<?php
/**
 * @abstract Sample box log for biological samples. This script is to be used with the E03Box.tpl.php script. Ideally we would be able to
 * dynamically create the text fields such as $txtS1 but I never use more than 100 slots per box so this is the easy solution. Ideally this script 
 * would pull the specs of a selected box in order to build out the form, but that is the todo list, so at the moment this script assumes
 * a specific box and slot configuration and a specific barcode encoding for validation of sample types.
 * 
 */


// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/BoxEditFormBase.class.php');
QApplication::CheckRemoteAdmin();

class E03BoxForm extends BoxEditFormBase {
	protected $objDefaultWaitIcon, $lblColor;

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
	protected $intId, $PreparedById,$strBoxDescriptionConfig, $strBoxPrefix, $intStudyTypeId, $parseBarcodeTimepoint, $scriptName, $scriptListName;

	protected function SetupBox() {
		// -------------- CONFIGURATION SETTINGS -----------------------
		$this->strBoxDescriptionConfig = Sample::$strE03BoxDescriptionConfig; // unique box description for the timepoint
		$this->strBoxPrefix = Sample::$strE03ParseBarcodeTimepoint;	//.'-';	 // removed dash after surpassing the 100 box mark
		$this->intStudyTypeId = Sample::$intE03StudyTypeId;	// study id assigned to the freezer samples (JoCoHS E03)
		$this->parseBarcodeTimepoint = Sample::$strE03ParseBarcodeTimepoint;	// barcode timepoint string
		$this->PreparedById = __LOGGED_USER_ID__;	// user who is processing the images
		$this->scriptName = Sample::$strE03ScriptName;	// name of this script
		$this->scriptListName = Sample::$strE03ScriptListName;	// name of the main list script
				
		// Lookup Object PK information from Query String (if applicable)
		// Set mode to Edit or New depending on what's found
		$this->intId = QApplication::QueryString('intId');
		if (($this->intId)) {
			$this->objBox = Box::QuerySingle(
					QQ::AndCondition(
							QQ::Like(QQN::Box()->Description, $this->strBoxDescriptionConfig.'%'),
							QQ::Equal(QQN::Box()->Id, $this->intId)
					));

			if (!$this->objBox) {
				QSessionDB::set("error", "Could not retrieve box.");
				QApplication::Redirect($this->scriptListName);
			}

			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objBox = new Box();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;

			$objBox = Box::QuerySingle(
					QQ::Like(QQN::Box()->Description, $this->strBoxDescriptionConfig.'%'),QQ::Clause(QQ::LimitInfo(1),QQ::OrderBy(QQN::Box()->Id,false))
			);
			//@BL if a box is already created then we create the next box name
			if ($objBox) {
				//QApplication::DisplayAlert($objBox->Name);
				//@BL create next box sequential box id
				$count = intval(str_replace($this->strBoxPrefix,'',$objBox->Name));	//	wpg - did not work after 30 -	ltrim($objBox->Name,$this->strBoxPrefix);
				if ($count < 100)
					$this->objBox->Name = $this->strBoxPrefix.sprintf('%02d',($count+1));
				else
					$this->objBox->Name = $this->strBoxPrefix.($count+1);
			}
			else {
				// we are on our first box
				$objBox = new Box();
				$this->objBox->Name = $this->strBoxPrefix.'01';
			}
		}
	}


	protected function ValidateControlAndChildren(QControl $objControl) {
		// Initially Assume Validation is True
		$blnToReturn = true;
		// Check the Control to see if it passes validation
		if (!$objControl->Validate()) {
			QSessionDB::set("_page_ValidateControlID", $objControl->ControlId);
			QSessionDB::set("_page_ValidationError", $objControl->ValidationError);
			QApplication::Redirect('#'.$objControl->ControlId);
		}
		return $blnToReturn;
	}

