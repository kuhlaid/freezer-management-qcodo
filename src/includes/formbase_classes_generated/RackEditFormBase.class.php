<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Rack class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Rack object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this RackEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class RackEditFormBase extends QForm {
		// General Form Variables
		protected $objRack;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Rack's Data Fields
		protected $lblId;
		protected $txtName;
		protected $lstRackType;
		protected $txtNotes;
		protected $txtShelf;
		protected $txtFreezer;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupRack() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objRack = Rack::Load(($intId));

				if (!$this->objRack)
					throw new Exception('Could not find a Rack object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objRack = new Rack();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupRack to either Load/Edit Existing or Create New
			$this->SetupRack();

			// Create/Setup Controls for Rack's Data Fields
			$this->lblId_Create();
			$this->txtName_Create();
			$this->lstRackType_Create();
			$this->txtNotes_Create();
			$this->txtShelf_Create();
			$this->txtFreezer_Create();

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
				$this->lblId->Text = $this->objRack->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objRack->Name;
			$this->txtName->Required = true;
			$this->txtName->MaxLength = Rack::NameMaxLength;
		}

		// Create and Setup lstRackType
		protected function lstRackType_Create() {
			$this->lstRackType = new QListBox($this);
			$this->lstRackType->Name = QApplication::Translate('Rack Type');
			$this->lstRackType->AddItem(QApplication::Translate('- Select One -'), null);
			$objRackTypeArray = TypeOfRack::LoadAll();
			if ($objRackTypeArray) foreach ($objRackTypeArray as $objRackType) {
				$objListItem = new QListItem($objRackType->__toString(), $objRackType->Id);
				if (($this->objRack->RackType) && ($this->objRack->RackType->Id == $objRackType->Id))
					$objListItem->Selected = true;
				$this->lstRackType->AddItem($objListItem);
			}
		}

		// Create and Setup txtNotes
		protected function txtNotes_Create() {
			$this->txtNotes = new QTextBox($this);
			$this->txtNotes->Name = QApplication::Translate('Notes');
			$this->txtNotes->Text = $this->objRack->Notes;
			$this->txtNotes->MaxLength = Rack::NotesMaxLength;
		}

		// Create and Setup txtShelf
		protected function txtShelf_Create() {
			$this->txtShelf = new QIntegerTextBox($this);
			$this->txtShelf->Name = QApplication::Translate('Shelf');
			$this->txtShelf->Text = $this->objRack->Shelf;
		}

		// Create and Setup txtFreezer
		protected function txtFreezer_Create() {
			$this->txtFreezer = new QIntegerTextBox($this);
			$this->txtFreezer->Name = QApplication::Translate('Freezer');
			$this->txtFreezer->Text = $this->objRack->Freezer;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Rack')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateRackFields() {
			$this->objRack->Name = $this->txtName->Text;
			$this->objRack->RackTypeId = $this->lstRackType->SelectedValue;
			$this->objRack->Notes = $this->txtNotes->Text;
			$this->objRack->Shelf = $this->txtShelf->Text;
			$this->objRack->Freezer = $this->txtFreezer->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateRackFields();
			$this->objRack->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objRack->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('rack_list.php');
		}
	}
?>