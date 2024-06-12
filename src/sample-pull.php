<?php
/**
 * @abstract Report of samples needing to be pulled from the freezer.  Selected samples will be highlighted
 * in boxes with details on where the boxes are located to help the 'sample puller' retrieve samples.  When a
 * sample is pulled and placed in the shipment box, click on the link of the sample and change the sample location
 * to update the sample pull list (Note: until the sample pulls are saved in the database for future use, it is
 * best to select the samples to pull while using the freezer laptop.
 * @author w. Patrick Gale (May 2014)
 * @todo - need to save the sample pull to the database
 * - would probably be nice to have a list of samples (alternatives) and their locations if the initial
 * sample pull (due to issues originally selected samples) does not work
 *
 *Logic:
 Report of samples needing to be pulled from the freezer.  Selected samples will be highlighted
 in boxes with details on where the boxes are located to help the 'sample puller' retrieve samples.

 Aug. 8, 2018 - wpg
 - adding the btnReleaseSamples button so we can simply release samples in the existing boxes they are in
Aug. 21, 2017 - wpg
- changing the links to the boxes so those pulling samples can more easily move the samples to their new box

 Aug. 20, 2017 - wpg
 - adding a counter for the number of boxes needing to be pulled for large sample pull requests

 Feb. 15, 2017 - wpg
 - adding handler to allow for additional selected samples to be moved to a box with existing samples already logged (in case we are moving multiple sample selections to the same box)

 5/30/2014 - wpg
 Beginning to create basic report view based on selected sample IDs.

 6/2/2014 - wpg
 Adding checkboxes to remove samples from the list and links to the samples so they can be moved to their new box for shipping.
 Also added a 'clear all' button to remove all selected samples from the sample pull list. I created a new box for shipping the
 samples and used the new functions to move the samples to the shipment box (seemed to do what I needed it to do without too many bells
 and whistles).

 Oct. 19, 2015 - wpg
 - changing the select sample datagrid to enable sorting

 * - adding txtTransferBox, btnTransferSamples, and txtFreezerPullId controls (OCt. 29, 2015 - wpg)
 * - changing freezer number to actual freezer name since the ID does not match the 'named' freezer number (Jan. 21, 2016 - wpg)
 * - disabling the selection checkboxes if the sample selection is locked (Jan. 29, 2016 - wpg)
 */

// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');
require(__FORMBASE_CLASSES__ . '/SampleListFormBase.class.php');
QApplication::CheckRemoteAdmin();


class SamplePullReport extends SampleListFormBase {
	protected $rowCount, $columnCount, $slotCount, $strBoxes, $dtgSample, $freezerPullArray, $btnRemoveSamples;
	protected $objSampleArray, $txtTransferBox, $btnTransferSamples, $txtFreezerPullId, $objSampleSelection, $objFreezerArray, $btnReleaseSamples, $boxArray;
	protected function Form_Create() {
		$this->btnRemoveSamples_Create();
		$this->boxArray = array();

		// loading all freezer names
		$objFreezerArray = Freezer::QueryArray(QQ::All(),null,null,array('id','name'));
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$this->objFreezerArray[$objFreezer->Id] = $objFreezer->Name;
		}

		// 		$this->objDefaultWaitIcon = new QWaitIcon($this);
		// 		$this->objDefaultWaitIcon->CssClass = 'waitIcon';
		$this->freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__') ?? '');
		$this->objSampleSelection = unserialize(QSessionDB::get('__SAMPLE_SELECTION_SEARCH__') ?? '');
		$this->strBoxes = new QPlain($this);
		$this->boxView();