	protected function Form_Exit() {
		parent::Form_Exit();
		$strControlId = QSessionDB::get("_page_ValidateControlID");
		$strValidationError = QSessionDB::get("_page_ValidationError");
		if ($strControlId != '') {
			$objControl = $this->GetControl($strControlId);
			$strNeedValidation = $objControl->Name;
			//            	QApplication::ExecuteJavaScript(sprintf('$("#dialog" ).html("'.$strNeedValidation.'");', $this));
			//           		QApplication::ExecuteJavaScript(sprintf('$("#dialog" ).dialog({ title: "The following question needs an answer", modal: false });', $this));
			// wpg - had to remove the dialog javascript because it was causing problems in the iPad (javascript alerts work fine)
			QApplication::DisplayAlert($strNeedValidation." error:".$strValidationError);
			QSessionDB::Delete("_page_ValidateControlID");
		}
	}

	protected function Form_Create() {
		parent::Form_Create();
		$this->txtSlot_Create();
		$this->lblColor_Create();

		//@BL we will only enable editing if we have not shipped the box
		//if (!($this->objBox->ClinicShipment && $this->objBox->ClinicShipment->ShipTime)) {
			$this->changeOptionAction();
		//}

		$this->ST_SL();
		//$this->slotFull();
		$this->objDefaultWaitIcon = new QWaitIcon($this);
		$this->objDefaultWaitIcon->CssClass = 'waitIcon';

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
	}

	protected function changeOptionAction() {
		$this->lstSampleType->AddAction(new QChangeEvent(), new QAjaxAction('ST_SL'));
		$this->lstSampleType->AddAction(new QChangeEvent(), new QServerAction('changeOptionSave'));	// needs to be a server action so the box id does not get duplicated (some strange behavior with creating duplicate box names if performing a redirect after saving)

		//@BL adding events for when the barcode is scanned within a field in the box; adding a 1 second delay to each action so that the clinic barcode scanner will not re-enter the same barcode or part of it in another field
		for($i=1;$i<=81;$i++) {
			$obj = '$this->txtS'.$i.'->AddAction(new QEnterKeyEvent(1000), new QAjaxAction("enterKeyPress"));';
			eval("return $obj;");
		}

		//@BL terminate submission of form
		for($i=1;$i<=81;$i++) {
			$obj = '$this->txtS'.$i.'->AddAction(new QEnterKeyEvent(), new QTerminateAction());';
			eval("return $obj;");
		}

		// disabling this since it is causing problems (April 18, 2017 - wpg)
		//$this->txtS1->AddAction(new QChangeEvent(), new QAjaxAction('ST_SL'));
		$this->txtS1->AddAction(new QChangeEvent(), new QAjaxAction('changeOptionSave'));

		//@BL adding change events
		for($i=2;$i<=81;$i++) {
			$obj = '$this->txtS'.$i.'->AddAction(new QChangeEvent(), new QAjaxAction("changeOptionSave"));';
			eval("return $obj;");
		}

		$this->chkComplete->AddAction(new QChangeEvent(), new QAjaxAction('changeOptionSave'));
	}

	//@BL will check to see when a barcode is scanned since the scanner issues an 'Enter' command within a textbox
	public function enterKeyPress($strFormId, $strControlId, $strParameter) {
		//@BL we will check when someone presses the enter key on one of the sample fields
		if ($this->GetControl($strControlId) instanceof QTextBox ) {
			QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', 'c'.(substr($strControlId,1)+1)));
		}
	}

	protected function changeOptionSave($strFormId, $strControlId, $strParameter='') {
		$this->completedControl(1,$this->GetControl($strControlId));
		// we will save individual sample slots this way
		if ($this->GetControl($strControlId) instanceof QTextBox ) {
			// get the text field barcode
			$obj = $this->GetControl($strControlId);

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
					$objExistingSample->Delete();
				}
				QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', $strControlId));
				$this->slotFull('',$obj->Columns);
				return;
			}
			// check to see if a sample exists for the entered barcode
			$objSampleExisting= Sample::QuerySingle(
					QQ::AndCondition(
							QQ::Equal(QQN::Sample()->Barcode, trim($obj->Text)),
							QQ::Equal(QQN::Sample()->StudyTypeId, $this->intStudyTypeId),
							QQ::Equal(QQN::Sample()->BoxId, $this->objBox->Id)
					)
			);
			// log a simple alert if we have scanned the barcode once already for this box
			if ($objSampleExisting) {
				QApplication::DisplayAlert('Note: Barcode already scanned in this box.');
			}
			$objSampleExisting=NULL;
			
