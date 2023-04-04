<?php
require(__DATAGEN_CLASSES__ . '/BoxGen.class.php');

/**
 * The Box class defined here contains any
 * customized code for the Box class in the
 * Object Relational Model.  It represents the "box" table
 * in the database, and extends from the code generated abstract BoxGen
 * class, which contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * @package My Application
 * @subpackage DataObjects
 *
*/
class Box extends BoxGen {
	/**
	 * Default "to string" handler
	 * Allows pages to _p()/echo()/print() this object, and to define the default
	 * way this object would be outputted.
	 *
	 * Can also be called directly via $objBox->__toString().
	 *
	 * @return string a nicely formatted string representation of this object
	 */
	public function __toString() {
		return sprintf('%s',  $this->Name);
	}

	public function __toStringLong() {
		return sprintf('%s (F%s/S%s/%s)',  $this->Name, $this->Freezer, $this->Shelf, $this->Rack);
	}


	public function __toStringLongDecript() {
		return sprintf('%s (F%s/S%s/%s)<br/>%s',  $this->Name, $this->Freezer, $this->Shelf, $this->Rack,$this->Description);
	}

	// name and description of box
	public function __toStringDesc() {
		return sprintf('<a href="boxes.php?intBoxId=%s" title="%s">%s</a>', $this->Id, $this->Description,$this->Name);
	}

	// constants for managing the forms
	public static $formName = "Biological sample box";
	public static $script = "box.php";
	public static $nextScript = "boxes.php";

	/**
	 * - not functional
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery("
				DELETE FROM box");
	}


	/**
	 * Gets an associated SampleBoxLocations as a SampleBoxLocation object
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return SampleBoxLocation
		*/
	public function GetSampleBoxLocation($intBoxSampleSlot, $objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Sample::QuerySingle(
					QQ::AndCondition(
							QQ::Equal(QQN::Sample()->BoxSampleSlot, $intBoxSampleSlot),
							QQ::Equal(QQN::Sample()->BoxId, $this->intId)
					),null,null,array('id'));
			// 				return SampleBoxLocation::QuerySingle(
			// 						QQ::AndCondition(
			// 								QQ::Equal(QQN::SampleBoxLocation()->BoxSampleSlot, $intBoxSampleSlot),
			// 								QQ::Equal(QQN::SampleBoxLocation()->BoxId, $this->intId)
			// 						), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * wpg - Load an array of Box objects by freezer (July 2012)
	 * @param integer $intFreezerId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
		*/
	public static function LoadArrayByFreezerId($intFreezerId, $objOptionalClauses = null) {
		try {
			return Box::QueryArray(
					QQ::Equal(QQN::Box()->Freezer, $intFreezerId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	// Override or Create New Load/Count methods
	// (For obvious reasons, these methods are commented out...
	// but feel free to use these as a starting point)
	/*
	public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return an array of Box objects
	return Box::QueryArray(
			QQ::AndCondition(
					QQ::Equal(QQN::Box()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Box()->Param2, $intParam2)
			),
			$objOptionalClauses
	);
	}

	public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return a single Box object
	return Box::QuerySingle(
			QQ::AndCondition(
					QQ::Equal(QQN::Box()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Box()->Param2, $intParam2)
			),
			$objOptionalClauses
	);
	}

	public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return a count of Box objects
	return Box::QueryCount(
			QQ::AndCondition(
					QQ::Equal(QQN::Box()->Param1, $strParam1),
	QQ::Equal(QQN::Box()->Param2, $intParam2)
	),
	$objOptionalClauses
	);
	}

	public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
	// Performing the load manually (instead of using Qcodo Query)

	// Get the Database Object for this Class
	$objDatabase = Box::GetDatabase();

	// Properly Escape All Input Parameters using Database->SqlVariable()
	$strParam1 = $objDatabase->SqlVariable($strParam1);
	$intParam2 = $objDatabase->SqlVariable($intParam2);

	// Setup the SQL Query
	$strQuery = sprintf('
	SELECT
	box.*
	FROM
	box AS box
	WHERE
	param_1 = %s AND
	param_2 < %s',
	$strParam1, $intParam2);

	// Perform the Query and Instantiate the Result
	$objDbResult = $objDatabase->Query($strQuery);
	return Box::InstantiateDbResult($objDbResult);
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