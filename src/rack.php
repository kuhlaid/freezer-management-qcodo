<?php
/**
 * @abstract Handles the updates to rack information.
 * 
 * March 20, 2020 - wpg
 * - tracking the actions of the racks
 * 
 * March 18, 2020 - wpg
 * - duplicate last rack information to a new rack
 * 
 * Oct 30, 2018 - wpg
 * - adding customized SetupRack function
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');
require(__FORMBASE_CLASSES__ . '/RackEditFormBase.class.php');
QApplication::CheckRemoteAdmin();

class RackEditForm8 extends RackEditFormBase {

	protected function SetupRack() {
		// if we are requesting to move boxes to a rack then save the selection to a session
		$intRackSelection = QApplication::QueryString('intSelectRackId');
		if ($intRackSelection) {
			Rack::selectRackPushBoxes($intRackSelection);
			QApplication::Redirect('boxes.php?intRack='.$intRackSelection);
			exit;
		}

		// if we are moving a box to the rack then perform the update
		$intMoveBoxId = QApplication::QueryString('intMoveBoxId');
		if ($intMoveBoxId) {
			$objBox = Box::LoadById($intMoveBoxId);
			$objRack = Rack::LoadById(FM2013Session::GetSession(1));	// get the rack location
			if ($objBox && $objRack) {
				ActionLog::LogBoxAction(1,$objBox);	// save the action
				// update the box location
				$objBox->RackId = $objRack->Id;
				$objBox->Freezer = $objRack->Freezer;
				$objBox->Shelf = $objRack->Shelf;
				$objBox->Save();
			}
			QApplication::Redirect('boxes.php?intRack='.FM2013Session::GetSession(1));
			exit;
		}

		// if we are stopping the request to move boxes to a rack then delete the selection session
		$intRackDeselect = QApplication::QueryString('intDeselectRackId');
		if ($intRackDeselect) {
			FM2013Session::DeleteSession(1);
			QApplication::Redirect('boxes.php?intRack='.$intRackDeselect);
			exit;
		}

		

		// Lookup Object PK information from Query String (if applicable)
		// Set mode to Edit or New depending on what's found
		$intId = QApplication::QueryString('intId');
		if (($intId)) {
			$this->objRack = Rack::Load(($intId));

			if (!$this->objRack)
				throw new Exception('Could not find a Rack object with PK arguments: ' . $intId);

			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objRack = new Rack();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;

			$blnDuplicate = QApplication::QueryString('blnDuplicate');
			// duplicate the data from the last rack entered
			if ($blnDuplicate) {
				$objClone = Rack::QuerySingle(
					QQ::All(),QQ::Clause(QQ::LimitInfo(1),QQ::OrderBy(QQN::Rack()->Id,false))
				);
				$this->objRack->Name = $objClone->Name;
				$this->objRack->RackTypeId = $objClone->RackTypeId;
				$this->objRack->Notes = $objClone->Notes;
				$this->objRack->Shelf = $objClone->Shelf;
				$this->objRack->Freezer = $objClone->Freezer;
				$this->blnEditMode = true;
			}
		}
	}

	protected function RedirectToListPage() {
		QApplication::Redirect('racks.php');
	}

	// Create and Setup txtName
	protected function txtName_Create() {
		$this->txtName = new QTextBox($this);
		$this->txtName->Name = QApplication::Translate('Name');
		$this->txtName->Text = $this->objRack->Name;
		$this->txtName->Required = true;
		$this->txtName->CssClass = 'bld fs18';
		$this->txtName->MaxLength = Rack::NameMaxLength;
	}

	// Create and Setup lstRackType
	protected function lstRackType_Create() {
		$this->lstRackType = new QListBox($this);
		$this->lstRackType->CssClass = '';
		$this->lstRackType->Name = QApplication::Translate('Rack Type');
		$this->lstRackType->AddItem(QApplication::Translate('- Select One -'), null);
		$objRackTypeArray = TypeOfRack::LoadAll();
		if ($objRackTypeArray) foreach ($objRackTypeArray as $objRackType) {
			$objListItem = new QListItem($objRackType->__toString(), $objRackType->Id);
			if (($this->objRack->RackType) && ($this->objRack->RackType->Id == $objRackType->Id))
				$objListItem->Selected = true;
			$this->lstRackType->AddItem($objListItem);
		}
	}

	// Create and Setup txtNotes
	protected function txtNotes_Create() {
		$this->txtNotes = new QTextBox($this);
		$this->txtNotes->Name = QApplication::Translate('Notes');
		$this->txtNotes->Text = $this->objRack->Notes;
		$this->txtNotes->Width = '100%';
		$this->txtNotes->MaxLength = Rack::NotesMaxLength;
	}

	protected function txtShelf_Create() {
		$this->txtShelf = new QIntegerTextBox($this);
		$this->txtShelf->Name = QApplication::Translate('Shelf #');
		$this->txtShelf->Text = $this->objRack->Shelf;
		$this->txtShelf->Width = "25px";
	}

	// Create and Setup txtFreezer
	protected function txtFreezer_Create() {
		$this->txtFreezer = new QListBox($this);
		$this->txtFreezer->Name = QApplication::Translate('Freezer');
		// show box options for selecting the freezer
		foreach (Freezer::$freezerArray as $freezerCode => $freezerName) {
			$objListItem = new QListItem("(".$freezerCode.") ".$freezerName, $freezerCode);
			if (($this->objRack->Freezer) && ($this->objRack->Freezer == $freezerCode))
				$objListItem->Selected = true;
			$this->txtFreezer->AddItem($objListItem);
		}
		// show actual freezers
		$objFreezerArray = Freezer::QueryArray(QQ::All());
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$objListItem = new QListItem($objFreezer->__toString(), $objFreezer->Id);
			if (($this->objRack->Freezer) && ($this->objRack->Freezer == $objFreezer->Id))
				$objListItem->Selected = true;
			$this->txtFreezer->AddItem($objListItem);
		}
	}

	protected function UpdateRackFields() {
		// log the action
		if ($this->objRack->Id) ActionLog::LogRackAction(8,$this->objRack);

		$this->objRack->Name = $this->txtName->Text;
		$this->objRack->RackTypeId = $this->lstRackType->SelectedValue;
		$this->objRack->Notes = $this->txtNotes->Text;
		$this->objRack->Shelf = $this->txtShelf->Text;
		$this->objRack->Freezer = $this->txtFreezer->SelectedValue;

		if (!$this->objRack->Id) ActionLog::LogRackAction(7,$this->objRack);

		// if editing a rack, check the boxes and update their locations
		if ($this->blnEditMode) {
			// get list of boxes under the rack
			if ($this->objRack->Id !='') {
				$objBoxArray = Box::QueryArray(QQ::Equal(QQN::Box()->RackId, $this->objRack->Id));
				// if we
				// for each box in the selected rack we need to update the location to the new space
				if ($objBoxArray) foreach($objBoxArray as $objBox){
					$objBox->Shelf = $this->txtShelf->Text;
					$objBox->Freezer = $this->txtFreezer->SelectedValue;
					$objBox->Save();
				}
			}
		}
	}

	protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		ActionLog::LogRackAction(9,$this->objRack);
		$this->objRack->Delete();

		$this->RedirectToListPage();
	}
}


// go to the centralized form executing access control function to run the form and check access control
ACL_Run('rack_edit');
?>