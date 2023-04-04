<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the Box class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single Box object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this BoxEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class BoxEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objBox;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for Box's Data Fields
	public $txtName;
	public $lstRack;
	public $txtShelf;
	public $txtFreezer;
	public $lblId;
	public $txtIssues;
	public $txtDescription;
	public $lstBoxType;
	public $lstSampleType;
	public $calCreated;
	public $txtPreparedById;
	public $chkComplete;
	public $lstClinicShipment;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupBox($objBox) {
		if ($objBox) {
			$this->objBox = $objBox;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objBox = new Box();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objBox = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupBox to either Load/Edit Existing or Create New
		$this->SetupBox($objBox);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for Box's Data Fields
		$this->txtName_Create();
		$this->lstRack_Create();
		$this->txtShelf_Create();
		$this->txtFreezer_Create();
		$this->lblId_Create();
		$this->txtIssues_Create();
		$this->txtDescription_Create();
		$this->lstBoxType_Create();
		$this->lstSampleType_Create();
		$this->calCreated_Create();
		$this->txtPreparedById_Create();
		$this->chkComplete_Create();
		$this->lstClinicShipment_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
	}

	// Protected Create Methods
	// Create and Setup txtName
	protected function txtName_Create() {
		$this->txtName = new QTextBox($this);
		$this->txtName->Name = QApplication::Translate('Name');
		$this->txtName->Text = $this->objBox->Name;
		$this->txtName->Required = true;
		$this->txtName->MaxLength = Box::NameMaxLength;
	}

	// Create and Setup lstRack
	protected function lstRack_Create() {
		$this->lstRack = new QListBox($this);
		$this->lstRack->Name = QApplication::Translate('Rack');
		$this->lstRack->AddItem(QApplication::Translate('- Select One -'), null);
		$objRackArray = Rack::LoadAll();
		if ($objRackArray) foreach ($objRackArray as $objRack) {
			$objListItem = new QListItem($objRack->__toString(), $objRack->Id);
			if (($this->objBox->Rack) && ($this->objBox->Rack->Id == $objRack->Id))
				$objListItem->Selected = true;
			$this->lstRack->AddItem($objListItem);
		}
	}

	// Create and Setup txtShelf
	protected function txtShelf_Create() {
		$this->txtShelf = new QIntegerTextBox($this);
		$this->txtShelf->Name = QApplication::Translate('Shelf');
		$this->txtShelf->Text = $this->objBox->Shelf;
	}

	// Create and Setup txtFreezer
	protected function txtFreezer_Create() {
		$this->txtFreezer = new QIntegerTextBox($this);
		$this->txtFreezer->Name = QApplication::Translate('Freezer');
		$this->txtFreezer->Text = $this->objBox->Freezer;
	}

	// Create and Setup lblId
	protected function lblId_Create() {
		$this->lblId = new QLabel($this);
		$this->lblId->Name = QApplication::Translate('Id');
		if ($this->blnEditMode)
			$this->lblId->Text = $this->objBox->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup txtIssues
	protected function txtIssues_Create() {
		$this->txtIssues = new QTextBox($this);
		$this->txtIssues->Name = QApplication::Translate('Issues');
		$this->txtIssues->Text = $this->objBox->Issues;
		$this->txtIssues->MaxLength = Box::IssuesMaxLength;
	}

	// Create and Setup txtDescription
	protected function txtDescription_Create() {
		$this->txtDescription = new QTextBox($this);
		$this->txtDescription->Name = QApplication::Translate('Description');
		$this->txtDescription->Text = $this->objBox->Description;
		$this->txtDescription->MaxLength = Box::DescriptionMaxLength;
	}

	// Create and Setup lstBoxType
	protected function lstBoxType_Create() {
		$this->lstBoxType = new QListBox($this);
		$this->lstBoxType->Name = QApplication::Translate('Box Type');
		$this->lstBoxType->AddItem(QApplication::Translate('- Select One -'), null);
		$objBoxTypeArray = TypeOfBox::LoadAll();
		if ($objBoxTypeArray) foreach ($objBoxTypeArray as $objBoxType) {
			$objListItem = new QListItem($objBoxType->__toString(), $objBoxType->Id);
			if (($this->objBox->BoxType) && ($this->objBox->BoxType->Id == $objBoxType->Id))
				$objListItem->Selected = true;
			$this->lstBoxType->AddItem($objListItem);
		}
	}

	// Create and Setup lstSampleType
	protected function lstSampleType_Create() {
		$this->lstSampleType = new QListBox($this);
		$this->lstSampleType->Name = QApplication::Translate('Sample Type');
		$this->lstSampleType->AddItem(QApplication::Translate('- Select One -'), null);
		$objSampleTypeArray = SampleTypes::LoadAll();
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			if (($this->objBox->SampleType) && ($this->objBox->SampleType->Id == $objSampleType->Id))
				$objListItem->Selected = true;
			$this->lstSampleType->AddItem($objListItem);
		}
	}

	// Create and Setup calCreated
	protected function calCreated_Create() {
		$this->calCreated = new QDateTimePicker($this);
		$this->calCreated->Name = QApplication::Translate('Created');
		$this->calCreated->DateTime = $this->objBox->Created;
		$this->calCreated->DateTimePickerType = QDateTimePickerType::DateTime;
	}

	// Create and Setup txtPreparedById
	protected function txtPreparedById_Create() {
		$this->txtPreparedById = new QIntegerTextBox($this);
		$this->txtPreparedById->Name = QApplication::Translate('Prepared By Id');
		$this->txtPreparedById->Text = $this->objBox->PreparedById;
	}

	// Create and Setup chkComplete
	protected function chkComplete_Create() {
		$this->chkComplete = new QCheckBox($this);
		$this->chkComplete->Name = QApplication::Translate('Complete');
		$this->chkComplete->Checked = $this->objBox->Complete;
	}

	// Create and Setup lstClinicShipment
	protected function lstClinicShipment_Create() {
		$this->lstClinicShipment = new QListBox($this);
		$this->lstClinicShipment->Name = QApplication::Translate('Clinic Shipment');
		$this->lstClinicShipment->AddItem(QApplication::Translate('- Select One -'), null);
		$objClinicShipmentArray = ClinicShipment::LoadAll();
		if ($objClinicShipmentArray) foreach ($objClinicShipmentArray as $objClinicShipment) {
			$objListItem = new QListItem($objClinicShipment->__toString(), $objClinicShipment->Id);
			if (($this->objBox->ClinicShipment) && ($this->objBox->ClinicShipment->Id == $objClinicShipment->Id))
				$objListItem->Selected = true;
			$this->lstClinicShipment->AddItem($objListItem);
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Box')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateBoxFields() {
		$this->objBox->Name = $this->txtName->Text;
		$this->objBox->RackId = $this->lstRack->SelectedValue;
		$this->objBox->Shelf = $this->txtShelf->Text;
		$this->objBox->Freezer = $this->txtFreezer->Text;
		$this->objBox->Issues = $this->txtIssues->Text;
		$this->objBox->Description = $this->txtDescription->Text;
		$this->objBox->BoxTypeId = $this->lstBoxType->SelectedValue;
		$this->objBox->SampleTypeId = $this->lstSampleType->SelectedValue;
		$this->objBox->Created = $this->calCreated->DateTime;
		$this->objBox->PreparedById = $this->txtPreparedById->Text;
		$this->objBox->Complete = $this->chkComplete->Checked;
		$this->objBox->ClinicShipmentId = $this->lstClinicShipment->SelectedValue;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateBoxFields();
		$this->objBox->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objBox->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>