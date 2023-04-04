<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the Rack class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single Rack object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this RackEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class RackEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objRack;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for Rack's Data Fields
	public $lblId;
	public $txtName;
	public $lstRackType;
	public $txtNotes;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupRack($objRack) {
		if ($objRack) {
			$this->objRack = $objRack;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objRack = new Rack();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objRack = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupRack to either Load/Edit Existing or Create New
		$this->SetupRack($objRack);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for Rack's Data Fields
		$this->lblId_Create();
		$this->txtName_Create();
		$this->lstRackType_Create();
		$this->txtNotes_Create();

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
			$this->lblId->Text = $this->objRack->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup txtName
	protected function txtName_Create() {
		$this->txtName = new QTextBox($this);
		$this->txtName->Name = QApplication::Translate('Name');
		$this->txtName->Text = $this->objRack->Name;
		$this->txtName->Required = true;
		$this->txtName->MaxLength = Rack::NameMaxLength;
	}

	// Create and Setup lstRackType
	protected function lstRackType_Create() {
		$this->lstRackType = new QListBox($this);
		$this->lstRackType->Name = QApplication::Translate('Rack Type');
		$this->lstRackType->AddItem(QApplication::Translate('- Select One -'), null);
		$objRackTypeArray = TypeOfRack::LoadAll();
		if ($objRackTypeArray) foreach ($objRackTypeArray as $objRackType) {
			$objListItem = new QListItem($objRackType->__toString(), $objRackType->Id);
			if (($this->objRack->RackType) && ($this->objRack->RackType->Id == $objRackType->Id))
				$objListItem->Selected = true;
			$this->lstRackType->AddItem($objListItem);
		}
	}

	// Create and Setup txtNotes
	protected function txtNotes_Create() {
		$this->txtNotes = new QTextBox($this);
		$this->txtNotes->Name = QApplication::Translate('Notes');
		$this->txtNotes->Text = $this->objRack->Notes;
		$this->txtNotes->MaxLength = Rack::NotesMaxLength;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Rack')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateRackFields() {
		$this->objRack->Name = $this->txtName->Text;
		$this->objRack->RackTypeId = $this->lstRackType->SelectedValue;
		$this->objRack->Notes = $this->txtNotes->Text;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateRackFields();
		$this->objRack->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objRack->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>