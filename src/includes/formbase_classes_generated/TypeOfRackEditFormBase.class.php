<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the TypeOfRack class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single TypeOfRack object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this TypeOfRackEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class TypeOfRackEditFormBase extends QForm {
		// General Form Variables
		protected $objTypeOfRack;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for TypeOfRack's Data Fields
		protected $lblId;
		protected $txtName;
		protected $txtWidth;
		protected $txtHeight;
		protected $txtDepth;
		protected $txtRows;
		protected $txtColumns;
		protected $txtBoxCount;
		protected $txtBoxType;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupTypeOfRack() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objTypeOfRack = TypeOfRack::Load(($intId));

				if (!$this->objTypeOfRack)
					throw new Exception('Could not find a TypeOfRack object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objTypeOfRack = new TypeOfRack();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupTypeOfRack to either Load/Edit Existing or Create New
			$this->SetupTypeOfRack();

			// Create/Setup Controls for TypeOfRack's Data Fields
			$this->lblId_Create();
			$this->txtName_Create();
			$this->txtWidth_Create();
			$this->txtHeight_Create();
			$this->txtDepth_Create();
			$this->txtRows_Create();
			$this->txtColumns_Create();
			$this->txtBoxCount_Create();
			$this->txtBoxType_Create();

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
				$this->lblId->Text = $this->objTypeOfRack->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objTypeOfRack->Name;
			$this->txtName->Required = true;
			$this->txtName->MaxLength = TypeOfRack::NameMaxLength;
		}

		// Create and Setup txtWidth
		protected function txtWidth_Create() {
			$this->txtWidth = new QFloatTextBox($this);
			$this->txtWidth->Name = QApplication::Translate('Width');
			$this->txtWidth->Text = $this->objTypeOfRack->Width;
		}

		// Create and Setup txtHeight
		protected function txtHeight_Create() {
			$this->txtHeight = new QFloatTextBox($this);
			$this->txtHeight->Name = QApplication::Translate('Height');
			$this->txtHeight->Text = $this->objTypeOfRack->Height;
		}

		// Create and Setup txtDepth
		protected function txtDepth_Create() {
			$this->txtDepth = new QFloatTextBox($this);
			$this->txtDepth->Name = QApplication::Translate('Depth');
			$this->txtDepth->Text = $this->objTypeOfRack->Depth;
		}

		// Create and Setup txtRows
		protected function txtRows_Create() {
			$this->txtRows = new QIntegerTextBox($this);
			$this->txtRows->Name = QApplication::Translate('Rows');
			$this->txtRows->Text = $this->objTypeOfRack->Rows;
		}

		// Create and Setup txtColumns
		protected function txtColumns_Create() {
			$this->txtColumns = new QIntegerTextBox($this);
			$this->txtColumns->Name = QApplication::Translate('Columns');
			$this->txtColumns->Text = $this->objTypeOfRack->Columns;
		}

		// Create and Setup txtBoxCount
		protected function txtBoxCount_Create() {
			$this->txtBoxCount = new QIntegerTextBox($this);
			$this->txtBoxCount->Name = QApplication::Translate('Box Count');
			$this->txtBoxCount->Text = $this->objTypeOfRack->BoxCount;
		}

		// Create and Setup txtBoxType
		protected function txtBoxType_Create() {
			$this->txtBoxType = new QIntegerTextBox($this);
			$this->txtBoxType->Name = QApplication::Translate('Box Type');
			$this->txtBoxType->Text = $this->objTypeOfRack->BoxType;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'TypeOfRack')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateTypeOfRackFields() {
			$this->objTypeOfRack->Name = $this->txtName->Text;
			$this->objTypeOfRack->Width = $this->txtWidth->Text;
			$this->objTypeOfRack->Height = $this->txtHeight->Text;
			$this->objTypeOfRack->Depth = $this->txtDepth->Text;
			$this->objTypeOfRack->Rows = $this->txtRows->Text;
			$this->objTypeOfRack->Columns = $this->txtColumns->Text;
			$this->objTypeOfRack->BoxCount = $this->txtBoxCount->Text;
			$this->objTypeOfRack->BoxType = $this->txtBoxType->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateTypeOfRackFields();
			$this->objTypeOfRack->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objTypeOfRack->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('type_of_rack_list.php');
		}
	}
?>