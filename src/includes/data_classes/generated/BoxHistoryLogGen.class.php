<?php
/**
 * The abstract BoxHistoryLogGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the BoxHistoryLog subclass which
 * extends this BoxHistoryLogGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the BoxHistoryLog class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class BoxHistoryLogGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a BoxHistoryLog from PK Info
	 * @param integer $intId
	 * @return BoxHistoryLog
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return BoxHistoryLog::QuerySingle(
				QQ::Equal(QQN::BoxHistoryLog()->Id, $intId)
		);
	}

	/**
	 * Load all BoxHistoryLogs
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return BoxHistoryLog[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call BoxHistoryLog::QueryArray to perform the LoadAll query
		try {
			return BoxHistoryLog::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all BoxHistoryLogs
	 * @return int
	 */
	public static function CountAll() {
		// Call BoxHistoryLog::QueryCount to perform the CountAll query
		return BoxHistoryLog::QueryCount(QQ::All());
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
	protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly,$selectionArray = null) {
		// Get the Database Object for this Class
		$objDatabase = BoxHistoryLog::GetDatabase();

		// Create/Build out the QueryBuilder object with BoxHistoryLog-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__box_history_log');
		BoxHistoryLog::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__box_history_log AS fm__box_history_log');

		// Set "CountOnly" option (if applicable)
		if ($blnCountOnly)
			$objQueryBuilder->SetCountOnlyFlag();
		// wpg - added to specify that we want a select field to count
		if ($selectionArray)
			$objQueryBuilder->SetCountSingle($selectionArray[0]);

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
	 * Static Qcodo Query method to query for a single BoxHistoryLog object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return BoxHistoryLog the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = BoxHistoryLog::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new BoxHistoryLog object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return BoxHistoryLog::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of BoxHistoryLog objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return BoxHistoryLog[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = BoxHistoryLog::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return BoxHistoryLog::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of BoxHistoryLog objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = BoxHistoryLog::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = BoxHistoryLog::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'box_history_log_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with BoxHistoryLog-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	BoxHistoryLog::GetSelectFields($objQueryBuilder);
	BoxHistoryLog::GetFromFields($objQueryBuilder);

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
	return BoxHistoryLog::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this BoxHistoryLog
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__box_history_log';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.box_id AS ' . $strAliasPrefix . 'box_id');
			$objBuilder->AddSelectItem($strTableName . '.release_date AS ' . $strAliasPrefix . 'release_date');
			$objBuilder->AddSelectItem($strTableName . '.freezer_pull_id AS ' . $strAliasPrefix . 'freezer_pull_id');
			$objBuilder->AddSelectItem($strTableName . '.received_date AS ' . $strAliasPrefix . 'received_date');
		}
		else {
			foreach($selectionArray AS $field){
				$objBuilder->AddSelectItem($strTableName . '.'.$field.' AS ' . $strAliasPrefix . $field.'');
			}
		}
	}



	///////////////////////////////
	// INSTANTIATION-RELATED METHODS
	///////////////////////////////

	/**
	 * Instantiate a BoxHistoryLog from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this BoxHistoryLog::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return BoxHistoryLog
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;


		// Create a new instance of the BoxHistoryLog object
		$objToReturn = new BoxHistoryLog();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->intBoxId = $objDbRow->GetColumn($strAliasPrefix . 'box_id', 'Integer');
		$objToReturn->dttReleaseDate = $objDbRow->GetColumn($strAliasPrefix . 'release_date', 'Date');
		$objToReturn->intFreezerPullId = $objDbRow->GetColumn($strAliasPrefix . 'freezer_pull_id', 'Integer');
		$objToReturn->dttReceivedDate = $objDbRow->GetColumn($strAliasPrefix . 'received_date', 'Date');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'box_history_log__';

		// Check for Box Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'box_id__id')))
			$objToReturn->objBox = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box_id__', $strExpandAsArrayNodes);




		return $objToReturn;
	}

	/**
	 * Instantiate an array of BoxHistoryLogs from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return BoxHistoryLog[]
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
				$objItem = BoxHistoryLog::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, BoxHistoryLog::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single BoxHistoryLog object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return BoxHistoryLog
	 */
	public static function LoadById($intId) {
		return BoxHistoryLog::QuerySingle(
				QQ::Equal(QQN::BoxHistoryLog()->Id, $intId)
		);
	}

	/**
	 * Load an array of BoxHistoryLog objects,
	 * by BoxId Index(es)
	 * @param integer $intBoxId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return BoxHistoryLog[]
		*/
	public static function LoadArrayByBoxId($intBoxId, $objOptionalClauses = null) {
		// Call BoxHistoryLog::QueryArray to perform the LoadArrayByBoxId query
		try {
			return BoxHistoryLog::QueryArray(
					QQ::Equal(QQN::BoxHistoryLog()->BoxId, $intBoxId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count BoxHistoryLogs
	 * by BoxId Index(es)
	 * @param integer $intBoxId
	 * @return int
		*/
	public static function CountByBoxId($intBoxId) {
		// Call BoxHistoryLog::QueryCount to perform the CountByBoxId query
		return BoxHistoryLog::QueryCount(
				QQ::Equal(QQN::BoxHistoryLog()->BoxId, $intBoxId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this BoxHistoryLog
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = BoxHistoryLog::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeBoxHistoryLog::$strPubTableName.' (
						box_id,
						release_date,
						freezer_pull_id,
						received_date
				) VALUES (
						' . $objDatabase->SqlVariable($this->intBoxId) . ',
						' . $objDatabase->SqlVariable($this->dttReleaseDate) . ',
						' . $objDatabase->SqlVariable($this->intFreezerPullId) . ',
						' . $objDatabase->SqlVariable($this->dttReceivedDate) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeBoxHistoryLog::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeBoxHistoryLog::$strPubTableName.'
						SET
						box_id = ' . $objDatabase->SqlVariable($this->intBoxId) . ',
						release_date = ' . $objDatabase->SqlVariable($this->dttReleaseDate) . ',
						freezer_pull_id = ' . $objDatabase->SqlVariable($this->intFreezerPullId) . ',
						received_date = ' . $objDatabase->SqlVariable($this->dttReceivedDate) . '
						WHERE
						id = ' . $objDatabase->SqlVariable($this->intId) . '
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
	 * Delete this BoxHistoryLog
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this BoxHistoryLog with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = BoxHistoryLog::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeBoxHistoryLog::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all BoxHistoryLogs
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = BoxHistoryLog::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeBoxHistoryLog::$strPubTableName.'');
	}

	/**
	 * Truncate box_history_log table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = BoxHistoryLog::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeBoxHistoryLog::$strPubTableName.'');
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

			case 'BoxId':
				/**
				 * Gets the value for intBoxId (Not Null)
				 * @return integer
				 */
				return $this->intBoxId;

			case 'ReleaseDate':
				/**
				 * Gets the value for dttReleaseDate
				 * @return QDateTime
				 */
				return $this->dttReleaseDate;

			case 'FreezerPullId':
				/**
				 * Gets the value for intFreezerPullId
				 * @return integer
				 */
				return $this->intFreezerPullId;

			case 'ReceivedDate':
				/**
				 * Gets the value for dttReceivedDate
				 * @return QDateTime
				 */
				return $this->dttReceivedDate;


				///////////////////
				// Member Objects
				///////////////////
			case 'Box':
				/**
				 * Gets the value for the Box object referenced by intBoxId (Not Null)
				 * @return Box
				 */
				try {
					if ((!$this->objBox) && (!is_null($this->intBoxId)))
						$this->objBox = Box::Load($this->intBoxId);
					return $this->objBox;
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
			case 'BoxId':
				/**
				 * Sets the value for intBoxId (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objBox = null;
					return ($this->intBoxId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'ReleaseDate':
				/**
				 * Sets the value for dttReleaseDate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttReleaseDate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'FreezerPullId':
				/**
				 * Sets the value for intFreezerPullId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intFreezerPullId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'ReceivedDate':
				/**
				 * Sets the value for dttReceivedDate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttReceivedDate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				///////////////////
				// Member Objects
				///////////////////
			case 'Box':
				/**
				 * Sets the value for the Box object referenced by intBoxId (Not Null)
				 * @param Box $mixValue
				 * @return Box
				 */
				if (is_null($mixValue)) {
					$this->intBoxId = null;
					$this->objBox = null;
					return null;
				} else {
					// Make sure $mixValue actually is a Box object
					try {
						$mixValue = QType::Cast($mixValue, 'Box');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED Box object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved Box for this BoxHistoryLog');

					// Update Local Member Variables
					$this->objBox = $mixValue;
					$this->intBoxId = $mixValue->Id;

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
	 * Protected member variable that maps to the database PK Identity column box_history_log.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column box_history_log.box_id
	 * @var integer intBoxId
	 */
	protected $intBoxId;
	const BoxIdDefault = null;


	/**
	 * Protected member variable that maps to the database column box_history_log.release_date
	 * @var QDateTime dttReleaseDate
	 */
	protected $dttReleaseDate;
	const ReleaseDateDefault = null;


	/**
	 * Protected member variable that maps to the database column box_history_log.freezer_pull_id
	 * @var integer intFreezerPullId
	 */
	protected $intFreezerPullId;
	const FreezerPullIdDefault = null;


	/**
	 * Protected member variable that maps to the database column box_history_log.received_date
	 * @var QDateTime dttReceivedDate
	 */
	protected $dttReceivedDate;
	const ReceivedDateDefault = null;


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
	 * in the database column box_history_log.box_id.
	 *
	 * NOTE: Always use the Box property getter to correctly retrieve this Box object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var Box objBox
	 */
	protected $objBox;






	////////////////////////////////////////
	// METHODS for WEB SERVICES
	////////////////////////////////////////

	public static function GetSoapComplexTypeXml() {
		$strToReturn = '<complexType name="BoxHistoryLog"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Box" type="xsd1:Box"/>';
		$strToReturn .= '<element name="ReleaseDate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="FreezerPullId" type="xsd:int"/>';
		$strToReturn .= '<element name="ReceivedDate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('BoxHistoryLog', $strComplexTypeArray)) {
			$strComplexTypeArray['BoxHistoryLog'] = BoxHistoryLog::GetSoapComplexTypeXml();
			Box::AlterSoapComplexTypeArray($strComplexTypeArray);
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, BoxHistoryLog::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new BoxHistoryLog();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if ((property_exists($objSoapObject, 'Box')) &&
				($objSoapObject->Box))
			$objToReturn->Box = Box::GetObjectFromSoapObject($objSoapObject->Box);
		if (property_exists($objSoapObject, 'ReleaseDate'))
			$objToReturn->dttReleaseDate = new QDateTime($objSoapObject->ReleaseDate);
		if (property_exists($objSoapObject, 'FreezerPullId'))
			$objToReturn->intFreezerPullId = $objSoapObject->FreezerPullId;
		if (property_exists($objSoapObject, 'ReceivedDate'))
			$objToReturn->dttReceivedDate = new QDateTime($objSoapObject->ReceivedDate);
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, BoxHistoryLog::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn ?? '') ?? '');
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->objBox)
			$objObject->objBox = Box::GetSoapObjectFromObject($objObject->objBox, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intBoxId = null;
		if ($objObject->dttReleaseDate)
			$objObject->dttReleaseDate = $objObject->dttReleaseDate->toString(QDateTime::FormatSoap);
		if ($objObject->dttReceivedDate)
			$objObject->dttReceivedDate = $objObject->dttReceivedDate->toString(QDateTime::FormatSoap);
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeBoxHistoryLog extends QQNode {
	protected $strTableName = 'fm__box_history_log'; public static $strPubTableName = 'fm__box_history_log';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'BoxHistoryLog';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'BoxId':
				return new QQNode('box_id', 'integer', $this);
			case 'Box':
				return new QQNodeBox('box_id', 'integer', $this);
			case 'ReleaseDate':
				return new QQNode('release_date', 'QDateTime', $this);
			case 'FreezerPullId':
				return new QQNode('freezer_pull_id', 'integer', $this);
			case 'ReceivedDate':
				return new QQNode('received_date', 'QDateTime', $this);

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

class QQReverseReferenceNodeBoxHistoryLog extends QQReverseReferenceNode {
	protected $strTableName = 'fm__box_history_log'; public static $strPubTableName = 'fm__box_history_log';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'BoxHistoryLog';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'BoxId':
				return new QQNode('box_id', 'integer', $this);
			case 'Box':
				return new QQNodeBox('box_id', 'integer', $this);
			case 'ReleaseDate':
				return new QQNode('release_date', 'QDateTime', $this);
			case 'FreezerPullId':
				return new QQNode('freezer_pull_id', 'integer', $this);
			case 'ReceivedDate':
				return new QQNode('received_date', 'QDateTime', $this);

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