<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the BoxHistoryLog class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single BoxHistoryLog object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this BoxHistoryLogEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class BoxHistoryLogEditFormBase extends QForm {
		// General Form Variables
		protected $objBoxHistoryLog;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for BoxHistoryLog's Data Fields
		protected $lblId;
		protected $lstBox;
		protected $calReleaseDate;
		protected $txtFreezerPullId;
		protected $calReceivedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupBoxHistoryLog() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objBoxHistoryLog = BoxHistoryLog::Load(($intId));

				if (!$this->objBoxHistoryLog)
					throw new Exception('Could not find a BoxHistoryLog object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objBoxHistoryLog = new BoxHistoryLog();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupBoxHistoryLog to either Load/Edit Existing or Create New
			$this->SetupBoxHistoryLog();

			// Create/Setup Controls for BoxHistoryLog's Data Fields
			$this->lblId_Create();
			$this->lstBox_Create();
			$this->calReleaseDate_Create();
			$this->txtFreezerPullId_Create();
			$this->calReceivedDate_Create();

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
				$this->lblId->Text = $this->objBoxHistoryLog->Id;
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
				if (($this->objBoxHistoryLog->Box) && ($this->objBoxHistoryLog->Box->Id == $objBox->Id))
					$objListItem->Selected = true;
				$this->lstBox->AddItem($objListItem);
			}
		}

		// Create and Setup calReleaseDate
		protected function calReleaseDate_Create() {
			$this->calReleaseDate = new QDateTimePicker($this);
			$this->calReleaseDate->Name = QApplication::Translate('Release Date');
			$this->calReleaseDate->DateTime = $this->objBoxHistoryLog->ReleaseDate;
			$this->calReleaseDate->DateTimePickerType = QDateTimePickerType::Date;
		}

		// Create and Setup txtFreezerPullId
		protected function txtFreezerPullId_Create() {
			$this->txtFreezerPullId = new QIntegerTextBox($this);
			$this->txtFreezerPullId->Name = QApplication::Translate('Freezer Pull Id');
			$this->txtFreezerPullId->Text = $this->objBoxHistoryLog->FreezerPullId;
		}

		// Create and Setup calReceivedDate
		protected function calReceivedDate_Create() {
			$this->calReceivedDate = new QDateTimePicker($this);
			$this->calReceivedDate->Name = QApplication::Translate('Received Date');
			$this->calReceivedDate->DateTime = $this->objBoxHistoryLog->ReceivedDate;
			$this->calReceivedDate->DateTimePickerType = QDateTimePickerType::Date;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'BoxHistoryLog')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateBoxHistoryLogFields() {
			$this->objBoxHistoryLog->BoxId = $this->lstBox->SelectedValue;
			$this->objBoxHistoryLog->ReleaseDate = $this->calReleaseDate->DateTime;
			$this->objBoxHistoryLog->FreezerPullId = $this->txtFreezerPullId->Text;
			$this->objBoxHistoryLog->ReceivedDate = $this->calReceivedDate->DateTime;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateBoxHistoryLogFields();
			$this->objBoxHistoryLog->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objBoxHistoryLog->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('box_history_log_list.php');
		}
	}
?>