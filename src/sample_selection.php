<?php
/**
 * @abstract Sample search log.
 * @author w. Patrick Gale
 *
 * Aug. 30, 2017 - wpg
 * - added the ability to update the sample selections after the sample selection log is unlocked
 *
 * Aug. 20, 2017 - wpg
 - adding a function for clearing the sample selection session when canceling or deleting a sample selection query

 * - initializing a sample search log and setting up session variable (Oct. 28, 2015 - wpg)
 * - adding btnCloseSampleSelection to close the sample selection when no samples have been selected (Nov. 10, 2015 - wpg)
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/SampleSelectionEditFormBase.class.php');
QApplication::CheckRemoteAdmin();

class SampleSelectionEditForm extends SampleSelectionEditFormBase {
	protected $btnCloseSampleSelection;
	protected function Form_Create() {
		// Call SetupSampleSelection to either Load/Edit Existing or Create New
		$this->SetupSampleSelection();

		// Create/Setup Controls for SampleSelection's Data Fields
		$this->txtParticipantSelect_Create();
		$this->txtSampleType_Create();
		$this->txtStudySelect_Create();
		$this->txtSampleSelect_Create();
		$this->txtDescription_Create();
		$this->chkLock_Create();

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
		$this->btnCloseSampleSelection_Create();
	}

	protected function btnCloseSampleSelection_Create() {
		$this->btnCloseSampleSelection = new QButton($this);
		$this->btnCloseSampleSelection->Text = QApplication::Translate('End this sample selection session');
		$this->btnCloseSampleSelection->AddAction(new QClickEvent(), new QServerAction('removeSamples'));
		$this->btnCloseSampleSelection->CausesValidation = false;
	}


	protected function removeSamples() {
		QSessionDB::set('error', 'No samples to pull.  Find samples to add to another freezer pull.');
		QSessionDB::set('__FREEZER_PULL_LIST__',serialize(array()));

		// lock the sample selection unless we decide to explicitly unlock it
		$this->objSampleSelection->Lock = true;
		$this->objSampleSelection->Save();

		QSessionDB::Delete('__SAMPLE_SELECTION_SEARCH__');
		QSessionDB::Delete('__SAMPLE_MOVING_BOX__');
		QApplication::Redirect("find_samples.php");
		exit;
	}

	protected function txtDescription_Create() {
		$this->txtDescription = new QTextBox($this);
		$this->txtDescription->Name = QApplication::Translate('Search Description');
		$this->txtDescription->Text = $this->objSampleSelection->Description;
		$this->txtDescription->MaxLength = SampleSelection::DescriptionMaxLength;
		$this->txtDescription->Width = '100%';
	}

	protected function btnSave_Create() {
		$this->btnSave = new QButton($this);
		if ($this->blnEditMode)
			$this->btnSave->Text = QApplication::Translate('Save');
		else
			$this->btnSave->Text = QApplication::Translate('Start sample search');
		$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
		$this->btnSave->PrimaryButton = true;
		$this->btnSave->CausesValidation = true;
	}

	protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
		if ($this->blnEditMode) {
			$this->UpdateSampleSelectionFields();
			$this->objSampleSelection->Save();
			// update the sample selection search session
			QSessionDB::set('__SAMPLE_SELECTION_SEARCH__',serialize($this->objSampleSelection));
			$this->RedirectToListPage();
		}
		else {
			$this->objSampleSelection->DateSelected = QDateTime::Now(false);
			$this->objSampleSelection->Description = $this->txtDescription->Text;
			$this->objSampleSelection->Save();
			// update the sample selection search session
			QSessionDB::set('__SAMPLE_SELECTION_SEARCH__',serialize($this->objSampleSelection));
			QApplication::Redirect('find_samples.php');
		}
	}

	protected function UpdateSampleSelectionFields() {
		// never update the other fields in this log, only in the sample search

		// update the sample selection list if we unlock the search log (Aug. 30, 2017 - wpg)
		if (!$this->chkLock->Checked) {
			$this->objSampleSelection->SampleSelect = QSessionDB::get('__FREEZER_PULL_LIST__');
		}
		$this->objSampleSelection->Description = $this->txtDescription->Text;
		$this->objSampleSelection->Lock = $this->chkLock->Checked;
	}

	protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->removeSamples();
		$this->RedirectToListPage();
	}

	protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objSampleSelection->Delete();
		$this->removeSamples();
		$this->RedirectToListPage();
	}

	protected function RedirectToListPage() {
		QApplication::Redirect('sample_selections.php');
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('sample_selection');
?>