<?php
require(__DATAGEN_CLASSES__ . '/SampleStateTypesGen.class.php');

/**
 * The SampleStateTypes class defined here contains any
 * customized code for the SampleStateTypes class in the
 * Object Relational Model.  It represents the "sample_state_types" table
 * in the database, and extends from the code generated abstract SampleStateTypesGen
 * class, which contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * @package My Application
 * @subpackage DataObjects
 *
*/
class SampleStateTypes extends SampleStateTypesGen {
	/**
	 * Default "to string" handler
	 * Allows pages to _p()/echo()/print() this object, and to define the default
	 * way this object would be outputted.
	 *
	 * Can also be called directly via $objSampleStateTypes->__toString().
	 *
	 * @return string a nicely formatted string representation of this object
	 */
	public function __toString() {
		return sprintf('%s',  $this->Name);
	}



	// Override or Create New Load/Count methods
	// (For obvious reasons, these methods are commented out...
	// but feel free to use these as a starting point)
	/*
	public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return an array of SampleStateTypes objects
	return SampleStateTypes::QueryArray(
			QQ::AndCondition(
					QQ::Equal(QQN::SampleStateTypes()->Param1, $strParam1),
					QQ::GreaterThan(QQN::SampleStateTypes()->Param2, $intParam2)
			),
			$objOptionalClauses
	);
	}

	public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return a single SampleStateTypes object
	return SampleStateTypes::QuerySingle(
			QQ::AndCondition(
					QQ::Equal(QQN::SampleStateTypes()->Param1, $strParam1),
					QQ::GreaterThan(QQN::SampleStateTypes()->Param2, $intParam2)
			),
			$objOptionalClauses
	);
	}

	public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return a count of SampleStateTypes objects
	return SampleStateTypes::QueryCount(
	QQ::AndCondition(
	QQ::Equal(QQN::SampleStateTypes()->Param1, $strParam1),
	QQ::Equal(QQN::SampleStateTypes()->Param2, $intParam2)
	),
	$objOptionalClauses
	);
	}

	public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
	// Performing the load manually (instead of using Qcodo Query)

	// Get the Database Object for this Class
	$objDatabase = SampleStateTypes::GetDatabase();

	// Properly Escape All Input Parameters using Database->SqlVariable()
	$strParam1 = $objDatabase->SqlVariable($strParam1);
	$intParam2 = $objDatabase->SqlVariable($intParam2);

	// Setup the SQL Query
	$strQuery = sprintf('
	SELECT
	sample_state_types.*
	FROM
	sample_state_types AS sample_state_types
	WHERE
	param_1 = %s AND
	param_2 < %s',
	$strParam1, $intParam2);

	// Perform the Query and Instantiate the Result
	$objDbResult = $objDatabase->Query($strQuery);
	return SampleStateTypes::InstantiateDbResult($objDbResult);
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