			// if sample is not logged, then create a new entry
			//if (!$objSample) {
			$objSample = new Sample();
			$objSample->StudyTypeId = $this->intStudyTypeId;	// study ID
			$objSample->Barcode = $obj->Text;
			$barcodePasses = $objSample->parseBarcode($this->lstSampleType->SelectedValue,Sample::$strE03BoxDescriptionConfig);
			// if we are able to parse the barcode then save the sample
			if ($barcodePasses){
				//error_log('barcode should have saved');
				$objSample->Save();
			}
			else {
				//error_log('barcode save: nopers'.$barcodePasses);
				QApplication::DisplayAlert('Incorrect barcode scanned. Please try again.');
				//$obj->Text = NULL;
				QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', $strControlId));
				$this->slotFull('',$obj->Columns);
				return;
			}
			//}

			// if someone is trying a sample that is already logged then we ask them to try again
			if ($obj->Text != '' && $objSample->BoxSampleSlot) {
				QApplication::DisplayAlert('Sample logged already in a box. Please try again.'.$obj->Text);
				if ($objExistingSample)
					$obj->Text = $objExistingSample->Barcode;
				else
					//$obj->Text = NULL;
				QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', $strControlId));
				return;
				$this->slotFull($objSample);
				return;
			}



			// stop update of the sample box if the sample type does not match
			if (!$barcodePasses) {
				QApplication::DisplayAlert('The entered sample type does not match the sample box. Please try again.');
				//$obj->Text = NULL;
				QApplication::ExecuteJavaScript(sprintf('qcodo.getControl("%s").focus()', $strControlId));
				$this->slotFull('',$obj->Columns);
				return;
			}

			// if a sample already exists in this location then see if it is the current one
			// else we are using the one we created or have
			if ($objExistingSample) {
				// if the barcode in the box is different from the selected one then notify that we are replacing a sample that is logged in this location and we are creating an orphan sample

				// if the existing sample is different than the one we created or found then
				if ($objExistingSample->Id != $objSample->Id) {
					$objSample->BoxId = $this->objBox->Id;
					$objSample->BoxSampleSlot = $obj->Columns;	// using the Columns property of the sample (field) to save the slot location
					if ($obj->Columns!='') $objSample->Save();
					else{
						// we throw an error is the sample location can not be obtained
						QApplication::DisplayAlert('The sample location could not be captured. Please try scanning the barcode again.');
						return;
					}

					// remove the existing one from the location and create an orphan sample (leave the box ID intact so we know what box the sample came from)
// 					$objExistingSample->BoxSampleSlot = NULL;
// 					$objExistingSample->Save();
					$objExistingSample->Delete();
					QApplication::DisplayAlert('You have just changed the sample logged in this box location.');
				}
				else {
					QApplication::DisplayAlert('Nothing changed');
				}
			}
			else {
				$objSample->BoxId = $this->objBox->Id;
				$objSample->BoxSampleSlot = $obj->Columns;	// using the Columns property of the sample (field) to save the slot location
				if ($obj->Columns!='') $objSample->Save();
				else{
					// we throw an error is the sample location can not be obtained
					QApplication::DisplayAlert('The sample location could not be captured. Please try scanning the barcode again.');
					return;
				}
			}

