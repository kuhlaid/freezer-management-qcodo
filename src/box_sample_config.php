<?php
/**
 * @author w. Patrick Gale
 * @abstract Form used to create box sample validation and checks
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');	
require(__FORMBASE_CLASSES__ . '/FmBoxSampleConfigEditFormBase.class.php');
QApplication::CheckRemoteAdmin();


class FmBoxSampleConfigEditForm8 extends FmBoxSampleConfigEditFormBase {

	// Create and Setup txtConfig
	protected function txtConfig_Create() {
		$this->txtConfig = new QTextBox($this);
		$this->txtConfig->Name = QApplication::Translate('Sample barcode validation');
		$this->txtConfig->Required = true;
		$this->txtConfig->TextMode = QTextMode::MultiLine;
		$this->txtConfig->Rows = 5;
		$this->txtConfig->Width = '100%';
		$this->txtConfig->Text = $this->objFmBoxSampleConfig->Config;
	}

	// Create and Setup txtDescription
	protected function txtDescription_Create() {
		$this->txtDescription = new QTextBox($this);
		$this->txtDescription->Name = QApplication::Translate('Description'); 	//QApplication::Translate('Description');
		$this->txtDescription->Text = $this->objFmBoxSampleConfig->Description;
		$this->txtDescription->Required = true;
		$this->txtDescription->MaxLength = FmBoxSampleConfig::DescriptionMaxLength;
	}

	protected function RedirectToListPage() {
		QApplication::Redirect('box_sample_configs.php');
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('box_sample_config');
?>