<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the BoxSampleSlot class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single BoxSampleSlot object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this BoxSampleSlotEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class BoxSampleSlotEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objBoxSampleSlot;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for BoxSampleSlot's Data Fields
	public $lblId;
	public $txtSlotName;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupBoxSampleSlot($objBoxSampleSlot) {
		if ($objBoxSampleSlot) {
			$this->objBoxSampleSlot = $objBoxSampleSlot;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objBoxSampleSlot = new BoxSampleSlot();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objBoxSampleSlot = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupBoxSampleSlot to either Load/Edit Existing or Create New
		$this->SetupBoxSampleSlot($objBoxSampleSlot);
		$this->strClosePanelMethod = $strClosePanelMethod;

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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'BoxSampleSlot')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateBoxSampleSlotFields() {
		$this->objBoxSampleSlot->SlotName = $this->txtSlotName->Text;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateBoxSampleSlotFields();
		$this->objBoxSampleSlot->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objBoxSampleSlot->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>