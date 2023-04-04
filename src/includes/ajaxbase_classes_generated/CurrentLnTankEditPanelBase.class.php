<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the CurrentLnTank class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single CurrentLnTank object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this CurrentLnTankEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class CurrentLnTankEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objCurrentLnTank;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for CurrentLnTank's Data Fields
	public $lblId;
	public $lstLnTank;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupCurrentLnTank($objCurrentLnTank) {
		if ($objCurrentLnTank) {
			$this->objCurrentLnTank = $objCurrentLnTank;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objCurrentLnTank = new CurrentLnTank();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objCurrentLnTank = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupCurrentLnTank to either Load/Edit Existing or Create New
		$this->SetupCurrentLnTank($objCurrentLnTank);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for CurrentLnTank's Data Fields
		$this->lblId_Create();
		$this->lstLnTank_Create();

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
			$this->lblId->Text = $this->objCurrentLnTank->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup lstLnTank
	protected function lstLnTank_Create() {
		$this->lstLnTank = new QListBox($this);
		$this->lstLnTank->Name = QApplication::Translate('Ln Tank');
		$this->lstLnTank->Required = true;
		if (!$this->blnEditMode)
			$this->lstLnTank->AddItem(QApplication::Translate('- Select One -'), null);
		$objLnTankArray = LnTank::LoadAll();
		if ($objLnTankArray) foreach ($objLnTankArray as $objLnTank) {
			$objListItem = new QListItem($objLnTank->__toString(), $objLnTank->Id);
			if (($this->objCurrentLnTank->LnTank) && ($this->objCurrentLnTank->LnTank->Id == $objLnTank->Id))
				$objListItem->Selected = true;
			$this->lstLnTank->AddItem($objListItem);
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'CurrentLnTank')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateCurrentLnTankFields() {
		$this->objCurrentLnTank->LnTankId = $this->lstLnTank->SelectedValue;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateCurrentLnTankFields();
		$this->objCurrentLnTank->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objCurrentLnTank->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>