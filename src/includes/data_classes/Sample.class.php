<?php
require(__DATAGEN_CLASSES__ . '/SampleGen.class.php');

/**
 * The Sample class defined here contains any
 * customized code for the Sample class in the
 * Object Relational Model.  It represents the "sample" table
 * in the database, and extends from the code generated abstract SampleGen
 * class, which contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * @package My Application
 * @subpackage DataObjects
 *
*/
class Sample extends SampleGen {
	/**
	 * Default "to string" handler
	 * Allows pages to _p()/echo()/print() this object, and to define the default
	 * way this object would be outputted.
	 *
	 * Can also be called directly via $objSample->__toString().
	 *
	 * @return string a nicely formatted string representation of this object
	 */
	public function __toString() {
		return sprintf('Sample Object %s',  $this->intId);
	}

	// W is for testing and is not really used for anything else
	public static $townArray = array("A"=>1,"B"=>2,"C"=>3,"D"=>4,"E"=>5,"F"=>6,"W"=>7);
	public static $sampleTypeArray = array("S"=>19,"U"=>21,"W"=>23,"A"=>'01');	// sampleses_types.letter => numeric equivalent of sample letter
	//public static $t3SampleNumber2Type = array(19=>1,21=>2,23=>10,'01'=>8);	// numeric equivalent of sample letter => sample type match
	public static $t3SampleNumber2BoxType = array('01'=>3,19=>1,21=>2,23=>3);	// numeric equivalent of sample letter(A,S,U,W) => box type match (sample type)
	public static $RC653SampleNumberType = array('08'=>3,'09'=>3,10=>3);	// valid sample types for the #295-dp project


	/**
	 * @abstract Generates the coded barcode for a particular sample type and number for a participant
	 *
	*/
	public static function codedSample($s_type='S',$num=1, $caseid='') {
		return Sample::$townArray[substr($caseid,0,1)].substr($caseid,1).Sample::$sampleTypeArray[$s_type].$num;
	}

	/**
	 * @abstract Generates the human-readable barcode label for a particular sample type and number for a participant
	 *
	 */
	public static function labelSample($s_type='S',$num=1, $caseid='') {
		return 'J3-'.$caseid.'-'.$s_type.$num;
	}

	/**
	 * Takes the barcode for the T3 sample and sets the participant id, sample type id and sample number
	 * @argument $matchSample Check to see if the barcode matches a particular sample type
	 */
	public function parseT3Barcode($matchSample='') {
		// if we have a barcode then we try and parse it
		if ($this->Barcode) {
			$letter = '';
			foreach (Sample::$townArray as $townLetter=>$townValue){
				if ($townValue==substr($this->Barcode,0,1))
					$letter = $townLetter;
			}
			$caseid = $letter.substr($this->Barcode,1,4);

			// parse out participant id
			$objParticipant = Participant::QuerySingle(
					QQ::Equal(QQN::Participant()->Caseid, $caseid)
			);
			if (!$objParticipant)
				return false;
			$this->ParticipantId = $objParticipant->Id;
			$this->StudyCase = $objParticipant->Caseid;

			// if the barcode has not been fully formed then we need to stop things
			// we will check the sample type at this point
			if (substr($this->Barcode,5,2) == '' || !array_key_exists(substr($this->Barcode,5,2), Sample::$t3SampleNumber2BoxType)) return false;

			$sampleTypeId = Sample::$t3SampleNumber2BoxType[substr($this->Barcode,5,2)];

			// post an issue if the barcode is a sample type not matching the selected type
			if ($matchSample != '' && $sampleTypeId!=$matchSample) return false;

			$objSampleType = SampleTypes::LoadById($sampleTypeId);
			if (!$objSampleType)
				return false;
			$this->SampleTypeId = $sampleTypeId;

			if (substr($this->Barcode,7,1) == '')
				return false;
			$this->SampleNumber = substr($this->Barcode,7,1);

			return true;
		}
	}

	/**
	 * Takes the barcode for the RC653 (#295-dp) sample and sets the participant id, sample type id and sample number
	 * @argument $matchSample Check to see if the barcode matches a particular sample type
	 */
	public function parseRC653Barcode() {
		// if we have a barcode then we try and parse it
		if ($this->Barcode) {
			// if the barcode has not been fully formed then we need to stop things
			// we will check the sample type at this point
			if (substr($this->Barcode,4,2) == '' || !array_key_exists(substr($this->Barcode,4,2), Sample::$RC653SampleNumberType)) return false;

			if (substr($this->Barcode,0,3) != '')
				$this->StudyCase = substr($this->Barcode,0,3).'A';

			// set the sample type
			$this->SampleTypeId = substr($this->Barcode,4,2);
			//QApplication::DisplayAlert($this->StudyCase);
			if (substr($this->Barcode,7,1) == '')
				return false;
			$this->SampleNumber = substr($this->Barcode,7,1);
			//QApplication::DisplayAlert($this->SampleNumber);
			return true;
		}
	}

	/**
	 * Takes the barcode for the Interleukin Genetics DNA sample and sets the participant id, sample type id and sample number
	 * @argument $matchSample Check to see if the barcode matches a particular sample type
	 */
	public function parseIG_Barcode($matchSample='') {
		// if we have a barcode then we try and parse it
		if ($this->Barcode) {
			$letter = '';
			// check that first letter is the town
			foreach (Sample::$townArray as $townLetter=>$townValue){
				if ($townLetter==substr($this->Barcode,0,1))
					$letter = $townLetter;
			}
			$caseid = $letter.substr($this->Barcode,1,4);

			// parse out participant id
			$objParticipant = Participant::QuerySingle(
					QQ::Equal(QQN::Participant()->Caseid, $caseid)
			);
			if (!$objParticipant)
				return false;
			$this->ParticipantId = $objParticipant->Id;
			// these should just be constants
			$this->SampleTypeId = 5;
			$this->SampleNumber = 1;

			return true;
		}
	}
}

?>