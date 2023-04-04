<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the UserLoginTrack class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single UserLoginTrack object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this UserLoginTrackEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class UserLoginTrackEditFormBase extends QForm {
		// General Form Variables
		protected $objUserLoginTrack;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for UserLoginTrack's Data Fields
		protected $lblId;
		protected $txtUserId;
		protected $chkLoginPassed;
		protected $calAttempted;
		protected $txtIp;
		protected $txtUserNameAttempt;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupUserLoginTrack() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objUserLoginTrack = UserLoginTrack::Load(($intId));

				if (!$this->objUserLoginTrack)
					throw new Exception('Could not find a UserLoginTrack object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objUserLoginTrack = new UserLoginTrack();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupUserLoginTrack to either Load/Edit Existing or Create New
			$this->SetupUserLoginTrack();

			// Create/Setup Controls for UserLoginTrack's Data Fields
			$this->lblId_Create();
			$this->txtUserId_Create();
			$this->chkLoginPassed_Create();
			$this->calAttempted_Create();
			$this->txtIp_Create();
			$this->txtUserNameAttempt_Create();

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
				$this->lblId->Text = $this->objUserLoginTrack->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtUserId
		protected function txtUserId_Create() {
			$this->txtUserId = new QIntegerTextBox($this);
			$this->txtUserId->Name = QApplication::Translate('User Id');
			$this->txtUserId->Text = $this->objUserLoginTrack->UserId;
		}

		// Create and Setup chkLoginPassed
		protected function chkLoginPassed_Create() {
			$this->chkLoginPassed = new QCheckBox($this);
			$this->chkLoginPassed->Name = QApplication::Translate('Login Passed');
			$this->chkLoginPassed->Checked = $this->objUserLoginTrack->LoginPassed;
		}

		// Create and Setup calAttempted
		protected function calAttempted_Create() {
			$this->calAttempted = new QDateTimePicker($this);
			$this->calAttempted->Name = QApplication::Translate('Attempted');
			$this->calAttempted->DateTime = $this->objUserLoginTrack->Attempted;
			$this->calAttempted->DateTimePickerType = QDateTimePickerType::DateTime;
			$this->calAttempted->Required = true;
		}

		// Create and Setup txtIp
		protected function txtIp_Create() {
			$this->txtIp = new QTextBox($this);
			$this->txtIp->Name = QApplication::Translate('Ip');
			$this->txtIp->Text = $this->objUserLoginTrack->Ip;
			$this->txtIp->MaxLength = UserLoginTrack::IpMaxLength;
		}

		// Create and Setup txtUserNameAttempt
		protected function txtUserNameAttempt_Create() {
			$this->txtUserNameAttempt = new QTextBox($this);
			$this->txtUserNameAttempt->Name = QApplication::Translate('User Name Attempt');
			$this->txtUserNameAttempt->Text = $this->objUserLoginTrack->UserNameAttempt;
			$this->txtUserNameAttempt->MaxLength = UserLoginTrack::UserNameAttemptMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'UserLoginTrack')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateUserLoginTrackFields() {
			$this->objUserLoginTrack->UserId = $this->txtUserId->Text;
			$this->objUserLoginTrack->LoginPassed = $this->chkLoginPassed->Checked;
			$this->objUserLoginTrack->Attempted = $this->calAttempted->DateTime;
			$this->objUserLoginTrack->Ip = $this->txtIp->Text;
			$this->objUserLoginTrack->UserNameAttempt = $this->txtUserNameAttempt->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateUserLoginTrackFields();
			$this->objUserLoginTrack->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objUserLoginTrack->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('user_login_track_list.php');
		}
	}
?>