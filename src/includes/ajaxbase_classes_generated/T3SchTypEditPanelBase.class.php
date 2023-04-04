<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the T3SchTyp class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single T3SchTyp object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this T3SchTypEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class T3SchTypEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objT3SchTyp;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for T3SchTyp's Data Fields
	public $lblId;
	public $txtName;
	public $txtStudy;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupT3SchTyp($objT3SchTyp) {
		if ($objT3SchTyp) {
			$this->objT3SchTyp = $objT3SchTyp;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objT3SchTyp = new T3SchTyp();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objT3SchTyp = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupT3SchTyp to either Load/Edit Existing or Create New
		$this->SetupT3SchTyp($objT3SchTyp);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for T3SchTyp's Data Fields
		$this->lblId_Create();
		$this->txtName_Create();
		$this->txtStudy_Create();

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
			$this->lblId->Text = $this->objT3SchTyp->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup txtName
	protected function txtName_Create() {
		$this->txtName = new QTextBox($this);
		$this->txtName->Name = QApplication::Translate('Name');
		$this->txtName->Text = $this->objT3SchTyp->Name;
		$this->txtName->Required = true;
		$this->txtName->MaxLength = T3SchTyp::NameMaxLength;
	}

	// Create and Setup txtStudy
	protected function txtStudy_Create() {
		$this->txtStudy = new QTextBox($this);
		$this->txtStudy->Name = QApplication::Translate('Study');
		$this->txtStudy->Text = $this->objT3SchTyp->Study;
		$this->txtStudy->Required = true;
		$this->txtStudy->MaxLength = T3SchTyp::StudyMaxLength;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'T3SchTyp')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateT3SchTypFields() {
		$this->objT3SchTyp->Name = $this->txtName->Text;
		$this->objT3SchTyp->Study = $this->txtStudy->Text;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateT3SchTypFields();
		$this->objT3SchTyp->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objT3SchTyp->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>