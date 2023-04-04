<?php
/**
 * @author w. Patrick Gale (April 2012)
 * @abstract box view used for sample pulls.
 * @author w. Patrick Gale
 *
 * Nov. 15, 2019 - wpg
 * - tracking the sample moves
 * 
 * Aug. 30, 2017 - wpg
 * - adding anchor to last pulled sample so user does not have to scroll down the page each time a sample is pulled
 * - adding checkboxes for freezer pull selections (in the case where we choose additional samples once we have a chance to look at the sample volume)
 *
 * Aug. 27, 2017 - wpg
 * - adding buttons to pull samples for a sample request and move to the 'moving' box
 *
 * Aug. 25, 2017 - wpg
 * - thought of adding a txtSampleMoveBox component to scan barcodes to be sent to the moving box, but there are cases where the label/barcode for a sample may be the same for multiple samples in the box, which would not work;
 * instead using a link/button at the sample slot to transfer the sample to the moving box without the need for the barcode scanner
 *
 * Aug. 24, 2017 - wpg
 * - setting up basic shell sample pull highlighting
*/

// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');
require(__FORMBASE_CLASSES__ . '/BoxEditFormBase.class.php');
require(__FORMBASE_CLASSES__ . '/SampleListFormBase.class.php');
QApplication::CheckRemoteAdmin();


class BoxSamplePullForm8 extends BoxEditFormBase {
	protected $objFreezerArray, $objDefaultWaitIcon, $rowCount, $columnCount, $slotCount,
	$lstStudy, $txtSamples, $btnAdd, $blnImport, $studyTypeArray, $txtSampleMoveBox, $highlightSlots;

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

	// pull sample buttons
	protected $btnS1;
	protected $btnS2;
	protected $btnS3;
	protected $btnS4;
	protected $btnS5;
	protected $btnS6;
	protected $btnS7;
	protected $btnS8;
	protected $btnS9;
	protected $btnS10;
	protected $btnS11;
	protected $btnS12;
	protected $btnS13;
	protected $btnS14;
	protected $btnS15;
	protected $btnS16;
	protected $btnS17;
	protected $btnS18;
	protected $btnS19;
	protected $btnS20;
	protected $btnS21;
	protected $btnS22;
	protected $btnS23;
	protected $btnS24;
	protected $btnS25;
	protected $btnS26;
	protected $btnS27;
	protected $btnS28;
	protected $btnS29;
	protected $btnS30;
	protected $btnS31;
	protected $btnS32;
	protected $btnS33;
	protected $btnS34;
	protected $btnS35;
	protected $btnS36;
	protected $btnS37;
	protected $btnS38;
	protected $btnS39;
	protected $btnS40;
	protected $btnS41;
	protected $btnS42;
	protected $btnS43;
	protected $btnS44;
	protected $btnS45;
	protected $btnS46;
	protected $btnS47;
	protected $btnS48;
	protected $btnS49;
	protected $btnS50;
	protected $btnS51;
	protected $btnS52;
	protected $btnS53;
	protected $btnS54;
	protected $btnS55;
	protected $btnS56;
	protected $btnS57;
	protected $btnS58;
	protected $btnS59;
	protected $btnS60;
	protected $btnS61;
	protected $btnS62;
	protected $btnS63;
	protected $btnS64;
	protected $btnS65;
	protected $btnS66;
	protected $btnS67;
	protected $btnS68;
	protected $btnS69;
	protected $btnS70;
	protected $btnS71;
	protected $btnS72;
	protected $btnS73;
	protected $btnS74;
	protected $btnS75;
	protected $btnS76;
	protected $btnS77;
	protected $btnS78;
	protected $btnS79;
	protected $btnS80;
	protected $btnS81;
	protected $btnS82;
	protected $btnS83;
	protected $btnS84;
	protected $btnS85;
	protected $btnS86;
	protected $btnS87;
	protected $btnS88;
	protected $btnS89;
	protected $btnS90;
	protected $btnS91;
	protected $btnS92;
	protected $btnS93;
	protected $btnS94;
	protected $btnS95;
	protected $btnS96;
	protected $btnS97;
	protected $btnS98;
	protected $btnS99;
	protected $btnS100;

