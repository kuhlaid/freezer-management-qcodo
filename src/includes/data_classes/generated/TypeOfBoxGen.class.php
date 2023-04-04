<?php
/**
 * The abstract TypeOfBoxGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the TypeOfBox subclass which
 * extends this TypeOfBoxGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the TypeOfBox class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class TypeOfBoxGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a TypeOfBox from PK Info
	 * @param integer $intId
	 * @return TypeOfBox
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return TypeOfBox::QuerySingle(
				QQ::Equal(QQN::TypeOfBox()->Id, $intId)
		);
	}

	/**
	 * Load all TypeOfBoxes
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return TypeOfBox[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call TypeOfBox::QueryArray to perform the LoadAll query
		try {
			return TypeOfBox::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all TypeOfBoxes
	 * @return int
	 */
	public static function CountAll() {
		// Call TypeOfBox::QueryCount to perform the CountAll query
		return TypeOfBox::QueryCount(QQ::All());
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
		$objDatabase = TypeOfBox::GetDatabase();

		// Create/Build out the QueryBuilder object with TypeOfBox-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__type_of_box');
		TypeOfBox::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__type_of_box AS fm__type_of_box');

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
	 * Static Qcodo Query method to query for a single TypeOfBox object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return TypeOfBox the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = TypeOfBox::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new TypeOfBox object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return TypeOfBox::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of TypeOfBox objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return TypeOfBox[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = TypeOfBox::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return TypeOfBox::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of TypeOfBox objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = TypeOfBox::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = TypeOfBox::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'type_of_box_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with TypeOfBox-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	TypeOfBox::GetSelectFields($objQueryBuilder);
	TypeOfBox::GetFromFields($objQueryBuilder);

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
	return TypeOfBox::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this TypeOfBox
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__type_of_box';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.name AS ' . $strAliasPrefix . 'name');
			$objBuilder->AddSelectItem($strTableName . '.width AS ' . $strAliasPrefix . 'width');
			$objBuilder->AddSelectItem($strTableName . '.height AS ' . $strAliasPrefix . 'height');
			$objBuilder->AddSelectItem($strTableName . '.`rows` AS ' . $strAliasPrefix . '`rows`');
			$objBuilder->AddSelectItem($strTableName . '.columns AS ' . $strAliasPrefix . 'columns');
			$objBuilder->AddSelectItem($strTableName . '.description AS ' . $strAliasPrefix . 'description');
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
	 * Instantiate a TypeOfBox from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this TypeOfBox::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return TypeOfBox
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
				$strAliasPrefix = 'type_of_box__';


			if ((array_key_exists($strAliasPrefix . 'boxasboxtype__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'boxasboxtype__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objBoxAsBoxTypeArray)) {
					$objPreviousChildItem = $objPreviousItem->_objBoxAsBoxTypeArray[$intPreviousChildItemCount - 1];
					$objChildItem = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxasboxtype__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objBoxAsBoxTypeArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objBoxAsBoxTypeArray, Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxasboxtype__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'type_of_box__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the TypeOfBox object
		$objToReturn = new TypeOfBox();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
		$objToReturn->fltWidth = $objDbRow->GetColumn($strAliasPrefix . 'width', 'Float');
		$objToReturn->fltHeight = $objDbRow->GetColumn($strAliasPrefix . 'height', 'Float');
		$objToReturn->intRows = $objDbRow->GetColumn($strAliasPrefix . 'rows', 'Integer');
		$objToReturn->intColumns = $objDbRow->GetColumn($strAliasPrefix . 'columns', 'Integer');
		$objToReturn->strDescription = $objDbRow->GetColumn($strAliasPrefix . 'description', 'VarChar');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'type_of_box__';




		// Check for BoxAsBoxType Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'boxasboxtype__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'boxasboxtype__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objBoxAsBoxTypeArray, Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxasboxtype__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objBoxAsBoxType = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxasboxtype__', $strExpandAsArrayNodes);
		}

		return $objToReturn;
	}

	/**
	 * Instantiate an array of TypeOfBoxes from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return TypeOfBox[]
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
				$objItem = TypeOfBox::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, TypeOfBox::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single TypeOfBox object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return TypeOfBox
	 */
	public static function LoadById($intId) {
		return TypeOfBox::QuerySingle(
				QQ::Equal(QQN::TypeOfBox()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this TypeOfBox
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = TypeOfBox::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeTypeOfBox::$strPubTableName.' (
						name,
						width,
						height,
						`rows`,
						columns,
						description
				) VALUES (
						' . $objDatabase->SqlVariable($this->strName) . ',
						' . $objDatabase->SqlVariable($this->fltWidth) . ',
						' . $objDatabase->SqlVariable($this->fltHeight) . ',
						' . $objDatabase->SqlVariable($this->intRows) . ',
						' . $objDatabase->SqlVariable($this->intColumns) . ',
						' . $objDatabase->SqlVariable($this->strDescription) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeTypeOfBox::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeTypeOfBox::$strPubTableName.'
						SET
						name = ' . $objDatabase->SqlVariable($this->strName) . ',
						width = ' . $objDatabase->SqlVariable($this->fltWidth) . ',
						height = ' . $objDatabase->SqlVariable($this->fltHeight) . ',
						`rows` = ' . $objDatabase->SqlVariable($this->intRows) . ',
						columns = ' . $objDatabase->SqlVariable($this->intColumns) . ',
						description = ' . $objDatabase->SqlVariable($this->strDescription) . '
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
	 * Delete this TypeOfBox
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this TypeOfBox with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfBox::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeTypeOfBox::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all TypeOfBoxes
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = TypeOfBox::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeTypeOfBox::$strPubTableName.'');
	}

	/**
	 * Truncate type_of_box table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = TypeOfBox::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeTypeOfBox::$strPubTableName.'');
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

			case 'Description':
				/**
				 * Gets the value for strDescription
				 * @return string
				 */
				return $this->strDescription;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_BoxAsBoxType':
				/**
				 * Gets the value for the private _objBoxAsBoxType (Read-Only)
				 * if set due to an expansion on the box.box_type_id reverse relationship
				 * @return Box
				 */
				return $this->_objBoxAsBoxType;

			case '_BoxAsBoxTypeArray':
				/**
				 * Gets the value for the private _objBoxAsBoxTypeArray (Read-Only)
				 * if set due to an ExpandAsArray on the box.box_type_id reverse relationship
				 * @return Box[]
				 */
				return (array) $this->_objBoxAsBoxTypeArray;

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



	// Related Objects' Methods for BoxAsBoxType
	//-------------------------------------------------------------------

	/**
	 * Gets all associated BoxesAsBoxType as an array of Box objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
		*/
	public function GetBoxAsBoxTypeArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Box::LoadArrayByBoxTypeId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated BoxesAsBoxType
	 * @return int
		*/
	public function CountBoxesAsBoxType() {
		if ((is_null($this->intId)))
			return 0;

		return Box::CountByBoxTypeId($this->intId);
	}

	/**
	 * Associates a BoxAsBoxType
	 * @param Box $objBox
	 * @return void
		*/
	public function AssociateBoxAsBoxType(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBoxAsBoxType on this unsaved TypeOfBox.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBoxAsBoxType on this TypeOfBox with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfBox::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
					fm__box
				SET
				box_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . '
				');
	}

	/**
	 * Unassociates a BoxAsBoxType
	 * @param Box $objBox
	 * @return void
		*/
	public function UnassociateBoxAsBoxType(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsBoxType on this unsaved TypeOfBox.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsBoxType on this TypeOfBox with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfBox::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
					fm__box
				SET
				box_type_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . ' AND
				box_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all BoxesAsBoxType
	 * @return void
		*/
	public function UnassociateAllBoxesAsBoxType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsBoxType on this unsaved TypeOfBox.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfBox::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
					fm__box
				SET
				box_type_id = null
				WHERE
				box_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated BoxAsBoxType
	 * @param Box $objBox
	 * @return void
		*/
	public function DeleteAssociatedBoxAsBoxType(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsBoxType on this unsaved TypeOfBox.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsBoxType on this TypeOfBox with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfBox::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
					fm__box
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . ' AND
				box_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated BoxesAsBoxType
	 * @return void
		*/
	public function DeleteAllBoxesAsBoxType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsBoxType on this unsaved TypeOfBox.');

		// Get the Database Object for this Class
		$objDatabase = TypeOfBox::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
					fm__box
				WHERE
				box_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column type_of_box.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_box.name
	 * @var string strName
	 */
	protected $strName;
	const NameMaxLength = 145;
	const NameDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_box.width
	 * @var double fltWidth
	 */
	protected $fltWidth;
	const WidthDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_box.height
	 * @var double fltHeight
	 */
	protected $fltHeight;
	const HeightDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_box.rows
	 * @var integer intRows
	 */
	protected $intRows;
	const RowsDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_box.columns
	 * @var integer intColumns
	 */
	protected $intColumns;
	const ColumnsDefault = null;


	/**
	 * Protected member variable that maps to the database column type_of_box.description
	 * @var string strDescription
	 */
	protected $strDescription;
	const DescriptionMaxLength = 145;
	const DescriptionDefault = null;


	/**
	 * Private member variable that stores a reference to a single BoxAsBoxType object
	 * (of type Box), if this TypeOfBox object was restored with
	 * an expansion on the box association table.
	 * @var Box _objBoxAsBoxType;
	 */
	private $_objBoxAsBoxType;

	/**
	 * Private member variable that stores a reference to an array of BoxAsBoxType objects
	 * (of type Box[]), if this TypeOfBox object was restored with
	 * an ExpandAsArray on the box association table.
	 * @var Box[] _objBoxAsBoxTypeArray;
	 */
	private $_objBoxAsBoxTypeArray = array();

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
		$strToReturn = '<complexType name="TypeOfBox"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Name" type="xsd:string"/>';
		$strToReturn .= '<element name="Width" type="xsd:float"/>';
		$strToReturn .= '<element name="Height" type="xsd:float"/>';
		$strToReturn .= '<element name="Rows" type="xsd:int"/>';
		$strToReturn .= '<element name="Columns" type="xsd:int"/>';
		$strToReturn .= '<element name="Description" type="xsd:string"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('TypeOfBox', $strComplexTypeArray)) {
			$strComplexTypeArray['TypeOfBox'] = TypeOfBox::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, TypeOfBox::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new TypeOfBox();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Name'))
			$objToReturn->strName = $objSoapObject->Name;
		if (property_exists($objSoapObject, 'Width'))
			$objToReturn->fltWidth = $objSoapObject->Width;
		if (property_exists($objSoapObject, 'Height'))
			$objToReturn->fltHeight = $objSoapObject->Height;
		if (property_exists($objSoapObject, 'Rows'))
			$objToReturn->intRows = $objSoapObject->Rows;
		if (property_exists($objSoapObject, 'Columns'))
			$objToReturn->intColumns = $objSoapObject->Columns;
		if (property_exists($objSoapObject, 'Description'))
			$objToReturn->strDescription = $objSoapObject->Description;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, TypeOfBox::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeTypeOfBox extends QQNode {
	protected $strTableName = 'fm__type_of_box'; public static $strPubTableName = 'fm__type_of_box';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'TypeOfBox';
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
			case 'Rows':
				return new QQNode('`rows`', 'integer', $this);
			case 'Columns':
				return new QQNode('columns', 'integer', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'BoxAsBoxType':
				return new QQReverseReferenceNodeBox($this, 'boxasboxtype', 'reverse_reference', 'box_type_id');

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

class QQReverseReferenceNodeTypeOfBox extends QQReverseReferenceNode {
	protected $strTableName = 'fm__type_of_box'; public static $strPubTableName = 'fm__type_of_box';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'TypeOfBox';
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
			case 'Rows':
				return new QQNode('`rows`', 'integer', $this);
			case 'Columns':
				return new QQNode('columns', 'integer', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'BoxAsBoxType':
				return new QQReverseReferenceNodeBox($this, 'boxasboxtype', 'reverse_reference', 'box_type_id');

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