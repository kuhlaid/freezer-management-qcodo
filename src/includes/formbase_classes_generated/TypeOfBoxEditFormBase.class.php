<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the TypeOfBox class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single TypeOfBox object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this TypeOfBoxEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class TypeOfBoxEditFormBase extends QForm {
		// General Form Variables
		protected $objTypeOfBox;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for TypeOfBox's Data Fields
		protected $lblId;
		protected $txtName;
		protected $txtWidth;
		protected $txtHeight;
		protected $txtRows;
		protected $txtColumns;
		protected $txtDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupTypeOfBox() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objTypeOfBox = TypeOfBox::Load(($intId));

				if (!$this->objTypeOfBox)
					throw new Exception('Could not find a TypeOfBox object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objTypeOfBox = new TypeOfBox();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupTypeOfBox to either Load/Edit Existing or Create New
			$this->SetupTypeOfBox();

			// Create/Setup Controls for TypeOfBox's Data Fields
			$this->lblId_Create();
			$this->txtName_Create();
			$this->txtWidth_Create();
			$this->txtHeight_Create();
			$this->txtRows_Create();
			$this->txtColumns_Create();
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
				$this->lblId->Text = $this->objTypeOfBox->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objTypeOfBox->Name;
			$this->txtName->Required = true;
			$this->txtName->MaxLength = TypeOfBox::NameMaxLength;
		}

		// Create and Setup txtWidth
		protected function txtWidth_Create() {
			$this->txtWidth = new QFloatTextBox($this);
			$this->txtWidth->Name = QApplication::Translate('Width');
			$this->txtWidth->Text = $this->objTypeOfBox->Width;
		}

		// Create and Setup txtHeight
		protected function txtHeight_Create() {
			$this->txtHeight = new QFloatTextBox($this);
			$this->txtHeight->Name = QApplication::Translate('Height');
			$this->txtHeight->Text = $this->objTypeOfBox->Height;
		}

		// Create and Setup txtRows
		protected function txtRows_Create() {
			$this->txtRows = new QIntegerTextBox($this);
			$this->txtRows->Name = QApplication::Translate('Rows');
			$this->txtRows->Text = $this->objTypeOfBox->Rows;
		}

		// Create and Setup txtColumns
		protected function txtColumns_Create() {
			$this->txtColumns = new QIntegerTextBox($this);
			$this->txtColumns->Name = QApplication::Translate('Columns');
			$this->txtColumns->Text = $this->objTypeOfBox->Columns;
		}

		// Create and Setup txtDescription
		protected function txtDescription_Create() {
			$this->txtDescription = new QTextBox($this);
			$this->txtDescription->Name = QApplication::Translate('Description');
			$this->txtDescription->Text = $this->objTypeOfBox->Description;
			$this->txtDescription->MaxLength = TypeOfBox::DescriptionMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'TypeOfBox')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateTypeOfBoxFields() {
			$this->objTypeOfBox->Name = $this->txtName->Text;
			$this->objTypeOfBox->Width = $this->txtWidth->Text;
			$this->objTypeOfBox->Height = $this->txtHeight->Text;
			$this->objTypeOfBox->Rows = $this->txtRows->Text;
			$this->objTypeOfBox->Columns = $this->txtColumns->Text;
			$this->objTypeOfBox->Description = $this->txtDescription->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateTypeOfBoxFields();
			$this->objTypeOfBox->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objTypeOfBox->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('type_of_box_list.php');
		}
	}
?>