<?php
/**
 * @author w. Patrick Gale (April 2012)
 * @abstract Biological sample box form
 *
 *Logic:
 * This is a view of the sample layout in each box.  When entering samples in the form, there is a forced delay/wait before you are able to enter a second sample; this was added to prevent a barcode scanner (which will send multiple signals depending on the scanner) from entering the same sample across multiple cells.  Also there are parsing functions for samples that check for duplicates in the same box and add additional information for each sample just based on the sample barcode/ID entered into the cell.  The barcode/label entered for the sample each box must be unique as well to prevent duplicate samples being entered in different boxes (an alert will appear if an entered sample barcode exists. 
*/

// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');
require(__FORMBASE_CLASSES__ . '/BoxEditFormBase.class.php');
require(__FORMBASE_CLASSES__ . '/SampleListFormBase.class.php');
QApplication::CheckRemoteAdmin();

/**
 * Second verions of box sample management using separate tables to handle how the boxes store
 * samples.  This should allow for easier queries to determine if a sample is logged but not in
 * one of OUR boxes (may be in use off site by another researcher, etc.).
 * @author pgale
 *
 * - changing the study type dropdown (single study) to a label in case there are multiple study samples in one box (Oct. 19, 2015 - wpg)
 *
*/
class BoxEditForm8 extends BoxEditFormBase {
	protected $objDefaultWaitIcon, $objFreezerArray, $rowCount, $columnCount, $slotCount, $lstStudy, $txtSamples, $btnAdd, $blnImport, $studyTypeArray;

	// define box slots (add more here if more are needed)
	protected $txtS1;
	protected $txtS2;
	protected $txtS3;
	protected $txtS4;
	protected $txtS5;
	protected $txtS6;
	protected $txtS7;
	protected $txtS8;
	protected $txtS9;
	protected $txtS10;
	protected $txtS11;
	protected $txtS12;
	protected $txtS13;
	protected $txtS14;
	protected $txtS15;
	protected $txtS16;
	protected $txtS17;
	protected $txtS18;
	protected $txtS19;
	protected $txtS20;
	protected $txtS21;
	protected $txtS22;
	protected $txtS23;
	protected $txtS24;
	protected $txtS25;
	protected $txtS26;
	protected $txtS27;
	protected $txtS28;
	protected $txtS29;
	protected $txtS30;
	protected $txtS31;
	protected $txtS32;
	protected $txtS33;
	protected $txtS34;
	protected $txtS35;
	protected $txtS36;
	protected $txtS37;
	protected $txtS38;
	protected $txtS39;
	protected $txtS40;
	protected $txtS41;
	protected $txtS42;
	protected $txtS43;
	protected $txtS44;
	protected $txtS45;
	protected $txtS46;
	protected $txtS47;
	protected $txtS48;
	protected $txtS49;
	protected $txtS50;
	protected $txtS51;
	protected $txtS52;
	protected $txtS53;
	protected $txtS54;
	protected $txtS55;
	protected $txtS56;
	protected $txtS57;
	protected $txtS58;
	protected $txtS59;
	protected $txtS60;
	protected $txtS61;
	protected $txtS62;
	protected $txtS63;
	protected $txtS64;
	protected $txtS65;
	protected $txtS66;
	protected $txtS67;
	protected $txtS68;
	protected $txtS69;
	protected $txtS70;
	protected $txtS71;
	protected $txtS72;
	protected $txtS73;
	protected $txtS74;
	protected $txtS75;
	protected $txtS76;
	protected $txtS77;
	protected $txtS78;
	protected $txtS79;
	protected $txtS80;
	protected $txtS81;
	protected $txtS82;
	protected $txtS83;
	protected $txtS84;
	protected $txtS85;
	protected $txtS86;
	protected $txtS87;
	protected $txtS88;
	protected $txtS89;
	protected $txtS90;
	protected $txtS91;
	protected $txtS92;
	protected $txtS93;
	protected $txtS94;
	protected $txtS95;
	protected $txtS96;
	protected $txtS97;
	protected $txtS98;
	protected $txtS99;
	protected $txtS100;
	protected $btnDeleteSamples;

	protected function SetupBox() {
		$this->blnImport = false;
		// Lookup Object PK information from Query String (if applicable)
		// Set mode to Edit or New depending on what's found
		$intId = QApplication::QueryString('intId');
		if (($intId)) {
			$this->objBox = Box::QuerySingle(
					QQ::AndCondition(
							QQ::Equal(QQN::Box()->Id, $intId)
					));

			if (!$this->objBox) {
				QSessionDB::set("error", "Could not retrieve box.");
				QApplication::Redirect('boxes.php');
			}

			// we need to find out how many row and columns are in the box since we need this to begin to build the template
			if ($this->objBox->BoxType) {
				$this->rowCount = $this->objBox->BoxType->Rows;
				$this->columnCount = $this->objBox->BoxType->Columns;
				$this->slotCount = $this->rowCount*$this->columnCount;
				if ($this->slotCount < 1) {
					QSessionDB::set("error", "The box needs to have a box count before proceeding.");
					QApplication::Redirect('box.php?intId='.$intId);
				}

			}
			else {
				QSessionDB::set("error", "Set the box type for the box.");
				QApplication::Redirect('box.php?intId='.$intId);
			}
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			QSessionDB::set("error", "Could not retrieve box.");
			QApplication::Redirect('boxes.php');
		}
		$this->btnDeleteSamples_Create();
	}

