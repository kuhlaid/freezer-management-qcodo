<?php
/**
 * @abstract Used to parse a list of cases to search for in the freezer inventory and return the sample details.
 * @author w. Patrick Gale (June 2013)
 *
 * Aug. 2, 2018 - wpg
 * - only showing an alert and redirecting to select a moving box if one is not selected
 * 
 * Feb. 16, 2018 - wpg
 * - changing the box column to include the box type (to help me differentiate between 2ml sample boxes and large vaccutainer boxes)
 *
 * Aug. 20, 2017 - wpg
 * - adding an 'auto select one sample from each subject' button
 *
 * Aug. 1, 2017 - wpg
 * - fixing the issue with leading and trailing white space in the search list making it impossible to find a sample if a whitespace exists
 *
 * - changed Export to Excel function to fix old one and adding link to show and hide the sample selection checkboxes
 * since we do not want to show these if exporting to Excel (Aug. 5, 2015 - wpg)
 * - changed box field to show link to the box details and also show the box description on link hover (Sept. 23, 2015 - wpg)
 * - adding strParticipantSampleRpt control to show the number of samples available and participants missing samples for the list of participants being searched (Oct. 1, 2015 - wpg)
 * - adding sample search log integration for saving
 * - adding a chkInventory checkbox to search only by samples still in inventory (Jan. 20, 2016 - wpg)
 * - disabling the selection checkboxes if the sample selection is locked (Jan. 29, 2016 - wpg)
 */
require('includes/prepend.inc.php');
require(__FORMBASE_CLASSES__ . '/SampleListFormBase.class.php');
QApplication::CheckRemoteAdmin();

class FindSamples8 extends SampleListFormBase {
	protected $strParticipantSampleRpt, $txtParticipants, $btnSearch, $lstSampleType, $dtgSample, $btnExport, $lstStudyType,
	$freezerPullArray,$sampleChkBx, $objSampleSelection,$lstStudyArray, $chkInventory, $btnAutoSelect;

