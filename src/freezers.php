<?php
/**
 * @abstract Lists the freezers we manage for our studies.
 * @author w. Patrick Gale (May 2013)
 *
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */

// Include the classfile for FreezerListFormBase
require(__FORMBASE_CLASSES__ . '/FreezerListFormBase.class.php');

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();

// freezer admin
class FreezerListForm8 extends FreezerListFormBase {
	protected $lstFreezerStatus;
	protected function Form_Create() {
		$this->lstFreezerStatus_Create();
		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFreezer_EditLinkColumn_Render($_ITEM) ?>');

		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= $_FORM->dtgFreezer_NameLinkColumn_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Name, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= $_ITEM->Description; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Description, false)));
		$this->colInUseSince = new QDataGridColumn(QApplication::Translate('In Use Since'), '<?= QString::Truncate($_ITEM->InUseSince, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->InUseSince), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->InUseSince, false)));
		$this->colLocation = new QDataGridColumn(QApplication::Translate('Location'), '<?= QString::Truncate($_ITEM->Location, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Location), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Location, false)));
		$this->colModelNumber = new QDataGridColumn(QApplication::Translate('Model #'), '<?= QString::Truncate($_ITEM->ModelNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ModelNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ModelNumber, false)));
		$this->colAssetNumber = new QDataGridColumn(QApplication::Translate('Asset #'), '#<?= QString::Truncate($_ITEM->AssetNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->AssetNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->AssetNumber, false)));
		$this->colAlarmAccount = new QDataGridColumn(QApplication::Translate('Alarm Account'), '#<?= QString::Truncate($_ITEM->AlarmAccount, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->AlarmAccount), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->AlarmAccount, false)));
		$this->colSerialNumber = new QDataGridColumn(QApplication::Translate('Serial #'), '<?= QString::Truncate($_ITEM->SerialNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->SerialNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->SerialNumber, false)));
		$this->colInUse = new QDataGridColumn(QApplication::Translate('Status'), '<?= $_FORM->dtgFreezer_InUseColumn_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->InUse), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->InUse, false)));

		$this->colEditLinkColumn->HtmlEntities = $this->colName->HtmlEntities = false;
		$this->colName->HorizontalAlign = QHorizontalAlign::Center;

		// Setup DataGrid
		$this->dtgFreezer = new QDataGrid($this);
		$this->dtgFreezer->CellSpacing = 0;
		$this->dtgFreezer->CellPadding = 4;
		$this->dtgFreezer->BorderStyle = QBorderStyle::Solid;
		$this->dtgFreezer->BorderWidth = 1;
		$this->dtgFreezer->GridLines = QGridLines::Both;
		$this->dtgFreezer->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgFreezer->Paginator = new QPaginator($this->dtgFreezer);
		$this->dtgFreezer->ItemsPerPage = __ITEMS_PER_PAGE__;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgFreezer->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgFreezer->SetDataBinder('dtgFreezer_Bind');

		$this->showColumns();
	}

	protected function showColumns() {
		$this->dtgFreezer->AddColumn($this->colEditLinkColumn);
		$this->dtgFreezer->AddColumn($this->colName);
		$this->dtgFreezer->AddColumn($this->colDescription);
		$this->dtgFreezer->AddColumn($this->colInUse);
		$this->dtgFreezer->AddColumn($this->colInUseSince);
		$this->dtgFreezer->AddColumn($this->colLocation);
			$this->dtgFreezer->AddColumn($this->colModelNumber);
			$this->dtgFreezer->AddColumn($this->colAssetNumber);
			$this->dtgFreezer->AddColumn($this->colAlarmAccount);
			$this->dtgFreezer->AddColumn($this->colSerialNumber);
	}

	public function dtgFreezer_InUseColumn_Render(Freezer $objFreezer) {
		$objRowStyle = new QDataGridRowStyle();
		$objRowStyle->CssClass = "fruse".$objFreezer->InUse;
		$this->dtgFreezer->OverrideRowStyle($this->dtgFreezer->CurrentRowIndex, $objRowStyle);


		if ($objFreezer->InUse)
			return Freezer::$freezerInUseArray[$objFreezer->InUse];
	}

	public function dtgFreezer_EditLinkColumn_Render(Freezer $objFreezer) {
		return sprintf('<a href="freezer.php?intId=%s" title="Edit freezer meta data">%s</a>',
				$objFreezer->Id,
				QApplication::Translate('Edit'));
	}


	public function dtgFreezer_NameLinkColumn_Render(Freezer $objFreezer) {
		// @todo - need to store these image file references in the database at some point instead of hard coding
		$fi = '<img src="'.__IMAGE_ASSETS__.'/upright-freezer.jpg" border="0" height="50px">';
		if ($objFreezer->Id == 1)
			$fi = '<img src="'.__IMAGE_ASSETS__.'/chest-freezer.jpg" border="0" height="50px">';
		elseif ($objFreezer->Id == 7)
		$fi = '<img src="'.__IMAGE_ASSETS__.'/ln-freezer.jpg" border="0" height="50px">';
		elseif ($objFreezer->Id == 9)
		$fi = '<img src="'.__IMAGE_ASSETS__.'/plasma-freezer.jpg" border="0" height="50px">';
		// added July 25, 2017 - wpg
		elseif ($objFreezer->Id == 12)
			$fi = '<img src="'.__IMAGE_ASSETS__.'/MVE-815P-190.png" border="0" height="50px">';

		return sprintf('<a href="freezer-view.php?intFreezer=%s" title="View freezer contents" class="bld ">%s<br/>%s</a>',
				$objFreezer->Id,
				$objFreezer->Name,
				$fi);
	}

	protected function lstFreezerStatus_Create() {
		$this->lstFreezerStatus = new QListBox($this);
		$this->lstFreezerStatus->Name = QApplication::Translate('Filter by freezer status:');
		$this->lstFreezerStatus->CssClass = '';
		$this->lstFreezerStatus->HtmlAfter = '<br/><br/>';
		$this->lstFreezerStatus->AddItem("--all types--",null);
		foreach(Freezer::$freezerInUseArray as $key => $val){
			$objListItem = new QListItem($val, $key);
			if ($key==1) $objListItem->Selected = true;
			$this->lstFreezerStatus->AddItem($objListItem);
		}
		$this->lstFreezerStatus->AddAction(new QChangeEvent(), new QServerAction('dtgFreezer_Bind'));	
	}

	protected function dtgFreezer_Bind() {
		// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

		if ($this->lstFreezerStatus->SelectedValue != ''){
			// filter by box type
			$strAndCondition = "QQ::Equal(QQN::Freezer()->InUse,".$this->lstFreezerStatus->SelectedValue.")";
		}
		else $strAndCondition = "QQ::All()";

		// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
		$this->dtgFreezer->TotalItemCount = Freezer::QueryCount(eval("return $strAndCondition;"));

		// Setup the $objClauses Array
		$objClauses = array();

		// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
		// the OrderByClause to the $objClauses array
		if ($objClause = $this->dtgFreezer->OrderByClause)
			array_push($objClauses, $objClause);

		// Add the LimitClause information, as well
		if ($objClause = $this->dtgFreezer->LimitClause)
			array_push($objClauses, $objClause);

		// Set the DataSource to be the array of all Freezer objects, given the clauses above
		$this->dtgFreezer->DataSource = Freezer::QueryArray(eval("return $strAndCondition;"),$objClauses);
	}
}

// view only
class FreezerListForm13 extends FreezerListForm8 {
	protected function showColumns() {
		$this->dtgFreezer->AddColumn($this->colName);
		$this->dtgFreezer->AddColumn($this->colDescription);
		$this->dtgFreezer->AddColumn($this->colInUse);
		$this->dtgFreezer->AddColumn($this->colInUseSince);
		$this->dtgFreezer->AddColumn($this->colLocation);
			$this->dtgFreezer->AddColumn($this->colModelNumber);
			$this->dtgFreezer->AddColumn($this->colAssetNumber);
			$this->dtgFreezer->AddColumn($this->colAlarmAccount);
			$this->dtgFreezer->AddColumn($this->colSerialNumber);
	}


	// 	public function dtgFreezer_NameLinkColumn_Render(Freezer $objFreezer) {
	// 		// @todo - need to store these image file references in the database at some point instead of hard coding
	// 		$fi = '<img src="'.__IMAGE_ASSETS__.'/upright-freezer.jpg" border="0" height="50px">';
	// 		if ($objFreezer->Id == 1)
		// 			$fi = '<img src="'.__IMAGE_ASSETS__.'/chest-freezer.jpg" border="0" height="50px">';
		// 		elseif ($objFreezer->Id == 7)
		// 		$fi = '<img src="'.__IMAGE_ASSETS__.'/ln-freezer.jpg" border="0" height="50px">';
		// 		elseif ($objFreezer->Id == 9)
		// 		$fi = '<img src="'.__IMAGE_ASSETS__.'/plasma-freezer.jpg" border="0" height="50px">';

		// 		return sprintf('<div class="bld ">%s</div>%s',
		// 				$objFreezer->Name,
		// 				$fi);
		// 	}
}
// go to the centralized form executing access control function to run the form and check access control
ACL_Run('freezers');

?>