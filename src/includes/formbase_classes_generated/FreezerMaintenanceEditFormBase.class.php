<?php
/**
 * This is the abstract Form class for the Create, Edit, and Delete functionality
 * of the FreezerMaintenance class.  This code-generated class
 * contains all the basic Qform elements to display an HTML form that can
 * manipulate a single FreezerMaintenance object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form which extends this FreezerMaintenanceEditFormBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage FormBaseObjects
 *
 */
abstract class FreezerMaintenanceEditFormBase extends QForm {
	// General Form Variables
	protected $objFreezerMaintenance;
	protected $strTitleVerb;
	protected $blnEditMode;

		// Controls for FreezerMaintenance's Data Fields
		protected $lblId;
		protected $calLogDate;
		protected $txtMainLog;
		protected $chkAlertUser;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
	protected $lstFreezersAsFrzMain;

	// Button Actions
	protected $btnSave;
	protected $btnCancel;
	protected $btnDelete;

	protected function SetupFreezerMaintenance() {
		// Lookup Object PK information from Query String (if applicable)
		// Set mode to Edit or New depending on what's found
		$intId = QApplication::QueryString('intId');
		if (($intId)) {
			$this->objFreezerMaintenance = FreezerMaintenance::Load(($intId));

			if (!$this->objFreezerMaintenance)
				throw new Exception('Could not find a FreezerMaintenance object with PK arguments: ' . $intId);

			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objFreezerMaintenance = new FreezerMaintenance();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	protected function Form_Create() {
		// Call SetupFreezerMaintenance to either Load/Edit Existing or Create New
		$this->SetupFreezerMaintenance();

			// Create/Setup Controls for FreezerMaintenance's Data Fields
			$this->lblId_Create();
			$this->calLogDate_Create();
			$this->txtMainLog_Create();
			$this->chkAlertUser_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
		$this->lstFreezersAsFrzMain_Create();

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
			$this->lblId->Text = $this->objFreezerMaintenance->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup calLogDate
	protected function calLogDate_Create() {
		$this->calLogDate = new QDateTimePicker($this);
		$this->calLogDate->Name = QApplication::Translate('Log Date');
		$this->calLogDate->DateTime = $this->objFreezerMaintenance->LogDate;
		$this->calLogDate->DateTimePickerType = QDateTimePickerType::Date;
		$this->calLogDate->Required = true;
	}

	// Create and Setup txtMainLog
	protected function txtMainLog_Create() {
		$this->txtMainLog = new QTextBox($this);
		$this->txtMainLog->Name = QApplication::Translate('Main Log');
		$this->txtMainLog->Text = $this->objFreezerMaintenance->MainLog;
		$this->txtMainLog->Required = true;
		$this->txtMainLog->TextMode = QTextMode::MultiLine;
	}

// Create and Setup chkAlertUser
		protected function chkAlertUser_Create() {
			$this->chkAlertUser = new QCheckBox($this);
			$this->chkAlertUser->Name = QApplication::Translate(' [alert_user]'); 	//QApplication::Translate('Alert User');
			$this->chkAlertUser->Checked = $this->objFreezerMaintenance->AlertUser;
		}
		
	// Create and Setup lstFreezersAsFrzMain
	protected function lstFreezersAsFrzMain_Create() {
		$this->lstFreezersAsFrzMain = new QListBox($this);
		$this->lstFreezersAsFrzMain->Name = QApplication::Translate('Freezers As Frz Main');
		$this->lstFreezersAsFrzMain->SelectionMode = QSelectionMode::Multiple;
		$objAssociatedArray = $this->objFreezerMaintenance->GetFreezerAsFrzMainArray();
		$objFreezerArray = Freezer::LoadAll();
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$objListItem = new QListItem($objFreezer->__toString(), $objFreezer->Id);
			foreach ($objAssociatedArray as $objAssociated) {
				if ($objAssociated->Id == $objFreezer->Id)
					$objListItem->Selected = true;
			}
			$this->lstFreezersAsFrzMain->AddItem($objListItem);
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'FreezerMaintenance')));
		$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateFreezerMaintenanceFields() {
		$this->objFreezerMaintenance->LogDate = $this->calLogDate->DateTime;
		$this->objFreezerMaintenance->MainLog = $this->txtMainLog->Text;
	$this->objFreezerMaintenance->AlertUser = $this->chkAlertUser->Checked;
	}

	protected function lstFreezersAsFrzMain_Update() {
		$this->objFreezerMaintenance->UnassociateAllFreezersAsFrzMain();
		$objSelectedListItems = $this->lstFreezersAsFrzMain->SelectedItems;
		if ($objSelectedListItems) foreach ($objSelectedListItems as $objListItem) {
			$this->objFreezerMaintenance->AssociateFreezerAsFrzMain(Freezer::Load($objListItem->Value));
		}
	}


	// Control ServerActions
	protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateFreezerMaintenanceFields();
		$this->objFreezerMaintenance->Save();

		$this->lstFreezersAsFrzMain_Update();

		$this->RedirectToListPage();
	}

	protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->RedirectToListPage();
	}

	protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {
		$this->objFreezerMaintenance->UnassociateAllFreezersAsFrzMain();

		$this->objFreezerMaintenance->Delete();

		$this->RedirectToListPage();
	}

	protected function RedirectToListPage() {
		QApplication::Redirect('freezer_maintenance_list.php');
	}
}
?>