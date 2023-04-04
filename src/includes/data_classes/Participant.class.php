<?php
require(__DATAGEN_CLASSES__ . '/ParticipantGen.class.php');

/**
 * The Participant class defined here contains any
 * customized code for the Participant class in the
 * Object Relational Model.  It represents the "participant" table
 * in the database, and extends from the code generated abstract ParticipantGen
 * class, which contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * @package My Application
 * @subpackage DataObjects
 *
*/
class Participant extends ParticipantGen {

	/**
	 * Default "to string" handler
	 * Allows pages to _p()/echo()/print() this object, and to define the default
	 * way this object would be outputted.
	 *
	 * Can also be called directly via $objParticipant->__toString().
	 *
	 * @return string a nicely formatted string representation of this object
	 */
	public function __toString() {
		return sprintf('%s',  str_replace("..",".",$this->Title.". ".$this->Firstname." ".$this->Lastname));
	}

	// entire name with caseid
	public function __toStringCase() {
		return sprintf('%s (%s)', $this->Caseid, str_replace("..",".",$this->Title.". ".$this->Firstname." ".$this->Lastname));
	}

	// just title and last name
	public function __toStringTLn() {
		return sprintf('%s',  str_replace("..",".",$this->Title.". ".$this->Lastname));
	}

	// participant name and address
	public function __toStringWAddress() {
		return sprintf('<b>%s</b>%s%s%s%s',  $this->__toStringCase(), "<br/>".$this->Street, "<br/>".$this->City, ", ".$this->State, " ".$this->Zip);
	}

	// participant address for geocoding
	public function __MapAddress() {
		return sprintf('%s,%s,%s %s',  $this->Street, $this->City, $this->State, $this->Zip);
	}

	// caseid and last name view
	public function __toStringCaseLast() {
		return sprintf('%s',  $this->Caseid." ".$this->Lastname);
	}

	// W is for testing and is not really used for anything else
	public static $townArray = array("A"=>1,"B"=>2,"C"=>3,"D"=>4,"E"=>5,"F"=>6,"W"=>7);
	public static $sampleTypeArray = array("S"=>19,"U"=>21,"W"=>23);

	// wpg - moved these array values here since we want access from both the participant manager application and T3
	public static $genderArray = array("Male"=>"M","Female"=>"F");
	public static $raceArray = array("White"=>"W","Black"=>"B","Don't Know"=>"D","Refused"=>"R");
	public static $maritalArray = array("Married"=>"M","Divorced"=>"V","Widowed"=>"W","Never Married"=>"N","Separated"=>"S","Don't Know"=>"D","Refused"=>"R");
	public static $dwellingArray = array("--"=>"","Single-family house"=>"00","Multiple-family house"=>"1","Apartment building"=>"2","Trailer"=>"3","Don't Know"=>"8","Refused"=>"9","Other (fill in the blank)"=>"4");
	public static $rentArray = array("--"=>"","Own"=>"00","Rent"=>"1","Live with family or friends"=>"2","Don't Know"=>"8","Refused"=>"9","Other (fill in the blank)"=>"3");


