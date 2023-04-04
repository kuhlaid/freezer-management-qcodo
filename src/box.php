<?php
/**
 * @author w. Patrick Gale
 * @abstract Form used to edit the details of a sample box (location, type, etc).
 * 
 * March 20, 2020 - wpg
 * - duplicate last box information to a new box
 * 
 * Oct. 30, 2018 - wpg
 * - adding action logging to box updates
 * 
 * - fixed a bug with new rack selector when the rack is new and does not have a location assigned (Sept. 29, 2014 - wpg)
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/BoxEditFormBase.class.php');

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();


class BoxEditForm8 extends BoxEditFormBase {
	protected $objDefaultWaitIcon;

	protected function SetupBox() {
		// Lookup Object PK information from Query String (if applicable)
		// Set mode to Edit or New depending on what's found
		$intId = QApplication::QueryString('intId');
		if (($intId)) {
			$this->objBox = Box::Load(($intId));

			if (!$this->objBox)
				throw new Exception('Could not find a Box object with PK arguments: ' . $intId);

			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objBox = new Box();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
			$blnDuplicate = QApplication::QueryString('blnDuplicate');
			// duplicate the data from the last box entered
			if ($blnDuplicate) {
				$objClone = Box::QuerySingle(
					QQ::All(),QQ::Clause(QQ::LimitInfo(1),QQ::OrderBy(QQN::Box()->Id,false))
				);

				$this->objBox->Name = $objClone->Name;
				$this->objBox->RackId = $objClone->RackId;
				$this->objBox->Shelf = $objClone->Shelf;
				$this->objBox->Freezer = $objClone->Freezer;
				$this->objBox->Issues = $objClone->Issues;
				$this->objBox->Description = $objClone->Description;
				$this->objBox->BoxTypeId = $objClone->BoxTypeId;
				$this->objBox->SampleTypeId = $objClone->SampleTypeId;
				$this->blnEditMode = true;
			}
		}
	}


			
	protected function Form_Create() {
		$this->objDefaultWaitIcon = new QWaitIcon($this);
		$this->objDefaultWaitIcon->CssClass = 'waitIcon';
		// Call SetupBox to either Load/Edit Existing or Create New
		$this->SetupBox();

		// Create/Setup Controls for Box's Data Fields
		$this->txtName_Create();
		$this->lstRack_Create();
		$this->txtShelf_Create();
		$this->txtFreezer_Create();
		$this->rackSelected();
		$this->txtIssues_Create();
		$this->txtDescription_Create();
		$this->lstBoxType_Create();
		$this->lstSampleType_Create();
		$this->chkComplete_Create();
		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
	}


	protected function chkComplete_Create() {
		$this->chkComplete = new QCheckBox($this);
		$this->chkComplete->Name = QApplication::Translate('Check if box inventory has been verified: ');
		$this->chkComplete->CssClass = 'bld';
		$this->chkComplete->Checked = $this->objBox->Complete;
	}

	protected function RedirectToListPage() {
		if ($this->objBox->Id)
			QApplication::Redirect('boxes.php?intBoxId='.$this->objBox->Id);
		else
			QApplication::Redirect('boxes.php');
	}

	// Protected Create Methods
	// Create and Setup txtName
	protected function txtName_Create() {
		$this->txtName = new QTextBox($this);
		$this->txtName->Name = QApplication::Translate('Name/ID');
		$this->txtName->Text = $this->objBox->Name;
		$this->txtName->CssClass = 'fs18 bld';
		$this->txtName->Required = true;
		$this->txtName->MaxLength = Box::NameMaxLength;
	}

	// Create and Setup lstRack
	protected function lstRack_Create() {
		$this->lstRack = new QListBox($this);
		$this->lstRack->Name = QApplication::Translate('Rack');
		$this->lstRack->AddAction(new QChangeEvent(), new QAjaxAction('rackSelected'));
		$this->lstRack->AddItem(QApplication::Translate('- Select One -'), null);
		$objRackArray = Rack::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::Rack()->Name)), null, array('id', 'name'));
		if ($objRackArray) foreach ($objRackArray as $objRack) {
			$objListItem = new QListItem($objRack->__toString(), $objRack->Id);
			if (($this->objBox->Rack) && ($this->objBox->Rack->Id == $objRack->Id))
				$objListItem->Selected = true;
			$this->lstRack->AddItem($objListItem);
		}
	}


	protected function rackSelected() {
		// if a rack is selected then get the freezer and shelf information
		if($this->lstRack->SelectedValue != '') {
			$this->txtShelf->Enabled = $this->txtFreezer->Enabled = false;
			$objRack = Rack::QuerySingle(QQ::Equal(QQN::Rack()->Id, $this->lstRack->SelectedValue), null, null, array('id', 'freezer','shelf'));
			if ($objRack) {
				// if the rack already has a freezer location
				// else we need to specify the freezer location since the rack does not currently have one
				if ($objRack->Freezer != '') {
					$this->txtShelf->Text = $objRack->Shelf;
					$this->txtFreezer->SelectedValue = $objRack->Freezer;
				}
				else{
					$this->txtShelf->Enabled = $this->txtFreezer->Enabled = true;
				}
			}
		}
		else {
			// else the box is just free floating in the freezers so we need to get the freezer and shelf information
			$this->txtShelf->Text = $this->objBox->Shelf;
			$this->txtFreezer->SelectedValue = $this->objBox->Freezer;
			$this->txtShelf->Enabled = $this->txtFreezer->Enabled = true;
		}
	}

	// Create and Setup txtShelf
	protected function txtShelf_Create() {
		$this->txtShelf = new QIntegerTextBox($this);
		$this->txtShelf->Name = QApplication::Translate('Shelf');
	}

	// Create and Setup txtFreezer
	protected function txtFreezer_Create() {
		$objFreezerTempArray = Freezer::QueryArray(QQ::All(),null,null,array('id','name'));
		if ($objFreezerTempArray) foreach ($objFreezerTempArray as $objFreezer) {
			$objFreezerArray[$objFreezer->Id] = $objFreezer->Name;
		}

		$this->txtFreezer = new QListBox($this);
		$this->txtFreezer->Name = QApplication::Translate('Freezer');
		foreach (Freezer::$freezerArray as $freezerCode => $freezerName) {
			// if this is a 'real' freezer
			// else we only have a freezer or box 'state'
			// 			if ($objFreezerArray[$freezerCode] != '')
				// 				$objListItem = new QListItem($objFreezerArray[$freezerCode], $freezerCode);
				// 			else
			$objListItem = new QListItem("(".$freezerCode.") ".Freezer::$freezerArray[$freezerCode], $freezerCode);
				// 			if (($this->objBox->Freezer) && ($this->objBox->Freezer == $freezerCode))
					// 				$objListItem->Selected = true;
				$this->txtFreezer->AddItem($objListItem);
		}

		// show actual freezers
		$objFreezerArray = Freezer::QueryArray(QQ::All(),null,null,array('id','name'));
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$objListItem = new QListItem($objFreezer->__toString(), $objFreezer->Id);
			if (($this->objBox->Freezer) && ($this->objBox->Freezer == $objFreezer->Id))
				$objListItem->Selected = true;
			$this->txtFreezer->AddItem($objListItem);
		}
	}

	// Create and Setup txtIssues
	protected function txtIssues_Create() {
		$this->txtIssues = new QTextBox($this);
		$this->txtIssues->Name = QApplication::Translate('Issues');
		$this->txtIssues->AddAction(new QChangeEvent(), new QAjaxAction('txtIssues_Change'));
		$this->txtIssues->Text = $this->objBox->Issues;
		$this->txtIssues->MaxLength = Box::IssuesMaxLength;
		$this->txtIssues->Width = '100%';
		$this->txtIssues->HtmlAfter = $this->colorWrap("Issue: ".$this->txtIssues->Text);
	}

	protected function txtIssues_Change($strFormId, $strControlId, $strParameter) {
		$this->txtIssues->HtmlAfter = $this->colorWrap("Issue: ".$this->txtIssues->Text);
	}

	protected function colorWrap($t){
		return "<span class='sm cGray'>".$t."</span>";
	}

	// Create and Setup txtDescription
	protected function txtDescription_Create() {
		$this->txtDescription = new QTextBox($this);
		$this->txtDescription->Name = QApplication::Translate('Description');
		$this->txtDescription->Text = $this->objBox->Description;
		$this->txtDescription->MaxLength = Box::DescriptionMaxLength;
		$this->txtDescription->Width = '100%';
	}

	// Create and Setup lstBoxType
	protected function lstBoxType_Create() {
		$this->lstBoxType = new QListBox($this);
		$this->lstBoxType->Width = "100%";
		$this->lstBoxType->Name = QApplication::Translate('Box Type');
		$this->lstBoxType->AddItem(QApplication::Translate('- Select One -'), null);
		$objBoxTypeArray = TypeOfBox::LoadAll();
		if ($objBoxTypeArray) foreach ($objBoxTypeArray as $objBoxType) {
			$objListItem = new QListItem($objBoxType->__toString(), $objBoxType->Id);
			if (($this->objBox->BoxType) && ($this->objBox->BoxType->Id == $objBoxType->Id))
				$objListItem->Selected = true;
			$this->lstBoxType->AddItem($objListItem);
		}
	}

	// Create and Setup lstSampleType
	protected function lstSampleType_Create() {
		$this->lstSampleType = new QListBox($this);
		$this->lstSampleType->Name = QApplication::Translate('Sample Type');
		$this->lstSampleType->AddItem(QApplication::Translate('- Select One -'), null);
		$objSampleTypeArray = SampleTypes::LoadAll();
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			if (($this->objBox->SampleType) && ($this->objBox->SampleType->Id == $objSampleType->Id))
				$objListItem->Selected = true;
			$this->lstSampleType->AddItem($objListItem);
		}
	}

	// Protected Update Methods
	protected function UpdateBoxFields() {
		// log the update action (we will save the data before it is updated)
		if ($this->objBox->Id) ActionLog::LogBoxAction(1,$this->objBox);

		$this->objBox->Name = $this->txtName->Text;
		$this->objBox->RackId = $this->lstRack->SelectedValue;
		$this->objBox->Shelf = $this->txtShelf->Text;
		$this->objBox->Freezer = $this->txtFreezer->SelectedValue;
		$this->objBox->Issues = $this->txtIssues->Text;
		$this->objBox->Description = $this->txtDescription->Text;
		$this->objBox->BoxTypeId = $this->lstBoxType->SelectedValue;
		$this->objBox->SampleTypeId = $this->lstSampleType->SelectedValue;
		$this->objBox->Complete = $this->chkComplete->Checked;
		if ($this->objBox->Created == '')
			$this->objBox->Created = QDateTime::Now(true);

		// log the insert action (save the data as inserted)
		if (!$this->objBox->Id) ActionLog::LogBoxAction(2,$this->objBox);

	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('box_edit');
?>