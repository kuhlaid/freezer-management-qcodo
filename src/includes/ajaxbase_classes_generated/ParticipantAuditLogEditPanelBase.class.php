<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the ParticipantAuditLog class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single ParticipantAuditLog object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this ParticipantAuditLogEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class ParticipantAuditLogEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objParticipantAuditLog;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for ParticipantAuditLog's Data Fields
	public $lblId;
	public $txtParticipantObj;
	public $calModifiedDate;
	public $lstParticipant;
	public $lstModifiedBy;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupParticipantAuditLog($objParticipantAuditLog) {
		if ($objParticipantAuditLog) {
			$this->objParticipantAuditLog = $objParticipantAuditLog;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objParticipantAuditLog = new ParticipantAuditLog();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objParticipantAuditLog = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupParticipantAuditLog to either Load/Edit Existing or Create New
		$this->SetupParticipantAuditLog($objParticipantAuditLog);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for ParticipantAuditLog's Data Fields
		$this->lblId_Create();
		$this->txtParticipantObj_Create();
		$this->calModifiedDate_Create();
		$this->lstParticipant_Create();
		$this->lstModifiedBy_Create();

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
			$this->lblId->Text = $this->objParticipantAuditLog->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup txtParticipantObj
	protected function txtParticipantObj_Create() {
		$this->txtParticipantObj = new QTextBox($this);
		$this->txtParticipantObj->Name = QApplication::Translate('Participant Obj');
		$this->txtParticipantObj->Text = $this->objParticipantAuditLog->ParticipantObj;
		$this->txtParticipantObj->Required = true;
		$this->txtParticipantObj->TextMode = QTextMode::MultiLine;
	}

	// Create and Setup calModifiedDate
	protected function calModifiedDate_Create() {
		$this->calModifiedDate = new QDateTimePicker($this);
		$this->calModifiedDate->Name = QApplication::Translate('Modified Date');
		$this->calModifiedDate->DateTime = $this->objParticipantAuditLog->ModifiedDate;
		$this->calModifiedDate->DateTimePickerType = QDateTimePickerType::DateTime;
		$this->calModifiedDate->Required = true;
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
			if (($this->objParticipantAuditLog->Participant) && ($this->objParticipantAuditLog->Participant->Id == $objParticipant->Id))
				$objListItem->Selected = true;
			$this->lstParticipant->AddItem($objListItem);
		}
	}

	// Create and Setup lstModifiedBy
	protected function lstModifiedBy_Create() {
		$this->lstModifiedBy = new QListBox($this);
		$this->lstModifiedBy->Name = QApplication::Translate('Modified By');
		$this->lstModifiedBy->AddItem(QApplication::Translate('- Select One -'), null);
		$objModifiedByArray = User::LoadAll();
		if ($objModifiedByArray) foreach ($objModifiedByArray as $objModifiedBy) {
			$objListItem = new QListItem($objModifiedBy->__toString(), $objModifiedBy->Userid);
			if (($this->objParticipantAuditLog->ModifiedBy) && ($this->objParticipantAuditLog->ModifiedBy->Userid == $objModifiedBy->Userid))
				$objListItem->Selected = true;
			$this->lstModifiedBy->AddItem($objListItem);
		}
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'ParticipantAuditLog')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateParticipantAuditLogFields() {
		$this->objParticipantAuditLog->ParticipantObj = $this->txtParticipantObj->Text;
		$this->objParticipantAuditLog->ModifiedDate = $this->calModifiedDate->DateTime;
		$this->objParticipantAuditLog->ParticipantId = $this->lstParticipant->SelectedValue;
		$this->objParticipantAuditLog->ModifiedById = $this->lstModifiedBy->SelectedValue;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateParticipantAuditLogFields();
		$this->objParticipantAuditLog->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objParticipantAuditLog->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>