	// pull sample selections
	protected $chkS1;
	protected $chkS2;
	protected $chkS3;
	protected $chkS4;
	protected $chkS5;
	protected $chkS6;
	protected $chkS7;
	protected $chkS8;
	protected $chkS9;
	protected $chkS10;
	protected $chkS11;
	protected $chkS12;
	protected $chkS13;
	protected $chkS14;
	protected $chkS15;
	protected $chkS16;
	protected $chkS17;
	protected $chkS18;
	protected $chkS19;
	protected $chkS20;
	protected $chkS21;
	protected $chkS22;
	protected $chkS23;
	protected $chkS24;
	protected $chkS25;
	protected $chkS26;
	protected $chkS27;
	protected $chkS28;
	protected $chkS29;
	protected $chkS30;
	protected $chkS31;
	protected $chkS32;
	protected $chkS33;
	protected $chkS34;
	protected $chkS35;
	protected $chkS36;
	protected $chkS37;
	protected $chkS38;
	protected $chkS39;
	protected $chkS40;
	protected $chkS41;
	protected $chkS42;
	protected $chkS43;
	protected $chkS44;
	protected $chkS45;
	protected $chkS46;
	protected $chkS47;
	protected $chkS48;
	protected $chkS49;
	protected $chkS50;
	protected $chkS51;
	protected $chkS52;
	protected $chkS53;
	protected $chkS54;
	protected $chkS55;
	protected $chkS56;
	protected $chkS57;
	protected $chkS58;
	protected $chkS59;
	protected $chkS60;
	protected $chkS61;
	protected $chkS62;
	protected $chkS63;
	protected $chkS64;
	protected $chkS65;
	protected $chkS66;
	protected $chkS67;
	protected $chkS68;
	protected $chkS69;
	protected $chkS70;
	protected $chkS71;
	protected $chkS72;
	protected $chkS73;
	protected $chkS74;
	protected $chkS75;
	protected $chkS76;
	protected $chkS77;
	protected $chkS78;
	protected $chkS79;
	protected $chkS80;
	protected $chkS81;
	protected $chkS82;
	protected $chkS83;
	protected $chkS84;
	protected $chkS85;
	protected $chkS86;
	protected $chkS87;
	protected $chkS88;
	protected $chkS89;
	protected $chkS90;
	protected $chkS91;
	protected $chkS92;
	protected $chkS93;
	protected $chkS94;
	protected $chkS95;
	protected $chkS96;
	protected $chkS97;
	protected $chkS98;
	protected $chkS99;
	protected $chkS100;

	protected $objSampleSelection, $objMovingBox;

	protected function SetupBox() {
		$this->highlightSlots = array();
		$intId=QApplication::QueryString('intId');
		$freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__'));
		$freezerSampleIDArray = array_values($freezerPullArray);	// we need to only get the array values array for the query to function correctly
		$objSamplePullArray = Sample::QueryArray(
				QQ::AndCondition(
						QQ::In(QQN::Sample()->Id, $freezerSampleIDArray),
						QQ::Equal(QQN::Sample()->BoxId, $intId)
						),
				QQ::Clause(QQ::OrderBy(QQN::Sample()->BoxSampleSlot)));
		if ($objSamplePullArray) foreach($objSamplePullArray as $objSample){
			array_push($this->highlightSlots,$objSample->BoxSampleSlot);
		}

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

		$this->objSampleSelection = unserialize(QSessionDB::get('__SAMPLE_SELECTION_SEARCH__')); // load the selected sample pull data
		$this->objMovingBox = unserialize(QSessionDB::get('__SAMPLE_MOVING_BOX__'));	// see if we have a moving box

		parent::Form_Create();
		$this->lstStudy_Create();
		$this->txtSlot_Create();
		//$this->txtSampleMoveBox_Create();


		$this->changeOptionAction();

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
		//s$this->lstSampleType->Required=true;
		//$this->lstStudy->Required=true;
	}

	protected function changeOptionAction() {
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
	}