	protected function btnDeleteSamples_Create() {
		$this->btnDeleteSamples = new QButton($this);
		$this->btnDeleteSamples->Text = QApplication::Translate('Delete samples from the box');
		$this->btnDeleteSamples->AddAction(new QClickEvent(), new QConfirmAction('Are you SURE you want to DELETE these samples?'));
		$this->btnDeleteSamples->AddAction(new QClickEvent(), new QServerAction('btnDeleteSamples_Click'));
	}

	// remove the samples from inventory
	protected function btnDeleteSamples_Click($strFormId, $strControlId, $strParameter) {
		if ($this->objBox) {
			$objSampleArray = Sample::LoadArrayByBoxId($this->objBox->Id);
			// for all of the samples in the box, delete them
			if ($objSampleArray) foreach($objSampleArray as $objSample) {
				ActionLog::LogSampleAction(6,$objSample);	// track the sample delete
				$objSample->Delete();
			}
		}

		QSessionDB::set("error", "Samples deleted from the box");
		// refresh the box
		QApplication::Redirect(Box::$viewScript.'?intId='.$this->objBox->Id);
	}


	protected function ValidateControlAndChildren(QControl $objControl) {
		// Initially Assume Validation is True
		$blnToReturn = true;
		// Check the Control to see if it passes validation
		if (!$objControl->Validate()) {
			QSessionDB::set("_page_ValidateControlID", $objControl->ControlId);
			QApplication::Redirect('#'.$objControl->ControlId);
		}
		return $blnToReturn;
	}

	protected function Form_Exit() {
		parent::Form_Exit();
		$strControlId = QSessionDB::get("_page_ValidateControlID");
		if ($strControlId != '') {
			$objControl = $this->GetControl($strControlId);
			$strNeedValidation = $objControl->Name;
			//            	QApplication::ExecuteJavaScript(sprintf('$("#dialog" ).html("'.$strNeedValidation.'");', $this));
			//           		QApplication::ExecuteJavaScript(sprintf('$("#dialog" ).dialog({ title: "The following question needs an answer", modal: false });', $this));
			// wpg - had to remove the dialog javascript because it was causing problems in the iPad (javascript alerts work fine)
			QApplication::DisplayAlert($strNeedValidation." (is required)");
			QSessionDB::Delete("_page_ValidateControlID");
		}
	}

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

		parent::Form_Create();

		$this->txtSlot_Create();
		$this->lstStudy_Create();	// this needs to come after we build the sample slots since we need to know the samples we are pulling from

		$this->changeOptionAction();
		$this->ST_SL();
		//$this->slotFull();
		$this->objDefaultWaitIcon = new QWaitIcon($this);
		$this->objDefaultWaitIcon->CssClass = 'waitIcon';

		$this->txtSamples_Create();


		$this->btnAdd_Create();

