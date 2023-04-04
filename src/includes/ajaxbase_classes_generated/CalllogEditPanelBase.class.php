<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the Calllog class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single Calllog object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this CalllogEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class CalllogEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objCalllog;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for Calllog's Data Fields
	public $lblId;
	public $txtCaseid;
	public $txtNumcalled;
	public $calCalldate;
	public $txtCalltime;
	public $txtCalloutcome;
	public $txtComments;
	public $txtUsername;
	public $txtReference;
	public $calCalldt;
	public $lstParticipant;
	public $lstInterviewer;
	public $calCallEnd;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupCalllog($objCalllog) {
		if ($objCalllog) {
			$this->objCalllog = $objCalllog;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objCalllog = new Calllog();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objCalllog = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupCalllog to either Load/Edit Existing or Create New
		$this->SetupCalllog($objCalllog);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for Calllog's Data Fields
		$this->lblId_Create();
		$this->txtCaseid_Create();
		$this->txtNumcalled_Create();
		$this->calCalldate_Create();
		$this->txtCalltime_Create();
		$this->txtCalloutcome_Create();
		$this->txtComments_Create();
		$this->txtUsername_Create();
		$this->txtReference_Create();
		$this->calCalldt_Create();
		$this->lstParticipant_Create();
		$this->lstInterviewer_Create();
		$this->calCallEnd_Create();

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
			$this->lblId->Text = $this->objCalllog->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup txtCaseid
	protected function txtCaseid_Create() {
		$this->txtCaseid = new QTextBox($this);
		$this->txtCaseid->Name = QApplication::Translate('Caseid');
		$this->txtCaseid->Text = $this->objCalllog->Caseid;
		$this->txtCaseid->MaxLength = Calllog::CaseidMaxLength;
	}

	// Create and Setup txtNumcalled
	protected function txtNumcalled_Create() {
		$this->txtNumcalled = new QTextBox($this);
		$this->txtNumcalled->Name = QApplication::Translate('Numcalled');
		$this->txtNumcalled->Text = $this->objCalllog->Numcalled;
		$this->txtNumcalled->MaxLength = Calllog::NumcalledMaxLength;
	}

	// Create and Setup calCalldate
	protected function calCalldate_Create() {
		$this->calCalldate = new QDateTimePicker($this);
		$this->calCalldate->Name = QApplication::Translate('Calldate');
		$this->calCalldate->DateTime = $this->objCalllog->Calldate;
		$this->calCalldate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtCalltime
	protected function txtCalltime_Create() {
		$this->txtCalltime = new QTextBox($this);
		$this->txtCalltime->Name = QApplication::Translate('Calltime');
		$this->txtCalltime->Text = $this->objCalllog->Calltime;
		$this->txtCalltime->MaxLength = Calllog::CalltimeMaxLength;
	}

	// Create and Setup txtCalloutcome
	protected function txtCalloutcome_Create() {
		$this->txtCalloutcome = new QTextBox($this);
		$this->txtCalloutcome->Name = QApplication::Translate('Calloutcome');
		$this->txtCalloutcome->Text = $this->objCalllog->Calloutcome;
		$this->txtCalloutcome->MaxLength = Calllog::CalloutcomeMaxLength;
	}

	// Create and Setup txtComments
	protected function txtComments_Create() {
		$this->txtComments = new QTextBox($this);
		$this->txtComments->Name = QApplication::Translate('Comments');
		$this->txtComments->Text = $this->objCalllog->Comments;
		$this->txtComments->TextMode = QTextMode::MultiLine;
	}

	// Create and Setup txtUsername
	protected function txtUsername_Create() {
		$this->txtUsername = new QTextBox($this);
		$this->txtUsername->Name = QApplication::Translate('Username');
		$this->txtUsername->Text = $this->objCalllog->Username;
		$this->txtUsername->MaxLength = Calllog::UsernameMaxLength;
	}

	// Create and Setup txtReference
	protected function txtReference_Create() {
		$this->txtReference = new QTextBox($this);
		$this->txtReference->Name = QApplication::Translate('Reference');
		$this->txtReference->Text = $this->objCalllog->Reference;
		$this->txtReference->MaxLength = Calllog::ReferenceMaxLength;
	}

	// Create and Setup calCalldt
	protected function calCalldt_Create() {
		$this->calCalldt = new QDateTimePicker($this);
		$this->calCalldt->Name = QApplication::Translate('Calldt');
		$this->calCalldt->DateTime = $this->objCalllog->Calldt;
		$this->calCalldt->DateTimePickerType = QDateTimePickerType::DateTime;
	}

	// Create and Setup lstParticipant
	protected function lstParticipant_Create() {
		$this->lstParticipant = new QListBox($this);
		$this->lstParticipant->Name = QApplication::Translate('Participant');
		$this->lstParticipant->AddItem(QApplication::Translate('- Select One -'), null);
		$objParticipantArray = Participant::LoadAll();
		if ($objParticipantArray) foreach ($objParticipantArray as $objParticipant) {
			$objListItem = new QListItem($objParticipant->__toString(), $objParticipant->Id);
			if (($this->objCalllog->Participant) && ($this->objCalllog->Participant->Id == $objParticipant->Id))
				$objListItem->Selected = true;
			$this->lstParticipant->AddItem($objListItem);
		}
	}

	// Create and Setup lstInterviewer
	protected function lstInterviewer_Create() {
		$this->lstInterviewer = new QListBox($this);
		$this->lstInterviewer->Name = QApplication::Translate('Interviewer');
		$this->lstInterviewer->AddItem(QApplication::Translate('- Select One -'), null);
		$objInterviewerArray = User::LoadAll();
		if ($objInterviewerArray) foreach ($objInterviewerArray as $objInterviewer) {
			$objListItem = new QListItem($objInterviewer->__toString(), $objInterviewer->Userid);
			if (($this->objCalllog->Interviewer) && ($this->objCalllog->Interviewer->Userid == $objInterviewer->Userid))
				$objListItem->Selected = true;
			$this->lstInterviewer->AddItem($objListItem);
		}
	}

	// Create and Setup calCallEnd
	protected function calCallEnd_Create() {
		$this->calCallEnd = new QDateTimePicker($this);
		$this->calCallEnd->Name = QApplication::Translate('Call End');
		$this->calCallEnd->DateTime = $this->objCalllog->CallEnd;
		$this->calCallEnd->DateTimePickerType = QDateTimePickerType::DateTime;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Calllog')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateCalllogFields() {
		$this->objCalllog->Caseid = $this->txtCaseid->Text;
		$this->objCalllog->Numcalled = $this->txtNumcalled->Text;
		$this->objCalllog->Calldate = $this->calCalldate->DateTime;
		$this->objCalllog->Calltime = $this->txtCalltime->Text;
		$this->objCalllog->Calloutcome = $this->txtCalloutcome->Text;
		$this->objCalllog->Comments = $this->txtComments->Text;
		$this->objCalllog->Username = $this->txtUsername->Text;
		$this->objCalllog->Reference = $this->txtReference->Text;
		$this->objCalllog->Calldt = $this->calCalldt->DateTime;
		$this->objCalllog->ParticipantId = $this->lstParticipant->SelectedValue;
		$this->objCalllog->InterviewerId = $this->lstInterviewer->SelectedValue;
		$this->objCalllog->CallEnd = $this->calCallEnd->DateTime;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateCalllogFields();
		$this->objCalllog->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objCalllog->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>