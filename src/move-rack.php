<?php
/**
 * @abstract Used to move a selected block of boxes in a rack to another freezer space (freezer and shelf).
 * @author w. Patrick Gale (March 2014)
 * 
 * Sept. 19, 2019 - wpg
 * - adding Rack and Box actions
 * 
 * - adding rack selection so that rack contents can be moved to another rack and not just another freezer space (Sept. 29, 2014 - wpg)
 * - fixing code that is causing boxes that are not assigned a rack to be relocated along with the boxes we are trying to relocate (Oct. 13, 2014 - wpg)
 * - fixing code that is causing a rack that is simply moving to a new freezer location to be 'dislocated' from the boxes being moved (Jan. 20, 2016 - wpg)
 * - updated the freezer array (Feb. 4, 2016 - wpg)
 */
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
QApplication::CheckRemoteAdmin();

class MoveRackForm8 extends QForm {
	protected $intRackId, $strRack, $txtShelf, $txtFreezer, $btnSave, $btnCancel, $objNewRack, $objRack, $objBoxArray,
	$lstRack, $intFreezerId, $intShelf, $objFreezerArray;
	protected $objDefaultWaitIcon;

	protected function Form_Create() {
		// show box options for selecting the freezer
		foreach (Freezer::$freezerArray as $freezerCode => $freezerName) {
			$this->objFreezerArray[$freezerCode] = "(".$freezerCode.") ".$freezerName;
		}
		// show actual freezers
		$objFreezerArray = Freezer::QueryArray(QQ::All(),null,null,array('id','name'));
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$this->objFreezerArray[$objFreezer->Id] = $objFreezer->__toString();
		}

		$this->objDefaultWaitIcon = new QWaitIcon($this);
		$this->objDefaultWaitIcon->CssClass = 'waitIcon';

		$this->intRackId = QApplication::QueryString('intRack');
		$this->objRack = Rack::Load($this->intRackId);
		if (!$this->objRack) {
			QApplication::DisplayAlert('Rack does not exist');
			exit;
		}

		$this->strRack_Create();
		$this->txtShelf_Create();
		$this->txtFreezer_Create();
		$this->lstRack_Create();

