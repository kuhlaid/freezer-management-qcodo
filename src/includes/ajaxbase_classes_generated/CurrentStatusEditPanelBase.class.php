<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the CurrentStatus class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single CurrentStatus object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this CurrentStatusEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class CurrentStatusEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objCurrentStatus;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for CurrentStatus's Data Fields
	public $lblId;
	public $calChanged;
	public $txtCode;
	public $lstParticipant;
	public $txtSetReasonId;
	public $txtReasonOther;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupCurrentStatus($objCurrentStatus) {
		if ($objCurrentStatus) {
			$this->objCurrentStatus = $objCurrentStatus;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objCurrentStatus = new CurrentStatus();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objCurrentStatus = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupCurrentStatus to either Load/Edit Existing or Create New
		$this->SetupCurrentStatus($objCurrentStatus);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for CurrentStatus's Data Fields
		$this->lblId_Create();
		$this->calChanged_Create();
		$this->txtCode_Create();
		$this->lstParticipant_Create();
		$this->txtSetReasonId_Create();
		$this->txtReasonOther_Create();

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
			$this->lblId->Text = $this->objCurrentStatus->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup calChanged
	protected function calChanged_Create() {
		$this->calChanged = new QDateTimePicker($this);
		$this->calChanged->Name = QApplication::Translate('Changed');
		$this->calChanged->DateTime = $this->objCurrentStatus->Changed;
		$this->calChanged->DateTimePickerType = QDateTimePickerType::DateTime;
		$this->calChanged->Required = true;
	}

	// Create and Setup txtCode
	protected function txtCode_Create() {
		$this->txtCode = new QIntegerTextBox($this);
		$this->txtCode->Name = QApplication::Translate('Code');
		$this->txtCode->Text = $this->objCurrentStatus->Code;
		$this->txtCode->Required = true;
	}

	// Create and Setup lstParticipant
	protected function lstParticipant_Create() {
		$this->lstParticipant = new QListBox($this);
		$this->lstParticipant->Name = QApplication::Translate('Participant');
		$this->lstParticipant->Required = true;
		if (!$this->blnEditMode)
			$this->lstParticipant->AddItem(QApplication::Translate('- Select One -'), null);
		$objParticipantArray = Participant::LoadAll();
		if ($objParticipantArray) foreach ($objParticipantArray as $objParticipant) {
			$objListItem = new QListItem($objParticipant->__toString(), $objParticipant->Id);
			if (($this->objCurrentStatus->Participant) && ($this->objCurrentStatus->Participant->Id == $objParticipant->Id))
				$objListItem->Selected = true;
			$this->lstParticipant->AddItem($objListItem);
		}
	}

	// Create and Setup txtSetReasonId
	protected function txtSetReasonId_Create() {
		$this->txtSetReasonId = new QIntegerTextBox($this);
		$this->txtSetReasonId->Name = QApplication::Translate('Set Reason Id');
		$this->txtSetReasonId->Text = $this->objCurrentStatus->SetReasonId;
	}

	// Create and Setup txtReasonOther
	protected function txtReasonOther_Create() {
		$this->txtReasonOther = new QTextBox($this);
		$this->txtReasonOther->Name = QApplication::Translate('Reason Other');
		$this->txtReasonOther->Text = $this->objCurrentStatus->ReasonOther;
		$this->txtReasonOther->MaxLength = CurrentStatus::ReasonOtherMaxLength;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'CurrentStatus')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateCurrentStatusFields() {
		$this->objCurrentStatus->Changed = $this->calChanged->DateTime;
		$this->objCurrentStatus->Code = $this->txtCode->Text;
		$this->objCurrentStatus->ParticipantId = $this->lstParticipant->SelectedValue;
		$this->objCurrentStatus->SetReasonId = $this->txtSetReasonId->Text;
		$this->objCurrentStatus->ReasonOther = $this->txtReasonOther->Text;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateCurrentStatusFields();
		$this->objCurrentStatus->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objCurrentStatus->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>