<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the TypeUserAccess class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single TypeUserAccess object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this TypeUserAccessEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class TypeUserAccessEditFormBase extends QForm {
		// General Form Variables
		protected $objTypeUserAccess;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for TypeUserAccess's Data Fields
		protected $lblId;
		protected $txtName;
		protected $txtDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
		protected $lstUsersAsAcl;

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupTypeUserAccess() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objTypeUserAccess = TypeUserAccess::Load(($intId));

				if (!$this->objTypeUserAccess)
					throw new Exception('Could not find a TypeUserAccess object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objTypeUserAccess = new TypeUserAccess();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupTypeUserAccess to either Load/Edit Existing or Create New
			$this->SetupTypeUserAccess();

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
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'TypeUserAccess')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
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
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateTypeUserAccessFields();
			$this->objTypeUserAccess->Save();

			$this->lstUsersAsAcl_Update();

			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {
			$this->objTypeUserAccess->UnassociateAllUsersAsAcl();

			$this->objTypeUserAccess->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('type_user_access_list.php');
		}
	}
?>