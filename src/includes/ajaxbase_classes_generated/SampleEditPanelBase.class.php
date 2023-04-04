<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the Sample class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single Sample object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this SampleEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objSample;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for Sample's Data Fields
	public $lblId;
	public $lstStudyType;
	public $txtParticipantId;
	public $lstSampleType;
	public $txtSampleNumber;
	public $txtBarcode;
	public $txtStudyCase;
	public $txtSampleloc;
	public $txtBoxId;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupSample($objSample) {
		if ($objSample) {
			$this->objSample = $objSample;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objSample = new Sample();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objSample = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupSample to either Load/Edit Existing or Create New
		$this->SetupSample($objSample);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for Sample's Data Fields
		$this->lblId_Create();
		$this->lstStudyType_Create();
		$this->txtParticipantId_Create();
		$this->lstSampleType_Create();
		$this->txtSampleNumber_Create();
		$this->txtBarcode_Create();
		$this->txtStudyCase_Create();
		$this->txtSampleloc_Create();
		$this->txtBoxId_Create();

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
			$this->lblId->Text = $this->objSample->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup lstStudyType
	protected function lstStudyType_Create() {
		$this->lstStudyType = new QListBox($this);
		$this->lstStudyType->Name = QApplication::Translate('Study Type');
		$this->lstStudyType->AddItem(QApplication::Translate('- Select One -'), null);
		$objStudyArray = FmStudy::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::FmStudy()->Name)));
		foreach ($objStudyArray as $objStudy)
			$this->lstStudyType->AddItem(new QListItem($objStudy->Name, $objStudy->Id, $this->objSample->StudyTypeId == $objStudy->Id));
	}

	// Create and Setup txtParticipantId
	protected function txtParticipantId_Create() {
		$this->txtParticipantId = new QIntegerTextBox($this);
		$this->txtParticipantId->Name = QApplication::Translate('Participant Id');
		$this->txtParticipantId->Text = $this->objSample->ParticipantId;
	}

	// Create and Setup lstSampleType
	protected function lstSampleType_Create() {
		$this->lstSampleType = new QListBox($this);
		$this->lstSampleType->Name = QApplication::Translate('Sample Type');
		$this->lstSampleType->AddItem(QApplication::Translate('- Select One -'), null);
		$objSampleTypeArray = SampleTypes::LoadAll();
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			if (($this->objSample->SampleType) && ($this->objSample->SampleType->Id == $objSampleType->Id))
				$objListItem->Selected = true;
			$this->lstSampleType->AddItem($objListItem);
		}
	}

	// Create and Setup txtSampleNumber
	protected function txtSampleNumber_Create() {
		$this->txtSampleNumber = new QIntegerTextBox($this);
		$this->txtSampleNumber->Name = QApplication::Translate('Sample Number');
		$this->txtSampleNumber->Text = $this->objSample->SampleNumber;
	}

	// Create and Setup txtBarcode
	protected function txtBarcode_Create() {
		$this->txtBarcode = new QTextBox($this);
		$this->txtBarcode->Name = QApplication::Translate('Barcode');
		$this->txtBarcode->Text = $this->objSample->Barcode;
		$this->txtBarcode->MaxLength = Sample::BarcodeMaxLength;
	}

	// Create and Setup txtStudyCase
	protected function txtStudyCase_Create() {
		$this->txtStudyCase = new QTextBox($this);
		$this->txtStudyCase->Name = QApplication::Translate('Study Case');
		$this->txtStudyCase->Text = $this->objSample->StudyCase;
		$this->txtStudyCase->MaxLength = Sample::StudyCaseMaxLength;
	}

	// Create and Setup txtSampleloc
	protected function txtSampleloc_Create() {
		$this->txtSampleloc = new QTextBox($this);
		$this->txtSampleloc->Name = QApplication::Translate('Sampleloc');
		$this->txtSampleloc->Text = $this->objSample->Sampleloc;
		$this->txtSampleloc->MaxLength = Sample::SamplelocMaxLength;
	}

	// Create and Setup txtBoxId
	protected function txtBoxId_Create() {
		$this->txtBoxId = new QTextBox($this);
		$this->txtBoxId->Name = QApplication::Translate('Box Id');
		$this->txtBoxId->Text = $this->objSample->BoxId;
		$this->txtBoxId->MaxLength = Sample::BoxIdMaxLength;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Sample')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateSampleFields() {
		$this->objSample->StudyTypeId = $this->lstStudyType->SelectedValue;
		$this->objSample->ParticipantId = $this->txtParticipantId->Text;
		$this->objSample->SampleTypeId = $this->lstSampleType->SelectedValue;
		$this->objSample->SampleNumber = $this->txtSampleNumber->Text;
		$this->objSample->Barcode = $this->txtBarcode->Text;
		$this->objSample->StudyCase = $this->txtStudyCase->Text;
		$this->objSample->Sampleloc = $this->txtSampleloc->Text;
		$this->objSample->BoxId = $this->txtBoxId->Text;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateSampleFields();
		$this->objSample->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objSample->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>