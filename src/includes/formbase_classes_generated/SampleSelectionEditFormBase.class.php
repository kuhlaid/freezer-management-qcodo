<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the SampleSelection class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single SampleSelection object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleSelectionEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleSelectionEditFormBase extends QForm {
		// General Form Variables
		protected $objSampleSelection;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for SampleSelection's Data Fields
		protected $lblId;
		protected $txtParticipantSelect;
		protected $txtSampleType;
		protected $txtStudySelect;
		protected $txtSampleSelect;
		protected $txtDescription;
		protected $chkLock;
		protected $chkSamplesTransferred;
		protected $calDateSelected;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupSampleSelection() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objSampleSelection = SampleSelection::Load(($intId));

				if (!$this->objSampleSelection)
					throw new Exception('Could not find a SampleSelection object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objSampleSelection = new SampleSelection();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupSampleSelection to either Load/Edit Existing or Create New
			$this->SetupSampleSelection();

			// Create/Setup Controls for SampleSelection's Data Fields
			$this->lblId_Create();
			$this->txtParticipantSelect_Create();
			$this->txtSampleType_Create();
			$this->txtStudySelect_Create();
			$this->txtSampleSelect_Create();
			$this->txtDescription_Create();
			$this->chkLock_Create();
			$this->chkSamplesTransferred_Create();
			$this->calDateSelected_Create();

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
				$this->lblId->Text = $this->objSampleSelection->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtParticipantSelect
		protected function txtParticipantSelect_Create() {
			$this->txtParticipantSelect = new QTextBox($this);
			$this->txtParticipantSelect->Name = QApplication::Translate('Participant Select');
			$this->txtParticipantSelect->Text = $this->objSampleSelection->ParticipantSelect;
			$this->txtParticipantSelect->MaxLength = SampleSelection::ParticipantSelectMaxLength;
		}

		// Create and Setup txtSampleType
		protected function txtSampleType_Create() {
			$this->txtSampleType = new QIntegerTextBox($this);
			$this->txtSampleType->Name = QApplication::Translate('Sample Type');
			$this->txtSampleType->Text = $this->objSampleSelection->SampleType;
		}

		// Create and Setup txtStudySelect
		protected function txtStudySelect_Create() {
			$this->txtStudySelect = new QTextBox($this);
			$this->txtStudySelect->Name = QApplication::Translate('Study Select');
			$this->txtStudySelect->Text = $this->objSampleSelection->StudySelect;
			$this->txtStudySelect->MaxLength = SampleSelection::StudySelectMaxLength;
		}

		// Create and Setup txtSampleSelect
		protected function txtSampleSelect_Create() {
			$this->txtSampleSelect = new QTextBox($this);
			$this->txtSampleSelect->Name = QApplication::Translate('Sample Select');
			$this->txtSampleSelect->Text = $this->objSampleSelection->SampleSelect;
			$this->txtSampleSelect->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup txtDescription
		protected function txtDescription_Create() {
			$this->txtDescription = new QTextBox($this);
			$this->txtDescription->Name = QApplication::Translate('Description');
			$this->txtDescription->Text = $this->objSampleSelection->Description;
			$this->txtDescription->MaxLength = SampleSelection::DescriptionMaxLength;
		}

		// Create and Setup chkLock
		protected function chkLock_Create() {
			$this->chkLock = new QCheckBox($this);
			$this->chkLock->Name = QApplication::Translate('Lock');
			$this->chkLock->Checked = $this->objSampleSelection->Lock;
		}

		// Create and Setup chkSamplesTransferred
		protected function chkSamplesTransferred_Create() {
			$this->chkSamplesTransferred = new QCheckBox($this);
			$this->chkSamplesTransferred->Name = QApplication::Translate('Samples Transferred');
			$this->chkSamplesTransferred->Checked = $this->objSampleSelection->SamplesTransferred;
		}

		// Create and Setup calDateSelected
		protected function calDateSelected_Create() {
			$this->calDateSelected = new QDateTimePicker($this);
			$this->calDateSelected->Name = QApplication::Translate('Date Selected');
			$this->calDateSelected->DateTime = $this->objSampleSelection->DateSelected;
			$this->calDateSelected->DateTimePickerType = QDateTimePickerType::Date;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'SampleSelection')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateSampleSelectionFields() {
			$this->objSampleSelection->ParticipantSelect = $this->txtParticipantSelect->Text;
			$this->objSampleSelection->SampleType = $this->txtSampleType->Text;
			$this->objSampleSelection->StudySelect = $this->txtStudySelect->Text;
			$this->objSampleSelection->SampleSelect = $this->txtSampleSelect->Text;
			$this->objSampleSelection->Description = $this->txtDescription->Text;
			$this->objSampleSelection->Lock = $this->chkLock->Checked;
			$this->objSampleSelection->SamplesTransferred = $this->chkSamplesTransferred->Checked;
			$this->objSampleSelection->DateSelected = $this->calDateSelected->DateTime;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateSampleSelectionFields();
			$this->objSampleSelection->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objSampleSelection->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('sample_selection_list.php');
		}
	}
?>