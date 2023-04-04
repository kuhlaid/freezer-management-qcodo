<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the SampleRack class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single SampleRack object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleRackEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleRackEditFormBase extends QForm {
		// General Form Variables
		protected $objSampleRack;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for SampleRack's Data Fields
		protected $lblId;
		protected $txtName;
		protected $txtBoxCount;
		protected $lstRackType;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupSampleRack() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objSampleRack = SampleRack::Load(($intId));

				if (!$this->objSampleRack)
					throw new Exception('Could not find a SampleRack object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objSampleRack = new SampleRack();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupSampleRack to either Load/Edit Existing or Create New
			$this->SetupSampleRack();

			// Create/Setup Controls for SampleRack's Data Fields
			$this->lblId_Create();
			$this->txtName_Create();
			$this->txtBoxCount_Create();
			$this->lstRackType_Create();

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
				$this->lblId->Text = $this->objSampleRack->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objSampleRack->Name;
			$this->txtName->Required = true;
			$this->txtName->MaxLength = SampleRack::NameMaxLength;
		}

		// Create and Setup txtBoxCount
		protected function txtBoxCount_Create() {
			$this->txtBoxCount = new QIntegerTextBox($this);
			$this->txtBoxCount->Name = QApplication::Translate('Box Count');
			$this->txtBoxCount->Text = $this->objSampleRack->BoxCount;
		}

		// Create and Setup lstRackType
		protected function lstRackType_Create() {
			$this->lstRackType = new QListBox($this);
			$this->lstRackType->Name = QApplication::Translate('Rack Type');
			$this->lstRackType->AddItem(QApplication::Translate('- Select One -'), null);
			$objRackTypeArray = Rack::LoadAll();
			if ($objRackTypeArray) foreach ($objRackTypeArray as $objRackType) {
				$objListItem = new QListItem($objRackType->__toString(), $objRackType->Id);
				if (($this->objSampleRack->RackType) && ($this->objSampleRack->RackType->Id == $objRackType->Id))
					$objListItem->Selected = true;
				$this->lstRackType->AddItem($objListItem);
			}
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'SampleRack')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateSampleRackFields() {
			$this->objSampleRack->Name = $this->txtName->Text;
			$this->objSampleRack->BoxCount = $this->txtBoxCount->Text;
			$this->objSampleRack->RackTypeId = $this->lstRackType->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateSampleRackFields();
			$this->objSampleRack->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objSampleRack->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('sample_rack_list.php');
		}
	}
?>