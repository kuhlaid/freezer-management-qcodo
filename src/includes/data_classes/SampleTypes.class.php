<?php
require(__DATAGEN_CLASSES__ . '/SampleTypesGen.class.php');

/**
 * The SampleTypes class defined here contains any
 * customized code for the SampleTypes class in the
 * Object Relational Model.  It represents the "sample_types" table
 * in the database, and extends from the code generated abstract SampleTypesGen
 * class, which contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * @package My Application
 * @subpackage DataObjects
 *
*/
class SampleTypes extends SampleTypesGen {
	// wpg - added to work like a type table
	public static $NameArray = array(
			1=>'Serum',
			2=>'Urine',
			3=>'WPPR',
			4=>'Paxgene',
			5=>'DNA',
			6=>'Blood Metals',
			7=>'Monovettes',
			8=>'Plasma',
			9=>'Red Blood Cell',
			10=>'Buffy coat (White Blood Cell)',
			11=>'Non-hazardous Human Cell Lines',
			12=>'Synovial Fluid',
			13=>'Bone (in 20 ml specimen tube-5672321)',
			14=>'Cartilage (in 20 ml specimen tube-5672321)'
	);

	/**
	 * Default "to string" handler
	 * Allows pages to _p()/echo()/print() this object, and to define the default
	 * way this object would be outputted.
	 *
	 * Can also be called directly via $objSampleTypes->__toString().
	 *
	 * @return string a nicely formatted string representation of this object
	*/
	public function __toString() {
		return sprintf('%s',  $this->Description);
	}

	public static $sampleColor = array(1=>array("s1 bld fs14","Maroon","s1"),2=>array("s2 bld fs14","YELLOW","s2"),3=>array("s3 bld fs14","PURPLE","s3"),4=>array("sPurple bld fs14","PURPLE","sPurple"),5=>array("sPurple bld fs14","PURPLE","sPurple"),6=>array("sPurple bld fs14","PURPLE","sPurple"),7=>array("sPurple bld fs14","PURPLE","sPurple"),8=>array("s8 bld fs14","ORANGE","s8"),9=>array("s9 bld fs14","RED","s9"),10=>array("s10 bld fs14","WHITE","s10"));


	// Override or Create New Load/Count methods
	// (For obvious reasons, these methods are commented out...
	// but feel free to use these as a starting point)
	/*
	public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return an array of SampleTypes objects
	return SampleTypes::QueryArray(
			QQ::AndCondition(
					QQ::Equal(QQN::SampleTypes()->Param1, $strParam1),
					QQ::GreaterThan(QQN::SampleTypes()->Param2, $intParam2)
			),
			$objOptionalClauses
	);
	}

	public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return a single SampleTypes object
	return SampleTypes::QuerySingle(
			QQ::AndCondition(
					QQ::Equal(QQN::SampleTypes()->Param1, $strParam1),
					QQ::GreaterThan(QQN::SampleTypes()->Param2, $intParam2)
			),
			$objOptionalClauses
	);
	}

	public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return a count of SampleTypes objects
	return SampleTypes::QueryCount(
	QQ::AndCondition(
	QQ::Equal(QQN::SampleTypes()->Param1, $strParam1),
	QQ::Equal(QQN::SampleTypes()->Param2, $intParam2)
	),
	$objOptionalClauses
	);
	}

	public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
	// Performing the load manually (instead of using Qcodo Query)

	// Get the Database Object for this Class
	$objDatabase = SampleTypes::GetDatabase();

	// Properly Escape All Input Parameters using Database->SqlVariable()
	$strParam1 = $objDatabase->SqlVariable($strParam1);
	$intParam2 = $objDatabase->SqlVariable($intParam2);

	// Setup the SQL Query
	$strQuery = sprintf('
	SELECT
	sample_types.*
	FROM
	sample_types AS sample_types
	WHERE
	param_1 = %s AND
	param_2 < %s',
	$strParam1, $intParam2);

	// Perform the Query and Instantiate the Result
	$objDbResult = $objDatabase->Query($strQuery);
	return SampleTypes::InstantiateDbResult($objDbResult);
	}
	*/



	// Override or Create New Properties and Variables
	// For performance reasons, these variables and __set and __get override methods
	// are commented out.  But if you wish to implement or override any
	// of the data generated properties, please feel free to uncomment them.
	/*
	protected $strSomeNewProperty;

	public function __get($strName) {
	switch ($strName) {
	case 'SomeNewProperty': return $this->strSomeNewProperty;

	default:
	try {
	return parent::__get($strName);
	} catch (QCallerException $objExc) {
	$objExc->IncrementOffset();
	throw $objExc;
	}
	}
	}

	public function __set($strName, $mixValue) {
	switch ($strName) {
	case 'SomeNewProperty':
	try {
	return ($this->strSomeNewProperty = QType::Cast($mixValue, QType::String));
	} catch (QInvalidCastException $objExc) {
	$objExc->IncrementOffset();
	throw $objExc;
	}

	default:
	try {
	return (parent::__set($strName, $mixValue));
	} catch (QCallerException $objExc) {
	$objExc->IncrementOffset();
	throw $objExc;
	}
	}
	}
	*/
}
?>