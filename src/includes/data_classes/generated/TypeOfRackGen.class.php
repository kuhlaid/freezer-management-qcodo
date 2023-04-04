<?php
/**
 * The abstract TypeOfRackGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the TypeOfRack subclass which
 * extends this TypeOfRackGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the TypeOfRack class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class TypeOfRackGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a TypeOfRack from PK Info
	 * @param integer $intId
	 * @return TypeOfRack
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return TypeOfRack::QuerySingle(
				QQ::Equal(QQN::TypeOfRack()->Id, $intId)
		);
	}

	/**
	 * Load all TypeOfRacks
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return TypeOfRack[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call TypeOfRack::QueryArray to perform the LoadAll query
		try {
			return TypeOfRack::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all TypeOfRacks
	 * @return int
	 */
	public static function CountAll() {
		// Call TypeOfRack::QueryCount to perform the CountAll query
		return TypeOfRack::QueryCount(QQ::All());
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
		$objDatabase = TypeOfRack::GetDatabase();

		// Create/Build out the QueryBuilder object with TypeOfRack-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__type_of_rack');
		TypeOfRack::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__type_of_rack AS fm__type_of_rack');

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
	 * Static Qcodo Query method to query for a single TypeOfRack object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return TypeOfRack the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = TypeOfRack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new TypeOfRack object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return TypeOfRack::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of TypeOfRack objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return TypeOfRack[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = TypeOfRack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
			//error_log($strQuery);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return TypeOfRack::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of TypeOfRack objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = TypeOfRack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = TypeOfRack::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'type_of_rack_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with TypeOfRack-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	TypeOfRack::GetSelectFields($objQueryBuilder);
	TypeOfRack::GetFromFields($objQueryBuilder);

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
	return TypeOfRack::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this TypeOfRack
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__type_of_rack';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.name AS ' . $strAliasPrefix . 'name');
			$objBuilder->AddSelectItem($strTableName . '.width AS ' . $strAliasPrefix . 'width');
			$objBuilder->AddSelectItem($strTableName . '.height AS ' . $strAliasPrefix . 'height');
			$objBuilder->AddSelectItem($strTableName . '.depth AS ' . $strAliasPrefix . 'depth');
			$objBuilder->AddSelectItem($strTableName . '.rows AS ' . $strAliasPrefix . '`rows`');
			$objBuilder->AddSelectItem($strTableName . '.columns AS ' . $strAliasPrefix . 'columns');
			$objBuilder->AddSelectItem($strTableName . '.box_count AS ' . $strAliasPrefix . 'box_count');
			$objBuilder->AddSelectItem($strTableName . '.box_type AS ' . $strAliasPrefix . 'box_type');
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
	 * Instantiate a TypeOfRack from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this TypeOfRack::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return TypeOfRack
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
				$strAliasPrefix = 'type_of_rack__';


			if ((array_key_exists($strAliasPrefix . 'rackasracktype__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'rackasracktype__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objRackAsRackTypeArray)) {
					$objPreviousChildItem = $objPreviousItem->_objRackAsRackTypeArray[$intPreviousChildItemCount - 1];
					$objChildItem = Rack::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rackasracktype__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objRackAsRackTypeArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objRackAsRackTypeArray, Rack::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rackasracktype__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'type_of_rack__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the TypeOfRack object
		$objToReturn = new TypeOfRack();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
		$objToReturn->fltWidth = $objDbRow->GetColumn($strAliasPrefix . 'width', 'Float');
		$objToReturn->fltHeight = $objDbRow->GetColumn($strAliasPrefix . 'height', 'Float');
		$objToReturn->fltDepth = $objDbRow->GetColumn($strAliasPrefix . 'depth', 'Float');
		$objToReturn->intRows = $objDbRow->GetColumn($strAliasPrefix . 'rows', 'Integer');
		$objToReturn->intColumns = $objDbRow->GetColumn($strAliasPrefix . 'columns', 'Integer');
		$objToReturn->intBoxCount = $objDbRow->GetColumn($strAliasPrefix . 'box_count', 'Integer');
		$objToReturn->intBoxType = $objDbRow->GetColumn($strAliasPrefix . 'box_type', 'Integer');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'type_of_rack__';




		// Check for RackAsRackType Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'rackasracktype__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'rackasracktype__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objRackAsRackTypeArray, Rack::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rackasracktype__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objRackAsRackType = Rack::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rackasracktype__', $strExpandAsArrayNodes);
		}

		return $objToReturn;
	}

	/**
	 * Instantiate an array of TypeOfRacks from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return TypeOfRack[]
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
				$objItem = TypeOfRack::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, TypeOfRack::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single TypeOfRack object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return TypeOfRack
	 */
	public static function LoadById($intId) {
		return TypeOfRack::QuerySingle(
				QQ::Equal(QQN::TypeOfRack()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this TypeOfRack
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = TypeOfRack::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeTypeOfRack::$strPubTableName.' (
						name,
						width,
						height,
						depth,
						`rows`,
						columns,
						box_count,
						box_type
				) VALUES (
						' . $objDatabase->SqlVariable($this->strName) . ',
						' . $objDatabase->SqlVariable($this->fltWidth) . ',
						' . $objDatabase->SqlVariable($this->fltHeight) . ',
						' . $objDatabase->SqlVariable($this->fltDepth) . ',
						' . $objDatabase->SqlVariable($this->intRows) . ',
						' . $objDatabase->SqlVariable($this->intColumns) . ',
						' . $objDatabase->SqlVariable($this->intBoxCount) . ',
						' . $objDatabase->SqlVariable($this->intBoxType) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeTypeOfRack::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeTypeOfRack::$strPubTableName.'
						SET
						name = ' . $objDatabase->SqlVariable($this->strName) . ',
						width = ' . $objDatabase->SqlVariable($this->fltWidth) . ',
						height = ' . $objDatabase->SqlVariable($this->fltHeight) . ',
						depth = ' . $objDatabase->SqlVariable($this->fltDepth) . ',
						`rows` = ' . $objDatabase->SqlVariable($this->intRows) . ',
						columns = ' . $objDatabase->SqlVariable($this->intColumns) . ',
						box_count = ' . $objDatabase->SqlVariable($this->intBoxCount) . ',
						box_type = ' . $objDatabase->SqlVariable($this->intBoxType) . '
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
	 * Delete this TypeOfRack
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this TypeOfRack with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfRack::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeTypeOfRack::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all TypeOfRacks
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = TypeOfRack::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeTypeOfRack::$strPubTableName.'');
	}

	/**
	 * Truncate type_of_rack table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = TypeOfRack::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeTypeOfRack::$strPubTableName.'');
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

			case 'Width':
				/**
				 * Gets the value for fltWidth
				 * @return double
				 */
				return $this->fltWidth;

			case 'Height':
				/**
				 * Gets the value for fltHeight
				 * @return double
				 */
				return $this->fltHeight;

			case 'Depth':
				/**
				 * Gets the value for fltDepth
				 * @return double
				 */
				return $this->fltDepth;

			case 'Rows':
				/**
				 * Gets the value for intRows
				 * @return integer
				 */
				return $this->intRows;

			case 'Columns':
				/**
				 * Gets the value for intColumns
				 * @return integer
				 */
				return $this->intColumns;

			case 'BoxCount':
				/**
				 * Gets the value for intBoxCount
				 * @return integer
				 */
				return $this->intBoxCount;

			case 'BoxType':
				/**
				 * Gets the value for intBoxType
				 * @return integer
				 */
				return $this->intBoxType;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_RackAsRackType':
				/**
				 * Gets the value for the private _objRackAsRackType (Read-Only)
				 * if set due to an expansion on the rack.rack_type_id reverse relationship
				 * @return Rack
				 */
				return $this->_objRackAsRackType;

			case '_RackAsRackTypeArray':
				/**
				 * Gets the value for the private _objRackAsRackTypeArray (Read-Only)
				 * if set due to an ExpandAsArray on the rack.rack_type_id reverse relationship
				 * @return Rack[]
				 */
				return (array) $this->_objRackAsRackTypeArray;

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

			case 'Width':
				/**
				 * Sets the value for fltWidth
				 * @param double $mixValue
				 * @return double
				 */
				try {
					return ($this->fltWidth = QType::Cast($mixValue, QType::Float));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Height':
				/**
				 * Sets the value for fltHeight
				 * @param double $mixValue
				 * @return double
				 */
				try {
					return ($this->fltHeight = QType::Cast($mixValue, QType::Float));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Depth':
				/**
				 * Sets the value for fltDepth
				 * @param double $mixValue
				 * @return double
				 */
				try {
					return ($this->fltDepth = QType::Cast($mixValue, QType::Float));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Rows':
				/**
				 * Sets the value for intRows
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intRows = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Columns':
				/**
				 * Sets the value for intColumns
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intColumns = QType::Cast($mixValue, QType::Integer));
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

			case 'BoxType':
				/**
				 * Sets the value for intBoxType
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intBoxType = QType::Cast($mixValue, QType::Integer));
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



	// Related Objects' Methods for RackAsRackType
	//-------------------------------------------------------------------

	/**
	 * Gets all associated RacksAsRackType as an array of Rack objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Rack[]
		*/
	public function GetRackAsRackTypeArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Rack::LoadArrayByRackTypeId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated RacksAsRackType
	 * @return int
		*/
	public function CountRacksAsRackType() {
		if ((is_null($this->intId)))
			return 0;

		return Rack::CountByRackTypeId($this->intId);
	}

	/**
	 * Associates a RackAsRackType
	 * @param Rack $objRack
	 * @return void
		*/
	public function AssociateRackAsRackType(Rack $objRack) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateRackAsRackType on this unsaved TypeOfRack.');
		if ((is_null($objRack->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateRackAsRackType on this TypeOfRack with an unsaved Rack.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfRack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				rack
				SET
				rack_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objRack->Id) . '
				');
	}

	/**
	 * Unassociates a RackAsRackType
	 * @param Rack $objRack
	 * @return void
		*/
	public function UnassociateRackAsRackType(Rack $objRack) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRackAsRackType on this unsaved TypeOfRack.');
		if ((is_null($objRack->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRackAsRackType on this TypeOfRack with an unsaved Rack.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfRack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				rack
				SET
				rack_type_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objRack->Id) . ' AND
				rack_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all RacksAsRackType
	 * @return void
		*/
	public function UnassociateAllRacksAsRackType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRackAsRackType on this unsaved TypeOfRack.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfRack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				rack
				SET
				rack_type_id = null
				WHERE
				rack_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated RackAsRackType
	 * @param Rack $objRack
	 * @return void
		*/
	public function DeleteAssociatedRackAsRackType(Rack $objRack) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRackAsRackType on this unsaved TypeOfRack.');
		if ((is_null($objRack->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRackAsRackType on this TypeOfRack with an unsaved Rack.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfRack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				rack
				WHERE
				id = ' . $objDatabase->SqlVariable($objRack->Id) . ' AND
				rack_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated RacksAsRackType
	 * @return void
		*/
	public function DeleteAllRacksAsRackType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateRackAsRackType on this unsaved TypeOfRack.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfRack::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				rack
				WHERE
				rack_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column type_of_rack.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_rack.name
	 * @var string strName
	 */
	protected $strName;
	const NameMaxLength = 145;
	const NameDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_rack.width
	 * @var double fltWidth
	 */
	protected $fltWidth;
	const WidthDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_rack.height
	 * @var double fltHeight
	 */
	protected $fltHeight;
	const HeightDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_rack.depth
	 * @var double fltDepth
	 */
	protected $fltDepth;
	const DepthDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_rack.rows
	 * @var integer intRows
	 */
	protected $intRows;
	const RowsDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_rack.columns
	 * @var integer intColumns
	 */
	protected $intColumns;
	const ColumnsDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_rack.box_count
	 * @var integer intBoxCount
	 */
	protected $intBoxCount;
	const BoxCountDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_rack.box_type
	 * @var integer intBoxType
	 */
	protected $intBoxType;
	const BoxTypeDefault = null;


	/**
	 * Private member variable that stores a reference to a single RackAsRackType object
	 * (of type Rack), if this TypeOfRack object was restored with
	 * an expansion on the rack association table.
	 * @var Rack _objRackAsRackType;
	 */
	private $_objRackAsRackType;

	/**
	 * Private member variable that stores a reference to an array of RackAsRackType objects
	 * (of type Rack[]), if this TypeOfRack object was restored with
	 * an ExpandAsArray on the rack association table.
	 * @var Rack[] _objRackAsRackTypeArray;
	 */
	private $_objRackAsRackTypeArray = array();

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
		$strToReturn = '<complexType name="TypeOfRack"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Name" type="xsd:string"/>';
		$strToReturn .= '<element name="Width" type="xsd:float"/>';
		$strToReturn .= '<element name="Height" type="xsd:float"/>';
		$strToReturn .= '<element name="Depth" type="xsd:float"/>';
		$strToReturn .= '<element name="Rows" type="xsd:int"/>';
		$strToReturn .= '<element name="Columns" type="xsd:int"/>';
		$strToReturn .= '<element name="BoxCount" type="xsd:int"/>';
		$strToReturn .= '<element name="BoxType" type="xsd:int"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('TypeOfRack', $strComplexTypeArray)) {
			$strComplexTypeArray['TypeOfRack'] = TypeOfRack::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, TypeOfRack::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new TypeOfRack();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Name'))
			$objToReturn->strName = $objSoapObject->Name;
		if (property_exists($objSoapObject, 'Width'))
			$objToReturn->fltWidth = $objSoapObject->Width;
		if (property_exists($objSoapObject, 'Height'))
			$objToReturn->fltHeight = $objSoapObject->Height;
		if (property_exists($objSoapObject, 'Depth'))
			$objToReturn->fltDepth = $objSoapObject->Depth;
		if (property_exists($objSoapObject, 'Rows'))
			$objToReturn->intRows = $objSoapObject->Rows;
		if (property_exists($objSoapObject, 'Columns'))
			$objToReturn->intColumns = $objSoapObject->Columns;
		if (property_exists($objSoapObject, 'BoxCount'))
			$objToReturn->intBoxCount = $objSoapObject->BoxCount;
		if (property_exists($objSoapObject, 'BoxType'))
			$objToReturn->intBoxType = $objSoapObject->BoxType;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, TypeOfRack::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeTypeOfRack extends QQNode {
	protected $strTableName = 'fm__type_of_rack'; public static $strPubTableName = 'fm__type_of_rack';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'TypeOfRack';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'Width':
				return new QQNode('width', 'double', $this);
			case 'Height':
				return new QQNode('height', 'double', $this);
			case 'Depth':
				return new QQNode('depth', 'double', $this);
			case 'Rows':
				return new QQNode('rows', 'integer', $this);
			case 'Columns':
				return new QQNode('columns', 'integer', $this);
			case 'BoxCount':
				return new QQNode('box_count', 'integer', $this);
			case 'BoxType':
				return new QQNode('box_type', 'integer', $this);
			case 'RackAsRackType':
				return new QQReverseReferenceNodeRack($this, 'rackasracktype', 'reverse_reference', 'rack_type_id');

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

class QQReverseReferenceNodeTypeOfRack extends QQReverseReferenceNode {
	protected $strTableName = 'fm__type_of_rack'; public static $strPubTableName = 'fm__type_of_rack';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'TypeOfRack';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'Width':
				return new QQNode('width', 'double', $this);
			case 'Height':
				return new QQNode('height', 'double', $this);
			case 'Depth':
				return new QQNode('depth', 'double', $this);
			case 'Rows':
				return new QQNode('rows', 'integer', $this);
			case 'Columns':
				return new QQNode('columns', 'integer', $this);
			case 'BoxCount':
				return new QQNode('box_count', 'integer', $this);
			case 'BoxType':
				return new QQNode('box_type', 'integer', $this);
			case 'RackAsRackType':
				return new QQReverseReferenceNodeRack($this, 'rackasracktype', 'reverse_reference', 'rack_type_id');

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