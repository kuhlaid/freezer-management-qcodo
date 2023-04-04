<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Sample class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Sample object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleEditFormBase extends QForm {
		// General Form Variables
		protected $objSample;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Sample's Data Fields
		protected $lblId;
		protected $lstStudyType;
		protected $txtParticipantId;
		protected $lstSampleType;
		protected $txtSampleNumber;
		protected $txtBarcode;
		protected $txtStudyCase;
		protected $txtSampleloc;
		protected $lstBox;
		protected $txtNotes;
		protected $txtBoxSampleSlot;
		protected $txtParentId;
		protected $lstContainerType;
		protected $lstStateType;
		protected $txtVolume;
		protected $txtVolumeUnit;
		protected $txtConcentration;
		protected $txtConcentrationUnit;
		protected $calStateDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupSample() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objSample = Sample::Load(($intId));

				if (!$this->objSample)
					throw new Exception('Could not find a Sample object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objSample = new Sample();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupSample to either Load/Edit Existing or Create New
			$this->SetupSample();

			// Create/Setup Controls for Sample's Data Fields
			$this->lblId_Create();
			$this->lstStudyType_Create();
			$this->txtParticipantId_Create();
			$this->lstSampleType_Create();
			$this->txtSampleNumber_Create();
			$this->txtBarcode_Create();
			$this->txtStudyCase_Create();
			$this->txtSampleloc_Create();
			$this->lstBox_Create();
			$this->txtNotes_Create();
			$this->txtBoxSampleSlot_Create();
			$this->txtParentId_Create();
			$this->lstContainerType_Create();
			$this->lstStateType_Create();
			$this->txtVolume_Create();
			$this->txtVolumeUnit_Create();
			$this->txtConcentration_Create();
			$this->txtConcentrationUnit_Create();
			$this->calStateDate_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblId
		protected function lblId_Create() {
			$this->lblId = new QLabel($this);
			$this->lblId->Name = QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objSample->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup lstStudyType
		protected function lstStudyType_Create() {
			$this->lstStudyType = new QListBox($this);
			$this->lstStudyType->Name = QApplication::Translate('Study Type');
			$this->lstStudyType->AddItem(QApplication::Translate('- Select One -'), null);
			$objStudyArray = FmStudy::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::FmStudy()->Name)));
			foreach ($objStudyArray as $objStudy)
				$this->lstStudyType->AddItem(new QListItem($objStudy->Name, $objStudy->Id, $this->objSample->StudyTypeId == $objStudy->Id));
		}

		// Create and Setup txtParticipantId
		protected function txtParticipantId_Create() {
			$this->txtParticipantId = new QIntegerTextBox($this);
			$this->txtParticipantId->Name = QApplication::Translate('Participant Id');
			$this->txtParticipantId->Text = $this->objSample->ParticipantId;
		}

		// Create and Setup lstSampleType
		protected function lstSampleType_Create() {
			$this->lstSampleType = new QListBox($this);
			$this->lstSampleType->Name = QApplication::Translate('Sample Type');
			$this->lstSampleType->AddItem(QApplication::Translate('- Select One -'), null);
			$objSampleTypeArray = SampleTypes::LoadAll();
			if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
				$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
				if (($this->objSample->SampleType) && ($this->objSample->SampleType->Id == $objSampleType->Id))
					$objListItem->Selected = true;
				$this->lstSampleType->AddItem($objListItem);
			}
		}

		// Create and Setup txtSampleNumber
		protected function txtSampleNumber_Create() {
			$this->txtSampleNumber = new QIntegerTextBox($this);
			$this->txtSampleNumber->Name = QApplication::Translate('Sample Number');
			$this->txtSampleNumber->Text = $this->objSample->SampleNumber;
		}

		// Create and Setup txtBarcode
		protected function txtBarcode_Create() {
			$this->txtBarcode = new QTextBox($this);
			$this->txtBarcode->Name = QApplication::Translate('Barcode');
			$this->txtBarcode->Text = $this->objSample->Barcode;
			$this->txtBarcode->MaxLength = Sample::BarcodeMaxLength;
		}

		// Create and Setup txtStudyCase
		protected function txtStudyCase_Create() {
			$this->txtStudyCase = new QTextBox($this);
			$this->txtStudyCase->Name = QApplication::Translate('Study Case');
			$this->txtStudyCase->Text = $this->objSample->StudyCase;
			$this->txtStudyCase->MaxLength = Sample::StudyCaseMaxLength;
		}

		// Create and Setup txtSampleloc
		protected function txtSampleloc_Create() {
			$this->txtSampleloc = new QTextBox($this);
			$this->txtSampleloc->Name = QApplication::Translate('Sampleloc');
			$this->txtSampleloc->Text = $this->objSample->Sampleloc;
			$this->txtSampleloc->MaxLength = Sample::SamplelocMaxLength;
		}

		// Create and Setup lstBox
		protected function lstBox_Create() {
			$this->lstBox = new QListBox($this);
			$this->lstBox->Name = QApplication::Translate('Box');
			$this->lstBox->AddItem(QApplication::Translate('- Select One -'), null);
			$objBoxArray = Box::LoadAll();
			if ($objBoxArray) foreach ($objBoxArray as $objBox) {
				$objListItem = new QListItem($objBox->__toString(), $objBox->Id);
				if (($this->objSample->Box) && ($this->objSample->Box->Id == $objBox->Id))
					$objListItem->Selected = true;
				$this->lstBox->AddItem($objListItem);
			}
		}

		// Create and Setup txtNotes
		protected function txtNotes_Create() {
			$this->txtNotes = new QTextBox($this);
			$this->txtNotes->Name = QApplication::Translate('Notes');
			$this->txtNotes->Text = $this->objSample->Notes;
			$this->txtNotes->MaxLength = Sample::NotesMaxLength;
		}

		// Create and Setup txtBoxSampleSlot
		protected function txtBoxSampleSlot_Create() {
			$this->txtBoxSampleSlot = new QIntegerTextBox($this);
			$this->txtBoxSampleSlot->Name = QApplication::Translate('Box Sample Slot');
			$this->txtBoxSampleSlot->Text = $this->objSample->BoxSampleSlot;
		}

		// Create and Setup txtParentId
		protected function txtParentId_Create() {
			$this->txtParentId = new QIntegerTextBox($this);
			$this->txtParentId->Name = QApplication::Translate('Parent Id');
			$this->txtParentId->Text = $this->objSample->ParentId;
		}

		// Create and Setup lstContainerType
		protected function lstContainerType_Create() {
			$this->lstContainerType = new QListBox($this);
			$this->lstContainerType->Name = QApplication::Translate('Container Type');
			$this->lstContainerType->AddItem(QApplication::Translate('- Select One -'), null);
			$objContainerTypeArray = SampleContainerTypes::LoadAll();
			if ($objContainerTypeArray) foreach ($objContainerTypeArray as $objContainerType) {
				$objListItem = new QListItem($objContainerType->__toString(), $objContainerType->Id);
				if (($this->objSample->ContainerType) && ($this->objSample->ContainerType->Id == $objContainerType->Id))
					$objListItem->Selected = true;
				$this->lstContainerType->AddItem($objListItem);
			}
		}

		// Create and Setup lstStateType
		protected function lstStateType_Create() {
			$this->lstStateType = new QListBox($this);
			$this->lstStateType->Name = QApplication::Translate('State Type');
			$this->lstStateType->AddItem(QApplication::Translate('- Select One -'), null);
			$objStateTypeArray = SampleStateTypes::LoadAll();
			if ($objStateTypeArray) foreach ($objStateTypeArray as $objStateType) {
				$objListItem = new QListItem($objStateType->__toString(), $objStateType->Id);
				if (($this->objSample->StateType) && ($this->objSample->StateType->Id == $objStateType->Id))
					$objListItem->Selected = true;
				$this->lstStateType->AddItem($objListItem);
			}
		}

		// Create and Setup txtVolume
		protected function txtVolume_Create() {
			$this->txtVolume = new QFloatTextBox($this);
			$this->txtVolume->Name = QApplication::Translate('Volume');
			$this->txtVolume->Text = $this->objSample->Volume;
		}

		// Create and Setup txtVolumeUnit
		protected function txtVolumeUnit_Create() {
			$this->txtVolumeUnit = new QTextBox($this);
			$this->txtVolumeUnit->Name = QApplication::Translate('Volume Unit');
			$this->txtVolumeUnit->Text = $this->objSample->VolumeUnit;
			$this->txtVolumeUnit->MaxLength = Sample::VolumeUnitMaxLength;
		}

		// Create and Setup txtConcentration
		protected function txtConcentration_Create() {
			$this->txtConcentration = new QFloatTextBox($this);
			$this->txtConcentration->Name = QApplication::Translate('Concentration');
			$this->txtConcentration->Text = $this->objSample->Concentration;
		}

		// Create and Setup txtConcentrationUnit
		protected function txtConcentrationUnit_Create() {
			$this->txtConcentrationUnit = new QTextBox($this);
			$this->txtConcentrationUnit->Name = QApplication::Translate('Concentration Unit');
			$this->txtConcentrationUnit->Text = $this->objSample->ConcentrationUnit;
			$this->txtConcentrationUnit->MaxLength = Sample::ConcentrationUnitMaxLength;
		}

		// Create and Setup calStateDate
		protected function calStateDate_Create() {
			$this->calStateDate = new QDateTimePicker($this);
			$this->calStateDate->Name = QApplication::Translate('State Date');
			$this->calStateDate->DateTime = $this->objSample->StateDate;
			$this->calStateDate->DateTimePickerType = QDateTimePickerType::DateTime;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Sample')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateSampleFields() {
			$this->objSample->StudyTypeId = $this->lstStudyType->SelectedValue;
			$this->objSample->ParticipantId = $this->txtParticipantId->Text;
			$this->objSample->SampleTypeId = $this->lstSampleType->SelectedValue;
			$this->objSample->SampleNumber = $this->txtSampleNumber->Text;
			$this->objSample->Barcode = $this->txtBarcode->Text;
			$this->objSample->StudyCase = $this->txtStudyCase->Text;
			$this->objSample->Sampleloc = $this->txtSampleloc->Text;
			$this->objSample->BoxId = $this->lstBox->SelectedValue;
			$this->objSample->Notes = $this->txtNotes->Text;
			$this->objSample->BoxSampleSlot = $this->txtBoxSampleSlot->Text;
			$this->objSample->ParentId = $this->txtParentId->Text;
			$this->objSample->ContainerTypeId = $this->lstContainerType->SelectedValue;
			$this->objSample->StateTypeId = $this->lstStateType->SelectedValue;
			$this->objSample->Volume = $this->txtVolume->Text;
			$this->objSample->VolumeUnit = $this->txtVolumeUnit->Text;
			$this->objSample->Concentration = $this->txtConcentration->Text;
			$this->objSample->ConcentrationUnit = $this->txtConcentrationUnit->Text;
			$this->objSample->StateDate = $this->calStateDate->DateTime;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateSampleFields();
			$this->objSample->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objSample->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('sample_list.php');
		}
	}
?>