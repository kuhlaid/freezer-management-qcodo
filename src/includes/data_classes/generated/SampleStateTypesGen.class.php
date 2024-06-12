<?php
/**
 * The abstract SampleStateTypesGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the SampleStateTypes subclass which
 * extends this SampleStateTypesGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the SampleStateTypes class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class SampleStateTypesGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a SampleStateTypes from PK Info
	 * @param integer $intId
	 * @return SampleStateTypes
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return SampleStateTypes::QuerySingle(
				QQ::Equal(QQN::SampleStateTypes()->Id, $intId)
		);
	}

	/**
	 * Load all SampleStateTypeses
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return SampleStateTypes[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call SampleStateTypes::QueryArray to perform the LoadAll query
		try {
			return SampleStateTypes::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all SampleStateTypeses
	 * @return int
	 */
	public static function CountAll() {
		// Call SampleStateTypes::QueryCount to perform the CountAll query
		return SampleStateTypes::QueryCount(QQ::All());
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
		$objDatabase = SampleStateTypes::GetDatabase();

		// Create/Build out the QueryBuilder object with SampleStateTypes-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__sample_state_types');
		SampleStateTypes::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__sample_state_types AS fm__sample_state_types');

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
	 * Static Qcodo Query method to query for a single SampleStateTypes object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return SampleStateTypes the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleStateTypes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new SampleStateTypes object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return SampleStateTypes::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of SampleStateTypes objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return SampleStateTypes[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleStateTypes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return SampleStateTypes::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of SampleStateTypes objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleStateTypes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = SampleStateTypes::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'sample_state_types_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with SampleStateTypes-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	SampleStateTypes::GetSelectFields($objQueryBuilder);
	SampleStateTypes::GetFromFields($objQueryBuilder);

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
	return SampleStateTypes::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this SampleStateTypes
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__sample_state_types';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.name AS ' . $strAliasPrefix . 'name');
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
	 * Instantiate a SampleStateTypes from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this SampleStateTypes::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return SampleStateTypes
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
				$strAliasPrefix = 'sample_state_types__';


			if ((array_key_exists($strAliasPrefix . 'sampleasstatetype__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'sampleasstatetype__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objSampleAsStateTypeArray)) {
					$objPreviousChildItem = $objPreviousItem->_objSampleAsStateTypeArray[$intPreviousChildItemCount - 1];
					$objChildItem = Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleasstatetype__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objSampleAsStateTypeArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objSampleAsStateTypeArray, Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleasstatetype__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'sample_state_types__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the SampleStateTypes object
		$objToReturn = new SampleStateTypes();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'sample_state_types__';




		// Check for SampleAsStateType Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'sampleasstatetype__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'sampleasstatetype__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objSampleAsStateTypeArray, Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleasstatetype__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objSampleAsStateType = Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleasstatetype__', $strExpandAsArrayNodes);
		}

		return $objToReturn;
	}

	/**
	 * Instantiate an array of SampleStateTypeses from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return SampleStateTypes[]
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
				$objItem = SampleStateTypes::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, SampleStateTypes::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single SampleStateTypes object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return SampleStateTypes
	 */
	public static function LoadById($intId) {
		return SampleStateTypes::QuerySingle(
				QQ::Equal(QQN::SampleStateTypes()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this SampleStateTypes
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = SampleStateTypes::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeSampleStateTypes::$strPubTableName.' (
						name
				) VALUES (
						' . $objDatabase->SqlVariable($this->strName) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeSampleStateTypes::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeSampleStateTypes::$strPubTableName.'
						SET
						name = ' . $objDatabase->SqlVariable($this->strName) . '
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
	 * Delete this SampleStateTypes
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this SampleStateTypes with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = SampleStateTypes::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleStateTypes::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all SampleStateTypeses
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = SampleStateTypes::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleStateTypes::$strPubTableName.'');
	}

	/**
	 * Truncate sample_state_types table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = SampleStateTypes::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeSampleStateTypes::$strPubTableName.'');
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
				 * Gets the value for strName
				 * @return string
				 */
				return $this->strName;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_SampleAsStateType':
				/**
				 * Gets the value for the private _objSampleAsStateType (Read-Only)
				 * if set due to an expansion on the sample.state_type_id reverse relationship
				 * @return Sample
				 */
				return $this->_objSampleAsStateType;

			case '_SampleAsStateTypeArray':
				/**
				 * Gets the value for the private _objSampleAsStateTypeArray (Read-Only)
				 * if set due to an ExpandAsArray on the sample.state_type_id reverse relationship
				 * @return Sample[]
				 */
				return (array) $this->_objSampleAsStateTypeArray;

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
				 * Sets the value for strName
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strName = QType::Cast($mixValue, QType::String));
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



	// Related Objects' Methods for SampleAsStateType
	//-------------------------------------------------------------------

	/**
	 * Gets all associated SamplesAsStateType as an array of Sample objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sample[]
		*/
	public function GetSampleAsStateTypeArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Sample::LoadArrayByStateTypeId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated SamplesAsStateType
	 * @return int
		*/
	public function CountSamplesAsStateType() {
		if ((is_null($this->intId)))
			return 0;

		return Sample::CountByStateTypeId($this->intId);
	}

	/**
	 * Associates a SampleAsStateType
	 * @param Sample $objSample
	 * @return void
		*/
	public function AssociateSampleAsStateType(Sample $objSample) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSampleAsStateType on this unsaved SampleStateTypes.');
		if ((is_null($objSample->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSampleAsStateType on this SampleStateTypes with an unsaved Sample.');

		// Get the Database Object for this Class
		$objDatabase = SampleStateTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample
				SET
				state_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objSample->Id) . '
				');
	}

	/**
	 * Unassociates a SampleAsStateType
	 * @param Sample $objSample
	 * @return void
		*/
	public function UnassociateSampleAsStateType(Sample $objSample) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsStateType on this unsaved SampleStateTypes.');
		if ((is_null($objSample->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsStateType on this SampleStateTypes with an unsaved Sample.');

		// Get the Database Object for this Class
		$objDatabase = SampleStateTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample
				SET
				state_type_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objSample->Id) . ' AND
				state_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all SamplesAsStateType
	 * @return void
		*/
	public function UnassociateAllSamplesAsStateType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsStateType on this unsaved SampleStateTypes.');

		// Get the Database Object for this Class
		$objDatabase = SampleStateTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample
				SET
				state_type_id = null
				WHERE
				state_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated SampleAsStateType
	 * @param Sample $objSample
	 * @return void
		*/
	public function DeleteAssociatedSampleAsStateType(Sample $objSample) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsStateType on this unsaved SampleStateTypes.');
		if ((is_null($objSample->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsStateType on this SampleStateTypes with an unsaved Sample.');

		// Get the Database Object for this Class
		$objDatabase = SampleStateTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				sample
				WHERE
				id = ' . $objDatabase->SqlVariable($objSample->Id) . ' AND
				state_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated SamplesAsStateType
	 * @return void
		*/
	public function DeleteAllSamplesAsStateType() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleAsStateType on this unsaved SampleStateTypes.');

		// Get the Database Object for this Class
		$objDatabase = SampleStateTypes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				sample
				WHERE
				state_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column sample_state_types.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_state_types.name
	 * @var string strName
	 */
	protected $strName;
	const NameMaxLength = 50;
	const NameDefault = null;


	/**
	 * Private member variable that stores a reference to a single SampleAsStateType object
	 * (of type Sample), if this SampleStateTypes object was restored with
	 * an expansion on the sample association table.
	 * @var Sample _objSampleAsStateType;
	 */
	private $_objSampleAsStateType;

	/**
	 * Private member variable that stores a reference to an array of SampleAsStateType objects
	 * (of type Sample[]), if this SampleStateTypes object was restored with
	 * an ExpandAsArray on the sample association table.
	 * @var Sample[] _objSampleAsStateTypeArray;
	 */
	private $_objSampleAsStateTypeArray = array();

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
		$strToReturn = '<complexType name="SampleStateTypes"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Name" type="xsd:string"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('SampleStateTypes', $strComplexTypeArray)) {
			$strComplexTypeArray['SampleStateTypes'] = SampleStateTypes::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, SampleStateTypes::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new SampleStateTypes();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Name'))
			$objToReturn->strName = $objSoapObject->Name;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, SampleStateTypes::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn ?? '') ?? '');
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeSampleStateTypes extends QQNode {
	protected $strTableName = 'fm__sample_state_types'; public static $strPubTableName = 'fm__sample_state_types';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'SampleStateTypes';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'SampleAsStateType':
				return new QQReverseReferenceNodeSample($this, 'sampleasstatetype', 'reverse_reference', 'state_type_id');

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

class QQReverseReferenceNodeSampleStateTypes extends QQReverseReferenceNode {
	protected $strTableName = 'fm__sample_state_types'; public static $strPubTableName = 'fm__sample_state_types';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'SampleStateTypes';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'SampleAsStateType':
				return new QQReverseReferenceNodeSample($this, 'sampleasstatetype', 'reverse_reference', 'state_type_id');

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