	protected function Form_Create() {
		// if we are loaded a previously saved sample search
		$intSampleSelectId = QApplication::QueryString('intSampleSelectId');
		if ($intSampleSelectId) {
			$objSampleSelection = SampleSelection::Load($intSampleSelectId);
			if ($objSampleSelection) {
				QSessionDB::set('__SAMPLE_SELECTION_SEARCH__',serialize($objSampleSelection));
				QSessionDB::set('__FREEZER_PULL_LIST__',$objSampleSelection->SampleSelect);
				// redirect to set a moving box if one is not set
				if (!QSessionDB::get('__SAMPLE_MOVING_BOX__')) {
					QSessionDB::set('error', 'Please set a moving box');
				QApplication::Redirect("boxes.php");
				exit;
				}
			}
		}
		$this->freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__'));
		$this->sampleChkBx = QApplication::QueryString('sampleChkBx');

		$this->btnAutoSelect_Create();
		$this->txtParticipants_Create();
		$this->strParticipantSampleRpt_Create();
		$this->lstSampleType_Create();
		$this->chkInventory_Create();
		$this->lstStudyArray=array();
		// if we are performing a sample search then load the search criteria
		if (QSessionDB::get('__SAMPLE_SELECTION_SEARCH__')) {
			$this->objSampleSelection = unserialize(QSessionDB::get('__SAMPLE_SELECTION_SEARCH__'));
			$this->txtParticipants->Text = $this->objSampleSelection->ParticipantSelect;
			$this->lstSampleType->SelectedValue = $this->objSampleSelection->SampleType;
			$this->lstStudyArray = explode(",",$this->objSampleSelection->StudySelect);
			// show checkboxes always when we are in sample selection mode
			$this->sampleChkBx = 'show';
		}

		$this->lstStudyType_Create();
		$this->btnSearch_Create();

		// Setup DataGrid Columns
		$this->colId = new QDataGridColumn(QApplication::Translate('Sample Id'), '<?= $_FORM->dtgSample_IdColumn_Render($_ITEM) ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Id, false)));
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSample_EditLinkColumn_Render($_ITEM) ?>');
		$this->colStudyTypeId = new QDataGridColumn(QApplication::Translate('Study Type'), '<?= $_FORM->dtgSample_StudyTypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId, false)));
		$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type'), '<?= $_FORM->dtgSample_SampleType_Render($_ITEM); ?>');
		$this->colSampleNumber = new QDataGridColumn(QApplication::Translate('Sample Number'), '<?= $_ITEM->SampleNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber, false)));
		$this->colBarcode = new QDataGridColumn(QApplication::Translate('Barcode'), '<?= QString::Truncate($_ITEM->Barcode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode, false)));
		$this->colStudyCase = new QDataGridColumn(QApplication::Translate('Study Case'), '<?= QString::Truncate($_ITEM->StudyCase, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase, false)));
		$this->colSampleloc = new QDataGridColumn(QApplication::Translate('Sampleloc'), '<?= QString::Truncate($_ITEM->Sampleloc, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc, false)));
		$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box'), '<?= $_FORM->dtgSample_Box_Render($_ITEM); ?>');
		$this->colNotes = new QDataGridColumn(QApplication::Translate('Notes'), '<?= QString::Truncate($_ITEM->Notes, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Notes), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Notes, false)));
		$this->colBoxSampleSlot = new QDataGridColumn(QApplication::Translate('Box Sample Slot'), '<?= $_ITEM->BoxSampleSlot; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->BoxSampleSlot), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->BoxSampleSlot, false)));
		$this->colParentId = new QDataGridColumn(QApplication::Translate('Parent Id'), '<?= $_ITEM->ParentId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ParentId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ParentId, false)));
		$this->colContainerTypeId = new QDataGridColumn(QApplication::Translate('Container Type Id'), '<?= $_FORM->dtgSample_ContainerType_Render($_ITEM); ?>');
		$this->colStateTypeId = new QDataGridColumn(QApplication::Translate('State Type Id'), '<?= $_FORM->dtgSample_StateType_Render($_ITEM); ?>');
		$this->colVolume = new QDataGridColumn(QApplication::Translate('Volume'), '<?= $_ITEM->Volume; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Volume), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Volume, false)));
		$this->colVolumeUnit = new QDataGridColumn(QApplication::Translate('Volume Unit'), '<?= QString::Truncate($_ITEM->VolumeUnit, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->VolumeUnit), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->VolumeUnit, false)));
		$this->colConcentration = new QDataGridColumn(QApplication::Translate('Concentration'), '<?= $_ITEM->Concentration; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Concentration), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Concentration, false)));
		$this->colConcentrationUnit = new QDataGridColumn(QApplication::Translate('Concentration Unit'), '<?= QString::Truncate($_ITEM->ConcentrationUnit, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ConcentrationUnit), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ConcentrationUnit, false)));
		$this->colStateDate = new QDataGridColumn(QApplication::Translate('State Date'), '<?= $_FORM->dtgSample_StateDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StateDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StateDate, false)));
		$this->colId->HtmlEntities = $this->colBoxId->HtmlEntities = $this->colEditLinkColumn->HtmlEntities = false;

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

		$this->dtgSample->SortColumnIndex = 6;
		$this->dtgSample->SortDirection = 1;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSample->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgSample->SetDataBinder('dtgSample_Bind');

		// wpg - do not show the sample selection checkbox if it is hidden
		if ($this->sampleChkBx == 'show')
			$this->dtgSample->AddColumn($this->colId);
		$this->dtgSample->AddColumn($this->colEditLinkColumn);
		$this->dtgSample->AddColumn($this->colStudyTypeId);
		//$this->dtgSample->AddColumn($this->colParticipantId);
		$this->dtgSample->AddColumn($this->colSampleTypeId);
		$this->dtgSample->AddColumn($this->colSampleNumber);
		$this->dtgSample->AddColumn($this->colBarcode);
		$this->dtgSample->AddColumn($this->colStudyCase);
		//$this->dtgSample->AddColumn($this->colSampleloc);
		$this->dtgSample->AddColumn($this->colBoxId);
		$this->dtgSample->AddColumn($this->colNotes);
		$this->dtgSample->AddColumn($this->colBoxSampleSlot);

		$this->dtgSample->AddColumn($this->colContainerTypeId);
		$this->dtgSample->AddColumn($this->colStateTypeId);
		$this->dtgSample->AddColumn($this->colVolume);
		$this->dtgSample->AddColumn($this->colVolumeUnit);
		$this->dtgSample->AddColumn($this->colConcentration);
		$this->dtgSample->AddColumn($this->colConcentrationUnit);
		$this->dtgSample->AddColumn($this->colStateDate);

		$this->dtgSample->ItemsPerPage = __ITEMS_PER_PAGE__;
		$this->btnExport_Create();
	}


	public function dtgSample_Box_Render(Sample $objSample) {
		if (!is_null($objSample->Box))
			return sprintf('%s<br/>%s',
					$objSample->Box->__toStringDesc("bld fs18"),
					$objSample->Box->BoxType->__toString());
	}

	public function dtgSample_EditLinkColumn_Render(Sample $objSample) {
		return sprintf('<a href="sample.php?intId=%s">%s</a>',
				$objSample->Id,
				QApplication::Translate('Edit'));
	}

	public function dtgSample_IdColumn_Render(Sample $objSample) {
		// we will use explicitly defined control ids.
		$strControlId = 'chkSamplePull' . $objSample->Id;

		// Let's see if the checkbox exists already
		$chkSamplePull = $this->GetControl($strControlId);

		if (!$chkSamplePull) {
			$chkSamplePull = new QCheckBox($this->dtgSample, $strControlId);
			$chkSamplePull->Text = $objSample->Id;
			// show checkboxes as long as we have not transferred samples
			if (!$this->objSampleSelection->SamplesTransferred) {
				$chkSamplePull->ActionParameter = $objSample->Id;
				// Let's assign a server action on click
				$chkSamplePull->AddAction(new QChangeEvent(), new QAjaxAction('chkSamplePull_Change'));
			}
			else
				$chkSamplePull->Enabled=false;
		}

		if (!($objSample->BoxSampleSlot && $objSample->Box->BoxType)) {
			$chkSamplePull->Enabled = false;
			$chkSamplePull->ToolTip = "The sample must be inventoried to add it to the sample pull list.";
		}
		else {
			$chkSamplePull->Enabled = true;
			$chkSamplePull->ToolTip = "Select to add the sample to a freezer pull";
		}

		if (is_array($this->freezerPullArray)) {
			if (in_array($objSample->Id, $this->freezerPullArray)) {
				$chkSamplePull->Checked = true;
			}
		}

		// disable the checkbox if the sample selection is locked (Jan. 29, 2016 - wpg)
		if ($this->objSampleSelection->Lock==1) {
			$chkSamplePull->Enabled = false;
		}
		// if the selected item is in the freezer pull list then highlight the cell
		//$this->colId->CssClass = 'sRed';

		// Render the checkbox.  We want to *return* the contents of the rendered Checkbox,
		// not display it.  (The datagrid is responsible for the rendering of this column).
		// Therefore, we must specify "false" for the optional blnDisplayOutput parameter.
		if ($chkSamplePull)
			return $chkSamplePull->Render(false);
	}

	protected function chkSamplePull_Change($strFormId, $strControlId, $strParameter) {
		$chkSamplePull = $this->GetControl($strControlId);
		$this->updateSampleSelections($chkSamplePull,$strParameter,null);
// 		$this->freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__'));
// 		if (!is_array($this->freezerPullArray)) $this->freezerPullArray = array();

// 		if ($chkSamplePull->Checked) {
// 			$this->freezerPullArray[$strParameter] = $strParameter;
// 			QSessionDB::set('__FREEZER_PULL_LIST__',serialize($this->freezerPullArray));
// 			//QApplication::DisplayAlert($strParameter." checked");
// 		}
// 		else {
// 			unset($this->freezerPullArray[$strParameter]);
// 			QSessionDB::set('__FREEZER_PULL_LIST__',serialize($this->freezerPullArray));
// 			//QApplication::DisplayAlert($strParameter." unchecked");
// 		}
// 		$this->updateSearchLog();	// update the search log with sample selection
		// show or hide the sample pull report link depending on if we have any selections
		$th = unserialize(QSessionDB::get('__MAIN_APP_THIS__'));
		QApplication::ExecuteJavaScript(sprintf('$.get("sample-pull.php?option=c", function(data) { if(data==1) $("#dmI").show("slow");else $("#dmI").hide("fast")});', $th));
	}

	protected function btnExport_Create(){
		$this->btnExport = new QButton($this);
		$this->btnExport->Text = QApplication::Translate('Export list to Excel');
		$this->btnExport->AddAction(new QClickEvent(), new QServerAction('btnExport_Click'));
		if ($this->sampleChkBx == 'show')
			$this->btnExport->Enabled = false;
	}
	// wpg - old export function
	// 	protected function btnExport_Click($strFormId, $strControlId, $strParameter) {
	// 		ob_end_clean();	// first silently get rid of any data we have in output
	// 		header("Content-Type: application/msexcel");
	// 		header("Content-Disposition: attachment; filename=\"samples_search.xls\"");
	// 		header("Cache-Control: no-store, no-cache, must-revalidate");
	// 		header("Cache-Control: post-check=0, pre-check=0", false);
	// 		print'
	// 				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	// 				<html xmlns="http://www.w3.org/1999/xhtml">
	// 				<head>
	// 				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	// 				<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
	// 				</head>
	// 				<body>
	// 				';
	// 		print($this->dtgSample->DG);
	// 		print'
	// 				</body>
	// 				</html>';
	// 		exit;
	// 	}

	protected function btnExport_Click($strFormId, $strControlId, $strParameter) {
		// ----------- start PHPExcel code
		if (PHP_SAPI == 'cli')
			die('This export should only be run from a Web Browser');

		/** Include PHPExcel */
		require_once __PHPEXCEL_CLASSES__ . '/PHPExcel.php';


		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("w. Patrick Gale")
		->setLastModifiedBy("w. Patrick Gale")
		->setTitle("Office 2007 XLSX - FM2013 Samples")
		->setSubject("Office 2007 XLSX - Data Dictionary")
		->setDescription("Generated samples selection from FM2013")
		->setKeywords("office 2007 openxml php")
		->setCategory("XLSX");

		// testing
		//print_r($this->dtgSample->PHPExcel);
		//print_r(tableToArray($this->dtgSample->PHPExcel));
		//exit;

		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
		->fromArray(tableToArray($this->dtgSample->PHPExcel),NULL,'A1');

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle("FM2013 Samples");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		ob_end_clean();	// first silently get rid of any data we have in output
		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="fm2013_'.QDateTime::NowToString('YYYY.MM.DD').'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		return;
		// ----------- end PHPExcel code
	}

	protected function txtParticipants_Create() {
		$this->txtParticipants = new QTextBox($this);
		$this->txtParticipants->Name = QApplication::Translate('Participants list');
		$this->txtParticipants->AddAction(new QChangeEvent(), new QAjaxAction('updateSearchLog'));
		$this->txtParticipants->TextMode = QTextMode::MultiLine;
		$this->txtParticipants->HtmlBefore = 'Participants ID/Study Case (enter or paste in a list of IDs using one ID per line)';
		//$this->txtParticipants->Required = true;
		$this->txtParticipants->Width = '100%';
	}

	protected function updateSearchLog() {
		// only save the sample selection changes if the log is not locked
		if ($this->objSampleSelection && !$this->objSampleSelection->Lock) {
			$this->objSampleSelection = unserialize(QSessionDB::get('__SAMPLE_SELECTION_SEARCH__'));
			$this->objSampleSelection->ParticipantSelect = $this->txtParticipants->Text;
			$this->objSampleSelection->SampleType = $this->lstSampleType->SelectedValue;
			$lstStudy = '';
			foreach ($this->lstStudyType->SelectedItems as $objLstStudy){
				if ($lstStudy != '') $lstStudy .= ",";
				$lstStudy .= $objLstStudy->Value;
			}
			$this->objSampleSelection->StudySelect = $lstStudy;
			$this->objSampleSelection->SampleSelect = QSessionDB::get('__FREEZER_PULL_LIST__');
			$this->objSampleSelection->Save();
			// update the sample selection search session
			QSessionDB::set('__SAMPLE_SELECTION_SEARCH__',serialize($this->objSampleSelection));
		}
	}

	// used to show the number of samples avaialable for a searched participant
	protected function strParticipantSampleRpt_Create() {
		$this->strParticipantSampleRpt = new QLabel($this);
		$this->strParticipantSampleRpt->Name = 'Participant (number of samples available):';
		$this->strParticipantSampleRpt->HtmlEntities = false;
	}

	// Create and Setup lstSampleType
	protected function lstSampleType_Create() {
		$this->lstSampleType = new QListBox($this);
		$this->lstSampleType->Name = QApplication::Translate('Sample Type: ');
		$this->lstSampleType->AddAction(new QChangeEvent(), new QAjaxAction('updateSearchLog'));
		$this->lstSampleType->AddItem(QApplication::Translate('- Select One -'), null);
		$objSampleTypeArray = SampleTypes::QueryArray(QQ::All(),QQ::Clause(QQ::OrderBy(QQN::SampleTypes()->Description)));
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			$this->lstSampleType->AddItem($objListItem);
		}
	}

	protected function chkInventory_Create() {
		$this->chkInventory = new QCheckBox($this);
		$this->chkInventory->Name = QApplication::Translate('Search only samples still in inventory: ');
		$this->chkInventory->AddAction(new QChangeEvent(), new QAjaxAction('updateSearchLog'));
	}

	// study type filter
	protected function lstStudyType_Create() {
		$this->lstStudyType = new QListBox($this);
		$this->lstStudyType->Name = QApplication::Translate('Studies');
		$this->lstStudyType->AddAction(new QChangeEvent(), new QAjaxAction('updateSearchLog'));
		$this->lstStudyType->SelectionMode = QSelectionMode::Multiple;
		$this->lstStudyType->Rows = 6;
		$objStudyArray = FmStudy::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::FmStudy()->Name)));
		foreach ($objStudyArray as $objStudy)
			$this->lstStudyType->AddItem(new QListItem($objStudy->Name, $objStudy->Id, in_array($objStudy->Id, $this->lstStudyArray)));
			// // check to see if we have selected studies in a saved sample search
			// if ($this->lstStudyArray && in_array($objStudy->Id, $this->lstStudyArray)) {
			// 	$objListItem->Selected = true;
			// }

			// $this->lstStudyType->AddItem($objListItem);
		
	}

	protected function btnSearch_Create() {
		$this->btnSearch = new QButton($this);
		$this->btnSearch->Text = QApplication::Translate('Search');
		$this->btnSearch->AddAction(new QClickEvent(), new QServerAction('sampleSearch'));
		$this->btnSearch->PrimaryButton = true;
		$this->btnSearch->CausesValidation = true;
	}

	protected function btnAutoSelect_Create() {
		$this->btnAutoSelect = new QButton($this);
		$this->btnAutoSelect->Text = QApplication::Translate('Auto-select one sample from each subject');
		$this->btnAutoSelect->AddAction(new QClickEvent(), new QServerAction('autoSelect'));	// we must use the server action otherwise the explode function will not work correctly in the autoSelect fuction for some reason
		if (QSessionDB::get('__SAMPLE_SELECTION_SEARCH__')) {
			$this->btnAutoSelect->Enabled = true;
			$this->btnAutoSelect->Visible = true;
		}
		else {
			$this->btnAutoSelect->Enabled = false;
			$this->btnAutoSelect->Visible = false;
		}
	}

	protected function autoSelect() {
		$strParticipantArray = array();
		$strAndCondition = '';
		$this->txtParticipants->Text = trim($this->txtParticipants->Text);	// trim the participant list
		// get list of participants to search on
		if ($this->txtParticipants->Text != '') {
			// split IDs by new line
			$delimiter = "\r\n";
			$strParticipantArray = explode($delimiter,str_ireplace(' ', '', trim($this->txtParticipants->Text)));
			$strParticipantTrimmedArray=array_map('trim',$strParticipantArray);	// we need to trim leading and trailing white space in the array values
			$strComPart='';
			if ($strParticipantTrimmedArray) foreach($strParticipantTrimmedArray as $key=>$strParticipant) {
				if ($strComPart != '') $strComPart .= ",";
				$strComPart .= "'".$strParticipant."'";
			}
			$strAndCondition .= "study_case IN ($strComPart)";
		}

		if ($this->lstSampleType->SelectedValue != ''){
			if ($strAndCondition != '') $strAndCondition .= " AND ";
			$strAndCondition .= "sample_type_id=".$this->lstSampleType->SelectedValue;
		}

		// only select samples still in inventory and ignore any off-site (Jan. 20, 2016 - wpg)
		if ($this->chkInventory->Checked){
			if ($strAndCondition != '') $strAndCondition .= " AND ";
			$strAndCondition .= "box_id IN (SELECT id FROM fm__box WHERE freezer > 1)";
		}

		// filter by selected study(s)
		if ($this->lstStudyType->SelectedValue != '' && $this->lstStudyType->SelectedItems != '') {
			$stud = "";
			foreach ($this->lstStudyType->SelectedItems as $objStudyType) {
				if ($stud != '') $stud .= " OR ";
				$stud .= "study_type_id=".$objStudyType->Value;
			}
			if ($strAndCondition != '') $strAndCondition .= " AND ";
			$strAndCondition .= "(".$stud.")";
		}

		if ($strAndCondition != '') $strAndCondition=" WHERE ".$strAndCondition;
		$strQuery = "SELECT id
				FROM fm__sample
				WHERE id IN (
				SELECT MIN(id) as one_sample
				FROM fm__sample
				".$strAndCondition." GROUP BY study_case)";

		$objDatabase = Sample::GetDatabase();
		$objDbResult = $objDatabase->Query($strQuery);
		
		$this->updateSampleSelections(null,null,$objDbResult);
		$this->sampleSearch();
	}

	// updating the sample selection for a freezer pull request
	protected function updateSampleSelections($chkSamplePull=null,$strParameter=null,$objDbResult=null){
		$this->freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__'));
		if (!is_array($this->freezerPullArray)) $this->freezerPullArray = array();
		// if we are manually updating the sample selections
		if ($chkSamplePull) {
			if ($chkSamplePull->Checked) {
				$this->freezerPullArray[$strParameter] = $strParameter;
				//QApplication::DisplayAlert($strParameter." checked");
			}
			else {
				unset($this->freezerPullArray[$strParameter]);
				//QApplication::DisplayAlert($strParameter." unchecked");
			}
		}
		if ($objDbResult) while ($mixRow = $objDbResult->FetchArray()){
			$this->freezerPullArray[$mixRow['id']] = $mixRow['id'];
		}
		//error_log('find samples:'.count($this->freezerPullArray));
		QSessionDB::set('__FREEZER_PULL_LIST__',serialize($this->freezerPullArray));
		$this->updateSearchLog();	// update the search log with sample selection
	}

	protected function sampleSearch() {
		$this->dtgSample->Paginator->PageNumber = 1;
		$this->dtgSample->Refresh();
		$this->dtgSample_Bind();
	}

	protected function dtgSample_Bind() {
		// get the latest list of samples to pull
		$this->freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__'));
		$strParticipantArray = array();
		$strAndCondition = '';
		$this->txtParticipants->Text = trim($this->txtParticipants->Text);	// trim the participant list
		// get list of participants to search on
		if ($this->txtParticipants->Text != '') {
			// convert the participants list into an array if the list is separated by commas
			//$strParticipant = explode(',',str_ireplace(' ', '', $this->txtParticipants->Text));

			// split IDs by new line
			$delimiter = "\r\n";
			$strParticipantArray = explode($delimiter,str_ireplace(' ', '', trim($this->txtParticipants->Text)));
			$strParticipantTrimmedArray=array_map('trim',$strParticipantArray);	// we need to trim leading and trailing white space in the array values
			$strAndCondition .= "QQ::In(QQN::Sample()->StudyCase, \$strParticipantTrimmedArray)";
		}

		if ($this->lstSampleType->SelectedValue != ''){
			if ($strAndCondition != '') $strAndCondition .= ",";
			$strAndCondition .= "QQ::Equal(QQN::Sample()->SampleTypeId,".$this->lstSampleType->SelectedValue.")";
		}

		// only select samples still in inventory and ignore any off-site (Jan. 20, 2016 - wpg)
		if ($this->chkInventory->Checked){
			if ($strAndCondition != '') $strAndCondition .= ",";
			$strAndCondition .= "QQ::NotEqual(QQN::Sample()->Box->Freezer,-2)";
		}

		// filter by selected study(s)
		if ($this->lstStudyType->SelectedValue != '' && $this->lstStudyType->SelectedItems != '') {
			$stud = "";
			foreach ($this->lstStudyType->SelectedItems as $objStudyType) {
				if ($stud != '') $stud .= ",";
				$stud .= "QQ::Equal(QQN::Sample()->StudyTypeId,".$objStudyType->Value.")";
			}
			if ($strAndCondition != '') $strAndCondition .= ",";
			$strAndCondition .= "QQ::OrCondition(".$stud.")";
		}

		if ($strAndCondition == '') {
			$strAndCondition .= "QQ::All()";
		}
		else {
			$strAndCondition = "QQ::AndCondition(".$strAndCondition.")";

			$caseCountArray = array();
			// here we build the available/missing report
			$objSampleArray = Sample::QueryArray(eval("return $strAndCondition;"),array(),array(),array('study_case'));
			if ($objSampleArray) foreach($objSampleArray as $objSample) {
				if (array_key_exists($objSample->StudyCase, $caseCountArray))
					$caseCountArray[$objSample->StudyCase]++;
				else $caseCountArray[$objSample->StudyCase] = 1;
			}

			$caseCount='';
			// now we need to find the list of those who do not have samples
			if ($strParticipantArray) foreach($strParticipantArray as $strParticipant) {
				if (!array_key_exists($strParticipant, $caseCountArray))
					$caseCount .= $strParticipant." (no samples)<br/>";
				else $caseCount .= $strParticipant." (".$caseCountArray[$strParticipant].")<br/>";
			}

			$this->strParticipantSampleRpt->Text = $caseCount;
		}

		//error_log($strAndCondition);
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
ACL_Run('find_samples');
?>
