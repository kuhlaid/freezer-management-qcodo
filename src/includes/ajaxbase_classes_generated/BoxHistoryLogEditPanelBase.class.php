<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the BoxHistoryLog class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single BoxHistoryLog object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this BoxHistoryLogEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class BoxHistoryLogEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objBoxHistoryLog;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for BoxHistoryLog's Data Fields
	public $lblId;
	public $lstBox;
	public $calReleaseDate;
	public $txtFreezerPullId;
	public $calReceivedDate;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupBoxHistoryLog($objBoxHistoryLog) {
		if ($objBoxHistoryLog) {
			$this->objBoxHistoryLog = $objBoxHistoryLog;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objBoxHistoryLog = new BoxHistoryLog();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objBoxHistoryLog = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupBoxHistoryLog to either Load/Edit Existing or Create New
		$this->SetupBoxHistoryLog($objBoxHistoryLog);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for BoxHistoryLog's Data Fields
		$this->lblId_Create();
		$this->lstBox_Create();
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
			$this->lblId->Text = $this->objBoxHistoryLog->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup lstBox
	protected function lstBox_Create() {
		$this->lstBox = new QListBox($this);
		$this->lstBox->Name = QApplication::Translate('Box');
		$this->lstBox->Required = true;
		if (!$this->blnEditMode)
			$this->lstBox->AddItem(QApplication::Translate('- Select One -'), null);
		$objBoxArray = Box::LoadAll();
		if ($objBoxArray) foreach ($objBoxArray as $objBox) {
			$objListItem = new QListItem($objBox->__toString(), $objBox->Id);
			if (($this->objBoxHistoryLog->Box) && ($this->objBoxHistoryLog->Box->Id == $objBox->Id))
				$objListItem->Selected = true;
			$this->lstBox->AddItem($objListItem);
		}
	}

	// Create and Setup calReleaseDate
	protected function calReleaseDate_Create() {
		$this->calReleaseDate = new QDateTimePicker($this);
		$this->calReleaseDate->Name = QApplication::Translate('Release Date');
		$this->calReleaseDate->DateTime = $this->objBoxHistoryLog->ReleaseDate;
		$this->calReleaseDate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtFreezerPullId
	protected function txtFreezerPullId_Create() {
		$this->txtFreezerPullId = new QIntegerTextBox($this);
		$this->txtFreezerPullId->Name = QApplication::Translate('Freezer Pull Id');
		$this->txtFreezerPullId->Text = $this->objBoxHistoryLog->FreezerPullId;
	}

	// Create and Setup calReceivedDate
	protected function calReceivedDate_Create() {
		$this->calReceivedDate = new QDateTimePicker($this);
		$this->calReceivedDate->Name = QApplication::Translate('Received Date');
		$this->calReceivedDate->DateTime = $this->objBoxHistoryLog->ReceivedDate;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'BoxHistoryLog')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateBoxHistoryLogFields() {
		$this->objBoxHistoryLog->BoxId = $this->lstBox->SelectedValue;
		$this->objBoxHistoryLog->ReleaseDate = $this->calReleaseDate->DateTime;
		$this->objBoxHistoryLog->FreezerPullId = $this->txtFreezerPullId->Text;
		$this->objBoxHistoryLog->ReceivedDate = $this->calReceivedDate->DateTime;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateBoxHistoryLogFields();
		$this->objBoxHistoryLog->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objBoxHistoryLog->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>