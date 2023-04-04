<?php
/**
 * The abstract SampleRackGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the SampleRack subclass which
 * extends this SampleRackGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the SampleRack class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class SampleRackGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a SampleRack from PK Info
	 * @param integer $intId
	 * @return SampleRack
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return SampleRack::QuerySingle(
				QQ::Equal(QQN::SampleRack()->Id, $intId)
		);
	}

	/**
	 * Load all SampleRacks
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return SampleRack[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call SampleRack::QueryArray to perform the LoadAll query
		try {
			return SampleRack::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all SampleRacks
	 * @return int
	 */
	public static function CountAll() {
		// Call SampleRack::QueryCount to perform the CountAll query
		return SampleRack::QueryCount(QQ::All());
	}



	///////////////////////////////
	// QCODO QUERY-RELATED METHODS
	///////////////////////////////

	/**
	 * Static method to retrieve the Database object that owns this class.
	 * @return QDatabaseBase reference to the Database object that can query this class
	 */
	public static function GetDatabase() {
		return QApplication::$Database[1];
	}

	/**
	 * Internally called method to assist with calling Qcodo Query for this class
	 * on load methods.
	 * @param QQueryBuilder &$objQueryBuilder the QueryBuilder object that will be created
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with (sending in null will skip the PrepareStatement step)
	 * @param boolean $blnCountOnly only select a rowcount
	 * @return string the query statement
	 */
	protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
		// Get the Database Object for this Class
		$objDatabase = SampleRack::GetDatabase();

		// Create/Build out the QueryBuilder object with SampleRack-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__sample_rack');
		SampleRack::GetSelectFields($objQueryBuilder);
		$objQueryBuilder->AddFromItem('fm__`sample_rack` AS fm__`sample_rack`');

		// Set "CountOnly" option (if applicable)
		if ($blnCountOnly)
			$objQueryBuilder->SetCountOnlyFlag();

		// Apply Any Conditions
		if ($objConditions)
			$objConditions->UpdateQueryBuilder($objQueryBuilder);

		// Iterate through all the Optional Clauses (if any) and perform accordingly
		if ($objOptionalClauses) {
			if (!is_array($objOptionalClauses))
				throw new QCallerException('Optional Clauses must be a QQ::Clause() or an array of QQClause objects');
			foreach ($objOptionalClauses as $objClause)
				$objClause->UpdateQueryBuilder($objQueryBuilder);
		}

		// Get the SQL Statement
		$strQuery = $objQueryBuilder->GetStatement();

		// Prepare the Statement with the Query Parameters (if applicable)
		if ($mixParameterArray) {
			if (is_array($mixParameterArray)) {
				if (count($mixParameterArray))
					$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

				// Ensure that there are no other Unresolved Named Parameters
				if (strpos($strQuery, chr(QQNamedValue::DelimiterCode) . '{') !== false)
					throw new QCallerException('Unresolved named parameters in the query');
			} else
				throw new QCallerException('Parameter Array must be an array of name-value parameter pairs');
		}

		// Return the Objects
		return $strQuery;
	}

	/**
	 * Static Qcodo Query method to query for a single SampleRack object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return SampleRack the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleRack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new SampleRack object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return SampleRack::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of SampleRack objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return SampleRack[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleRack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return SampleRack::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of SampleRack objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleRack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and return the row_count
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);

		// Figure out if the query is using GroupBy
		$blnGrouped = false;

		if ($objOptionalClauses) foreach ($objOptionalClauses as $objClause) {
			if ($objClause instanceof QQGroupBy) {
				$blnGrouped = true;
				break;
			}
		}

		if ($blnGrouped)
			// Groups in this query - return the count of Groups (which is the count of all rows)
			return $objDbResult->CountRows();
		else {
			// No Groups - return the sql-calculated count(*) value
			$strDbRow = $objDbResult->FetchRow();
			return QType::Cast($strDbRow[0], QType::Integer);
		}
	}

	/*		public static function QueryArrayCached($strConditions, $mixParameterArray = null) {
	 // Get the Database Object for this Class
	$objDatabase = SampleRack::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'sample_rack_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with SampleRack-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	SampleRack::GetSelectFields($objQueryBuilder);
	SampleRack::GetFromFields($objQueryBuilder);

	// Ensure the Passed-in Conditions is a string
	try {
	$strConditions = QType::Cast($strConditions, QType::String);
	} catch (QCallerException $objExc) {
	$objExc->IncrementOffset();
	throw $objExc;
	}

	// Create the Conditions object, and apply it
	$objConditions = eval('return ' . $strConditions . ';');

	// Apply Any Conditions
	if ($objConditions)
		$objConditions->UpdateQueryBuilder($objQueryBuilder);

	// Get the SQL Statement
	$strQuery = $objQueryBuilder->GetStatement();

	// Save the SQL Statement in the Cache
	$objCache->SaveData($strQuery);
	}

	// Prepare the Statement with the Parameters
	if ($mixParameterArray)
		$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

	// Perform the Query and Instantiate the Array Result
	$objDbResult = $objDatabase->Query($strQuery);
	return SampleRack::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this SampleRack
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
		if ($strPrefix) {
			$strTableName = 'fm__`' . $strPrefix . '`';
			$strAliasPrefix = '`' . $strPrefix . '__';
		} else {
			$strTableName = 'fm__`sample_rack`';
			$strAliasPrefix = '`';
		}

		$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
		$objBuilder->AddSelectItem($strTableName . '.`name` AS ' . $strAliasPrefix . 'name`');
		$objBuilder->AddSelectItem($strTableName . '.`box_count` AS ' . $strAliasPrefix . 'box_count`');
		$objBuilder->AddSelectItem($strTableName . '.`rack_type_id` AS ' . $strAliasPrefix . 'rack_type_id`');
	}



	///////////////////////////////
	// INSTANTIATION-RELATED METHODS
	///////////////////////////////

	/**
	 * Instantiate a SampleRack from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this SampleRack::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return SampleRack
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;


		// Create a new instance of the SampleRack object
		$objToReturn = new SampleRack();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
		$objToReturn->intBoxCount = $objDbRow->GetColumn($strAliasPrefix . 'box_count', 'Integer');
		$objToReturn->intRackTypeId = $objDbRow->GetColumn($strAliasPrefix . 'rack_type_id', 'Integer');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'sample_rack__';

		// Check for RackType Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'rack_type_id__id')))
			$objToReturn->objRackType = Rack::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rack_type_id__', $strExpandAsArrayNodes);




		return $objToReturn;
	}

	/**
	 * Instantiate an array of SampleRacks from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return SampleRack[]
	 */
	public static function InstantiateDbResult(QDatabaseResultBase $objDbResult, $strExpandAsArrayNodes = null) {
		$objToReturn = array();

		// If blank resultset, then return empty array
		if (!$objDbResult)
			return $objToReturn;

		// Load up the return array with each row
		if ($strExpandAsArrayNodes) {
			$objLastRowItem = null;
			while ($objDbRow = $objDbResult->GetNextRow()) {
				$objItem = SampleRack::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, SampleRack::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single SampleRack object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return SampleRack
	 */
	public static function LoadById($intId) {
		return SampleRack::QuerySingle(
				QQ::Equal(QQN::SampleRack()->Id, $intId)
		);
	}

	/**
	 * Load an array of SampleRack objects,
	 * by RackTypeId Index(es)
	 * @param integer $intRackTypeId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return SampleRack[]
		*/
	public static function LoadArrayByRackTypeId($intRackTypeId, $objOptionalClauses = null) {
		// Call SampleRack::QueryArray to perform the LoadArrayByRackTypeId query
		try {
			return SampleRack::QueryArray(
					QQ::Equal(QQN::SampleRack()->RackTypeId, $intRackTypeId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count SampleRacks
	 * by RackTypeId Index(es)
	 * @param integer $intRackTypeId
	 * @return int
		*/
	public static function CountByRackTypeId($intRackTypeId) {
		// Call SampleRack::QueryCount to perform the CountByRackTypeId query
		return SampleRack::QueryCount(
				QQ::Equal(QQN::SampleRack()->RackTypeId, $intRackTypeId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this SampleRack
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = SampleRack::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO `'.QQNodeSampleRack::$strPubTableName.'` (
						`name`,
						`box_count`,
						`rack_type_id`
				) VALUES (
						' . $objDatabase->SqlVariable($this->strName) . ',
						' . $objDatabase->SqlVariable($this->intBoxCount) . ',
						' . $objDatabase->SqlVariable($this->intRackTypeId) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeSampleRack::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						`'.QQNodeSampleRack::$strPubTableName.'`
						SET
						`name` = ' . $objDatabase->SqlVariable($this->strName) . ',
						`box_count` = ' . $objDatabase->SqlVariable($this->intBoxCount) . ',
						`rack_type_id` = ' . $objDatabase->SqlVariable($this->intRackTypeId) . '
						WHERE
						`id` = ' . $objDatabase->SqlVariable($this->intId) . '
						');
			}

		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Update __blnRestored and any Non-Identity PK Columns (if applicable)
		$this->__blnRestored = true;


		// Return
		return $mixToReturn;
	}

	/**
	 * Delete this SampleRack
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this SampleRack with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = SampleRack::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				`'.QQNodeSampleRack::$strPubTableName.'`
				WHERE
				`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all SampleRacks
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = SampleRack::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				`'.QQNodeSampleRack::$strPubTableName.'`');
	}

	/**
	 * Truncate sample_rack table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = SampleRack::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE `'.QQNodeSampleRack::$strPubTableName.'`');
	}



	////////////////////
	// PUBLIC OVERRIDERS
	////////////////////

	/**
	 * Override method to perform a property "Get"
	 * This will get the value of $strName
	 *
	 * @param string $strName Name of the property to get
	 * @return mixed
	 */
	public function __get($strName) {
		switch ($strName) {
			///////////////////
			// Member Variables
			///////////////////
			case 'Id':
				/**
				 * Gets the value for intId (Read-Only PK)
				 * @return integer
				 */
				return $this->intId;

			case 'Name':
				/**
				 * Gets the value for strName (Not Null)
				 * @return string
				 */
				return $this->strName;

			case 'BoxCount':
				/**
				 * Gets the value for intBoxCount
				 * @return integer
				 */
				return $this->intBoxCount;

			case 'RackTypeId':
				/**
				 * Gets the value for intRackTypeId
				 * @return integer
				 */
				return $this->intRackTypeId;


				///////////////////
				// Member Objects
				///////////////////
			case 'RackType':
				/**
				 * Gets the value for the Rack object referenced by intRackTypeId
				 * @return Rack
				 */
				try {
					if ((!$this->objRackType) && (!is_null($this->intRackTypeId)))
						$this->objRackType = Rack::Load($this->intRackTypeId);
					return $this->objRackType;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			default:
				try {
					return parent::__get($strName);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}

	/**
	 * Override method to perform a property "Set"
	 * This will set the property $strName to be $mixValue
	 *
	 * @param string $strName Name of the property to set
	 * @param string $mixValue New value of the property
	 * @return mixed
	 */
	public function __set($strName, $mixValue) {
		switch ($strName) {
			///////////////////
			// Member Variables
			///////////////////
			case 'Name':
				/**
				 * Sets the value for strName (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strName = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'BoxCount':
				/**
				 * Sets the value for intBoxCount
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intBoxCount = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'RackTypeId':
				/**
				 * Sets the value for intRackTypeId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objRackType = null;
					return ($this->intRackTypeId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				///////////////////
				// Member Objects
				///////////////////
			case 'RackType':
				/**
				 * Sets the value for the Rack object referenced by intRackTypeId
				 * @param Rack $mixValue
				 * @return Rack
				 */
				if (is_null($mixValue)) {
					$this->intRackTypeId = null;
					$this->objRackType = null;
					return null;
				} else {
					// Make sure $mixValue actually is a Rack object
					try {
						$mixValue = QType::Cast($mixValue, 'Rack');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED Rack object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved RackType for this SampleRack');

					// Update Local Member Variables
					$this->objRackType = $mixValue;
					$this->intRackTypeId = $mixValue->Id;

					// Return $mixValue
					return $mixValue;
				}
				break;

			default:
				try {
					return parent::__set($strName, $mixValue);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}
		}
	}

	/**
	 * Lookup a VirtualAttribute value (if applicable).  Returns NULL if none found.
	 * @param string $strName
	 * @return string
	 */
	public function GetVirtualAttribute($strName) {
		if (array_key_exists($strName, $this->__strVirtualAttributeArray))
			return $this->__strVirtualAttributeArray[$strName];
		return null;
	}



	///////////////////////////////
	// ASSOCIATED OBJECTS
	///////////////////////////////




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column sample_rack.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_rack.name
	 * @var string strName
	 */
	protected $strName;
	const NameMaxLength = 45;
	const NameDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_rack.box_count
	 * @var integer intBoxCount
	 */
	protected $intBoxCount;
	const BoxCountDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_rack.rack_type_id
	 * @var integer intRackTypeId
	 */
	protected $intRackTypeId;
	const RackTypeIdDefault = null;


	/**
	 * Protected array of virtual attributes for this object (e.g. extra/other calculated and/or non-object bound
	 * columns from the run-time database query result for this object).  Used by InstantiateDbRow and
	 * GetVirtualAttribute.
	 * @var string[] $__strVirtualAttributeArray
	 */
	protected $__strVirtualAttributeArray = array();

	/**
	 * Protected internal member variable that specifies whether or not this object is Restored from the database.
	 * Used by Save() to determine if Save() should perform a db UPDATE or INSERT.
	 * @var bool __blnRestored;
	*/
	protected $__blnRestored;



	///////////////////////////////
	// PROTECTED MEMBER OBJECTS
	///////////////////////////////

	/**
	 * Protected member variable that contains the object pointed by the reference
	 * in the database column sample_rack.rack_type_id.
	 *
	 * NOTE: Always use the RackType property getter to correctly retrieve this Rack object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var Rack objRackType
	 */
	protected $objRackType;






	////////////////////////////////////////
	// METHODS for WEB SERVICES
	////////////////////////////////////////

	public static function GetSoapComplexTypeXml() {
		$strToReturn = '<complexType name="SampleRack"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Name" type="xsd:string"/>';
		$strToReturn .= '<element name="BoxCount" type="xsd:int"/>';
		$strToReturn .= '<element name="RackType" type="xsd1:Rack"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('SampleRack', $strComplexTypeArray)) {
			$strComplexTypeArray['SampleRack'] = SampleRack::GetSoapComplexTypeXml();
			Rack::AlterSoapComplexTypeArray($strComplexTypeArray);
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, SampleRack::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new SampleRack();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Name'))
			$objToReturn->strName = $objSoapObject->Name;
		if (property_exists($objSoapObject, 'BoxCount'))
			$objToReturn->intBoxCount = $objSoapObject->BoxCount;
		if ((property_exists($objSoapObject, 'RackType')) &&
				($objSoapObject->RackType))
			$objToReturn->RackType = Rack::GetObjectFromSoapObject($objSoapObject->RackType);
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, SampleRack::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->objRackType)
			$objObject->objRackType = Rack::GetSoapObjectFromObject($objObject->objRackType, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intRackTypeId = null;
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeSampleRack extends QQNode {
	protected $strTableName = 'fm__sample_rack'; public static $strPubTableName = 'fm__sample_rack';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'SampleRack';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'BoxCount':
				return new QQNode('box_count', 'integer', $this);
			case 'RackTypeId':
				return new QQNode('rack_type_id', 'integer', $this);
			case 'RackType':
				return new QQNodeRack('rack_type_id', 'integer', $this);

			case '_PrimaryKeyNode':
				return new QQNode('id', 'integer', $this);
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

class QQReverseReferenceNodeSampleRack extends QQReverseReferenceNode {
	protected $strTableName = 'fm__sample_rack'; public static $strPubTableName = 'fm__sample_rack';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'SampleRack';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'BoxCount':
				return new QQNode('box_count', 'integer', $this);
			case 'RackTypeId':
				return new QQNode('rack_type_id', 'integer', $this);
			case 'RackType':
				return new QQNodeRack('rack_type_id', 'integer', $this);

			case '_PrimaryKeyNode':
				return new QQNode('id', 'integer', $this);
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
?>