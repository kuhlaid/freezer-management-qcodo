<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the SampleTypes class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single SampleTypes object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleTypesEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleTypesEditFormBase extends QForm {
		// General Form Variables
		protected $objSampleTypes;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for SampleTypes's Data Fields
		protected $lblId;
		protected $txtLetter;
		protected $txtDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupSampleTypes() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objSampleTypes = SampleTypes::Load(($intId));

				if (!$this->objSampleTypes)
					throw new Exception('Could not find a SampleTypes object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objSampleTypes = new SampleTypes();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupSampleTypes to either Load/Edit Existing or Create New
			$this->SetupSampleTypes();

			// Create/Setup Controls for SampleTypes's Data Fields
			$this->lblId_Create();
			$this->txtLetter_Create();
			$this->txtDescription_Create();

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
				$this->lblId->Text = $this->objSampleTypes->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtLetter
		protected function txtLetter_Create() {
			$this->txtLetter = new QTextBox($this);
			$this->txtLetter->Name = QApplication::Translate('Letter');
			$this->txtLetter->Text = $this->objSampleTypes->Letter;
			$this->txtLetter->Required = true;
			$this->txtLetter->MaxLength = SampleTypes::LetterMaxLength;
		}

		// Create and Setup txtDescription
		protected function txtDescription_Create() {
			$this->txtDescription = new QTextBox($this);
			$this->txtDescription->Name = QApplication::Translate('Description');
			$this->txtDescription->Text = $this->objSampleTypes->Description;
			$this->txtDescription->Required = true;
			$this->txtDescription->MaxLength = SampleTypes::DescriptionMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'SampleTypes')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateSampleTypesFields() {
			$this->objSampleTypes->Letter = $this->txtLetter->Text;
			$this->objSampleTypes->Description = $this->txtDescription->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateSampleTypesFields();
			$this->objSampleTypes->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objSampleTypes->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('sample_types_list.php');
		}
	}
?>