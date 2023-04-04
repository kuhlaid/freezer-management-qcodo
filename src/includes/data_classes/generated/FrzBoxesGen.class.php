<?php
/**
 * The abstract FrzBoxesGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the FrzBoxes subclass which
 * extends this FrzBoxesGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the FrzBoxes class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class FrzBoxesGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a FrzBoxes from PK Info
	 * @param integer $intId
	 * @return FrzBoxes
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return FrzBoxes::QuerySingle(
				QQ::Equal(QQN::FrzBoxes()->Id, $intId)
		);
	}

	/**
	 * Load all FrzBoxeses
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return FrzBoxes[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call FrzBoxes::QueryArray to perform the LoadAll query
		try {
			return FrzBoxes::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all FrzBoxeses
	 * @return int
	 */
	public static function CountAll() {
		// Call FrzBoxes::QueryCount to perform the CountAll query
		return FrzBoxes::QueryCount(QQ::All());
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
		$objDatabase = FrzBoxes::GetDatabase();

		// Create/Build out the QueryBuilder object with FrzBoxes-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__frz_boxes');
		FrzBoxes::GetSelectFields($objQueryBuilder);
		$objQueryBuilder->AddFromItem('fm__`frz_boxes` AS fm__`frz_boxes`');

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
	 * Static Qcodo Query method to query for a single FrzBoxes object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return FrzBoxes the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
		// Get the Query Statement
		try {
			$strQuery = FrzBoxes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new FrzBoxes object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return FrzBoxes::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of FrzBoxes objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return FrzBoxes[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
		// Get the Query Statement
		try {
			$strQuery = FrzBoxes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return FrzBoxes::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of FrzBoxes objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
		// Get the Query Statement
		try {
			$strQuery = FrzBoxes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
	$objDatabase = FrzBoxes::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'frz_boxes_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with FrzBoxes-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	FrzBoxes::GetSelectFields($objQueryBuilder);
	FrzBoxes::GetFromFields($objQueryBuilder);

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
	return FrzBoxes::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this FrzBoxes
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
		if ($strPrefix) {
			$strTableName = 'fm__`' . $strPrefix . '`';
			$strAliasPrefix = '`' . $strPrefix . '__';
		} else {
			$strTableName = 'fm__`frz_boxes`';
			$strAliasPrefix = '`';
		}

		$objBuilder->AddSelectItem($strTableName . '.`boxid` AS ' . $strAliasPrefix . 'boxid`');
		$objBuilder->AddSelectItem($strTableName . '.`rack` AS ' . $strAliasPrefix . 'rack`');
		$objBuilder->AddSelectItem($strTableName . '.`shelf` AS ' . $strAliasPrefix . 'shelf`');
		$objBuilder->AddSelectItem($strTableName . '.`freezer` AS ' . $strAliasPrefix . 'freezer`');
		$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
		$objBuilder->AddSelectItem($strTableName . '.`issues` AS ' . $strAliasPrefix . 'issues`');
		$objBuilder->AddSelectItem($strTableName . '.`description` AS ' . $strAliasPrefix . 'description`');
		$objBuilder->AddSelectItem($strTableName . '.`box_type_id` AS ' . $strAliasPrefix . 'box_type_id`');
	}



	///////////////////////////////
	// INSTANTIATION-RELATED METHODS
	///////////////////////////////

	/**
	 * Instantiate a FrzBoxes from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this FrzBoxes::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return FrzBoxes
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;


		// Create a new instance of the FrzBoxes object
		$objToReturn = new FrzBoxes();
		$objToReturn->__blnRestored = true;

		$objToReturn->strBoxid = $objDbRow->GetColumn($strAliasPrefix . 'boxid', 'VarChar');
		$objToReturn->strRack = $objDbRow->GetColumn($strAliasPrefix . 'rack', 'VarChar');
		$objToReturn->intShelf = $objDbRow->GetColumn($strAliasPrefix . 'shelf', 'Integer');
		$objToReturn->intFreezer = $objDbRow->GetColumn($strAliasPrefix . 'freezer', 'Integer');
		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strIssues = $objDbRow->GetColumn($strAliasPrefix . 'issues', 'VarChar');
		$objToReturn->strDescription = $objDbRow->GetColumn($strAliasPrefix . 'description', 'VarChar');
		$objToReturn->intBoxTypeId = $objDbRow->GetColumn($strAliasPrefix . 'box_type_id', 'Integer');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'frz_boxes__';




		return $objToReturn;
	}

	/**
	 * Instantiate an array of FrzBoxeses from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return FrzBoxes[]
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
				$objItem = FrzBoxes::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, FrzBoxes::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single FrzBoxes object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return FrzBoxes
	 */
	public static function LoadById($intId) {
		return FrzBoxes::QuerySingle(
				QQ::Equal(QQN::FrzBoxes()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this FrzBoxes
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = FrzBoxes::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO `'.QQNodeFrzBoxes::$strPubTableName.'` (
						`boxid`,
						`rack`,
						`shelf`,
						`freezer`,
						`issues`,
						`description`,
						`box_type_id`
				) VALUES (
						' . $objDatabase->SqlVariable($this->strBoxid) . ',
						' . $objDatabase->SqlVariable($this->strRack) . ',
						' . $objDatabase->SqlVariable($this->intShelf) . ',
						' . $objDatabase->SqlVariable($this->intFreezer) . ',
						' . $objDatabase->SqlVariable($this->strIssues) . ',
						' . $objDatabase->SqlVariable($this->strDescription) . ',
						' . $objDatabase->SqlVariable($this->intBoxTypeId) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeFrzBoxes::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						`'.QQNodeFrzBoxes::$strPubTableName.'`
						SET
						`boxid` = ' . $objDatabase->SqlVariable($this->strBoxid) . ',
						`rack` = ' . $objDatabase->SqlVariable($this->strRack) . ',
						`shelf` = ' . $objDatabase->SqlVariable($this->intShelf) . ',
						`freezer` = ' . $objDatabase->SqlVariable($this->intFreezer) . ',
						`issues` = ' . $objDatabase->SqlVariable($this->strIssues) . ',
						`description` = ' . $objDatabase->SqlVariable($this->strDescription) . ',
						`box_type_id` = ' . $objDatabase->SqlVariable($this->intBoxTypeId) . '
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
	 * Delete this FrzBoxes
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this FrzBoxes with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = FrzBoxes::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				`'.QQNodeFrzBoxes::$strPubTableName.'`
				WHERE
				`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all FrzBoxeses
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = FrzBoxes::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				`'.QQNodeFrzBoxes::$strPubTableName.'`');
	}

	/**
	 * Truncate frz_boxes table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = FrzBoxes::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE `'.QQNodeFrzBoxes::$strPubTableName.'`');
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
			case 'Boxid':
				/**
				 * Gets the value for strBoxid (Not Null)
				 * @return string
				 */
				return $this->strBoxid;

			case 'Rack':
				/**
				 * Gets the value for strRack
				 * @return string
				 */
				return $this->strRack;

			case 'Shelf':
				/**
				 * Gets the value for intShelf
				 * @return integer
				 */
				return $this->intShelf;

			case 'Freezer':
				/**
				 * Gets the value for intFreezer
				 * @return integer
				 */
				return $this->intFreezer;

			case 'Id':
				/**
				 * Gets the value for intId (Read-Only PK)
				 * @return integer
				 */
				return $this->intId;

			case 'Issues':
				/**
				 * Gets the value for strIssues
				 * @return string
				 */
				return $this->strIssues;

			case 'Description':
				/**
				 * Gets the value for strDescription
				 * @return string
				 */
				return $this->strDescription;

			case 'BoxTypeId':
				/**
				 * Gets the value for intBoxTypeId
				 * @return integer
				 */
				return $this->intBoxTypeId;


				///////////////////
				// Member Objects
				///////////////////

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
			case 'Boxid':
				/**
				 * Sets the value for strBoxid (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strBoxid = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Rack':
				/**
				 * Sets the value for strRack
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strRack = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Shelf':
				/**
				 * Sets the value for intShelf
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intShelf = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Freezer':
				/**
				 * Sets the value for intFreezer
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intFreezer = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Issues':
				/**
				 * Sets the value for strIssues
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strIssues = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Description':
				/**
				 * Sets the value for strDescription
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strDescription = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'BoxTypeId':
				/**
				 * Sets the value for intBoxTypeId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intBoxTypeId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				///////////////////
				// Member Objects
				///////////////////
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
	 * Protected member variable that maps to the database column frz_boxes.boxid
	 * @var string strBoxid
	 */
	protected $strBoxid;
	const BoxidMaxLength = 10;
	const BoxidDefault = null;


	/**
	 * Protected member variable that maps to the database column frz_boxes.rack
	 * @var string strRack
	 */
	protected $strRack;
	const RackMaxLength = 10;
	const RackDefault = null;


	/**
	 * Protected member variable that maps to the database column frz_boxes.shelf
	 * @var integer intShelf
	 */
	protected $intShelf;
	const ShelfDefault = null;


	/**
	 * Protected member variable that maps to the database column frz_boxes.freezer
	 * @var integer intFreezer
	 */
	protected $intFreezer;
	const FreezerDefault = null;


	/**
	 * Protected member variable that maps to the database PK Identity column frz_boxes.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column frz_boxes.issues
	 * @var string strIssues
	 */
	protected $strIssues;
	const IssuesMaxLength = 1000;
	const IssuesDefault = null;


	/**
	 * Protected member variable that maps to the database column frz_boxes.description
	 * @var string strDescription
	 */
	protected $strDescription;
	const DescriptionMaxLength = 2000;
	const DescriptionDefault = null;


	/**
	 * Protected member variable that maps to the database column frz_boxes.box_type_id
	 * @var integer intBoxTypeId
	 */
	protected $intBoxTypeId;
	const BoxTypeIdDefault = null;


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






	////////////////////////////////////////
	// METHODS for WEB SERVICES
	////////////////////////////////////////

	public static function GetSoapComplexTypeXml() {
		$strToReturn = '<complexType name="FrzBoxes"><sequence>';
		$strToReturn .= '<element name="Boxid" type="xsd:string"/>';
		$strToReturn .= '<element name="Rack" type="xsd:string"/>';
		$strToReturn .= '<element name="Shelf" type="xsd:int"/>';
		$strToReturn .= '<element name="Freezer" type="xsd:int"/>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Issues" type="xsd:string"/>';
		$strToReturn .= '<element name="Description" type="xsd:string"/>';
		$strToReturn .= '<element name="BoxTypeId" type="xsd:int"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('FrzBoxes', $strComplexTypeArray)) {
			$strComplexTypeArray['FrzBoxes'] = FrzBoxes::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, FrzBoxes::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new FrzBoxes();
		if (property_exists($objSoapObject, 'Boxid'))
			$objToReturn->strBoxid = $objSoapObject->Boxid;
		if (property_exists($objSoapObject, 'Rack'))
			$objToReturn->strRack = $objSoapObject->Rack;
		if (property_exists($objSoapObject, 'Shelf'))
			$objToReturn->intShelf = $objSoapObject->Shelf;
		if (property_exists($objSoapObject, 'Freezer'))
			$objToReturn->intFreezer = $objSoapObject->Freezer;
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Issues'))
			$objToReturn->strIssues = $objSoapObject->Issues;
		if (property_exists($objSoapObject, 'Description'))
			$objToReturn->strDescription = $objSoapObject->Description;
		if (property_exists($objSoapObject, 'BoxTypeId'))
			$objToReturn->intBoxTypeId = $objSoapObject->BoxTypeId;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, FrzBoxes::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeFrzBoxes extends QQNode {
	protected $strTableName = 'fm__frz_boxes'; public static $strPubTableName = 'fm__frz_boxes';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'FrzBoxes';
	public function __get($strName) {
		switch ($strName) {
			case 'Boxid':
				return new QQNode('boxid', 'string', $this);
			case 'Rack':
				return new QQNode('rack', 'string', $this);
			case 'Shelf':
				return new QQNode('shelf', 'integer', $this);
			case 'Freezer':
				return new QQNode('freezer', 'integer', $this);
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Issues':
				return new QQNode('issues', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'BoxTypeId':
				return new QQNode('box_type_id', 'integer', $this);

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

class QQReverseReferenceNodeFrzBoxes extends QQReverseReferenceNode {
	protected $strTableName = 'fm__frz_boxes'; public static $strPubTableName = 'fm__frz_boxes';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'FrzBoxes';
	public function __get($strName) {
		switch ($strName) {
			case 'Boxid':
				return new QQNode('boxid', 'string', $this);
			case 'Rack':
				return new QQNode('rack', 'string', $this);
			case 'Shelf':
				return new QQNode('shelf', 'integer', $this);
			case 'Freezer':
				return new QQNode('freezer', 'integer', $this);
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Issues':
				return new QQNode('issues', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'BoxTypeId':
				return new QQNode('box_type_id', 'integer', $this);

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