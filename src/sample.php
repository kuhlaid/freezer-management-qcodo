<?php
/**
 * @abstract Simple editing form for sample details.
 * @author w. Patrick Gale (June 2013)
 * @TODO need to save new sample when the 'state' is changed and probably add a datagrid to the form that gives
 * a read-only history of the sample state changes; also if the parent_id is null then set it to the main sample ID
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */

// Include the classfile for SampleEditFormBase
require(__FORMBASE_CLASSES__ . '/SampleEditFormBase.class.php');

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();


class SampleEditForm8 extends SampleEditFormBase {
	protected $strReturn;
	
	protected function Form_Create() {
		$this->strReturn = QApplication::QueryString('return');
		// Call SetupSample to either Load/Edit Existing or Create New
		$this->SetupSample();

		// Create/Setup Controls for Sample's Data Fields
		$this->lblId_Create();
		$this->lstStudyType_Create();
		$this->txtParticipantId_Create();
		$this->lstSampleType_Create();
		$this->txtSampleNumber_Create();
		$this->txtBarcode_Create();
		$this->txtStudyCase_Create();
		$this->txtSampleloc_Create();
		$this->lstBox_Create();
			
		$this->txtNotes_Create();
		$this->txtBoxSampleSlot_Create();
		$this->txtParentId_Create();
		$this->lstContainerType_Create();
		$this->lstStateType_Create();
		$this->txtVolume_Create();
		$this->txtVolumeUnit_Create();
		$this->txtConcentration_Create();
		$this->txtConcentrationUnit_Create();
		$this->calStateDate_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
	}


