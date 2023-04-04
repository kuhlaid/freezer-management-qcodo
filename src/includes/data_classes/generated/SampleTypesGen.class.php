<?php
/**
 * The abstract SampleTypesGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the SampleTypes subclass which
 * extends this SampleTypesGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the SampleTypes class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class SampleTypesGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a SampleTypes from PK Info
	 * @param integer $intId
	 * @return SampleTypes
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return SampleTypes::QuerySingle(
				QQ::Equal(QQN::SampleTypes()->Id, $intId)
		);
	}

	/**
	 * Load all SampleTypeses
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return SampleTypes[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call SampleTypes::QueryArray to perform the LoadAll query
		try {
			return SampleTypes::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all SampleTypeses
	 * @return int
	 */
	public static function CountAll() {
		// Call SampleTypes::QueryCount to perform the CountAll query
		return SampleTypes::QueryCount(QQ::All());
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
		$objDatabase = SampleTypes::GetDatabase();

		// Create/Build out the QueryBuilder object with SampleTypes-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__sample_types');
		SampleTypes::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__sample_types AS fm__sample_types');

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
	 * Static Qcodo Query method to query for a single SampleTypes object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return SampleTypes the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleTypes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new SampleTypes object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return SampleTypes::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of SampleTypes objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return SampleTypes[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleTypes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return SampleTypes::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of SampleTypes objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleTypes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = SampleTypes::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'sample_types_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with SampleTypes-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	SampleTypes::GetSelectFields($objQueryBuilder);
	SampleTypes::GetFromFields($objQueryBuilder);

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
	return SampleTypes::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this SampleTypes
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__sample_types';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.letter AS ' . $strAliasPrefix . 'letter');
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
	 * Instantiate a SampleTypes from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this SampleTypes::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return SampleTypes
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
				$strAliasPrefix = 'sample_types__';


			if ((array_key_exists($strAliasPrefix . 'boxassampletype__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'boxassampletype__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objBoxAsSampleTypeArray)) {
					$objPreviousChildItem = $objPreviousItem->_objBoxAsSampleTypeArray[$intPreviousChildItemCount - 1];
					$objChildItem = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxassampletype__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objBoxAsSampleTypeArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objBoxAsSampleTypeArray, Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxassampletype__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			if ((array_key_exists($strAliasPrefix . 'sampleassampletype__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'sampleassampletype__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objSampleAsSampleTypeArray)) {
					$objPreviousChildItem = $objPreviousItem->_objSampleAsSampleTypeArray[$intPreviousChildItemCount - 1];
					$objChildItem = Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleassampletype__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objSampleAsSampleTypeArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objSampleAsSampleTypeArray, Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleassampletype__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'sample_types__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the SampleTypes object
		$objToReturn = new SampleTypes();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strLetter = $objDbRow->GetColumn($strAliasPrefix . 'letter', 'Char');
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
			$strAliasPrefix = 'sample_types__';




		// Check for BoxAsSampleType Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'boxassampletype__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'boxassampletype__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objBoxAsSampleTypeArray, Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxassampletype__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objBoxAsSampleType = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxassampletype__', $strExpandAsArrayNodes);
		}

		// Check for SampleAsSampleType Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'sampleassampletype__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'sampleassampletype__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objSampleAsSampleTypeArray, Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleassampletype__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objSampleAsSampleType = Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleassampletype__', $strExpandAsArrayNodes);
		}

		return $objToReturn;
	}

	/**
	 * Instantiate an array of SampleTypeses from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return SampleTypes[]
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
				$objItem = SampleTypes::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, SampleTypes::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single SampleTypes object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return SampleTypes
	 */
	public static function LoadById($intId) {
		return SampleTypes::QuerySingle(
				QQ::Equal(QQN::SampleTypes()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this SampleTypes
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeSampleTypes::$strPubTableName.' (
						letter,
						description
				) VALUES (
						' . $objDatabase->SqlVariable($this->strLetter) . ',
						' . $objDatabase->SqlVariable($this->strDescription) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeSampleTypes::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeSampleTypes::$strPubTableName.'
						SET
						letter = ' . $objDatabase->SqlVariable($this->strLetter) . ',
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
	 * Delete this SampleTypes
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this SampleTypes with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleTypes::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all SampleTypeses
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleTypes::$strPubTableName.'');
	}

	/**
	 * Truncate sample_types table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeSampleTypes::$strPubTableName.'');
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

			case 'Letter':
				/**
				 * Gets the value for strLetter (Not Null)
				 * @return string
				 */
				return $this->strLetter;

			case 'Description':
				/**
				 * Gets the value for strDescription (Not Null)
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

			case '_BoxAsSampleType':
				/**
				 * Gets the value for the private _objBoxAsSampleType (Read-Only)
				 * if set due to an expansion on the box.sample_type_id reverse relationship
				 * @return Box
				 */
				return $this->_objBoxAsSampleType;

			case '_BoxAsSampleTypeArray':
				/**
				 * Gets the value for the private _objBoxAsSampleTypeArray (Read-Only)
				 * if set due to an ExpandAsArray on the box.sample_type_id reverse relationship
				 * @return Box[]
				 */
				return (array) $this->_objBoxAsSampleTypeArray;

			case '_SampleAsSampleType':
				/**
				 * Gets the value for the private _objSampleAsSampleType (Read-Only)
				 * if set due to an expansion on the sample.sample_type_id reverse relationship
				 * @return Sample
				 */
				return $this->_objSampleAsSampleType;

			case '_SampleAsSampleTypeArray':
				/**
				 * Gets the value for the private _objSampleAsSampleTypeArray (Read-Only)
				 * if set due to an ExpandAsArray on the sample.sample_type_id reverse relationship
				 * @return Sample[]
				 */
				return (array) $this->_objSampleAsSampleTypeArray;

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
			case 'Letter':
				/**
				 * Sets the value for strLetter (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strLetter = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Description':
				/**
				 * Sets the value for strDescription (Not Null)
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



	// Related Objects' Methods for BoxAsSampleType
	//-------------------------------------------------------------------

	/**
	 * Gets all associated BoxesAsSampleType as an array of Box objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
		*/
	public function GetBoxAsSampleTypeArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Box::LoadArrayBySampleTypeId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated BoxesAsSampleType
	 * @return int
		*/
	public function CountBoxesAsSampleType() {
		if ((is_null($this->intId)))
			return 0;

		return Box::CountBySampleTypeId($this->intId);
	}

	/**
	 * Associates a BoxAsSampleType
	 * @param Box $objBox
	 * @return void
		*/
	public function AssociateBoxAsSampleType(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBoxAsSampleType on this unsaved SampleTypes.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBoxAsSampleType on this SampleTypes with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box
				SET
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . '
				');
	}

	/**
	 * Unassociates a BoxAsSampleType
	 * @param Box $objBox
	 * @return void
		*/
	public function UnassociateBoxAsSampleType(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsSampleType on this unsaved SampleTypes.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsSampleType on this SampleTypes with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box
				SET
				sample_type_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . ' AND
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all BoxesAsSampleType
	 * @return void
		*/
	public function UnassociateAllBoxesAsSampleType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsSampleType on this unsaved SampleTypes.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box
				SET
				sample_type_id = null
				WHERE
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated BoxAsSampleType
	 * @param Box $objBox
	 * @return void
		*/
	public function DeleteAssociatedBoxAsSampleType(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsSampleType on this unsaved SampleTypes.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsSampleType on this SampleTypes with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				box
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . ' AND
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated BoxesAsSampleType
	 * @return void
		*/
	public function DeleteAllBoxesAsSampleType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxAsSampleType on this unsaved SampleTypes.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				box
				WHERE
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}



	// Related Objects' Methods for SampleAsSampleType
	//-------------------------------------------------------------------

	/**
	 * Gets all associated SamplesAsSampleType as an array of Sample objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sample[]
		*/
	public function GetSampleAsSampleTypeArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Sample::LoadArrayBySampleTypeId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated SamplesAsSampleType
	 * @return int
		*/
	public function CountSamplesAsSampleType() {
		if ((is_null($this->intId)))
			return 0;

		return Sample::CountBySampleTypeId($this->intId);
	}

	/**
	 * Associates a SampleAsSampleType
	 * @param Sample $objSample
	 * @return void
		*/
	public function AssociateSampleAsSampleType(Sample $objSample) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSampleAsSampleType on this unsaved SampleTypes.');
		if ((is_null($objSample->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSampleAsSampleType on this SampleTypes with an unsaved Sample.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample
				SET
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objSample->Id) . '
				');
	}

	/**
	 * Unassociates a SampleAsSampleType
	 * @param Sample $objSample
	 * @return void
		*/
	public function UnassociateSampleAsSampleType(Sample $objSample) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsSampleType on this unsaved SampleTypes.');
		if ((is_null($objSample->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsSampleType on this SampleTypes with an unsaved Sample.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample
				SET
				sample_type_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objSample->Id) . ' AND
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all SamplesAsSampleType
	 * @return void
		*/
	public function UnassociateAllSamplesAsSampleType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsSampleType on this unsaved SampleTypes.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample
				SET
				sample_type_id = null
				WHERE
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated SampleAsSampleType
	 * @param Sample $objSample
	 * @return void
		*/
	public function DeleteAssociatedSampleAsSampleType(Sample $objSample) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsSampleType on this unsaved SampleTypes.');
		if ((is_null($objSample->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsSampleType on this SampleTypes with an unsaved Sample.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				sample
				WHERE
				id = ' . $objDatabase->SqlVariable($objSample->Id) . ' AND
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated SamplesAsSampleType
	 * @return void
		*/
	public function DeleteAllSamplesAsSampleType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsSampleType on this unsaved SampleTypes.');

		// Get the Database Object for this Class
		$objDatabase = SampleTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				sample
				WHERE
				sample_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column sample_types.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_types.letter
	 * @var string strLetter
	 */
	protected $strLetter;
	const LetterMaxLength = 1;
	const LetterDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_types.description
	 * @var string strDescription
	 */
	protected $strDescription;
	const DescriptionMaxLength = 45;
	const DescriptionDefault = null;


	/**
	 * Private member variable that stores a reference to a single BoxAsSampleType object
	 * (of type Box), if this SampleTypes object was restored with
	 * an expansion on the box association table.
	 * @var Box _objBoxAsSampleType;
	 */
	private $_objBoxAsSampleType;

	/**
	 * Private member variable that stores a reference to an array of BoxAsSampleType objects
	 * (of type Box[]), if this SampleTypes object was restored with
	 * an ExpandAsArray on the box association table.
	 * @var Box[] _objBoxAsSampleTypeArray;
	 */
	private $_objBoxAsSampleTypeArray = array();

	/**
	 * Private member variable that stores a reference to a single SampleAsSampleType object
	 * (of type Sample), if this SampleTypes object was restored with
	 * an expansion on the sample association table.
	 * @var Sample _objSampleAsSampleType;
	*/
	private $_objSampleAsSampleType;

	/**
	 * Private member variable that stores a reference to an array of SampleAsSampleType objects
	 * (of type Sample[]), if this SampleTypes object was restored with
	 * an ExpandAsArray on the sample association table.
	 * @var Sample[] _objSampleAsSampleTypeArray;
	 */
	private $_objSampleAsSampleTypeArray = array();

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
		$strToReturn = '<complexType name="SampleTypes"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Letter" type="xsd:string"/>';
		$strToReturn .= '<element name="Description" type="xsd:string"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('SampleTypes', $strComplexTypeArray)) {
			$strComplexTypeArray['SampleTypes'] = SampleTypes::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, SampleTypes::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new SampleTypes();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Letter'))
			$objToReturn->strLetter = $objSoapObject->Letter;
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
			array_push($objArrayToReturn, SampleTypes::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeSampleTypes extends QQNode {
	protected $strTableName = 'fm__sample_types'; public static $strPubTableName = 'fm__sample_types';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'SampleTypes';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Letter':
				return new QQNode('letter', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'BoxAsSampleType':
				return new QQReverseReferenceNodeBox($this, 'boxassampletype', 'reverse_reference', 'sample_type_id');
			case 'SampleAsSampleType':
				return new QQReverseReferenceNodeSample($this, 'sampleassampletype', 'reverse_reference', 'sample_type_id');

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

class QQReverseReferenceNodeSampleTypes extends QQReverseReferenceNode {
	protected $strTableName = 'fm__sample_types'; public static $strPubTableName = 'fm__sample_types';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'SampleTypes';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Letter':
				return new QQNode('letter', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'BoxAsSampleType':
				return new QQReverseReferenceNodeBox($this, 'boxassampletype', 'reverse_reference', 'sample_type_id');
			case 'SampleAsSampleType':
				return new QQReverseReferenceNodeSample($this, 'sampleassampletype', 'reverse_reference', 'sample_type_id');

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