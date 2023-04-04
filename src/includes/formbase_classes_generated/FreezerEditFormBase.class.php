<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Freezer class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Freezer object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FreezerEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FreezerEditFormBase extends QForm {
		// General Form Variables
		protected $objFreezer;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Freezer's Data Fields
		protected $lblId;
		protected $txtName;
		protected $txtDescription;
		protected $txtInUseSince;
		protected $txtLocation;
		protected $txtNShelves;
		protected $txtShelfCuIn;
		protected $txtShelfDepthIn;
		protected $txtShelfWidthIn;
		protected $txtShelfHeightIn;
		protected $txtFreezerType;
		protected $txtModelNumber;
		protected $txtAssetNumber;
		protected $txtAlarmAccount;
		protected $txtSerialNumber;
		protected $txtInUse;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
		protected $lstFreezerMaintenancesAsFrzMain;

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupFreezer() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objFreezer = Freezer::Load(($intId));

				if (!$this->objFreezer)
					throw new Exception('Could not find a Freezer object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objFreezer = new Freezer();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupFreezer to either Load/Edit Existing or Create New
			$this->SetupFreezer();

			// Create/Setup Controls for Freezer's Data Fields
			$this->lblId_Create();
			$this->txtName_Create();
			$this->txtDescription_Create();
			$this->txtInUseSince_Create();
			$this->txtLocation_Create();
			$this->txtNShelves_Create();
			$this->txtShelfCuIn_Create();
			$this->txtShelfDepthIn_Create();
			$this->txtShelfWidthIn_Create();
			$this->txtShelfHeightIn_Create();
			$this->txtFreezerType_Create();
			$this->txtModelNumber_Create();
			$this->txtAssetNumber_Create();
			$this->txtAlarmAccount_Create();
			$this->txtSerialNumber_Create();
			$this->txtInUse_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
			$this->lstFreezerMaintenancesAsFrzMain_Create();

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
				$this->lblId->Text = $this->objFreezer->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objFreezer->Name;
			$this->txtName->Required = true;
			$this->txtName->MaxLength = Freezer::NameMaxLength;
		}

		// Create and Setup txtDescription
		protected function txtDescription_Create() {
			$this->txtDescription = new QTextBox($this);
			$this->txtDescription->Name = QApplication::Translate('Description');
			$this->txtDescription->Text = $this->objFreezer->Description;
			$this->txtDescription->Required = true;
			$this->txtDescription->MaxLength = Freezer::DescriptionMaxLength;
		}

		// Create and Setup txtInUseSince
		protected function txtInUseSince_Create() {
			$this->txtInUseSince = new QTextBox($this);
			$this->txtInUseSince->Name = QApplication::Translate('In Use Since');
			$this->txtInUseSince->Text = $this->objFreezer->InUseSince;
			$this->txtInUseSince->MaxLength = Freezer::InUseSinceMaxLength;
		}

		// Create and Setup txtLocation
		protected function txtLocation_Create() {
			$this->txtLocation = new QTextBox($this);
			$this->txtLocation->Name = QApplication::Translate('Location');
			$this->txtLocation->Text = $this->objFreezer->Location;
			$this->txtLocation->Required = true;
			$this->txtLocation->MaxLength = Freezer::LocationMaxLength;
		}

		// Create and Setup txtNShelves
		protected function txtNShelves_Create() {
			$this->txtNShelves = new QIntegerTextBox($this);
			$this->txtNShelves->Name = QApplication::Translate('N Shelves');
			$this->txtNShelves->Text = $this->objFreezer->NShelves;
		}

		// Create and Setup txtShelfCuIn
		protected function txtShelfCuIn_Create() {
			$this->txtShelfCuIn = new QFloatTextBox($this);
			$this->txtShelfCuIn->Name = QApplication::Translate('Shelf Cu In');
			$this->txtShelfCuIn->Text = $this->objFreezer->ShelfCuIn;
		}

		// Create and Setup txtShelfDepthIn
		protected function txtShelfDepthIn_Create() {
			$this->txtShelfDepthIn = new QFloatTextBox($this);
			$this->txtShelfDepthIn->Name = QApplication::Translate('Shelf Depth In');
			$this->txtShelfDepthIn->Text = $this->objFreezer->ShelfDepthIn;
		}

		// Create and Setup txtShelfWidthIn
		protected function txtShelfWidthIn_Create() {
			$this->txtShelfWidthIn = new QFloatTextBox($this);
			$this->txtShelfWidthIn->Name = QApplication::Translate('Shelf Width In');
			$this->txtShelfWidthIn->Text = $this->objFreezer->ShelfWidthIn;
		}

		// Create and Setup txtShelfHeightIn
		protected function txtShelfHeightIn_Create() {
			$this->txtShelfHeightIn = new QFloatTextBox($this);
			$this->txtShelfHeightIn->Name = QApplication::Translate('Shelf Height In');
			$this->txtShelfHeightIn->Text = $this->objFreezer->ShelfHeightIn;
		}

		// Create and Setup txtFreezerType
		protected function txtFreezerType_Create() {
			$this->txtFreezerType = new QTextBox($this);
			$this->txtFreezerType->Name = QApplication::Translate('Freezer Type');
			$this->txtFreezerType->Text = $this->objFreezer->FreezerType;
			$this->txtFreezerType->MaxLength = Freezer::FreezerTypeMaxLength;
		}

		// Create and Setup txtModelNumber
		protected function txtModelNumber_Create() {
			$this->txtModelNumber = new QTextBox($this);
			$this->txtModelNumber->Name = QApplication::Translate('Model Number');
			$this->txtModelNumber->Text = $this->objFreezer->ModelNumber;
			$this->txtModelNumber->MaxLength = Freezer::ModelNumberMaxLength;
		}

		// Create and Setup txtAssetNumber
		protected function txtAssetNumber_Create() {
			$this->txtAssetNumber = new QTextBox($this);
			$this->txtAssetNumber->Name = QApplication::Translate('Asset Number');
			$this->txtAssetNumber->Text = $this->objFreezer->AssetNumber;
			$this->txtAssetNumber->MaxLength = Freezer::AssetNumberMaxLength;
		}

		// Create and Setup txtAlarmAccount
		protected function txtAlarmAccount_Create() {
			$this->txtAlarmAccount = new QTextBox($this);
			$this->txtAlarmAccount->Name = QApplication::Translate('Alarm Account');
			$this->txtAlarmAccount->Text = $this->objFreezer->AlarmAccount;
			$this->txtAlarmAccount->MaxLength = Freezer::AlarmAccountMaxLength;
		}

		// Create and Setup txtSerialNumber
		protected function txtSerialNumber_Create() {
			$this->txtSerialNumber = new QTextBox($this);
			$this->txtSerialNumber->Name = QApplication::Translate('Serial Number');
			$this->txtSerialNumber->Text = $this->objFreezer->SerialNumber;
			$this->txtSerialNumber->MaxLength = Freezer::SerialNumberMaxLength;
		}

		// Create and Setup txtInUse
		protected function txtInUse_Create() {
			$this->txtInUse = new QIntegerTextBox($this);
			$this->txtInUse->Name = QApplication::Translate('In Use');
			$this->txtInUse->Text = $this->objFreezer->InUse;
		}

		// Create and Setup lstFreezerMaintenancesAsFrzMain
		protected function lstFreezerMaintenancesAsFrzMain_Create() {
			$this->lstFreezerMaintenancesAsFrzMain = new QListBox($this);
			$this->lstFreezerMaintenancesAsFrzMain->Name = QApplication::Translate('Freezer Maintenances As Frz Main');
			$this->lstFreezerMaintenancesAsFrzMain->SelectionMode = QSelectionMode::Multiple;
			$objAssociatedArray = $this->objFreezer->GetFreezerMaintenanceAsFrzMainArray();
			$objFreezerMaintenanceArray = FreezerMaintenance::LoadAll();
			if ($objFreezerMaintenanceArray) foreach ($objFreezerMaintenanceArray as $objFreezerMaintenance) {
				$objListItem = new QListItem($objFreezerMaintenance->__toString(), $objFreezerMaintenance->Id);
				foreach ($objAssociatedArray as $objAssociated) {
					if ($objAssociated->Id == $objFreezerMaintenance->Id)
						$objListItem->Selected = true;
				}
				$this->lstFreezerMaintenancesAsFrzMain->AddItem($objListItem);
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Freezer')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateFreezerFields() {
			$this->objFreezer->Name = $this->txtName->Text;
			$this->objFreezer->Description = $this->txtDescription->Text;
			$this->objFreezer->InUseSince = $this->txtInUseSince->Text;
			$this->objFreezer->Location = $this->txtLocation->Text;
			$this->objFreezer->NShelves = $this->txtNShelves->Text;
			$this->objFreezer->ShelfCuIn = $this->txtShelfCuIn->Text;
			$this->objFreezer->ShelfDepthIn = $this->txtShelfDepthIn->Text;
			$this->objFreezer->ShelfWidthIn = $this->txtShelfWidthIn->Text;
			$this->objFreezer->ShelfHeightIn = $this->txtShelfHeightIn->Text;
			$this->objFreezer->FreezerType = $this->txtFreezerType->Text;
			$this->objFreezer->ModelNumber = $this->txtModelNumber->Text;
			$this->objFreezer->AssetNumber = $this->txtAssetNumber->Text;
			$this->objFreezer->AlarmAccount = $this->txtAlarmAccount->Text;
			$this->objFreezer->SerialNumber = $this->txtSerialNumber->Text;
			$this->objFreezer->InUse = $this->txtInUse->Text;
		}

		protected function lstFreezerMaintenancesAsFrzMain_Update() {
			$this->objFreezer->UnassociateAllFreezerMaintenancesAsFrzMain();
			$objSelectedListItems = $this->lstFreezerMaintenancesAsFrzMain->SelectedItems;
			if ($objSelectedListItems) foreach ($objSelectedListItems as $objListItem) {
				$this->objFreezer->AssociateFreezerMaintenanceAsFrzMain(FreezerMaintenance::Load($objListItem->Value));
			}
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateFreezerFields();
			$this->objFreezer->Save();

			$this->lstFreezerMaintenancesAsFrzMain_Update();

			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {
			$this->objFreezer->UnassociateAllFreezerMaintenancesAsFrzMain();

			$this->objFreezer->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('freezer_list.php');
		}
	}
?>