	// Create and Setup lstStudyType
	protected function lstStudyType_Create() {
		$this->lstStudyType = new QListBox($this);
		$this->lstStudyType->CssClass = '';
		$this->lstStudyType->Name = QApplication::Translate('Study Type');
		$this->lstStudyType->AddItem(QApplication::Translate('- Select One -'), null);
		$objStudyArray = FmStudy::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::FmStudy()->Name)));
		foreach ($objStudyArray as $objStudy)
			$this->lstStudyType->AddItem(new QListItem($objStudy->Name, $objStudy->Id, $this->objSample->StudyTypeId == $objStudy->Id));
	}

	// Create and Setup lstSampleType
	protected function lstSampleType_Create() {
		$this->lstSampleType = new QListBox($this);
		$this->lstSampleType->CssClass = '';
		$this->lstSampleType->Name = QApplication::Translate('Sample Type');
		$this->lstSampleType->AddItem(QApplication::Translate('- Select One -'), null);
		$objSampleTypeArray = SampleTypes::LoadAll();
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			if (($this->objSample->SampleType) && ($this->objSample->SampleType->Id == $objSampleType->Id))
				$objListItem->Selected = true;
			$this->lstSampleType->AddItem($objListItem);
		}
	}


	// Create and Setup txtStudyCase
	protected function txtStudyCase_Create() {
		$this->txtStudyCase = new QTextBox($this);
		$this->txtStudyCase->Name = QApplication::Translate('Study Case');
		$this->txtStudyCase->Text = $this->objSample->StudyCase;
		$this->txtStudyCase->MaxLength = Sample::StudyCaseMaxLength;
		$this->txtStudyCase->Width = '100px';
	}

	// Create and Setup txtSampleNumber
	protected function txtSampleNumber_Create() {
		$this->txtSampleNumber = new QIntegerTextBox($this);
		$this->txtSampleNumber->Name = QApplication::Translate('Sample Number');
		$this->txtSampleNumber->Text = $this->objSample->SampleNumber;
		$this->txtSampleNumber->Width = '25px';
	}

	// Create and Setup txtBarcode
	protected function txtBarcode_Create() {
		$this->txtBarcode = new QTextBox($this);
		$this->txtBarcode->Name = QApplication::Translate('Barcode');
		$this->txtBarcode->Text = $this->objSample->Barcode;
		$this->txtBarcode->MaxLength = Sample::BarcodeMaxLength;
	}

	// Create and Setup lstContainerType
	protected function lstContainerType_Create() {
		$this->lstContainerType = new QListBox($this);
		$this->lstContainerType->CssClass = '';
		$this->lstContainerType->Name = QApplication::Translate('Container Type');
		$this->lstContainerType->AddItem(QApplication::Translate('- Select One -'), null);
		$objContainerTypeArray = SampleContainerTypes::LoadAll();
		if ($objContainerTypeArray) foreach ($objContainerTypeArray as $objContainerType) {
			$objListItem = new QListItem($objContainerType->__toString(), $objContainerType->Id);
			if (($this->objSample->ContainerType) && ($this->objSample->ContainerType->Id == $objContainerType->Id))
				$objListItem->Selected = true;
			$this->lstContainerType->AddItem($objListItem);
		}
	}

	// Create and Setup lstStateType
	protected function lstStateType_Create() {
		$this->lstStateType = new QListBox($this);
		$this->lstStateType->CssClass = '';
		$this->lstStateType->Name = QApplication::Translate('State/Status of the sample');
		$this->lstStateType->AddItem(QApplication::Translate('- Select One -'), null);
		$objStateTypeArray = SampleStateTypes::LoadAll();
		if ($objStateTypeArray) foreach ($objStateTypeArray as $objStateType) {
			$objListItem = new QListItem($objStateType->__toString(), $objStateType->Id);
			if (($this->objSample->StateType) && ($this->objSample->StateType->Id == $objStateType->Id))
				$objListItem->Selected = true;
			$this->lstStateType->AddItem($objListItem);
		}
	}

	// Create and Setup txtVolume
	protected function txtVolume_Create() {
		$this->txtVolume = new QFloatTextBox($this);
		$this->txtVolume->Name = QApplication::Translate('Volume');
		$this->txtVolume->Text = $this->objSample->Volume;
		$this->txtVolume->Width = '100px';
	}

	// Create and Setup txtVolumeUnit
	protected function txtVolumeUnit_Create() {
		$this->txtVolumeUnit = new QTextBox($this);
		$this->txtVolumeUnit->Name = QApplication::Translate('Volume Unit');
		$this->txtVolumeUnit->Text = $this->objSample->VolumeUnit;
		$this->txtVolumeUnit->MaxLength = Sample::VolumeUnitMaxLength;
		$this->txtVolumeUnit->Width = '75px';
	}

	// Create and Setup txtConcentration
	protected function txtConcentration_Create() {
		$this->txtConcentration = new QFloatTextBox($this);
		$this->txtConcentration->Name = QApplication::Translate('Concentration');
		$this->txtConcentration->Text = $this->objSample->Concentration;
		$this->txtConcentration->Width = '100px';
	}

	// Create and Setup txtConcentrationUnit
	protected function txtConcentrationUnit_Create() {
		$this->txtConcentrationUnit = new QTextBox($this);
		$this->txtConcentrationUnit->Name = QApplication::Translate('Concentration Unit');
		$this->txtConcentrationUnit->Text = $this->objSample->ConcentrationUnit;
		$this->txtConcentrationUnit->MaxLength = Sample::ConcentrationUnitMaxLength;
		$this->txtConcentrationUnit->Width = '75px';
	}

	// Create and Setup calStateDate
	protected function calStateDate_Create() {
		$this->calStateDate = new QJsCalendar($this);
		$this->calStateDate->Name = QApplication::Translate('State/Status Date');
		$this->calStateDate->DateTime = $this->objSample->StateDate;
	}

	// Create and Setup txtNotes
	protected function txtNotes_Create() {
		$this->txtNotes = new QTextBox($this);
		$this->txtNotes->Name = QApplication::Translate('Notes');
		$this->txtNotes->Text = $this->objSample->Notes;
		$this->txtNotes->Width = '100%';
		$this->txtNotes->Rows = 2;
		$this->txtNotes->TextMode = QTextMode::MultiLine;
		$this->txtNotes->MaxLength = Sample::NotesMaxLength;
	}

	// Create and Setup txtBoxSampleSlot
	protected function txtBoxSampleSlot_Create() {
		$this->txtBoxSampleSlot = new QIntegerTextBox($this);
		$this->txtBoxSampleSlot->Name = QApplication::Translate('Box Sample Slot');
		$this->txtBoxSampleSlot->Text = $this->objSample->BoxSampleSlot;
		$this->txtBoxSampleSlot->Width = '50px';
	}

	protected function lstBox_Create() {
		$this->lstBox = new QListBox($this);
		$this->lstBox->Name = QApplication::Translate('Box');
		$this->lstBox->AddItem(QApplication::Translate('- Select One -'), null);
		$objBoxArray = Box::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::Box()->Name)),null,array('id','name'));
		if ($objBoxArray) foreach ($objBoxArray as $objBox) {
			$objListItem = new QListItem($objBox->__toString(), $objBox->Id);
			if (($this->objSample->Box) && ($this->objSample->Box->Id == $objBox->Id))
				$objListItem->Selected = true;
			$this->lstBox->AddItem($objListItem);
		}
	}


	protected function RedirectToListPage() {
		if ($this->strReturn != '')
			QApplication::Redirect($this->strReturn.'.php');
		// if the sample is in a box then return to the box view, otherwise show the samples list
		elseif ($this->lstBox->SelectedValue != '') QApplication::Redirect('box-view.php?intId='.$this->lstBox->SelectedValue);
		else QApplication::Redirect('samples.php');
	}
	
	protected function UpdateSampleFields() {
		$this->objSample->StudyTypeId = $this->lstStudyType->SelectedValue;
		$this->objSample->ParticipantId = $this->txtParticipantId->Text;
		$this->objSample->SampleTypeId = $this->lstSampleType->SelectedValue;
		$this->objSample->SampleNumber = $this->txtSampleNumber->Text;
		$this->objSample->Barcode = $this->txtBarcode->Text;
		$this->objSample->StudyCase = $this->txtStudyCase->Text;
		$this->objSample->Sampleloc = $this->txtSampleloc->Text;
		$this->objSample->BoxId = $this->lstBox->SelectedValue;
		$this->objSample->Notes = $this->txtNotes->Text;
		$this->objSample->BoxSampleSlot = $this->txtBoxSampleSlot->Text;
		$this->objSample->ParentId = $this->txtParentId->Text;
		$this->objSample->ContainerTypeId = $this->lstContainerType->SelectedValue;
		$this->objSample->StateTypeId = $this->lstStateType->SelectedValue;
		$this->objSample->Volume = $this->txtVolume->Text;
		$this->objSample->VolumeUnit = $this->txtVolumeUnit->Text;
		$this->objSample->Concentration = $this->txtConcentration->Text;
		$this->objSample->ConcentrationUnit = $this->txtConcentrationUnit->Text;
		$this->objSample->StateDate = $this->calStateDate->DateTime;
	}

	// Control ServerActions
	protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateSampleFields();
		$this->objSample->Save();
		if ($this->blnEditMode)
			ActionLog::LogSampleAction(5,$this->objSample);	// track the sample update
		else
			ActionLog::LogSampleAction(4,$this->objSample);	// track sample insert
		$this->RedirectToListPage();
	}
}


// go to the centralized form executing access control function to run the form and check access control
ACL_Run('sample_edit');
?>