		// Setup DataGrid Columns
		$this->colId = new QDataGridColumn(QApplication::Translate('Sample Id'), '<?= $_FORM->dtgSample_IdColumn_Render($_ITEM) ?>');
		$this->colStudyTypeId = new QDataGridColumn(QApplication::Translate('Study Type'), '<?= $_FORM->dtgSample_StudyTypeId_Render($_ITEM); ?>');
		$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type Id'), '<?= $_FORM->dtgSample_SampleType_Render($_ITEM); ?>');
		$this->colSampleNumber = new QDataGridColumn(QApplication::Translate('Sample Number'), '<?= $_ITEM->SampleNumber; ?>');
		$this->colBarcode = new QDataGridColumn(QApplication::Translate('Barcode'), '<?= QString::Truncate($_ITEM->Barcode, 200); ?>');
		$this->colStudyCase = new QDataGridColumn(QApplication::Translate('Study Case'), '<?= QString::Truncate($_ITEM->StudyCase, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase, false)));
		$this->colSampleloc = new QDataGridColumn(QApplication::Translate('Sampleloc'), '<?= QString::Truncate($_ITEM->Sampleloc, 200); ?>');
		$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box'), '<?= $_FORM->dtgSample_Box_Render($_ITEM); ?>');
		$this->colBoxSampleSlot = new QDataGridColumn(QApplication::Translate('Box Sample Slot'), '<?= $_ITEM->BoxSampleSlot; ?>');
		$this->colId->HtmlEntities = $this->colBoxId->HtmlEntities = false;
		$this->colBoxId->CssClass = 'bld sm';

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
		$this->dtgSample->ItemsPerPage = 1000;

		$this->dtgSample->SortColumnIndex = 5;
		$this->dtgSample->SortDirection = 1;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSample->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSample->SetDataBinder('dtgSample_Bind');

		$this->dtgSample->AddColumn($this->colId);
		$this->dtgSample->AddColumn($this->colStudyTypeId);
		$this->dtgSample->AddColumn($this->colSampleTypeId);
		$this->dtgSample->AddColumn($this->colBarcode);
		$this->dtgSample->AddColumn($this->colStudyCase);
		$this->dtgSample->AddColumn($this->colBoxId);
		$this->dtgSample->AddColumn($this->colBoxSampleSlot);

		$this->txtTransferBox_Create();
		$this->btnTransferSamples_Create();
		$this->btnReleaseSamples_Create();
		$this->txtFreezerPullId_Create();

		if ($this->objSampleSelection->SamplesTransferred) {
			$this->txtTransferBox->Visible = $this->btnTransferSamples->Visible = $this->txtFreezerPullId->Visible = false;
		}
	}

	protected function txtTransferBox_Create() {
		$this->txtTransferBox = new QIntegerTextBox($this);
		$this->txtTransferBox->Name = "Box ID samples were transferred to: ";
		$this->txtTransferBox->Required = true;
	}

	protected function btnTransferSamples_Create() {
		$this->btnTransferSamples = new QButton($this);
		$this->btnTransferSamples->Text = "Move samples and log sample transfer";
		$this->btnTransferSamples->PrimaryButton = true;
		$this->btnTransferSamples->CausesValidation = true;
		$this->btnTransferSamples->AddAction(new QClickEvent(), new QServerAction('transferSamples'));
	}
	protected function btnReleaseSamples_Create() {
		$this->btnReleaseSamples = new QButton($this);
		$this->btnReleaseSamples->Text = "Release samples in existing boxes";
		$this->btnReleaseSamples->PrimaryButton = true;
		$this->btnReleaseSamples->CausesValidation = true;
		$this->btnReleaseSamples->AddAction(new QClickEvent(), new QServerAction('releaseSamples'));
	}
	protected function releaseSamples() {
		$this->txtTransferBox->Text = 0;
		if ($this->boxArray) foreach($this->boxArray as $boxId=>$val) {
			$objBoxHistoryLog = new BoxHistoryLog();
			$objBoxHistoryLog->BoxId = $boxId;
			$objBoxHistoryLog->ReleaseDate = QDateTime::Now(true);
			$objBoxHistoryLog->FreezerPullId = $this->txtFreezerPullId->Text;
			$objBoxHistoryLog->Save();
			// update box information
			$objBox = Box::QuerySingle(QQ::Equal(QQN::Box()->Id, $boxId));
			if ($objBox) {
				$objBox->Freezer = '-2';
				$objBox->Shelf = NULL;
				$objBox->RackId = NULL;
				$objBox->Save();
			}
		}
	}

	protected function txtFreezerPullId_Create() {
		$this->txtFreezerPullId = new QIntegerTextBox($this);
		$this->txtFreezerPullId->Name = "ID of freezer pull: ";
		$this->txtFreezerPullId->Required = true;
	}

