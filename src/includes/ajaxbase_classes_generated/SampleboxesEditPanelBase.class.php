<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the Sampleboxes class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single Sampleboxes object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this SampleboxesEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleboxesEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objSampleboxes;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for Sampleboxes's Data Fields
	public $txtId;
	public $txtIncounty;
	public $calIncountydate;
	public $txtCountyuser;
	public $txtChapelhilluser;
	public $txtIntransit;
	public $calIntransitdate;
	public $txtTrackingnum;
	public $txtReadytoship;
	public $calReadytoshipdate;
	public $txtInchapelhill;
	public $txtIncdc;
	public $calIncdcdate;
	public $txtCdcuser;
	public $calInchapelhilldate;
	public $txtSamptype;
	public $txtFreezer;
	public $txtRack;
	public $txtBox;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupSampleboxes($objSampleboxes) {
		if ($objSampleboxes) {
			$this->objSampleboxes = $objSampleboxes;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objSampleboxes = new Sampleboxes();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objSampleboxes = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupSampleboxes to either Load/Edit Existing or Create New
		$this->SetupSampleboxes($objSampleboxes);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for Sampleboxes's Data Fields
		$this->txtId_Create();
		$this->txtIncounty_Create();
		$this->calIncountydate_Create();
		$this->txtCountyuser_Create();
		$this->txtChapelhilluser_Create();
		$this->txtIntransit_Create();
		$this->calIntransitdate_Create();
		$this->txtTrackingnum_Create();
		$this->txtReadytoship_Create();
		$this->calReadytoshipdate_Create();
		$this->txtInchapelhill_Create();
		$this->txtIncdc_Create();
		$this->calIncdcdate_Create();
		$this->txtCdcuser_Create();
		$this->calInchapelhilldate_Create();
		$this->txtSamptype_Create();
		$this->txtFreezer_Create();
		$this->txtRack_Create();
		$this->txtBox_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
	}

	// Protected Create Methods
	// Create and Setup txtId
	protected function txtId_Create() {
		$this->txtId = new QIntegerTextBox($this);
		$this->txtId->Name = QApplication::Translate('Id');
		$this->txtId->Text = $this->objSampleboxes->Id;
		$this->txtId->Required = true;
	}

	// Create and Setup txtIncounty
	protected function txtIncounty_Create() {
		$this->txtIncounty = new QIntegerTextBox($this);
		$this->txtIncounty->Name = QApplication::Translate('Incounty');
		$this->txtIncounty->Text = $this->objSampleboxes->Incounty;
		$this->txtIncounty->Required = true;
	}

	// Create and Setup calIncountydate
	protected function calIncountydate_Create() {
		$this->calIncountydate = new QDateTimePicker($this);
		$this->calIncountydate->Name = QApplication::Translate('Incountydate');
		$this->calIncountydate->DateTime = $this->objSampleboxes->Incountydate;
		$this->calIncountydate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtCountyuser
	protected function txtCountyuser_Create() {
		$this->txtCountyuser = new QTextBox($this);
		$this->txtCountyuser->Name = QApplication::Translate('Countyuser');
		$this->txtCountyuser->Text = $this->objSampleboxes->Countyuser;
		$this->txtCountyuser->MaxLength = Sampleboxes::CountyuserMaxLength;
	}

	// Create and Setup txtChapelhilluser
	protected function txtChapelhilluser_Create() {
		$this->txtChapelhilluser = new QTextBox($this);
		$this->txtChapelhilluser->Name = QApplication::Translate('Chapelhilluser');
		$this->txtChapelhilluser->Text = $this->objSampleboxes->Chapelhilluser;
		$this->txtChapelhilluser->MaxLength = Sampleboxes::ChapelhilluserMaxLength;
	}

	// Create and Setup txtIntransit
	protected function txtIntransit_Create() {
		$this->txtIntransit = new QIntegerTextBox($this);
		$this->txtIntransit->Name = QApplication::Translate('Intransit');
		$this->txtIntransit->Text = $this->objSampleboxes->Intransit;
	}

	// Create and Setup calIntransitdate
	protected function calIntransitdate_Create() {
		$this->calIntransitdate = new QDateTimePicker($this);
		$this->calIntransitdate->Name = QApplication::Translate('Intransitdate');
		$this->calIntransitdate->DateTime = $this->objSampleboxes->Intransitdate;
		$this->calIntransitdate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtTrackingnum
	protected function txtTrackingnum_Create() {
		$this->txtTrackingnum = new QTextBox($this);
		$this->txtTrackingnum->Name = QApplication::Translate('Trackingnum');
		$this->txtTrackingnum->Text = $this->objSampleboxes->Trackingnum;
		$this->txtTrackingnum->MaxLength = Sampleboxes::TrackingnumMaxLength;
	}

	// Create and Setup txtReadytoship
	protected function txtReadytoship_Create() {
		$this->txtReadytoship = new QIntegerTextBox($this);
		$this->txtReadytoship->Name = QApplication::Translate('Readytoship');
		$this->txtReadytoship->Text = $this->objSampleboxes->Readytoship;
		$this->txtReadytoship->Required = true;
	}

	// Create and Setup calReadytoshipdate
	protected function calReadytoshipdate_Create() {
		$this->calReadytoshipdate = new QDateTimePicker($this);
		$this->calReadytoshipdate->Name = QApplication::Translate('Readytoshipdate');
		$this->calReadytoshipdate->DateTime = $this->objSampleboxes->Readytoshipdate;
		$this->calReadytoshipdate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtInchapelhill
	protected function txtInchapelhill_Create() {
		$this->txtInchapelhill = new QIntegerTextBox($this);
		$this->txtInchapelhill->Name = QApplication::Translate('Inchapelhill');
		$this->txtInchapelhill->Text = $this->objSampleboxes->Inchapelhill;
	}

	// Create and Setup txtIncdc
	protected function txtIncdc_Create() {
		$this->txtIncdc = new QIntegerTextBox($this);
		$this->txtIncdc->Name = QApplication::Translate('Incdc');
		$this->txtIncdc->Text = $this->objSampleboxes->Incdc;
		$this->txtIncdc->Required = true;
	}

	// Create and Setup calIncdcdate
	protected function calIncdcdate_Create() {
		$this->calIncdcdate = new QDateTimePicker($this);
		$this->calIncdcdate->Name = QApplication::Translate('Incdcdate');
		$this->calIncdcdate->DateTime = $this->objSampleboxes->Incdcdate;
		$this->calIncdcdate->DateTimePickerType = QDateTimePickerType::Date;
		$this->calIncdcdate->Required = true;
	}

	// Create and Setup txtCdcuser
	protected function txtCdcuser_Create() {
		$this->txtCdcuser = new QTextBox($this);
		$this->txtCdcuser->Name = QApplication::Translate('Cdcuser');
		$this->txtCdcuser->Text = $this->objSampleboxes->Cdcuser;
		$this->txtCdcuser->Required = true;
		$this->txtCdcuser->MaxLength = Sampleboxes::CdcuserMaxLength;
	}

	// Create and Setup calInchapelhilldate
	protected function calInchapelhilldate_Create() {
		$this->calInchapelhilldate = new QDateTimePicker($this);
		$this->calInchapelhilldate->Name = QApplication::Translate('Inchapelhilldate');
		$this->calInchapelhilldate->DateTime = $this->objSampleboxes->Inchapelhilldate;
		$this->calInchapelhilldate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtSamptype
	protected function txtSamptype_Create() {
		$this->txtSamptype = new QTextBox($this);
		$this->txtSamptype->Name = QApplication::Translate('Samptype');
		$this->txtSamptype->Text = $this->objSampleboxes->Samptype;
		$this->txtSamptype->MaxLength = Sampleboxes::SamptypeMaxLength;
	}

	// Create and Setup txtFreezer
	protected function txtFreezer_Create() {
		$this->txtFreezer = new QTextBox($this);
		$this->txtFreezer->Name = QApplication::Translate('Freezer');
		$this->txtFreezer->Text = $this->objSampleboxes->Freezer;
		$this->txtFreezer->MaxLength = Sampleboxes::FreezerMaxLength;
	}

	// Create and Setup txtRack
	protected function txtRack_Create() {
		$this->txtRack = new QTextBox($this);
		$this->txtRack->Name = QApplication::Translate('Rack');
		$this->txtRack->Text = $this->objSampleboxes->Rack;
		$this->txtRack->MaxLength = Sampleboxes::RackMaxLength;
	}

	// Create and Setup txtBox
	protected function txtBox_Create() {
		$this->txtBox = new QTextBox($this);
		$this->txtBox->Name = QApplication::Translate('Box');
		$this->txtBox->Text = $this->objSampleboxes->Box;
		$this->txtBox->MaxLength = Sampleboxes::BoxMaxLength;
	}


	// Setup btnSave
	protected function btnSave_Create() {
		$this->btnSave = new QButton($this);
		$this->btnSave->Text = QApplication::Translate('Save');
		$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
		$this->btnSave->PrimaryButton = true;
		$this->btnSave->CausesValidation = true;
	}

	// Setup btnCancel
	protected function btnCancel_Create() {
		$this->btnCancel = new QButton($this);
		$this->btnCancel->Text = QApplication::Translate('Cancel');
		$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));
		$this->btnCancel->CausesValidation = false;
	}

	// Setup btnDelete
	protected function btnDelete_Create() {
		$this->btnDelete = new QButton($this);
		$this->btnDelete->Text = QApplication::Translate('Delete');
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Sampleboxes')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateSampleboxesFields() {
		$this->objSampleboxes->Id = $this->txtId->Text;
		$this->objSampleboxes->Incounty = $this->txtIncounty->Text;
		$this->objSampleboxes->Incountydate = $this->calIncountydate->DateTime;
		$this->objSampleboxes->Countyuser = $this->txtCountyuser->Text;
		$this->objSampleboxes->Chapelhilluser = $this->txtChapelhilluser->Text;
		$this->objSampleboxes->Intransit = $this->txtIntransit->Text;
		$this->objSampleboxes->Intransitdate = $this->calIntransitdate->DateTime;
		$this->objSampleboxes->Trackingnum = $this->txtTrackingnum->Text;
		$this->objSampleboxes->Readytoship = $this->txtReadytoship->Text;
		$this->objSampleboxes->Readytoshipdate = $this->calReadytoshipdate->DateTime;
		$this->objSampleboxes->Inchapelhill = $this->txtInchapelhill->Text;
		$this->objSampleboxes->Incdc = $this->txtIncdc->Text;
		$this->objSampleboxes->Incdcdate = $this->calIncdcdate->DateTime;
		$this->objSampleboxes->Cdcuser = $this->txtCdcuser->Text;
		$this->objSampleboxes->Inchapelhilldate = $this->calInchapelhilldate->DateTime;
		$this->objSampleboxes->Samptype = $this->txtSamptype->Text;
		$this->objSampleboxes->Freezer = $this->txtFreezer->Text;
		$this->objSampleboxes->Rack = $this->txtRack->Text;
		$this->objSampleboxes->Box = $this->txtBox->Text;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateSampleboxesFields();
		$this->objSampleboxes->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objSampleboxes->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>