	//@BL updates the form object, saves it
	protected function saveChanges() {
		$this->UpdateBoxFields();
		$this->objBox->Save();
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
			$obj = '$this->txtS'.$i.'->Width = "90px"';
			eval("return $obj;");

			$obj = '$this->btnS'.$i.' = new QButton($this);';
			eval("return $obj;");
			$obj = '$this->btnS'.$i.'->Visible = false;';
			eval("return $obj;");

			// build checkboxes for sample pull selections
			$obj = '$this->chkS'.$i.' = new QCheckbox($this);';
			eval("return $obj;");
			$obj = '$this->chkS'.$i.'->Visible = false;';
			eval("return $obj;");
			$obj = '$this->chkS'.$i.'->ToolTip = "Select to add/remove the sample from a freezer pull";';
			eval("return $obj;");
			$obj = '$this->chkS'.$i.'->AddAction(new QChangeEvent(), new QServerAction("chkSamplePull_Change"));';
			eval("return $obj;");
		}
		// now that we have built the controls we fill them in
		$objSampleArray = Sample::QueryArray(
				QQ::Equal(QQN::Sample()->BoxId, $this->objBox->Id),null,null,array('id','barcode','box_sample_slot','study_case','sample_type_id','study_type_id')
		);
		if ($objSampleArray) foreach ($objSampleArray as $objSample) {
			// if a sample exists
			if ($objSample->BoxSampleSlot) {
				//QApplication::ExecuteJavaScript(sprintf('$("#sampleImport").hide("slow");', $this));

				//add css style if we know the sample type
				if (array_key_exists($objSample->SampleTypeId, SampleTypes::$sampleColor)) {
					$obj = '$this->txtS'.$objSample->BoxSampleSlot.'->CssClass = "'.SampleTypes::$sampleColor[$objSample->SampleTypeId][2].' fs10"';
					eval("return $obj;");
				}

				$obj = '$this->chkS'.$objSample->BoxSampleSlot.'->Visible = true;';
				eval("return $obj;");
				$obj = '$this->chkS'.$objSample->BoxSampleSlot.'->ActionParameter = '.$objSample->Id.';';
				eval("return $obj;");

				//print_r($this->highlightSlots);
				if (in_array($objSample->BoxSampleSlot, $this->highlightSlots)) {
					$obj = '$this->chkS'.$objSample->BoxSampleSlot.'->AddAction(new QClickEvent(), new QConfirmAction(\'Are you SURE you want to DELETE the selected sample from the pull list?\'));';
					eval("return $obj;");
					$obj = '$this->chkS'.$objSample->BoxSampleSlot.'->Checked = true;';
					eval("return $obj;");
				}
				else {
					$obj = '$this->chkS'.$objSample->BoxSampleSlot.'->AddAction(new QClickEvent(), new QConfirmAction(\'Are you SURE you want to ADD the selected sample to the pull list?\'));';
					eval("return $obj;");
				}

				// create add properties to the button used to pull samples
				$obj = '$this->btnS'.$objSample->BoxSampleSlot.'->Text = "Pull sample";';
				eval("return $obj;");
				$obj = '$this->btnS'.$objSample->BoxSampleSlot.'->Visible = true;';
				eval("return $obj;");
				$obj = '$this->btnS'.$objSample->BoxSampleSlot.'->ActionParameter = '.$objSample->Id.';';
				eval("return $obj;");
				$obj = '$this->btnS'.$objSample->BoxSampleSlot.'->AddAction(new QClickEvent(), new QConfirmAction(\'Are you SURE you want to PULL the selected sample?\'));';
				eval("return $obj;");
				$obj = '$this->btnS'.$objSample->BoxSampleSlot.'->AddAction(new QClickEvent(), new QServerAction("chkSamplePull_Change"));';
				eval("return $obj;");

				$obj = '$this->txtS'.$objSample->BoxSampleSlot.'->Text = $objSample->Barcode;';
				eval("return $obj;");
				$txtSlot2 = '$this->txtS'.$objSample->BoxSampleSlot.'->HtmlAfter = "<div title=\'Subject ID\'>'.$objSample->StudyCase.'</div>"';
				eval("return $txtSlot2;");

				// wpg - create an array of study types here
				$this->studyTypeArray[$objSample->StudyTypeId] = $objSample->StudyTypeId;
			}
		}
	}

	protected function chkSamplePull_Change($strFormId, $strControlId, $strParameter) {
		$chkSamplePull = $this->GetControl($strControlId);
		$freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__'));
		if (!is_array($freezerPullArray)) $freezerPullArray = array();

		if ($chkSamplePull instanceof QCheckbox && $chkSamplePull->Checked) {
			//QApplication::DisplayAlert($strParameter." checked");
			$freezerPullArray[$strParameter] = $strParameter;
			QSessionDB::set('__FREEZER_PULL_LIST__',serialize($freezerPullArray));
			//QApplication::DisplayAlert($strParameter." checked");
		}
		elseif ($chkSamplePull instanceof QButton) {
			//QApplication::DisplayAlert($strParameter." checked");
			$freezerPullArray[$strParameter] = $strParameter;
			QSessionDB::set('__FREEZER_PULL_LIST__',serialize($freezerPullArray));
			// if user selects to pull the sample
			$this->moveSample($strFormId, $strControlId, $strParameter);
			//QApplication::DisplayAlert($strParameter." checked");
		}
		elseif ($chkSamplePull instanceof QCheckbox && !$chkSamplePull->Checked) {
			//QApplication::DisplayAlert($strParameter." unchecked");
			unset($freezerPullArray[$strParameter]);
			QSessionDB::set('__FREEZER_PULL_LIST__',serialize($freezerPullArray));
			//QApplication::DisplayAlert($strParameter." unchecked");
		}
		$objSample = Sample::Load($strParameter);	// load the selected sample object
		QApplication::Redirect("#slot".$objSample->BoxSampleSlot);
	}

	protected function moveSample($strFormId, $strControlId, $strParameter='') {
		$objSample = Sample::Load($strParameter);	// load the selected sample object
		
		ActionLog::LogSampleAction(5,$objSample);	// track the sample update
		// build the notes for the sample move history
		$sampleMoveNote = "moved from box: ".$this->objBox->Name." (boxid=".$this->objBox->Id."), slot #".$objSample->BoxSampleSlot.", reason for move: ".$this->objSampleSelection->__toString()." (sample_pull_id=".$this->objSampleSelection->Id."), date moved: ".QDateTime::Now(false)->toString("YYYY.MM.DD").", moved by: ".__LOGGED_USER_NAME__;	//$objSample->Barcode
		$intSlotPulled = $objSample->BoxSampleSlot;
		// get the last open slot in the moving box
		$objDatabase = Sample::GetDatabase();
		$strQuery= "SELECT box_sample_slot FROM fm__sample WHERE box_id=".$this->objMovingBox->Id." ORDER BY box_sample_slot desc LIMIT 1";
		$objDbResult = $objDatabase->Query($strQuery);
		$intBoxSampleSlot = $objDbResult->FetchRow();

		// log the moving of the sample to the moving box
		$objSampleHistoryLog = new SampleHistoryLog();
		$objSampleHistoryLog->SampleId = $objSample->Id;
		$objSampleHistoryLog->Note = $sampleMoveNote;

		// box is empty so we would start with the first slot
		// else the moving box is not empty so we continue to fill it
		if ($intBoxSampleSlot == '') {
// 			QApplication::DisplayAlert(1);
// 			return;
			$objSample->BoxSampleSlot = 1;
		}
		else {
// 			QApplication::DisplayAlert($intBoxSampleSlot[0]+1);
// 			return;
			// get box slot count
			$intMBSC = $this->objMovingBox->BoxType->Columns*$this->objMovingBox->BoxType->Rows;
			if ($intMBSC > $intBoxSampleSlot[0]) $objSample->BoxSampleSlot = $intBoxSampleSlot[0]+1;
			else {
				QApplication::DisplayAlert("Moving box is full. Cannot move samples to this box.");
				return;
			}
		}
		$objSample->BoxId = $this->objMovingBox->Id;
		$objSample->Save();

		$objSampleHistoryLog->Save();
		QApplication::Redirect("#slot".$intSlotPulled);
		//QApplication::DisplayAlert("Sample moved.");
		// print the current sample location and move information to the sample history log
		// save the current location to the notes of the sample (would be better to have a 'move' log to track when samples moved from one box to another)
	}

	// build box name link and other meta data
	protected function txtName_Create() {
		$this->txtName = new QLabel($this);
		$this->txtName->Text = $this->objBox->Name;
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
			$this->lstStudy->Text .= FmStudy::GetName($key);
		}
		else $this->lstStudy->Text = "---";
	}

	protected function lstSampleType_Create() {
		$this->lstSampleType = new QLabel($this);
		$this->lstSampleType->Name = QApplication::Translate('Sample Type: ');
		//$this->lstSampleType->HtmlBefore = $this->lstSampleType->Name;
		$this->lstSampleType->Text = $this->objBox->SampleType->__toString();
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
	}

	//@BL mark if a slot in the box is occupied using the box type colors
	protected function slotFull($obj=NULL) {
	}

	// create link to freezer
	protected function txtFreezer_Create() {
		$this->txtFreezer = new QLabel($this);
		$this->txtFreezer->CssClass = 'bld fs18';
		$this->txtFreezer->HtmlEntities = false;
		if ($this->objBox->Freezer)
			$this->txtFreezer->Text = $this->objFreezerArray[$this->objBox->Freezer];
		else
			$this->txtFreezer->Text = 'box is not in a Thurston freezer';
	}


	// create link to freezer
	protected function txtShelf_Create() {
		$this->txtShelf = new QLabel($this);
		$this->txtShelf->CssClass = 'bld fs18';
		$this->txtShelf->HtmlEntities = false;
		if ($this->objBox->Shelf)
			$this->txtShelf->Text = 'Shelf '.$this->objBox->Shelf;
		else
			$this->txtShelf->Text = '<span class="sm cGray">(no shelf)</span>';
	}



	protected function lstRack_Create() {
		$this->lstRack = new QLabel($this);
		$this->lstRack->CssClass = 'bld fs18';
		$this->lstRack->HtmlEntities = false;
		if ($this->objBox->Rack)
			$this->lstRack->Text = 'Rack '.$this->objBox->Rack->__toString();
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
ACL_Run('box-sample-pull');
?>