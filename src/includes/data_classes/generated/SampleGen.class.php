<?php
/**
 * The abstract SampleGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Sample subclass which
 * extends this SampleGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Sample class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class SampleGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a Sample from PK Info
	 * @param integer $intId
	 * @return Sample
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return Sample::QuerySingle(
				QQ::Equal(QQN::Sample()->Id, $intId)
		);
	}

	/**
	 * Load all Samples
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sample[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call Sample::QueryArray to perform the LoadAll query
		try {
			return Sample::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all Samples
	 * @return int
	 */
	public static function CountAll() {
		// Call Sample::QueryCount to perform the CountAll query
		return Sample::QueryCount(QQ::All());
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
		$objDatabase = Sample::GetDatabase();

		// Create/Build out the QueryBuilder object with Sample-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__sample');
		Sample::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__sample AS fm__sample');

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
	 * Static Qcodo Query method to query for a single Sample object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Sample the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Sample::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new Sample object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Sample::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of Sample objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Sample[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Sample::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Sample::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of Sample objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Sample::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = Sample::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'sample_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Sample-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	Sample::GetSelectFields($objQueryBuilder);
	Sample::GetFromFields($objQueryBuilder);

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
	return Sample::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this Sample
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__sample';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.study_type_id AS ' . $strAliasPrefix . 'study_type_id');
			$objBuilder->AddSelectItem($strTableName . '.participant_id AS ' . $strAliasPrefix . 'participant_id');
			$objBuilder->AddSelectItem($strTableName . '.sample_type_id AS ' . $strAliasPrefix . 'sample_type_id');
			$objBuilder->AddSelectItem($strTableName . '.sample_number AS ' . $strAliasPrefix . 'sample_number');
			$objBuilder->AddSelectItem($strTableName . '.barcode AS ' . $strAliasPrefix . 'barcode');
			$objBuilder->AddSelectItem($strTableName . '.study_case AS ' . $strAliasPrefix . 'study_case');
			$objBuilder->AddSelectItem($strTableName . '.sampleloc AS ' . $strAliasPrefix . 'sampleloc');
			$objBuilder->AddSelectItem($strTableName . '.box_id AS ' . $strAliasPrefix . 'box_id');
			$objBuilder->AddSelectItem($strTableName . '.notes AS ' . $strAliasPrefix . 'notes');
			$objBuilder->AddSelectItem($strTableName . '.box_sample_slot AS ' . $strAliasPrefix . 'box_sample_slot');
			$objBuilder->AddSelectItem($strTableName . '.parent_id AS ' . $strAliasPrefix . 'parent_id');
			$objBuilder->AddSelectItem($strTableName . '.container_type_id AS ' . $strAliasPrefix . 'container_type_id');
			$objBuilder->AddSelectItem($strTableName . '.state_type_id AS ' . $strAliasPrefix . 'state_type_id');
			$objBuilder->AddSelectItem($strTableName . '.volume AS ' . $strAliasPrefix . 'volume');
			$objBuilder->AddSelectItem($strTableName . '.volumeUnit AS ' . $strAliasPrefix . 'volumeUnit');
			$objBuilder->AddSelectItem($strTableName . '.concentration AS ' . $strAliasPrefix . 'concentration');
			$objBuilder->AddSelectItem($strTableName . '.concentrationUnit AS ' . $strAliasPrefix . 'concentrationUnit');
			$objBuilder->AddSelectItem($strTableName . '.state_date AS ' . $strAliasPrefix . 'state_date');
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
	 * Instantiate a Sample from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this Sample::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return Sample
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;


		// Create a new instance of the Sample object
		$objToReturn = new Sample();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->intStudyTypeId = $objDbRow->GetColumn($strAliasPrefix . 'study_type_id', 'Integer');
		$objToReturn->intParticipantId = $objDbRow->GetColumn($strAliasPrefix . 'participant_id', 'Integer');
		$objToReturn->intSampleTypeId = $objDbRow->GetColumn($strAliasPrefix . 'sample_type_id', 'Integer');
		$objToReturn->intSampleNumber = $objDbRow->GetColumn($strAliasPrefix . 'sample_number', 'Integer');
		$objToReturn->strBarcode = $objDbRow->GetColumn($strAliasPrefix . 'barcode', 'VarChar');
		$objToReturn->strStudyCase = $objDbRow->GetColumn($strAliasPrefix . 'study_case', 'VarChar');
		$objToReturn->strSampleloc = $objDbRow->GetColumn($strAliasPrefix . 'sampleloc', 'VarChar');
		$objToReturn->intBoxId = $objDbRow->GetColumn($strAliasPrefix . 'box_id', 'Integer');
		$objToReturn->strNotes = $objDbRow->GetColumn($strAliasPrefix . 'notes', 'VarChar');
		$objToReturn->intBoxSampleSlot = $objDbRow->GetColumn($strAliasPrefix . 'box_sample_slot', 'Integer');
		$objToReturn->intParentId = $objDbRow->GetColumn($strAliasPrefix . 'parent_id', 'Integer');
		$objToReturn->intContainerTypeId = $objDbRow->GetColumn($strAliasPrefix . 'container_type_id', 'Integer');
		$objToReturn->intStateTypeId = $objDbRow->GetColumn($strAliasPrefix . 'state_type_id', 'Integer');
		$objToReturn->fltVolume = $objDbRow->GetColumn($strAliasPrefix . 'volume', 'Float');
		$objToReturn->strVolumeUnit = $objDbRow->GetColumn($strAliasPrefix . 'volumeUnit', 'VarChar');
		$objToReturn->fltConcentration = $objDbRow->GetColumn($strAliasPrefix . 'concentration', 'Float');
		$objToReturn->strConcentrationUnit = $objDbRow->GetColumn($strAliasPrefix . 'concentrationUnit', 'VarChar');
		$objToReturn->dttStateDate = $objDbRow->GetColumn($strAliasPrefix . 'state_date', 'DateTime');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'sample__';

		// Check for SampleType Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'sample_type_id__id')))
			$objToReturn->objSampleType = SampleTypes::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sample_type_id__', $strExpandAsArrayNodes);

		// Check for Box Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'box_id__id')))
			$objToReturn->objBox = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box_id__', $strExpandAsArrayNodes);

		// Check for ContainerType Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'container_type_id__id')))
			$objToReturn->objContainerType = SampleContainerTypes::InstantiateDbRow($objDbRow, $strAliasPrefix . 'container_type_id__', $strExpandAsArrayNodes);

		// Check for StateType Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'state_type_id__id')))
			$objToReturn->objStateType = SampleStateTypes::InstantiateDbRow($objDbRow, $strAliasPrefix . 'state_type_id__', $strExpandAsArrayNodes);




		return $objToReturn;
	}

	/**
	 * Instantiate an array of Samples from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return Sample[]
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
				$objItem = Sample::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, Sample::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single Sample object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return Sample
	 */
	public static function LoadById($intId) {
		return Sample::QuerySingle(
				QQ::Equal(QQN::Sample()->Id, $intId)
		);
	}

	/**
	 * Load an array of Sample objects,
	 * by ContainerTypeId Index(es)
	 * @param integer $intContainerTypeId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sample[]
		*/
	public static function LoadArrayByContainerTypeId($intContainerTypeId, $objOptionalClauses = null) {
		// Call Sample::QueryArray to perform the LoadArrayByContainerTypeId query
		try {
			return Sample::QueryArray(
					QQ::Equal(QQN::Sample()->ContainerTypeId, $intContainerTypeId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Samples
	 * by ContainerTypeId Index(es)
	 * @param integer $intContainerTypeId
	 * @return int
		*/
	public static function CountByContainerTypeId($intContainerTypeId) {
		// Call Sample::QueryCount to perform the CountByContainerTypeId query
		return Sample::QueryCount(
				QQ::Equal(QQN::Sample()->ContainerTypeId, $intContainerTypeId)
		);
	}

	/**
	 * Load an array of Sample objects,
	 * by StudyTypeId Index(es)
	 * @param integer $intStudyTypeId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sample[]
		*/
	public static function LoadArrayByStudyTypeId($intStudyTypeId, $objOptionalClauses = null) {
		// Call Sample::QueryArray to perform the LoadArrayByStudyTypeId query
		try {
			return Sample::QueryArray(
					QQ::Equal(QQN::Sample()->StudyTypeId, $intStudyTypeId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Samples
	 * by StudyTypeId Index(es)
	 * @param integer $intStudyTypeId
	 * @return int
		*/
	public static function CountByStudyTypeId($intStudyTypeId) {
		// Call Sample::QueryCount to perform the CountByStudyTypeId query
		return Sample::QueryCount(
				QQ::Equal(QQN::Sample()->StudyTypeId, $intStudyTypeId)
		);
	}

	/**
	 * Load an array of Sample objects,
	 * by SampleTypeId Index(es)
	 * @param integer $intSampleTypeId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sample[]
		*/
	public static function LoadArrayBySampleTypeId($intSampleTypeId, $objOptionalClauses = null) {
		// Call Sample::QueryArray to perform the LoadArrayBySampleTypeId query
		try {
			return Sample::QueryArray(
					QQ::Equal(QQN::Sample()->SampleTypeId, $intSampleTypeId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Samples
	 * by SampleTypeId Index(es)
	 * @param integer $intSampleTypeId
	 * @return int
		*/
	public static function CountBySampleTypeId($intSampleTypeId) {
		// Call Sample::QueryCount to perform the CountBySampleTypeId query
		return Sample::QueryCount(
				QQ::Equal(QQN::Sample()->SampleTypeId, $intSampleTypeId)
		);
	}


	/**
	 * Load an array of Sample objects,
	 * by BoxId Index(es)
	 * @param integer $intBoxId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sample[]
		*/
	public static function LoadArrayByBoxId($intBoxId, $objOptionalClauses = null) {
		// Call Sample::QueryArray to perform the LoadArrayByBoxId query
		try {
			return Sample::QueryArray(
					QQ::Equal(QQN::Sample()->BoxId, $intBoxId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Samples
	 * by BoxId Index(es)
	 * @param integer $intBoxId
	 * @return int
		*/
	public static function CountByBoxId($intBoxId) {
		// Call Sample::QueryCount to perform the CountByBoxId query
		return Sample::QueryCount(
				QQ::Equal(QQN::Sample()->BoxId, $intBoxId)
		);
	}

	/**
	 * Load an array of Sample objects,
	 * by StateTypeId Index(es)
	 * @param integer $intStateTypeId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sample[]
		*/
	public static function LoadArrayByStateTypeId($intStateTypeId, $objOptionalClauses = null) {
		// Call Sample::QueryArray to perform the LoadArrayByStateTypeId query
		try {
			return Sample::QueryArray(
					QQ::Equal(QQN::Sample()->StateTypeId, $intStateTypeId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Samples
	 * by StateTypeId Index(es)
	 * @param integer $intStateTypeId
	 * @return int
		*/
	public static function CountByStateTypeId($intStateTypeId) {
		// Call Sample::QueryCount to perform the CountByStateTypeId query
		return Sample::QueryCount(
				QQ::Equal(QQN::Sample()->StateTypeId, $intStateTypeId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this Sample
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = Sample::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeSample::$strPubTableName.' (
						study_type_id,
						participant_id,
						sample_type_id,
						sample_number,
						barcode,
						study_case,
						sampleloc,
						box_id,
						notes,
						box_sample_slot,
						parent_id,
						container_type_id,
						state_type_id,
						volume,
						volumeUnit,
						concentration,
						concentrationUnit,
						state_date
				) VALUES (
						' . $objDatabase->SqlVariable($this->intStudyTypeId) . ',
						' . $objDatabase->SqlVariable($this->intParticipantId) . ',
						' . $objDatabase->SqlVariable($this->intSampleTypeId) . ',
						' . $objDatabase->SqlVariable($this->intSampleNumber) . ',
						' . $objDatabase->SqlVariable($this->strBarcode) . ',
						' . $objDatabase->SqlVariable($this->strStudyCase) . ',
						' . $objDatabase->SqlVariable($this->strSampleloc) . ',
								' . $objDatabase->SqlVariable($this->intBoxId) . ',
										' . $objDatabase->SqlVariable($this->strNotes) . ',
												' . $objDatabase->SqlVariable($this->intBoxSampleSlot) . ',
														' . $objDatabase->SqlVariable($this->intParentId) . ',
																' . $objDatabase->SqlVariable($this->intContainerTypeId) . ',
																		' . $objDatabase->SqlVariable($this->intStateTypeId) . ',
																				' . $objDatabase->SqlVariable($this->fltVolume) . ',
																						' . $objDatabase->SqlVariable($this->strVolumeUnit) . ',
																								' . $objDatabase->SqlVariable($this->fltConcentration) . ',
																										' . $objDatabase->SqlVariable($this->strConcentrationUnit) . ',
																												' . $objDatabase->SqlVariable($this->dttStateDate) . '
																														)
																														');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeSample::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query
				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeSample::$strPubTableName.'
						SET
						study_type_id = ' . $objDatabase->SqlVariable($this->intStudyTypeId) . ',
						participant_id = ' . $objDatabase->SqlVariable($this->intParticipantId) . ',
						sample_type_id = ' . $objDatabase->SqlVariable($this->intSampleTypeId) . ',
						sample_number = ' . $objDatabase->SqlVariable($this->intSampleNumber) . ',
						barcode = ' . $objDatabase->SqlVariable($this->strBarcode) . ',
						study_case = ' . $objDatabase->SqlVariable($this->strStudyCase) . ',
						sampleloc = ' . $objDatabase->SqlVariable($this->strSampleloc) . ',
						box_id = ' . $objDatabase->SqlVariable($this->intBoxId) . ',
						notes = ' . $objDatabase->SqlVariable($this->strNotes) . ',
								box_sample_slot = ' . $objDatabase->SqlVariable($this->intBoxSampleSlot) . ',
										parent_id = ' . $objDatabase->SqlVariable($this->intParentId) . ',
												container_type_id = ' . $objDatabase->SqlVariable($this->intContainerTypeId) . ',
														state_type_id = ' . $objDatabase->SqlVariable($this->intStateTypeId) . ',
																volume = ' . $objDatabase->SqlVariable($this->fltVolume) . ',
																		volumeUnit = ' . $objDatabase->SqlVariable($this->strVolumeUnit) . ',
																				concentration = ' . $objDatabase->SqlVariable($this->fltConcentration) . ',
																						concentrationUnit = ' . $objDatabase->SqlVariable($this->strConcentrationUnit) . ',
																								state_date = ' . $objDatabase->SqlVariable($this->dttStateDate) . '
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
	 * Delete this Sample
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this Sample with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = Sample::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSample::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all Samples
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = Sample::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSample::$strPubTableName.'');
	}

	/**
	 * Truncate sample table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = Sample::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeSample::$strPubTableName.'');
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

			case 'StudyTypeId':
				/**
				 * Gets the value for intStudyTypeId
				 * @return integer
				 */
				return $this->intStudyTypeId;

			case 'ParticipantId':
				/**
				 * Gets the value for intParticipantId
				 * @return integer
				 */
				return $this->intParticipantId;

			case 'SampleTypeId':
				/**
				 * Gets the value for intSampleTypeId
				 * @return integer
				 */
				return $this->intSampleTypeId;

			case 'SampleNumber':
				/**
				 * Gets the value for intSampleNumber
				 * @return integer
				 */
				return $this->intSampleNumber;

			case 'Barcode':
				/**
				 * Gets the value for strBarcode
				 * @return string
				 */
				return $this->strBarcode;


			case 'StudyCase':
				/**
				 * Gets the value for strStudyCase
				 * @return string
				 */
				return $this->strStudyCase;

			case 'Sampleloc':
				/**
				 * Gets the value for strSampleloc
				 * @return string
				 */
				return $this->strSampleloc;

			case 'BoxId':
				/**
				 * Gets the value for intBoxId
				 * @return integer
				 */
				return $this->intBoxId;

			case 'Notes':
				/**
				 * Gets the value for strNotes
				 * @return string
				 */
				return $this->strNotes;

			case 'BoxSampleSlot':
				/**
				 * Gets the value for intBoxSampleSlot
				 * @return integer
				 */
				return $this->intBoxSampleSlot;

			case 'ParentId':
				/**
				 * Gets the value for intParentId
				 * @return integer
				 */
				return $this->intParentId;

			case 'ContainerTypeId':
				/**
				 * Gets the value for intContainerTypeId
				 * @return integer
				 */
				return $this->intContainerTypeId;

			case 'StateTypeId':
				/**
				 * Gets the value for intStateTypeId
				 * @return integer
				 */
				return $this->intStateTypeId;

			case 'Volume':
				/**
				 * Gets the value for fltVolume
				 * @return double
				 */
				return $this->fltVolume;

			case 'VolumeUnit':
				/**
				 * Gets the value for strVolumeUnit
				 * @return string
				 */
				return $this->strVolumeUnit;

			case 'Concentration':
				/**
				 * Gets the value for fltConcentration
				 * @return double
				 */
				return $this->fltConcentration;

			case 'ConcentrationUnit':
				/**
				 * Gets the value for strConcentrationUnit
				 * @return string
				 */
				return $this->strConcentrationUnit;

			case 'StateDate':
				/**
				 * Gets the value for dttStateDate
				 * @return QDateTime
				 */
				return $this->dttStateDate;


				///////////////////
				// Member Objects
				///////////////////
			case 'SampleType':
				/**
				 * Gets the value for the SampleTypes object referenced by intSampleTypeId
				 * @return SampleTypes
				 */
				try {
					if ((!$this->objSampleType) && (!is_null($this->intSampleTypeId)))
						$this->objSampleType = SampleTypes::Load($this->intSampleTypeId);
					return $this->objSampleType;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Box':
				/**
				 * Gets the value for the Box object referenced by intBoxId
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

			case 'ContainerType':
				/**
				 * Gets the value for the SampleContainerTypes object referenced by intContainerTypeId
				 * @return SampleContainerTypes
				 */
				try {
					if ((!$this->objContainerType) && (!is_null($this->intContainerTypeId)))
						$this->objContainerType = SampleContainerTypes::Load($this->intContainerTypeId);
					return $this->objContainerType;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'StateType':
				/**
				 * Gets the value for the SampleStateTypes object referenced by intStateTypeId
				 * @return SampleStateTypes
				 */
				try {
					if ((!$this->objStateType) && (!is_null($this->intStateTypeId)))
						$this->objStateType = SampleStateTypes::Load($this->intStateTypeId);
					return $this->objStateType;
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
			case 'StudyTypeId':
				/**
				 * Sets the value for intStudyTypeId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intStudyTypeId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'ParticipantId':
				/**
				 * Sets the value for intParticipantId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intParticipantId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'SampleTypeId':
				/**
				 * Sets the value for intSampleTypeId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objSampleType = null;
					return ($this->intSampleTypeId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'SampleNumber':
				/**
				 * Sets the value for intSampleNumber
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intSampleNumber = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Barcode':
				/**
				 * Sets the value for strBarcode
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strBarcode = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			

			case 'StudyCase':
				/**
				 * Sets the value for strStudyCase
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strStudyCase = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Sampleloc':
				/**
				 * Sets the value for strSampleloc
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strSampleloc = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'BoxId':
				/**
				 * Sets the value for intBoxId
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

			case 'BoxSampleSlot':
				/**
				 * Sets the value for intBoxSampleSlot
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intBoxSampleSlot = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'ParentId':
				/**
				 * Sets the value for intParentId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intParentId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'ContainerTypeId':
				/**
				 * Sets the value for intContainerTypeId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objContainerType = null;
					return ($this->intContainerTypeId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'StateTypeId':
				/**
				 * Sets the value for intStateTypeId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objStateType = null;
					return ($this->intStateTypeId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Volume':
				/**
				 * Sets the value for fltVolume
				 * @param double $mixValue
				 * @return double
				 */
				try {
					return ($this->fltVolume = QType::Cast($mixValue, QType::Float));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'VolumeUnit':
				/**
				 * Sets the value for strVolumeUnit
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strVolumeUnit = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Concentration':
				/**
				 * Sets the value for fltConcentration
				 * @param double $mixValue
				 * @return double
				 */
				try {
					return ($this->fltConcentration = QType::Cast($mixValue, QType::Float));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'ConcentrationUnit':
				/**
				 * Sets the value for strConcentrationUnit
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strConcentrationUnit = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'StateDate':
				/**
				 * Sets the value for dttStateDate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttStateDate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				///////////////////
				// Member Objects
				///////////////////
			case 'SampleType':
				/**
				 * Sets the value for the SampleTypes object referenced by intSampleTypeId
				 * @param SampleTypes $mixValue
				 * @return SampleTypes
				 */
				if (is_null($mixValue)) {
					$this->intSampleTypeId = null;
					$this->objSampleType = null;
					return null;
				} else {
					// Make sure $mixValue actually is a SampleTypes object
					try {
						$mixValue = QType::Cast($mixValue, 'SampleTypes');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED SampleTypes object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved SampleType for this Sample');

					// Update Local Member Variables
					$this->objSampleType = $mixValue;
					$this->intSampleTypeId = $mixValue->Id;

					// Return $mixValue
					return $mixValue;
				}
				break;

			

			case 'Box':
				/**
				 * Sets the value for the Box object referenced by intBoxId
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
						throw new QCallerException('Unable to set an unsaved Box for this Sample');

					// Update Local Member Variables
					$this->objBox = $mixValue;
					$this->intBoxId = $mixValue->Id;

					// Return $mixValue
					return $mixValue;
				}
				break;

			case 'ContainerType':
				/**
				 * Sets the value for the SampleContainerTypes object referenced by intContainerTypeId
				 * @param SampleContainerTypes $mixValue
				 * @return SampleContainerTypes
				 */
				if (is_null($mixValue)) {
					$this->intContainerTypeId = null;
					$this->objContainerType = null;
					return null;
				} else {
					// Make sure $mixValue actually is a SampleContainerTypes object
					try {
						$mixValue = QType::Cast($mixValue, 'SampleContainerTypes');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED SampleContainerTypes object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved ContainerType for this Sample');

					// Update Local Member Variables
					$this->objContainerType = $mixValue;
					$this->intContainerTypeId = $mixValue->Id;

					// Return $mixValue
					return $mixValue;
				}
				break;

			case 'StateType':
				/**
				 * Sets the value for the SampleStateTypes object referenced by intStateTypeId
				 * @param SampleStateTypes $mixValue
				 * @return SampleStateTypes
				 */
				if (is_null($mixValue)) {
					$this->intStateTypeId = null;
					$this->objStateType = null;
					return null;
				} else {
					// Make sure $mixValue actually is a SampleStateTypes object
					try {
						$mixValue = QType::Cast($mixValue, 'SampleStateTypes');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED SampleStateTypes object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved StateType for this Sample');

					// Update Local Member Variables
					$this->objStateType = $mixValue;
					$this->intStateTypeId = $mixValue->Id;

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
	 * Protected member variable that maps to the database PK Identity column sample.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.study_type_id
	 * @var integer intStudyTypeId
	 */
	protected $intStudyTypeId;
	const StudyTypeIdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.participant_id
	 * @var integer intParticipantId
	 */
	protected $intParticipantId;
	const ParticipantIdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.sample_type_id
	 * @var integer intSampleTypeId
	 */
	protected $intSampleTypeId;
	const SampleTypeIdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.sample_number
	 * @var integer intSampleNumber
	 */
	protected $intSampleNumber;
	const SampleNumberDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.barcode
	 * @var string strBarcode
	 */
	protected $strBarcode;
	const BarcodeMaxLength = 16;
	const BarcodeDefault = null;




	/**
	 * Protected member variable that maps to the database column sample.study_case
	 * @var string strStudyCase
	 */
	protected $strStudyCase;
	const StudyCaseMaxLength = 25;
	const StudyCaseDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.sampleloc
	 * @var string strSampleloc
	 */
	protected $strSampleloc;
	const SamplelocMaxLength = 5;
	const SamplelocDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.box_id
	 * @var integer intBoxId
	 */
	protected $intBoxId;
	const BoxIdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.notes
	 * @var string strNotes
	 */
	protected $strNotes;
	const NotesMaxLength = 3000;
	const NotesDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.box_sample_slot
	 * @var integer intBoxSampleSlot
	 */
	protected $intBoxSampleSlot;
	const BoxSampleSlotDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.parent_id
	 * @var integer intParentId
	 */
	protected $intParentId;
	const ParentIdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.container_type_id
	 * @var integer intContainerTypeId
	 */
	protected $intContainerTypeId;
	const ContainerTypeIdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.state_type_id
	 * @var integer intStateTypeId
	 */
	protected $intStateTypeId;
	const StateTypeIdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.volume
	 * @var double fltVolume
	 */
	protected $fltVolume;
	const VolumeDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.volumeUnit
	 * @var string strVolumeUnit
	 */
	protected $strVolumeUnit;
	const VolumeUnitMaxLength = 10;
	const VolumeUnitDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.concentration
	 * @var double fltConcentration
	 */
	protected $fltConcentration;
	const ConcentrationDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.concentrationUnit
	 * @var string strConcentrationUnit
	 */
	protected $strConcentrationUnit;
	const ConcentrationUnitMaxLength = 10;
	const ConcentrationUnitDefault = null;


	/**
	 * Protected member variable that maps to the database column sample.state_date
	 * @var QDateTime dttStateDate
	 */
	protected $dttStateDate;
	const StateDateDefault = null;


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
	 * in the database column sample.sample_type_id.
	 *
	 * NOTE: Always use the SampleType property getter to correctly retrieve this SampleTypes object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var SampleTypes objSampleType
	 */
	protected $objSampleType;


	/**
	 * Protected member variable that contains the object pointed by the reference
	 * in the database column sample.box_id.
	 *
	 * NOTE: Always use the Box property getter to correctly retrieve this Box object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var Box objBox
	 */
	protected $objBox;

	/**
	 * Protected member variable that contains the object pointed by the reference
	 * in the database column sample.container_type_id.
	 *
	 * NOTE: Always use the ContainerType property getter to correctly retrieve this SampleContainerTypes object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var SampleContainerTypes objContainerType
	 */
	protected $objContainerType;

	/**
	 * Protected member variable that contains the object pointed by the reference
	 * in the database column sample.state_type_id.
	 *
	 * NOTE: Always use the StateType property getter to correctly retrieve this SampleStateTypes object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var SampleStateTypes objStateType
	 */
	protected $objStateType;






	////////////////////////////////////////
	// METHODS for WEB SERVICES
	////////////////////////////////////////

	public static function GetSoapComplexTypeXml() {
		$strToReturn = '<complexType name="Sample"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="StudyTypeId" type="xsd:int"/>';
		$strToReturn .= '<element name="ParticipantId" type="xsd:int"/>';
		$strToReturn .= '<element name="SampleType" type="xsd1:SampleTypes"/>';
		$strToReturn .= '<element name="SampleNumber" type="xsd:int"/>';
		$strToReturn .= '<element name="Barcode" type="xsd:string"/>';
		$strToReturn .= '<element name="StudyCase" type="xsd:string"/>';
		$strToReturn .= '<element name="Sampleloc" type="xsd:string"/>';
		$strToReturn .= '<element name="Box" type="xsd1:Box"/>';
		$strToReturn .= '<element name="Notes" type="xsd:string"/>';
		$strToReturn .= '<element name="BoxSampleSlot" type="xsd:int"/>';
		$strToReturn .= '<element name="ParentId" type="xsd:int"/>';
		$strToReturn .= '<element name="ContainerType" type="xsd1:SampleContainerTypes"/>';
		$strToReturn .= '<element name="StateType" type="xsd1:SampleStateTypes"/>';
		$strToReturn .= '<element name="Volume" type="xsd:float"/>';
		$strToReturn .= '<element name="VolumeUnit" type="xsd:string"/>';
		$strToReturn .= '<element name="Concentration" type="xsd:float"/>';
		$strToReturn .= '<element name="ConcentrationUnit" type="xsd:string"/>';
		$strToReturn .= '<element name="StateDate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('Sample', $strComplexTypeArray)) {
			$strComplexTypeArray['Sample'] = Sample::GetSoapComplexTypeXml();
			SampleTypes::AlterSoapComplexTypeArray($strComplexTypeArray);
			FrzInventory::AlterSoapComplexTypeArray($strComplexTypeArray);
			Box::AlterSoapComplexTypeArray($strComplexTypeArray);
			SampleContainerTypes::AlterSoapComplexTypeArray($strComplexTypeArray);
			SampleStateTypes::AlterSoapComplexTypeArray($strComplexTypeArray);
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, Sample::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new Sample();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'StudyTypeId'))
			$objToReturn->intStudyTypeId = $objSoapObject->StudyTypeId;
		if (property_exists($objSoapObject, 'ParticipantId'))
			$objToReturn->intParticipantId = $objSoapObject->ParticipantId;
		if ((property_exists($objSoapObject, 'SampleType')) &&
				($objSoapObject->SampleType))
			$objToReturn->SampleType = SampleTypes::GetObjectFromSoapObject($objSoapObject->SampleType);
		if (property_exists($objSoapObject, 'SampleNumber'))
			$objToReturn->intSampleNumber = $objSoapObject->SampleNumber;
		if (property_exists($objSoapObject, 'Barcode'))
			$objToReturn->strBarcode = $objSoapObject->Barcode;
		if (property_exists($objSoapObject, 'StudyCase'))
			$objToReturn->strStudyCase = $objSoapObject->StudyCase;
		if (property_exists($objSoapObject, 'Sampleloc'))
			$objToReturn->strSampleloc = $objSoapObject->Sampleloc;
		if ((property_exists($objSoapObject, 'Box')) &&
				($objSoapObject->Box))
			$objToReturn->Box = Box::GetObjectFromSoapObject($objSoapObject->Box);
		if (property_exists($objSoapObject, 'Notes'))
			$objToReturn->strNotes = $objSoapObject->Notes;
		if (property_exists($objSoapObject, 'BoxSampleSlot'))
			$objToReturn->intBoxSampleSlot = $objSoapObject->BoxSampleSlot;
		if (property_exists($objSoapObject, 'ParentId'))
			$objToReturn->intParentId = $objSoapObject->ParentId;
		if ((property_exists($objSoapObject, 'ContainerType')) &&
				($objSoapObject->ContainerType))
			$objToReturn->ContainerType = SampleContainerTypes::GetObjectFromSoapObject($objSoapObject->ContainerType);
		if ((property_exists($objSoapObject, 'StateType')) &&
				($objSoapObject->StateType))
			$objToReturn->StateType = SampleStateTypes::GetObjectFromSoapObject($objSoapObject->StateType);
		if (property_exists($objSoapObject, 'Volume'))
			$objToReturn->fltVolume = $objSoapObject->Volume;
		if (property_exists($objSoapObject, 'VolumeUnit'))
			$objToReturn->strVolumeUnit = $objSoapObject->VolumeUnit;
		if (property_exists($objSoapObject, 'Concentration'))
			$objToReturn->fltConcentration = $objSoapObject->Concentration;
		if (property_exists($objSoapObject, 'ConcentrationUnit'))
			$objToReturn->strConcentrationUnit = $objSoapObject->ConcentrationUnit;
		if (property_exists($objSoapObject, 'StateDate'))
			$objToReturn->dttStateDate = new QDateTime($objSoapObject->StateDate);
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, Sample::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn ?? '') ?? '');
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->objSampleType)
			$objObject->objSampleType = SampleTypes::GetSoapObjectFromObject($objObject->objSampleType, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intSampleTypeId = null;
		if ($objObject->objBox)
			$objObject->objBox = Box::GetSoapObjectFromObject($objObject->objBox, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intBoxId = null;
		if ($objObject->objContainerType)
			$objObject->objContainerType = SampleContainerTypes::GetSoapObjectFromObject($objObject->objContainerType, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intContainerTypeId = null;
		if ($objObject->objStateType)
			$objObject->objStateType = SampleStateTypes::GetSoapObjectFromObject($objObject->objStateType, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intStateTypeId = null;
		if ($objObject->dttStateDate)
			$objObject->dttStateDate = $objObject->dttStateDate->toString(QDateTime::FormatSoap);
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeSample extends QQNode {
	protected $strTableName = 'fm__sample'; public static $strPubTableName = 'fm__sample';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Sample';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'StudyTypeId':
				return new QQNode('study_type_id', 'integer', $this);
			case 'ParticipantId':
				return new QQNode('participant_id', 'integer', $this);
			case 'SampleTypeId':
				return new QQNode('sample_type_id', 'integer', $this);
			case 'SampleType':
				return new QQNodeSampleTypes('sample_type_id', 'integer', $this);
			case 'SampleNumber':
				return new QQNode('sample_number', 'integer', $this);
			case 'Barcode':
				return new QQNode('barcode', 'string', $this);
			case 'StudyCase':
				return new QQNode('study_case', 'string', $this);
			case 'Sampleloc':
				return new QQNode('sampleloc', 'string', $this);
			case 'BoxId':
				return new QQNode('box_id', 'integer', $this);
			case 'Box':
				return new QQNodeBox('box_id', 'integer', $this);
			case 'Notes':
				return new QQNode('notes', 'string', $this);
			case 'BoxSampleSlot':
				return new QQNode('box_sample_slot', 'integer', $this);
			case 'ParentId':
				return new QQNode('parent_id', 'integer', $this);
			case 'ContainerTypeId':
				return new QQNode('container_type_id', 'integer', $this);
			case 'ContainerType':
				return new QQNodeSampleContainerTypes('container_type_id', 'integer', $this);
			case 'StateTypeId':
				return new QQNode('state_type_id', 'integer', $this);
			case 'StateType':
				return new QQNodeSampleStateTypes('state_type_id', 'integer', $this);
			case 'Volume':
				return new QQNode('volume', 'double', $this);
			case 'VolumeUnit':
				return new QQNode('volumeUnit', 'string', $this);
			case 'Concentration':
				return new QQNode('concentration', 'double', $this);
			case 'ConcentrationUnit':
				return new QQNode('concentrationUnit', 'string', $this);
			case 'StateDate':
				return new QQNode('state_date', 'QDateTime', $this);

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

class QQReverseReferenceNodeSample extends QQReverseReferenceNode {
	protected $strTableName = 'fm__sample'; public static $strPubTableName = 'fm__sample';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Sample';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'StudyTypeId':
				return new QQNode('study_type_id', 'integer', $this);
			case 'ParticipantId':
				return new QQNode('participant_id', 'integer', $this);
			case 'SampleTypeId':
				return new QQNode('sample_type_id', 'integer', $this);
			case 'SampleType':
				return new QQNodeSampleTypes('sample_type_id', 'integer', $this);
			case 'SampleNumber':
				return new QQNode('sample_number', 'integer', $this);
			case 'Barcode':
				return new QQNode('barcode', 'string', $this);
			case 'StudyCase':
				return new QQNode('study_case', 'string', $this);
			case 'Sampleloc':
				return new QQNode('sampleloc', 'string', $this);
			case 'BoxId':
				return new QQNode('box_id', 'integer', $this);
			case 'Box':
				return new QQNodeBox('box_id', 'integer', $this);
			case 'Notes':
				return new QQNode('notes', 'string', $this);
			case 'BoxSampleSlot':
				return new QQNode('box_sample_slot', 'integer', $this);
			case 'ParentId':
				return new QQNode('parent_id', 'integer', $this);
			case 'ContainerTypeId':
				return new QQNode('container_type_id', 'integer', $this);
			case 'ContainerType':
				return new QQNodeSampleContainerTypes('container_type_id', 'integer', $this);
			case 'StateTypeId':
				return new QQNode('state_type_id', 'integer', $this);
			case 'StateType':
				return new QQNodeSampleStateTypes('state_type_id', 'integer', $this);
			case 'Volume':
				return new QQNode('volume', 'double', $this);
			case 'VolumeUnit':
				return new QQNode('volumeUnit', 'string', $this);
			case 'Concentration':
				return new QQNode('concentration', 'double', $this);
			case 'ConcentrationUnit':
				return new QQNode('concentrationUnit', 'string', $this);
			case 'StateDate':
				return new QQNode('state_date', 'QDateTime', $this);

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