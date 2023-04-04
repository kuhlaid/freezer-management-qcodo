<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the User class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single User object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this UserEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class UserEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objUser;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for User's Data Fields
	public $lblUserid;
	public $txtUsername;
	public $txtFirstname;
	public $txtLastname;
	public $txtEmail;
	public $txtActive;
	public $txtOnyen;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
	public $lstTypeUserAccessesAsAcl;

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupUser($objUser) {
		if ($objUser) {
			$this->objUser = $objUser;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objUser = new User();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objUser = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupUser to either Load/Edit Existing or Create New
		$this->SetupUser($objUser);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for User's Data Fields
		$this->lblUserid_Create();
		$this->txtUsername_Create();
		$this->txtFirstname_Create();
		$this->txtLastname_Create();
		$this->txtEmail_Create();
		$this->txtActive_Create();
		$this->txtOnyen_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
		$this->lstTypeUserAccessesAsAcl_Create();

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
	}

	// Protected Create Methods
	// Create and Setup lblUserid
	protected function lblUserid_Create() {
		$this->lblUserid = new QLabel($this);
		$this->lblUserid->Name = QApplication::Translate('Userid');
		if ($this->blnEditMode)
			$this->lblUserid->Text = $this->objUser->Userid;
		else
			$this->lblUserid->Text = 'N/A';
	}

	// Create and Setup txtUsername
	protected function txtUsername_Create() {
		$this->txtUsername = new QTextBox($this);
		$this->txtUsername->Name = QApplication::Translate('Username');
		$this->txtUsername->Text = $this->objUser->Username;
		$this->txtUsername->MaxLength = User::UsernameMaxLength;
	}

	// Create and Setup txtFirstname
	protected function txtFirstname_Create() {
		$this->txtFirstname = new QTextBox($this);
		$this->txtFirstname->Name = QApplication::Translate('Firstname');
		$this->txtFirstname->Text = $this->objUser->Firstname;
		$this->txtFirstname->Required = true;
		$this->txtFirstname->MaxLength = User::FirstnameMaxLength;
	}

	// Create and Setup txtLastname
	protected function txtLastname_Create() {
		$this->txtLastname = new QTextBox($this);
		$this->txtLastname->Name = QApplication::Translate('Lastname');
		$this->txtLastname->Text = $this->objUser->Lastname;
		$this->txtLastname->Required = true;
		$this->txtLastname->MaxLength = User::LastnameMaxLength;
	}

	// Create and Setup txtEmail
	protected function txtEmail_Create() {
		$this->txtEmail = new QTextBox($this);
		$this->txtEmail->Name = QApplication::Translate('Email');
		$this->txtEmail->Text = $this->objUser->Email;
		$this->txtEmail->Required = true;
		$this->txtEmail->MaxLength = User::EmailMaxLength;
	}

	// Create and Setup txtActive
	protected function txtActive_Create() {
		$this->txtActive = new QIntegerTextBox($this);
		$this->txtActive->Name = QApplication::Translate('Active');
		$this->txtActive->Text = $this->objUser->Active;
		$this->txtActive->Required = true;
	}

	// Create and Setup txtOnyen
	protected function txtOnyen_Create() {
		$this->txtOnyen = new QTextBox($this);
		$this->txtOnyen->Name = QApplication::Translate('Onyen');
		$this->txtOnyen->Text = $this->objUser->Onyen;
		$this->txtOnyen->MaxLength = User::OnyenMaxLength;
	}

	// Create and Setup lstTypeUserAccessesAsAcl
	protected function lstTypeUserAccessesAsAcl_Create() {
		$this->lstTypeUserAccessesAsAcl = new QListBox($this);
		$this->lstTypeUserAccessesAsAcl->Name = QApplication::Translate('Type User Accesses As Acl');
		$this->lstTypeUserAccessesAsAcl->SelectionMode = QSelectionMode::Multiple;
		$objAssociatedArray = $this->objUser->GetTypeUserAccessAsAclArray();
		$objTypeUserAccessArray = TypeUserAccess::LoadAll();
		if ($objTypeUserAccessArray) foreach ($objTypeUserAccessArray as $objTypeUserAccess) {
			$objListItem = new QListItem($objTypeUserAccess->__toString(), $objTypeUserAccess->Id);
			foreach ($objAssociatedArray as $objAssociated) {
				if ($objAssociated->Id == $objTypeUserAccess->Id)
					$objListItem->Selected = true;
			}
			$this->lstTypeUserAccessesAsAcl->AddItem($objListItem);
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'User')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateUserFields() {
		$this->objUser->Username = $this->txtUsername->Text;
		$this->objUser->Firstname = $this->txtFirstname->Text;
		$this->objUser->Lastname = $this->txtLastname->Text;
		$this->objUser->Email = $this->txtEmail->Text;
		$this->objUser->Active = $this->txtActive->Text;
		$this->objUser->Onyen = $this->txtOnyen->Text;
	}

	protected function lstTypeUserAccessesAsAcl_Update() {
		$this->objUser->UnassociateAllTypeUserAccessesAsAcl();
		$objSelectedListItems = $this->lstTypeUserAccessesAsAcl->SelectedItems;
		if ($objSelectedListItems) foreach ($objSelectedListItems as $objListItem) {
			$this->objUser->AssociateTypeUserAccessAsAcl(TypeUserAccess::Load($objListItem->Value));
		}
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateUserFields();
		$this->objUser->Save();

		$this->lstTypeUserAccessesAsAcl_Update();

		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {
		$this->objUser->UnassociateAllTypeUserAccessesAsAcl();

		$this->objUser->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>