	protected function transferSamples() {
		// we need to take each selected sample and save it to the sample history log
		// then set the sample location in the new box (just numerical in no particular order since we will probably not receive it in order)
		$slotCount=1;

		// or if the box already has slots filled then we start at the next available slot
		$objSample = Sample::QuerySingle(
			QQ::Equal(QQN::Sample()->BoxId, $this->txtTransferBox->Text),
			QQ::Clause(QQ::OrderBy(QQN::Sample()->BoxSampleSlot, false)),
			array(),
			array('box_sample_slot')
		);

		// if was have samples already in the box then we will start with the next available open slot
		if ($objSample->BoxSampleSlot)
			$slotCount+=$objSample->BoxSampleSlot;

		foreach ($this->freezerPullArray as $key=>$value){
			// save sample to sample history log
			$objSampleHistoryLog = new SampleHistoryLog();
			$objSampleHistoryLog->SampleId=$value;
			$objSampleHistoryLog->ReleaseDate=QDateTime::Now(false);
			$objSampleHistoryLog->FreezerPullId=$this->txtFreezerPullId->Text;
			$objSampleHistoryLog->Save();


			// change the box for each sample
			$objSample = Sample::Load($value);
			$objSample->BoxId = $this->txtTransferBox->Text;
			$objSample->BoxSampleSlot = $slotCount;
			$objSample->Save();

			// 			$objSampleBoxLocation = SampleBoxLocation::LoadBySampleId($value);
			// 			$objSampleBoxLocation->BoxId = $this->txtTransferBox->Text;
			// 			$objSampleBoxLocation->BoxSampleSlot = $slotCount;
			// 			$objSampleBoxLocation->Save();
			$slotCount++;
		}

		// lock the sample selection unless we decide to explicitly unlock it
		$this->objSampleSelection->SamplesTransferred = true;
		$this->objSampleSelection->Save();
		QSessionDB::set('__SAMPLE_SELECTION_SEARCH__', serialize($this->objSampleSelection));

		QApplication::Redirect("sample-pull.php");
		exit;
	}

	public function dtgSample_Box_Render(Sample $objSample) {
		if (!is_null($objSample->Box))
			return sprintf('<a href="box-sample-pull.php?intId=%s">%s</a> (%s/shelf %s/rack %s)<br/>%s', $objSample->Box->Id, $objSample->Box->Name, $this->objFreezerArray[$objSample->Box->Freezer], $objSample->Box->Shelf, $objSample->Box->Rack,$objSample->Box->Description);
		//return $objSample->Box->__toStringLongDecript();
		else
			return null;
	}

	protected function btnRemoveSamples_Create() {
		$this->btnRemoveSamples = new QButton($this);
		$this->btnRemoveSamples->Text = QApplication::Translate('End this sample selection session');
		//$this->btnRemoveSamples->AddAction(new QClickEvent(), new QConfirmAction('Are you SURE you want to end this?'));
		$this->btnRemoveSamples->AddAction(new QClickEvent(), new QServerAction('removeSamples'));
		$this->btnRemoveSamples->PrimaryButton = true;
	}

