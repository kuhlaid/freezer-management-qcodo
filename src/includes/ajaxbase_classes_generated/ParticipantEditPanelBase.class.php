<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the Participant class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single Participant object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this ParticipantEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class ParticipantEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objParticipant;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for Participant's Data Fields
	public $txtCaseid;
	public $txtTitle;
	public $txtLastname;
	public $txtFirstname;
	public $txtMiddlename;
	public $txtMaidenname;
	public $txtNickname;
	public $txtStreet;
	public $txtStreetsort;
	public $txtPobox;
	public $txtCity;
	public $txtState;
	public $txtZip;
	public $txtHomephone;
	public $txtOtherphone;
	public $txtGender;
	public $txtRace;
	public $calDateofbirth;
	public $txtNumhouse;
	public $txtTypedwelling;
	public $txtTypedwellingother;
	public $txtRentorown;
	public $txtRentorownother;
	public $txtMaritalstatus;
	public $txtEmail;
	public $txtC1name;
	public $txtC1street;
	public $txtC1pobox;
	public $txtC1city;
	public $txtC1state;
	public $txtC1zip;
	public $txtC1phone;
	public $txtC1relation;
	public $txtC2name;
	public $txtC2street;
	public $txtC2pobox;
	public $txtC2city;
	public $txtC2state;
	public $txtC2zip;
	public $txtC2phone;
	public $txtC2relation;
	public $txtC3name;
	public $txtC3street;
	public $txtC3pobox;
	public $txtC3city;
	public $txtC3state;
	public $txtC3zip;
	public $txtC3phone;
	public $txtC3relation;
	public $txtBasecode;
	public $txtF1code;
	public $txtNecode;
	public $txtCurrentcode;
	public $txtPostcode;
	public $calBase1stint;
	public $calBaseclinic;
	public $calBase2ndint;
	public $calF11stint;
	public $calF1clinic;
	public $calF12ndint;
	public $calNe1stint;
	public $calNeclinic;
	public $calNe2ndint;
	public $calF21stint;
	public $calF2clinic;
	public $calF22ndint;
	public $txtBuddyid;
	public $calBuddydate;
	public $txtAcesid;
	public $calAces1stint;
	public $calAces2ndint;
	public $txtGogoindid;
	public $txtGogofamid;
	public $calGogodate;
	public $txtGogolongid;
	public $calGogolongdate;
	public $txtJoproid;
	public $calJoprodate;
	public $txtJoprocont;
	public $txtJoprocomp;
	public $calLastcodeupdate;
	public $calPostcodeupdate;
	public $txtT0weight;
	public $txtT1weight;
	public $txtNotes;
	public $txtOtherstudy;
	public $txtHomeinterviewer;
	public $lblId;
	public $lstInterviewer;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupParticipant($objParticipant) {
		if ($objParticipant) {
			$this->objParticipant = $objParticipant;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objParticipant = new Participant();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objParticipant = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupParticipant to either Load/Edit Existing or Create New
		$this->SetupParticipant($objParticipant);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for Participant's Data Fields
		$this->txtCaseid_Create();
		$this->txtTitle_Create();
		$this->txtLastname_Create();
		$this->txtFirstname_Create();
		$this->txtMiddlename_Create();
		$this->txtMaidenname_Create();
		$this->txtNickname_Create();
		$this->txtStreet_Create();
		$this->txtStreetsort_Create();
		$this->txtPobox_Create();
		$this->txtCity_Create();
		$this->txtState_Create();
		$this->txtZip_Create();
		$this->txtHomephone_Create();
		$this->txtOtherphone_Create();
		$this->txtGender_Create();
		$this->txtRace_Create();
		$this->calDateofbirth_Create();
		$this->txtNumhouse_Create();
		$this->txtTypedwelling_Create();
		$this->txtTypedwellingother_Create();
		$this->txtRentorown_Create();
		$this->txtRentorownother_Create();
		$this->txtMaritalstatus_Create();
		$this->txtEmail_Create();
		$this->txtC1name_Create();
		$this->txtC1street_Create();
		$this->txtC1pobox_Create();
		$this->txtC1city_Create();
		$this->txtC1state_Create();
		$this->txtC1zip_Create();
		$this->txtC1phone_Create();
		$this->txtC1relation_Create();
		$this->txtC2name_Create();
		$this->txtC2street_Create();
		$this->txtC2pobox_Create();
		$this->txtC2city_Create();
		$this->txtC2state_Create();
		$this->txtC2zip_Create();
		$this->txtC2phone_Create();
		$this->txtC2relation_Create();
		$this->txtC3name_Create();
		$this->txtC3street_Create();
		$this->txtC3pobox_Create();
		$this->txtC3city_Create();
		$this->txtC3state_Create();
		$this->txtC3zip_Create();
		$this->txtC3phone_Create();
		$this->txtC3relation_Create();
		$this->txtBasecode_Create();
		$this->txtF1code_Create();
		$this->txtNecode_Create();
		$this->txtCurrentcode_Create();
		$this->txtPostcode_Create();
		$this->calBase1stint_Create();
		$this->calBaseclinic_Create();
		$this->calBase2ndint_Create();
		$this->calF11stint_Create();
		$this->calF1clinic_Create();
		$this->calF12ndint_Create();
		$this->calNe1stint_Create();
		$this->calNeclinic_Create();
		$this->calNe2ndint_Create();
		$this->calF21stint_Create();
		$this->calF2clinic_Create();
		$this->calF22ndint_Create();
		$this->txtBuddyid_Create();
		$this->calBuddydate_Create();
		$this->txtAcesid_Create();
		$this->calAces1stint_Create();
		$this->calAces2ndint_Create();
		$this->txtGogoindid_Create();
		$this->txtGogofamid_Create();
		$this->calGogodate_Create();
		$this->txtGogolongid_Create();
		$this->calGogolongdate_Create();
		$this->txtJoproid_Create();
		$this->calJoprodate_Create();
		$this->txtJoprocont_Create();
		$this->txtJoprocomp_Create();
		$this->calLastcodeupdate_Create();
		$this->calPostcodeupdate_Create();
		$this->txtT0weight_Create();
		$this->txtT1weight_Create();
		$this->txtNotes_Create();
		$this->txtOtherstudy_Create();
		$this->txtHomeinterviewer_Create();
		$this->lblId_Create();
		$this->lstInterviewer_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
	}

	// Protected Create Methods
	// Create and Setup txtCaseid
	protected function txtCaseid_Create() {
		$this->txtCaseid = new QTextBox($this);
		$this->txtCaseid->Name = QApplication::Translate('Caseid');
		$this->txtCaseid->Text = $this->objParticipant->Caseid;
		$this->txtCaseid->Required = true;
		$this->txtCaseid->MaxLength = Participant::CaseidMaxLength;
	}

	// Create and Setup txtTitle
	protected function txtTitle_Create() {
		$this->txtTitle = new QTextBox($this);
		$this->txtTitle->Name = QApplication::Translate('Title');
		$this->txtTitle->Text = $this->objParticipant->Title;
		$this->txtTitle->MaxLength = Participant::TitleMaxLength;
	}

	// Create and Setup txtLastname
	protected function txtLastname_Create() {
		$this->txtLastname = new QTextBox($this);
		$this->txtLastname->Name = QApplication::Translate('Lastname');
		$this->txtLastname->Text = $this->objParticipant->Lastname;
		$this->txtLastname->MaxLength = Participant::LastnameMaxLength;
	}

	// Create and Setup txtFirstname
	protected function txtFirstname_Create() {
		$this->txtFirstname = new QTextBox($this);
		$this->txtFirstname->Name = QApplication::Translate('Firstname');
		$this->txtFirstname->Text = $this->objParticipant->Firstname;
		$this->txtFirstname->MaxLength = Participant::FirstnameMaxLength;
	}

	// Create and Setup txtMiddlename
	protected function txtMiddlename_Create() {
		$this->txtMiddlename = new QTextBox($this);
		$this->txtMiddlename->Name = QApplication::Translate('Middlename');
		$this->txtMiddlename->Text = $this->objParticipant->Middlename;
		$this->txtMiddlename->MaxLength = Participant::MiddlenameMaxLength;
	}

	// Create and Setup txtMaidenname
	protected function txtMaidenname_Create() {
		$this->txtMaidenname = new QTextBox($this);
		$this->txtMaidenname->Name = QApplication::Translate('Maidenname');
		$this->txtMaidenname->Text = $this->objParticipant->Maidenname;
		$this->txtMaidenname->MaxLength = Participant::MaidennameMaxLength;
	}

	// Create and Setup txtNickname
	protected function txtNickname_Create() {
		$this->txtNickname = new QTextBox($this);
		$this->txtNickname->Name = QApplication::Translate('Nickname');
		$this->txtNickname->Text = $this->objParticipant->Nickname;
		$this->txtNickname->MaxLength = Participant::NicknameMaxLength;
	}

	// Create and Setup txtStreet
	protected function txtStreet_Create() {
		$this->txtStreet = new QTextBox($this);
		$this->txtStreet->Name = QApplication::Translate('Street');
		$this->txtStreet->Text = $this->objParticipant->Street;
		$this->txtStreet->MaxLength = Participant::StreetMaxLength;
	}

	// Create and Setup txtStreetsort
	protected function txtStreetsort_Create() {
		$this->txtStreetsort = new QTextBox($this);
		$this->txtStreetsort->Name = QApplication::Translate('Streetsort');
		$this->txtStreetsort->Text = $this->objParticipant->Streetsort;
		$this->txtStreetsort->Required = true;
		$this->txtStreetsort->MaxLength = Participant::StreetsortMaxLength;
	}

	// Create and Setup txtPobox
	protected function txtPobox_Create() {
		$this->txtPobox = new QTextBox($this);
		$this->txtPobox->Name = QApplication::Translate('Pobox');
		$this->txtPobox->Text = $this->objParticipant->Pobox;
		$this->txtPobox->MaxLength = Participant::PoboxMaxLength;
	}

	// Create and Setup txtCity
	protected function txtCity_Create() {
		$this->txtCity = new QTextBox($this);
		$this->txtCity->Name = QApplication::Translate('City');
		$this->txtCity->Text = $this->objParticipant->City;
		$this->txtCity->MaxLength = Participant::CityMaxLength;
	}

	// Create and Setup txtState
	protected function txtState_Create() {
		$this->txtState = new QTextBox($this);
		$this->txtState->Name = QApplication::Translate('State');
		$this->txtState->Text = $this->objParticipant->State;
		$this->txtState->MaxLength = Participant::StateMaxLength;
	}

	// Create and Setup txtZip
	protected function txtZip_Create() {
		$this->txtZip = new QTextBox($this);
		$this->txtZip->Name = QApplication::Translate('Zip');
		$this->txtZip->Text = $this->objParticipant->Zip;
		$this->txtZip->MaxLength = Participant::ZipMaxLength;
	}

	// Create and Setup txtHomephone
	protected function txtHomephone_Create() {
		$this->txtHomephone = new QTextBox($this);
		$this->txtHomephone->Name = QApplication::Translate('Homephone');
		$this->txtHomephone->Text = $this->objParticipant->Homephone;
		$this->txtHomephone->MaxLength = Participant::HomephoneMaxLength;
	}

	// Create and Setup txtOtherphone
	protected function txtOtherphone_Create() {
		$this->txtOtherphone = new QTextBox($this);
		$this->txtOtherphone->Name = QApplication::Translate('Otherphone');
		$this->txtOtherphone->Text = $this->objParticipant->Otherphone;
		$this->txtOtherphone->MaxLength = Participant::OtherphoneMaxLength;
	}

	// Create and Setup txtGender
	protected function txtGender_Create() {
		$this->txtGender = new QTextBox($this);
		$this->txtGender->Name = QApplication::Translate('Gender');
		$this->txtGender->Text = $this->objParticipant->Gender;
		$this->txtGender->MaxLength = Participant::GenderMaxLength;
	}

	// Create and Setup txtRace
	protected function txtRace_Create() {
		$this->txtRace = new QTextBox($this);
		$this->txtRace->Name = QApplication::Translate('Race');
		$this->txtRace->Text = $this->objParticipant->Race;
		$this->txtRace->MaxLength = Participant::RaceMaxLength;
	}

	// Create and Setup calDateofbirth
	protected function calDateofbirth_Create() {
		$this->calDateofbirth = new QDateTimePicker($this);
		$this->calDateofbirth->Name = QApplication::Translate('Dateofbirth');
		$this->calDateofbirth->DateTime = $this->objParticipant->Dateofbirth;
		$this->calDateofbirth->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtNumhouse
	protected function txtNumhouse_Create() {
		$this->txtNumhouse = new QIntegerTextBox($this);
		$this->txtNumhouse->Name = QApplication::Translate('Numhouse');
		$this->txtNumhouse->Text = $this->objParticipant->Numhouse;
	}

	// Create and Setup txtTypedwelling
	protected function txtTypedwelling_Create() {
		$this->txtTypedwelling = new QIntegerTextBox($this);
		$this->txtTypedwelling->Name = QApplication::Translate('Typedwelling');
		$this->txtTypedwelling->Text = $this->objParticipant->Typedwelling;
	}

	// Create and Setup txtTypedwellingother
	protected function txtTypedwellingother_Create() {
		$this->txtTypedwellingother = new QTextBox($this);
		$this->txtTypedwellingother->Name = QApplication::Translate('Typedwellingother');
		$this->txtTypedwellingother->Text = $this->objParticipant->Typedwellingother;
		$this->txtTypedwellingother->MaxLength = Participant::TypedwellingotherMaxLength;
	}

	// Create and Setup txtRentorown
	protected function txtRentorown_Create() {
		$this->txtRentorown = new QIntegerTextBox($this);
		$this->txtRentorown->Name = QApplication::Translate('Rentorown');
		$this->txtRentorown->Text = $this->objParticipant->Rentorown;
	}

	// Create and Setup txtRentorownother
	protected function txtRentorownother_Create() {
		$this->txtRentorownother = new QTextBox($this);
		$this->txtRentorownother->Name = QApplication::Translate('Rentorownother');
		$this->txtRentorownother->Text = $this->objParticipant->Rentorownother;
		$this->txtRentorownother->MaxLength = Participant::RentorownotherMaxLength;
	}

	// Create and Setup txtMaritalstatus
	protected function txtMaritalstatus_Create() {
		$this->txtMaritalstatus = new QTextBox($this);
		$this->txtMaritalstatus->Name = QApplication::Translate('Maritalstatus');
		$this->txtMaritalstatus->Text = $this->objParticipant->Maritalstatus;
		$this->txtMaritalstatus->MaxLength = Participant::MaritalstatusMaxLength;
	}

	// Create and Setup txtEmail
	protected function txtEmail_Create() {
		$this->txtEmail = new QTextBox($this);
		$this->txtEmail->Name = QApplication::Translate('Email');
		$this->txtEmail->Text = $this->objParticipant->Email;
		$this->txtEmail->MaxLength = Participant::EmailMaxLength;
	}

	// Create and Setup txtC1name
	protected function txtC1name_Create() {
		$this->txtC1name = new QTextBox($this);
		$this->txtC1name->Name = QApplication::Translate('C 1 name');
		$this->txtC1name->Text = $this->objParticipant->C1name;
		$this->txtC1name->MaxLength = Participant::C1nameMaxLength;
	}

	// Create and Setup txtC1street
	protected function txtC1street_Create() {
		$this->txtC1street = new QTextBox($this);
		$this->txtC1street->Name = QApplication::Translate('C 1 street');
		$this->txtC1street->Text = $this->objParticipant->C1street;
		$this->txtC1street->MaxLength = Participant::C1streetMaxLength;
	}

	// Create and Setup txtC1pobox
	protected function txtC1pobox_Create() {
		$this->txtC1pobox = new QTextBox($this);
		$this->txtC1pobox->Name = QApplication::Translate('C 1 pobox');
		$this->txtC1pobox->Text = $this->objParticipant->C1pobox;
		$this->txtC1pobox->MaxLength = Participant::C1poboxMaxLength;
	}

	// Create and Setup txtC1city
	protected function txtC1city_Create() {
		$this->txtC1city = new QTextBox($this);
		$this->txtC1city->Name = QApplication::Translate('C 1 city');
		$this->txtC1city->Text = $this->objParticipant->C1city;
		$this->txtC1city->MaxLength = Participant::C1cityMaxLength;
	}

	// Create and Setup txtC1state
	protected function txtC1state_Create() {
		$this->txtC1state = new QTextBox($this);
		$this->txtC1state->Name = QApplication::Translate('C 1 state');
		$this->txtC1state->Text = $this->objParticipant->C1state;
		$this->txtC1state->MaxLength = Participant::C1stateMaxLength;
	}

	// Create and Setup txtC1zip
	protected function txtC1zip_Create() {
		$this->txtC1zip = new QTextBox($this);
		$this->txtC1zip->Name = QApplication::Translate('C 1 zip');
		$this->txtC1zip->Text = $this->objParticipant->C1zip;
		$this->txtC1zip->MaxLength = Participant::C1zipMaxLength;
	}

	// Create and Setup txtC1phone
	protected function txtC1phone_Create() {
		$this->txtC1phone = new QTextBox($this);
		$this->txtC1phone->Name = QApplication::Translate('C 1 phone');
		$this->txtC1phone->Text = $this->objParticipant->C1phone;
		$this->txtC1phone->MaxLength = Participant::C1phoneMaxLength;
	}

	// Create and Setup txtC1relation
	protected function txtC1relation_Create() {
		$this->txtC1relation = new QTextBox($this);
		$this->txtC1relation->Name = QApplication::Translate('C 1 relation');
		$this->txtC1relation->Text = $this->objParticipant->C1relation;
		$this->txtC1relation->MaxLength = Participant::C1relationMaxLength;
	}

	// Create and Setup txtC2name
	protected function txtC2name_Create() {
		$this->txtC2name = new QTextBox($this);
		$this->txtC2name->Name = QApplication::Translate('C 2 name');
		$this->txtC2name->Text = $this->objParticipant->C2name;
		$this->txtC2name->MaxLength = Participant::C2nameMaxLength;
	}

	// Create and Setup txtC2street
	protected function txtC2street_Create() {
		$this->txtC2street = new QTextBox($this);
		$this->txtC2street->Name = QApplication::Translate('C 2 street');
		$this->txtC2street->Text = $this->objParticipant->C2street;
		$this->txtC2street->MaxLength = Participant::C2streetMaxLength;
	}

	// Create and Setup txtC2pobox
	protected function txtC2pobox_Create() {
		$this->txtC2pobox = new QTextBox($this);
		$this->txtC2pobox->Name = QApplication::Translate('C 2 pobox');
		$this->txtC2pobox->Text = $this->objParticipant->C2pobox;
		$this->txtC2pobox->MaxLength = Participant::C2poboxMaxLength;
	}

	// Create and Setup txtC2city
	protected function txtC2city_Create() {
		$this->txtC2city = new QTextBox($this);
		$this->txtC2city->Name = QApplication::Translate('C 2 city');
		$this->txtC2city->Text = $this->objParticipant->C2city;
		$this->txtC2city->MaxLength = Participant::C2cityMaxLength;
	}

	// Create and Setup txtC2state
	protected function txtC2state_Create() {
		$this->txtC2state = new QTextBox($this);
		$this->txtC2state->Name = QApplication::Translate('C 2 state');
		$this->txtC2state->Text = $this->objParticipant->C2state;
		$this->txtC2state->MaxLength = Participant::C2stateMaxLength;
	}

	// Create and Setup txtC2zip
	protected function txtC2zip_Create() {
		$this->txtC2zip = new QTextBox($this);
		$this->txtC2zip->Name = QApplication::Translate('C 2 zip');
		$this->txtC2zip->Text = $this->objParticipant->C2zip;
		$this->txtC2zip->MaxLength = Participant::C2zipMaxLength;
	}

	// Create and Setup txtC2phone
	protected function txtC2phone_Create() {
		$this->txtC2phone = new QTextBox($this);
		$this->txtC2phone->Name = QApplication::Translate('C 2 phone');
		$this->txtC2phone->Text = $this->objParticipant->C2phone;
		$this->txtC2phone->MaxLength = Participant::C2phoneMaxLength;
	}

	// Create and Setup txtC2relation
	protected function txtC2relation_Create() {
		$this->txtC2relation = new QTextBox($this);
		$this->txtC2relation->Name = QApplication::Translate('C 2 relation');
		$this->txtC2relation->Text = $this->objParticipant->C2relation;
		$this->txtC2relation->MaxLength = Participant::C2relationMaxLength;
	}

	// Create and Setup txtC3name
	protected function txtC3name_Create() {
		$this->txtC3name = new QTextBox($this);
		$this->txtC3name->Name = QApplication::Translate('C 3 name');
		$this->txtC3name->Text = $this->objParticipant->C3name;
		$this->txtC3name->MaxLength = Participant::C3nameMaxLength;
	}

	// Create and Setup txtC3street
	protected function txtC3street_Create() {
		$this->txtC3street = new QTextBox($this);
		$this->txtC3street->Name = QApplication::Translate('C 3 street');
		$this->txtC3street->Text = $this->objParticipant->C3street;
		$this->txtC3street->MaxLength = Participant::C3streetMaxLength;
	}

	// Create and Setup txtC3pobox
	protected function txtC3pobox_Create() {
		$this->txtC3pobox = new QTextBox($this);
		$this->txtC3pobox->Name = QApplication::Translate('C 3 pobox');
		$this->txtC3pobox->Text = $this->objParticipant->C3pobox;
		$this->txtC3pobox->MaxLength = Participant::C3poboxMaxLength;
	}

	// Create and Setup txtC3city
	protected function txtC3city_Create() {
		$this->txtC3city = new QTextBox($this);
		$this->txtC3city->Name = QApplication::Translate('C 3 city');
		$this->txtC3city->Text = $this->objParticipant->C3city;
		$this->txtC3city->MaxLength = Participant::C3cityMaxLength;
	}

	// Create and Setup txtC3state
	protected function txtC3state_Create() {
		$this->txtC3state = new QTextBox($this);
		$this->txtC3state->Name = QApplication::Translate('C 3 state');
		$this->txtC3state->Text = $this->objParticipant->C3state;
		$this->txtC3state->MaxLength = Participant::C3stateMaxLength;
	}

	// Create and Setup txtC3zip
	protected function txtC3zip_Create() {
		$this->txtC3zip = new QTextBox($this);
		$this->txtC3zip->Name = QApplication::Translate('C 3 zip');
		$this->txtC3zip->Text = $this->objParticipant->C3zip;
		$this->txtC3zip->MaxLength = Participant::C3zipMaxLength;
	}

	// Create and Setup txtC3phone
	protected function txtC3phone_Create() {
		$this->txtC3phone = new QTextBox($this);
		$this->txtC3phone->Name = QApplication::Translate('C 3 phone');
		$this->txtC3phone->Text = $this->objParticipant->C3phone;
		$this->txtC3phone->MaxLength = Participant::C3phoneMaxLength;
	}

	// Create and Setup txtC3relation
	protected function txtC3relation_Create() {
		$this->txtC3relation = new QTextBox($this);
		$this->txtC3relation->Name = QApplication::Translate('C 3 relation');
		$this->txtC3relation->Text = $this->objParticipant->C3relation;
		$this->txtC3relation->MaxLength = Participant::C3relationMaxLength;
	}

	// Create and Setup txtBasecode
	protected function txtBasecode_Create() {
		$this->txtBasecode = new QIntegerTextBox($this);
		$this->txtBasecode->Name = QApplication::Translate('Basecode');
		$this->txtBasecode->Text = $this->objParticipant->Basecode;
	}

	// Create and Setup txtF1code
	protected function txtF1code_Create() {
		$this->txtF1code = new QIntegerTextBox($this);
		$this->txtF1code->Name = QApplication::Translate('F 1 code');
		$this->txtF1code->Text = $this->objParticipant->F1code;
	}

	// Create and Setup txtNecode
	protected function txtNecode_Create() {
		$this->txtNecode = new QIntegerTextBox($this);
		$this->txtNecode->Name = QApplication::Translate('Necode');
		$this->txtNecode->Text = $this->objParticipant->Necode;
	}

	// Create and Setup txtCurrentcode
	protected function txtCurrentcode_Create() {
		$this->txtCurrentcode = new QIntegerTextBox($this);
		$this->txtCurrentcode->Name = QApplication::Translate('Currentcode');
		$this->txtCurrentcode->Text = $this->objParticipant->Currentcode;
	}

	// Create and Setup txtPostcode
	protected function txtPostcode_Create() {
		$this->txtPostcode = new QIntegerTextBox($this);
		$this->txtPostcode->Name = QApplication::Translate('Postcode');
		$this->txtPostcode->Text = $this->objParticipant->Postcode;
	}

	// Create and Setup calBase1stint
	protected function calBase1stint_Create() {
		$this->calBase1stint = new QDateTimePicker($this);
		$this->calBase1stint->Name = QApplication::Translate('Base 1 stint');
		$this->calBase1stint->DateTime = $this->objParticipant->Base1stint;
		$this->calBase1stint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calBaseclinic
	protected function calBaseclinic_Create() {
		$this->calBaseclinic = new QDateTimePicker($this);
		$this->calBaseclinic->Name = QApplication::Translate('Baseclinic');
		$this->calBaseclinic->DateTime = $this->objParticipant->Baseclinic;
		$this->calBaseclinic->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calBase2ndint
	protected function calBase2ndint_Create() {
		$this->calBase2ndint = new QDateTimePicker($this);
		$this->calBase2ndint->Name = QApplication::Translate('Base 2 ndint');
		$this->calBase2ndint->DateTime = $this->objParticipant->Base2ndint;
		$this->calBase2ndint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calF11stint
	protected function calF11stint_Create() {
		$this->calF11stint = new QDateTimePicker($this);
		$this->calF11stint->Name = QApplication::Translate('F 11 stint');
		$this->calF11stint->DateTime = $this->objParticipant->F11stint;
		$this->calF11stint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calF1clinic
	protected function calF1clinic_Create() {
		$this->calF1clinic = new QDateTimePicker($this);
		$this->calF1clinic->Name = QApplication::Translate('F 1 clinic');
		$this->calF1clinic->DateTime = $this->objParticipant->F1clinic;
		$this->calF1clinic->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calF12ndint
	protected function calF12ndint_Create() {
		$this->calF12ndint = new QDateTimePicker($this);
		$this->calF12ndint->Name = QApplication::Translate('F 12 ndint');
		$this->calF12ndint->DateTime = $this->objParticipant->F12ndint;
		$this->calF12ndint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calNe1stint
	protected function calNe1stint_Create() {
		$this->calNe1stint = new QDateTimePicker($this);
		$this->calNe1stint->Name = QApplication::Translate('Ne 1 stint');
		$this->calNe1stint->DateTime = $this->objParticipant->Ne1stint;
		$this->calNe1stint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calNeclinic
	protected function calNeclinic_Create() {
		$this->calNeclinic = new QDateTimePicker($this);
		$this->calNeclinic->Name = QApplication::Translate('Neclinic');
		$this->calNeclinic->DateTime = $this->objParticipant->Neclinic;
		$this->calNeclinic->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calNe2ndint
	protected function calNe2ndint_Create() {
		$this->calNe2ndint = new QDateTimePicker($this);
		$this->calNe2ndint->Name = QApplication::Translate('Ne 2 ndint');
		$this->calNe2ndint->DateTime = $this->objParticipant->Ne2ndint;
		$this->calNe2ndint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calF21stint
	protected function calF21stint_Create() {
		$this->calF21stint = new QDateTimePicker($this);
		$this->calF21stint->Name = QApplication::Translate('F 21 stint');
		$this->calF21stint->DateTime = $this->objParticipant->F21stint;
		$this->calF21stint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calF2clinic
	protected function calF2clinic_Create() {
		$this->calF2clinic = new QDateTimePicker($this);
		$this->calF2clinic->Name = QApplication::Translate('F 2 clinic');
		$this->calF2clinic->DateTime = $this->objParticipant->F2clinic;
		$this->calF2clinic->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calF22ndint
	protected function calF22ndint_Create() {
		$this->calF22ndint = new QDateTimePicker($this);
		$this->calF22ndint->Name = QApplication::Translate('F 22 ndint');
		$this->calF22ndint->DateTime = $this->objParticipant->F22ndint;
		$this->calF22ndint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtBuddyid
	protected function txtBuddyid_Create() {
		$this->txtBuddyid = new QIntegerTextBox($this);
		$this->txtBuddyid->Name = QApplication::Translate('Buddyid');
		$this->txtBuddyid->Text = $this->objParticipant->Buddyid;
	}

	// Create and Setup calBuddydate
	protected function calBuddydate_Create() {
		$this->calBuddydate = new QDateTimePicker($this);
		$this->calBuddydate->Name = QApplication::Translate('Buddydate');
		$this->calBuddydate->DateTime = $this->objParticipant->Buddydate;
		$this->calBuddydate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtAcesid
	protected function txtAcesid_Create() {
		$this->txtAcesid = new QTextBox($this);
		$this->txtAcesid->Name = QApplication::Translate('Acesid');
		$this->txtAcesid->Text = $this->objParticipant->Acesid;
		$this->txtAcesid->MaxLength = Participant::AcesidMaxLength;
	}

	// Create and Setup calAces1stint
	protected function calAces1stint_Create() {
		$this->calAces1stint = new QDateTimePicker($this);
		$this->calAces1stint->Name = QApplication::Translate('Aces 1 stint');
		$this->calAces1stint->DateTime = $this->objParticipant->Aces1stint;
		$this->calAces1stint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calAces2ndint
	protected function calAces2ndint_Create() {
		$this->calAces2ndint = new QDateTimePicker($this);
		$this->calAces2ndint->Name = QApplication::Translate('Aces 2 ndint');
		$this->calAces2ndint->DateTime = $this->objParticipant->Aces2ndint;
		$this->calAces2ndint->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtGogoindid
	protected function txtGogoindid_Create() {
		$this->txtGogoindid = new QIntegerTextBox($this);
		$this->txtGogoindid->Name = QApplication::Translate('Gogoindid');
		$this->txtGogoindid->Text = $this->objParticipant->Gogoindid;
	}

	// Create and Setup txtGogofamid
	protected function txtGogofamid_Create() {
		$this->txtGogofamid = new QIntegerTextBox($this);
		$this->txtGogofamid->Name = QApplication::Translate('Gogofamid');
		$this->txtGogofamid->Text = $this->objParticipant->Gogofamid;
	}

	// Create and Setup calGogodate
	protected function calGogodate_Create() {
		$this->calGogodate = new QDateTimePicker($this);
		$this->calGogodate->Name = QApplication::Translate('Gogodate');
		$this->calGogodate->DateTime = $this->objParticipant->Gogodate;
		$this->calGogodate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtGogolongid
	protected function txtGogolongid_Create() {
		$this->txtGogolongid = new QIntegerTextBox($this);
		$this->txtGogolongid->Name = QApplication::Translate('Gogolongid');
		$this->txtGogolongid->Text = $this->objParticipant->Gogolongid;
	}

	// Create and Setup calGogolongdate
	protected function calGogolongdate_Create() {
		$this->calGogolongdate = new QDateTimePicker($this);
		$this->calGogolongdate->Name = QApplication::Translate('Gogolongdate');
		$this->calGogolongdate->DateTime = $this->objParticipant->Gogolongdate;
		$this->calGogolongdate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtJoproid
	protected function txtJoproid_Create() {
		$this->txtJoproid = new QTextBox($this);
		$this->txtJoproid->Name = QApplication::Translate('Joproid');
		$this->txtJoproid->Text = $this->objParticipant->Joproid;
		$this->txtJoproid->MaxLength = Participant::JoproidMaxLength;
	}

	// Create and Setup calJoprodate
	protected function calJoprodate_Create() {
		$this->calJoprodate = new QDateTimePicker($this);
		$this->calJoprodate->Name = QApplication::Translate('Joprodate');
		$this->calJoprodate->DateTime = $this->objParticipant->Joprodate;
		$this->calJoprodate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtJoprocont
	protected function txtJoprocont_Create() {
		$this->txtJoprocont = new QIntegerTextBox($this);
		$this->txtJoprocont->Name = QApplication::Translate('Joprocont');
		$this->txtJoprocont->Text = $this->objParticipant->Joprocont;
		$this->txtJoprocont->Required = true;
	}

	// Create and Setup txtJoprocomp
	protected function txtJoprocomp_Create() {
		$this->txtJoprocomp = new QIntegerTextBox($this);
		$this->txtJoprocomp->Name = QApplication::Translate('Joprocomp');
		$this->txtJoprocomp->Text = $this->objParticipant->Joprocomp;
		$this->txtJoprocomp->Required = true;
	}

	// Create and Setup calLastcodeupdate
	protected function calLastcodeupdate_Create() {
		$this->calLastcodeupdate = new QDateTimePicker($this);
		$this->calLastcodeupdate->Name = QApplication::Translate('Lastcodeupdate');
		$this->calLastcodeupdate->DateTime = $this->objParticipant->Lastcodeupdate;
		$this->calLastcodeupdate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup calPostcodeupdate
	protected function calPostcodeupdate_Create() {
		$this->calPostcodeupdate = new QDateTimePicker($this);
		$this->calPostcodeupdate->Name = QApplication::Translate('Postcodeupdate');
		$this->calPostcodeupdate->DateTime = $this->objParticipant->Postcodeupdate;
		$this->calPostcodeupdate->DateTimePickerType = QDateTimePickerType::Date;
	}

	// Create and Setup txtT0weight
	protected function txtT0weight_Create() {
		$this->txtT0weight = new QTextBox($this);
		$this->txtT0weight->Name = QApplication::Translate('T 0 weight');
		$this->txtT0weight->Text = $this->objParticipant->T0weight;
	}

	// Create and Setup txtT1weight
	protected function txtT1weight_Create() {
		$this->txtT1weight = new QTextBox($this);
		$this->txtT1weight->Name = QApplication::Translate('T 1 weight');
		$this->txtT1weight->Text = $this->objParticipant->T1weight;
	}

	// Create and Setup txtNotes
	protected function txtNotes_Create() {
		$this->txtNotes = new QTextBox($this);
		$this->txtNotes->Name = QApplication::Translate('Notes');
		$this->txtNotes->Text = $this->objParticipant->Notes;
		$this->txtNotes->TextMode = QTextMode::MultiLine;
	}

	// Create and Setup txtOtherstudy
	protected function txtOtherstudy_Create() {
		$this->txtOtherstudy = new QTextBox($this);
		$this->txtOtherstudy->Name = QApplication::Translate('Otherstudy');
		$this->txtOtherstudy->Text = $this->objParticipant->Otherstudy;
		$this->txtOtherstudy->MaxLength = Participant::OtherstudyMaxLength;
	}

	// Create and Setup txtHomeinterviewer
	protected function txtHomeinterviewer_Create() {
		$this->txtHomeinterviewer = new QTextBox($this);
		$this->txtHomeinterviewer->Name = QApplication::Translate('Homeinterviewer');
		$this->txtHomeinterviewer->Text = $this->objParticipant->Homeinterviewer;
		$this->txtHomeinterviewer->MaxLength = Participant::HomeinterviewerMaxLength;
	}

	// Create and Setup lblId
	protected function lblId_Create() {
		$this->lblId = new QLabel($this);
		$this->lblId->Name = QApplication::Translate('Id');
		if ($this->blnEditMode)
			$this->lblId->Text = $this->objParticipant->Id;
		else
			$this->lblId->Text = 'N/A';
	}

	// Create and Setup lstInterviewer
	protected function lstInterviewer_Create() {
		$this->lstInterviewer = new QListBox($this);
		$this->lstInterviewer->Name = QApplication::Translate('Interviewer');
		$this->lstInterviewer->AddItem(QApplication::Translate('- Select One -'), null);
		$objInterviewerArray = User::LoadAll();
		if ($objInterviewerArray) foreach ($objInterviewerArray as $objInterviewer) {
			$objListItem = new QListItem($objInterviewer->__toString(), $objInterviewer->Userid);
			if (($this->objParticipant->Interviewer) && ($this->objParticipant->Interviewer->Userid == $objInterviewer->Userid))
				$objListItem->Selected = true;
			$this->lstInterviewer->AddItem($objListItem);
		}
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
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Participant')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateParticipantFields() {
		$this->objParticipant->Caseid = $this->txtCaseid->Text;
		$this->objParticipant->Title = $this->txtTitle->Text;
		$this->objParticipant->Lastname = $this->txtLastname->Text;
		$this->objParticipant->Firstname = $this->txtFirstname->Text;
		$this->objParticipant->Middlename = $this->txtMiddlename->Text;
		$this->objParticipant->Maidenname = $this->txtMaidenname->Text;
		$this->objParticipant->Nickname = $this->txtNickname->Text;
		$this->objParticipant->Street = $this->txtStreet->Text;
		$this->objParticipant->Streetsort = $this->txtStreetsort->Text;
		$this->objParticipant->Pobox = $this->txtPobox->Text;
		$this->objParticipant->City = $this->txtCity->Text;
		$this->objParticipant->State = $this->txtState->Text;
		$this->objParticipant->Zip = $this->txtZip->Text;
		$this->objParticipant->Homephone = $this->txtHomephone->Text;
		$this->objParticipant->Otherphone = $this->txtOtherphone->Text;
		$this->objParticipant->Gender = $this->txtGender->Text;
		$this->objParticipant->Race = $this->txtRace->Text;
		$this->objParticipant->Dateofbirth = $this->calDateofbirth->DateTime;
		$this->objParticipant->Numhouse = $this->txtNumhouse->Text;
		$this->objParticipant->Typedwelling = $this->txtTypedwelling->Text;
		$this->objParticipant->Typedwellingother = $this->txtTypedwellingother->Text;
		$this->objParticipant->Rentorown = $this->txtRentorown->Text;
		$this->objParticipant->Rentorownother = $this->txtRentorownother->Text;
		$this->objParticipant->Maritalstatus = $this->txtMaritalstatus->Text;
		$this->objParticipant->Email = $this->txtEmail->Text;
		$this->objParticipant->C1name = $this->txtC1name->Text;
		$this->objParticipant->C1street = $this->txtC1street->Text;
		$this->objParticipant->C1pobox = $this->txtC1pobox->Text;
		$this->objParticipant->C1city = $this->txtC1city->Text;
		$this->objParticipant->C1state = $this->txtC1state->Text;
		$this->objParticipant->C1zip = $this->txtC1zip->Text;
		$this->objParticipant->C1phone = $this->txtC1phone->Text;
		$this->objParticipant->C1relation = $this->txtC1relation->Text;
		$this->objParticipant->C2name = $this->txtC2name->Text;
		$this->objParticipant->C2street = $this->txtC2street->Text;
		$this->objParticipant->C2pobox = $this->txtC2pobox->Text;
		$this->objParticipant->C2city = $this->txtC2city->Text;
		$this->objParticipant->C2state = $this->txtC2state->Text;
		$this->objParticipant->C2zip = $this->txtC2zip->Text;
		$this->objParticipant->C2phone = $this->txtC2phone->Text;
		$this->objParticipant->C2relation = $this->txtC2relation->Text;
		$this->objParticipant->C3name = $this->txtC3name->Text;
		$this->objParticipant->C3street = $this->txtC3street->Text;
		$this->objParticipant->C3pobox = $this->txtC3pobox->Text;
		$this->objParticipant->C3city = $this->txtC3city->Text;
		$this->objParticipant->C3state = $this->txtC3state->Text;
		$this->objParticipant->C3zip = $this->txtC3zip->Text;
		$this->objParticipant->C3phone = $this->txtC3phone->Text;
		$this->objParticipant->C3relation = $this->txtC3relation->Text;
		$this->objParticipant->Basecode = $this->txtBasecode->Text;
		$this->objParticipant->F1code = $this->txtF1code->Text;
		$this->objParticipant->Necode = $this->txtNecode->Text;
		$this->objParticipant->Currentcode = $this->txtCurrentcode->Text;
		$this->objParticipant->Postcode = $this->txtPostcode->Text;
		$this->objParticipant->Base1stint = $this->calBase1stint->DateTime;
		$this->objParticipant->Baseclinic = $this->calBaseclinic->DateTime;
		$this->objParticipant->Base2ndint = $this->calBase2ndint->DateTime;
		$this->objParticipant->F11stint = $this->calF11stint->DateTime;
		$this->objParticipant->F1clinic = $this->calF1clinic->DateTime;
		$this->objParticipant->F12ndint = $this->calF12ndint->DateTime;
		$this->objParticipant->Ne1stint = $this->calNe1stint->DateTime;
		$this->objParticipant->Neclinic = $this->calNeclinic->DateTime;
		$this->objParticipant->Ne2ndint = $this->calNe2ndint->DateTime;
		$this->objParticipant->F21stint = $this->calF21stint->DateTime;
		$this->objParticipant->F2clinic = $this->calF2clinic->DateTime;
		$this->objParticipant->F22ndint = $this->calF22ndint->DateTime;
		$this->objParticipant->Buddyid = $this->txtBuddyid->Text;
		$this->objParticipant->Buddydate = $this->calBuddydate->DateTime;
		$this->objParticipant->Acesid = $this->txtAcesid->Text;
		$this->objParticipant->Aces1stint = $this->calAces1stint->DateTime;
		$this->objParticipant->Aces2ndint = $this->calAces2ndint->DateTime;
		$this->objParticipant->Gogoindid = $this->txtGogoindid->Text;
		$this->objParticipant->Gogofamid = $this->txtGogofamid->Text;
		$this->objParticipant->Gogodate = $this->calGogodate->DateTime;
		$this->objParticipant->Gogolongid = $this->txtGogolongid->Text;
		$this->objParticipant->Gogolongdate = $this->calGogolongdate->DateTime;
		$this->objParticipant->Joproid = $this->txtJoproid->Text;
		$this->objParticipant->Joprodate = $this->calJoprodate->DateTime;
		$this->objParticipant->Joprocont = $this->txtJoprocont->Text;
		$this->objParticipant->Joprocomp = $this->txtJoprocomp->Text;
		$this->objParticipant->Lastcodeupdate = $this->calLastcodeupdate->DateTime;
		$this->objParticipant->Postcodeupdate = $this->calPostcodeupdate->DateTime;
		$this->objParticipant->T0weight = $this->txtT0weight->Text;
		$this->objParticipant->T1weight = $this->txtT1weight->Text;
		$this->objParticipant->Notes = $this->txtNotes->Text;
		$this->objParticipant->Otherstudy = $this->txtOtherstudy->Text;
		$this->objParticipant->Homeinterviewer = $this->txtHomeinterviewer->Text;
		$this->objParticipant->InterviewerId = $this->lstInterviewer->SelectedValue;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateParticipantFields();
		$this->objParticipant->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objParticipant->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>