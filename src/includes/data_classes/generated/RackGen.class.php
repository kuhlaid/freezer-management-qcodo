<?php
/**
 * The abstract RackGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Rack subclass which
 * extends this RackGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Rack class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class RackGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a Rack from PK Info
	 * @param integer $intId
	 * @return Rack
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return Rack::QuerySingle(
				QQ::Equal(QQN::Rack()->Id, $intId)
		);
	}

	/**
	 * Load all Racks
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Rack[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call Rack::QueryArray to perform the LoadAll query
		try {
			return Rack::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all Racks
	 * @return int
	 */
	public static function CountAll() {
		// Call Rack::QueryCount to perform the CountAll query
		return Rack::QueryCount(QQ::All());
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
		$objDatabase = Rack::GetDatabase();

		// Create/Build out the QueryBuilder object with Rack-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__rack');
		Rack::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__rack AS fm__rack');

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
	 * Static Qcodo Query method to query for a single Rack object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Rack the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Rack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new Rack object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Rack::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of Rack objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Rack[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Rack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Rack::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of Rack objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Rack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = Rack::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'rack_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Rack-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	Rack::GetSelectFields($objQueryBuilder);
	Rack::GetFromFields($objQueryBuilder);

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
	return Rack::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this Rack
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__rack';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.name AS ' . $strAliasPrefix . 'name');
			$objBuilder->AddSelectItem($strTableName . '.rack_type_id AS ' . $strAliasPrefix . 'rack_type_id');
			$objBuilder->AddSelectItem($strTableName . '.notes AS ' . $strAliasPrefix . 'notes');
			$objBuilder->AddSelectItem($strTableName . '.shelf AS ' . $strAliasPrefix . 'shelf');
			$objBuilder->AddSelectItem($strTableName . '.freezer AS ' . $strAliasPrefix . 'freezer');
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
	 * Instantiate a Rack from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this Rack::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return Rack
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
				$strAliasPrefix = 'rack__';


			if ((array_key_exists($strAliasPrefix . 'box__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'box__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objBoxArray)) {
					$objPreviousChildItem = $objPreviousItem->_objBoxArray[$intPreviousChildItemCount - 1];
					$objChildItem = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objBoxArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objBoxArray, Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'rack__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the Rack object
		$objToReturn = new Rack();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
		$objToReturn->intRackTypeId = $objDbRow->GetColumn($strAliasPrefix . 'rack_type_id', 'Integer');
		$objToReturn->strNotes = $objDbRow->GetColumn($strAliasPrefix . 'notes', 'VarChar');
		$objToReturn->intShelf = $objDbRow->GetColumn($strAliasPrefix . 'shelf', 'Integer');
		$objToReturn->intFreezer = $objDbRow->GetColumn($strAliasPrefix . 'freezer', 'Integer');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'rack__';

		// Check for RackType Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'rack_type_id__id')))
			$objToReturn->objRackType = TypeOfRack::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rack_type_id__', $strExpandAsArrayNodes);




		// Check for Box Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'box__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'box__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objBoxArray, Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objBox = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box__', $strExpandAsArrayNodes);
		}

		return $objToReturn;
	}

	/**
	 * Instantiate an array of Racks from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return Rack[]
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
				$objItem = Rack::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, Rack::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////
		
	/**
	 * Load a single Rack object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return Rack
	*/
	public static function LoadById($intId) {
		return Rack::QuerySingle(
				QQ::Equal(QQN::Rack()->Id, $intId)
		);
	}
		
	/**
	 * Load an array of Rack objects,
	 * by RackTypeId Index(es)
	 * @param integer $intRackTypeId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Rack[]
		*/
	public static function LoadArrayByRackTypeId($intRackTypeId, $objOptionalClauses = null) {
		// Call Rack::QueryArray to perform the LoadArrayByRackTypeId query
		try {
			return Rack::QueryArray(
					QQ::Equal(QQN::Rack()->RackTypeId, $intRackTypeId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Racks
	 * by RackTypeId Index(es)
	 * @param integer $intRackTypeId
	 * @return int
		*/
	public static function CountByRackTypeId($intRackTypeId) {
		// Call Rack::QueryCount to perform the CountByRackTypeId query
		return Rack::QueryCount(
				QQ::Equal(QQN::Rack()->RackTypeId, $intRackTypeId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this Rack
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = Rack::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeRack::$strPubTableName.' (
						name,
						rack_type_id,
						notes,
						shelf,
						freezer
				) VALUES (
						' . $objDatabase->SqlVariable($this->strName) . ',
						' . $objDatabase->SqlVariable($this->intRackTypeId) . ',
						' . $objDatabase->SqlVariable($this->strNotes) . ',
						' . $objDatabase->SqlVariable($this->intShelf) . ',
						' . $objDatabase->SqlVariable($this->intFreezer) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeRack::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeRack::$strPubTableName.'
						SET
						name = ' . $objDatabase->SqlVariable($this->strName) . ',
						rack_type_id = ' . $objDatabase->SqlVariable($this->intRackTypeId) . ',
						notes = ' . $objDatabase->SqlVariable($this->strNotes) . ',
						shelf = ' . $objDatabase->SqlVariable($this->intShelf) . ',
						freezer = ' . $objDatabase->SqlVariable($this->intFreezer) . '
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
	 * Delete this Rack
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this Rack with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = Rack::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeRack::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all Racks
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = Rack::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeRack::$strPubTableName.'');
	}

	/**
	 * Truncate rack table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = Rack::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeRack::$strPubTableName.'');
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

			case 'RackTypeId':
				/**
				 * Gets the value for intRackTypeId
				 * @return integer
				 */
				return $this->intRackTypeId;

			case 'Notes':
				/**
				 * Gets the value for strNotes
				 * @return string
				 */
				return $this->strNotes;

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


				///////////////////
				// Member Objects
				///////////////////
			case 'RackType':
				/**
				 * Gets the value for the TypeOfRack object referenced by intRackTypeId
				 * @return TypeOfRack
				 */
				try {
					if ((!$this->objRackType) && (!is_null($this->intRackTypeId)))
						$this->objRackType = TypeOfRack::Load($this->intRackTypeId);
					return $this->objRackType;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_Box':
				/**
				 * Gets the value for the private _objBox (Read-Only)
				 * if set due to an expansion on the box.rack_id reverse relationship
				 * @return Box
				 */
				return $this->_objBox;

			case '_BoxArray':
				/**
				 * Gets the value for the private _objBoxArray (Read-Only)
				 * if set due to an ExpandAsArray on the box.rack_id reverse relationship
				 * @return Box[]
				 */
				return (array) $this->_objBoxArray;

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

			case 'Notes':
				/**
				 * Sets the value for strNotes
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strNotes = QType::Cast($mixValue, QType::String));
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


				///////////////////
				// Member Objects
				///////////////////
			case 'RackType':
				/**
				 * Sets the value for the TypeOfRack object referenced by intRackTypeId
				 * @param TypeOfRack $mixValue
				 * @return TypeOfRack
				 */
				if (is_null($mixValue)) {
					$this->intRackTypeId = null;
					$this->objRackType = null;
					return null;
				} else {
					// Make sure $mixValue actually is a TypeOfRack object
					try {
						$mixValue = QType::Cast($mixValue, 'TypeOfRack');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED TypeOfRack object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved RackType for this Rack');

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

		

	// Related Objects' Methods for Box
	//-------------------------------------------------------------------

	/**
	 * Gets all associated Boxes as an array of Box objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
		*/
	public function GetBoxArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Box::LoadArrayByRackId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated Boxes
	 * @return int
		*/
	public function CountBoxes() {
		if ((is_null($this->intId)))
			return 0;

		return Box::CountByRackId($this->intId);
	}

	/**
	 * Associates a Box
	 * @param Box $objBox
	 * @return void
		*/
	public function AssociateBox(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBox on this unsaved Rack.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBox on this Rack with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Rack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				fm__box
				SET
				rack_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . '
				');
	}

	/**
	 * Unassociates a Box
	 * @param Box $objBox
	 * @return void
		*/
	public function UnassociateBox(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this unsaved Rack.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this Rack with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Rack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				fm__box
				SET
				rack_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . ' AND
				rack_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all Boxes
	 * @return void
		*/
	public function UnassociateAllBoxes() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this unsaved Rack.');

		// Get the Database Object for this Class
		$objDatabase = Rack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box
				SET
				rack_id = null
				WHERE
				rack_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated Box
	 * @param Box $objBox
	 * @return void
		*/
	public function DeleteAssociatedBox(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this unsaved Rack.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this Rack with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Rack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				fm__box
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . ' AND
				rack_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated Boxes
	 * @return void
		*/
	public function DeleteAllBoxes() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this unsaved Rack.');

		// Get the Database Object for this Class
		$objDatabase = Rack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				fm__box
				WHERE
				rack_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column rack.id
	 * @var integer intId
	*/
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column rack.name
	 * @var string strName
	 */
	protected $strName;
	const NameMaxLength = 145;
	const NameDefault = null;


	/**
	 * Protected member variable that maps to the database column rack.rack_type_id
	 * @var integer intRackTypeId
	 */
	protected $intRackTypeId;
	const RackTypeIdDefault = null;


	/**
	 * Protected member variable that maps to the database column rack.notes
	 * @var string strNotes
	 */
	protected $strNotes;
	const NotesMaxLength = 255;
	const NotesDefault = null;


	/**
	 * Protected member variable that maps to the database column rack.shelf
	 * @var integer intShelf
	 */
	protected $intShelf;
	const ShelfDefault = null;


	/**
	 * Protected member variable that maps to the database column rack.freezer
	 * @var integer intFreezer
	 */
	protected $intFreezer;
	const FreezerDefault = null;


	/**
	 * Private member variable that stores a reference to a single Box object
	 * (of type Box), if this Rack object was restored with
	 * an expansion on the box association table.
	 * @var Box _objBox;
	 */
	private $_objBox;

	/**
	 * Private member variable that stores a reference to an array of Box objects
	 * (of type Box[]), if this Rack object was restored with
	 * an ExpandAsArray on the box association table.
	 * @var Box[] _objBoxArray;
	 */
	private $_objBoxArray = array();

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
	 * in the database column rack.rack_type_id.
	 *
	 * NOTE: Always use the RackType property getter to correctly retrieve this TypeOfRack object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var TypeOfRack objRackType
	 */
	protected $objRackType;






	////////////////////////////////////////
	// METHODS for WEB SERVICES
	////////////////////////////////////////

	public static function GetSoapComplexTypeXml() {
		$strToReturn = '<complexType name="Rack"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Name" type="xsd:string"/>';
		$strToReturn .= '<element name="RackType" type="xsd1:TypeOfRack"/>';
		$strToReturn .= '<element name="Notes" type="xsd:string"/>';
		$strToReturn .= '<element name="Shelf" type="xsd:int"/>';
		$strToReturn .= '<element name="Freezer" type="xsd:int"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('Rack', $strComplexTypeArray)) {
			$strComplexTypeArray['Rack'] = Rack::GetSoapComplexTypeXml();
			TypeOfRack::AlterSoapComplexTypeArray($strComplexTypeArray);
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, Rack::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new Rack();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Name'))
			$objToReturn->strName = $objSoapObject->Name;
		if ((property_exists($objSoapObject, 'RackType')) &&
				($objSoapObject->RackType))
			$objToReturn->RackType = TypeOfRack::GetObjectFromSoapObject($objSoapObject->RackType);
		if (property_exists($objSoapObject, 'Notes'))
			$objToReturn->strNotes = $objSoapObject->Notes;
		if (property_exists($objSoapObject, 'Shelf'))
			$objToReturn->intShelf = $objSoapObject->Shelf;
		if (property_exists($objSoapObject, 'Freezer'))
			$objToReturn->intFreezer = $objSoapObject->Freezer;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, Rack::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn ?? '') ?? '');
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->objRackType)
			$objObject->objRackType = TypeOfRack::GetSoapObjectFromObject($objObject->objRackType, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intRackTypeId = null;
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeRack extends QQNode {
	protected $strTableName = 'fm__rack'; public static $strPubTableName = 'fm__rack';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Rack';
	protected $strDbSchema = '';	// wpg - added so we would have the database schema

	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'RackTypeId':
				return new QQNode('rack_type_id', 'integer', $this);
			case 'RackType':
				return new QQNodeTypeOfRack('rack_type_id', 'integer', $this);
			case 'Notes':
				return new QQNode('notes', 'string', $this);
			case 'Shelf':
				return new QQNode('shelf', 'integer', $this);
			case 'Freezer':
				return new QQNode('freezer', 'integer', $this);
			case 'Box':
				return new QQReverseReferenceNodeBox($this, 'box', 'reverse_reference', 'rack_id');

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

class QQReverseReferenceNodeRack extends QQReverseReferenceNode {
	protected $strTableName = 'fm__rack'; public static $strPubTableName = 'fm__rack';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Rack';
	protected $strDbSchema = '';	// wpg - added so we would have the database schema

	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'RackTypeId':
				return new QQNode('rack_type_id', 'integer', $this);
			case 'RackType':
				return new QQNodeTypeOfRack('rack_type_id', 'integer', $this);
			case 'Notes':
				return new QQNode('notes', 'string', $this);
			case 'Shelf':
				return new QQNode('shelf', 'integer', $this);
			case 'Freezer':
				return new QQNode('freezer', 'integer', $this);
			case 'Box':
				return new QQReverseReferenceNodeBox($this, 'box', 'reverse_reference', 'rack_id');

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