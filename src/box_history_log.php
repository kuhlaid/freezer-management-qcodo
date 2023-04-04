<?php
/**
 * @abstract Used to manage the logs of when boxes were pulled from inventory.
 * @author w. Patrick Gale (July 2013)
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/BoxHistoryLogEditFormBase.class.php');
QApplication::CheckRemoteAdmin();

class BoxHistoryLogEditForm extends BoxHistoryLogEditFormBase {
	protected function RedirectToListPage() {
		QApplication::Redirect('box_history_logs.php');
	}

	// Protected Update Methods
	protected function UpdateBoxHistoryLogFields() {
		$this->objBoxHistoryLog->ReleaseDate = $this->calReleaseDate->DateTime;
		$this->objBoxHistoryLog->FreezerPullId = $this->txtFreezerPullId->Text;
		$this->objBoxHistoryLog->ReceivedDate = $this->calReceivedDate->DateTime;
	}

	// Create and Setup lstBox
	protected function lstBox_Create() {
		$this->lstBox = new QLabel($this);
		$this->lstBox->Name = QApplication::Translate('Box');
		$this->lstBox->Text = $this->objBoxHistoryLog->Box->__toString();
	}

	// Create and Setup calReleaseDate
	protected function calReleaseDate_Create() {
		$this->calReleaseDate = new QJsCalendar($this);
		$this->calReleaseDate->Name = QApplication::Translate('Release Date');
		$this->calReleaseDate->DateTime = $this->objBoxHistoryLog->ReleaseDate;
	}

	// Create and Setup calReceivedDate
	protected function calReceivedDate_Create() {
		$this->calReceivedDate = new QJsCalendar($this);
		$this->calReceivedDate->Name = QApplication::Translate('Received Date');
		$this->calReceivedDate->DateTime = $this->objBoxHistoryLog->ReceivedDate;
	}

}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('box_history_log');
?>