		$this->btnSave_Create();
		$this->btnCancel_Create();
	}


	protected function RedirectToListPage() {
		// redirect to new freezer location
		if ($this->lstRack->SelectedValue != '')
			QApplication::Redirect('boxes.php?intRack='.$this->lstRack->SelectedValue.'&intFreezerId='.$this->txtFreezer->SelectedValue);
		elseif ($this->txtFreezer->SelectedValue != '')
		QApplication::Redirect('boxes.php?intRack='.$this->intRackId.'&intFreezerId='.$this->txtFreezer->SelectedValue);
		else
			QApplication::Redirect('racks.php?intRackId='.$this->intRackId);
	}

	// selected rack to move
	protected function strRack_Create() {
		$this->strRack = new QLabel($this);
		$this->strRack->HtmlEntities = false;

		if ($this->objRack->Name)
			$this->strRack->HtmlBefore = "<h2>Selected Rack: ".$this->objRack->Name."</h2>";

		// get list of boxes under the rack
		$this->objBoxArray = Box::QueryArray(QQ::Equal(QQN::Box()->RackId, $this->intRackId));
		$a='';
		if ($this->objBoxArray) foreach($this->objBoxArray as $objBox){
			if($a!='') $a.=", ";
			$a.="<a href='boxes.php?intBoxId=".$objBox->Id."'>".$objBox->Name."</a>";
		}

		$this->intFreezerId = $objBox->Freezer;
		$this->intShelf = $objBox->Shelf;

		if ($a != '')
			$this->strRack->Text .= "<div>Boxes: <b>".$a."</b></div>";

		$freezerName='';
		if (array_key_exists($objBox->Freezer, $this->objFreezerArray) && trim($objBox->Freezer ?? '')!="")
			$freezerName=$this->objFreezerArray[$objBox->Freezer];

		$this->strRack->Text .= '<div><a href="freezer-view.php?intFreezer='.$objBox->Freezer.'">'.$freezerName.'</a>'.($objBox->Shelf ? "<br/>Shelf #".$objBox->Shelf:'')."</div>";
	}

	// Create and Setup txtShelf
	protected function txtShelf_Create() {
		$this->txtShelf = new QIntegerTextBox($this);
		$this->txtShelf->Name = QApplication::Translate('Shelf');
		$this->txtShelf->Text = $this->intShelf;
	}

	// Create and Setup txtFreezer
	protected function txtFreezer_Create() {
		$this->txtFreezer = new QListBox($this);
		$this->txtFreezer->Name = QApplication::Translate('Freezer');
		$this->txtFreezer->AddItem(QApplication::Translate('- Select a freezer -'), null);

		// show box options for selecting the freezer
		foreach ($this->objFreezerArray as $freezerCode => $freezerName) {
			$objListItem = new QListItem($freezerName, $freezerCode);
			if ($this->intFreezerId == $freezerCode){
				$objListItem->Selected = true;
			}
			$this->txtFreezer->AddItem($objListItem);
		}
	}

	protected function lstRack_Create() {
		$this->lstRack = new QListBox($this);
		$this->lstRack->Name = QApplication::Translate('Rack');
		$this->lstRack->AddAction(new QChangeEvent(), new QAjaxAction('rackSelected'));
		$this->lstRack->AddItem(QApplication::Translate('- Select One -'), null);
		// get all racks
		$objRackArray = Rack::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::Rack()->Name)), null, array('id', 'name'));
		if ($objRackArray) foreach ($objRackArray as $objRack) {
			$objListItem = new QListItem($objRack->__toString(), $objRack->Id);
			if ($this->objRack->Id == $objRack->Id){
				$objListItem->Selected = true;
			}
			$this->lstRack->AddItem($objListItem);
		}
	}

	// changes in rack selection
	protected function rackSelected() {
		// if a rack is selected then get the freezer and shelf information
		if($this->lstRack->SelectedValue != '') {
			$this->objNewRack = Rack::QuerySingle(QQ::Equal(QQN::Rack()->Id, $this->lstRack->SelectedValue));
			//QApplication::DisplayAlert($this->objNewRack->Name);
			if ($this->objNewRack) {
				// if the rack already has a freezer location
				// else we need to specify the freezer location since the rack does not currently have one
				if ($this->objNewRack->Freezer != '') {
					$this->txtShelf->Text = $this->objNewRack->Shelf;
					$this->txtFreezer->SelectedValue = $this->objNewRack->Freezer;
				}
				// 				else{
				// 					$this->txtShelf->Enabled = $this->txtFreezer->Enabled = true;
				// 				}
			}
		}
		else {
			$this->objNewRack = NULL;
			// else the box is just free floating in the freezers so we need to get the freezer and shelf information
			$this->txtShelf->Text = NULL;
			$this->txtFreezer->SelectedValue = NULL;
			// 			$this->txtShelf->Enabled = $this->txtFreezer->Enabled = true;
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

	// Control ServerActions
	protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateRack();
		$this->RedirectToListPage();
	}

	protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->RedirectToListPage();
	}

	// Protected Update Methods
	protected function UpdateRack() {
		// if a rack is selected (moving the boxes to the selected rack)
		// else we are just moving the boxes to another freezer location
		if ($this->objNewRack || $this->objRack) {
			// for each box in the selected rack we need to update the location to the new space
			if ($this->objBoxArray) foreach($this->objBoxArray as $objBox){
				ActionLog::LogBoxAction(1,$objBox);
				$objBox->Shelf = $this->txtShelf->Text;
				$objBox->Freezer = $this->txtFreezer->SelectedValue;
				$objBox->RackId = $this->lstRack->SelectedValue;
				$objBox->Save();
			}

			// if we are moving boxes to a new rack
			// else we are just moving the rack to another freezer
			if ($this->objNewRack) {
				// update the rack that the boxes are moving to
				$this->objNewRack->Shelf = $this->txtShelf->Text;
				$this->objNewRack->Freezer = $this->txtFreezer->SelectedValue;
				$this->objNewRack->Save();
				ActionLog::LogRackAction(7,$this->objNewRack);
			}
			else {
				ActionLog::LogRackAction(8,$this->objRack);
				// update the rack that the boxes are moving to
				$this->objRack->Shelf = $this->txtShelf->Text;
				$this->objRack->Freezer = $this->txtFreezer->SelectedValue;
				$this->objRack->Save();
			}

			// update the old rack record since
			// 			$this->objRack->Shelf = NULL;
			// 			$this->objRack->Freezer = NULL;
			// 			$this->objRack->Save();
		}
		else {
			// for each box in the original rack we need to update the location to the new space
			if ($this->objBoxArray) foreach($this->objBoxArray as $objBox){
				ActionLog::LogBoxAction(1,$objBox);
				$objBox->Shelf = $this->txtShelf->Text;
				$objBox->Freezer = $this->txtFreezer->SelectedValue;
				$objBox->RackId = NULL;
				$objBox->Save();
			}

			// update the rack record since the rack is not being used anymore it seems
			// 			$this->objRack->Shelf = NULL;
			// 			$this->objRack->Freezer = NULL;
			// 			$this->objRack->Save();
		}
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('move-rack');
?>