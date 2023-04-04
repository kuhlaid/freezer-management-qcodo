<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the FrzInventory class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single FrzInventory object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FrzInventoryEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FrzInventoryEditFormBase extends QForm {
		// General Form Variables
		protected $objFrzInventory;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for FrzInventory's Data Fields
		protected $txtSampleid;
		protected $txtSampleloc;
		protected $txtBoxid;
		protected $lblId;
		protected $txtStudy;
		protected $txtStudyCase;
		protected $txtSampleType;
		protected $txtSampleNumber;
		protected $lstBoxIdentObject;
		protected $txtStudyTypeId;
		protected $txtSampleTypeId;
		protected $txtParticipantId;
		protected $txtSampleLocId;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupFrzInventory() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objFrzInventory = FrzInventory::Load(($intId));

				if (!$this->objFrzInventory)
					throw new Exception('Could not find a FrzInventory object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objFrzInventory = new FrzInventory();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupFrzInventory to either Load/Edit Existing or Create New
			$this->SetupFrzInventory();

			// Create/Setup Controls for FrzInventory's Data Fields
			$this->txtSampleid_Create();
			$this->txtSampleloc_Create();
			$this->txtBoxid_Create();
			$this->lblId_Create();
			$this->txtStudy_Create();
			$this->txtStudyCase_Create();
			$this->txtSampleType_Create();
			$this->txtSampleNumber_Create();
			$this->lstBoxIdentObject_Create();
			$this->txtStudyTypeId_Create();
			$this->txtSampleTypeId_Create();
			$this->txtParticipantId_Create();
			$this->txtSampleLocId_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup txtSampleid
		protected function txtSampleid_Create() {
			$this->txtSampleid = new QTextBox($this);
			$this->txtSampleid->Name = QApplication::Translate('Sampleid');
			$this->txtSampleid->Text = $this->objFrzInventory->Sampleid;
			$this->txtSampleid->Required = true;
			$this->txtSampleid->MaxLength = FrzInventory::SampleidMaxLength;
		}

		// Create and Setup txtSampleloc
		protected function txtSampleloc_Create() {
			$this->txtSampleloc = new QTextBox($this);
			$this->txtSampleloc->Name = QApplication::Translate('Sampleloc');
			$this->txtSampleloc->Text = $this->objFrzInventory->Sampleloc;
			$this->txtSampleloc->MaxLength = FrzInventory::SamplelocMaxLength;
		}

		// Create and Setup txtBoxid
		protected function txtBoxid_Create() {
			$this->txtBoxid = new QTextBox($this);
			$this->txtBoxid->Name = QApplication::Translate('Boxid');
			$this->txtBoxid->Text = $this->objFrzInventory->Boxid;
			$this->txtBoxid->MaxLength = FrzInventory::BoxidMaxLength;
		}

		// Create and Setup lblId
		protected function lblId_Create() {
			$this->lblId = new QLabel($this);
			$this->lblId->Name = QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objFrzInventory->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtStudy
		protected function txtStudy_Create() {
			$this->txtStudy = new QTextBox($this);
			$this->txtStudy->Name = QApplication::Translate('Study');
			$this->txtStudy->Text = $this->objFrzInventory->Study;
			$this->txtStudy->MaxLength = FrzInventory::StudyMaxLength;
		}

		// Create and Setup txtStudyCase
		protected function txtStudyCase_Create() {
			$this->txtStudyCase = new QTextBox($this);
			$this->txtStudyCase->Name = QApplication::Translate('Study Case');
			$this->txtStudyCase->Text = $this->objFrzInventory->StudyCase;
			$this->txtStudyCase->MaxLength = FrzInventory::StudyCaseMaxLength;
		}

		// Create and Setup txtSampleType
		protected function txtSampleType_Create() {
			$this->txtSampleType = new QTextBox($this);
			$this->txtSampleType->Name = QApplication::Translate('Sample Type');
			$this->txtSampleType->Text = $this->objFrzInventory->SampleType;
			$this->txtSampleType->MaxLength = FrzInventory::SampleTypeMaxLength;
		}

		// Create and Setup txtSampleNumber
		protected function txtSampleNumber_Create() {
			$this->txtSampleNumber = new QIntegerTextBox($this);
			$this->txtSampleNumber->Name = QApplication::Translate('Sample Number');
			$this->txtSampleNumber->Text = $this->objFrzInventory->SampleNumber;
		}

		// Create and Setup lstBoxIdentObject
		protected function lstBoxIdentObject_Create() {
			$this->lstBoxIdentObject = new QListBox($this);
			$this->lstBoxIdentObject->Name = QApplication::Translate('Box Ident Object');
			$this->lstBoxIdentObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objBoxIdentObjectArray = Box::LoadAll();
			if ($objBoxIdentObjectArray) foreach ($objBoxIdentObjectArray as $objBoxIdentObject) {
				$objListItem = new QListItem($objBoxIdentObject->__toString(), $objBoxIdentObject->Id);
				if (($this->objFrzInventory->BoxIdentObject) && ($this->objFrzInventory->BoxIdentObject->Id == $objBoxIdentObject->Id))
					$objListItem->Selected = true;
				$this->lstBoxIdentObject->AddItem($objListItem);
			}
		}

		// Create and Setup txtStudyTypeId
		protected function txtStudyTypeId_Create() {
			$this->txtStudyTypeId = new QIntegerTextBox($this);
			$this->txtStudyTypeId->Name = QApplication::Translate('Study Type Id');
			$this->txtStudyTypeId->Text = $this->objFrzInventory->StudyTypeId;
		}

		// Create and Setup txtSampleTypeId
		protected function txtSampleTypeId_Create() {
			$this->txtSampleTypeId = new QIntegerTextBox($this);
			$this->txtSampleTypeId->Name = QApplication::Translate('Sample Type Id');
			$this->txtSampleTypeId->Text = $this->objFrzInventory->SampleTypeId;
		}

		// Create and Setup txtParticipantId
		protected function txtParticipantId_Create() {
			$this->txtParticipantId = new QIntegerTextBox($this);
			$this->txtParticipantId->Name = QApplication::Translate('Participant Id');
			$this->txtParticipantId->Text = $this->objFrzInventory->ParticipantId;
		}

		// Create and Setup txtSampleLocId
		protected function txtSampleLocId_Create() {
			$this->txtSampleLocId = new QIntegerTextBox($this);
			$this->txtSampleLocId->Name = QApplication::Translate('Sample Loc Id');
			$this->txtSampleLocId->Text = $this->objFrzInventory->SampleLocId;
		}


		// Setup btnSave
		protected function btnSave_Create() {
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'FrzInventory')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateFrzInventoryFields() {
			$this->objFrzInventory->Sampleid = $this->txtSampleid->Text;
			$this->objFrzInventory->Sampleloc = $this->txtSampleloc->Text;
			$this->objFrzInventory->Boxid = $this->txtBoxid->Text;
			$this->objFrzInventory->Study = $this->txtStudy->Text;
			$this->objFrzInventory->StudyCase = $this->txtStudyCase->Text;
			$this->objFrzInventory->SampleType = $this->txtSampleType->Text;
			$this->objFrzInventory->SampleNumber = $this->txtSampleNumber->Text;
			$this->objFrzInventory->BoxIdent = $this->lstBoxIdentObject->SelectedValue;
			$this->objFrzInventory->StudyTypeId = $this->txtStudyTypeId->Text;
			$this->objFrzInventory->SampleTypeId = $this->txtSampleTypeId->Text;
			$this->objFrzInventory->ParticipantId = $this->txtParticipantId->Text;
			$this->objFrzInventory->SampleLocId = $this->txtSampleLocId->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateFrzInventoryFields();
			$this->objFrzInventory->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objFrzInventory->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('frz_inventory_list.php');
		}
	}
?>