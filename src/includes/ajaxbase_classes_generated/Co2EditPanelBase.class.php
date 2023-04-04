<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the Co2 class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single Co2 object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this Co2EditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class Co2EditPanelBase extends QPanel {
	// General Panel Variables
	protected $objCo2;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for Co2's Data Fields
	public $lblId;
	public $calDateOrdered;
	public $txtCost;
	public $calDateReceived;
	public $calDateAttached;
	public $txtSerialNumber;
	public $txtNote;
	public $calPickedUp;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupCo2($objCo2) {
		if ($objCo2) {
			$this->objCo2 = $objCo2;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objCo2 = new Co2();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objCo2 = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupCo2 to either Load/Edit Existing or Create New
		$this->SetupCo2($objCo2);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for Co2's Data Fields
		$this->lblId_Create();
		$this->calDateOrdered_Create();
		$this->txtCost_Create();
		$this->calDateReceived_Create();
		$this->calDateAttached_Create();
		$this->txtSerialNumber_Create();
		$this->txtNote_Create();
		$this->calPickedUp_Create();

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
			$this->lblId->Text = $this->objCo2->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup calDateOrdered
	protected function calDateOrdered_Create() {
		$this->calDateOrdered = new QDateTimePicker($this);
		$this->calDateOrdered->Name = QApplication::Translate('Date Ordered');
		$this->calDateOrdered->DateTime = $this->objCo2->DateOrdered;
		$this->calDateOrdered->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtCost
	protected function txtCost_Create() {
		$this->txtCost = new QFloatTextBox($this);
		$this->txtCost->Name = QApplication::Translate('Cost');
		$this->txtCost->Text = $this->objCo2->Cost;
	}

	// Create and Setup calDateReceived
	protected function calDateReceived_Create() {
		$this->calDateReceived = new QDateTimePicker($this);
		$this->calDateReceived->Name = QApplication::Translate('Date Received');
		$this->calDateReceived->DateTime = $this->objCo2->DateReceived;
		$this->calDateReceived->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calDateAttached
	protected function calDateAttached_Create() {
		$this->calDateAttached = new QDateTimePicker($this);
		$this->calDateAttached->Name = QApplication::Translate('Date Attached');
		$this->calDateAttached->DateTime = $this->objCo2->DateAttached;
		$this->calDateAttached->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtSerialNumber
	protected function txtSerialNumber_Create() {
		$this->txtSerialNumber = new QTextBox($this);
		$this->txtSerialNumber->Name = QApplication::Translate('Serial Number');
		$this->txtSerialNumber->Text = $this->objCo2->SerialNumber;
		$this->txtSerialNumber->MaxLength = Co2::SerialNumberMaxLength;
	}

	// Create and Setup txtNote
	protected function txtNote_Create() {
		$this->txtNote = new QTextBox($this);
		$this->txtNote->Name = QApplication::Translate('Note');
		$this->txtNote->Text = $this->objCo2->Note;
		$this->txtNote->MaxLength = Co2::NoteMaxLength;
	}

	// Create and Setup calPickedUp
	protected function calPickedUp_Create() {
		$this->calPickedUp = new QDateTimePicker($this);
		$this->calPickedUp->Name = QApplication::Translate('Picked Up');
		$this->calPickedUp->DateTime = $this->objCo2->PickedUp;
		$this->calPickedUp->DateTimePickerType = QDateTimePickerType::Date;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Co2')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateCo2Fields() {
		$this->objCo2->DateOrdered = $this->calDateOrdered->DateTime;
		$this->objCo2->Cost = $this->txtCost->Text;
		$this->objCo2->DateReceived = $this->calDateReceived->DateTime;
		$this->objCo2->DateAttached = $this->calDateAttached->DateTime;
		$this->objCo2->SerialNumber = $this->txtSerialNumber->Text;
		$this->objCo2->Note = $this->txtNote->Text;
		$this->objCo2->PickedUp = $this->calPickedUp->DateTime;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateCo2Fields();
		$this->objCo2->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objCo2->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>