<?php
/**
 * The abstract FreezerMaintenanceGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the FreezerMaintenance subclass which
 * extends this FreezerMaintenanceGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the FreezerMaintenance class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class FreezerMaintenanceGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a FreezerMaintenance from PK Info
	 * @param integer $intId
	 * @return FreezerMaintenance
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return FreezerMaintenance::QuerySingle(
				QQ::Equal(QQN::FreezerMaintenance()->Id, $intId)
		);
	}

	/**
	 * Load all FreezerMaintenances
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return FreezerMaintenance[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call FreezerMaintenance::QueryArray to perform the LoadAll query
		try {
			return FreezerMaintenance::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all FreezerMaintenances
	 * @return int
	 */
	public static function CountAll() {
		// Call FreezerMaintenance::QueryCount to perform the CountAll query
		return FreezerMaintenance::QueryCount(QQ::All());
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
		$objDatabase = FreezerMaintenance::GetDatabase();

		// Create/Build out the QueryBuilder object with FreezerMaintenance-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__freezer_maintenance');
		FreezerMaintenance::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__freezer_maintenance AS fm__freezer_maintenance');

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
	 * Static Qcodo Query method to query for a single FreezerMaintenance object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return FreezerMaintenance the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = FreezerMaintenance::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new FreezerMaintenance object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return FreezerMaintenance::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of FreezerMaintenance objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return FreezerMaintenance[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = FreezerMaintenance::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return FreezerMaintenance::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of FreezerMaintenance objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = FreezerMaintenance::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = FreezerMaintenance::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'freezer_maintenance_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with FreezerMaintenance-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	FreezerMaintenance::GetSelectFields($objQueryBuilder);
	FreezerMaintenance::GetFromFields($objQueryBuilder);

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
	return FreezerMaintenance::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this FreezerMaintenance
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__freezer_maintenance';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.log_date AS ' . $strAliasPrefix . 'log_date');
			$objBuilder->AddSelectItem($strTableName . '.main_log AS ' . $strAliasPrefix . 'main_log');
				$objBuilder->AddSelectItem($strTableName . '.alert_user AS ' . $strAliasPrefix . 'alert_user');
		
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
	 * Instantiate a FreezerMaintenance from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this FreezerMaintenance::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return FreezerMaintenance
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;

		// See if we're doing an array expansion on the previous item
		if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intId == $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer'))) {

			// We are.  Now, prepare to check for ExpandAsArray clauses
			$blnExpandedViaArray = false;
			if (!$strAliasPrefix)
				$strAliasPrefix = 'freezer_maintenance__';

			if ((array_key_exists($strAliasPrefix . 'freezerasfrzmain__freezer_id__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'freezerasfrzmain__freezer_id__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objFreezerAsFrzMainArray)) {
					$objPreviousChildItem = $objPreviousItem->_objFreezerAsFrzMainArray[$intPreviousChildItemCount - 1];
					$objChildItem = Freezer::InstantiateDbRow($objDbRow, $strAliasPrefix . 'freezerasfrzmain__freezer_id__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objFreezerAsFrzMainArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objFreezerAsFrzMainArray, Freezer::InstantiateDbRow($objDbRow, $strAliasPrefix . 'freezerasfrzmain__freezer_id__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}


			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'freezer_maintenance__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the FreezerMaintenance object
		$objToReturn = new FreezerMaintenance();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->dttLogDate = $objDbRow->GetColumn($strAliasPrefix . 'log_date', 'Date');
		$objToReturn->strMainLog = $objDbRow->GetColumn($strAliasPrefix . 'main_log', 'Blob');
		$objToReturn->blnAlertUser = $objDbRow->GetColumn($strAliasPrefix . 'alert_user', 'Bit');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'freezer_maintenance__';



		// Check for FreezerAsFrzMain Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'freezerasfrzmain__freezer_id__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'freezerasfrzmain__freezer_id__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objFreezerAsFrzMainArray, Freezer::InstantiateDbRow($objDbRow, $strAliasPrefix . 'freezerasfrzmain__freezer_id__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objFreezerAsFrzMain = Freezer::InstantiateDbRow($objDbRow, $strAliasPrefix . 'freezerasfrzmain__freezer_id__', $strExpandAsArrayNodes);
		}


		return $objToReturn;
	}

	/**
	 * Instantiate an array of FreezerMaintenances from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return FreezerMaintenance[]
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
				$objItem = FreezerMaintenance::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, FreezerMaintenance::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single FreezerMaintenance object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return FreezerMaintenance
	 */
	public static function LoadById($intId) {
		return FreezerMaintenance::QuerySingle(
				QQ::Equal(QQN::FreezerMaintenance()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////
	/**
	* Load an array of Freezer objects for a given FreezerAsFrzMain
	* via the frz_main_assn table
	* @param integer $intFreezerId
	* @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	* @return FreezerMaintenance[]
	*/
	public static function LoadArrayByFreezerAsFrzMain($intFreezerId, $objOptionalClauses = null) {
		// Call FreezerMaintenance::QueryArray to perform the LoadArrayByFreezerAsFrzMain query
		try {
			return FreezerMaintenance::QueryArray(
					QQ::Equal(QQN::FreezerMaintenance()->FreezerAsFrzMain->FreezerId, $intFreezerId),
					$objOptionalClauses
			);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count FreezerMaintenances for a given FreezerAsFrzMain
	 * via the frz_main_assn table
	 * @param integer $intFreezerId
	 * @return int
		*/
	public static function CountByFreezerAsFrzMain($intFreezerId) {
		return FreezerMaintenance::QueryCount(
				QQ::Equal(QQN::FreezerMaintenance()->FreezerAsFrzMain->FreezerId, $intFreezerId)
		);
	}



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this FreezerMaintenance
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = FreezerMaintenance::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeFreezerMaintenance::$strPubTableName.' (
						log_date,
						main_log,
						alert_user
						) VALUES (
						' . $objDatabase->SqlVariable($this->dttLogDate) . ',
						' . $objDatabase->SqlVariable($this->strMainLog) . ',
						' . $objDatabase->SqlVariable($this->blnAlertUser) . '
						)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeFreezerMaintenance::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeFreezerMaintenance::$strPubTableName.'
						SET
						log_date = ' . $objDatabase->SqlVariable($this->dttLogDate) . ',
						main_log = ' . $objDatabase->SqlVariable($this->strMainLog) . ',
						alert_user = ' . $objDatabase->SqlVariable($this->blnAlertUser) . '
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
	 * Delete this FreezerMaintenance
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this FreezerMaintenance with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = FreezerMaintenance::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeFreezerMaintenance::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all FreezerMaintenances
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = FreezerMaintenance::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeFreezerMaintenance::$strPubTableName.'');
	}

	/**
	 * Truncate freezer_maintenance table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = FreezerMaintenance::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeFreezerMaintenance::$strPubTableName.'');
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

			case 'LogDate':
				/**
				 * Gets the value for dttLogDate (Not Null)
				 * @return QDateTime
				 */
				return $this->dttLogDate;

			case 'MainLog':
				/**
				 * Gets the value for strMainLog (Not Null)
				 * @return string
				 */
				return $this->strMainLog;

				case 'AlertUser':
					/**
					 * Gets the value for blnAlertUser (Not Null)
					 * @return boolean
					 */
					return $this->blnAlertUser;

				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_FreezerAsFrzMain':
				/**
				 * Gets the value for the private _objFreezerAsFrzMain (Read-Only)
				 * if set due to an expansion on the frz_main_assn association table
				 * @return Freezer
				 */
				return $this->_objFreezerAsFrzMain;

			case '_FreezerAsFrzMainArray':
				/**
				 * Gets the value for the private _objFreezerAsFrzMainArray (Read-Only)
				 * if set due to an ExpandAsArray on the frz_main_assn association table
				 * @return Freezer[]
				 */
				return (array) $this->_objFreezerAsFrzMainArray;

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
			case 'LogDate':
				/**
				 * Sets the value for dttLogDate (Not Null)
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttLogDate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'MainLog':
				/**
				 * Sets the value for strMainLog (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strMainLog = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				case 'AlertUser':
					/**
					 * Sets the value for blnAlertUser (Not Null)
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnAlertUser = QType::Cast($mixValue, QType::Boolean));
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


	// Related Many-to-Many Objects' Methods for FreezerAsFrzMain
	//-------------------------------------------------------------------

	/**
	 * Gets all many-to-many associated FreezersAsFrzMain as an array of Freezer objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Freezer[]
		*/
	public function GetFreezerAsFrzMainArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Freezer::LoadArrayByFreezerMaintenanceAsFrzMain($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all many-to-many associated FreezersAsFrzMain
	 * @return int
		*/
	public function CountFreezersAsFrzMain() {
		if ((is_null($this->intId)))
			return 0;

		return Freezer::CountByFreezerMaintenanceAsFrzMain($this->intId);
	}

	/**
	 * Checks to see if an association exists with a specific FreezerAsFrzMain
	 * @param Freezer $objFreezer
	 * @return bool
		*/
	public function IsFreezerAsFrzMainAssociated(Freezer $objFreezer) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call IsFreezerAsFrzMainAssociated on this unsaved FreezerMaintenance.');
		if ((is_null($objFreezer->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call IsFreezerAsFrzMainAssociated on this FreezerMaintenance with an unsaved Freezer.');

		$intRowCount = FreezerMaintenance::QueryCount(
				QQ::AndCondition(
						QQ::Equal(QQN::FreezerMaintenance()->Id, $this->intId),
						QQ::Equal(QQN::FreezerMaintenance()->FreezerAsFrzMain->FreezerId, $objFreezer->Id)
				)
		);

		return ($intRowCount > 0);
	}

	/**
	 * Associates a FreezerAsFrzMain
	 * @param Freezer $objFreezer
	 * @return void
		*/
	public function AssociateFreezerAsFrzMain(Freezer $objFreezer) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateFreezerAsFrzMain on this unsaved FreezerMaintenance.');
		if ((is_null($objFreezer->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateFreezerAsFrzMain on this FreezerMaintenance with an unsaved Freezer.');

		// Get the Database Object for this Class
		$objDatabase = FreezerMaintenance::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				INSERT INTO '.QQNodeFreezerMaintenanceFreezerAsFrzMain::$strPubTableName.' (
				freezer_maintenance_id,
				freezer_id
		) VALUES (
				' . $objDatabase->SqlVariable($this->intId) . ',
				' . $objDatabase->SqlVariable($objFreezer->Id) . '
		)
				');
	}

	/**
	 * Unassociates a FreezerAsFrzMain
	 * @param Freezer $objFreezer
	 * @return void
		*/
	public function UnassociateFreezerAsFrzMain(Freezer $objFreezer) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFreezerAsFrzMain on this unsaved FreezerMaintenance.');
		if ((is_null($objFreezer->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFreezerAsFrzMain on this FreezerMaintenance with an unsaved Freezer.');

		// Get the Database Object for this Class
		$objDatabase = FreezerMaintenance::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeFreezerMaintenanceFreezerAsFrzMain::$strPubTableName.'
				WHERE
				freezer_maintenance_id = ' . $objDatabase->SqlVariable($this->intId) . ' AND
				freezer_id = ' . $objDatabase->SqlVariable($objFreezer->Id) . '
				');
	}

	/**
	 * Unassociates all FreezersAsFrzMain
	 * @return void
		*/
	public function UnassociateAllFreezersAsFrzMain() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAllFreezerAsFrzMainArray on this unsaved FreezerMaintenance.');

		// Get the Database Object for this Class
		$objDatabase = FreezerMaintenance::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeFreezerMaintenanceFreezerAsFrzMain::$strPubTableName.'
				WHERE
				freezer_maintenance_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}



	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column freezer_maintenance.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column freezer_maintenance.log_date
	 * @var QDateTime dttLogDate
	 */
	protected $dttLogDate;
	const LogDateDefault = null;


	/**
	 * Protected member variable that maps to the database column freezer_maintenance.main_log
	 * @var string strMainLog
	 */
	protected $strMainLog;
	const MainLogDefault = null;

/**
		 * Protected member variable that maps to the database column freezer_maintenance.alert_user
		 * @var boolean blnAlertUser
		 */
		protected $blnAlertUser;
		const AlertUserDefault = null;
		
	/**
	 * Private member variable that stores a reference to a single FreezerAsFrzMain object
	 * (of type Freezer), if this FreezerMaintenance object was restored with
	 * an expansion on the frz_main_assn association table.
	 * @var Freezer _objFreezerAsFrzMain;
	 */
	private $_objFreezerAsFrzMain;

	/**
	 * Private member variable that stores a reference to an array of FreezerAsFrzMain objects
	 * (of type Freezer[]), if this FreezerMaintenance object was restored with
	 * an ExpandAsArray on the frz_main_assn association table.
	 * @var Freezer[] _objFreezerAsFrzMainArray;
	 */
	private $_objFreezerAsFrzMainArray = array();

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
		$strToReturn = '<complexType name="FreezerMaintenance"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="LogDate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="MainLog" type="xsd:string"/>';
			$strToReturn .= '<element name="AlertUser" type="xsd:boolean"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('FreezerMaintenance', $strComplexTypeArray)) {
			$strComplexTypeArray['FreezerMaintenance'] = FreezerMaintenance::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, FreezerMaintenance::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new FreezerMaintenance();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'LogDate'))
			$objToReturn->dttLogDate = new QDateTime($objSoapObject->LogDate);
		if (property_exists($objSoapObject, 'MainLog'))
			$objToReturn->strMainLog = $objSoapObject->MainLog;
			if (property_exists($objSoapObject, 'AlertUser'))
				$objToReturn->blnAlertUser = $objSoapObject->AlertUser;
			if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, FreezerMaintenance::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn ?? '') ?? '');
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->dttLogDate)
			$objObject->dttLogDate = $objObject->dttLogDate->toString(QDateTime::FormatSoap);
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeFreezerMaintenanceFreezerAsFrzMain extends QQAssociationNode {
	protected $strType = 'association';
	protected $strName = 'freezerasfrzmain';

	protected $strTableName = 'fm__frz_main_assn'; public static $strPubTableName = 'fm__frz_main_assn';
	protected $strPrimaryKey = 'freezer_maintenance_id';
	protected $strClassName = 'Freezer';

	public function __get($strName) {
		switch ($strName) {
			case 'FreezerId':
				return new QQNode('freezer_id', 'integer', $this);
			case 'Freezer':
				return new QQNodeFreezer('freezer_id', 'integer', $this);
			case '_ChildTableNode':
				return new QQNodeFreezer('freezer_id', 'integer', $this);
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

class QQNodeFreezerMaintenance extends QQNode {
	protected $strTableName = 'fm__freezer_maintenance'; public static $strPubTableName = 'fm__freezer_maintenance';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'FreezerMaintenance';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'LogDate':
				return new QQNode('log_date', 'QDateTime', $this);
			case 'MainLog':
				return new QQNode('main_log', 'string', $this);
			case 'FreezerAsFrzMain':
				return new QQNodeFreezerMaintenanceFreezerAsFrzMain($this);
			case 'AlertUser':
				return new QQNode('alert_user', 'boolean', $this);

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

class QQReverseReferenceNodeFreezerMaintenance extends QQReverseReferenceNode {
	protected $strTableName = 'fm__freezer_maintenance'; public static $strPubTableName = 'fm__freezer_maintenance';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'FreezerMaintenance';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'LogDate':
				return new QQNode('log_date', 'QDateTime', $this);
			case 'MainLog':
				return new QQNode('main_log', 'string', $this);
			case 'FreezerAsFrzMain':
				return new QQNodeFreezerMaintenanceFreezerAsFrzMain($this);
			case 'AlertUser':
				return new QQNode('alert_user', 'boolean', $this);

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