		if ($this->objBox->Id != "")
			$this->validateCheck();
		else
			$this->requiredCheck();
	}

	// @BL run through the controls and if they require and pass validation then show them as having proper validation or not
	protected function validateCheck() {
		$this->requiredCheck();
		foreach ($this->GetAllControls() as $objControl) {
			// if the control is required
			if ($objControl->Required)
				if ($objControl->Validate()) {
				$this->completedControl(1,$objControl);
			}
			else {
				$this->completedControl(0,$objControl);
			}
		}
	}

	protected function completedControl($flag=1,$objControl) {
		if ($flag) {
			$objControl->Opacity = 100;
			$this->cssAddRemove($objControl, 'reqG', 'a');
		}
		else {
			$objControl->Opacity = 100;
			$this->cssAddRemove($objControl, 'reqG', 'r');
		}
	}

	//@BL add a CSS class definition if it does not exist
	/**
	* $objCss css assigned to an object
	* $ck css class name to check
	* $type 'r' to remove and 'a' to add a css class
	*
	*/
	protected function cssAddRemove($objControl, $ck, $type) {
		$newCss = $objControl->CssClass;

		// if adding a css class check to see if it exists
		if ($type == 'a' && strstr($objControl->CssClass, $ck) == ''){
			$newCss = $objControl->CssClass." ".$ck;
		}

		// if adding a css class check to see if it exists
		if ($type == 'r' && strstr($objControl->CssClass, $ck) != ''){
			$newCss = str_replace($ck, '', $objControl->CssClass);
		}
		$objControl->CssClass = $newCss;
	}

	protected function requiredCheck() {
		$this->lstSampleType->Required=true;
		//$this->lstStudy->Required=true;
	}

	protected function changeOptionAction() {
		$this->lstSampleType->AddAction(new QChangeEvent(), new QAjaxAction('ST_SL'));
		$this->lstStudy->AddAction(new QChangeEvent(), new QAjaxAction('ST_SL'));

		//@BL adding events for when the barcode is scanned within a field in the box; adding a 2 second delay to each action so that the clinic barcode scanner will not re-enter the same barcode or part of it in another field
		for($i=1;$i<$this->slotCount;$i++) {
			$obj = '$this->txtS'.$i.'->AddAction(new QEnterKeyEvent(2000), new QAjaxAction("enterKeyPress"));';
			eval("return $obj;");
		}

		//@BL terminate submission of form
		for($i=1;$i<=$this->slotCount;$i++) {
			$obj = '$this->txtS'.$i.'->AddAction(new QEnterKeyEvent(), new QTerminateAction());';
			eval("return $obj;");
		}

		$this->txtS1->AddAction(new QChangeEvent(), new QServerAction('ST_SL'));
		//@BL adding change events
		for($i=2;$i<=$this->slotCount;$i++) {
			$obj = '$this->txtS'.$i.'->AddAction(new QChangeEvent(), new QAjaxAction("ST_SL"));';	// IMPORTANT***
			eval("return $obj;");
		}

		$this->chkComplete->AddAction(new QChangeEvent(), new QAjaxAction('saveChanges'));
	}

	//@BL will check to see when a barcode is scanned since the scanner issues an 'Enter' command within a textbox
	public function enterKeyPress($strFormId, $strControlId, $strParameter) {
		//QApplication::DisplayAlert('enterKeyPress');
		//@BL we will check when someone presses the enter key on one of the sample fields
		if ($this->GetControl($strControlId) instanceof QTextBox ) {
			// skip to the next slot if one exists
			if ($this->GetControl('c'.(substr($strControlId,1)+1)) instanceof QTextBox)
				QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', 'c'.(substr($strControlId,1)+1)));
		}
	}

	protected function changeOptionSave($strFormId, $strControlId, $strParameter='') {
		//QApplication::DisplayAlert('changeOptionSave');
		$this->completedControl(1,$this->GetControl($strControlId));
		// we will save individual sample slots this way
		if ($this->GetControl($strControlId) instanceof QTextBox ) {
			// get the text field object
			$obj = $this->GetControl($strControlId);
			//QApplication::DisplayAlert($obj->Name.$strControlId.$obj->Text);
			// check to see if the box has the selected location logged already
			$objExistingSample = Sample::QuerySingle(
					QQ::AndCondition(
							QQ::Equal(QQN::Sample()->BoxId, $this->objBox->Id),
							QQ::Equal(QQN::Sample()->BoxSampleSlot, $obj->Columns)
					)
			);

			// if we want to delete a sample location then the text barcode field needs to be blank
			if (trim($obj->Text) == ''){
				// remove sample location
				if ($objExistingSample) {
					$objExistingSample->BoxId = NULL;
					$objExistingSample->BoxSampleSlot = NULL;
					$objExistingSample->Save();
				}
				QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', $strControlId));
				$this->slotFull($obj);
				return;
			}
			// check to see if a sample exists for the entered barcode in this box
			$objSampleExisting = Sample::QuerySingle(
					QQ::AndCondition(
							QQ::Equal(QQN::Sample()->Barcode, $obj->Text),
							QQ::Equal(QQN::Sample()->BoxId, $this->objBox->Id),
							QQ::Equal(QQN::Sample()->SampleTypeId, $this->lstSampleType->SelectedValue)
					)
			);

			// log a simple alert if we have scanned the barcode once already for this box
			if ($objSampleExisting) {
				QApplication::DisplayAlert('Note: Barcode already exists in this box.');
			}
			$objSampleExisting=NULL;

			//QQ::Equal(QQN::Sample()->StudyTypeId, $this->lstStudy->SelectedValue),
			// if sample is not logged, then create a new entry
			//if (!$objSample) {
				$objSample = new Sample();
				// save meta data with the sample
				$objSample->Barcode = $obj->Text;
				//$objSample->StudyTypeId = $this->lstStudy->SelectedValue;
				$objSample->SampleTypeId = $this->lstSampleType->SelectedValue;
				// if we are able to parse the box name then save the sample
				if (strstr($this->objBox->Name,'J3-')) {
					if ($objSample->parseT3Barcode($this->lstSampleType->SelectedValue))
						$objSample->Save();
					else {
						QApplication::DisplayAlert('Incorrect barcode scanned. Please try again.');
						$obj->Text = NULL;
						QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', $strControlId));
						$this->slotFull($obj);
						return;
					}
				}
				// if we are able to parse the box name (from Interleukin Genetics DNA samples) then save the sample
				elseif (strstr($this->objBox->Name,'IG-')) {
					if ($objSample->parseIG_Barcode($this->lstSampleType->SelectedValue))
						$objSample->Save();
					else {
						QApplication::DisplayAlert('Incorrect barcode scanned. Please try again.');
						$obj->Text = NULL;
						QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', $strControlId));
						$this->slotFull($obj);
						return;
					}
				}
				else
					$objSample->Save();
			//}

			// stop update of the sample box if the sample type does not match
			// if we are able to parse the barcode then save the sample
			if (strstr($this->objBox->Name,'J3-')) {
				if (!$objSample->parseT3Barcode($this->lstSampleType->SelectedValue)) {
					QApplication::DisplayAlert('The entered sample type does not match the sample box. Please try again.');
					$obj->Text = NULL;
					QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', $strControlId));
					$this->slotFull($obj);
					return;
				}
			}
			// if we are able to parse the box name (from Interleukin Genetics DNA samples) then save the sample
			elseif (strstr($this->objBox->Name,'IG-')) {
				if (!$objSample->parseIG_Barcode($this->lstSampleType->SelectedValue)) {
					QApplication::DisplayAlert('The entered sample type does not match the sample box. Please try again.');
					$obj->Text = NULL;
					QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', $strControlId));
					$this->slotFull($obj);
					return;
				}
			}

			// if a sample already exists in this location then see if it is the current one
			// else we are using the one we created or have
			if ($objExistingSample) {
				// if the barcode in the box is different from the selected one then notify that we are replacing a sample that is logged in this location and we are creating an orphan sample

				// if the existing sample is different than the one we created or found then
				if ($objExistingSample->Id != $objSample->Id) {
					$objSample->BoxId = $this->objBox->Id;
					$objSample->BoxSampleSlot = $obj->Columns;	// using the Columns property of the sample (field) to save the slot location
					$objSample->Save();

					// remove the existing one from the location and create an orphan sample (leave the box ID intact so we know what box the sample came from)
					$objExistingSample->BoxSampleSlot = NULL;
					$objExistingSample->Save();
					QApplication::DisplayAlert('You have just changed the sample logged in this box location.');
				}
				else {
					QApplication::DisplayAlert('Nothing changed');
				}
			}
			else {
				$objSample->BoxId = $this->objBox->Id;
				$objSample->BoxSampleSlot = $obj->Columns;	// using the Columns property of the sample (field) to save the slot location
				$objSample->Save();
			}

			$this->slotFull($obj);
		}

		// we are already saving changes with the import
		if (!$this->blnImport)
			$this->saveChanges();

		// skip to the next slot if one exists
		if ($this->GetControl('c'.(substr($strControlId,1)+1)) instanceof QTextBox)
			QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', 'c'.(substr($strControlId,1)+1)));
	}

	//@BL updates the form object, saves it
	protected function saveChanges() {
		$this->UpdateBoxFields();
		$this->objBox->Save();

		// wpg - old import solution that did not handle saving study case (loop through the samples if we have flagged an import)
		// 			if ($this->blnImport)
		// 				for($i=1;$i<=$this->slotCount;$i++) {
		// 					// get slot component
		// 					$obj = '$this->txtS'.$i.'->ControlId';
		// 					$objText = '$this->txtS'.$i.'->Text';
		// 					$strText = eval("return $objText;");
		// 					$strControlId = eval("return $obj;");
		// 					if ($strText != '') {
		// 						$this->changeOptionSave('', $strControlId, '');
		// 					}
		// 				}


		// loop through the samples if we have flagged to import and save them
		if ($this->blnImport && $this->txtSamples->Text != '') {
			// parse the samples list
			$delimiter = "\r\n";	// wpg - changed from \n but this should be correct
			$dataLines = explode($delimiter, $this->txtSamples->Text);
			foreach ( $dataLines as $dataLine ) {
				$part = explode("\t", $dataLine);
				$objSample = new Sample();
				// save meta data with the sample
				$objSample->Barcode = $part[1];
				//$objSample->StudyTypeId = $this->lstStudy->SelectedValue;
				$objSample->SampleTypeId = $this->lstSampleType->SelectedValue;
				$objSample->BoxId = $this->objBox->Id;
				$objSample->BoxSampleSlot = intval($part[2]);	// wpg - for some reason this would ONLY work if I converted the value to an int before trying to save, even though the core code tried to convert it to an int and kept failing (I kept getting errors that the value could not be converted to an int)
				$objSample->StudyCase = $part[0];
				$objSample->Save();
			}
			$this->txtSamples->Text = NULL;
			QSessionDB::set("error", "The samples were imported into the box.");
			QApplication::Redirect('boxes.php');
		}

		$this->blnImport = false;	// reset the import to false
	}


	protected function UpdateBoxFields() {
		$this->objBox->SampleTypeId = $this->lstSampleType->SelectedValue;
		$this->objBox->Complete = $this->chkComplete->Checked;
	}

	protected function btnSave_Create() {
		$this->btnSave = new QButton($this);
		$this->btnSave->Text = 'Save';
		$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
		$this->btnSave->PrimaryButton = true;
		$this->btnSave->CausesValidation = true;
	}

	protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->saveChanges();
		//$this->RedirectToListPage();
	}

	protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->saveChanges();	//@BL still need to save changes on cancel in case one of the mouse or key events did not fire off when the user was filling out the form
		$this->RedirectToListPage();
	}

	protected function RedirectToListPage() {
		if ($this->objBox->Id)
			QApplication::Redirect(Box::$nextScript.'?intBoxId='.$this->objBox->Id);
		else
			QApplication::Redirect(Box::$nextScript);
	}

	/**
	 * wpg - dynamically create the number of slots we need for our box depending on the box slot count
	 *
	 */
	protected function txtSlot_Create() {
		for($i=1;$i<=$this->slotCount;$i++) {
			$obj = '$this->txtS'.$i.' = new QTextBox($this);';
			eval("return $obj;");
			$obj = '$this->txtS'.$i.'->Name = QApplication::Translate("slot '.$i.'");';
			eval("return $obj;");
			$obj = '$this->txtS'.$i.'->Columns = '.$i.';';
			eval("return $obj;");
			$obj = '$this->txtS'.$i.'->MaxLength = 16;';
			eval("return $obj;");
			$obj = '$this->txtS'.$i.'->Width = "90px"';
			eval("return $obj;");
		}
		// now that we have built the controls we fill them in
		$objSampleArray = Sample::QueryArray(
				QQ::Equal(QQN::Sample()->BoxId, $this->objBox->Id),null,null,array('id','barcode','box_sample_slot','study_case','sample_type_id','study_type_id')
		);
		if ($objSampleArray) foreach ($objSampleArray as $objSample) {
			if ($objSample->BoxSampleSlot) {
				QApplication::ExecuteJavaScript(sprintf('$("#sampleImport").hide("slow");', $this));

				//add css style if we know the sample type
				if (array_key_exists($objSample->SampleTypeId, SampleTypes::$sampleColor)) {
					$obj = '$this->txtS'.$objSample->BoxSampleSlot.'->CssClass = "'.SampleTypes::$sampleColor[$objSample->SampleTypeId][2].' fs10"';
					eval("return $obj;");
				}

				$obj = '$this->txtS'.$objSample->BoxSampleSlot.'->Text = $objSample->Barcode;';
				eval("return $obj;");
				$txtSlot2 = '$this->txtS'.$objSample->BoxSampleSlot.'->HtmlAfter = "<div class=\'sm cGray\' title=\'Subject ID\'><a href=\'sample.php?intId='.$objSample->Id.'\'>Subject: '.$objSample->StudyCase.'</a></div>"';
				eval("return $txtSlot2;");

				// if we have a sample then we need to set the sample type selection
				if ($this->lstSampleType->SelectedValue == ''){
					$this->lstSampleType->SelectedValue = $objSample->SampleTypeId;
				}

				// wpg - create an array of study types here
				$this->studyTypeArray[$objSample->StudyTypeId] = $objSample->StudyTypeId;
				// 				if ($this->lstStudy->SelectedValue == ''){
				// 					$this->lstStudy->SelectedValue = $objSample->StudyTypeId;
				// 				}

			}
		}
	}

	// build box name link and other meta data
	protected function txtName_Create() {
		$this->txtName = new QLabel($this);
		$this->txtName->Text = $this->objBox->Name." <a href='box.php?intId=".$this->objBox->Id."' class='sm' title='edit the box location, sample type, etc.'>Edit box meta data</a>";
		$this->txtName->CssClass = 'bld';
		$this->txtName->HtmlEntities = false;
		if ($this->objBox && isset($this->objBox->BoxType))
			$this->txtName->HtmlBefore = '<b>Box</b> <span class="sm">['.$this->objBox->BoxType->__toString().']</span>:<br/><div style="border:1px solid #000;padding:3px;width:200px;text-align:center;">';
		$this->txtName->HtmlAfter = '</div>';
		if ($this->objBox->BoxType)
			$this->txtName->HtmlAfter .= '<span class="sm">Description: <i>'.$this->objBox->Description.'</i></span>';
	}

	protected function lstStudy_Create() {
		$this->lstStudy = new QLabel($this);
		$this->lstStudy->CssClass = '';
		$this->lstStudy->Name = QApplication::Translate('Studies found in this box: ');
		$this->lstStudy->HtmlBefore = $this->lstStudy->Name;
		if ($this->studyTypeArray)
			foreach ($this->studyTypeArray as $key => $val) {
			if ($this->lstStudy->Text != '') $this->lstStudy->Text .= ", ";
			if ($key) {
				$this->lstStudy->Text .= FmStudy::GetName($key);
			}
			else
				$this->lstStudy->Text .= '**study not assigned to some samples**';
		}
		else $this->lstStudy->Text = "---";
	}

	protected function lstSampleType_Create() {
		$this->lstSampleType = new QListBox($this);
		$this->lstSampleType->Name = QApplication::Translate('Sample Type: ');
		$this->lstSampleType->HtmlBefore = $this->lstSampleType->Name;

		$this->lstSampleType->AddItem(QApplication::Translate('- Select a sample type -'), null);
		$objSampleTypeArray = SampleTypes::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::SampleTypes()->Letter)));
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			if (($this->objBox->SampleType) && ($this->objBox->SampleType->Id == $objSampleType->Id))
				$objListItem->Selected = true;
			$this->lstSampleType->AddItem($objListItem);
		}
	}

	protected function chkComplete_Create() {
		$this->chkComplete = new QCheckBox($this);
		$this->chkComplete->Name = QApplication::Translate('Check if box inventory has been verified: ');
		$this->chkComplete->CssClass = 'bld';
		$this->chkComplete->Checked = $this->objBox->Complete;
	}

	// ------------ skip logic
	//@BL sample type change
	protected function ST_SL($strFormId='', $strControlId='', $strParameter=''){
		//QApplication::DisplayAlert('ST_SL');
		//if ($this->lstSampleType->SelectedValue!='' && $this->lstStudy->SelectedValue!=''){
		//@BL do not change the sample type if a sample has been added to the box
		//@BL loop through box
		$showImport=true;
		for($i=1;$i<=$this->slotCount;$i++) {
			// see if we have text defined in the slot
			$obj = '$this->txtS'.$i.'->Text';

			// if we do have a sample in the slot then apply styling to the slot
			if (trim(eval("return $obj;")) != '') {
				$showImport=false;
				$this->lstSampleType->Enabled=false;
				$this->lstStudy->Enabled=false;
				//@BL when updating the form if the interview date has not been saved then set it to now
				if ($this->objBox->Created == '')
					$this->objBox->Created = QDateTime::Now(true);
				break;
			}
			else {
				$this->lstSampleType->Enabled=true;
				$this->lstStudy->Enabled=true;
			}
		}
		$this->lstSampleType->CssClass=$this->lstStudy->CssClass='bld fs14';
		QApplication::ExecuteJavaScript(sprintf('$("#ST_SL").show("slow");', $this));
		// we will show the importer if the box is empty
		if ($showImport)
			QApplication::ExecuteJavaScript(sprintf('$("#sampleImport").show("slow");', $this));
		// 			}
		// 			else {
		// 				$this->lstStudy->Enabled=true;
		// 				$this->lstSampleType->Enabled=true;
		// 				QApplication::ExecuteJavaScript(sprintf('$("#ST_SL").hide("slow");', $this));
		// 				QApplication::ExecuteJavaScript(sprintf('$("#sampleImport").hide("slow");', $this));
		// 			}
		if ($strControlId != '')
			$this->changeOptionSave($strFormId, $strControlId, $strParameter);
	}

	//@BL mark if a slot in the box is occupied using the box type colors
	protected function slotFull($obj=NULL) {
		if ($this->lstSampleType->SelectedValue!=''){
			// changing a single slot
			// else we check all
			if ($obj) {
				// if we do have a sample in the slot then apply styling to the slot
				if ($obj->Text != '' && array_key_exists($this->lstSampleType->SelectedValue, SampleTypes::$sampleColor)) {
						$obj->CssClass = SampleTypes::$sampleColor[$this->lstSampleType->SelectedValue][2].' fs10';
				}
				else {
					$obj->CssClass = '';
				}
			}
			else {
				//@BL loop through box
				for($i=1;$i<=$this->slotCount;$i++) {
					// see if we have text defined in the slot
					$obj = '$this->txtS'.$i.'->Text';

					// if we do have a sample in the slot then apply styling to the slot
					if (eval("return $obj;") != '') {
						$obj2 = '$this->txtS'.$i.'->CssClass = "'.SampleTypes::$sampleColor[$this->lstSampleType->SelectedValue][2].' fs10"';
						eval("return $obj2;");
					}
					else {
						$obj2 = '$this->txtS'.$i.'->CssClass = "fs10"';
						eval("return $obj2;");
					}
				}
			}
		}
	}

	// create link to freezer
	protected function txtFreezer_Create() {
		$this->txtFreezer = new QLabel($this);
		$this->txtFreezer->CssClass = 'bld fs18';
		$this->txtFreezer->HtmlEntities = false;
		if ($this->objBox->Freezer)
			$this->txtFreezer->Text = '<a href="freezer-view.php?intFreezer='.$this->objBox->Freezer.'" title="view freezer contents">'.$this->objFreezerArray[$this->objBox->Freezer].'</a>';
		else
			$this->txtFreezer->Text = 'box is not in a Thurston freezer';
	}


	// create link to freezer
	protected function txtShelf_Create() {
		$this->txtShelf = new QLabel($this);
		$this->txtShelf->CssClass = 'bld fs18';
		$this->txtShelf->HtmlEntities = false;
		if ($this->objBox->Shelf)
			$this->txtShelf->Text = '<a href="freezer-view.php?intFreezer='.$this->objBox->Freezer.'" title="view shelf contents">Shelf '.$this->objBox->Shelf.'</a>';
		else
			$this->txtShelf->Text = '<span class="sm cGray">(no shelf)</span>';
	}



	protected function lstRack_Create() {
		$this->lstRack = new QLabel($this);
		$this->lstRack->CssClass = 'bld fs18';
		$this->lstRack->HtmlEntities = false;
		if ($this->objBox->Rack)
			$this->lstRack->Text = '<a href="boxes.php?intRack='.$this->objBox->Rack->Id.'&intFreezerId='.$this->objBox->Freezer.'"  title="view rack contents">Rack '.$this->objBox->Rack->__toString().'</a>';
		else
			$this->lstRack->Text = 'box is not in a rack';
	}


	protected function txtSamples_Create() {
		$this->txtSamples = new QTextBox($this);
		$this->txtSamples->Name = QApplication::Translate('Samples list');
		$this->txtSamples->TextMode = QTextMode::MultiLine;
		$this->txtSamples->Width = '100%';
	}


	protected function btnAdd_Create() {
		$this->btnAdd = new QButton($this);
		$this->btnAdd->Text = QApplication::Translate('Import samples into box');
		$this->btnAdd->AddAction(new QClickEvent(), new QAjaxAction('importSamples'));
		//$this->btnAdd->CausesValidation = true;
	}

	// parse list of samples to import and perform the import
	protected function importSamples() {
		$this->blnImport = true;

		// clear out existing samples marked in the box
		//@BL loop through box
		for($i=1;$i<=$this->slotCount;$i++) {
			// just empty all of the fields
			$obj = '$this->txtS'.$i.'->Text = NULL';
			eval("return $obj;");
			$obj = '$this->txtS'.$i.'->HtmlAfter = NULL';
			eval("return $obj;");
		}


		// get list of samples to import
		if ($this->txtSamples->Text != '') {
			// parse the samples list
			$delimiter = "\n";
			$dataLines = explode($delimiter, $this->txtSamples->Text);
			foreach ( $dataLines as $dataLine ) {
				$part = explode("\t", $dataLine);
				// copy the sample barcodes to the box slots
				//error_log($part[2]);
				$txtSlot = '$this->txtS'.$part[2].'->Text = "'.$part[1].'"';
				eval("return $txtSlot;");
				$txtSlot2 = '$this->txtS'.$part[2].'->HtmlAfter = "<div class=\'bld\' title=\'Study case\'>'.$part[0].'</div>"';
				eval("return $txtSlot2;");
			}
		}
		QApplication::DisplayAlert('Samples have been imported for your review.  Check that they look correct in the box and save the form.  If you need to make corrections to the import you MUST make them in the import box and reimport and NOT edit the sample box slots before saving.');
	}
}

