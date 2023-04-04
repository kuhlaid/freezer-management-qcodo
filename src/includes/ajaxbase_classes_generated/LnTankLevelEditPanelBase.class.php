<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the LnTankLevel class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single LnTankLevel object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this LnTankLevelEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class LnTankLevelEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objLnTankLevel;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for LnTankLevel's Data Fields
	public $lblId;
	public $lstLnTank;
	public $calDateChecked;
	public $txtTankLevel;
	public $chkFreezerFull;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupLnTankLevel($objLnTankLevel) {
		if ($objLnTankLevel) {
			$this->objLnTankLevel = $objLnTankLevel;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objLnTankLevel = new LnTankLevel();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objLnTankLevel = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupLnTankLevel to either Load/Edit Existing or Create New
		$this->SetupLnTankLevel($objLnTankLevel);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for LnTankLevel's Data Fields
		$this->lblId_Create();
		$this->lstLnTank_Create();
		$this->calDateChecked_Create();
		$this->txtTankLevel_Create();
		$this->chkFreezerFull_Create();

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
			$this->lblId->Text = $this->objLnTankLevel->Id;
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
			if (($this->objLnTankLevel->LnTank) && ($this->objLnTankLevel->LnTank->Id == $objLnTank->Id))
				$objListItem->Selected = true;
			$this->lstLnTank->AddItem($objListItem);
		}
	}

	// Create and Setup calDateChecked
	protected function calDateChecked_Create() {
		$this->calDateChecked = new QDateTimePicker($this);
		$this->calDateChecked->Name = QApplication::Translate('Date Checked');
		$this->calDateChecked->DateTime = $this->objLnTankLevel->DateChecked;
		$this->calDateChecked->DateTimePickerType = QDateTimePickerType::DateTime;
		$this->calDateChecked->Required = true;
	}

	// Create and Setup txtTankLevel
	protected function txtTankLevel_Create() {
		$this->txtTankLevel = new QIntegerTextBox($this);
		$this->txtTankLevel->Name = QApplication::Translate('Tank Level');
		$this->txtTankLevel->Text = $this->objLnTankLevel->TankLevel;
		$this->txtTankLevel->Required = true;
	}

	// Create and Setup chkFreezerFull
	protected function chkFreezerFull_Create() {
		$this->chkFreezerFull = new QCheckBox($this);
		$this->chkFreezerFull->Name = QApplication::Translate('Freezer Full');
		$this->chkFreezerFull->Checked = $this->objLnTankLevel->FreezerFull;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'LnTankLevel')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateLnTankLevelFields() {
		$this->objLnTankLevel->LnTankId = $this->lstLnTank->SelectedValue;
		$this->objLnTankLevel->DateChecked = $this->calDateChecked->DateTime;
		$this->objLnTankLevel->TankLevel = $this->txtTankLevel->Text;
		$this->objLnTankLevel->FreezerFull = $this->chkFreezerFull->Checked;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateLnTankLevelFields();
		$this->objLnTankLevel->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objLnTankLevel->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>