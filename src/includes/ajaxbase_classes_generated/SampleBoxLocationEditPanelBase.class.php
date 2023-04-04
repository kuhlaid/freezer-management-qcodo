<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the SampleBoxLocation class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single SampleBoxLocation object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this SampleBoxLocationEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleBoxLocationEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objSampleBoxLocation;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for SampleBoxLocation's Data Fields
	public $lblId;
	public $lstBox;
	public $txtBoxSampleSlot;
	public $txtSampleId;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupSampleBoxLocation($objSampleBoxLocation) {
		if ($objSampleBoxLocation) {
			$this->objSampleBoxLocation = $objSampleBoxLocation;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objSampleBoxLocation = new SampleBoxLocation();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objSampleBoxLocation = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupSampleBoxLocation to either Load/Edit Existing or Create New
		$this->SetupSampleBoxLocation($objSampleBoxLocation);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for SampleBoxLocation's Data Fields
		$this->lblId_Create();
		$this->lstBox_Create();
		$this->txtBoxSampleSlot_Create();
		$this->txtSampleId_Create();

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
			$this->lblId->Text = $this->objSampleBoxLocation->Id;
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
			if (($this->objSampleBoxLocation->Box) && ($this->objSampleBoxLocation->Box->Id == $objBox->Id))
				$objListItem->Selected = true;
			$this->lstBox->AddItem($objListItem);
		}
	}

	// Create and Setup txtBoxSampleSlot
	protected function txtBoxSampleSlot_Create() {
		$this->txtBoxSampleSlot = new QIntegerTextBox($this);
		$this->txtBoxSampleSlot->Name = QApplication::Translate('Box Sample Slot');
		$this->txtBoxSampleSlot->Text = $this->objSampleBoxLocation->BoxSampleSlot;
		$this->txtBoxSampleSlot->Required = true;
	}

	// Create and Setup txtSampleId
	protected function txtSampleId_Create() {
		$this->txtSampleId = new QIntegerTextBox($this);
		$this->txtSampleId->Name = QApplication::Translate('Sample Id');
		$this->txtSampleId->Text = $this->objSampleBoxLocation->SampleId;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'SampleBoxLocation')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateSampleBoxLocationFields() {
		$this->objSampleBoxLocation->BoxId = $this->lstBox->SelectedValue;
		$this->objSampleBoxLocation->BoxSampleSlot = $this->txtBoxSampleSlot->Text;
		$this->objSampleBoxLocation->SampleId = $this->txtSampleId->Text;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateSampleBoxLocationFields();
		$this->objSampleBoxLocation->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objSampleBoxLocation->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>