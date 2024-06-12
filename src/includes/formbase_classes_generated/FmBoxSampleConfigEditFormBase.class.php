<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the FmBoxSampleConfig class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single FmBoxSampleConfig object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FmBoxSampleConfigEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FmBoxSampleConfigEditFormBase extends QForm {
		// General Form Variables
		protected $objFmBoxSampleConfig;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for FmBoxSampleConfig's Data Fields
		protected $lblId;
		protected $txtConfig;
		protected $txtDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupFmBoxSampleConfig() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objFmBoxSampleConfig = FmBoxSampleConfig::Load(($intId));

				if (!$this->objFmBoxSampleConfig)
					throw new Exception('Could not find a FmBoxSampleConfig object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objFmBoxSampleConfig = new FmBoxSampleConfig();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupFmBoxSampleConfig to either Load/Edit Existing or Create New
			$this->SetupFmBoxSampleConfig();

			// Create/Setup Controls for FmBoxSampleConfig's Data Fields
			$this->lblId_Create();
			$this->txtConfig_Create();
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
			$this->lblId->Name = QApplication::Translate(' [id]'); 	//QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objFmBoxSampleConfig->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtConfig
		protected function txtConfig_Create() {
			$this->txtConfig = new QTextBox($this);
			$this->txtConfig->Name = QApplication::Translate(' [config]'); 	//QApplication::Translate('Config');
			$this->txtConfig->Text = $this->objFmBoxSampleConfig->Config;
		}

		// Create and Setup txtDescription
		protected function txtDescription_Create() {
			$this->txtDescription = new QTextBox($this);
			$this->txtDescription->Name = QApplication::Translate(' [description]'); 	//QApplication::Translate('Description');
			$this->txtDescription->Text = $this->objFmBoxSampleConfig->Description;
			$this->txtDescription->MaxLength = FmBoxSampleConfig::DescriptionMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'FmBoxSampleConfig')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateFmBoxSampleConfigFields() {
			$this->objFmBoxSampleConfig->Config = $this->txtConfig->Text;
			$this->objFmBoxSampleConfig->Description = $this->txtDescription->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateFmBoxSampleConfigFields();
			$this->objFmBoxSampleConfig->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objFmBoxSampleConfig->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('fm_box_sample_config_list.php');
		}
	}
?>