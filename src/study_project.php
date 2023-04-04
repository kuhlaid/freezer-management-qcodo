<?php
require('includes/prepend.inc.php');			/* if you DO have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/FmStudyEditFormBase.class.php');
QApplication::CheckRemoteAdmin();


class FmStudyEditForm8 extends FmStudyEditFormBase {
	protected function txtName_Create() {
		$this->txtName = new QTextBox($this);
		$this->txtName->Name = QApplication::Translate('Study or project name to be assigned to samples');
		$this->txtName->Text = $this->objFmStudy->Name;
		$this->txtName->Required = true;
		$this->txtName->MaxLength = FmStudy::NameMaxLength;
	}

	protected function RedirectToListPage() {
		QApplication::Redirect('study_projects.php');
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('study_project');
?>