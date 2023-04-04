<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the LnTank class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single LnTank object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this LnTankEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class LnTankEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objLnTank;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for LnTank's Data Fields
	public $lblId;
	public $calDateOrdered;
	public $txtCost;
	public $calDateReceived;
	public $calDateAttached;
	public $txtSerialNumber;
	public $txtNote;
	public $calPickedUp;
	public $chkElectronicGauge;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupLnTank($objLnTank) {
		if ($objLnTank) {
			$this->objLnTank = $objLnTank;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objLnTank = new LnTank();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objLnTank = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupLnTank to either Load/Edit Existing or Create New
		$this->SetupLnTank($objLnTank);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for LnTank's Data Fields
		$this->lblId_Create();
		$this->calDateOrdered_Create();
		$this->txtCost_Create();
		$this->calDateReceived_Create();
		$this->calDateAttached_Create();
		$this->txtSerialNumber_Create();
		$this->txtNote_Create();
		$this->calPickedUp_Create();
		$this->chkElectronicGauge_Create();

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
			$this->lblId->Text = $this->objLnTank->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup calDateOrdered
	protected function calDateOrdered_Create() {
		$this->calDateOrdered = new QDateTimePicker($this);
		$this->calDateOrdered->Name = QApplication::Translate('Date Ordered');
		$this->calDateOrdered->DateTime = $this->objLnTank->DateOrdered;
		$this->calDateOrdered->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtCost
	protected function txtCost_Create() {
		$this->txtCost = new QFloatTextBox($this);
		$this->txtCost->Name = QApplication::Translate('Cost');
		$this->txtCost->Text = $this->objLnTank->Cost;
	}

	// Create and Setup calDateReceived
	protected function calDateReceived_Create() {
		$this->calDateReceived = new QDateTimePicker($this);
		$this->calDateReceived->Name = QApplication::Translate('Date Received');
		$this->calDateReceived->DateTime = $this->objLnTank->DateReceived;
		$this->calDateReceived->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calDateAttached
	protected function calDateAttached_Create() {
		$this->calDateAttached = new QDateTimePicker($this);
		$this->calDateAttached->Name = QApplication::Translate('Date Attached');
		$this->calDateAttached->DateTime = $this->objLnTank->DateAttached;
		$this->calDateAttached->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtSerialNumber
	protected function txtSerialNumber_Create() {
		$this->txtSerialNumber = new QTextBox($this);
		$this->txtSerialNumber->Name = QApplication::Translate('Serial Number');
		$this->txtSerialNumber->Text = $this->objLnTank->SerialNumber;
		$this->txtSerialNumber->MaxLength = LnTank::SerialNumberMaxLength;
	}

	// Create and Setup txtNote
	protected function txtNote_Create() {
		$this->txtNote = new QTextBox($this);
		$this->txtNote->Name = QApplication::Translate('Note');
		$this->txtNote->Text = $this->objLnTank->Note;
		$this->txtNote->MaxLength = LnTank::NoteMaxLength;
	}

	// Create and Setup calPickedUp
	protected function calPickedUp_Create() {
		$this->calPickedUp = new QDateTimePicker($this);
		$this->calPickedUp->Name = QApplication::Translate('Picked Up');
		$this->calPickedUp->DateTime = $this->objLnTank->PickedUp;
		$this->calPickedUp->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup chkElectronicGauge
	protected function chkElectronicGauge_Create() {
		$this->chkElectronicGauge = new QCheckBox($this);
		$this->chkElectronicGauge->Name = QApplication::Translate('Electronic Gauge');
		$this->chkElectronicGauge->Checked = $this->objLnTank->ElectronicGauge;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'LnTank')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateLnTankFields() {
		$this->objLnTank->DateOrdered = $this->calDateOrdered->DateTime;
		$this->objLnTank->Cost = $this->txtCost->Text;
		$this->objLnTank->DateReceived = $this->calDateReceived->DateTime;
		$this->objLnTank->DateAttached = $this->calDateAttached->DateTime;
		$this->objLnTank->SerialNumber = $this->txtSerialNumber->Text;
		$this->objLnTank->Note = $this->txtNote->Text;
		$this->objLnTank->PickedUp = $this->calPickedUp->DateTime;
		$this->objLnTank->ElectronicGauge = $this->chkElectronicGauge->Checked;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateLnTankFields();
		$this->objLnTank->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objLnTank->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>