	protected function boxView() {
		$this->strBoxes->Text = '';
		// for a list of samples we will just query on the entire list of samples and order by box_id and slot number (this will give us all the sample and box information we need)
		//$testSampleIDArray = array(85506,85503,85518,85512,85522,85513);
		$testSampleIDArray = array_values($this->freezerPullArray);	// we need to only get the array values array for the query to function correctly
		$this->objSampleArray = Sample::QueryArray(QQ::In(QQN::Sample()->Id, $testSampleIDArray), QQ::Clause(QQ::OrderBy(QQN::Sample()->BoxId,QQN::Sample()->BoxSampleSlot)));
		$boxId = $boxRowCount = $boxColumnCount = $sampleSlot = $strSampleToPull = '';
		$intBoxCount=0;
		if ($this->objSampleArray) foreach ($this->objSampleArray as $objSample) {
			//if ($strSampleToPull != "") $strSampleToPull .= "<br/>";
			//$strSampleToPull .= "<b>".$objSample->StudyCase."</b> (<i>".$objSample->Barcode."</i>) - <b>".$objSample->Box->Name."</b> (<i>".$objSample->BoxSampleSlot."</i>)";
			// we are starting with our first sample or a new box
			// else we are staying with the box we have already started
			if ($boxId != $objSample->BoxId){
				if ($boxId != "") {
					$intBoxCount++;
					// need to close the box
					$this->boxBuild($sampleSlot+1,null,$boxColumnCount,($boxColumnCount*$boxRowCount));
					$this->strBoxes->Text .= '</div></div>';
				}

				// start the box
				$this->strBoxes->Text .= '<div class="boxWrapper"><div>Freezer: <b>'.$this->objFreezerArray[$objSample->Box->Freezer].'</b></div>';
				$this->strBoxes->Text .= '<div>Shelf: <b>'.$objSample->Box->Shelf.'</b></div>';
				$this->strBoxes->Text .= '<div>Rack: <b>'.$objSample->Box->Rack.'</b></div>';
				$this->strBoxes->Text .= '<div>Box: <b><a href="box-sample-pull.php?intId='.$objSample->Box->Id.'">'.$objSample->Box->Name.'</a></b></div>';	// link to the box view so we can select samples to pull and move to a new box; <span class="sm">('.QString::Truncate($objSample->Box->Description,50).')</span>
				$this->strBoxes->Text .= '<div class="box">
						';
				$this->boxBuild(1,$objSample->BoxSampleSlot,$objSample->Box->BoxType->Columns,$objSample->BoxSampleSlot);

			}
			else {
				// continue with the box
				$this->boxBuild($sampleSlot+1,$objSample->BoxSampleSlot,$objSample->Box->BoxType->Columns,$objSample->BoxSampleSlot);
			}

			// save the selected box, sample slot location, and box size
			$boxId = $objSample->BoxId;
			if ($objSample->Box->BoxType->Columns)
				$boxColumnCount = $objSample->Box->BoxType->Columns;
			if ($objSample->Box->BoxType->Rows)
				$boxRowCount = $objSample->Box->BoxType->Rows;
			if ($objSample->BoxSampleSlot)
				$sampleSlot = $objSample->BoxSampleSlot;
		}

		if ($boxId != "") {
			$intBoxCount++;
			// need to close the box
			$this->boxBuild($sampleSlot+1,null,$boxColumnCount,($boxColumnCount*$boxRowCount));
			$this->strBoxes->Text .= '</div></div><br class="clr"><div><b>'.$intBoxCount.'</b> boxes of samples to pull from</div>';	//case ID (<i>barcode</i>) - box (<i>sample slot</i>)</div><hr/>'.$strSampleToPull.'
		}
	}

	public function dtgSample_IdColumn_Render(Sample $objSample) {
		// show checkboxes as long as we have not transferred samples
		if (!$this->objSampleSelection->SamplesTransferred) {
			// we will use explicitly defined control ids.
			$strControlId = 'chkSamplePull' . $objSample->Id;

			// Let's see if the checkbox exists already
			$chkSamplePull = $this->GetControl($strControlId);

			if (!$chkSamplePull) {
				$chkSamplePull = new QCheckBox($this->dtgSample, $strControlId);
				$chkSamplePull->ToolTip = "Select to add the sample to a freezer pull";
				$chkSamplePull->Text = "<a href='sample.php?intId=".$objSample->Id."&return=sample-pull'>".$objSample->Id."</a>";
				$chkSamplePull->ActionParameter = $objSample->Id;
				$chkSamplePull->HtmlEntities = false;
				// Let's assign a server action on click
				$chkSamplePull->AddAction(new QClickEvent(), new QConfirmAction('Are you SURE you want to DELETE the selected sample from the pull list?'));
				$chkSamplePull->AddAction(new QChangeEvent(), new QServerAction('chkSamplePull_Change'));
			}

			if (is_array($this->freezerPullArray)) {
				if (in_array($objSample->Id, $this->freezerPullArray)) {
					$chkSamplePull->Checked = true;
				}
			}

			// if the selected item is in the freezer pull list then highlight the cell
			//$this->colId->CssClass = 'sRed';

			// disable the checkbox if the sample selection is locked (Jan. 29, 2016 - wpg)
			if ($this->objSampleSelection->Lock==1) {
				$chkSamplePull->Enabled = false;
			}

			// Render the checkbox.  We want to *return* the contents of the rendered Checkbox,
			// not display it.  (The datagrid is responsible for the rendering of this column).
			// Therefore, we must specify "false" for the optional blnDisplayOutput parameter.
			return $chkSamplePull->Render(false);
		}
		else
			return $objSample->Id;
	}

