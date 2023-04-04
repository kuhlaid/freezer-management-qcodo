<?php
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/TypeOfBoxEditFormBase.class.php');
QApplication::CheckRemoteAdmin();

class TypeOfBoxEditForm8 extends TypeOfBoxEditFormBase {
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


	protected function RedirectToListPage() {
		QApplication::Redirect('types_of_boxes.php');
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('type_of_box');
?>