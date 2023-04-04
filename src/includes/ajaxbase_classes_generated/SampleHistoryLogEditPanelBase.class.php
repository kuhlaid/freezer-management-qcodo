<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the SampleHistoryLog class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single SampleHistoryLog object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this SampleHistoryLogEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleHistoryLogEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objSampleHistoryLog;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for SampleHistoryLog's Data Fields
	public $lblId;
	public $txtSampleId;
	public $calReleaseDate;
	public $txtFreezerPullId;
	public $calReceivedDate;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupSampleHistoryLog($objSampleHistoryLog) {
		if ($objSampleHistoryLog) {
			$this->objSampleHistoryLog = $objSampleHistoryLog;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objSampleHistoryLog = new SampleHistoryLog();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objSampleHistoryLog = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupSampleHistoryLog to either Load/Edit Existing or Create New
		$this->SetupSampleHistoryLog($objSampleHistoryLog);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for SampleHistoryLog's Data Fields
		$this->lblId_Create();
		$this->txtSampleId_Create();
		$this->calReleaseDate_Create();
		$this->txtFreezerPullId_Create();
		$this->calReceivedDate_Create();

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
			$this->lblId->Text = $this->objSampleHistoryLog->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup txtSampleId
	protected function txtSampleId_Create() {
		$this->txtSampleId = new QIntegerTextBox($this);
		$this->txtSampleId->Name = QApplication::Translate('Sample Id');
		$this->txtSampleId->Text = $this->objSampleHistoryLog->SampleId;
		$this->txtSampleId->Required = true;
	}

	// Create and Setup calReleaseDate
	protected function calReleaseDate_Create() {
		$this->calReleaseDate = new QDateTimePicker($this);
		$this->calReleaseDate->Name = QApplication::Translate('Release Date');
		$this->calReleaseDate->DateTime = $this->objSampleHistoryLog->ReleaseDate;
		$this->calReleaseDate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtFreezerPullId
	protected function txtFreezerPullId_Create() {
		$this->txtFreezerPullId = new QIntegerTextBox($this);
		$this->txtFreezerPullId->Name = QApplication::Translate('Freezer Pull Id');
		$this->txtFreezerPullId->Text = $this->objSampleHistoryLog->FreezerPullId;
	}

	// Create and Setup calReceivedDate
	protected function calReceivedDate_Create() {
		$this->calReceivedDate = new QDateTimePicker($this);
		$this->calReceivedDate->Name = QApplication::Translate('Received Date');
		$this->calReceivedDate->DateTime = $this->objSampleHistoryLog->ReceivedDate;
		$this->calReceivedDate->DateTimePickerType = QDateTimePickerType::Date;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'SampleHistoryLog')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateSampleHistoryLogFields() {
		$this->objSampleHistoryLog->SampleId = $this->txtSampleId->Text;
		$this->objSampleHistoryLog->ReleaseDate = $this->calReleaseDate->DateTime;
		$this->objSampleHistoryLog->FreezerPullId = $this->txtFreezerPullId->Text;
		$this->objSampleHistoryLog->ReceivedDate = $this->calReceivedDate->DateTime;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateSampleHistoryLogFields();
		$this->objSampleHistoryLog->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objSampleHistoryLog->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>