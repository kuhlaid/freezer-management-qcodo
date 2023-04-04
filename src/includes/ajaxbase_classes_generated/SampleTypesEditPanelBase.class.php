<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the SampleTypes class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single SampleTypes object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this SampleTypesEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleTypesEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objSampleTypes;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for SampleTypes's Data Fields
	public $lblId;
	public $txtLetter;
	public $txtDescription;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupSampleTypes($objSampleTypes) {
		if ($objSampleTypes) {
			$this->objSampleTypes = $objSampleTypes;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objSampleTypes = new SampleTypes();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objSampleTypes = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupSampleTypes to either Load/Edit Existing or Create New
		$this->SetupSampleTypes($objSampleTypes);
		$this->strClosePanelMethod = $strClosePanelMethod;

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
		$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
		$this->btnSave->PrimaryButton = true;
		$this->btnSave->CausesValidation = true;
	}

	// Setup btnCancel
	protected function btnCancel_Create() {
		$this->btnCancel = new QButton($this);
		$this->btnCancel->Text = QApplication::Translate('Cancel');
		$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));
		$this->btnCancel->CausesValidation = false;
	}

	// Setup btnDelete
	protected function btnDelete_Create() {
		$this->btnDelete = new QButton($this);
		$this->btnDelete->Text = QApplication::Translate('Delete');
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'SampleTypes')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
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
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateSampleTypesFields();
		$this->objSampleTypes->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objSampleTypes->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>