	/**
	 * Override method to perform a property "Get"
	 * This will get the value of $strName
	 * wpg - using this method control how information is displayed normally and 'demo' mode which
	 * obfuscates participant identifiers
	 * @param string $strName Name of the property to get
	 * @return mixed
	*/
	public function __get($strName) {
		if (defined('__DEMO_MODE__')) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				// wpg - added age
				case 'Age' :
					// need the participant age
					$difference = $this->objParticipant->Dateofbirth->Difference(QDateTime::Now(false));
					if (!is_null($difference))
						return -$difference->Years;
				case 'Caseid':
					/**
					 * Gets the value for strCaseid (Not Null)
					 * @return string
					 */
					return QString::Truncate(md5($this->strCaseid),5);

				case 'Title':
					/**
					 * Gets the value for strTitle
					 * @return string
					 */
					return QString::Truncate(md5($this->strTitle),5);

				case 'Lastname':
					/**
					 * Gets the value for strLastname
					 * @return string
					 */
					return QString::Truncate(md5($this->strLastname),5);

				case 'Firstname':
					/**
					 * Gets the value for strFirstname
					 * @return string
					 */
					return QString::Truncate(md5($this->strFirstname),5);

				case 'Middlename':
					/**
					 * Gets the value for strMiddlename
					 * @return string
					 */
					return QString::Truncate(md5($this->strMiddlename),5);

				case 'Maidenname':
					/**
					 * Gets the value for strMaidenname
					 * @return string
					 */
					return QString::Truncate(md5($this->strMaidenname),5);

				case 'Nickname':
					/**
					 * Gets the value for strNickname
					 * @return string
					 */
					return QString::Truncate(md5($this->strNickname),5);

				case 'Street':
					/**
					 * Gets the value for strStreet
					 * @return string
					 */
					return QString::Truncate(md5($this->strStreet),5);

				case 'Streetsort':
					/**
					 * Gets the value for strStreetsort (Not Null)
					 * @return string
					 */
					return QString::Truncate(md5($this->strStreetsort),5);

				case 'Pobox':
					/**
					 * Gets the value for strPobox
					 * @return string
					 */
					return QString::Truncate(md5($this->strPobox),5);

				case 'City':
					/**
					 * Gets the value for strCity
					 * @return string
					 */
					return QString::Truncate(md5($this->strCity),5);

				case 'State':
					/**
					 * Gets the value for strState
					 * @return string
					 */
					return QString::Truncate(md5($this->strState),5);

				case 'Zip':
					/**
					 * Gets the value for strZip
					 * @return string
					 */
					return QString::Truncate(md5($this->strZip),5);

				case 'Homephone':
					/**
					 * Gets the value for strHomephone
					 * @return string
					 */
					return QString::Truncate(md5($this->strHomephone),5);

				case 'Otherphone':
					/**
					 * Gets the value for strOtherphone
					 * @return string
					 */
					return QString::Truncate(md5($this->strOtherphone),5);

				case 'Gender':
					/**
					 * Gets the value for strGender
					 * @return string
					 */
					return QString::Truncate(md5($this->strGender),5);

				case 'Race':
					/**
					 * Gets the value for strRace
					 * @return string
					 */
					return QString::Truncate(md5($this->strRace),5);

				case 'Dateofbirth':
					/**
					 * Gets the value for dttDateofbirth
					 * @return QDateTime
					 */
					return NULL;

				case 'Numhouse':
					/**
					 * Gets the value for intNumhouse
					 * @return integer
					 */
					return QString::Truncate(md5($this->intNumhouse),5);

				case 'Typedwelling':
					/**
					 * Gets the value for strTypedwelling
					 * @return string
					 */
					return $this->strTypedwelling;

				case 'Typedwellingother':
					/**
					 * Gets the value for strTypedwellingother
					 * @return string
					 */
					return $this->strTypedwellingother;

				case 'Rentorown':
					/**
					 * Gets the value for strRentorown
					 * @return string
					 */
					return $this->strRentorown;

				case 'Rentorownother':
					/**
					 * Gets the value for strRentorownother
					 * @return string
					 */
					return $this->strRentorownother;

				case 'Maritalstatus':
					/**
					 * Gets the value for strMaritalstatus
					 * @return string
					 */
					return $this->strMaritalstatus;

				case 'Email':
					/**
					 * Gets the value for strEmail
					 * @return string
					 */
					return QString::Truncate(md5($this->strEmail),5);

				case 'C1name':
					/**
					 * Gets the value for strC1name
					 * @return string
					 */
					return QString::Truncate(md5($this->strC1name),5);

				case 'C1street':
					/**
					 * Gets the value for strC1street
					 * @return string
					 */
					return QString::Truncate(md5($this->strC1street),5);

				case 'C1pobox':
					/**
					 * Gets the value for strC1pobox
					 * @return string
					 */
					return QString::Truncate(md5($this->strC1pobox),5);

				case 'C1city':
					/**
					 * Gets the value for strC1city
					 * @return string
					 */
					return QString::Truncate(md5($this->strC1city),5);

				case 'C1state':
					/**
					 * Gets the value for strC1state
					 * @return string
					 */
					return QString::Truncate(md5($this->strC1state),5);

				case 'C1zip':
					/**
					 * Gets the value for strC1zip
					 * @return string
					 */
					return QString::Truncate(md5($this->strC1zip),5);

				case 'C1phone':
					/**
					 * Gets the value for strC1phone
					 * @return string
					 */
					return QString::Truncate(md5($this->strC1phone),5);

				case 'C1relation':
					/**
					 * Gets the value for strC1relation
					 * @return string
					 */
					return QString::Truncate(md5($this->strC1relation),5);

				case 'C2name':
					/**
					 * Gets the value for strC2name
					 * @return string
					 */
					return QString::Truncate(md5($this->strC2name),5);

				case 'C2street':
					/**
					 * Gets the value for strC2street
					 * @return string
					 */
					return QString::Truncate(md5($this->strC2street),5);

				case 'C2pobox':
					/**
					 * Gets the value for strC2pobox
					 * @return string
					 */
					return QString::Truncate(md5($this->strC2pobox),5);

				case 'C2city':
					/**
					 * Gets the value for strC2city
					 * @return string
					 */
					return QString::Truncate(md5($this->strC2city),5);

				case 'C2state':
					/**
					 * Gets the value for strC2state
					 * @return string
					 */
					return QString::Truncate(md5($this->strC2state),5);

				case 'C2zip':
					/**
					 * Gets the value for strC2zip
					 * @return string
					 */
					return QString::Truncate(md5($this->strC2zip),5);

				case 'C2phone':
					/**
					 * Gets the value for strC2phone
					 * @return string
					 */
					return QString::Truncate(md5($this->strC2phone),5);

				case 'C2relation':
					/**
					 * Gets the value for strC2relation
					 * @return string
					 */
					return QString::Truncate(md5($this->strC2relation),5);

				case 'C3name':
					/**
					 * Gets the value for strC3name
					 * @return string
					 */
					return QString::Truncate(md5($this->strC3name),5);

				case 'C3street':
					/**
					 * Gets the value for strC3street
					 * @return string
					 */
					return QString::Truncate(md5($this->strC3street),5);

				case 'C3pobox':
					/**
					 * Gets the value for strC3pobox
					 * @return string
					 */
					return QString::Truncate(md5($this->strC3pobox),5);

				case 'C3city':
					/**
					 * Gets the value for strC3city
					 * @return string
					 */
					return QString::Truncate(md5($this->strC3city),5);

				case 'C3state':
					/**
					 * Gets the value for strC3state
					 * @return string
					 */
					return QString::Truncate(md5($this->strC3state),5);

				case 'C3zip':
					/**
					 * Gets the value for strC3zip
					 * @return string
					 */
					return QString::Truncate(md5($this->strC3zip),5);

				case 'C3phone':
					/**
					 * Gets the value for strC3phone
					 * @return string
					 */
					return QString::Truncate(md5($this->strC3phone),5);

				case 'C3relation':
					/**
					 * Gets the value for strC3relation
					 * @return string
					 */
					return QString::Truncate(md5($this->strC3relation),5);

				case 'Basecode':
					/**
					 * Gets the value for intBasecode
					 * @return integer
					 */
					return QString::Truncate(md5($this->intBasecode),5);

				case 'F1code':
					/**
					 * Gets the value for intF1code
					 * @return integer
					 */
					return QString::Truncate(md5($this->intF1code),5);

				case 'Necode':
					/**
					 * Gets the value for intNecode
					 * @return integer
					 */
					return QString::Truncate(md5($this->intNecode),5);

				case 'Currentcode':
					/**
					 * Gets the value for intCurrentcode
					 * @return integer
					 */
					return QString::Truncate(md5($this->intCurrentcode),5);

				case 'Postcode':
					/**
					 * Gets the value for intPostcode
					 * @return integer
					 */
					return QString::Truncate(md5($this->intPostcode),5);

				case 'Base1stint':
					/**
					 * Gets the value for dttBase1stint
					 * @return QDateTime
					 */
					return NULL;
				case 'Baseclinic':
					/**
					 * Gets the value for dttBaseclinic
					 * @return QDateTime
					 */
					return NULL;

				case 'Base2ndint':
					/**
					 * Gets the value for dttBase2ndint
					 * @return QDateTime
					 */
					return NULL;

				case 'F11stint':
					/**
					 * Gets the value for dttF11stint
					 * @return QDateTime
					 */
					return NULL;

				case 'F1clinic':
					/**
					 * Gets the value for dttF1clinic
					 * @return QDateTime
					 */
					return NULL;

				case 'F12ndint':
					/**
					 * Gets the value for dttF12ndint
					 * @return QDateTime
					 */
					return NULL;

				case 'Ne1stint':
					/**
					 * Gets the value for dttNe1stint
					 * @return QDateTime
					 */
					return NULL;

				case 'Neclinic':
					/**
					 * Gets the value for dttNeclinic
					 * @return QDateTime
					 */
					return NULL;

				case 'Ne2ndint':
					/**
					 * Gets the value for dttNe2ndint
					 * @return QDateTime
					 */
					return NULL;

				case 'F21stint':
					/**
					 * Gets the value for dttF21stint
					 * @return QDateTime
					 */
					return NULL;

				case 'F2clinic':
					/**
					 * Gets the value for dttF2clinic
					 * @return QDateTime
					 */
					return NULL;

				case 'F22ndint':
					/**
					 * Gets the value for dttF22ndint
					 * @return QDateTime
					 */
					return NULL;

				case 'Buddyid':
					/**
					 * Gets the value for intBuddyid
					 * @return integer
					 */
					return QString::Truncate(md5($this->intBuddyid),5);

				case 'Buddydate':
					/**
					 * Gets the value for dttBuddydate
					 * @return QDateTime
					 */
					return NULL;

				case 'Acesid':
					/**
					 * Gets the value for strAcesid
					 * @return string
					 */
					return QString::Truncate(md5($this->strAcesid),5);

				case 'Aces1stint':
					/**
					 * Gets the value for dttAces1stint
					 * @return QDateTime
					 */
					return NULL;

				case 'Aces2ndint':
					/**
					 * Gets the value for dttAces2ndint
					 * @return QDateTime
					 */
					return NULL;

				case 'Gogoindid':
					/**
					 * Gets the value for intGogoindid
					 * @return integer
					 */
					return QString::Truncate(md5($this->intGogoindid),5);

				case 'Gogofamid':
					/**
					 * Gets the value for intGogofamid
					 * @return integer
					 */
					return QString::Truncate(md5($this->intGogofamid),5);

				case 'Gogodate':
					/**
					 * Gets the value for dttGogodate
					 * @return QDateTime
					 */
					return NULL;

				case 'Gogolongid':
					/**
					 * Gets the value for intGogolongid
					 * @return integer
					 */
					return QString::Truncate(md5($this->intGogolongid),5);

				case 'Gogolongdate':
					/**
					 * Gets the value for dttGogolongdate
					 * @return QDateTime
					 */
					return NULL;

				case 'Joproid':
					/**
					 * Gets the value for strJoproid
					 * @return string
					 */
					return QString::Truncate(md5($this->strJoproid),5);

				case 'Joprodate':
					/**
					 * Gets the value for dttJoprodate
					 * @return QDateTime
					 */
					return NULL;

				case 'Joprocont':
					/**
					 * Gets the value for intJoprocont (Not Null)
					 * @return integer
					 */
					return QString::Truncate(md5($this->intJoprocont),5);

				case 'Joprocomp':
					/**
					 * Gets the value for intJoprocomp (Not Null)
					 * @return integer
					 */
					return QString::Truncate(md5($this->intJoprocomp),5);

				case 'Lastcodeupdate':
					/**
					 * Gets the value for dttLastcodeupdate
					 * @return QDateTime
					 */
					return NULL;

				case 'Postcodeupdate':
					/**
					 * Gets the value for dttPostcodeupdate
					 * @return QDateTime
					 */
					return NULL;

				case 'T0weight':
					/**
					 * Gets the value for strT0weight
					 * @return string
					 */
					return QString::Truncate(md5($this->fltT0weight),5);

				case 'T1weight':
					/**
					 * Gets the value for strT1weight
					 * @return string
					 */
					return QString::Truncate(md5($this->fltT1weight),5);

				case 'Notes':
					/**
					 * Gets the value for strNotes
					 * @return string
					 */
					return QString::Truncate(md5($this->strNotes),5);

				case 'Otherstudy':
					/**
					 * Gets the value for strOtherstudy
					 * @return string
					 */
					return QString::Truncate(md5($this->strOtherstudy),5);

				case 'Homeinterviewer':
					/**
					 * Gets the value for strHomeinterviewer
					 * @return string
					 */
					return QString::Truncate(md5($this->strHomeinterviewer),5);

				case 'Id':
					/**
					 * Gets the value for intId (Read-Only PK)
					 * @return integer
					 */
					return $this->intId;

				case 'InterviewerId':
					/**
					 * Gets the value for intInterviewerId
					 * @return integer
					 */
					return $this->intInterviewerId;


					///////////////////
					// Member Objects
					///////////////////
				case 'Interviewer':
					/**
					 * Gets the value for the User object referenced by intInterviewerId
					 * @return User
					 */
					try {
						if ((!$this->objInterviewer) && (!is_null($this->intInterviewerId)))
							$this->objInterviewer = User::Load($this->intInterviewerId);
						return $this->objInterviewer;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


					////////////////////////////
					// Virtual Object References (Many to Many and Reverse References)
					// (If restored via a "Many-to" expansion)
					////////////////////////////

				case '_Calllog':
					/**
					 * Gets the value for the private _objCalllog (Read-Only)
					 * if set due to an expansion on the calllog.participant_id reverse relationship
					 * @return Calllog
					 */
					return $this->_objCalllog;

				case '_CalllogArray':
					/**
					 * Gets the value for the private _objCalllogArray (Read-Only)
					 * if set due to an ExpandAsArray on the calllog.participant_id reverse relationship
					 * @return Calllog[]
					 */
					return (array) $this->_objCalllogArray;

				case '_CurrentStatus':
					/**
					 * Gets the value for the private _objCurrentStatus (Read-Only)
					 * if set due to an expansion on the current_status.participant_id reverse relationship
					 * @return CurrentStatus
					 */
					return $this->_objCurrentStatus;

				case '_CurrentStatusArray':
					/**
					 * Gets the value for the private _objCurrentStatusArray (Read-Only)
					 * if set due to an ExpandAsArray on the current_status.participant_id reverse relationship
					 * @return CurrentStatus[]
					 */
					return (array) $this->_objCurrentStatusArray;

				case '_ParticipantAuditLog':
					/**
					 * Gets the value for the private _objParticipantAuditLog (Read-Only)
					 * if set due to an expansion on the participant_audit_log.participant_id reverse relationship
					 * @return ParticipantAuditLog
					 */
					return $this->_objParticipantAuditLog;

				case '_ParticipantAuditLogArray':
					/**
					 * Gets the value for the private _objParticipantAuditLogArray (Read-Only)
					 * if set due to an ExpandAsArray on the participant_audit_log.participant_id reverse relationship
					 * @return ParticipantAuditLog[]
					 */
					return (array) $this->_objParticipantAuditLogArray;

				case '_T3Sch':
					/**
					 * Gets the value for the private _objT3Sch (Read-Only)
					 * if set due to an expansion on the t3_sch.participant_id reverse relationship
					 * @return T3Sch
					 */
					return $this->_objT3Sch;

				case '_T3SchArray':
					/**
					 * Gets the value for the private _objT3SchArray (Read-Only)
					 * if set due to an ExpandAsArray on the t3_sch.participant_id reverse relationship
					 * @return T3Sch[]
					 */
					return (array) $this->_objT3SchArray;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
		else {
			switch ($strName) {
				// wpg - added age
				case 'Age' :
					// need the participant age
					$difference = $this->Dateofbirth->Difference(QDateTime::Now(false));
					if (!is_null($difference))
						return -$difference->Years;
					///////////////////
					// Member Variables
					///////////////////
				case 'Caseid':
					/**
					 * Gets the value for strCaseid (Not Null)
					 * @return string
					 */
					return $this->strCaseid;

				case 'Title':
					/**
					 * Gets the value for strTitle
					 * @return string
					 */
					return $this->strTitle;

				case 'Lastname':
					/**
					 * Gets the value for strLastname
					 * @return string
					 */
					return $this->strLastname;

				case 'Firstname':
					/**
					 * Gets the value for strFirstname
					 * @return string
					 */
					return $this->strFirstname;

				case 'Middlename':
					/**
					 * Gets the value for strMiddlename
					 * @return string
					 */
					return $this->strMiddlename;

				case 'Maidenname':
					/**
					 * Gets the value for strMaidenname
					 * @return string
					 */
					return $this->strMaidenname;

				case 'Nickname':
					/**
					 * Gets the value for strNickname
					 * @return string
					 */
					return $this->strNickname;

				case 'Street':
					/**
					 * Gets the value for strStreet
					 * @return string
					 */
					return $this->strStreet;

				case 'Streetsort':
					/**
					 * Gets the value for strStreetsort (Not Null)
					 * @return string
					 */
					return $this->strStreetsort;

				case 'Pobox':
					/**
					 * Gets the value for strPobox
					 * @return string
					 */
					return $this->strPobox;

				case 'City':
					/**
					 * Gets the value for strCity
					 * @return string
					 */
					return $this->strCity;

				case 'State':
					/**
					 * Gets the value for strState
					 * @return string
					 */
					return $this->strState;

				case 'Zip':
					/**
					 * Gets the value for strZip
					 * @return string
					 */
					return $this->strZip;

				case 'Homephone':
					/**
					 * Gets the value for strHomephone
					 * @return string
					 */
					return $this->strHomephone;

				case 'Otherphone':
					/**
					 * Gets the value for strOtherphone
					 * @return string
					 */
					return $this->strOtherphone;

				case 'Gender':
					/**
					 * Gets the value for strGender
					 * @return string
					 */
					return $this->strGender;

				case 'Race':
					/**
					 * Gets the value for strRace
					 * @return string
					 */
					return $this->strRace;

				case 'Dateofbirth':
					/**
					 * Gets the value for dttDateofbirth
					 * @return QDateTime
					 */
					return $this->dttDateofbirth;

				case 'Numhouse':
					/**
					 * Gets the value for intNumhouse
					 * @return integer
					 */
					return $this->intNumhouse;

				case 'Typedwelling':
					/**
					 * Gets the value for strTypedwelling
					 * @return string
					 */
					return $this->strTypedwelling;

				case 'Typedwellingother':
					/**
					 * Gets the value for strTypedwellingother
					 * @return string
					 */
					return $this->strTypedwellingother;

				case 'Rentorown':
					/**
					 * Gets the value for strRentorown
					 * @return string
					 */
					return $this->strRentorown;

				case 'Rentorownother':
					/**
					 * Gets the value for strRentorownother
					 * @return string
					 */
					return $this->strRentorownother;

				case 'Maritalstatus':
					/**
					 * Gets the value for strMaritalstatus
					 * @return string
					 */
					return $this->strMaritalstatus;

				case 'Email':
					/**
					 * Gets the value for strEmail
					 * @return string
					 */
					return $this->strEmail;

				case 'C1name':
					/**
					 * Gets the value for strC1name
					 * @return string
					 */
					return $this->strC1name;

				case 'C1street':
					/**
					 * Gets the value for strC1street
					 * @return string
					 */
					return $this->strC1street;

				case 'C1pobox':
					/**
					 * Gets the value for strC1pobox
					 * @return string
					 */
					return $this->strC1pobox;

				case 'C1city':
					/**
					 * Gets the value for strC1city
					 * @return string
					 */
					return $this->strC1city;

				case 'C1state':
					/**
					 * Gets the value for strC1state
					 * @return string
					 */
					return $this->strC1state;

				case 'C1zip':
					/**
					 * Gets the value for strC1zip
					 * @return string
					 */
					return $this->strC1zip;

				case 'C1phone':
					/**
					 * Gets the value for strC1phone
					 * @return string
					 */
					return $this->strC1phone;

				case 'C1relation':
					/**
					 * Gets the value for strC1relation
					 * @return string
					 */
					return $this->strC1relation;

				case 'C2name':
					/**
					 * Gets the value for strC2name
					 * @return string
					 */
					return $this->strC2name;

				case 'C2street':
					/**
					 * Gets the value for strC2street
					 * @return string
					 */
					return $this->strC2street;

				case 'C2pobox':
					/**
					 * Gets the value for strC2pobox
					 * @return string
					 */
					return $this->strC2pobox;

				case 'C2city':
					/**
					 * Gets the value for strC2city
					 * @return string
					 */
					return $this->strC2city;

				case 'C2state':
					/**
					 * Gets the value for strC2state
					 * @return string
					 */
					return $this->strC2state;

				case 'C2zip':
					/**
					 * Gets the value for strC2zip
					 * @return string
					 */
					return $this->strC2zip;

				case 'C2phone':
					/**
					 * Gets the value for strC2phone
					 * @return string
					 */
					return $this->strC2phone;

				case 'C2relation':
					/**
					 * Gets the value for strC2relation
					 * @return string
					 */
					return $this->strC2relation;

				case 'C3name':
					/**
					 * Gets the value for strC3name
					 * @return string
					 */
					return $this->strC3name;

				case 'C3street':
					/**
					 * Gets the value for strC3street
					 * @return string
					 */
					return $this->strC3street;

				case 'C3pobox':
					/**
					 * Gets the value for strC3pobox
					 * @return string
					 */
					return $this->strC3pobox;

				case 'C3city':
					/**
					 * Gets the value for strC3city
					 * @return string
					 */
					return $this->strC3city;

				case 'C3state':
					/**
					 * Gets the value for strC3state
					 * @return string
					 */
					return $this->strC3state;

				case 'C3zip':
					/**
					 * Gets the value for strC3zip
					 * @return string
					 */
					return $this->strC3zip;

				case 'C3phone':
					/**
					 * Gets the value for strC3phone
					 * @return string
					 */
					return $this->strC3phone;

				case 'C3relation':
					/**
					 * Gets the value for strC3relation
					 * @return string
					 */
					return $this->strC3relation;

				case 'Basecode':
					/**
					 * Gets the value for intBasecode
					 * @return integer
					 */
					return $this->intBasecode;

				case 'F1code':
					/**
					 * Gets the value for intF1code
					 * @return integer
					 */
					return $this->intF1code;

				case 'Necode':
					/**
					 * Gets the value for intNecode
					 * @return integer
					 */
					return $this->intNecode;

				case 'Currentcode':
					/**
					 * Gets the value for intCurrentcode
					 * @return integer
					 */
					return $this->intCurrentcode;

				case 'Postcode':
					/**
					 * Gets the value for intPostcode
					 * @return integer
					 */
					return $this->intPostcode;

				case 'Base1stint':
					/**
					 * Gets the value for dttBase1stint
					 * @return QDateTime
					 */
					return $this->dttBase1stint;

				case 'Baseclinic':
					/**
					 * Gets the value for dttBaseclinic
					 * @return QDateTime
					 */
					return $this->dttBaseclinic;

				case 'Base2ndint':
					/**
					 * Gets the value for dttBase2ndint
					 * @return QDateTime
					 */
					return $this->dttBase2ndint;

				case 'F11stint':
					/**
					 * Gets the value for dttF11stint
					 * @return QDateTime
					 */
					return $this->dttF11stint;

				case 'F1clinic':
					/**
					 * Gets the value for dttF1clinic
					 * @return QDateTime
					 */
					return $this->dttF1clinic;

				case 'F12ndint':
					/**
					 * Gets the value for dttF12ndint
					 * @return QDateTime
					 */
					return $this->dttF12ndint;

				case 'Ne1stint':
					/**
					 * Gets the value for dttNe1stint
					 * @return QDateTime
					 */
					return $this->dttNe1stint;

				case 'Neclinic':
					/**
					 * Gets the value for dttNeclinic
					 * @return QDateTime
					 */
					return $this->dttNeclinic;

				case 'Ne2ndint':
					/**
					 * Gets the value for dttNe2ndint
					 * @return QDateTime
					 */
					return $this->dttNe2ndint;

				case 'F21stint':
					/**
					 * Gets the value for dttF21stint
					 * @return QDateTime
					 */
					return $this->dttF21stint;

				case 'F2clinic':
					/**
					 * Gets the value for dttF2clinic
					 * @return QDateTime
					 */
					return $this->dttF2clinic;

				case 'F22ndint':
					/**
					 * Gets the value for dttF22ndint
					 * @return QDateTime
					 */
					return $this->dttF22ndint;

				case 'Buddyid':
					/**
					 * Gets the value for intBuddyid
					 * @return integer
					 */
					return $this->intBuddyid;

				case 'Buddydate':
					/**
					 * Gets the value for dttBuddydate
					 * @return QDateTime
					 */
					return $this->dttBuddydate;

				case 'Acesid':
					/**
					 * Gets the value for strAcesid
					 * @return string
					 */
					return $this->strAcesid;

				case 'Aces1stint':
					/**
					 * Gets the value for dttAces1stint
					 * @return QDateTime
					 */
					return $this->dttAces1stint;

				case 'Aces2ndint':
					/**
					 * Gets the value for dttAces2ndint
					 * @return QDateTime
					 */
					return $this->dttAces2ndint;

				case 'Gogoindid':
					/**
					 * Gets the value for intGogoindid
					 * @return integer
					 */
					return $this->intGogoindid;

				case 'Gogofamid':
					/**
					 * Gets the value for intGogofamid
					 * @return integer
					 */
					return $this->intGogofamid;

				case 'Gogodate':
					/**
					 * Gets the value for dttGogodate
					 * @return QDateTime
					 */
					return $this->dttGogodate;

				case 'Gogolongid':
					/**
					 * Gets the value for intGogolongid
					 * @return integer
					 */
					return $this->intGogolongid;

				case 'Gogolongdate':
					/**
					 * Gets the value for dttGogolongdate
					 * @return QDateTime
					 */
					return $this->dttGogolongdate;

				case 'Joproid':
					/**
					 * Gets the value for strJoproid
					 * @return string
					 */
					return $this->strJoproid;

				case 'Joprodate':
					/**
					 * Gets the value for dttJoprodate
					 * @return QDateTime
					 */
					return $this->dttJoprodate;

				case 'Joprocont':
					/**
					 * Gets the value for intJoprocont (Not Null)
					 * @return integer
					 */
					return $this->intJoprocont;

				case 'Joprocomp':
					/**
					 * Gets the value for intJoprocomp (Not Null)
					 * @return integer
					 */
					return $this->intJoprocomp;

				case 'Lastcodeupdate':
					/**
					 * Gets the value for dttLastcodeupdate
					 * @return QDateTime
					 */
					return $this->dttLastcodeupdate;

				case 'Postcodeupdate':
					/**
					 * Gets the value for dttPostcodeupdate
					 * @return QDateTime
					 */
					return $this->dttPostcodeupdate;

				case 'T0weight':
					/**
					 * Gets the value for strT0weight
					 * @return string
					 */
					return $this->fltT0weight;

				case 'T1weight':
					/**
					 * Gets the value for strT1weight
					 * @return string
					 */
					return $this->fltT1weight;

				case 'Notes':
					/**
					 * Gets the value for strNotes
					 * @return string
					 */
					return $this->strNotes;

				case 'Otherstudy':
					/**
					 * Gets the value for strOtherstudy
					 * @return string
					 */
					return $this->strOtherstudy;

				case 'Homeinterviewer':
					/**
					 * Gets the value for strHomeinterviewer
					 * @return string
					 */
					return $this->strHomeinterviewer;

				case 'Id':
					/**
					 * Gets the value for intId (Read-Only PK)
					 * @return integer
					 */
					return $this->intId;

				case 'InterviewerId':
					/**
					 * Gets the value for intInterviewerId
					 * @return integer
					 */
					return $this->intInterviewerId;


					///////////////////
					// Member Objects
					///////////////////
				case 'Interviewer':
					/**
					 * Gets the value for the User object referenced by intInterviewerId
					 * @return User
					 */
					try {
						if ((!$this->objInterviewer) && (!is_null($this->intInterviewerId)))
							$this->objInterviewer = User::Load($this->intInterviewerId);
						return $this->objInterviewer;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


					////////////////////////////
					// Virtual Object References (Many to Many and Reverse References)
					// (If restored via a "Many-to" expansion)
					////////////////////////////

				case '_Calllog':
					/**
					 * Gets the value for the private _objCalllog (Read-Only)
					 * if set due to an expansion on the calllog.participant_id reverse relationship
					 * @return Calllog
					 */
					return $this->_objCalllog;

				case '_CalllogArray':
					/**
					 * Gets the value for the private _objCalllogArray (Read-Only)
					 * if set due to an ExpandAsArray on the calllog.participant_id reverse relationship
					 * @return Calllog[]
					 */
					return (array) $this->_objCalllogArray;

				case '_CurrentStatus':
					/**
					 * Gets the value for the private _objCurrentStatus (Read-Only)
					 * if set due to an expansion on the current_status.participant_id reverse relationship
					 * @return CurrentStatus
					 */
					return $this->_objCurrentStatus;

				case '_CurrentStatusArray':
					/**
					 * Gets the value for the private _objCurrentStatusArray (Read-Only)
					 * if set due to an ExpandAsArray on the current_status.participant_id reverse relationship
					 * @return CurrentStatus[]
					 */
					return (array) $this->_objCurrentStatusArray;

				case '_ParticipantAuditLog':
					/**
					 * Gets the value for the private _objParticipantAuditLog (Read-Only)
					 * if set due to an expansion on the participant_audit_log.participant_id reverse relationship
					 * @return ParticipantAuditLog
					 */
					return $this->_objParticipantAuditLog;

				case '_ParticipantAuditLogArray':
					/**
					 * Gets the value for the private _objParticipantAuditLogArray (Read-Only)
					 * if set due to an ExpandAsArray on the participant_audit_log.participant_id reverse relationship
					 * @return ParticipantAuditLog[]
					 */
					return (array) $this->_objParticipantAuditLogArray;

				case '_T3Sch':
					/**
					 * Gets the value for the private _objT3Sch (Read-Only)
					 * if set due to an expansion on the t3_sch.participant_id reverse relationship
					 * @return T3Sch
					 */
					return $this->_objT3Sch;

				case '_T3SchArray':
					/**
					 * Gets the value for the private _objT3SchArray (Read-Only)
					 * if set due to an ExpandAsArray on the t3_sch.participant_id reverse relationship
					 * @return T3Sch[]
					 */
					return (array) $this->_objT3SchArray;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}


	/**
	 * Saves a Participant record to the audit log
	 * @return void
		*/
	public function AuditSave($userId, $update=null) {
			
		// Get the Database Object for this Class
		$objDatabase = ParticipantAudit::GetDatabase();

		// Perform an INSERT query
		$objDatabase->NonQuery('
				INSERT INTO '.QQNodeParticipant::$strPubTableName.' (
				caseid,
				title,
				lastname,
				firstname,
				middlename,
				maidenname,
				nickname,
				street,
				streetsort,
				pobox,
				city,
				state,
				zip,
				homephone,
				otherphone,
				gender,
				race,
				dateofbirth,
				numhouse,
				typedwelling,
				typedwellingother,
				rentorown,
				rentorownother,
				maritalstatus,
				email,
				c1name,
				c1street,
				c1pobox,
				c1city,
				c1state,
				c1zip,
				c1phone,
				c1relation,
				c2name,
				c2street,
				c2pobox,
				c2city,
				c2state,
				c2zip,
				c2phone,
				c2relation,
				c3name,
				c3street,
				c3pobox,
				c3city,
				c3state,
				c3zip,
				c3phone,
				c3relation,
				basecode,
				f1code,
				necode,
				currentcode,
				postcode,
				base1stint,
				baseclinic,
				base2ndint,
				f11stint,
				f1clinic,
				f12ndint,
				ne1stint,
				neclinic,
				ne2ndint,
				f21stint,
				f2clinic,
				f22ndint,
				buddyid,
				buddydate,
				acesid,
				aces1stint,
				aces2ndint,
				gogoindid,
				gogofamid,
				gogodate,
				gogolongid,
				gogolongdate,
				joproid,
				joprodate,
				joprocont,
				joprocomp,
				lastcodeupdate,
				postcodeupdate,
				t0weight,
				t1weight,
				notes,
				otherstudy,
				homeinterviewer,
				interviewer_id,
				id
				) SELECT
				caseid,
				title,
				lastname,
				firstname,
				middlename,
				maidenname,
				nickname,
				street,
				streetsort,
				pobox,
				city,
				state,
				zip,
				homephone,
				otherphone,
				gender,
				race,
				dateofbirth,
				numhouse,
				typedwelling,
				typedwellingother,
				rentorown,
				rentorownother,
				maritalstatus,
				email,
				c1name,
				c1street,
				c1pobox,
				c1city,
				c1state,
				c1zip,
				c1phone,
				c1relation,
				c2name,
				c2street,
				c2pobox,
				c2city,
				c2state,
				c2zip,
				c2phone,
				c2relation,
				c3name,
				c3street,
				c3pobox,
				c3city,
				c3state,
				c3zip,
				c3phone,
				c3relation,
				basecode,
				f1code,
				necode,
				currentcode,
				postcode,
				base1stint,
				baseclinic,
				base2ndint,
				f11stint,
				f1clinic,
				f12ndint,
				ne1stint,
				neclinic,
				ne2ndint,
				f21stint,
				f2clinic,
				f22ndint,
				buddyid,
				buddydate,
				acesid,
				aces1stint,
				aces2ndint,
				gogoindid,
				gogofamid,
				gogodate,
				gogolongid,
				gogolongdate,
				joproid,
				joprodate,
				joprocont,
				joprocomp,
				lastcodeupdate,
				postcodeupdate,
				t0weight,
				t1weight,
				notes,
				otherstudy,
				homeinterviewer,
				interviewer_id,
				id
				FROM participant WHERE id = ' . $objDatabase->SqlVariable($this->intId));
		// Update Identity column and return its value
		$participantAuditId = $objDatabase->InsertId(QQNodeParticipant::$strPubTableName, 'audit_id');
			
		if ($update) return $participantAuditId;
		else {
			// for the new audit record we need add a reference table to show when the participant record was updated and by whom
			$objParticipantAuditLog = new ParticipantAuditLog();
			$objParticipantAuditLog->AuditId = $participantAuditId;
			$objParticipantAuditLog->ModifiedById = $userId;
			$objParticipantAuditLog->ModifiedDate = QDateTime::Now(true);
			$objParticipantAuditLog->Save();
		}
	}

	/**
	 * Saves a Participant record to the audit log
	 * @return void
		*/
	public function AuditLogSave($userId,$auditId) {
		// for the new audit record we need add a reference table to show when the participant record was updated and by whom
		$objParticipantAuditLog = new ParticipantAuditLog();
		$objParticipantAuditLog->AuditId = $auditId;
		$objParticipantAuditLog->ModifiedById = $userId;
		$objParticipantAuditLog->ModifiedDate = QDateTime::Now(true);
		$objParticipantAuditLog->Save();
	}
}
?>