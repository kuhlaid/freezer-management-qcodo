<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Participant class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Participant objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this ParticipantListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class ParticipantListPanelBase extends QPanel {
	public $dtgParticipant;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colCaseid;
	protected $colTitle;
	protected $colLastname;
	protected $colFirstname;
	protected $colMiddlename;
	protected $colMaidenname;
	protected $colNickname;
	protected $colStreet;
	protected $colStreetsort;
	protected $colPobox;
	protected $colCity;
	protected $colState;
	protected $colZip;
	protected $colHomephone;
	protected $colOtherphone;
	protected $colGender;
	protected $colRace;
	protected $colDateofbirth;
	protected $colNumhouse;
	protected $colTypedwelling;
	protected $colTypedwellingother;
	protected $colRentorown;
	protected $colRentorownother;
	protected $colMaritalstatus;
	protected $colEmail;
	protected $colC1name;
	protected $colC1street;
	protected $colC1pobox;
	protected $colC1city;
	protected $colC1state;
	protected $colC1zip;
	protected $colC1phone;
	protected $colC1relation;
	protected $colC2name;
	protected $colC2street;
	protected $colC2pobox;
	protected $colC2city;
	protected $colC2state;
	protected $colC2zip;
	protected $colC2phone;
	protected $colC2relation;
	protected $colC3name;
	protected $colC3street;
	protected $colC3pobox;
	protected $colC3city;
	protected $colC3state;
	protected $colC3zip;
	protected $colC3phone;
	protected $colC3relation;
	protected $colBasecode;
	protected $colF1code;
	protected $colNecode;
	protected $colCurrentcode;
	protected $colPostcode;
	protected $colBase1stint;
	protected $colBaseclinic;
	protected $colBase2ndint;
	protected $colF11stint;
	protected $colF1clinic;
	protected $colF12ndint;
	protected $colNe1stint;
	protected $colNeclinic;
	protected $colNe2ndint;
	protected $colF21stint;
	protected $colF2clinic;
	protected $colF22ndint;
	protected $colBuddyid;
	protected $colBuddydate;
	protected $colAcesid;
	protected $colAces1stint;
	protected $colAces2ndint;
	protected $colGogoindid;
	protected $colGogofamid;
	protected $colGogodate;
	protected $colGogolongid;
	protected $colGogolongdate;
	protected $colJoproid;
	protected $colJoprodate;
	protected $colJoprocont;
	protected $colJoprocomp;
	protected $colLastcodeupdate;
	protected $colPostcodeupdate;
	protected $colT0weight;
	protected $colT1weight;
	protected $colNotes;
	protected $colOtherstudy;
	protected $colHomeinterviewer;
	protected $colId;
	protected $colInterviewerId;

	public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Record Method Callbacks
		$this->strSetEditPanelMethod = $strSetEditPanelMethod;
		$this->strCloseEditPanelMethod = $strCloseEditPanelMethod;

		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgParticipant_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colCaseid = new QDataGridColumn(QApplication::Translate('Caseid'), '<?= QString::Truncate($_ITEM->Caseid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Caseid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Caseid, false)));
		$this->colTitle = new QDataGridColumn(QApplication::Translate('Title'), '<?= QString::Truncate($_ITEM->Title, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Title), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Title, false)));
		$this->colLastname = new QDataGridColumn(QApplication::Translate('Lastname'), '<?= QString::Truncate($_ITEM->Lastname, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Lastname), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Lastname, false)));
		$this->colFirstname = new QDataGridColumn(QApplication::Translate('Firstname'), '<?= QString::Truncate($_ITEM->Firstname, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Firstname), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Firstname, false)));
		$this->colMiddlename = new QDataGridColumn(QApplication::Translate('Middlename'), '<?= QString::Truncate($_ITEM->Middlename, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Middlename), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Middlename, false)));
		$this->colMaidenname = new QDataGridColumn(QApplication::Translate('Maidenname'), '<?= QString::Truncate($_ITEM->Maidenname, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Maidenname), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Maidenname, false)));
		$this->colNickname = new QDataGridColumn(QApplication::Translate('Nickname'), '<?= QString::Truncate($_ITEM->Nickname, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Nickname), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Nickname, false)));
		$this->colStreet = new QDataGridColumn(QApplication::Translate('Street'), '<?= QString::Truncate($_ITEM->Street, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Street), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Street, false)));
		$this->colStreetsort = new QDataGridColumn(QApplication::Translate('Streetsort'), '<?= QString::Truncate($_ITEM->Streetsort, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Streetsort), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Streetsort, false)));
		$this->colPobox = new QDataGridColumn(QApplication::Translate('Pobox'), '<?= QString::Truncate($_ITEM->Pobox, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Pobox), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Pobox, false)));
		$this->colCity = new QDataGridColumn(QApplication::Translate('City'), '<?= QString::Truncate($_ITEM->City, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->City), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->City, false)));
		$this->colState = new QDataGridColumn(QApplication::Translate('State'), '<?= QString::Truncate($_ITEM->State, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->State), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->State, false)));
		$this->colZip = new QDataGridColumn(QApplication::Translate('Zip'), '<?= QString::Truncate($_ITEM->Zip, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Zip), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Zip, false)));
		$this->colHomephone = new QDataGridColumn(QApplication::Translate('Homephone'), '<?= QString::Truncate($_ITEM->Homephone, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Homephone), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Homephone, false)));
		$this->colOtherphone = new QDataGridColumn(QApplication::Translate('Otherphone'), '<?= QString::Truncate($_ITEM->Otherphone, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Otherphone), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Otherphone, false)));
		$this->colGender = new QDataGridColumn(QApplication::Translate('Gender'), '<?= QString::Truncate($_ITEM->Gender, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Gender), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Gender, false)));
		$this->colRace = new QDataGridColumn(QApplication::Translate('Race'), '<?= QString::Truncate($_ITEM->Race, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Race), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Race, false)));
		$this->colDateofbirth = new QDataGridColumn(QApplication::Translate('Dateofbirth'), '<?= $_CONTROL->ParentControl->dtgParticipant_Dateofbirth_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Dateofbirth), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Dateofbirth, false)));
		$this->colNumhouse = new QDataGridColumn(QApplication::Translate('Numhouse'), '<?= $_ITEM->Numhouse; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Numhouse), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Numhouse, false)));
		$this->colTypedwelling = new QDataGridColumn(QApplication::Translate('Typedwelling'), '<?= $_ITEM->Typedwelling; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Typedwelling), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Typedwelling, false)));
		$this->colTypedwellingother = new QDataGridColumn(QApplication::Translate('Typedwellingother'), '<?= QString::Truncate($_ITEM->Typedwellingother, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Typedwellingother), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Typedwellingother, false)));
		$this->colRentorown = new QDataGridColumn(QApplication::Translate('Rentorown'), '<?= $_ITEM->Rentorown; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Rentorown), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Rentorown, false)));
		$this->colRentorownother = new QDataGridColumn(QApplication::Translate('Rentorownother'), '<?= QString::Truncate($_ITEM->Rentorownother, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Rentorownother), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Rentorownother, false)));
		$this->colMaritalstatus = new QDataGridColumn(QApplication::Translate('Maritalstatus'), '<?= QString::Truncate($_ITEM->Maritalstatus, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Maritalstatus), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Maritalstatus, false)));
		$this->colEmail = new QDataGridColumn(QApplication::Translate('Email'), '<?= QString::Truncate($_ITEM->Email, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Email), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Email, false)));
		$this->colC1name = new QDataGridColumn(QApplication::Translate('C 1 name'), '<?= QString::Truncate($_ITEM->C1name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C1name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C1name, false)));
		$this->colC1street = new QDataGridColumn(QApplication::Translate('C 1 street'), '<?= QString::Truncate($_ITEM->C1street, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C1street), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C1street, false)));
		$this->colC1pobox = new QDataGridColumn(QApplication::Translate('C 1 pobox'), '<?= QString::Truncate($_ITEM->C1pobox, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C1pobox), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C1pobox, false)));
		$this->colC1city = new QDataGridColumn(QApplication::Translate('C 1 city'), '<?= QString::Truncate($_ITEM->C1city, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C1city), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C1city, false)));
		$this->colC1state = new QDataGridColumn(QApplication::Translate('C 1 state'), '<?= QString::Truncate($_ITEM->C1state, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C1state), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C1state, false)));
		$this->colC1zip = new QDataGridColumn(QApplication::Translate('C 1 zip'), '<?= QString::Truncate($_ITEM->C1zip, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C1zip), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C1zip, false)));
		$this->colC1phone = new QDataGridColumn(QApplication::Translate('C 1 phone'), '<?= QString::Truncate($_ITEM->C1phone, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C1phone), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C1phone, false)));
		$this->colC1relation = new QDataGridColumn(QApplication::Translate('C 1 relation'), '<?= QString::Truncate($_ITEM->C1relation, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C1relation), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C1relation, false)));
		$this->colC2name = new QDataGridColumn(QApplication::Translate('C 2 name'), '<?= QString::Truncate($_ITEM->C2name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C2name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C2name, false)));
		$this->colC2street = new QDataGridColumn(QApplication::Translate('C 2 street'), '<?= QString::Truncate($_ITEM->C2street, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C2street), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C2street, false)));
		$this->colC2pobox = new QDataGridColumn(QApplication::Translate('C 2 pobox'), '<?= QString::Truncate($_ITEM->C2pobox, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C2pobox), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C2pobox, false)));
		$this->colC2city = new QDataGridColumn(QApplication::Translate('C 2 city'), '<?= QString::Truncate($_ITEM->C2city, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C2city), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C2city, false)));
		$this->colC2state = new QDataGridColumn(QApplication::Translate('C 2 state'), '<?= QString::Truncate($_ITEM->C2state, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C2state), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C2state, false)));
		$this->colC2zip = new QDataGridColumn(QApplication::Translate('C 2 zip'), '<?= QString::Truncate($_ITEM->C2zip, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C2zip), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C2zip, false)));
		$this->colC2phone = new QDataGridColumn(QApplication::Translate('C 2 phone'), '<?= QString::Truncate($_ITEM->C2phone, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C2phone), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C2phone, false)));
		$this->colC2relation = new QDataGridColumn(QApplication::Translate('C 2 relation'), '<?= QString::Truncate($_ITEM->C2relation, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C2relation), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C2relation, false)));
		$this->colC3name = new QDataGridColumn(QApplication::Translate('C 3 name'), '<?= QString::Truncate($_ITEM->C3name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C3name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C3name, false)));
		$this->colC3street = new QDataGridColumn(QApplication::Translate('C 3 street'), '<?= QString::Truncate($_ITEM->C3street, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C3street), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C3street, false)));
		$this->colC3pobox = new QDataGridColumn(QApplication::Translate('C 3 pobox'), '<?= QString::Truncate($_ITEM->C3pobox, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C3pobox), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C3pobox, false)));
		$this->colC3city = new QDataGridColumn(QApplication::Translate('C 3 city'), '<?= QString::Truncate($_ITEM->C3city, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C3city), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C3city, false)));
		$this->colC3state = new QDataGridColumn(QApplication::Translate('C 3 state'), '<?= QString::Truncate($_ITEM->C3state, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C3state), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C3state, false)));
		$this->colC3zip = new QDataGridColumn(QApplication::Translate('C 3 zip'), '<?= QString::Truncate($_ITEM->C3zip, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C3zip), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C3zip, false)));
		$this->colC3phone = new QDataGridColumn(QApplication::Translate('C 3 phone'), '<?= QString::Truncate($_ITEM->C3phone, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C3phone), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C3phone, false)));
		$this->colC3relation = new QDataGridColumn(QApplication::Translate('C 3 relation'), '<?= QString::Truncate($_ITEM->C3relation, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->C3relation), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->C3relation, false)));
		$this->colBasecode = new QDataGridColumn(QApplication::Translate('Basecode'), '<?= $_ITEM->Basecode; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Basecode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Basecode, false)));
		$this->colF1code = new QDataGridColumn(QApplication::Translate('F 1 code'), '<?= $_ITEM->F1code; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->F1code), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->F1code, false)));
		$this->colNecode = new QDataGridColumn(QApplication::Translate('Necode'), '<?= $_ITEM->Necode; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Necode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Necode, false)));
		$this->colCurrentcode = new QDataGridColumn(QApplication::Translate('Currentcode'), '<?= $_ITEM->Currentcode; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Currentcode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Currentcode, false)));
		$this->colPostcode = new QDataGridColumn(QApplication::Translate('Postcode'), '<?= $_ITEM->Postcode; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Postcode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Postcode, false)));
		$this->colBase1stint = new QDataGridColumn(QApplication::Translate('Base 1 stint'), '<?= $_CONTROL->ParentControl->dtgParticipant_Base1stint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Base1stint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Base1stint, false)));
		$this->colBaseclinic = new QDataGridColumn(QApplication::Translate('Baseclinic'), '<?= $_CONTROL->ParentControl->dtgParticipant_Baseclinic_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Baseclinic), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Baseclinic, false)));
		$this->colBase2ndint = new QDataGridColumn(QApplication::Translate('Base 2 ndint'), '<?= $_CONTROL->ParentControl->dtgParticipant_Base2ndint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Base2ndint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Base2ndint, false)));
		$this->colF11stint = new QDataGridColumn(QApplication::Translate('F 11 stint'), '<?= $_CONTROL->ParentControl->dtgParticipant_F11stint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->F11stint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->F11stint, false)));
		$this->colF1clinic = new QDataGridColumn(QApplication::Translate('F 1 clinic'), '<?= $_CONTROL->ParentControl->dtgParticipant_F1clinic_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->F1clinic), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->F1clinic, false)));
		$this->colF12ndint = new QDataGridColumn(QApplication::Translate('F 12 ndint'), '<?= $_CONTROL->ParentControl->dtgParticipant_F12ndint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->F12ndint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->F12ndint, false)));
		$this->colNe1stint = new QDataGridColumn(QApplication::Translate('Ne 1 stint'), '<?= $_CONTROL->ParentControl->dtgParticipant_Ne1stint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Ne1stint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Ne1stint, false)));
		$this->colNeclinic = new QDataGridColumn(QApplication::Translate('Neclinic'), '<?= $_CONTROL->ParentControl->dtgParticipant_Neclinic_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Neclinic), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Neclinic, false)));
		$this->colNe2ndint = new QDataGridColumn(QApplication::Translate('Ne 2 ndint'), '<?= $_CONTROL->ParentControl->dtgParticipant_Ne2ndint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Ne2ndint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Ne2ndint, false)));
		$this->colF21stint = new QDataGridColumn(QApplication::Translate('F 21 stint'), '<?= $_CONTROL->ParentControl->dtgParticipant_F21stint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->F21stint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->F21stint, false)));
		$this->colF2clinic = new QDataGridColumn(QApplication::Translate('F 2 clinic'), '<?= $_CONTROL->ParentControl->dtgParticipant_F2clinic_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->F2clinic), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->F2clinic, false)));
		$this->colF22ndint = new QDataGridColumn(QApplication::Translate('F 22 ndint'), '<?= $_CONTROL->ParentControl->dtgParticipant_F22ndint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->F22ndint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->F22ndint, false)));
		$this->colBuddyid = new QDataGridColumn(QApplication::Translate('Buddyid'), '<?= $_ITEM->Buddyid; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Buddyid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Buddyid, false)));
		$this->colBuddydate = new QDataGridColumn(QApplication::Translate('Buddydate'), '<?= $_CONTROL->ParentControl->dtgParticipant_Buddydate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Buddydate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Buddydate, false)));
		$this->colAcesid = new QDataGridColumn(QApplication::Translate('Acesid'), '<?= QString::Truncate($_ITEM->Acesid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Acesid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Acesid, false)));
		$this->colAces1stint = new QDataGridColumn(QApplication::Translate('Aces 1 stint'), '<?= $_CONTROL->ParentControl->dtgParticipant_Aces1stint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Aces1stint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Aces1stint, false)));
		$this->colAces2ndint = new QDataGridColumn(QApplication::Translate('Aces 2 ndint'), '<?= $_CONTROL->ParentControl->dtgParticipant_Aces2ndint_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Aces2ndint), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Aces2ndint, false)));
		$this->colGogoindid = new QDataGridColumn(QApplication::Translate('Gogoindid'), '<?= $_ITEM->Gogoindid; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Gogoindid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Gogoindid, false)));
		$this->colGogofamid = new QDataGridColumn(QApplication::Translate('Gogofamid'), '<?= $_ITEM->Gogofamid; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Gogofamid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Gogofamid, false)));
		$this->colGogodate = new QDataGridColumn(QApplication::Translate('Gogodate'), '<?= $_CONTROL->ParentControl->dtgParticipant_Gogodate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Gogodate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Gogodate, false)));
		$this->colGogolongid = new QDataGridColumn(QApplication::Translate('Gogolongid'), '<?= $_ITEM->Gogolongid; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Gogolongid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Gogolongid, false)));
		$this->colGogolongdate = new QDataGridColumn(QApplication::Translate('Gogolongdate'), '<?= $_CONTROL->ParentControl->dtgParticipant_Gogolongdate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Gogolongdate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Gogolongdate, false)));
		$this->colJoproid = new QDataGridColumn(QApplication::Translate('Joproid'), '<?= QString::Truncate($_ITEM->Joproid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Joproid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Joproid, false)));
		$this->colJoprodate = new QDataGridColumn(QApplication::Translate('Joprodate'), '<?= $_CONTROL->ParentControl->dtgParticipant_Joprodate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Joprodate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Joprodate, false)));
		$this->colJoprocont = new QDataGridColumn(QApplication::Translate('Joprocont'), '<?= $_ITEM->Joprocont; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Joprocont), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Joprocont, false)));
		$this->colJoprocomp = new QDataGridColumn(QApplication::Translate('Joprocomp'), '<?= $_ITEM->Joprocomp; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Joprocomp), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Joprocomp, false)));
		$this->colLastcodeupdate = new QDataGridColumn(QApplication::Translate('Lastcodeupdate'), '<?= $_CONTROL->ParentControl->dtgParticipant_Lastcodeupdate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Lastcodeupdate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Lastcodeupdate, false)));
		$this->colPostcodeupdate = new QDataGridColumn(QApplication::Translate('Postcodeupdate'), '<?= $_CONTROL->ParentControl->dtgParticipant_Postcodeupdate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Postcodeupdate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Postcodeupdate, false)));
		$this->colT0weight = new QDataGridColumn(QApplication::Translate('T 0 weight'), '<?= QString::Truncate($_ITEM->T0weight, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->T0weight), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->T0weight, false)));
		$this->colT1weight = new QDataGridColumn(QApplication::Translate('T 1 weight'), '<?= QString::Truncate($_ITEM->T1weight, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->T1weight), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->T1weight, false)));
		$this->colNotes = new QDataGridColumn(QApplication::Translate('Notes'), '<?= QString::Truncate($_ITEM->Notes, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Notes), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Notes, false)));
		$this->colOtherstudy = new QDataGridColumn(QApplication::Translate('Otherstudy'), '<?= QString::Truncate($_ITEM->Otherstudy, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Otherstudy), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Otherstudy, false)));
		$this->colHomeinterviewer = new QDataGridColumn(QApplication::Translate('Homeinterviewer'), '<?= QString::Truncate($_ITEM->Homeinterviewer, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Homeinterviewer), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Homeinterviewer, false)));
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Participant()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Participant()->Id, false)));
		$this->colInterviewerId = new QDataGridColumn(QApplication::Translate('Interviewer Id'), '<?= $_CONTROL->ParentControl->dtgParticipant_Interviewer_Render($_ITEM); ?>');

		// Setup DataGrid
		$this->dtgParticipant = new QDataGrid($this);
		$this->dtgParticipant->CellSpacing = 0;
		$this->dtgParticipant->CellPadding = 4;
		$this->dtgParticipant->BorderStyle = QBorderStyle::Solid;
		$this->dtgParticipant->BorderWidth = 1;
		$this->dtgParticipant->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgParticipant->Paginator = new QPaginator($this->dtgParticipant);
		$this->dtgParticipant->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgParticipant->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgParticipant->SetDataBinder('dtgParticipant_Bind', $this);

		$this->dtgParticipant->AddColumn($this->colEditLinkColumn);
		$this->dtgParticipant->AddColumn($this->colCaseid);
		$this->dtgParticipant->AddColumn($this->colTitle);
		$this->dtgParticipant->AddColumn($this->colLastname);
		$this->dtgParticipant->AddColumn($this->colFirstname);
		$this->dtgParticipant->AddColumn($this->colMiddlename);
		$this->dtgParticipant->AddColumn($this->colMaidenname);
		$this->dtgParticipant->AddColumn($this->colNickname);
		$this->dtgParticipant->AddColumn($this->colStreet);
		$this->dtgParticipant->AddColumn($this->colStreetsort);
		$this->dtgParticipant->AddColumn($this->colPobox);
		$this->dtgParticipant->AddColumn($this->colCity);
		$this->dtgParticipant->AddColumn($this->colState);
		$this->dtgParticipant->AddColumn($this->colZip);
		$this->dtgParticipant->AddColumn($this->colHomephone);
		$this->dtgParticipant->AddColumn($this->colOtherphone);
		$this->dtgParticipant->AddColumn($this->colGender);
		$this->dtgParticipant->AddColumn($this->colRace);
		$this->dtgParticipant->AddColumn($this->colDateofbirth);
		$this->dtgParticipant->AddColumn($this->colNumhouse);
		$this->dtgParticipant->AddColumn($this->colTypedwelling);
		$this->dtgParticipant->AddColumn($this->colTypedwellingother);
		$this->dtgParticipant->AddColumn($this->colRentorown);
		$this->dtgParticipant->AddColumn($this->colRentorownother);
		$this->dtgParticipant->AddColumn($this->colMaritalstatus);
		$this->dtgParticipant->AddColumn($this->colEmail);
		$this->dtgParticipant->AddColumn($this->colC1name);
		$this->dtgParticipant->AddColumn($this->colC1street);
		$this->dtgParticipant->AddColumn($this->colC1pobox);
		$this->dtgParticipant->AddColumn($this->colC1city);
		$this->dtgParticipant->AddColumn($this->colC1state);
		$this->dtgParticipant->AddColumn($this->colC1zip);
		$this->dtgParticipant->AddColumn($this->colC1phone);
		$this->dtgParticipant->AddColumn($this->colC1relation);
		$this->dtgParticipant->AddColumn($this->colC2name);
		$this->dtgParticipant->AddColumn($this->colC2street);
		$this->dtgParticipant->AddColumn($this->colC2pobox);
		$this->dtgParticipant->AddColumn($this->colC2city);
		$this->dtgParticipant->AddColumn($this->colC2state);
		$this->dtgParticipant->AddColumn($this->colC2zip);
		$this->dtgParticipant->AddColumn($this->colC2phone);
		$this->dtgParticipant->AddColumn($this->colC2relation);
		$this->dtgParticipant->AddColumn($this->colC3name);
		$this->dtgParticipant->AddColumn($this->colC3street);
		$this->dtgParticipant->AddColumn($this->colC3pobox);
		$this->dtgParticipant->AddColumn($this->colC3city);
		$this->dtgParticipant->AddColumn($this->colC3state);
		$this->dtgParticipant->AddColumn($this->colC3zip);
		$this->dtgParticipant->AddColumn($this->colC3phone);
		$this->dtgParticipant->AddColumn($this->colC3relation);
		$this->dtgParticipant->AddColumn($this->colBasecode);
		$this->dtgParticipant->AddColumn($this->colF1code);
		$this->dtgParticipant->AddColumn($this->colNecode);
		$this->dtgParticipant->AddColumn($this->colCurrentcode);
		$this->dtgParticipant->AddColumn($this->colPostcode);
		$this->dtgParticipant->AddColumn($this->colBase1stint);
		$this->dtgParticipant->AddColumn($this->colBaseclinic);
		$this->dtgParticipant->AddColumn($this->colBase2ndint);
		$this->dtgParticipant->AddColumn($this->colF11stint);
		$this->dtgParticipant->AddColumn($this->colF1clinic);
		$this->dtgParticipant->AddColumn($this->colF12ndint);
		$this->dtgParticipant->AddColumn($this->colNe1stint);
		$this->dtgParticipant->AddColumn($this->colNeclinic);
		$this->dtgParticipant->AddColumn($this->colNe2ndint);
		$this->dtgParticipant->AddColumn($this->colF21stint);
		$this->dtgParticipant->AddColumn($this->colF2clinic);
		$this->dtgParticipant->AddColumn($this->colF22ndint);
		$this->dtgParticipant->AddColumn($this->colBuddyid);
		$this->dtgParticipant->AddColumn($this->colBuddydate);
		$this->dtgParticipant->AddColumn($this->colAcesid);
		$this->dtgParticipant->AddColumn($this->colAces1stint);
		$this->dtgParticipant->AddColumn($this->colAces2ndint);
		$this->dtgParticipant->AddColumn($this->colGogoindid);
		$this->dtgParticipant->AddColumn($this->colGogofamid);
		$this->dtgParticipant->AddColumn($this->colGogodate);
		$this->dtgParticipant->AddColumn($this->colGogolongid);
		$this->dtgParticipant->AddColumn($this->colGogolongdate);
		$this->dtgParticipant->AddColumn($this->colJoproid);
		$this->dtgParticipant->AddColumn($this->colJoprodate);
		$this->dtgParticipant->AddColumn($this->colJoprocont);
		$this->dtgParticipant->AddColumn($this->colJoprocomp);
		$this->dtgParticipant->AddColumn($this->colLastcodeupdate);
		$this->dtgParticipant->AddColumn($this->colPostcodeupdate);
		$this->dtgParticipant->AddColumn($this->colT0weight);
		$this->dtgParticipant->AddColumn($this->colT1weight);
		$this->dtgParticipant->AddColumn($this->colNotes);
		$this->dtgParticipant->AddColumn($this->colOtherstudy);
		$this->dtgParticipant->AddColumn($this->colHomeinterviewer);
		$this->dtgParticipant->AddColumn($this->colId);
		$this->dtgParticipant->AddColumn($this->colInterviewerId);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Participant');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgParticipant_EditLinkColumn_Render(Participant $objParticipant) {
		$strControlId = 'btnEdit' . $this->dtgParticipant->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgParticipant, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objParticipant->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objParticipant = Participant::Load($strParameterArray[0]);

		$objEditPanel = new ParticipantEditPanel($this, $this->strCloseEditPanelMethod, $objParticipant);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new ParticipantEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgParticipant_Dateofbirth_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Dateofbirth))
			return $objParticipant->Dateofbirth->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Base1stint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Base1stint))
			return $objParticipant->Base1stint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Baseclinic_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Baseclinic))
			return $objParticipant->Baseclinic->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Base2ndint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Base2ndint))
			return $objParticipant->Base2ndint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_F11stint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->F11stint))
			return $objParticipant->F11stint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_F1clinic_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->F1clinic))
			return $objParticipant->F1clinic->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_F12ndint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->F12ndint))
			return $objParticipant->F12ndint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Ne1stint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Ne1stint))
			return $objParticipant->Ne1stint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Neclinic_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Neclinic))
			return $objParticipant->Neclinic->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Ne2ndint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Ne2ndint))
			return $objParticipant->Ne2ndint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_F21stint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->F21stint))
			return $objParticipant->F21stint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_F2clinic_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->F2clinic))
			return $objParticipant->F2clinic->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_F22ndint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->F22ndint))
			return $objParticipant->F22ndint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Buddydate_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Buddydate))
			return $objParticipant->Buddydate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Aces1stint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Aces1stint))
			return $objParticipant->Aces1stint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Aces2ndint_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Aces2ndint))
			return $objParticipant->Aces2ndint->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Gogodate_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Gogodate))
			return $objParticipant->Gogodate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Gogolongdate_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Gogolongdate))
			return $objParticipant->Gogolongdate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Joprodate_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Joprodate))
			return $objParticipant->Joprodate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Lastcodeupdate_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Lastcodeupdate))
			return $objParticipant->Lastcodeupdate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Postcodeupdate_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Postcodeupdate))
			return $objParticipant->Postcodeupdate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgParticipant_Interviewer_Render(Participant $objParticipant) {
		if (!is_null($objParticipant->Interviewer))
			return $objParticipant->Interviewer->__toString();
		else
			return null;
	}


	public function dtgParticipant_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgParticipant->TotalItemCount = Participant::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgParticipant->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgParticipant->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgParticipant->DataSource = Participant::LoadAll($objClauses);
	}
}
?>