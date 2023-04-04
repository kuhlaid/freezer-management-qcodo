<?php
/**
 * Oct. 6, 2020 - wpg
 * - adding an alert flag
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/FreezerMaintenanceEditFormBase.class.php');
QApplication::CheckRemoteAdmin();

class FreezerMaintenanceEditForm8 extends FreezerMaintenanceEditFormBase {
	// Create and Setup calLogDate
	protected function calLogDate_Create() {
		$this->calLogDate = new QJsCalendar($this);
		$this->calLogDate->Name = QApplication::Translate('Log Date');
		if ($this->objFreezerMaintenance->LogDate)
			$this->calLogDate->DateTime = $this->objFreezerMaintenance->LogDate;
		else
			$this->calLogDate->DateTime = QDateTime::Now();
		$this->calLogDate->Required = true;
		$this->calLogDate->Width = '100px';
	}

	protected function chkAlertUser_Create() {
		$this->chkAlertUser = new QCheckBox($this);
		$this->chkAlertUser->Name = QApplication::Translate('Alert users with this log?'); 	//QApplication::Translate('Alert User');
		$this->chkAlertUser->Checked = $this->objFreezerMaintenance->AlertUser;
	}

	// Create and Setup txtMainLog
	protected function txtMainLog_Create() {
		$this->txtMainLog = new QTextBox($this);
		$this->txtMainLog->Name = QApplication::Translate('Main Log:');
		$this->txtMainLog->Text = $this->objFreezerMaintenance->MainLog;
		$this->txtMainLog->Required = true;
		$this->txtMainLog->TextMode = QTextMode::MultiLine;
		$this->txtMainLog->Rows = 5;
		$this->txtMainLog->Width = '100%';
	}

	// Create and Setup lstFreezersAsFrzMain
	protected function lstFreezersAsFrzMain_Create() {
		$this->lstFreezersAsFrzMain = new QListBox($this);
		$this->lstFreezersAsFrzMain->Name = QApplication::Translate('Maintenance performed on freezers:');
		$this->lstFreezersAsFrzMain->SelectionMode = QSelectionMode::Multiple;
		$objAssociatedArray = $this->objFreezerMaintenance->GetFreezerAsFrzMainArray();
		$objFreezerArray = Freezer::LoadAll();
		$count=0;
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$objListItem = new QListItem($objFreezer->__toString(), $objFreezer->Id);
			foreach ($objAssociatedArray as $objAssociated) {
				if ($objAssociated->Id == $objFreezer->Id)
					$objListItem->Selected = true;
			}
			$count++;
			$this->lstFreezersAsFrzMain->AddItem($objListItem);
		}
		$this->lstFreezersAsFrzMain->Rows = $count;
	}


	protected function RedirectToListPage() {
		QApplication::Redirect('freezer-maintenance-logs.php');
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('freezer-maintenance');
?>