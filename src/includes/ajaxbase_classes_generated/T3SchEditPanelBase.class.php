<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the T3Sch class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single T3Sch object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this T3SchEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class T3SchEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objT3Sch;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for T3Sch's Data Fields
	public $lblId;
	public $lstParticipant;
	public $calScheduleIn;
	public $calScheduleOut;
	public $txtNote;
	public $lstInterviewer;
	public $lstScheduleType;
	public $calCreatedOn;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupT3Sch($objT3Sch) {
		if ($objT3Sch) {
			$this->objT3Sch = $objT3Sch;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objT3Sch = new T3Sch();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objT3Sch = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupT3Sch to either Load/Edit Existing or Create New
		$this->SetupT3Sch($objT3Sch);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for T3Sch's Data Fields
		$this->lblId_Create();
		$this->lstParticipant_Create();
		$this->calScheduleIn_Create();
		$this->calScheduleOut_Create();
		$this->txtNote_Create();
		$this->lstInterviewer_Create();
		$this->lstScheduleType_Create();
		$this->calCreatedOn_Create();

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
			$this->lblId->Text = $this->objT3Sch->Id;
		else
			$this->lblId->Text = 'N/A';
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
			if (($this->objT3Sch->Participant) && ($this->objT3Sch->Participant->Id == $objParticipant->Id))
				$objListItem->Selected = true;
			$this->lstParticipant->AddItem($objListItem);
		}
	}

	// Create and Setup calScheduleIn
	protected function calScheduleIn_Create() {
		$this->calScheduleIn = new QDateTimePicker($this);
		$this->calScheduleIn->Name = QApplication::Translate('Schedule In');
		$this->calScheduleIn->DateTime = $this->objT3Sch->ScheduleIn;
		$this->calScheduleIn->DateTimePickerType = QDateTimePickerType::DateTime;
		$this->calScheduleIn->Required = true;
	}

	// Create and Setup calScheduleOut
	protected function calScheduleOut_Create() {
		$this->calScheduleOut = new QDateTimePicker($this);
		$this->calScheduleOut->Name = QApplication::Translate('Schedule Out');
		$this->calScheduleOut->DateTime = $this->objT3Sch->ScheduleOut;
		$this->calScheduleOut->DateTimePickerType = QDateTimePickerType::DateTime;
		$this->calScheduleOut->Required = true;
	}

	// Create and Setup txtNote
	protected function txtNote_Create() {
		$this->txtNote = new QTextBox($this);
		$this->txtNote->Name = QApplication::Translate('Note');
		$this->txtNote->Text = $this->objT3Sch->Note;
		$this->txtNote->MaxLength = T3Sch::NoteMaxLength;
	}

	// Create and Setup lstInterviewer
	protected function lstInterviewer_Create() {
		$this->lstInterviewer = new QListBox($this);
		$this->lstInterviewer->Name = QApplication::Translate('Interviewer');
		$this->lstInterviewer->AddItem(QApplication::Translate('- Select One -'), null);
		$objInterviewerArray = User::LoadAll();
		if ($objInterviewerArray) foreach ($objInterviewerArray as $objInterviewer) {
			$objListItem = new QListItem($objInterviewer->__toString(), $objInterviewer->Userid);
			if (($this->objT3Sch->Interviewer) && ($this->objT3Sch->Interviewer->Userid == $objInterviewer->Userid))
				$objListItem->Selected = true;
			$this->lstInterviewer->AddItem($objListItem);
		}
	}

	// Create and Setup lstScheduleType
	protected function lstScheduleType_Create() {
		$this->lstScheduleType = new QListBox($this);
		$this->lstScheduleType->Name = QApplication::Translate('Schedule Type');
		$this->lstScheduleType->AddItem(QApplication::Translate('- Select One -'), null);
		$objScheduleTypeArray = T3SchTyp::LoadAll();
		if ($objScheduleTypeArray) foreach ($objScheduleTypeArray as $objScheduleType) {
			$objListItem = new QListItem($objScheduleType->__toString(), $objScheduleType->Id);
			if (($this->objT3Sch->ScheduleType) && ($this->objT3Sch->ScheduleType->Id == $objScheduleType->Id))
				$objListItem->Selected = true;
			$this->lstScheduleType->AddItem($objListItem);
		}
	}

	// Create and Setup calCreatedOn
	protected function calCreatedOn_Create() {
		$this->calCreatedOn = new QDateTimePicker($this);
		$this->calCreatedOn->Name = QApplication::Translate('Created On');
		$this->calCreatedOn->DateTime = $this->objT3Sch->CreatedOn;
		$this->calCreatedOn->DateTimePickerType = QDateTimePickerType::DateTime;
		$this->calCreatedOn->Required = true;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'T3Sch')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateT3SchFields() {
		$this->objT3Sch->ParticipantId = $this->lstParticipant->SelectedValue;
		$this->objT3Sch->ScheduleIn = $this->calScheduleIn->DateTime;
		$this->objT3Sch->ScheduleOut = $this->calScheduleOut->DateTime;
		$this->objT3Sch->Note = $this->txtNote->Text;
		$this->objT3Sch->InterviewerId = $this->lstInterviewer->SelectedValue;
		$this->objT3Sch->ScheduleTypeId = $this->lstScheduleType->SelectedValue;
		$this->objT3Sch->CreatedOn = $this->calCreatedOn->DateTime;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateT3SchFields();
		$this->objT3Sch->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objT3Sch->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>