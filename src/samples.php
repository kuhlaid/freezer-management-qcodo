<?php
/**
 * @abstract Lists samples by study type and sample type to help get an idea of how many types of samples we
 * have in the bank.
 * @author w. Patrick Gale
 *
 * Sept. 29, 2020 
 * - adding a txtBarcode component to search by specific sample barcodes
 * 
 * Jan. 29, 2014 - added the 'completed' checkbox to the right of boxes that have been inventoried in the
 * Box column of the samples.php data table
 *
 * March 21, 2014 - added an orphan filter to filter samples that either have a slot specified in a box or not
 *
 *- updated the freezer array (Feb. 4, 2016 - wpg)
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */

// Include the classfile for SampleListFormBase
require(__FORMBASE_CLASSES__ . '/SampleListFormBase.class.php');

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();


class SampleListForm8 extends SampleListFormBase {
	protected $lstTimepoint, $txtBarcode, $lstSampleType, $colSampleBoxLocation, $lstInventoriedBox, $blnOrphan, $objFreezerArray;

	protected function Form_Create() {
		// show box options for selecting the freezer
		foreach (Freezer::$freezerArray as $freezerCode => $freezerName) {
			$this->objFreezerArray[$freezerCode] = "(".$freezerCode.") ".$freezerName;
		}
		// show actual freezers
		$objFreezerArray = Freezer::QueryArray(QQ::All(),null,null,array('id','name'));
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$this->objFreezerArray[$objFreezer->Id] = $objFreezer->__toString();
		}

		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSample_EditLinkColumn_Render($_ITEM) ?>');

		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Id, false)));
		$this->colStudyTypeId = new QDataGridColumn(QApplication::Translate('Study'), '<?= $_FORM->dtgSample_StudyTypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId, false)));
		$this->colParticipantId = new QDataGridColumn(QApplication::Translate('Participant Id'), '<?= $_ITEM->ParticipantId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ParticipantId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ParticipantId, false)));
		$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Type'), '<?= $_FORM->dtgSample_SampleType_Render($_ITEM); ?>');
		$this->colSampleNumber = new QDataGridColumn(QApplication::Translate('Sample Number'), '<?= $_ITEM->SampleNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber, false)));
		$this->colBarcode = new QDataGridColumn(QApplication::Translate('Barcode'), '<?= QString::Truncate($_ITEM->Barcode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode, false)));
		$this->colStudyCase = new QDataGridColumn(QApplication::Translate('Case'), '<?= $_ITEM->StudyCase."<div class=\"sm cGray\">$_ITEM->Notes</div>"; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase, false)));
		$this->colSampleloc = new QDataGridColumn(QApplication::Translate('Sampleloc'), '<?= QString::Truncate($_ITEM->Sampleloc, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc, false)));
		$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box'), '<?= $_FORM->dtgSample_BoxLinkColumn_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->BoxId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->BoxId, false)));
		$this->colBoxSampleSlot = new QDataGridColumn(QApplication::Translate('Box Sample Slot'), '<?= $_ITEM->BoxSampleSlot; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->BoxSampleSlot), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->BoxSampleSlot, false)));
		$this->colBoxId->HtmlEntities = $this->colStudyCase->HtmlEntities = $this->colEditLinkColumn->HtmlEntities = false;

		// Setup DataGrid
		$this->dtgSample = new QDataGrid($this);
		$this->dtgSample->CellSpacing = 0;
		$this->dtgSample->CellPadding = 4;
		$this->dtgSample->BorderStyle = QBorderStyle::Solid;
		$this->dtgSample->BorderWidth = 1;
		$this->dtgSample->GridLines = QGridLines::Both;
		$this->dtgSample->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgSample->Paginator = new QPaginator($this->dtgSample);
		$this->dtgSample->ItemsPerPage = __ITEMS_PER_PAGE__;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSample->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgSample->SetDataBinder('dtgSample_Bind');

		//$this->dtgSample->AddColumn($this->colEditLinkColumn);
		$this->dtgSample->AddColumn($this->colStudyTypeId);
		//$this->dtgSample->AddColumn($this->colParticipantId);
		$this->dtgSample->AddColumn($this->colSampleTypeId);
		$this->dtgSample->AddColumn($this->colSampleNumber);
		$this->dtgSample->AddColumn($this->colBarcode);
		$this->dtgSample->AddColumn($this->colStudyCase);
		$this->dtgSample->AddColumn($this->colBoxSampleSlot);
		$this->dtgSample->AddColumn($this->colBoxId);
		//$this->dtgSample->AddColumn($this->colSampleBoxLocation);

		$this->lstTimepoint_Create();
		$this->txtBarcode_Create();
		$this->lstSampleType_Create();
		$this->lstInventoriedBox_Create();
		$this->blnOrphan_Create();
	}

	public function dtgSample_EditLinkColumn_Render(Sample $objSample) {
		return sprintf('<a href="sample.php?intId=%s">%s</a>',
				$objSample->Id,
				QApplication::Translate('Edit'));
	}

	public function dtgSample_BoxLinkColumn_Render(Sample $objSample) {
		$boxId = $boxName = '';
		if ($objSample->BoxId) {
			$boxId = $objSample->BoxId;
			// try to get the box name
			$objBox = Box::QuerySingle(QQ::Equal(QQN::Box()->Id, $boxId),null,null, array('name','complete','freezer','rack_id'));
			if ($objBox) {
				$boxName = "<b>".$objBox->Name."</b>";
				if ($objBox->Complete) $boxName .= ' <img src="'.__IMAGE_ASSETS__.'/tick.png" border="0" title="box has been inventoried">';
				if ($objBox->Freezer && $objBox->Freezer >= 1) $boxName .= '<br/><a href="freezer-view.php?intFreezer='.$objBox->Freezer.'">'.$this->objFreezerArray[$objBox->Freezer].'</a>';
				if ($objBox->RackId) $boxName .= '<br/><a href="boxes.php?intRack='.$objBox->RackId.'&intFreezerId='.$objBox->Freezer.'">View rack</a>';
			}

		}

		if ($boxId != '')
			return sprintf('<a href="box-view.php?intId=%s">%s</a>',
					$boxId,
					$boxName);
		else return null;
	}

	protected function lstTimepoint_Create() {
		$this->lstTimepoint = new QListBox($this);
		$this->lstTimepoint->Name = QApplication::Translate('Filter by study: ');
		$this->lstTimepoint->CssClass = '';
		$this->lstTimepoint->HtmlAfter = '<br/><br/>';
		$this->lstTimepoint->AddItem("--all studies--",null);
		$objStudyArray = FmStudy::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::FmStudy()->Name)));
		foreach ($objStudyArray as $objStudy)
			$this->lstTimepoint->AddItem(new QListItem($objStudy->Name, $objStudy->Id));
		$this->lstTimepoint->AddAction(new QChangeEvent(), new QServerAction('dtgSample_Bind'));
	}

	protected function txtBarcode_Create() {
		$this->txtBarcode = new QTextBox($this);
		$this->txtBarcode->Name = QApplication::Translate('Barcode: ');
		$this->txtBarcode->AddAction(new QChangeEvent(), new QServerAction('dtgSample_Bind'));
	}

	protected function lstSampleType_Create() {
		$this->lstSampleType = new QListBox($this);
		$this->lstSampleType->Name = QApplication::Translate('Filter by sample type: ');
		$this->lstSampleType->CssClass = '';
		$this->lstSampleType->HtmlAfter = '<br/><br/>';
		$this->lstSampleType->AddItem("--all types--",null);
		$objSampleTypeArray = SampleTypes::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::SampleTypes()->Description)));
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			$this->lstSampleType->AddItem($objListItem);
		}
		$this->lstSampleType->AddAction(new QChangeEvent(), new QServerAction('dtgSample_Bind'));
	}

	// filter to either show inventoried boxes or not
	protected function lstInventoriedBox_Create() {
		$this->lstInventoriedBox = new QListBox($this);
		$this->lstInventoriedBox->Name = QApplication::Translate('Filter by inventoried samples:');
		$this->lstInventoriedBox->CssClass = '';
		$this->lstInventoriedBox->HtmlAfter = '<br/><br/>';
		$this->lstInventoriedBox->AddItem("--all--",null);
		$tempArray = array('I'=>'Inventoried', 'NI'=>'Not Inventoried');
		foreach ($tempArray as $key=>$value) {
			$objListItem = new QListItem($value, $key);
			$this->lstInventoriedBox->AddItem($objListItem);
		}
		$this->lstInventoriedBox->AddAction(new QChangeEvent(), new QServerAction('dtgSample_Bind'));
	}


	protected function blnOrphan_Create() {
		$this->blnOrphan = new QCheckBox($this);
		$this->blnOrphan->Name = QApplication::Translate('Orphan samples? ');
		$this->blnOrphan->CssClass = '';
		$this->blnOrphan->HtmlAfter = '<br/><br/>';
		$this->blnOrphan->AddAction(new QChangeEvent(), new QServerAction('dtgSample_Bind'));
	}

	protected function dtgSample_Bind() {
		$strAndCondition = '';
		// filter list by timepoint
		if ($this->lstTimepoint->SelectedValue != ''){
			$strAndCondition .= "QQ::Equal(QQN::Sample()->StudyTypeId,".$this->lstTimepoint->SelectedValue.")";
		}

		// filter by barcode
		if ($this->txtBarcode->Text != ''){
			$strAndCondition .= "QQ::Equal(QQN::Sample()->Barcode,'".$this->txtBarcode->Text."')";
		}

		// filter list by sample type
		if ($this->lstSampleType->SelectedValue != ''){
			if ($strAndCondition != '') $strAndCondition .= ",";
			$strAndCondition .= "QQ::Equal(QQN::Sample()->SampleTypeId,".$this->lstSampleType->SelectedValue.")";
		}

		// filter list by inventoried boxes
		if ($this->lstInventoriedBox->SelectedValue != ''){
			if ($this->lstInventoriedBox->SelectedValue == 'I'){
				if ($strAndCondition != '') $strAndCondition .= ",";
				$strAndCondition .= "QQ::Equal(QQN::Sample()->Box->Complete,1)";
			}
			elseif ($this->lstInventoriedBox->SelectedValue == 'NI'){
				if ($strAndCondition != '') $strAndCondition .= ",";
				$strAndCondition .= "QQ::OrCondition(QQ::IsNull(QQN::Sample()->Box->Complete),QQ::Equal(QQN::Sample()->Box->Complete,0))";
			}
		}

		if ($this->blnOrphan->Checked){
			if ($strAndCondition != '') $strAndCondition .= ",";
			$strAndCondition .= "QQ::OrCondition(QQ::Equal(QQN::Sample()->BoxSampleSlot,''),QQ::IsNull(QQN::Sample()->BoxSampleSlot))";
		}
		else {
			if ($strAndCondition != '') $strAndCondition .= ",";
			$strAndCondition .= "QQ::NotEqual(QQN::Sample()->BoxSampleSlot,'')";
		}

		if ($strAndCondition == '') {
			$strAndCondition .= "QQ::All()";
		}
		else {
			$strAndCondition = "QQ::AndCondition(".$strAndCondition.")";
		}
		// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
		$this->dtgSample->TotalItemCount = Sample::QueryCount(eval("return $strAndCondition;"));

		// Setup the $objClauses Array
		$objClauses = array();

		// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
		// the OrderByClause to the $objClauses array
		if ($objClause = $this->dtgSample->OrderByClause)
			array_push($objClauses, $objClause);

		// Add the LimitClause information, as well
		if ($objClause = $this->dtgSample->LimitClause)
			array_push($objClauses, $objClause);

		// Set the DataSource to be the array of all Sample objects, given the clauses above
		$this->dtgSample->DataSource = Sample::QueryArray(eval("return $strAndCondition;"), $objClauses);
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('sample_list');
?>