			if ($objSample->StudyCase) {
				$txtSlot2 = '$this->txtS'.$objSample->BoxSampleSlot.'->HtmlAfter = "<div class=\'text-sm-left text-muted\' title=\'Case ID\'>Case: '.$objSample->StudyCase.'</div>"';
				eval("return $txtSlot2;");
			}
			$this->slotFull($objSample);
		}

		$this->saveChanges();
	}

	//@BL updates the form object, saves it
	protected function saveChanges() {
		//if (!($this->objBox->ClinicShipment && $this->objBox->ClinicShipment->ShipTime)) {
			$this->UpdateBoxFields();
			$this->objBox->Save();

			// redirect back to the saved box because otherwise a page refresh will duplicate the box
			if (!$this->intId) {
				QApplication::Redirect($this->scriptName.'?intId='.$this->objBox->Id);
				exit;
			}
		//}
	}

	protected function calCreated_Create() {
		$this->calCreated = new QLabel($this);
		$this->calCreated->Name = QApplication::Translate('Created Date: ');
		if ($this->blnEditMode && $this->objBox->Created)
			$this->calCreated->Text = $this->objBox->Created->toString(QDateTime::FormatSlashes);
		else {
			$this->calCreated->Text = QDateTime::NowToString(QDateTime::FormatSlashes);
		}
	}

	protected function UpdateBoxFields() {
		$this->objBox->SampleTypeId = $this->lstSampleType->SelectedValue;
		$this->objBox->Complete = $this->chkComplete->Checked;

		if ($this->objBox->Description == '')
			$this->objBox->Description = $this->strBoxDescriptionConfig;
		if ($this->objBox->BoxTypeId == '')
			$this->objBox->BoxTypeId = 1;
		if ($this->objBox->Freezer == '')
			$this->objBox->Freezer = 9;	// default to clinic freezer
		if ($this->objBox->PreparedById == '')
			$this->objBox->PreparedById = $this->PreparedById;
	}

	protected function btnSave_Create() {
		$this->btnSave = new QButton($this);
		//if (!($this->objBox->ClinicShipment && $this->objBox->ClinicShipment->ShipTime)) {
			$this->btnSave->Text = 'Save >';
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		// }
		// else {
		// 	$this->btnSave->Text = '< Back to boxes';
		// 	$this->btnSave->AddAction(new QClickEvent(), new QAjaxAction('RedirectToListPage'));
		// }
	}

	protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->saveChanges();
		$this->RedirectToListPage();
	}

	protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->saveChanges();	//@BL still need to save changes on cancel in case one of the mouse or key events did not fire off when the user was filling out the form
		$this->RedirectToListPage();
	}

	protected function RedirectToListPage() {
		QApplication::Redirect($this->scriptListName);
	}

	/**
	 * wpg - dynamically create the number of slots we need for our box depending on the box slot count
	 *
	 */
	protected function txtSlot_Create($count=81) {
		for($i=1;$i<=81;$i++) {
			// NOTE: DO NOT CHANGE THIS TO QIntegerTextBox because for some reason it is not handling numbers correctly
			$obj = '$this->txtS'.$i.' = new QTextBox($this);';
			eval("return $obj;");
			$obj = '$this->txtS'.$i.'->Name = QApplication::Translate("slot '.$i.'");';
			eval("return $obj;");
			$obj = '$this->txtS'.$i.'->Columns = '.$i.';';	// we need this to save the slot location
			eval("return $obj;");
			$obj = '$this->txtS'.$i.'->MaxLength = 10;';
			eval("return $obj;");
			$obj = '$this->txtS'.$i.'->Width = "85px"';
			eval("return $obj;");
		}
		// do not bother looking for sample if there is no box Id
		if ($this->objBox->Id != '') {
			// now that we have built the controls we fill them in with samples
			$objSampleArray = Sample::QueryArray(
					QQ::Equal(QQN::Sample()->BoxId, $this->objBox->Id),null,null,array('barcode','box_sample_slot','study_case','sample_type_id')
			);
			if ($objSampleArray) foreach ($objSampleArray as $objSample) {
				if ($objSample->BoxSampleSlot) {
					//add css style for sample type
					if ($objSample->SampleTypeId) {
						$obj = '$this->txtS'.$objSample->BoxSampleSlot.'->CssClass = "'.SampleTypes::$sampleColor[$objSample->SampleTypeId][2].'"';
						eval("return $obj;");
					}

					$obj = '$this->txtS'.$objSample->BoxSampleSlot.'->Text = $objSample->Barcode;';
					eval("return $obj;");

					$txtSlot2 = '$this->txtS'.$objSample->BoxSampleSlot.'->HtmlAfter = "<div class=\'text-sm-left text-muted\' title=\'Case ID\'>Case: '.$objSample->StudyCase.'</div>"';
					eval("return $txtSlot2;");
				}
			}
		}
	}

	protected function txtName_Create() {
		$this->txtName = new QLabel($this);
		$this->txtName->Text = $this->objBox->Name;
		$this->txtName->CssClass = 'bld fs18';
	}

	protected function lblColor_Create() {
		$this->lblColor = new QLabel($this);
		$this->lblColor->HtmlEntities = false;
	}

	protected function lstSampleType_Create() {
		$this->lstSampleType = new QListBox($this);
		// if ($this->objBox->ClinicShipment && $this->objBox->ClinicShipment->ShipTime) {
		// 	$this->lstSampleType->HtmlBefore = '<h3 class="error">Box shipped</h3><div>'.$this->lstSampleType->Name.'</div>';
		// }
		// else
			$this->lstSampleType->HtmlBefore = '<div>'.$this->lstSampleType->Name.'</div>';
		$this->lstSampleType->Name = QApplication::Translate('Sample Type: ');
		$this->lstSampleType->AddItem(QApplication::Translate('- Select a sample type -'), null);
		// we are only concerned with serum, urine, plasma, and white blood cell samples for T4
		$objSampleTypeArray = SampleTypes::QueryArray(QQ::In(QQN::SampleTypes()->Id, array(1,2,3)), QQ::Clause(QQ::OrderBy(QQN::SampleTypes()->Id)));
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			if (($this->objBox->SampleType) && ($this->objBox->SampleType->Id == $objSampleType->Id))
				$objListItem->Selected = true;
			$this->lstSampleType->AddItem($objListItem);
		}
	}

	protected function chkComplete_Create() {
		$this->chkComplete = new QCheckBox($this);
		$this->chkComplete->Name = QApplication::Translate('Check if box is ready to be shipped: ');
		$this->chkComplete->CssClass = 'bld';
		$this->chkComplete->Checked = $this->objBox->Complete;
	}

	// ------------ skip logic
	//@BL sample type change
	protected function ST_SL($strFormId='', $strControlId='', $strParameter=''){
		if ($this->lstSampleType->SelectedValue!=''){
			//@BL do not change the sample type if the first sample has been added to the box
			if (trim($this->txtS1->Text) != '') {
				$this->lstSampleType->Enabled=false;
				//@BL when updating the form if the interview date has not been saved then set it to now
				if ($this->objBox->Created == '')
					$this->objBox->Created = QDateTime::Now(true);
			}
			else
				$this->lstSampleType->Enabled=true;

			$this->lstSampleType->CssClass='bld fs14';
			QApplication::ExecuteJavaScript(sprintf('$("#ST_SL").show("slow");', $this));

			$this->lblColor->Text = SampleTypes::$sampleColor[$this->lstSampleType->SelectedValue][1];
			//$this->lblColor->CssClass = SampleTypes::$sampleColor[$this->lstSampleType->SelectedValue][0];
		}
		else {
			$this->lstSampleType->Enabled=true;
			QApplication::ExecuteJavaScript(sprintf('$("#ST_SL").hide("slow");', $this));
		}
	}

	//@BL mark if a slot in the box is occupied using the box type colors
	protected function slotFull($objSample='', $slot='') {
		if ($objSample) {
			$obj = '$this->txtS'.$objSample->BoxSampleSlot.'->Text';
			$obj2 = '$this->txtS'.$objSample->BoxSampleSlot.'->CssClass = "'.SampleTypes::$sampleColor[$objSample->SampleTypeId][2].'"';
			if (eval("return $obj;") != '')
				eval("return $obj2;");
		}
		else {
			//$obj = '$this->txtS'.$slot.'->Text=""';
			$obj2 = '$this->txtS'.$slot.'->CssClass = ""';
			$obj3 = '$this->txtS'.$slot.'->HtmlAfter = ""';
			//eval("return $obj;");
			eval("return $obj2;");
			eval("return $obj3;");
		}
	}
}


// go to the centralized form executing access control function to run the form and check access control
ACL_Run('E03Box');
?>