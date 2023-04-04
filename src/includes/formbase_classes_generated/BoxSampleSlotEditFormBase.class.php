<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the BoxSampleSlot class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single BoxSampleSlot object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this BoxSampleSlotEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class BoxSampleSlotEditFormBase extends QForm {
		// General Form Variables
		protected $objBoxSampleSlot;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for BoxSampleSlot's Data Fields
		protected $lblId;
		protected $txtSlotName;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupBoxSampleSlot() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objBoxSampleSlot = BoxSampleSlot::Load(($intId));

				if (!$this->objBoxSampleSlot)
					throw new Exception('Could not find a BoxSampleSlot object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objBoxSampleSlot = new BoxSampleSlot();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupBoxSampleSlot to either Load/Edit Existing or Create New
			$this->SetupBoxSampleSlot();

			// Create/Setup Controls for BoxSampleSlot's Data Fields
			$this->lblId_Create();
			$this->txtSlotName_Create();

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
				$this->lblId->Text = $this->objBoxSampleSlot->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtSlotName
		protected function txtSlotName_Create() {
			$this->txtSlotName = new QTextBox($this);
			$this->txtSlotName->Name = QApplication::Translate('Slot Name');
			$this->txtSlotName->Text = $this->objBoxSampleSlot->SlotName;
			$this->txtSlotName->Required = true;
			$this->txtSlotName->MaxLength = BoxSampleSlot::SlotNameMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'BoxSampleSlot')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateBoxSampleSlotFields() {
			$this->objBoxSampleSlot->SlotName = $this->txtSlotName->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateBoxSampleSlotFields();
			$this->objBoxSampleSlot->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objBoxSampleSlot->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('box_sample_slot_list.php');
		}
	}
?>