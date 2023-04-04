<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the TypeUserAccess class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single TypeUserAccess object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this TypeUserAccessEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class TypeUserAccessEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objTypeUserAccess;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for TypeUserAccess's Data Fields
	public $lblId;
	public $txtName;
	public $txtDescription;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
	public $lstUsersAsAcl;

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupTypeUserAccess($objTypeUserAccess) {
		if ($objTypeUserAccess) {
			$this->objTypeUserAccess = $objTypeUserAccess;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objTypeUserAccess = new TypeUserAccess();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objTypeUserAccess = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupTypeUserAccess to either Load/Edit Existing or Create New
		$this->SetupTypeUserAccess($objTypeUserAccess);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for TypeUserAccess's Data Fields
		$this->lblId_Create();
		$this->txtName_Create();
		$this->txtDescription_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
		$this->lstUsersAsAcl_Create();

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
			$this->lblId->Text = $this->objTypeUserAccess->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup txtName
	protected function txtName_Create() {
		$this->txtName = new QTextBox($this);
		$this->txtName->Name = QApplication::Translate('Name');
		$this->txtName->Text = $this->objTypeUserAccess->Name;
		$this->txtName->Required = true;
		$this->txtName->MaxLength = TypeUserAccess::NameMaxLength;
	}

	// Create and Setup txtDescription
	protected function txtDescription_Create() {
		$this->txtDescription = new QTextBox($this);
		$this->txtDescription->Name = QApplication::Translate('Description');
		$this->txtDescription->Text = $this->objTypeUserAccess->Description;
		$this->txtDescription->MaxLength = TypeUserAccess::DescriptionMaxLength;
	}

	// Create and Setup lstUsersAsAcl
	protected function lstUsersAsAcl_Create() {
		$this->lstUsersAsAcl = new QListBox($this);
		$this->lstUsersAsAcl->Name = QApplication::Translate('Users As Acl');
		$this->lstUsersAsAcl->SelectionMode = QSelectionMode::Multiple;
		$objAssociatedArray = $this->objTypeUserAccess->GetUserAsAclArray();
		$objUserArray = User::LoadAll();
		if ($objUserArray) foreach ($objUserArray as $objUser) {
			$objListItem = new QListItem($objUser->__toString(), $objUser->Userid);
			foreach ($objAssociatedArray as $objAssociated) {
				if ($objAssociated->Userid == $objUser->Userid)
					$objListItem->Selected = true;
			}
			$this->lstUsersAsAcl->AddItem($objListItem);
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'TypeUserAccess')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateTypeUserAccessFields() {
		$this->objTypeUserAccess->Name = $this->txtName->Text;
		$this->objTypeUserAccess->Description = $this->txtDescription->Text;
	}

	protected function lstUsersAsAcl_Update() {
		$this->objTypeUserAccess->UnassociateAllUsersAsAcl();
		$objSelectedListItems = $this->lstUsersAsAcl->SelectedItems;
		if ($objSelectedListItems) foreach ($objSelectedListItems as $objListItem) {
			$this->objTypeUserAccess->AssociateUserAsAcl(User::Load($objListItem->Value));
		}
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateTypeUserAccessFields();
		$this->objTypeUserAccess->Save();

		$this->lstUsersAsAcl_Update();

		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {
		$this->objTypeUserAccess->UnassociateAllUsersAsAcl();

		$this->objTypeUserAccess->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>