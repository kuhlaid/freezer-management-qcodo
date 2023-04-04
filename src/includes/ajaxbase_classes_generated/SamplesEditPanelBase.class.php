<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the Samples class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single Samples object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this SamplesEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SamplesEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objSamples;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for Samples's Data Fields
	public $lblId;
	public $txtCaseid;
	public $txtSamplenum;
	public $txtSamploc;
	public $txtSamptype;
	public $txtBoxid;
	public $txtUsername;
	public $txtThawed;
	public $txtOnmanifest;
	public $txtLoggedout;
	public $calToenaildate;
	public $txtToenailshipped;
	public $calChlclin;
	public $calChllabcorp;
	public $txtBscbook;
	public $txtBscpage;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupSamples($objSamples) {
		if ($objSamples) {
			$this->objSamples = $objSamples;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objSamples = new Samples();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objSamples = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupSamples to either Load/Edit Existing or Create New
		$this->SetupSamples($objSamples);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for Samples's Data Fields
		$this->lblId_Create();
		$this->txtCaseid_Create();
		$this->txtSamplenum_Create();
		$this->txtSamploc_Create();
		$this->txtSamptype_Create();
		$this->txtBoxid_Create();
		$this->txtUsername_Create();
		$this->txtThawed_Create();
		$this->txtOnmanifest_Create();
		$this->txtLoggedout_Create();
		$this->calToenaildate_Create();
		$this->txtToenailshipped_Create();
		$this->calChlclin_Create();
		$this->calChllabcorp_Create();
		$this->txtBscbook_Create();
		$this->txtBscpage_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
	}

	// Protected Create Methods
	// Create and Setup lblId
	protected function lblId_Create() {
		$this->lblId = new QLabel($this);
		$this->lblId->Name = QApplication::Translate('Id');
		if ($this->blnEditMode)
			$this->lblId->Text = $this->objSamples->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup txtCaseid
	protected function txtCaseid_Create() {
		$this->txtCaseid = new QTextBox($this);
		$this->txtCaseid->Name = QApplication::Translate('Caseid');
		$this->txtCaseid->Text = $this->objSamples->Caseid;
		$this->txtCaseid->Required = true;
		$this->txtCaseid->MaxLength = Samples::CaseidMaxLength;
	}

	// Create and Setup txtSamplenum
	protected function txtSamplenum_Create() {
		$this->txtSamplenum = new QTextBox($this);
		$this->txtSamplenum->Name = QApplication::Translate('Samplenum');
		$this->txtSamplenum->Text = $this->objSamples->Samplenum;
		$this->txtSamplenum->Required = true;
		$this->txtSamplenum->MaxLength = Samples::SamplenumMaxLength;
	}

	// Create and Setup txtSamploc
	protected function txtSamploc_Create() {
		$this->txtSamploc = new QTextBox($this);
		$this->txtSamploc->Name = QApplication::Translate('Samploc');
		$this->txtSamploc->Text = $this->objSamples->Samploc;
		$this->txtSamploc->Required = true;
		$this->txtSamploc->MaxLength = Samples::SamplocMaxLength;
	}

	// Create and Setup txtSamptype
	protected function txtSamptype_Create() {
		$this->txtSamptype = new QTextBox($this);
		$this->txtSamptype->Name = QApplication::Translate('Samptype');
		$this->txtSamptype->Text = $this->objSamples->Samptype;
		$this->txtSamptype->Required = true;
		$this->txtSamptype->MaxLength = Samples::SamptypeMaxLength;
	}

	// Create and Setup txtBoxid
	protected function txtBoxid_Create() {
		$this->txtBoxid = new QIntegerTextBox($this);
		$this->txtBoxid->Name = QApplication::Translate('Boxid');
		$this->txtBoxid->Text = $this->objSamples->Boxid;
		$this->txtBoxid->Required = true;
	}

	// Create and Setup txtUsername
	protected function txtUsername_Create() {
		$this->txtUsername = new QTextBox($this);
		$this->txtUsername->Name = QApplication::Translate('Username');
		$this->txtUsername->Text = $this->objSamples->Username;
		$this->txtUsername->Required = true;
		$this->txtUsername->MaxLength = Samples::UsernameMaxLength;
	}

	// Create and Setup txtThawed
	protected function txtThawed_Create() {
		$this->txtThawed = new QIntegerTextBox($this);
		$this->txtThawed->Name = QApplication::Translate('Thawed');
		$this->txtThawed->Text = $this->objSamples->Thawed;
		$this->txtThawed->Required = true;
	}

	// Create and Setup txtOnmanifest
	protected function txtOnmanifest_Create() {
		$this->txtOnmanifest = new QIntegerTextBox($this);
		$this->txtOnmanifest->Name = QApplication::Translate('Onmanifest');
		$this->txtOnmanifest->Text = $this->objSamples->Onmanifest;
		$this->txtOnmanifest->Required = true;
	}

	// Create and Setup txtLoggedout
	protected function txtLoggedout_Create() {
		$this->txtLoggedout = new QIntegerTextBox($this);
		$this->txtLoggedout->Name = QApplication::Translate('Loggedout');
		$this->txtLoggedout->Text = $this->objSamples->Loggedout;
		$this->txtLoggedout->Required = true;
	}

	// Create and Setup calToenaildate
	protected function calToenaildate_Create() {
		$this->calToenaildate = new QDateTimePicker($this);
		$this->calToenaildate->Name = QApplication::Translate('Toenaildate');
		$this->calToenaildate->DateTime = $this->objSamples->Toenaildate;
		$this->calToenaildate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtToenailshipped
	protected function txtToenailshipped_Create() {
		$this->txtToenailshipped = new QIntegerTextBox($this);
		$this->txtToenailshipped->Name = QApplication::Translate('Toenailshipped');
		$this->txtToenailshipped->Text = $this->objSamples->Toenailshipped;
		$this->txtToenailshipped->Required = true;
	}

	// Create and Setup calChlclin
	protected function calChlclin_Create() {
		$this->calChlclin = new QDateTimePicker($this);
		$this->calChlclin->Name = QApplication::Translate('Chlclin');
		$this->calChlclin->DateTime = $this->objSamples->Chlclin;
		$this->calChlclin->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calChllabcorp
	protected function calChllabcorp_Create() {
		$this->calChllabcorp = new QDateTimePicker($this);
		$this->calChllabcorp->Name = QApplication::Translate('Chllabcorp');
		$this->calChllabcorp->DateTime = $this->objSamples->Chllabcorp;
		$this->calChllabcorp->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtBscbook
	protected function txtBscbook_Create() {
		$this->txtBscbook = new QTextBox($this);
		$this->txtBscbook->Name = QApplication::Translate('Bscbook');
		$this->txtBscbook->Text = $this->objSamples->Bscbook;
		$this->txtBscbook->MaxLength = Samples::BscbookMaxLength;
	}

	// Create and Setup txtBscpage
	protected function txtBscpage_Create() {
		$this->txtBscpage = new QTextBox($this);
		$this->txtBscpage->Name = QApplication::Translate('Bscpage');
		$this->txtBscpage->Text = $this->objSamples->Bscpage;
		$this->txtBscpage->MaxLength = Samples::BscpageMaxLength;
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Samples')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateSamplesFields() {
		$this->objSamples->Caseid = $this->txtCaseid->Text;
		$this->objSamples->Samplenum = $this->txtSamplenum->Text;
		$this->objSamples->Samploc = $this->txtSamploc->Text;
		$this->objSamples->Samptype = $this->txtSamptype->Text;
		$this->objSamples->Boxid = $this->txtBoxid->Text;
		$this->objSamples->Username = $this->txtUsername->Text;
		$this->objSamples->Thawed = $this->txtThawed->Text;
		$this->objSamples->Onmanifest = $this->txtOnmanifest->Text;
		$this->objSamples->Loggedout = $this->txtLoggedout->Text;
		$this->objSamples->Toenaildate = $this->calToenaildate->DateTime;
		$this->objSamples->Toenailshipped = $this->txtToenailshipped->Text;
		$this->objSamples->Chlclin = $this->calChlclin->DateTime;
		$this->objSamples->Chllabcorp = $this->calChllabcorp->DateTime;
		$this->objSamples->Bscbook = $this->txtBscbook->Text;
		$this->objSamples->Bscpage = $this->txtBscpage->Text;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateSamplesFields();
		$this->objSamples->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objSamples->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>