// box content details
class BoxListForm8 extends SampleListFormBase {
	protected $txtName, $objBox, $rowCount, $columnCount, $slotCount, $lstSampleType, $lstRack, $txtShelf, $txtFreezer, $lstStudy;
	protected $btnDeleteSamples, $objFreezerArray;

	protected function SetupBox() {
		if (__QUERY_STATUS_BVint__) {
			$this->objBox = Box::QuerySingle(
					QQ::AndCondition(
							QQ::Equal(QQN::Box()->Id, __QUERY_STATUS_BVint__)
					));

			if (!$this->objBox) {
				QSessionDB::set("error", "Could not retrieve box.");
				QApplication::Redirect('boxes.php');
			}

			// we need to find out how many row and columns are in the box since we need this to begin to build the template
			if ($this->objBox->BoxType) {
				$this->rowCount = $this->objBox->BoxType->Rows;
				$this->columnCount = $this->objBox->BoxType->Columns;
				$this->slotCount = $this->rowCount*$this->columnCount;
				if ($this->slotCount < 1) {
					QSessionDB::set("error", "The box needs to have a box count before proceeding.");
					QApplication::Redirect('box.php?intId='.$intId);
				}

			}
			else {
				QSessionDB::set("error", "Set the box type for the box.");
				QApplication::Redirect('box.php?intId='.$intId);
			}
		} else {
			QSessionDB::set("error", "Could not retrieve box.");
			QApplication::Redirect('boxes.php');
		}

	}

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