	protected function chkSamplePull_Change($strFormId, $strControlId, $strParameter) {
		$chkSamplePull = $this->GetControl($strControlId);
		$this->freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__') ?? '');
		if (!is_array($this->freezerPullArray)) $this->freezerPullArray = array();

		if ($chkSamplePull->Checked) {
			$this->freezerPullArray[$strParameter] = $strParameter;
			QSessionDB::set('__FREEZER_PULL_LIST__',serialize($this->freezerPullArray));
			//QApplication::DisplayAlert($strParameter." checked");
		}
		else {
			unset($this->freezerPullArray[$strParameter]);
			QSessionDB::set('__FREEZER_PULL_LIST__',serialize($this->freezerPullArray));
			//QApplication::DisplayAlert($strParameter." unchecked");
		}
		$this->boxView();

		$this->dtgSample_Bind();
		// show or hide the sample pull report link depending on if we have any selections
		// 		$th = unserialize(QSessionDB::get('__MAIN_APP_THIS__') ?? '');
		// 		QApplication::ExecuteJavaScript(sprintf('$.get("sample-pull.php?option=c", function(data) { if(data==1) $("#dmI").show("slow");else $("#dmI").hide("fast")});', $th));
	}

	// handles building the box view
	protected function boxBuild($startSlot,$highlightSlot,$columnCount,$stopSlot){
		$count=$startSlot;
		for($a=$startSlot;$a<=$stopSlot;$a++) {
			$stp = '';
			if ($highlightSlot == $a) $stp = 'stp';

			$this->strBoxes->Text .= '<img src="'.__IMAGE_ASSETS__.'/blank.gif" class="slot '.$stp.'"/>';

			// we have reached the end of the column
			if (($count % $columnCount) == 0 )
				$this->strBoxes->Text .= '<br/>
						';
			$count++;
		}
	}

	protected function removeSamples() {
		QSessionDB::set('error', 'No samples to pull.  Find samples to add to another freezer pull.');
		QSessionDB::set('__FREEZER_PULL_LIST__',serialize(array()));

		// lock the sample selection unless we decide to explicitly unlock it
		$this->objSampleSelection->Lock = true;
		$this->objSampleSelection->Save();

		QSessionDB::Delete('__SAMPLE_SELECTION_SEARCH__');
		QApplication::Redirect("find_samples.php");
		exit;
	}

	protected function dtgSample_Bind() {
		// get the latest list of samples to pull
		$this->freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__') ?? '');

		$samples = array_values($this->freezerPullArray);
		if (count($this->freezerPullArray) > 0)
			$strAndCondition = "QQ::AndCondition(QQ::In(QQN::Sample()->Id, \$samples))";
		else {
			//$this->removeSamples();	// was prematurely ending the sample pull if no samples were being searched on (June 5, 2018 - wpg)
			$strAndCondition .= "QQ::None()";
		}

		//$this->objSampleArray;	//
		// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below

		$this->dtgSample->TotalItemCount = count($this->objSampleArray);	//Sample::QueryCount(eval("return $strAndCondition;"));

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
		foreach ($this->dtgSample->DataSource as $objSample) {
			$this->boxArray[$objSample->BoxId] = $objSample->BoxId;
		}
	}
}


class SamplePullList extends QForm {


}
// we want to check to see if there are any selected samples to pull
if (QApplication::QueryString('option') == 'c')
	SamplePullList::Run('SamplePullList', 'template/WSDL-sample-pull-list.tpl.php');
else {
	// go to the centralized form executing access control function to run the form and check access control
	ACL_Run('sample-pull');
}
?>