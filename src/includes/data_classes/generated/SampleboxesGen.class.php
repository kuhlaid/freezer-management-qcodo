<?php
/**
 * The abstract SampleboxesGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Sampleboxes subclass which
 * extends this SampleboxesGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Sampleboxes class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class SampleboxesGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a Sampleboxes from PK Info
	 * @param integer $intId
	 * @return Sampleboxes
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return Sampleboxes::QuerySingle(
				QQ::Equal(QQN::Sampleboxes()->Id, $intId)
		);
	}

	/**
	 * Load all Sampleboxeses
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sampleboxes[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call Sampleboxes::QueryArray to perform the LoadAll query
		try {
			return Sampleboxes::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all Sampleboxeses
	 * @return int
	 */
	public static function CountAll() {
		// Call Sampleboxes::QueryCount to perform the CountAll query
		return Sampleboxes::QueryCount(QQ::All());
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
		$objDatabase = Sampleboxes::GetDatabase();

		// Create/Build out the QueryBuilder object with Sampleboxes-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__sampleboxes');
		Sampleboxes::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__sampleboxes AS fm__sampleboxes');

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
	 * Static Qcodo Query method to query for a single Sampleboxes object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Sampleboxes the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Sampleboxes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new Sampleboxes object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Sampleboxes::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of Sampleboxes objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Sampleboxes[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Sampleboxes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Sampleboxes::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of Sampleboxes objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Sampleboxes::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = Sampleboxes::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'sampleboxes_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Sampleboxes-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	Sampleboxes::GetSelectFields($objQueryBuilder);
	Sampleboxes::GetFromFields($objQueryBuilder);

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
	return Sampleboxes::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this Sampleboxes
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__sampleboxes';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.incounty AS ' . $strAliasPrefix . 'incounty');
			$objBuilder->AddSelectItem($strTableName . '.incountydate AS ' . $strAliasPrefix . 'incountydate');
			$objBuilder->AddSelectItem($strTableName . '.countyuser AS ' . $strAliasPrefix . 'countyuser');
			$objBuilder->AddSelectItem($strTableName . '.chapelhilluser AS ' . $strAliasPrefix . 'chapelhilluser');
			$objBuilder->AddSelectItem($strTableName . '.intransit AS ' . $strAliasPrefix . 'intransit');
			$objBuilder->AddSelectItem($strTableName . '.intransitdate AS ' . $strAliasPrefix . 'intransitdate');
			$objBuilder->AddSelectItem($strTableName . '.trackingnum AS ' . $strAliasPrefix . 'trackingnum');
			$objBuilder->AddSelectItem($strTableName . '.readytoship AS ' . $strAliasPrefix . 'readytoship');
			$objBuilder->AddSelectItem($strTableName . '.readytoshipdate AS ' . $strAliasPrefix . 'readytoshipdate');
			$objBuilder->AddSelectItem($strTableName . '.inchapelhill AS ' . $strAliasPrefix . 'inchapelhill');
			$objBuilder->AddSelectItem($strTableName . '.incdc AS ' . $strAliasPrefix . 'incdc');
			$objBuilder->AddSelectItem($strTableName . '.incdcdate AS ' . $strAliasPrefix . 'incdcdate');
			$objBuilder->AddSelectItem($strTableName . '.cdcuser AS ' . $strAliasPrefix . 'cdcuser');
			$objBuilder->AddSelectItem($strTableName . '.inchapelhilldate AS ' . $strAliasPrefix . 'inchapelhilldate');
			$objBuilder->AddSelectItem($strTableName . '.samptype AS ' . $strAliasPrefix . 'samptype');
			$objBuilder->AddSelectItem($strTableName . '.freezer AS ' . $strAliasPrefix . 'freezer');
			$objBuilder->AddSelectItem($strTableName . '.rack AS ' . $strAliasPrefix . 'rack');
			$objBuilder->AddSelectItem($strTableName . '.box AS ' . $strAliasPrefix . 'box');
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
	 * Instantiate a Sampleboxes from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this Sampleboxes::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return Sampleboxes
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
				$strAliasPrefix = 'sampleboxes__';


			if ((array_key_exists($strAliasPrefix . 'samplelocasbox__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'samplelocasbox__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objSamplelocAsBoxArray)) {
					$objPreviousChildItem = $objPreviousItem->_objSamplelocAsBoxArray[$intPreviousChildItemCount - 1];
					$objChildItem = Sampleloc::InstantiateDbRow($objDbRow, $strAliasPrefix . 'samplelocasbox__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objSamplelocAsBoxArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objSamplelocAsBoxArray, Sampleloc::InstantiateDbRow($objDbRow, $strAliasPrefix . 'samplelocasbox__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'sampleboxes__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the Sampleboxes object
		$objToReturn = new Sampleboxes();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->__intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->intIncounty = $objDbRow->GetColumn($strAliasPrefix . 'incounty', 'Integer');
		$objToReturn->dttIncountydate = $objDbRow->GetColumn($strAliasPrefix . 'incountydate', 'Date');
		$objToReturn->strCountyuser = $objDbRow->GetColumn($strAliasPrefix . 'countyuser', 'VarChar');
		$objToReturn->strChapelhilluser = $objDbRow->GetColumn($strAliasPrefix . 'chapelhilluser', 'VarChar');
		$objToReturn->intIntransit = $objDbRow->GetColumn($strAliasPrefix . 'intransit', 'Integer');
		$objToReturn->dttIntransitdate = $objDbRow->GetColumn($strAliasPrefix . 'intransitdate', 'Date');
		$objToReturn->strTrackingnum = $objDbRow->GetColumn($strAliasPrefix . 'trackingnum', 'VarChar');
		$objToReturn->intReadytoship = $objDbRow->GetColumn($strAliasPrefix . 'readytoship', 'Integer');
		$objToReturn->dttReadytoshipdate = $objDbRow->GetColumn($strAliasPrefix . 'readytoshipdate', 'Date');
		$objToReturn->intInchapelhill = $objDbRow->GetColumn($strAliasPrefix . 'inchapelhill', 'Integer');
		$objToReturn->intIncdc = $objDbRow->GetColumn($strAliasPrefix . 'incdc', 'Integer');
		$objToReturn->dttIncdcdate = $objDbRow->GetColumn($strAliasPrefix . 'incdcdate', 'Date');
		$objToReturn->strCdcuser = $objDbRow->GetColumn($strAliasPrefix . 'cdcuser', 'VarChar');
		$objToReturn->dttInchapelhilldate = $objDbRow->GetColumn($strAliasPrefix . 'inchapelhilldate', 'Date');
		$objToReturn->strSamptype = $objDbRow->GetColumn($strAliasPrefix . 'samptype', 'VarChar');
		$objToReturn->strFreezer = $objDbRow->GetColumn($strAliasPrefix . 'freezer', 'Char');
		$objToReturn->strRack = $objDbRow->GetColumn($strAliasPrefix . 'rack', 'VarChar');
		$objToReturn->strBox = $objDbRow->GetColumn($strAliasPrefix . 'box', 'VarChar');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'sampleboxes__';




		// Check for SamplelocAsBox Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'samplelocasbox__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'samplelocasbox__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objSamplelocAsBoxArray, Sampleloc::InstantiateDbRow($objDbRow, $strAliasPrefix . 'samplelocasbox__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objSamplelocAsBox = Sampleloc::InstantiateDbRow($objDbRow, $strAliasPrefix . 'samplelocasbox__', $strExpandAsArrayNodes);
		}

		return $objToReturn;
	}

	/**
	 * Instantiate an array of Sampleboxeses from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return Sampleboxes[]
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
				$objItem = Sampleboxes::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, Sampleboxes::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single Sampleboxes object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return Sampleboxes
	 */
	public static function LoadById($intId) {
		return Sampleboxes::QuerySingle(
				QQ::Equal(QQN::Sampleboxes()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this Sampleboxes
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return void
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = Sampleboxes::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeSampleboxes::$strPubTableName.' (
						id,
						incounty,
						incountydate,
						countyuser,
						chapelhilluser,
						intransit,
						intransitdate,
						trackingnum,
						readytoship,
						readytoshipdate,
						inchapelhill,
						incdc,
						incdcdate,
						cdcuser,
						inchapelhilldate,
						samptype,
						freezer,
						rack,
						box
				) VALUES (
						' . $objDatabase->SqlVariable($this->intId) . ',
						' . $objDatabase->SqlVariable($this->intIncounty) . ',
						' . $objDatabase->SqlVariable($this->dttIncountydate) . ',
						' . $objDatabase->SqlVariable($this->strCountyuser) . ',
						' . $objDatabase->SqlVariable($this->strChapelhilluser) . ',
						' . $objDatabase->SqlVariable($this->intIntransit) . ',
						' . $objDatabase->SqlVariable($this->dttIntransitdate) . ',
						' . $objDatabase->SqlVariable($this->strTrackingnum) . ',
								' . $objDatabase->SqlVariable($this->intReadytoship) . ',
										' . $objDatabase->SqlVariable($this->dttReadytoshipdate) . ',
												' . $objDatabase->SqlVariable($this->intInchapelhill) . ',
														' . $objDatabase->SqlVariable($this->intIncdc) . ',
																' . $objDatabase->SqlVariable($this->dttIncdcdate) . ',
																		' . $objDatabase->SqlVariable($this->strCdcuser) . ',
																				' . $objDatabase->SqlVariable($this->dttInchapelhilldate) . ',
																						' . $objDatabase->SqlVariable($this->strSamptype) . ',
																								' . $objDatabase->SqlVariable($this->strFreezer) . ',
																										' . $objDatabase->SqlVariable($this->strRack) . ',
																												' . $objDatabase->SqlVariable($this->strBox) . '
																														)
																														');


			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeSampleboxes::$strPubTableName.'
						SET
						id = ' . $objDatabase->SqlVariable($this->intId) . ',
						incounty = ' . $objDatabase->SqlVariable($this->intIncounty) . ',
						incountydate = ' . $objDatabase->SqlVariable($this->dttIncountydate) . ',
						countyuser = ' . $objDatabase->SqlVariable($this->strCountyuser) . ',
						chapelhilluser = ' . $objDatabase->SqlVariable($this->strChapelhilluser) . ',
						intransit = ' . $objDatabase->SqlVariable($this->intIntransit) . ',
						intransitdate = ' . $objDatabase->SqlVariable($this->dttIntransitdate) . ',
						trackingnum = ' . $objDatabase->SqlVariable($this->strTrackingnum) . ',
						readytoship = ' . $objDatabase->SqlVariable($this->intReadytoship) . ',
						readytoshipdate = ' . $objDatabase->SqlVariable($this->dttReadytoshipdate) . ',
								inchapelhill = ' . $objDatabase->SqlVariable($this->intInchapelhill) . ',
										incdc = ' . $objDatabase->SqlVariable($this->intIncdc) . ',
												incdcdate = ' . $objDatabase->SqlVariable($this->dttIncdcdate) . ',
														cdcuser = ' . $objDatabase->SqlVariable($this->strCdcuser) . ',
																inchapelhilldate = ' . $objDatabase->SqlVariable($this->dttInchapelhilldate) . ',
																		samptype = ' . $objDatabase->SqlVariable($this->strSamptype) . ',
																				freezer = ' . $objDatabase->SqlVariable($this->strFreezer) . ',
																						rack = ' . $objDatabase->SqlVariable($this->strRack) . ',
																								box = ' . $objDatabase->SqlVariable($this->strBox) . '
																										WHERE
																										id = ' . $objDatabase->SqlVariable($this->__intId) . '
																												');
			}

		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Update __blnRestored and any Non-Identity PK Columns (if applicable)
		$this->__blnRestored = true;
		$this->__intId = $this->intId;


		// Return
		return $mixToReturn;
	}

	/**
	 * Delete this Sampleboxes
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this Sampleboxes with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = Sampleboxes::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleboxes::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all Sampleboxeses
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = Sampleboxes::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleboxes::$strPubTableName.'');
	}

	/**
	 * Truncate sampleboxes table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = Sampleboxes::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeSampleboxes::$strPubTableName.'');
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
				 * Gets the value for intId (PK)
				 * @return integer
				 */
				return $this->intId;

			case 'Incounty':
				/**
				 * Gets the value for intIncounty (Not Null)
				 * @return integer
				 */
				return $this->intIncounty;

			case 'Incountydate':
				/**
				 * Gets the value for dttIncountydate
				 * @return QDateTime
				 */
				return $this->dttIncountydate;

			case 'Countyuser':
				/**
				 * Gets the value for strCountyuser
				 * @return string
				 */
				return $this->strCountyuser;

			case 'Chapelhilluser':
				/**
				 * Gets the value for strChapelhilluser
				 * @return string
				 */
				return $this->strChapelhilluser;

			case 'Intransit':
				/**
				 * Gets the value for intIntransit
				 * @return integer
				 */
				return $this->intIntransit;

			case 'Intransitdate':
				/**
				 * Gets the value for dttIntransitdate
				 * @return QDateTime
				 */
				return $this->dttIntransitdate;

			case 'Trackingnum':
				/**
				 * Gets the value for strTrackingnum
				 * @return string
				 */
				return $this->strTrackingnum;

			case 'Readytoship':
				/**
				 * Gets the value for intReadytoship (Not Null)
				 * @return integer
				 */
				return $this->intReadytoship;

			case 'Readytoshipdate':
				/**
				 * Gets the value for dttReadytoshipdate
				 * @return QDateTime
				 */
				return $this->dttReadytoshipdate;

			case 'Inchapelhill':
				/**
				 * Gets the value for intInchapelhill
				 * @return integer
				 */
				return $this->intInchapelhill;

			case 'Incdc':
				/**
				 * Gets the value for intIncdc (Not Null)
				 * @return integer
				 */
				return $this->intIncdc;

			case 'Incdcdate':
				/**
				 * Gets the value for dttIncdcdate (Not Null)
				 * @return QDateTime
				 */
				return $this->dttIncdcdate;

			case 'Cdcuser':
				/**
				 * Gets the value for strCdcuser (Not Null)
				 * @return string
				 */
				return $this->strCdcuser;

			case 'Inchapelhilldate':
				/**
				 * Gets the value for dttInchapelhilldate
				 * @return QDateTime
				 */
				return $this->dttInchapelhilldate;

			case 'Samptype':
				/**
				 * Gets the value for strSamptype
				 * @return string
				 */
				return $this->strSamptype;

			case 'Freezer':
				/**
				 * Gets the value for strFreezer
				 * @return string
				 */
				return $this->strFreezer;

			case 'Rack':
				/**
				 * Gets the value for strRack
				 * @return string
				 */
				return $this->strRack;

			case 'Box':
				/**
				 * Gets the value for strBox
				 * @return string
				 */
				return $this->strBox;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_SamplelocAsBox':
				/**
				 * Gets the value for the private _objSamplelocAsBox (Read-Only)
				 * if set due to an expansion on the sampleloc.box_id reverse relationship
				 * @return Sampleloc
				 */
				return $this->_objSamplelocAsBox;

			case '_SamplelocAsBoxArray':
				/**
				 * Gets the value for the private _objSamplelocAsBoxArray (Read-Only)
				 * if set due to an ExpandAsArray on the sampleloc.box_id reverse relationship
				 * @return Sampleloc[]
				 */
				return (array) $this->_objSamplelocAsBoxArray;

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
			case 'Id':
				/**
				 * Sets the value for intId (PK)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Incounty':
				/**
				 * Sets the value for intIncounty (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intIncounty = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Incountydate':
				/**
				 * Sets the value for dttIncountydate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttIncountydate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Countyuser':
				/**
				 * Sets the value for strCountyuser
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strCountyuser = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Chapelhilluser':
				/**
				 * Sets the value for strChapelhilluser
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strChapelhilluser = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Intransit':
				/**
				 * Sets the value for intIntransit
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intIntransit = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Intransitdate':
				/**
				 * Sets the value for dttIntransitdate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttIntransitdate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Trackingnum':
				/**
				 * Sets the value for strTrackingnum
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strTrackingnum = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Readytoship':
				/**
				 * Sets the value for intReadytoship (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intReadytoship = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Readytoshipdate':
				/**
				 * Sets the value for dttReadytoshipdate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttReadytoshipdate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Inchapelhill':
				/**
				 * Sets the value for intInchapelhill
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intInchapelhill = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Incdc':
				/**
				 * Sets the value for intIncdc (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intIncdc = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Incdcdate':
				/**
				 * Sets the value for dttIncdcdate (Not Null)
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttIncdcdate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Cdcuser':
				/**
				 * Sets the value for strCdcuser (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strCdcuser = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Inchapelhilldate':
				/**
				 * Sets the value for dttInchapelhilldate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttInchapelhilldate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Samptype':
				/**
				 * Sets the value for strSamptype
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strSamptype = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Freezer':
				/**
				 * Sets the value for strFreezer
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strFreezer = QType::Cast($mixValue, QType::String));
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

			case 'Box':
				/**
				 * Sets the value for strBox
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strBox = QType::Cast($mixValue, QType::String));
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



	// Related Objects' Methods for SamplelocAsBox
	//-------------------------------------------------------------------

	/**
	 * Gets all associated SamplelocsAsBox as an array of Sampleloc objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sampleloc[]
		*/
	public function GetSamplelocAsBoxArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Sampleloc::LoadArrayByBoxId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated SamplelocsAsBox
	 * @return int
		*/
	public function CountSamplelocsAsBox() {
		if ((is_null($this->intId)))
			return 0;

		return Sampleloc::CountByBoxId($this->intId);
	}

	/**
	 * Associates a SamplelocAsBox
	 * @param Sampleloc $objSampleloc
	 * @return void
		*/
	public function AssociateSamplelocAsBox(Sampleloc $objSampleloc) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSamplelocAsBox on this unsaved Sampleboxes.');
		if ((is_null($objSampleloc->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSamplelocAsBox on this Sampleboxes with an unsaved Sampleloc.');

		// Get the Database Object for this Class
		$objDatabase = Sampleboxes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				fm__sampleloc
				SET
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objSampleloc->Id) . '
				');
	}

	/**
	 * Unassociates a SamplelocAsBox
	 * @param Sampleloc $objSampleloc
	 * @return void
		*/
	public function UnassociateSamplelocAsBox(Sampleloc $objSampleloc) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSamplelocAsBox on this unsaved Sampleboxes.');
		if ((is_null($objSampleloc->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSamplelocAsBox on this Sampleboxes with an unsaved Sampleloc.');

		// Get the Database Object for this Class
		$objDatabase = Sampleboxes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				fm__sampleloc
				SET
				box_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objSampleloc->Id) . ' AND
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all SamplelocsAsBox
	 * @return void
		*/
	public function UnassociateAllSamplelocsAsBox() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSamplelocAsBox on this unsaved Sampleboxes.');

		// Get the Database Object for this Class
		$objDatabase = Sampleboxes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				fm__sampleloc
				SET
				box_id = null
				WHERE
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated SamplelocAsBox
	 * @param Sampleloc $objSampleloc
	 * @return void
		*/
	public function DeleteAssociatedSamplelocAsBox(Sampleloc $objSampleloc) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSamplelocAsBox on this unsaved Sampleboxes.');
		if ((is_null($objSampleloc->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSamplelocAsBox on this Sampleboxes with an unsaved Sampleloc.');

		// Get the Database Object for this Class
		$objDatabase = Sampleboxes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				fm__sampleloc
				WHERE
				id = ' . $objDatabase->SqlVariable($objSampleloc->Id) . ' AND
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated SamplelocsAsBox
	 * @return void
		*/
	public function DeleteAllSamplelocsAsBox() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSamplelocAsBox on this unsaved Sampleboxes.');

		// Get the Database Object for this Class
		$objDatabase = Sampleboxes::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				fm__sampleloc
				WHERE
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK column sampleboxes.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected internal member variable that stores the original version of the PK column value (if restored)
	 * Used by Save() to update a PK column during UPDATE
	 * @var integer __intId;
	 */
	protected $__intId;

	/**
	 * Protected member variable that maps to the database column sampleboxes.incounty
	 * @var integer intIncounty
	 */
	protected $intIncounty;
	const IncountyDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.incountydate
	 * @var QDateTime dttIncountydate
	 */
	protected $dttIncountydate;
	const IncountydateDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.countyuser
	 * @var string strCountyuser
	 */
	protected $strCountyuser;
	const CountyuserMaxLength = 60;
	const CountyuserDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.chapelhilluser
	 * @var string strChapelhilluser
	 */
	protected $strChapelhilluser;
	const ChapelhilluserMaxLength = 60;
	const ChapelhilluserDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.intransit
	 * @var integer intIntransit
	 */
	protected $intIntransit;
	const IntransitDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.intransitdate
	 * @var QDateTime dttIntransitdate
	 */
	protected $dttIntransitdate;
	const IntransitdateDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.trackingnum
	 * @var string strTrackingnum
	 */
	protected $strTrackingnum;
	const TrackingnumMaxLength = 100;
	const TrackingnumDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.readytoship
	 * @var integer intReadytoship
	 */
	protected $intReadytoship;
	const ReadytoshipDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.readytoshipdate
	 * @var QDateTime dttReadytoshipdate
	 */
	protected $dttReadytoshipdate;
	const ReadytoshipdateDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.inchapelhill
	 * @var integer intInchapelhill
	 */
	protected $intInchapelhill;
	const InchapelhillDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.incdc
	 * @var integer intIncdc
	 */
	protected $intIncdc;
	const IncdcDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.incdcdate
	 * @var QDateTime dttIncdcdate
	 */
	protected $dttIncdcdate;
	const IncdcdateDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.cdcuser
	 * @var string strCdcuser
	 */
	protected $strCdcuser;
	const CdcuserMaxLength = 60;
	const CdcuserDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.inchapelhilldate
	 * @var QDateTime dttInchapelhilldate
	 */
	protected $dttInchapelhilldate;
	const InchapelhilldateDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.samptype
	 * @var string strSamptype
	 */
	protected $strSamptype;
	const SamptypeMaxLength = 40;
	const SamptypeDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.freezer
	 * @var string strFreezer
	 */
	protected $strFreezer;
	const FreezerMaxLength = 2;
	const FreezerDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.rack
	 * @var string strRack
	 */
	protected $strRack;
	const RackMaxLength = 4;
	const RackDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleboxes.box
	 * @var string strBox
	 */
	protected $strBox;
	const BoxMaxLength = 8;
	const BoxDefault = null;


	/**
	 * Private member variable that stores a reference to a single SamplelocAsBox object
	 * (of type Sampleloc), if this Sampleboxes object was restored with
	 * an expansion on the sampleloc association table.
	 * @var Sampleloc _objSamplelocAsBox;
	 */
	private $_objSamplelocAsBox;

	/**
	 * Private member variable that stores a reference to an array of SamplelocAsBox objects
	 * (of type Sampleloc[]), if this Sampleboxes object was restored with
	 * an ExpandAsArray on the sampleloc association table.
	 * @var Sampleloc[] _objSamplelocAsBoxArray;
	 */
	private $_objSamplelocAsBoxArray = array();

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
		$strToReturn = '<complexType name="Sampleboxes"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Incounty" type="xsd:int"/>';
		$strToReturn .= '<element name="Incountydate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Countyuser" type="xsd:string"/>';
		$strToReturn .= '<element name="Chapelhilluser" type="xsd:string"/>';
		$strToReturn .= '<element name="Intransit" type="xsd:int"/>';
		$strToReturn .= '<element name="Intransitdate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Trackingnum" type="xsd:string"/>';
		$strToReturn .= '<element name="Readytoship" type="xsd:int"/>';
		$strToReturn .= '<element name="Readytoshipdate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Inchapelhill" type="xsd:int"/>';
		$strToReturn .= '<element name="Incdc" type="xsd:int"/>';
		$strToReturn .= '<element name="Incdcdate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Cdcuser" type="xsd:string"/>';
		$strToReturn .= '<element name="Inchapelhilldate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Samptype" type="xsd:string"/>';
		$strToReturn .= '<element name="Freezer" type="xsd:string"/>';
		$strToReturn .= '<element name="Rack" type="xsd:string"/>';
		$strToReturn .= '<element name="Box" type="xsd:string"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('Sampleboxes', $strComplexTypeArray)) {
			$strComplexTypeArray['Sampleboxes'] = Sampleboxes::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, Sampleboxes::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new Sampleboxes();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Incounty'))
			$objToReturn->intIncounty = $objSoapObject->Incounty;
		if (property_exists($objSoapObject, 'Incountydate'))
			$objToReturn->dttIncountydate = new QDateTime($objSoapObject->Incountydate);
		if (property_exists($objSoapObject, 'Countyuser'))
			$objToReturn->strCountyuser = $objSoapObject->Countyuser;
		if (property_exists($objSoapObject, 'Chapelhilluser'))
			$objToReturn->strChapelhilluser = $objSoapObject->Chapelhilluser;
		if (property_exists($objSoapObject, 'Intransit'))
			$objToReturn->intIntransit = $objSoapObject->Intransit;
		if (property_exists($objSoapObject, 'Intransitdate'))
			$objToReturn->dttIntransitdate = new QDateTime($objSoapObject->Intransitdate);
		if (property_exists($objSoapObject, 'Trackingnum'))
			$objToReturn->strTrackingnum = $objSoapObject->Trackingnum;
		if (property_exists($objSoapObject, 'Readytoship'))
			$objToReturn->intReadytoship = $objSoapObject->Readytoship;
		if (property_exists($objSoapObject, 'Readytoshipdate'))
			$objToReturn->dttReadytoshipdate = new QDateTime($objSoapObject->Readytoshipdate);
		if (property_exists($objSoapObject, 'Inchapelhill'))
			$objToReturn->intInchapelhill = $objSoapObject->Inchapelhill;
		if (property_exists($objSoapObject, 'Incdc'))
			$objToReturn->intIncdc = $objSoapObject->Incdc;
		if (property_exists($objSoapObject, 'Incdcdate'))
			$objToReturn->dttIncdcdate = new QDateTime($objSoapObject->Incdcdate);
		if (property_exists($objSoapObject, 'Cdcuser'))
			$objToReturn->strCdcuser = $objSoapObject->Cdcuser;
		if (property_exists($objSoapObject, 'Inchapelhilldate'))
			$objToReturn->dttInchapelhilldate = new QDateTime($objSoapObject->Inchapelhilldate);
		if (property_exists($objSoapObject, 'Samptype'))
			$objToReturn->strSamptype = $objSoapObject->Samptype;
		if (property_exists($objSoapObject, 'Freezer'))
			$objToReturn->strFreezer = $objSoapObject->Freezer;
		if (property_exists($objSoapObject, 'Rack'))
			$objToReturn->strRack = $objSoapObject->Rack;
		if (property_exists($objSoapObject, 'Box'))
			$objToReturn->strBox = $objSoapObject->Box;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, Sampleboxes::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->dttIncountydate)
			$objObject->dttIncountydate = $objObject->dttIncountydate->toString(QDateTime::FormatSoap);
		if ($objObject->dttIntransitdate)
			$objObject->dttIntransitdate = $objObject->dttIntransitdate->toString(QDateTime::FormatSoap);
		if ($objObject->dttReadytoshipdate)
			$objObject->dttReadytoshipdate = $objObject->dttReadytoshipdate->toString(QDateTime::FormatSoap);
		if ($objObject->dttIncdcdate)
			$objObject->dttIncdcdate = $objObject->dttIncdcdate->toString(QDateTime::FormatSoap);
		if ($objObject->dttInchapelhilldate)
			$objObject->dttInchapelhilldate = $objObject->dttInchapelhilldate->toString(QDateTime::FormatSoap);
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeSampleboxes extends QQNode {
	protected $strTableName = 'fm__sampleboxes'; public static $strPubTableName = 'fm__sampleboxes';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Sampleboxes';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Incounty':
				return new QQNode('incounty', 'integer', $this);
			case 'Incountydate':
				return new QQNode('incountydate', 'QDateTime', $this);
			case 'Countyuser':
				return new QQNode('countyuser', 'string', $this);
			case 'Chapelhilluser':
				return new QQNode('chapelhilluser', 'string', $this);
			case 'Intransit':
				return new QQNode('intransit', 'integer', $this);
			case 'Intransitdate':
				return new QQNode('intransitdate', 'QDateTime', $this);
			case 'Trackingnum':
				return new QQNode('trackingnum', 'string', $this);
			case 'Readytoship':
				return new QQNode('readytoship', 'integer', $this);
			case 'Readytoshipdate':
				return new QQNode('readytoshipdate', 'QDateTime', $this);
			case 'Inchapelhill':
				return new QQNode('inchapelhill', 'integer', $this);
			case 'Incdc':
				return new QQNode('incdc', 'integer', $this);
			case 'Incdcdate':
				return new QQNode('incdcdate', 'QDateTime', $this);
			case 'Cdcuser':
				return new QQNode('cdcuser', 'string', $this);
			case 'Inchapelhilldate':
				return new QQNode('inchapelhilldate', 'QDateTime', $this);
			case 'Samptype':
				return new QQNode('samptype', 'string', $this);
			case 'Freezer':
				return new QQNode('freezer', 'string', $this);
			case 'Rack':
				return new QQNode('rack', 'string', $this);
			case 'Box':
				return new QQNode('box', 'string', $this);
			case 'SamplelocAsBox':
				return new QQReverseReferenceNodeSampleloc($this, 'samplelocasbox', 'reverse_reference', 'box_id');

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

class QQReverseReferenceNodeSampleboxes extends QQReverseReferenceNode {
	protected $strTableName = 'fm__sampleboxes'; public static $strPubTableName = 'fm__sampleboxes';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Sampleboxes';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Incounty':
				return new QQNode('incounty', 'integer', $this);
			case 'Incountydate':
				return new QQNode('incountydate', 'QDateTime', $this);
			case 'Countyuser':
				return new QQNode('countyuser', 'string', $this);
			case 'Chapelhilluser':
				return new QQNode('chapelhilluser', 'string', $this);
			case 'Intransit':
				return new QQNode('intransit', 'integer', $this);
			case 'Intransitdate':
				return new QQNode('intransitdate', 'QDateTime', $this);
			case 'Trackingnum':
				return new QQNode('trackingnum', 'string', $this);
			case 'Readytoship':
				return new QQNode('readytoship', 'integer', $this);
			case 'Readytoshipdate':
				return new QQNode('readytoshipdate', 'QDateTime', $this);
			case 'Inchapelhill':
				return new QQNode('inchapelhill', 'integer', $this);
			case 'Incdc':
				return new QQNode('incdc', 'integer', $this);
			case 'Incdcdate':
				return new QQNode('incdcdate', 'QDateTime', $this);
			case 'Cdcuser':
				return new QQNode('cdcuser', 'string', $this);
			case 'Inchapelhilldate':
				return new QQNode('inchapelhilldate', 'QDateTime', $this);
			case 'Samptype':
				return new QQNode('samptype', 'string', $this);
			case 'Freezer':
				return new QQNode('freezer', 'string', $this);
			case 'Rack':
				return new QQNode('rack', 'string', $this);
			case 'Box':
				return new QQNode('box', 'string', $this);
			case 'SamplelocAsBox':
				return new QQReverseReferenceNodeSampleloc($this, 'samplelocasbox', 'reverse_reference', 'box_id');

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