		$this->SetupBox();
		$this->btnDeleteSamples = new QPlain($this);
		parent::Form_Create();
		$this->txtName_Create();
		$this->lstRack_Create();
		$this->txtShelf_Create();
		$this->txtFreezer_Create();
		$this->lstSampleType_Create();
		$this->lstStudy_Create();
		$this->dtg_Create();
	}


	protected function lstStudy_Create() {
		$this->lstStudy = new QLabel($this);
	}

	protected function dtg_Create() {
		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSample_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Id, false)));
		$this->colStudyTypeId = new QDataGridColumn(QApplication::Translate('Study Type'), '<?= $_FORM->dtgSample_StudyTypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId, false)));
		$this->colParticipantId = new QDataGridColumn(QApplication::Translate('Participant Id'), '<?= $_ITEM->ParticipantId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ParticipantId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ParticipantId, false)));
		$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type Id'), '<?= $_FORM->dtgSample_SampleType_Render($_ITEM); ?>');
		$this->colSampleNumber = new QDataGridColumn(QApplication::Translate('Sample Number'), '<?= $_ITEM->SampleNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber, false)));
		$this->colBarcode = new QDataGridColumn(QApplication::Translate('Barcode'), '<?= QString::Truncate($_ITEM->Barcode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode, false)));
		$this->colStudyCase = new QDataGridColumn(QApplication::Translate('Study Case'), '<?= QString::Truncate($_ITEM->StudyCase, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase, false)));
		$this->colSampleloc = new QDataGridColumn(QApplication::Translate('Sampleloc'), '<?= QString::Truncate($_ITEM->Sampleloc, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc, false)));
		$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box'), '<?= $_FORM->dtgSample_Box_Render($_ITEM); ?>');
		$this->colNotes = new QDataGridColumn(QApplication::Translate('Notes'), '<?= QString::Truncate($_ITEM->Notes, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Notes), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Notes, false)));
		$this->colBoxSampleSlot = new QDataGridColumn(QApplication::Translate('Box Sample Slot'), '<?= $_ITEM->BoxSampleSlot; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->BoxSampleSlot), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->BoxSampleSlot, false)));
		$this->colParentId = new QDataGridColumn(QApplication::Translate('Parent Id'), '<?= $_ITEM->ParentId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ParentId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ParentId, false)));
		$this->colContainerTypeId = new QDataGridColumn(QApplication::Translate('Container Type'), '<?= $_FORM->dtgSample_ContainerType_Render($_ITEM); ?>');
		$this->colStateTypeId = new QDataGridColumn(QApplication::Translate('State Type Id'), '<?= $_FORM->dtgSample_StateType_Render($_ITEM); ?>');
		$this->colVolume = new QDataGridColumn(QApplication::Translate('Volume'), '<?= number_format($_ITEM->Volume,2); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Volume), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Volume, false)));
		$this->colVolumeUnit = new QDataGridColumn(QApplication::Translate('Volume Unit'), '<?= QString::Truncate($_ITEM->VolumeUnit, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->VolumeUnit), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->VolumeUnit, false)));
		$this->colConcentration = new QDataGridColumn(QApplication::Translate('Concentration'), '<?= number_format($_ITEM->Concentration,2); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Concentration), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Concentration, false)));
		$this->colConcentrationUnit = new QDataGridColumn(QApplication::Translate('Concentration Unit'), '<?= QString::Truncate($_ITEM->ConcentrationUnit, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ConcentrationUnit), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ConcentrationUnit, false)));
		$this->colStateDate = new QDataGridColumn(QApplication::Translate('State Date'), '<?= $_FORM->dtgSample_StateDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StateDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StateDate, false)));

		// Setup DataGrid
		$this->dtgSample = new QDataGrid($this);
		$this->dtgSample->CellSpacing = 0;
		$this->dtgSample->CellPadding = 4;
		$this->dtgSample->BorderStyle = QBorderStyle::Solid;
		$this->dtgSample->BorderWidth = 1;
		$this->dtgSample->GridLines = QGridLines::Both;
		$this->dtgSample->CssClass='table table-bordered';

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSample->UseAjax = false;

		$this->dtgSample->Paginator = new QPaginator($this->dtgSample);
		$this->dtgSample->ItemsPerPage = 1000;

		$this->dtgSample->SortColumnIndex = 1;

		// Specify the local databind method this datagrid will use
		$this->dtgSample->SetDataBinder('dtgSample_Bind');

		$this->dtgSample->AddColumn($this->colEditLinkColumn);
		$this->dtgSample->AddColumn($this->colBoxSampleSlot);

		$this->dtgSample->AddColumn($this->colSampleTypeId);
		$this->dtgSample->AddColumn($this->colSampleNumber);
		$this->dtgSample->AddColumn($this->colBarcode);
		$this->dtgSample->AddColumn($this->colStudyCase);
		$this->dtgSample->AddColumn($this->colNotes);

		$this->dtgSample->AddColumn($this->colParentId);
		$this->dtgSample->AddColumn($this->colContainerTypeId);
		$this->dtgSample->AddColumn($this->colStateTypeId);
		$this->dtgSample->AddColumn($this->colVolume);
		$this->dtgSample->AddColumn($this->colVolumeUnit);
		$this->dtgSample->AddColumn($this->colConcentration);
		$this->dtgSample->AddColumn($this->colConcentrationUnit);
		$this->dtgSample->AddColumn($this->colStateDate);
		$this->dtgSample->AddColumn($this->colStudyTypeId);
	}


	protected function dtgSample_Bind() {
		$this->dtgSample->TotalItemCount = Sample::CountByBoxId($this->objBox->Id);

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
		$this->dtgSample->DataSource = Sample::LoadArrayByBoxId($this->objBox->Id,$objClauses);
	}


	public function dtgSample_EditLinkColumn_Render(Sample $objSample) {
		return sprintf('<a href="sample.php?intId=%s">%s</a>',
				$objSample->Id,
				QApplication::Translate('Edit'));
	}


	// build box name link and other meta data
	protected function txtName_Create() {
		$this->txtName = new QLabel($this);
		$this->txtName->Text = $this->objBox->Name." <a href='box.php?intId=".$this->objBox->Id."' class='sm' title='edit the box location, sample type, etc.'>Edit box meta data</a>";
		$this->txtName->CssClass = 'bld';
		$this->txtName->HtmlEntities = false;
		if ($this->objBox && isset($this->objBox->BoxType))
			$this->txtName->HtmlBefore = '<b>Box</b> <span class="sm">['.$this->objBox->BoxType->__toString().']</span>:<br/><div style="border:1px solid #000;padding:3px;width:200px;text-align:center;">';
		$this->txtName->HtmlAfter = '</div>';
		if ($this->objBox->BoxType)
			$this->txtName->HtmlAfter .= '<span class="sm">Description: <i>'.$this->objBox->Description.'</i></span>';
	}


	protected function lstSampleType_Create() {
		$this->lstSampleType = new QListBox($this);
		$this->lstSampleType->Name = QApplication::Translate('Sample Type: ');
		$this->lstSampleType->HtmlBefore = $this->lstSampleType->Name;

		$this->lstSampleType->AddItem(QApplication::Translate('- Select a sample type -'), null);
		$objSampleTypeArray = SampleTypes::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::SampleTypes()->Letter)));
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			if (($this->objBox->SampleType) && ($this->objBox->SampleType->Id == $objSampleType->Id))
				$objListItem->Selected = true;
			$this->lstSampleType->AddItem($objListItem);
		}
	}


	// create link to freezer
	protected function txtFreezer_Create() {
		$this->txtFreezer = new QLabel($this);
		$this->txtFreezer->CssClass = 'bld fs18';
		$this->txtFreezer->HtmlEntities = false;
		if ($this->objBox->Freezer)
			$this->txtFreezer->Text = '<a href="freezer-view.php?intFreezer='.$this->objBox->Freezer.'" title="view freezer contents">Freezer '.$this->objFreezerArray[$this->objBox->Freezer].'</a>';
		else
			$this->txtFreezer->Text = 'box is not in a Thurston freezer';
	}


	// create link to freezer
	protected function txtShelf_Create() {
		$this->txtShelf = new QLabel($this);
		$this->txtShelf->CssClass = 'bld fs18';
		$this->txtShelf->HtmlEntities = false;
		if ($this->objBox->Shelf)
			$this->txtShelf->Text = '<a href="freezer-view.php?intFreezer='.$this->objBox->Freezer.'" title="view shelf contents">Shelf '.$this->objBox->Shelf.'</a>';
		else
			$this->txtShelf->Text = 'box is not in a Thurston freezer shelf';
	}



	protected function lstRack_Create() {
		$this->lstRack = new QLabel($this);
		$this->lstRack->CssClass = 'bld fs18';
		$this->lstRack->HtmlEntities = false;
		if ($this->objBox->Rack)
			$this->lstRack->Text = '<a href="boxes.php?intRack='.$this->objBox->Rack->Id.'&intFreezerId='.$this->objBox->Freezer.'"  title="view rack contents">Rack '.$this->objBox->Rack->__toString().'</a>';
		else
			$this->lstRack->Text = 'box is not in a rack';
	}

}

$intId = QApplication::QueryString('intId');	// get selected box
$q_status = QApplication::QueryString('strTabStatus');	// look at tab status

// default to 'space available'
if ($q_status == '')
	$q_status = 'a';

define("__QUERY_STATUS_BVint__", $intId);
define("__QUERY_STATUS_BV__", $q_status);

// go to the centralized form executing access control function to run the form and check access control
if (__QUERY_STATUS_BV__=='a') {
	if (__QUERY_STATUS_BVint__!='') ACL_Run('box-view_edit');
}
elseif (__QUERY_STATUS_BV__=='b') {
	if (__QUERY_STATUS_BVint__!='') ACL_Run('box-view_list');
}


// 	// go to the centralized form executing access control function to run the form and check access control
// 	ACL_Run('box-view_edit');
?>