<?php
/**
 * @abstract Business logic for the freezer form.
 *
 * Jan. 6, 2017 - wpg
 * - added additional fields 'FreezerType'-'InUse'
 */

require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/FreezerEditFormBase.class.php');
QApplication::CheckRemoteAdmin();

class FreezerEditForm extends FreezerEditFormBase {
	protected function RedirectToListPage() {
		QApplication::Redirect('freezers.php');
	}


	// Create and Setup txtDescription
	protected function txtDescription_Create() {
		$this->txtDescription = new QTextBox($this);
		$this->txtDescription->Name = QApplication::Translate('Description');
		$this->txtDescription->Text = $this->objFreezer->Description;
		$this->txtDescription->Required = true;
		$this->txtDescription->MaxLength = Freezer::DescriptionMaxLength;
		$this->txtDescription->Width = '100%';
		// 			$this->txtDescription->Rows = 2;
		// 			$this->txtDescription->TextMode = QTextMode::MultiLine;
	}


	// Create and Setup txtLocation
	protected function txtLocation_Create() {
		parent::txtLocation_Create();
		$this->txtLocation->Width = '100%';
	}


	// Create and Setup txtNShelves
	protected function txtNShelves_Create() {
		$this->txtNShelves = new QIntegerTextBox($this);
		$this->txtNShelves->Name = QApplication::Translate('# of Shelves');
		$this->txtNShelves->Text = $this->objFreezer->NShelves;
		$this->txtNShelves->Width = '50px';
	}

	// Create and Setup txtShelf
	protected function txtShelfCuIn_Create() {
		$this->txtShelfCuIn = new QFloatTextBox($this);
		$this->txtShelfCuIn->Name = QApplication::Translate('Shelf space (cubic inches)');
		$this->txtShelfCuIn->Text = $this->objFreezer->ShelfCuIn;
		$this->txtShelfCuIn->Width = '50px';
	}

	// Create and Setup txtShelfDepth
	protected function txtShelfDepthIn_Create() {
		$this->txtShelfDepthIn = new QFloatTextBox($this);
		$this->txtShelfDepthIn->Name = QApplication::Translate('Shelf Depth (inches)');
		$this->txtShelfDepthIn->Text = $this->objFreezer->ShelfDepthIn;
		$this->txtShelfDepthIn->Width = '50px';
	}

	// Create and Setup txtShelfWidth
	protected function txtShelfWidthIn_Create() {
		$this->txtShelfWidthIn = new QFloatTextBox($this);
		$this->txtShelfWidthIn->Name = QApplication::Translate('Shelf Width (inches)');
		$this->txtShelfWidthIn->Text = $this->objFreezer->ShelfWidthIn;
		$this->txtShelfWidthIn->Width = '50px';
	}

	// Create and Setup txtShelfHeightIn
	protected function txtShelfHeightIn_Create() {
		$this->txtShelfHeightIn = new QFloatTextBox($this);
		$this->txtShelfHeightIn->Name = QApplication::Translate('Shelf Height (inches)');
		$this->txtShelfHeightIn->Text = $this->objFreezer->ShelfHeightIn;
		$this->txtShelfHeightIn->Width = '50px';
	}

	protected function txtInUse_Create() {
		$this->txtInUse = new QListBox($this);
		$this->txtInUse->Name = QApplication::Translate('Status of freezer');
		$this->txtInUse->AddItem("-- no status --",null);
		foreach (Freezer::$freezerInUseArray as $freezerInUseCode => $freezerInUseValue) {
			$objListItem = new QListItem($freezerInUseValue, $freezerInUseCode);
				if ($this->objFreezer->InUse == $freezerInUseCode)
					$objListItem->Selected = true;
			$this->txtInUse->AddItem($objListItem);
		}
	}

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
		$this->objFreezer->InUse = $this->txtInUse->SelectedValue;
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('freezer');
?>