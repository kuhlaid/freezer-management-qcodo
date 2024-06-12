<?php
require(__DATAGEN_CLASSES__ . '/FreezerGen.class.php');

/**
 * The Freezer class defined here contains any
 * customized code for the Freezer class in the
 * Object Relational Model.  It represents the "freezer" table
 * in the database, and extends from the code generated abstract FreezerGen
 * class, which contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * @package My Application
 * @subpackage DataObjects
 *
*/
class Freezer extends FreezerGen {
	/**
	 * Default "to string" handler
	 * Allows pages to _p()/echo()/print() this object, and to define the default
	 * way this object would be outputted.
	 *
	 * Can also be called directly via $objFreezer->__toString().
	 *
	 * @return string a nicely formatted string representation of this object
	 */
	public function __toString() {
		return sprintf('%s',  $this->Name);
	}

	public static $freezerArray = array(-3=>'Box no longer used',-2=>'Box sent off site',-1=>'Unknown freezer');

	// added to define when a freezer is 'in use' or not
	public static $freezerInUseArray = array(1=>'In use',2=>'Temporary offline',3=>'Surplused');


	// return a human readable freezer name for a given ID (Feb. 4, 2016 - wpg)
	// 	public static function getFreezerName($id) {
	// 		if ($id < 1 && $id!='') {
	// 			foreach(reezer::$freezerArray[$id] as $freezerCode => $freezerName)
		// 				return "(".$freezerCode.") ".$freezerName;
		// 		}
		// 		else {
		// 			return $id;
		// 		}

		//(array_key_exists($objRack->Freezer, $this->objFreezerArray)||trim($objRack->Freezer ?? '')!='')?$this->objFreezerArray[$objRack->Freezer]:''

		// 		$objFreezerArray = Freezer::QueryArray(QQ::All(),null,null,array('id','name'));
		// 		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
		// 			$objFreezerArray2[$objFreezer->Id] = $objFreezer->Name;
		// 		}
		// 		return $objFreezerArray2;
		//	}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
	/*
	public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return an array of Freezer objects
	return Freezer::QueryArray(
			QQ::AndCondition(
					QQ::Equal(QQN::Freezer()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Freezer()->Param2, $intParam2)
			),
			$objOptionalClauses
	);
	}

	public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return a single Freezer object
	return Freezer::QuerySingle(
			QQ::AndCondition(
					QQ::Equal(QQN::Freezer()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Freezer()->Param2, $intParam2)
			),
			$objOptionalClauses
	);
	}

	public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
	// This will return a count of Freezer objects
	return Freezer::QueryCount(
	QQ::AndCondition(
	QQ::Equal(QQN::Freezer()->Param1, $strParam1),
	QQ::Equal(QQN::Freezer()->Param2, $intParam2)
	),
	$objOptionalClauses
	);
	}

	public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
	// Performing the load manually (instead of using Qcodo Query)

	// Get the Database Object for this Class
	$objDatabase = Freezer::GetDatabase();

	// Properly Escape All Input Parameters using Database->SqlVariable()
	$strParam1 = $objDatabase->SqlVariable($strParam1);
	$intParam2 = $objDatabase->SqlVariable($intParam2);

	// Setup the SQL Query
	$strQuery = sprintf('
	SELECT
	freezer.*
	FROM
	freezer AS freezer
	WHERE
	param_1 = %s AND
	param_2 < %s',
	$strParam1, $intParam2);

	// Perform the Query and Instantiate the Result
	$objDbResult = $objDatabase->Query($strQuery);
	return Freezer::InstantiateDbResult($objDbResult);
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