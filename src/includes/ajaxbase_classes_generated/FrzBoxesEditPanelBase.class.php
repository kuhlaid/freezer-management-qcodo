<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the FrzBoxes class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single FrzBoxes object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this FrzBoxesEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class FrzBoxesEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objFrzBoxes;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for FrzBoxes's Data Fields
	public $txtBoxid;
	public $txtRack;
	public $txtShelf;
	public $txtFreezer;
	public $lblId;
	public $txtIssues;
	public $txtDescription;
	public $txtBoxTypeId;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupFrzBoxes($objFrzBoxes) {
		if ($objFrzBoxes) {
			$this->objFrzBoxes = $objFrzBoxes;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objFrzBoxes = new FrzBoxes();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objFrzBoxes = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupFrzBoxes to either Load/Edit Existing or Create New
		$this->SetupFrzBoxes($objFrzBoxes);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for FrzBoxes's Data Fields
		$this->txtBoxid_Create();
		$this->txtRack_Create();
		$this->txtShelf_Create();
		$this->txtFreezer_Create();
		$this->lblId_Create();
		$this->txtIssues_Create();
		$this->txtDescription_Create();
		$this->txtBoxTypeId_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
	}

	// Protected Create Methods
	// Create and Setup txtBoxid
	protected function txtBoxid_Create() {
		$this->txtBoxid = new QTextBox($this);
		$this->txtBoxid->Name = QApplication::Translate('Boxid');
		$this->txtBoxid->Text = $this->objFrzBoxes->Boxid;
		$this->txtBoxid->Required = true;
		$this->txtBoxid->MaxLength = FrzBoxes::BoxidMaxLength;
	}

	// Create and Setup txtRack
	protected function txtRack_Create() {
		$this->txtRack = new QTextBox($this);
		$this->txtRack->Name = QApplication::Translate('Rack');
		$this->txtRack->Text = $this->objFrzBoxes->Rack;
		$this->txtRack->MaxLength = FrzBoxes::RackMaxLength;
	}

	// Create and Setup txtShelf
	protected function txtShelf_Create() {
		$this->txtShelf = new QIntegerTextBox($this);
		$this->txtShelf->Name = QApplication::Translate('Shelf');
		$this->txtShelf->Text = $this->objFrzBoxes->Shelf;
	}

	// Create and Setup txtFreezer
	protected function txtFreezer_Create() {
		$this->txtFreezer = new QIntegerTextBox($this);
		$this->txtFreezer->Name = QApplication::Translate('Freezer');
		$this->txtFreezer->Text = $this->objFrzBoxes->Freezer;
	}

	// Create and Setup lblId
	protected function lblId_Create() {
		$this->lblId = new QLabel($this);
		$this->lblId->Name = QApplication::Translate('Id');
		if ($this->blnEditMode)
			$this->lblId->Text = $this->objFrzBoxes->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup txtIssues
	protected function txtIssues_Create() {
		$this->txtIssues = new QTextBox($this);
		$this->txtIssues->Name = QApplication::Translate('Issues');
		$this->txtIssues->Text = $this->objFrzBoxes->Issues;
		$this->txtIssues->MaxLength = FrzBoxes::IssuesMaxLength;
	}

	// Create and Setup txtDescription
	protected function txtDescription_Create() {
		$this->txtDescription = new QTextBox($this);
		$this->txtDescription->Name = QApplication::Translate('Description');
		$this->txtDescription->Text = $this->objFrzBoxes->Description;
		$this->txtDescription->MaxLength = FrzBoxes::DescriptionMaxLength;
	}

	// Create and Setup txtBoxTypeId
	protected function txtBoxTypeId_Create() {
		$this->txtBoxTypeId = new QIntegerTextBox($this);
		$this->txtBoxTypeId->Name = QApplication::Translate('Box Type Id');
		$this->txtBoxTypeId->Text = $this->objFrzBoxes->BoxTypeId;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'FrzBoxes')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateFrzBoxesFields() {
		$this->objFrzBoxes->Boxid = $this->txtBoxid->Text;
		$this->objFrzBoxes->Rack = $this->txtRack->Text;
		$this->objFrzBoxes->Shelf = $this->txtShelf->Text;
		$this->objFrzBoxes->Freezer = $this->txtFreezer->Text;
		$this->objFrzBoxes->Issues = $this->txtIssues->Text;
		$this->objFrzBoxes->Description = $this->txtDescription->Text;
		$this->objFrzBoxes->BoxTypeId = $this->txtBoxTypeId->Text;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateFrzBoxesFields();
		$this->objFrzBoxes->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objFrzBoxes->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>