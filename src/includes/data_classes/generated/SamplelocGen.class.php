<?php
/**
 * The abstract SamplelocGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Sampleloc subclass which
 * extends this SamplelocGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Sampleloc class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class SamplelocGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a Sampleloc from PK Info
	 * @param integer $intId
	 * @return Sampleloc
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return Sampleloc::QuerySingle(
				QQ::Equal(QQN::Sampleloc()->Id, $intId)
		);
	}

	/**
	 * Load all Samplelocs
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sampleloc[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call Sampleloc::QueryArray to perform the LoadAll query
		try {
			return Sampleloc::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all Samplelocs
	 * @return int
	 */
	public static function CountAll() {
		// Call Sampleloc::QueryCount to perform the CountAll query
		return Sampleloc::QueryCount(QQ::All());
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
		$objDatabase = Sampleloc::GetDatabase();

		// Create/Build out the QueryBuilder object with Sampleloc-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__sampleloc');
		Sampleloc::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__sampleloc AS fm__sampleloc');

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
	 * Static Qcodo Query method to query for a single Sampleloc object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Sampleloc the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Sampleloc::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new Sampleloc object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Sampleloc::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of Sampleloc objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Sampleloc[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Sampleloc::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Sampleloc::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of Sampleloc objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Sampleloc::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = Sampleloc::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'sampleloc_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Sampleloc-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	Sampleloc::GetSelectFields($objQueryBuilder);
	Sampleloc::GetFromFields($objQueryBuilder);

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
	return Sampleloc::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this Sampleloc
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__sampleloc';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.box_id AS ' . $strAliasPrefix . 'box_id');
			$objBuilder->AddSelectItem($strTableName . '.samptype AS ' . $strAliasPrefix . 'samptype');
			$objBuilder->AddSelectItem($strTableName . '.[A0] AS ' . $strAliasPrefix . 'A0');
			$objBuilder->AddSelectItem($strTableName . '.[A1] AS ' . $strAliasPrefix . 'A1');
			$objBuilder->AddSelectItem($strTableName . '.[A2] AS ' . $strAliasPrefix . 'A2');
			$objBuilder->AddSelectItem($strTableName . '.[A3] AS ' . $strAliasPrefix . 'A3');
			$objBuilder->AddSelectItem($strTableName . '.[A4] AS ' . $strAliasPrefix . 'A4');
			$objBuilder->AddSelectItem($strTableName . '.[A5] AS ' . $strAliasPrefix . 'A5');
			$objBuilder->AddSelectItem($strTableName . '.[A6] AS ' . $strAliasPrefix . 'A6');
			$objBuilder->AddSelectItem($strTableName . '.[A7] AS ' . $strAliasPrefix . 'A7');
			$objBuilder->AddSelectItem($strTableName . '.[A8] AS ' . $strAliasPrefix . 'A8');
			$objBuilder->AddSelectItem($strTableName . '.[B0] AS ' . $strAliasPrefix . 'B0');
			$objBuilder->AddSelectItem($strTableName . '.[B1] AS ' . $strAliasPrefix . 'B1');
			$objBuilder->AddSelectItem($strTableName . '.[B2] AS ' . $strAliasPrefix . 'B2');
			$objBuilder->AddSelectItem($strTableName . '.[B3] AS ' . $strAliasPrefix . 'B3');
			$objBuilder->AddSelectItem($strTableName . '.[B4] AS ' . $strAliasPrefix . 'B4');
			$objBuilder->AddSelectItem($strTableName . '.[B5] AS ' . $strAliasPrefix . 'B5');
			$objBuilder->AddSelectItem($strTableName . '.[B6] AS ' . $strAliasPrefix . 'B6');
			$objBuilder->AddSelectItem($strTableName . '.[B7] AS ' . $strAliasPrefix . 'B7');
			$objBuilder->AddSelectItem($strTableName . '.[B8] AS ' . $strAliasPrefix . 'B8');
			$objBuilder->AddSelectItem($strTableName . '.[C0] AS ' . $strAliasPrefix . 'C0');
			$objBuilder->AddSelectItem($strTableName . '.[C1] AS ' . $strAliasPrefix . 'C1');
			$objBuilder->AddSelectItem($strTableName . '.[C2] AS ' . $strAliasPrefix . 'C2');
			$objBuilder->AddSelectItem($strTableName . '.[C3] AS ' . $strAliasPrefix . 'C3');
			$objBuilder->AddSelectItem($strTableName . '.[C4] AS ' . $strAliasPrefix . 'C4');
			$objBuilder->AddSelectItem($strTableName . '.[C5] AS ' . $strAliasPrefix . 'C5');
			$objBuilder->AddSelectItem($strTableName . '.[C6] AS ' . $strAliasPrefix . 'C6');
			$objBuilder->AddSelectItem($strTableName . '.[C7] AS ' . $strAliasPrefix . 'C7');
			$objBuilder->AddSelectItem($strTableName . '.[C8] AS ' . $strAliasPrefix . 'C8');
			$objBuilder->AddSelectItem($strTableName . '.[D0] AS ' . $strAliasPrefix . 'D0');
			$objBuilder->AddSelectItem($strTableName . '.[D1] AS ' . $strAliasPrefix . 'D1');
			$objBuilder->AddSelectItem($strTableName . '.[D2] AS ' . $strAliasPrefix . 'D2');
			$objBuilder->AddSelectItem($strTableName . '.[D3] AS ' . $strAliasPrefix . 'D3');
			$objBuilder->AddSelectItem($strTableName . '.[D4] AS ' . $strAliasPrefix . 'D4');
			$objBuilder->AddSelectItem($strTableName . '.[D5] AS ' . $strAliasPrefix . 'D5');
			$objBuilder->AddSelectItem($strTableName . '.[D6] AS ' . $strAliasPrefix . 'D6');
			$objBuilder->AddSelectItem($strTableName . '.[D7] AS ' . $strAliasPrefix . 'D7');
			$objBuilder->AddSelectItem($strTableName . '.[D8] AS ' . $strAliasPrefix . 'D8');
			$objBuilder->AddSelectItem($strTableName . '.[E0] AS ' . $strAliasPrefix . 'E0');
			$objBuilder->AddSelectItem($strTableName . '.[E1] AS ' . $strAliasPrefix . 'E1');
			$objBuilder->AddSelectItem($strTableName . '.[E2] AS ' . $strAliasPrefix . 'E2');
			$objBuilder->AddSelectItem($strTableName . '.[E3] AS ' . $strAliasPrefix . 'E3');
			$objBuilder->AddSelectItem($strTableName . '.[E4] AS ' . $strAliasPrefix . 'E4');
			$objBuilder->AddSelectItem($strTableName . '.[E5] AS ' . $strAliasPrefix . 'E5');
			$objBuilder->AddSelectItem($strTableName . '.[E6] AS ' . $strAliasPrefix . 'E6');
			$objBuilder->AddSelectItem($strTableName . '.[E7] AS ' . $strAliasPrefix . 'E7');
			$objBuilder->AddSelectItem($strTableName . '.[E8] AS ' . $strAliasPrefix . 'E8');
			$objBuilder->AddSelectItem($strTableName . '.[F0] AS ' . $strAliasPrefix . 'F0');
			$objBuilder->AddSelectItem($strTableName . '.[F1] AS ' . $strAliasPrefix . 'F1');
			$objBuilder->AddSelectItem($strTableName . '.[F2] AS ' . $strAliasPrefix . 'F2');
			$objBuilder->AddSelectItem($strTableName . '.[F3] AS ' . $strAliasPrefix . 'F3');
			$objBuilder->AddSelectItem($strTableName . '.[F4] AS ' . $strAliasPrefix . 'F4');
			$objBuilder->AddSelectItem($strTableName . '.[F5] AS ' . $strAliasPrefix . 'F5');
			$objBuilder->AddSelectItem($strTableName . '.[F6] AS ' . $strAliasPrefix . 'F6');
			$objBuilder->AddSelectItem($strTableName . '.[F7] AS ' . $strAliasPrefix . 'F7');
			$objBuilder->AddSelectItem($strTableName . '.[F8] AS ' . $strAliasPrefix . 'F8');
			$objBuilder->AddSelectItem($strTableName . '.[G0] AS ' . $strAliasPrefix . 'G0');
			$objBuilder->AddSelectItem($strTableName . '.[G1] AS ' . $strAliasPrefix . 'G1');
			$objBuilder->AddSelectItem($strTableName . '.[G2] AS ' . $strAliasPrefix . 'G2');
			$objBuilder->AddSelectItem($strTableName . '.[G3] AS ' . $strAliasPrefix . 'G3');
			$objBuilder->AddSelectItem($strTableName . '.[G4] AS ' . $strAliasPrefix . 'G4');
			$objBuilder->AddSelectItem($strTableName . '.[G5] AS ' . $strAliasPrefix . 'G5');
			$objBuilder->AddSelectItem($strTableName . '.[G6] AS ' . $strAliasPrefix . 'G6');
			$objBuilder->AddSelectItem($strTableName . '.[G7] AS ' . $strAliasPrefix . 'G7');
			$objBuilder->AddSelectItem($strTableName . '.[G8] AS ' . $strAliasPrefix . 'G8');
			$objBuilder->AddSelectItem($strTableName . '.[H0] AS ' . $strAliasPrefix . 'H0');
			$objBuilder->AddSelectItem($strTableName . '.[H1] AS ' . $strAliasPrefix . 'H1');
			$objBuilder->AddSelectItem($strTableName . '.[H2] AS ' . $strAliasPrefix . 'H2');
			$objBuilder->AddSelectItem($strTableName . '.[H3] AS ' . $strAliasPrefix . 'H3');
			$objBuilder->AddSelectItem($strTableName . '.[H4] AS ' . $strAliasPrefix . 'H4');
			$objBuilder->AddSelectItem($strTableName . '.[H5] AS ' . $strAliasPrefix . 'H5');
			$objBuilder->AddSelectItem($strTableName . '.[H6] AS ' . $strAliasPrefix . 'H6');
			$objBuilder->AddSelectItem($strTableName . '.[H7] AS ' . $strAliasPrefix . 'H7');
			$objBuilder->AddSelectItem($strTableName . '.[H8] AS ' . $strAliasPrefix . 'H8');
			$objBuilder->AddSelectItem($strTableName . '.[I0] AS ' . $strAliasPrefix . 'I0');
			$objBuilder->AddSelectItem($strTableName . '.[I1] AS ' . $strAliasPrefix . 'I1');
			$objBuilder->AddSelectItem($strTableName . '.[I2] AS ' . $strAliasPrefix . 'I2');
			$objBuilder->AddSelectItem($strTableName . '.[I3] AS ' . $strAliasPrefix . 'I3');
			$objBuilder->AddSelectItem($strTableName . '.[I4] AS ' . $strAliasPrefix . 'I4');
			$objBuilder->AddSelectItem($strTableName . '.[I5] AS ' . $strAliasPrefix . 'I5');
			$objBuilder->AddSelectItem($strTableName . '.[I6] AS ' . $strAliasPrefix . 'I6');
			$objBuilder->AddSelectItem($strTableName . '.[I7] AS ' . $strAliasPrefix . 'I7');
			$objBuilder->AddSelectItem($strTableName . '.[I8] AS ' . $strAliasPrefix . 'I8');
			$objBuilder->AddSelectItem($strTableName . '.username AS ' . $strAliasPrefix . 'username');
			$objBuilder->AddSelectItem($strTableName . '.date AS ' . $strAliasPrefix . 'date');
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
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
	 * Instantiate a Sampleloc from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this Sampleloc::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return Sampleloc
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;


		// Create a new instance of the Sampleloc object
		$objToReturn = new Sampleloc();
		$objToReturn->__blnRestored = true;

		$objToReturn->intBoxId = $objDbRow->GetColumn($strAliasPrefix . 'box_id', 'Integer');
		$objToReturn->strSamptype = $objDbRow->GetColumn($strAliasPrefix . 'samptype', 'VarChar');
		$objToReturn->strA0 = $objDbRow->GetColumn($strAliasPrefix . 'A0', 'VarChar');
		$objToReturn->strA1 = $objDbRow->GetColumn($strAliasPrefix . 'A1', 'VarChar');
		$objToReturn->strA2 = $objDbRow->GetColumn($strAliasPrefix . 'A2', 'VarChar');
		$objToReturn->strA3 = $objDbRow->GetColumn($strAliasPrefix . 'A3', 'VarChar');
		$objToReturn->strA4 = $objDbRow->GetColumn($strAliasPrefix . 'A4', 'VarChar');
		$objToReturn->strA5 = $objDbRow->GetColumn($strAliasPrefix . 'A5', 'VarChar');
		$objToReturn->strA6 = $objDbRow->GetColumn($strAliasPrefix . 'A6', 'VarChar');
		$objToReturn->strA7 = $objDbRow->GetColumn($strAliasPrefix . 'A7', 'VarChar');
		$objToReturn->strA8 = $objDbRow->GetColumn($strAliasPrefix . 'A8', 'VarChar');
		$objToReturn->strB0 = $objDbRow->GetColumn($strAliasPrefix . 'B0', 'VarChar');
		$objToReturn->strB1 = $objDbRow->GetColumn($strAliasPrefix . 'B1', 'VarChar');
		$objToReturn->strB2 = $objDbRow->GetColumn($strAliasPrefix . 'B2', 'VarChar');
		$objToReturn->strB3 = $objDbRow->GetColumn($strAliasPrefix . 'B3', 'VarChar');
		$objToReturn->strB4 = $objDbRow->GetColumn($strAliasPrefix . 'B4', 'VarChar');
		$objToReturn->strB5 = $objDbRow->GetColumn($strAliasPrefix . 'B5', 'VarChar');
		$objToReturn->strB6 = $objDbRow->GetColumn($strAliasPrefix . 'B6', 'VarChar');
		$objToReturn->strB7 = $objDbRow->GetColumn($strAliasPrefix . 'B7', 'VarChar');
		$objToReturn->strB8 = $objDbRow->GetColumn($strAliasPrefix . 'B8', 'VarChar');
		$objToReturn->strC0 = $objDbRow->GetColumn($strAliasPrefix . 'C0', 'VarChar');
		$objToReturn->strC1 = $objDbRow->GetColumn($strAliasPrefix . 'C1', 'VarChar');
		$objToReturn->strC2 = $objDbRow->GetColumn($strAliasPrefix . 'C2', 'VarChar');
		$objToReturn->strC3 = $objDbRow->GetColumn($strAliasPrefix . 'C3', 'VarChar');
		$objToReturn->strC4 = $objDbRow->GetColumn($strAliasPrefix . 'C4', 'VarChar');
		$objToReturn->strC5 = $objDbRow->GetColumn($strAliasPrefix . 'C5', 'VarChar');
		$objToReturn->strC6 = $objDbRow->GetColumn($strAliasPrefix . 'C6', 'VarChar');
		$objToReturn->strC7 = $objDbRow->GetColumn($strAliasPrefix . 'C7', 'VarChar');
		$objToReturn->strC8 = $objDbRow->GetColumn($strAliasPrefix . 'C8', 'VarChar');
		$objToReturn->strD0 = $objDbRow->GetColumn($strAliasPrefix . 'D0', 'VarChar');
		$objToReturn->strD1 = $objDbRow->GetColumn($strAliasPrefix . 'D1', 'VarChar');
		$objToReturn->strD2 = $objDbRow->GetColumn($strAliasPrefix . 'D2', 'VarChar');
		$objToReturn->strD3 = $objDbRow->GetColumn($strAliasPrefix . 'D3', 'VarChar');
		$objToReturn->strD4 = $objDbRow->GetColumn($strAliasPrefix . 'D4', 'VarChar');
		$objToReturn->strD5 = $objDbRow->GetColumn($strAliasPrefix . 'D5', 'VarChar');
		$objToReturn->strD6 = $objDbRow->GetColumn($strAliasPrefix . 'D6', 'VarChar');
		$objToReturn->strD7 = $objDbRow->GetColumn($strAliasPrefix . 'D7', 'VarChar');
		$objToReturn->strD8 = $objDbRow->GetColumn($strAliasPrefix . 'D8', 'VarChar');
		$objToReturn->strE0 = $objDbRow->GetColumn($strAliasPrefix . 'E0', 'VarChar');
		$objToReturn->strE1 = $objDbRow->GetColumn($strAliasPrefix . 'E1', 'VarChar');
		$objToReturn->strE2 = $objDbRow->GetColumn($strAliasPrefix . 'E2', 'VarChar');
		$objToReturn->strE3 = $objDbRow->GetColumn($strAliasPrefix . 'E3', 'VarChar');
		$objToReturn->strE4 = $objDbRow->GetColumn($strAliasPrefix . 'E4', 'VarChar');
		$objToReturn->strE5 = $objDbRow->GetColumn($strAliasPrefix . 'E5', 'VarChar');
		$objToReturn->strE6 = $objDbRow->GetColumn($strAliasPrefix . 'E6', 'VarChar');
		$objToReturn->strE7 = $objDbRow->GetColumn($strAliasPrefix . 'E7', 'VarChar');
		$objToReturn->strE8 = $objDbRow->GetColumn($strAliasPrefix . 'E8', 'VarChar');
		$objToReturn->strF0 = $objDbRow->GetColumn($strAliasPrefix . 'F0', 'VarChar');
		$objToReturn->strF1 = $objDbRow->GetColumn($strAliasPrefix . 'F1', 'VarChar');
		$objToReturn->strF2 = $objDbRow->GetColumn($strAliasPrefix . 'F2', 'VarChar');
		$objToReturn->strF3 = $objDbRow->GetColumn($strAliasPrefix . 'F3', 'VarChar');
		$objToReturn->strF4 = $objDbRow->GetColumn($strAliasPrefix . 'F4', 'VarChar');
		$objToReturn->strF5 = $objDbRow->GetColumn($strAliasPrefix . 'F5', 'VarChar');
		$objToReturn->strF6 = $objDbRow->GetColumn($strAliasPrefix . 'F6', 'VarChar');
		$objToReturn->strF7 = $objDbRow->GetColumn($strAliasPrefix . 'F7', 'VarChar');
		$objToReturn->strF8 = $objDbRow->GetColumn($strAliasPrefix . 'F8', 'VarChar');
		$objToReturn->strG0 = $objDbRow->GetColumn($strAliasPrefix . 'G0', 'VarChar');
		$objToReturn->strG1 = $objDbRow->GetColumn($strAliasPrefix . 'G1', 'VarChar');
		$objToReturn->strG2 = $objDbRow->GetColumn($strAliasPrefix . 'G2', 'VarChar');
		$objToReturn->strG3 = $objDbRow->GetColumn($strAliasPrefix . 'G3', 'VarChar');
		$objToReturn->strG4 = $objDbRow->GetColumn($strAliasPrefix . 'G4', 'VarChar');
		$objToReturn->strG5 = $objDbRow->GetColumn($strAliasPrefix . 'G5', 'VarChar');
		$objToReturn->strG6 = $objDbRow->GetColumn($strAliasPrefix . 'G6', 'VarChar');
		$objToReturn->strG7 = $objDbRow->GetColumn($strAliasPrefix . 'G7', 'VarChar');
		$objToReturn->strG8 = $objDbRow->GetColumn($strAliasPrefix . 'G8', 'VarChar');
		$objToReturn->strH0 = $objDbRow->GetColumn($strAliasPrefix . 'H0', 'VarChar');
		$objToReturn->strH1 = $objDbRow->GetColumn($strAliasPrefix . 'H1', 'VarChar');
		$objToReturn->strH2 = $objDbRow->GetColumn($strAliasPrefix . 'H2', 'VarChar');
		$objToReturn->strH3 = $objDbRow->GetColumn($strAliasPrefix . 'H3', 'VarChar');
		$objToReturn->strH4 = $objDbRow->GetColumn($strAliasPrefix . 'H4', 'VarChar');
		$objToReturn->strH5 = $objDbRow->GetColumn($strAliasPrefix . 'H5', 'VarChar');
		$objToReturn->strH6 = $objDbRow->GetColumn($strAliasPrefix . 'H6', 'VarChar');
		$objToReturn->strH7 = $objDbRow->GetColumn($strAliasPrefix . 'H7', 'VarChar');
		$objToReturn->strH8 = $objDbRow->GetColumn($strAliasPrefix . 'H8', 'VarChar');
		$objToReturn->strI0 = $objDbRow->GetColumn($strAliasPrefix . 'I0', 'VarChar');
		$objToReturn->strI1 = $objDbRow->GetColumn($strAliasPrefix . 'I1', 'VarChar');
		$objToReturn->strI2 = $objDbRow->GetColumn($strAliasPrefix . 'I2', 'VarChar');
		$objToReturn->strI3 = $objDbRow->GetColumn($strAliasPrefix . 'I3', 'VarChar');
		$objToReturn->strI4 = $objDbRow->GetColumn($strAliasPrefix . 'I4', 'VarChar');
		$objToReturn->strI5 = $objDbRow->GetColumn($strAliasPrefix . 'I5', 'VarChar');
		$objToReturn->strI6 = $objDbRow->GetColumn($strAliasPrefix . 'I6', 'VarChar');
		$objToReturn->strI7 = $objDbRow->GetColumn($strAliasPrefix . 'I7', 'VarChar');
		$objToReturn->strI8 = $objDbRow->GetColumn($strAliasPrefix . 'I8', 'VarChar');
		$objToReturn->strUsername = $objDbRow->GetColumn($strAliasPrefix . 'username', 'VarChar');
		$objToReturn->dttDate = $objDbRow->GetColumn($strAliasPrefix . 'date', 'Date');
		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'sampleloc__';

		// Check for Box Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'box_id__id')))
			$objToReturn->objBox = Sampleboxes::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box_id__', $strExpandAsArrayNodes);




		return $objToReturn;
	}

	/**
	 * Instantiate an array of Samplelocs from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return Sampleloc[]
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
				$objItem = Sampleloc::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, Sampleloc::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single Sampleloc object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return Sampleloc
	 */
	public static function LoadById($intId) {
		return Sampleloc::QuerySingle(
				QQ::Equal(QQN::Sampleloc()->Id, $intId)
		);
	}

	/**
	 * Load an array of Sampleloc objects,
	 * by BoxId Index(es)
	 * @param integer $intBoxId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sampleloc[]
		*/
	public static function LoadArrayByBoxId($intBoxId, $objOptionalClauses = null) {
		// Call Sampleloc::QueryArray to perform the LoadArrayByBoxId query
		try {
			return Sampleloc::QueryArray(
					QQ::Equal(QQN::Sampleloc()->BoxId, $intBoxId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Samplelocs
	 * by BoxId Index(es)
	 * @param integer $intBoxId
	 * @return int
		*/
	public static function CountByBoxId($intBoxId) {
		// Call Sampleloc::QueryCount to perform the CountByBoxId query
		return Sampleloc::QueryCount(
				QQ::Equal(QQN::Sampleloc()->BoxId, $intBoxId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this Sampleloc
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = Sampleloc::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeSampleloc::$strPubTableName.' (
						box_id,
						samptype,
						[A0],
						[A1],
						[A2],
						[A3],
						[A4],
						[A5],
						[A6],
						[A7],
						[A8],
						[B0],
						[B1],
						[B2],
						[B3],
						[B4],
						[B5],
						[B6],
						[B7],
						[B8],
						[C0],
						[C1],
						[C2],
						[C3],
						[C4],
						[C5],
						[C6],
						[C7],
						[C8],
						[D0],
						[D1],
						[D2],
						[D3],
						[D4],
						[D5],
						[D6],
						[D7],
						[D8],
						[E0],
						[E1],
						[E2],
						[E3],
						[E4],
						[E5],
						[E6],
						[E7],
						[E8],
						[F0],
						[F1],
						[F2],
						[F3],
						[F4],
						[F5],
						[F6],
						[F7],
						[F8],
						[G0],
						[G1],
						[G2],
						[G3],
						[G4],
						[G5],
						[G6],
						[G7],
						[G8],
						[H0],
						[H1],
						[H2],
						[H3],
						[H4],
						[H5],
						[H6],
						[H7],
						[H8],
						[I0],
						[I1],
						[I2],
						[I3],
						[I4],
						[I5],
						[I6],
						[I7],
						[I8],
						username,
						date
						) VALUES (
						' . $objDatabase->SqlVariable($this->intBoxId) . ',
								' . $objDatabase->SqlVariable($this->strSamptype) . ',
										' . $objDatabase->SqlVariable($this->strA0) . ',
												' . $objDatabase->SqlVariable($this->strA1) . ',
														' . $objDatabase->SqlVariable($this->strA2) . ',
																' . $objDatabase->SqlVariable($this->strA3) . ',
																		' . $objDatabase->SqlVariable($this->strA4) . ',
																				' . $objDatabase->SqlVariable($this->strA5) . ',
																						' . $objDatabase->SqlVariable($this->strA6) . ',
																								' . $objDatabase->SqlVariable($this->strA7) . ',
																										' . $objDatabase->SqlVariable($this->strA8) . ',
																												' . $objDatabase->SqlVariable($this->strB0) . ',
																														' . $objDatabase->SqlVariable($this->strB1) . ',
																																' . $objDatabase->SqlVariable($this->strB2) . ',
																																		' . $objDatabase->SqlVariable($this->strB3) . ',
																																				' . $objDatabase->SqlVariable($this->strB4) . ',
																																						' . $objDatabase->SqlVariable($this->strB5) . ',
																																								' . $objDatabase->SqlVariable($this->strB6) . ',
																																										' . $objDatabase->SqlVariable($this->strB7) . ',
																																												' . $objDatabase->SqlVariable($this->strB8) . ',
																																														' . $objDatabase->SqlVariable($this->strC0) . ',
																																																' . $objDatabase->SqlVariable($this->strC1) . ',
																																																		' . $objDatabase->SqlVariable($this->strC2) . ',
																																																				' . $objDatabase->SqlVariable($this->strC3) . ',
																																																						' . $objDatabase->SqlVariable($this->strC4) . ',
																																																								' . $objDatabase->SqlVariable($this->strC5) . ',
																																																										' . $objDatabase->SqlVariable($this->strC6) . ',
																																																												' . $objDatabase->SqlVariable($this->strC7) . ',
																																																														' . $objDatabase->SqlVariable($this->strC8) . ',
																																																																' . $objDatabase->SqlVariable($this->strD0) . ',
																																																																		' . $objDatabase->SqlVariable($this->strD1) . ',
																																																																				' . $objDatabase->SqlVariable($this->strD2) . ',
																																																																						' . $objDatabase->SqlVariable($this->strD3) . ',
																																																																								' . $objDatabase->SqlVariable($this->strD4) . ',
																																																																										' . $objDatabase->SqlVariable($this->strD5) . ',
																																																																												' . $objDatabase->SqlVariable($this->strD6) . ',
																																																																														' . $objDatabase->SqlVariable($this->strD7) . ',
																																																																																' . $objDatabase->SqlVariable($this->strD8) . ',
																																																																																		' . $objDatabase->SqlVariable($this->strE0) . ',
																																																																																				' . $objDatabase->SqlVariable($this->strE1) . ',
																																																																																						' . $objDatabase->SqlVariable($this->strE2) . ',
																																																																																								' . $objDatabase->SqlVariable($this->strE3) . ',
																																																																																										' . $objDatabase->SqlVariable($this->strE4) . ',
																																																																																												' . $objDatabase->SqlVariable($this->strE5) . ',
																																																																																														' . $objDatabase->SqlVariable($this->strE6) . ',
																																																																																																' . $objDatabase->SqlVariable($this->strE7) . ',
																																																																																																		' . $objDatabase->SqlVariable($this->strE8) . ',
																																																																																																				' . $objDatabase->SqlVariable($this->strF0) . ',
																																																																																																						' . $objDatabase->SqlVariable($this->strF1) . ',
																																																																																																								' . $objDatabase->SqlVariable($this->strF2) . ',
																																																																																																										' . $objDatabase->SqlVariable($this->strF3) . ',
																																																																																																												' . $objDatabase->SqlVariable($this->strF4) . ',
																																																																																																														' . $objDatabase->SqlVariable($this->strF5) . ',
																																																																																																																' . $objDatabase->SqlVariable($this->strF6) . ',
																																																																																																																		' . $objDatabase->SqlVariable($this->strF7) . ',
																																																																																																																				' . $objDatabase->SqlVariable($this->strF8) . ',
																																																																																																																						' . $objDatabase->SqlVariable($this->strG0) . ',
																																																																																																																								' . $objDatabase->SqlVariable($this->strG1) . ',
																																																																																																																										' . $objDatabase->SqlVariable($this->strG2) . ',
																																																																																																																												' . $objDatabase->SqlVariable($this->strG3) . ',
																																																																																																																														' . $objDatabase->SqlVariable($this->strG4) . ',
																																																																																																																																' . $objDatabase->SqlVariable($this->strG5) . ',
																																																																																																																																		' . $objDatabase->SqlVariable($this->strG6) . ',
																																																																																																																																				' . $objDatabase->SqlVariable($this->strG7) . ',
																																																																																																																																						' . $objDatabase->SqlVariable($this->strG8) . ',
																																																																																																																																								' . $objDatabase->SqlVariable($this->strH0) . ',
																																																																																																																																										' . $objDatabase->SqlVariable($this->strH1) . ',
																																																																																																																																												' . $objDatabase->SqlVariable($this->strH2) . ',
																																																																																																																																														' . $objDatabase->SqlVariable($this->strH3) . ',
																																																																																																																																																' . $objDatabase->SqlVariable($this->strH4) . ',
																																																																																																																																																		' . $objDatabase->SqlVariable($this->strH5) . ',
																																																																																																																																																				' . $objDatabase->SqlVariable($this->strH6) . ',
																																																																																																																																																						' . $objDatabase->SqlVariable($this->strH7) . ',
																																																																																																																																																								' . $objDatabase->SqlVariable($this->strH8) . ',
																																																																																																																																																										' . $objDatabase->SqlVariable($this->strI0) . ',
																																																																																																																																																												' . $objDatabase->SqlVariable($this->strI1) . ',
																																																																																																																																																														' . $objDatabase->SqlVariable($this->strI2) . ',
																																																																																																																																																																' . $objDatabase->SqlVariable($this->strI3) . ',
																																																																																																																																																																		' . $objDatabase->SqlVariable($this->strI4) . ',
																																																																																																																																																																				' . $objDatabase->SqlVariable($this->strI5) . ',
																																																																																																																																																																						' . $objDatabase->SqlVariable($this->strI6) . ',
																																																																																																																																																																								' . $objDatabase->SqlVariable($this->strI7) . ',
																																																																																																																																																																										' . $objDatabase->SqlVariable($this->strI8) . ',
																																																																																																																																																																												' . $objDatabase->SqlVariable($this->strUsername) . ',
																																																																																																																																																																														' . $objDatabase->SqlVariable($this->dttDate) . '
																																																																																																																																																																																)
																																																																																																																																																																																');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeSampleloc::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeSampleloc::$strPubTableName.'
						SET
						box_id = ' . $objDatabase->SqlVariable($this->intBoxId) . ',
						samptype = ' . $objDatabase->SqlVariable($this->strSamptype) . ',
						[A0] = ' . $objDatabase->SqlVariable($this->strA0) . ',
						[A1] = ' . $objDatabase->SqlVariable($this->strA1) . ',
						[A2] = ' . $objDatabase->SqlVariable($this->strA2) . ',
						[A3] = ' . $objDatabase->SqlVariable($this->strA3) . ',
						[A4] = ' . $objDatabase->SqlVariable($this->strA4) . ',
						[A5] = ' . $objDatabase->SqlVariable($this->strA5) . ',
						[A6] = ' . $objDatabase->SqlVariable($this->strA6) . ',
						[A7] = ' . $objDatabase->SqlVariable($this->strA7) . ',
						[A8] = ' . $objDatabase->SqlVariable($this->strA8) . ',
						[B0] = ' . $objDatabase->SqlVariable($this->strB0) . ',
						[B1] = ' . $objDatabase->SqlVariable($this->strB1) . ',
								[B2] = ' . $objDatabase->SqlVariable($this->strB2) . ',
										[B3] = ' . $objDatabase->SqlVariable($this->strB3) . ',
												[B4] = ' . $objDatabase->SqlVariable($this->strB4) . ',
														[B5] = ' . $objDatabase->SqlVariable($this->strB5) . ',
																[B6] = ' . $objDatabase->SqlVariable($this->strB6) . ',
																		[B7] = ' . $objDatabase->SqlVariable($this->strB7) . ',
																				[B8] = ' . $objDatabase->SqlVariable($this->strB8) . ',
																						[C0] = ' . $objDatabase->SqlVariable($this->strC0) . ',
																								[C1] = ' . $objDatabase->SqlVariable($this->strC1) . ',
																										[C2] = ' . $objDatabase->SqlVariable($this->strC2) . ',
																												[C3] = ' . $objDatabase->SqlVariable($this->strC3) . ',
																														[C4] = ' . $objDatabase->SqlVariable($this->strC4) . ',
																																[C5] = ' . $objDatabase->SqlVariable($this->strC5) . ',
																																		[C6] = ' . $objDatabase->SqlVariable($this->strC6) . ',
																																				[C7] = ' . $objDatabase->SqlVariable($this->strC7) . ',
																																						[C8] = ' . $objDatabase->SqlVariable($this->strC8) . ',
																																								[D0] = ' . $objDatabase->SqlVariable($this->strD0) . ',
																																										[D1] = ' . $objDatabase->SqlVariable($this->strD1) . ',
																																												[D2] = ' . $objDatabase->SqlVariable($this->strD2) . ',
																																														[D3] = ' . $objDatabase->SqlVariable($this->strD3) . ',
																																																[D4] = ' . $objDatabase->SqlVariable($this->strD4) . ',
																																																		[D5] = ' . $objDatabase->SqlVariable($this->strD5) . ',
																																																				[D6] = ' . $objDatabase->SqlVariable($this->strD6) . ',
																																																						[D7] = ' . $objDatabase->SqlVariable($this->strD7) . ',
																																																								[D8] = ' . $objDatabase->SqlVariable($this->strD8) . ',
																																																										[E0] = ' . $objDatabase->SqlVariable($this->strE0) . ',
																																																												[E1] = ' . $objDatabase->SqlVariable($this->strE1) . ',
																																																														[E2] = ' . $objDatabase->SqlVariable($this->strE2) . ',
																																																																[E3] = ' . $objDatabase->SqlVariable($this->strE3) . ',
																																																																		[E4] = ' . $objDatabase->SqlVariable($this->strE4) . ',
																																																																				[E5] = ' . $objDatabase->SqlVariable($this->strE5) . ',
																																																																						[E6] = ' . $objDatabase->SqlVariable($this->strE6) . ',
																																																																								[E7] = ' . $objDatabase->SqlVariable($this->strE7) . ',
																																																																										[E8] = ' . $objDatabase->SqlVariable($this->strE8) . ',
																																																																												[F0] = ' . $objDatabase->SqlVariable($this->strF0) . ',
																																																																														[F1] = ' . $objDatabase->SqlVariable($this->strF1) . ',
																																																																																[F2] = ' . $objDatabase->SqlVariable($this->strF2) . ',
																																																																																		[F3] = ' . $objDatabase->SqlVariable($this->strF3) . ',
																																																																																				[F4] = ' . $objDatabase->SqlVariable($this->strF4) . ',
																																																																																						[F5] = ' . $objDatabase->SqlVariable($this->strF5) . ',
																																																																																								[F6] = ' . $objDatabase->SqlVariable($this->strF6) . ',
																																																																																										[F7] = ' . $objDatabase->SqlVariable($this->strF7) . ',
																																																																																												[F8] = ' . $objDatabase->SqlVariable($this->strF8) . ',
																																																																																														[G0] = ' . $objDatabase->SqlVariable($this->strG0) . ',
																																																																																																[G1] = ' . $objDatabase->SqlVariable($this->strG1) . ',
																																																																																																		[G2] = ' . $objDatabase->SqlVariable($this->strG2) . ',
																																																																																																				[G3] = ' . $objDatabase->SqlVariable($this->strG3) . ',
																																																																																																						[G4] = ' . $objDatabase->SqlVariable($this->strG4) . ',
																																																																																																								[G5] = ' . $objDatabase->SqlVariable($this->strG5) . ',
																																																																																																										[G6] = ' . $objDatabase->SqlVariable($this->strG6) . ',
																																																																																																												[G7] = ' . $objDatabase->SqlVariable($this->strG7) . ',
																																																																																																														[G8] = ' . $objDatabase->SqlVariable($this->strG8) . ',
																																																																																																																[H0] = ' . $objDatabase->SqlVariable($this->strH0) . ',
																																																																																																																		[H1] = ' . $objDatabase->SqlVariable($this->strH1) . ',
																																																																																																																				[H2] = ' . $objDatabase->SqlVariable($this->strH2) . ',
																																																																																																																						[H3] = ' . $objDatabase->SqlVariable($this->strH3) . ',
																																																																																																																								[H4] = ' . $objDatabase->SqlVariable($this->strH4) . ',
																																																																																																																										[H5] = ' . $objDatabase->SqlVariable($this->strH5) . ',
																																																																																																																												[H6] = ' . $objDatabase->SqlVariable($this->strH6) . ',
																																																																																																																														[H7] = ' . $objDatabase->SqlVariable($this->strH7) . ',
																																																																																																																																[H8] = ' . $objDatabase->SqlVariable($this->strH8) . ',
																																																																																																																																		[I0] = ' . $objDatabase->SqlVariable($this->strI0) . ',
																																																																																																																																				[I1] = ' . $objDatabase->SqlVariable($this->strI1) . ',
																																																																																																																																						[I2] = ' . $objDatabase->SqlVariable($this->strI2) . ',
																																																																																																																																								[I3] = ' . $objDatabase->SqlVariable($this->strI3) . ',
																																																																																																																																										[I4] = ' . $objDatabase->SqlVariable($this->strI4) . ',
																																																																																																																																												[I5] = ' . $objDatabase->SqlVariable($this->strI5) . ',
																																																																																																																																														[I6] = ' . $objDatabase->SqlVariable($this->strI6) . ',
																																																																																																																																																[I7] = ' . $objDatabase->SqlVariable($this->strI7) . ',
																																																																																																																																																		[I8] = ' . $objDatabase->SqlVariable($this->strI8) . ',
																																																																																																																																																				username = ' . $objDatabase->SqlVariable($this->strUsername) . ',
																																																																																																																																																						date = ' . $objDatabase->SqlVariable($this->dttDate) . '
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
	 * Delete this Sampleloc
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this Sampleloc with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = Sampleloc::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleloc::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all Samplelocs
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = Sampleloc::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleloc::$strPubTableName.'');
	}

	/**
	 * Truncate sampleloc table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = Sampleloc::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeSampleloc::$strPubTableName.'');
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
			case 'BoxId':
				/**
				 * Gets the value for intBoxId (Not Null)
				 * @return integer
				 */
				return $this->intBoxId;

			case 'Samptype':
				/**
				 * Gets the value for strSamptype (Not Null)
				 * @return string
				 */
				return $this->strSamptype;

			case 'A0':
				/**
				 * Gets the value for strA0
				 * @return string
				 */
				return $this->strA0;

			case 'A1':
				/**
				 * Gets the value for strA1
				 * @return string
				 */
				return $this->strA1;

			case 'A2':
				/**
				 * Gets the value for strA2
				 * @return string
				 */
				return $this->strA2;

			case 'A3':
				/**
				 * Gets the value for strA3
				 * @return string
				 */
				return $this->strA3;

			case 'A4':
				/**
				 * Gets the value for strA4
				 * @return string
				 */
				return $this->strA4;

			case 'A5':
				/**
				 * Gets the value for strA5
				 * @return string
				 */
				return $this->strA5;

			case 'A6':
				/**
				 * Gets the value for strA6
				 * @return string
				 */
				return $this->strA6;

			case 'A7':
				/**
				 * Gets the value for strA7
				 * @return string
				 */
				return $this->strA7;

			case 'A8':
				/**
				 * Gets the value for strA8
				 * @return string
				 */
				return $this->strA8;

			case 'B0':
				/**
				 * Gets the value for strB0
				 * @return string
				 */
				return $this->strB0;

			case 'B1':
				/**
				 * Gets the value for strB1
				 * @return string
				 */
				return $this->strB1;

			case 'B2':
				/**
				 * Gets the value for strB2
				 * @return string
				 */
				return $this->strB2;

			case 'B3':
				/**
				 * Gets the value for strB3
				 * @return string
				 */
				return $this->strB3;

			case 'B4':
				/**
				 * Gets the value for strB4
				 * @return string
				 */
				return $this->strB4;

			case 'B5':
				/**
				 * Gets the value for strB5
				 * @return string
				 */
				return $this->strB5;

			case 'B6':
				/**
				 * Gets the value for strB6
				 * @return string
				 */
				return $this->strB6;

			case 'B7':
				/**
				 * Gets the value for strB7
				 * @return string
				 */
				return $this->strB7;

			case 'B8':
				/**
				 * Gets the value for strB8
				 * @return string
				 */
				return $this->strB8;

			case 'C0':
				/**
				 * Gets the value for strC0
				 * @return string
				 */
				return $this->strC0;

			case 'C1':
				/**
				 * Gets the value for strC1
				 * @return string
				 */
				return $this->strC1;

			case 'C2':
				/**
				 * Gets the value for strC2
				 * @return string
				 */
				return $this->strC2;

			case 'C3':
				/**
				 * Gets the value for strC3
				 * @return string
				 */
				return $this->strC3;

			case 'C4':
				/**
				 * Gets the value for strC4
				 * @return string
				 */
				return $this->strC4;

			case 'C5':
				/**
				 * Gets the value for strC5
				 * @return string
				 */
				return $this->strC5;

			case 'C6':
				/**
				 * Gets the value for strC6
				 * @return string
				 */
				return $this->strC6;

			case 'C7':
				/**
				 * Gets the value for strC7
				 * @return string
				 */
				return $this->strC7;

			case 'C8':
				/**
				 * Gets the value for strC8
				 * @return string
				 */
				return $this->strC8;

			case 'D0':
				/**
				 * Gets the value for strD0
				 * @return string
				 */
				return $this->strD0;

			case 'D1':
				/**
				 * Gets the value for strD1
				 * @return string
				 */
				return $this->strD1;

			case 'D2':
				/**
				 * Gets the value for strD2
				 * @return string
				 */
				return $this->strD2;

			case 'D3':
				/**
				 * Gets the value for strD3
				 * @return string
				 */
				return $this->strD3;

			case 'D4':
				/**
				 * Gets the value for strD4
				 * @return string
				 */
				return $this->strD4;

			case 'D5':
				/**
				 * Gets the value for strD5
				 * @return string
				 */
				return $this->strD5;

			case 'D6':
				/**
				 * Gets the value for strD6
				 * @return string
				 */
				return $this->strD6;

			case 'D7':
				/**
				 * Gets the value for strD7
				 * @return string
				 */
				return $this->strD7;

			case 'D8':
				/**
				 * Gets the value for strD8
				 * @return string
				 */
				return $this->strD8;

			case 'E0':
				/**
				 * Gets the value for strE0
				 * @return string
				 */
				return $this->strE0;

			case 'E1':
				/**
				 * Gets the value for strE1
				 * @return string
				 */
				return $this->strE1;

			case 'E2':
				/**
				 * Gets the value for strE2
				 * @return string
				 */
				return $this->strE2;

			case 'E3':
				/**
				 * Gets the value for strE3
				 * @return string
				 */
				return $this->strE3;

			case 'E4':
				/**
				 * Gets the value for strE4
				 * @return string
				 */
				return $this->strE4;

			case 'E5':
				/**
				 * Gets the value for strE5
				 * @return string
				 */
				return $this->strE5;

			case 'E6':
				/**
				 * Gets the value for strE6
				 * @return string
				 */
				return $this->strE6;

			case 'E7':
				/**
				 * Gets the value for strE7
				 * @return string
				 */
				return $this->strE7;

			case 'E8':
				/**
				 * Gets the value for strE8
				 * @return string
				 */
				return $this->strE8;

			case 'F0':
				/**
				 * Gets the value for strF0
				 * @return string
				 */
				return $this->strF0;

			case 'F1':
				/**
				 * Gets the value for strF1
				 * @return string
				 */
				return $this->strF1;

			case 'F2':
				/**
				 * Gets the value for strF2
				 * @return string
				 */
				return $this->strF2;

			case 'F3':
				/**
				 * Gets the value for strF3
				 * @return string
				 */
				return $this->strF3;

			case 'F4':
				/**
				 * Gets the value for strF4
				 * @return string
				 */
				return $this->strF4;

			case 'F5':
				/**
				 * Gets the value for strF5
				 * @return string
				 */
				return $this->strF5;

			case 'F6':
				/**
				 * Gets the value for strF6
				 * @return string
				 */
				return $this->strF6;

			case 'F7':
				/**
				 * Gets the value for strF7
				 * @return string
				 */
				return $this->strF7;

			case 'F8':
				/**
				 * Gets the value for strF8
				 * @return string
				 */
				return $this->strF8;

			case 'G0':
				/**
				 * Gets the value for strG0
				 * @return string
				 */
				return $this->strG0;

			case 'G1':
				/**
				 * Gets the value for strG1
				 * @return string
				 */
				return $this->strG1;

			case 'G2':
				/**
				 * Gets the value for strG2
				 * @return string
				 */
				return $this->strG2;

			case 'G3':
				/**
				 * Gets the value for strG3
				 * @return string
				 */
				return $this->strG3;

			case 'G4':
				/**
				 * Gets the value for strG4
				 * @return string
				 */
				return $this->strG4;

			case 'G5':
				/**
				 * Gets the value for strG5
				 * @return string
				 */
				return $this->strG5;

			case 'G6':
				/**
				 * Gets the value for strG6
				 * @return string
				 */
				return $this->strG6;

			case 'G7':
				/**
				 * Gets the value for strG7
				 * @return string
				 */
				return $this->strG7;

			case 'G8':
				/**
				 * Gets the value for strG8
				 * @return string
				 */
				return $this->strG8;

			case 'H0':
				/**
				 * Gets the value for strH0
				 * @return string
				 */
				return $this->strH0;

			case 'H1':
				/**
				 * Gets the value for strH1
				 * @return string
				 */
				return $this->strH1;

			case 'H2':
				/**
				 * Gets the value for strH2
				 * @return string
				 */
				return $this->strH2;

			case 'H3':
				/**
				 * Gets the value for strH3
				 * @return string
				 */
				return $this->strH3;

			case 'H4':
				/**
				 * Gets the value for strH4
				 * @return string
				 */
				return $this->strH4;

			case 'H5':
				/**
				 * Gets the value for strH5
				 * @return string
				 */
				return $this->strH5;

			case 'H6':
				/**
				 * Gets the value for strH6
				 * @return string
				 */
				return $this->strH6;

			case 'H7':
				/**
				 * Gets the value for strH7
				 * @return string
				 */
				return $this->strH7;

			case 'H8':
				/**
				 * Gets the value for strH8
				 * @return string
				 */
				return $this->strH8;

			case 'I0':
				/**
				 * Gets the value for strI0
				 * @return string
				 */
				return $this->strI0;

			case 'I1':
				/**
				 * Gets the value for strI1
				 * @return string
				 */
				return $this->strI1;

			case 'I2':
				/**
				 * Gets the value for strI2
				 * @return string
				 */
				return $this->strI2;

			case 'I3':
				/**
				 * Gets the value for strI3
				 * @return string
				 */
				return $this->strI3;

			case 'I4':
				/**
				 * Gets the value for strI4
				 * @return string
				 */
				return $this->strI4;

			case 'I5':
				/**
				 * Gets the value for strI5
				 * @return string
				 */
				return $this->strI5;

			case 'I6':
				/**
				 * Gets the value for strI6
				 * @return string
				 */
				return $this->strI6;

			case 'I7':
				/**
				 * Gets the value for strI7
				 * @return string
				 */
				return $this->strI7;

			case 'I8':
				/**
				 * Gets the value for strI8
				 * @return string
				 */
				return $this->strI8;

			case 'Username':
				/**
				 * Gets the value for strUsername (Not Null)
				 * @return string
				 */
				return $this->strUsername;

			case 'Date':
				/**
				 * Gets the value for dttDate (Not Null)
				 * @return QDateTime
				 */
				return $this->dttDate;

			case 'Id':
				/**
				 * Gets the value for intId (Read-Only PK)
				 * @return integer
				 */
				return $this->intId;


				///////////////////
				// Member Objects
				///////////////////
			case 'Box':
				/**
				 * Gets the value for the Sampleboxes object referenced by intBoxId (Not Null)
				 * @return Sampleboxes
				 */
				try {
					if ((!$this->objBox) && (!is_null($this->intBoxId)))
						$this->objBox = Sampleboxes::Load($this->intBoxId);
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

			case 'Samptype':
				/**
				 * Sets the value for strSamptype (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strSamptype = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'A0':
				/**
				 * Sets the value for strA0
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strA0 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'A1':
				/**
				 * Sets the value for strA1
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strA1 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'A2':
				/**
				 * Sets the value for strA2
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strA2 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'A3':
				/**
				 * Sets the value for strA3
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strA3 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'A4':
				/**
				 * Sets the value for strA4
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strA4 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'A5':
				/**
				 * Sets the value for strA5
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strA5 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'A6':
				/**
				 * Sets the value for strA6
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strA6 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'A7':
				/**
				 * Sets the value for strA7
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strA7 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'A8':
				/**
				 * Sets the value for strA8
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strA8 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'B0':
				/**
				 * Sets the value for strB0
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strB0 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'B1':
				/**
				 * Sets the value for strB1
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strB1 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'B2':
				/**
				 * Sets the value for strB2
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strB2 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'B3':
				/**
				 * Sets the value for strB3
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strB3 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'B4':
				/**
				 * Sets the value for strB4
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strB4 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'B5':
				/**
				 * Sets the value for strB5
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strB5 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'B6':
				/**
				 * Sets the value for strB6
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strB6 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'B7':
				/**
				 * Sets the value for strB7
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strB7 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'B8':
				/**
				 * Sets the value for strB8
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strB8 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C0':
				/**
				 * Sets the value for strC0
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC0 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C1':
				/**
				 * Sets the value for strC1
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC1 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C2':
				/**
				 * Sets the value for strC2
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC2 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C3':
				/**
				 * Sets the value for strC3
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC3 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C4':
				/**
				 * Sets the value for strC4
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC4 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C5':
				/**
				 * Sets the value for strC5
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC5 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C6':
				/**
				 * Sets the value for strC6
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC6 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C7':
				/**
				 * Sets the value for strC7
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC7 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C8':
				/**
				 * Sets the value for strC8
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC8 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'D0':
				/**
				 * Sets the value for strD0
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strD0 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'D1':
				/**
				 * Sets the value for strD1
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strD1 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'D2':
				/**
				 * Sets the value for strD2
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strD2 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'D3':
				/**
				 * Sets the value for strD3
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strD3 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'D4':
				/**
				 * Sets the value for strD4
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strD4 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'D5':
				/**
				 * Sets the value for strD5
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strD5 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'D6':
				/**
				 * Sets the value for strD6
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strD6 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'D7':
				/**
				 * Sets the value for strD7
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strD7 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'D8':
				/**
				 * Sets the value for strD8
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strD8 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'E0':
				/**
				 * Sets the value for strE0
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strE0 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'E1':
				/**
				 * Sets the value for strE1
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strE1 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'E2':
				/**
				 * Sets the value for strE2
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strE2 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'E3':
				/**
				 * Sets the value for strE3
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strE3 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'E4':
				/**
				 * Sets the value for strE4
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strE4 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'E5':
				/**
				 * Sets the value for strE5
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strE5 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'E6':
				/**
				 * Sets the value for strE6
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strE6 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'E7':
				/**
				 * Sets the value for strE7
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strE7 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'E8':
				/**
				 * Sets the value for strE8
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strE8 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F0':
				/**
				 * Sets the value for strF0
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strF0 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F1':
				/**
				 * Sets the value for strF1
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strF1 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F2':
				/**
				 * Sets the value for strF2
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strF2 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F3':
				/**
				 * Sets the value for strF3
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strF3 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F4':
				/**
				 * Sets the value for strF4
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strF4 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F5':
				/**
				 * Sets the value for strF5
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strF5 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F6':
				/**
				 * Sets the value for strF6
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strF6 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F7':
				/**
				 * Sets the value for strF7
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strF7 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F8':
				/**
				 * Sets the value for strF8
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strF8 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'G0':
				/**
				 * Sets the value for strG0
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strG0 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'G1':
				/**
				 * Sets the value for strG1
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strG1 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'G2':
				/**
				 * Sets the value for strG2
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strG2 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'G3':
				/**
				 * Sets the value for strG3
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strG3 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'G4':
				/**
				 * Sets the value for strG4
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strG4 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'G5':
				/**
				 * Sets the value for strG5
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strG5 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'G6':
				/**
				 * Sets the value for strG6
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strG6 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'G7':
				/**
				 * Sets the value for strG7
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strG7 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'G8':
				/**
				 * Sets the value for strG8
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strG8 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'H0':
				/**
				 * Sets the value for strH0
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strH0 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'H1':
				/**
				 * Sets the value for strH1
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strH1 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'H2':
				/**
				 * Sets the value for strH2
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strH2 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'H3':
				/**
				 * Sets the value for strH3
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strH3 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'H4':
				/**
				 * Sets the value for strH4
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strH4 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'H5':
				/**
				 * Sets the value for strH5
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strH5 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'H6':
				/**
				 * Sets the value for strH6
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strH6 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'H7':
				/**
				 * Sets the value for strH7
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strH7 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'H8':
				/**
				 * Sets the value for strH8
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strH8 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'I0':
				/**
				 * Sets the value for strI0
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strI0 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'I1':
				/**
				 * Sets the value for strI1
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strI1 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'I2':
				/**
				 * Sets the value for strI2
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strI2 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'I3':
				/**
				 * Sets the value for strI3
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strI3 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'I4':
				/**
				 * Sets the value for strI4
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strI4 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'I5':
				/**
				 * Sets the value for strI5
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strI5 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'I6':
				/**
				 * Sets the value for strI6
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strI6 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'I7':
				/**
				 * Sets the value for strI7
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strI7 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'I8':
				/**
				 * Sets the value for strI8
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strI8 = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Username':
				/**
				 * Sets the value for strUsername (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strUsername = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Date':
				/**
				 * Sets the value for dttDate (Not Null)
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttDate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				///////////////////
				// Member Objects
				///////////////////
			case 'Box':
				/**
				 * Sets the value for the Sampleboxes object referenced by intBoxId (Not Null)
				 * @param Sampleboxes $mixValue
				 * @return Sampleboxes
				 */
				if (is_null($mixValue)) {
					$this->intBoxId = null;
					$this->objBox = null;
					return null;
				} else {
					// Make sure $mixValue actually is a Sampleboxes object
					try {
						$mixValue = QType::Cast($mixValue, 'Sampleboxes');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED Sampleboxes object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved Box for this Sampleloc');

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
	 * Protected member variable that maps to the database column sampleloc.box_id
	 * @var integer intBoxId
	 */
	protected $intBoxId;
	const BoxIdDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.samptype
	 * @var string strSamptype
	 */
	protected $strSamptype;
	const SamptypeMaxLength = 40;
	const SamptypeDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.A0
	 * @var string strA0
	 */
	protected $strA0;
	const A0MaxLength = 32;
	const A0Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.A1
	 * @var string strA1
	 */
	protected $strA1;
	const A1MaxLength = 32;
	const A1Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.A2
	 * @var string strA2
	 */
	protected $strA2;
	const A2MaxLength = 32;
	const A2Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.A3
	 * @var string strA3
	 */
	protected $strA3;
	const A3MaxLength = 32;
	const A3Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.A4
	 * @var string strA4
	 */
	protected $strA4;
	const A4MaxLength = 32;
	const A4Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.A5
	 * @var string strA5
	 */
	protected $strA5;
	const A5MaxLength = 32;
	const A5Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.A6
	 * @var string strA6
	 */
	protected $strA6;
	const A6MaxLength = 32;
	const A6Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.A7
	 * @var string strA7
	 */
	protected $strA7;
	const A7MaxLength = 32;
	const A7Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.A8
	 * @var string strA8
	 */
	protected $strA8;
	const A8MaxLength = 32;
	const A8Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.B0
	 * @var string strB0
	 */
	protected $strB0;
	const B0MaxLength = 32;
	const B0Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.B1
	 * @var string strB1
	 */
	protected $strB1;
	const B1MaxLength = 32;
	const B1Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.B2
	 * @var string strB2
	 */
	protected $strB2;
	const B2MaxLength = 32;
	const B2Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.B3
	 * @var string strB3
	 */
	protected $strB3;
	const B3MaxLength = 32;
	const B3Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.B4
	 * @var string strB4
	 */
	protected $strB4;
	const B4MaxLength = 32;
	const B4Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.B5
	 * @var string strB5
	 */
	protected $strB5;
	const B5MaxLength = 32;
	const B5Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.B6
	 * @var string strB6
	 */
	protected $strB6;
	const B6MaxLength = 32;
	const B6Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.B7
	 * @var string strB7
	 */
	protected $strB7;
	const B7MaxLength = 32;
	const B7Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.B8
	 * @var string strB8
	 */
	protected $strB8;
	const B8MaxLength = 32;
	const B8Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.C0
	 * @var string strC0
	 */
	protected $strC0;
	const C0MaxLength = 32;
	const C0Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.C1
	 * @var string strC1
	 */
	protected $strC1;
	const C1MaxLength = 32;
	const C1Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.C2
	 * @var string strC2
	 */
	protected $strC2;
	const C2MaxLength = 32;
	const C2Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.C3
	 * @var string strC3
	 */
	protected $strC3;
	const C3MaxLength = 32;
	const C3Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.C4
	 * @var string strC4
	 */
	protected $strC4;
	const C4MaxLength = 32;
	const C4Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.C5
	 * @var string strC5
	 */
	protected $strC5;
	const C5MaxLength = 32;
	const C5Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.C6
	 * @var string strC6
	 */
	protected $strC6;
	const C6MaxLength = 32;
	const C6Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.C7
	 * @var string strC7
	 */
	protected $strC7;
	const C7MaxLength = 32;
	const C7Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.C8
	 * @var string strC8
	 */
	protected $strC8;
	const C8MaxLength = 32;
	const C8Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.D0
	 * @var string strD0
	 */
	protected $strD0;
	const D0MaxLength = 32;
	const D0Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.D1
	 * @var string strD1
	 */
	protected $strD1;
	const D1MaxLength = 32;
	const D1Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.D2
	 * @var string strD2
	 */
	protected $strD2;
	const D2MaxLength = 32;
	const D2Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.D3
	 * @var string strD3
	 */
	protected $strD3;
	const D3MaxLength = 32;
	const D3Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.D4
	 * @var string strD4
	 */
	protected $strD4;
	const D4MaxLength = 32;
	const D4Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.D5
	 * @var string strD5
	 */
	protected $strD5;
	const D5MaxLength = 32;
	const D5Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.D6
	 * @var string strD6
	 */
	protected $strD6;
	const D6MaxLength = 32;
	const D6Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.D7
	 * @var string strD7
	 */
	protected $strD7;
	const D7MaxLength = 32;
	const D7Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.D8
	 * @var string strD8
	 */
	protected $strD8;
	const D8MaxLength = 32;
	const D8Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.E0
	 * @var string strE0
	 */
	protected $strE0;
	const E0MaxLength = 32;
	const E0Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.E1
	 * @var string strE1
	 */
	protected $strE1;
	const E1MaxLength = 32;
	const E1Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.E2
	 * @var string strE2
	 */
	protected $strE2;
	const E2MaxLength = 32;
	const E2Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.E3
	 * @var string strE3
	 */
	protected $strE3;
	const E3MaxLength = 32;
	const E3Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.E4
	 * @var string strE4
	 */
	protected $strE4;
	const E4MaxLength = 32;
	const E4Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.E5
	 * @var string strE5
	 */
	protected $strE5;
	const E5MaxLength = 32;
	const E5Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.E6
	 * @var string strE6
	 */
	protected $strE6;
	const E6MaxLength = 32;
	const E6Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.E7
	 * @var string strE7
	 */
	protected $strE7;
	const E7MaxLength = 32;
	const E7Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.E8
	 * @var string strE8
	 */
	protected $strE8;
	const E8MaxLength = 32;
	const E8Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.F0
	 * @var string strF0
	 */
	protected $strF0;
	const F0MaxLength = 32;
	const F0Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.F1
	 * @var string strF1
	 */
	protected $strF1;
	const F1MaxLength = 32;
	const F1Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.F2
	 * @var string strF2
	 */
	protected $strF2;
	const F2MaxLength = 32;
	const F2Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.F3
	 * @var string strF3
	 */
	protected $strF3;
	const F3MaxLength = 32;
	const F3Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.F4
	 * @var string strF4
	 */
	protected $strF4;
	const F4MaxLength = 32;
	const F4Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.F5
	 * @var string strF5
	 */
	protected $strF5;
	const F5MaxLength = 32;
	const F5Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.F6
	 * @var string strF6
	 */
	protected $strF6;
	const F6MaxLength = 32;
	const F6Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.F7
	 * @var string strF7
	 */
	protected $strF7;
	const F7MaxLength = 32;
	const F7Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.F8
	 * @var string strF8
	 */
	protected $strF8;
	const F8MaxLength = 32;
	const F8Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.G0
	 * @var string strG0
	 */
	protected $strG0;
	const G0MaxLength = 32;
	const G0Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.G1
	 * @var string strG1
	 */
	protected $strG1;
	const G1MaxLength = 32;
	const G1Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.G2
	 * @var string strG2
	 */
	protected $strG2;
	const G2MaxLength = 32;
	const G2Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.G3
	 * @var string strG3
	 */
	protected $strG3;
	const G3MaxLength = 32;
	const G3Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.G4
	 * @var string strG4
	 */
	protected $strG4;
	const G4MaxLength = 32;
	const G4Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.G5
	 * @var string strG5
	 */
	protected $strG5;
	const G5MaxLength = 32;
	const G5Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.G6
	 * @var string strG6
	 */
	protected $strG6;
	const G6MaxLength = 32;
	const G6Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.G7
	 * @var string strG7
	 */
	protected $strG7;
	const G7MaxLength = 32;
	const G7Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.G8
	 * @var string strG8
	 */
	protected $strG8;
	const G8MaxLength = 32;
	const G8Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.H0
	 * @var string strH0
	 */
	protected $strH0;
	const H0MaxLength = 32;
	const H0Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.H1
	 * @var string strH1
	 */
	protected $strH1;
	const H1MaxLength = 32;
	const H1Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.H2
	 * @var string strH2
	 */
	protected $strH2;
	const H2MaxLength = 32;
	const H2Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.H3
	 * @var string strH3
	 */
	protected $strH3;
	const H3MaxLength = 32;
	const H3Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.H4
	 * @var string strH4
	 */
	protected $strH4;
	const H4MaxLength = 32;
	const H4Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.H5
	 * @var string strH5
	 */
	protected $strH5;
	const H5MaxLength = 32;
	const H5Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.H6
	 * @var string strH6
	 */
	protected $strH6;
	const H6MaxLength = 32;
	const H6Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.H7
	 * @var string strH7
	 */
	protected $strH7;
	const H7MaxLength = 32;
	const H7Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.H8
	 * @var string strH8
	 */
	protected $strH8;
	const H8MaxLength = 32;
	const H8Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.I0
	 * @var string strI0
	 */
	protected $strI0;
	const I0MaxLength = 32;
	const I0Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.I1
	 * @var string strI1
	 */
	protected $strI1;
	const I1MaxLength = 32;
	const I1Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.I2
	 * @var string strI2
	 */
	protected $strI2;
	const I2MaxLength = 32;
	const I2Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.I3
	 * @var string strI3
	 */
	protected $strI3;
	const I3MaxLength = 32;
	const I3Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.I4
	 * @var string strI4
	 */
	protected $strI4;
	const I4MaxLength = 32;
	const I4Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.I5
	 * @var string strI5
	 */
	protected $strI5;
	const I5MaxLength = 32;
	const I5Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.I6
	 * @var string strI6
	 */
	protected $strI6;
	const I6MaxLength = 32;
	const I6Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.I7
	 * @var string strI7
	 */
	protected $strI7;
	const I7MaxLength = 32;
	const I7Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.I8
	 * @var string strI8
	 */
	protected $strI8;
	const I8MaxLength = 32;
	const I8Default = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.username
	 * @var string strUsername
	 */
	protected $strUsername;
	const UsernameMaxLength = 60;
	const UsernameDefault = null;


	/**
	 * Protected member variable that maps to the database column sampleloc.date
	 * @var QDateTime dttDate
	 */
	protected $dttDate;
	const DateDefault = null;


	/**
	 * Protected member variable that maps to the database PK Identity column sampleloc.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


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
	 * in the database column sampleloc.box_id.
	 *
	 * NOTE: Always use the Box property getter to correctly retrieve this Sampleboxes object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var Sampleboxes objBox
	 */
	protected $objBox;






	////////////////////////////////////////
	// METHODS for WEB SERVICES
	////////////////////////////////////////

	public static function GetSoapComplexTypeXml() {
		$strToReturn = '<complexType name="Sampleloc"><sequence>';
		$strToReturn .= '<element name="Box" type="xsd1:Sampleboxes"/>';
		$strToReturn .= '<element name="Samptype" type="xsd:string"/>';
		$strToReturn .= '<element name="A0" type="xsd:string"/>';
		$strToReturn .= '<element name="A1" type="xsd:string"/>';
		$strToReturn .= '<element name="A2" type="xsd:string"/>';
		$strToReturn .= '<element name="A3" type="xsd:string"/>';
		$strToReturn .= '<element name="A4" type="xsd:string"/>';
		$strToReturn .= '<element name="A5" type="xsd:string"/>';
		$strToReturn .= '<element name="A6" type="xsd:string"/>';
		$strToReturn .= '<element name="A7" type="xsd:string"/>';
		$strToReturn .= '<element name="A8" type="xsd:string"/>';
		$strToReturn .= '<element name="B0" type="xsd:string"/>';
		$strToReturn .= '<element name="B1" type="xsd:string"/>';
		$strToReturn .= '<element name="B2" type="xsd:string"/>';
		$strToReturn .= '<element name="B3" type="xsd:string"/>';
		$strToReturn .= '<element name="B4" type="xsd:string"/>';
		$strToReturn .= '<element name="B5" type="xsd:string"/>';
		$strToReturn .= '<element name="B6" type="xsd:string"/>';
		$strToReturn .= '<element name="B7" type="xsd:string"/>';
		$strToReturn .= '<element name="B8" type="xsd:string"/>';
		$strToReturn .= '<element name="C0" type="xsd:string"/>';
		$strToReturn .= '<element name="C1" type="xsd:string"/>';
		$strToReturn .= '<element name="C2" type="xsd:string"/>';
		$strToReturn .= '<element name="C3" type="xsd:string"/>';
		$strToReturn .= '<element name="C4" type="xsd:string"/>';
		$strToReturn .= '<element name="C5" type="xsd:string"/>';
		$strToReturn .= '<element name="C6" type="xsd:string"/>';
		$strToReturn .= '<element name="C7" type="xsd:string"/>';
		$strToReturn .= '<element name="C8" type="xsd:string"/>';
		$strToReturn .= '<element name="D0" type="xsd:string"/>';
		$strToReturn .= '<element name="D1" type="xsd:string"/>';
		$strToReturn .= '<element name="D2" type="xsd:string"/>';
		$strToReturn .= '<element name="D3" type="xsd:string"/>';
		$strToReturn .= '<element name="D4" type="xsd:string"/>';
		$strToReturn .= '<element name="D5" type="xsd:string"/>';
		$strToReturn .= '<element name="D6" type="xsd:string"/>';
		$strToReturn .= '<element name="D7" type="xsd:string"/>';
		$strToReturn .= '<element name="D8" type="xsd:string"/>';
		$strToReturn .= '<element name="E0" type="xsd:string"/>';
		$strToReturn .= '<element name="E1" type="xsd:string"/>';
		$strToReturn .= '<element name="E2" type="xsd:string"/>';
		$strToReturn .= '<element name="E3" type="xsd:string"/>';
		$strToReturn .= '<element name="E4" type="xsd:string"/>';
		$strToReturn .= '<element name="E5" type="xsd:string"/>';
		$strToReturn .= '<element name="E6" type="xsd:string"/>';
		$strToReturn .= '<element name="E7" type="xsd:string"/>';
		$strToReturn .= '<element name="E8" type="xsd:string"/>';
		$strToReturn .= '<element name="F0" type="xsd:string"/>';
		$strToReturn .= '<element name="F1" type="xsd:string"/>';
		$strToReturn .= '<element name="F2" type="xsd:string"/>';
		$strToReturn .= '<element name="F3" type="xsd:string"/>';
		$strToReturn .= '<element name="F4" type="xsd:string"/>';
		$strToReturn .= '<element name="F5" type="xsd:string"/>';
		$strToReturn .= '<element name="F6" type="xsd:string"/>';
		$strToReturn .= '<element name="F7" type="xsd:string"/>';
		$strToReturn .= '<element name="F8" type="xsd:string"/>';
		$strToReturn .= '<element name="G0" type="xsd:string"/>';
		$strToReturn .= '<element name="G1" type="xsd:string"/>';
		$strToReturn .= '<element name="G2" type="xsd:string"/>';
		$strToReturn .= '<element name="G3" type="xsd:string"/>';
		$strToReturn .= '<element name="G4" type="xsd:string"/>';
		$strToReturn .= '<element name="G5" type="xsd:string"/>';
		$strToReturn .= '<element name="G6" type="xsd:string"/>';
		$strToReturn .= '<element name="G7" type="xsd:string"/>';
		$strToReturn .= '<element name="G8" type="xsd:string"/>';
		$strToReturn .= '<element name="H0" type="xsd:string"/>';
		$strToReturn .= '<element name="H1" type="xsd:string"/>';
		$strToReturn .= '<element name="H2" type="xsd:string"/>';
		$strToReturn .= '<element name="H3" type="xsd:string"/>';
		$strToReturn .= '<element name="H4" type="xsd:string"/>';
		$strToReturn .= '<element name="H5" type="xsd:string"/>';
		$strToReturn .= '<element name="H6" type="xsd:string"/>';
		$strToReturn .= '<element name="H7" type="xsd:string"/>';
		$strToReturn .= '<element name="H8" type="xsd:string"/>';
		$strToReturn .= '<element name="I0" type="xsd:string"/>';
		$strToReturn .= '<element name="I1" type="xsd:string"/>';
		$strToReturn .= '<element name="I2" type="xsd:string"/>';
		$strToReturn .= '<element name="I3" type="xsd:string"/>';
		$strToReturn .= '<element name="I4" type="xsd:string"/>';
		$strToReturn .= '<element name="I5" type="xsd:string"/>';
		$strToReturn .= '<element name="I6" type="xsd:string"/>';
		$strToReturn .= '<element name="I7" type="xsd:string"/>';
		$strToReturn .= '<element name="I8" type="xsd:string"/>';
		$strToReturn .= '<element name="Username" type="xsd:string"/>';
		$strToReturn .= '<element name="Date" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('Sampleloc', $strComplexTypeArray)) {
			$strComplexTypeArray['Sampleloc'] = Sampleloc::GetSoapComplexTypeXml();
			Sampleboxes::AlterSoapComplexTypeArray($strComplexTypeArray);
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, Sampleloc::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new Sampleloc();
		if ((property_exists($objSoapObject, 'Box')) &&
				($objSoapObject->Box))
			$objToReturn->Box = Sampleboxes::GetObjectFromSoapObject($objSoapObject->Box);
		if (property_exists($objSoapObject, 'Samptype'))
			$objToReturn->strSamptype = $objSoapObject->Samptype;
		if (property_exists($objSoapObject, 'A0'))
			$objToReturn->strA0 = $objSoapObject->A0;
		if (property_exists($objSoapObject, 'A1'))
			$objToReturn->strA1 = $objSoapObject->A1;
		if (property_exists($objSoapObject, 'A2'))
			$objToReturn->strA2 = $objSoapObject->A2;
		if (property_exists($objSoapObject, 'A3'))
			$objToReturn->strA3 = $objSoapObject->A3;
		if (property_exists($objSoapObject, 'A4'))
			$objToReturn->strA4 = $objSoapObject->A4;
		if (property_exists($objSoapObject, 'A5'))
			$objToReturn->strA5 = $objSoapObject->A5;
		if (property_exists($objSoapObject, 'A6'))
			$objToReturn->strA6 = $objSoapObject->A6;
		if (property_exists($objSoapObject, 'A7'))
			$objToReturn->strA7 = $objSoapObject->A7;
		if (property_exists($objSoapObject, 'A8'))
			$objToReturn->strA8 = $objSoapObject->A8;
		if (property_exists($objSoapObject, 'B0'))
			$objToReturn->strB0 = $objSoapObject->B0;
		if (property_exists($objSoapObject, 'B1'))
			$objToReturn->strB1 = $objSoapObject->B1;
		if (property_exists($objSoapObject, 'B2'))
			$objToReturn->strB2 = $objSoapObject->B2;
		if (property_exists($objSoapObject, 'B3'))
			$objToReturn->strB3 = $objSoapObject->B3;
		if (property_exists($objSoapObject, 'B4'))
			$objToReturn->strB4 = $objSoapObject->B4;
		if (property_exists($objSoapObject, 'B5'))
			$objToReturn->strB5 = $objSoapObject->B5;
		if (property_exists($objSoapObject, 'B6'))
			$objToReturn->strB6 = $objSoapObject->B6;
		if (property_exists($objSoapObject, 'B7'))
			$objToReturn->strB7 = $objSoapObject->B7;
		if (property_exists($objSoapObject, 'B8'))
			$objToReturn->strB8 = $objSoapObject->B8;
		if (property_exists($objSoapObject, 'C0'))
			$objToReturn->strC0 = $objSoapObject->C0;
		if (property_exists($objSoapObject, 'C1'))
			$objToReturn->strC1 = $objSoapObject->C1;
		if (property_exists($objSoapObject, 'C2'))
			$objToReturn->strC2 = $objSoapObject->C2;
		if (property_exists($objSoapObject, 'C3'))
			$objToReturn->strC3 = $objSoapObject->C3;
		if (property_exists($objSoapObject, 'C4'))
			$objToReturn->strC4 = $objSoapObject->C4;
		if (property_exists($objSoapObject, 'C5'))
			$objToReturn->strC5 = $objSoapObject->C5;
		if (property_exists($objSoapObject, 'C6'))
			$objToReturn->strC6 = $objSoapObject->C6;
		if (property_exists($objSoapObject, 'C7'))
			$objToReturn->strC7 = $objSoapObject->C7;
		if (property_exists($objSoapObject, 'C8'))
			$objToReturn->strC8 = $objSoapObject->C8;
		if (property_exists($objSoapObject, 'D0'))
			$objToReturn->strD0 = $objSoapObject->D0;
		if (property_exists($objSoapObject, 'D1'))
			$objToReturn->strD1 = $objSoapObject->D1;
		if (property_exists($objSoapObject, 'D2'))
			$objToReturn->strD2 = $objSoapObject->D2;
		if (property_exists($objSoapObject, 'D3'))
			$objToReturn->strD3 = $objSoapObject->D3;
		if (property_exists($objSoapObject, 'D4'))
			$objToReturn->strD4 = $objSoapObject->D4;
		if (property_exists($objSoapObject, 'D5'))
			$objToReturn->strD5 = $objSoapObject->D5;
		if (property_exists($objSoapObject, 'D6'))
			$objToReturn->strD6 = $objSoapObject->D6;
		if (property_exists($objSoapObject, 'D7'))
			$objToReturn->strD7 = $objSoapObject->D7;
		if (property_exists($objSoapObject, 'D8'))
			$objToReturn->strD8 = $objSoapObject->D8;
		if (property_exists($objSoapObject, 'E0'))
			$objToReturn->strE0 = $objSoapObject->E0;
		if (property_exists($objSoapObject, 'E1'))
			$objToReturn->strE1 = $objSoapObject->E1;
		if (property_exists($objSoapObject, 'E2'))
			$objToReturn->strE2 = $objSoapObject->E2;
		if (property_exists($objSoapObject, 'E3'))
			$objToReturn->strE3 = $objSoapObject->E3;
		if (property_exists($objSoapObject, 'E4'))
			$objToReturn->strE4 = $objSoapObject->E4;
		if (property_exists($objSoapObject, 'E5'))
			$objToReturn->strE5 = $objSoapObject->E5;
		if (property_exists($objSoapObject, 'E6'))
			$objToReturn->strE6 = $objSoapObject->E6;
		if (property_exists($objSoapObject, 'E7'))
			$objToReturn->strE7 = $objSoapObject->E7;
		if (property_exists($objSoapObject, 'E8'))
			$objToReturn->strE8 = $objSoapObject->E8;
		if (property_exists($objSoapObject, 'F0'))
			$objToReturn->strF0 = $objSoapObject->F0;
		if (property_exists($objSoapObject, 'F1'))
			$objToReturn->strF1 = $objSoapObject->F1;
		if (property_exists($objSoapObject, 'F2'))
			$objToReturn->strF2 = $objSoapObject->F2;
		if (property_exists($objSoapObject, 'F3'))
			$objToReturn->strF3 = $objSoapObject->F3;
		if (property_exists($objSoapObject, 'F4'))
			$objToReturn->strF4 = $objSoapObject->F4;
		if (property_exists($objSoapObject, 'F5'))
			$objToReturn->strF5 = $objSoapObject->F5;
		if (property_exists($objSoapObject, 'F6'))
			$objToReturn->strF6 = $objSoapObject->F6;
		if (property_exists($objSoapObject, 'F7'))
			$objToReturn->strF7 = $objSoapObject->F7;
		if (property_exists($objSoapObject, 'F8'))
			$objToReturn->strF8 = $objSoapObject->F8;
		if (property_exists($objSoapObject, 'G0'))
			$objToReturn->strG0 = $objSoapObject->G0;
		if (property_exists($objSoapObject, 'G1'))
			$objToReturn->strG1 = $objSoapObject->G1;
		if (property_exists($objSoapObject, 'G2'))
			$objToReturn->strG2 = $objSoapObject->G2;
		if (property_exists($objSoapObject, 'G3'))
			$objToReturn->strG3 = $objSoapObject->G3;
		if (property_exists($objSoapObject, 'G4'))
			$objToReturn->strG4 = $objSoapObject->G4;
		if (property_exists($objSoapObject, 'G5'))
			$objToReturn->strG5 = $objSoapObject->G5;
		if (property_exists($objSoapObject, 'G6'))
			$objToReturn->strG6 = $objSoapObject->G6;
		if (property_exists($objSoapObject, 'G7'))
			$objToReturn->strG7 = $objSoapObject->G7;
		if (property_exists($objSoapObject, 'G8'))
			$objToReturn->strG8 = $objSoapObject->G8;
		if (property_exists($objSoapObject, 'H0'))
			$objToReturn->strH0 = $objSoapObject->H0;
		if (property_exists($objSoapObject, 'H1'))
			$objToReturn->strH1 = $objSoapObject->H1;
		if (property_exists($objSoapObject, 'H2'))
			$objToReturn->strH2 = $objSoapObject->H2;
		if (property_exists($objSoapObject, 'H3'))
			$objToReturn->strH3 = $objSoapObject->H3;
		if (property_exists($objSoapObject, 'H4'))
			$objToReturn->strH4 = $objSoapObject->H4;
		if (property_exists($objSoapObject, 'H5'))
			$objToReturn->strH5 = $objSoapObject->H5;
		if (property_exists($objSoapObject, 'H6'))
			$objToReturn->strH6 = $objSoapObject->H6;
		if (property_exists($objSoapObject, 'H7'))
			$objToReturn->strH7 = $objSoapObject->H7;
		if (property_exists($objSoapObject, 'H8'))
			$objToReturn->strH8 = $objSoapObject->H8;
		if (property_exists($objSoapObject, 'I0'))
			$objToReturn->strI0 = $objSoapObject->I0;
		if (property_exists($objSoapObject, 'I1'))
			$objToReturn->strI1 = $objSoapObject->I1;
		if (property_exists($objSoapObject, 'I2'))
			$objToReturn->strI2 = $objSoapObject->I2;
		if (property_exists($objSoapObject, 'I3'))
			$objToReturn->strI3 = $objSoapObject->I3;
		if (property_exists($objSoapObject, 'I4'))
			$objToReturn->strI4 = $objSoapObject->I4;
		if (property_exists($objSoapObject, 'I5'))
			$objToReturn->strI5 = $objSoapObject->I5;
		if (property_exists($objSoapObject, 'I6'))
			$objToReturn->strI6 = $objSoapObject->I6;
		if (property_exists($objSoapObject, 'I7'))
			$objToReturn->strI7 = $objSoapObject->I7;
		if (property_exists($objSoapObject, 'I8'))
			$objToReturn->strI8 = $objSoapObject->I8;
		if (property_exists($objSoapObject, 'Username'))
			$objToReturn->strUsername = $objSoapObject->Username;
		if (property_exists($objSoapObject, 'Date'))
			$objToReturn->dttDate = new QDateTime($objSoapObject->Date);
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, Sampleloc::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->objBox)
			$objObject->objBox = Sampleboxes::GetSoapObjectFromObject($objObject->objBox, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intBoxId = null;
		if ($objObject->dttDate)
			$objObject->dttDate = $objObject->dttDate->toString(QDateTime::FormatSoap);
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeSampleloc extends QQNode {
	protected $strTableName = 'fm__sampleloc'; public static $strPubTableName = 'fm__sampleloc';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Sampleloc';
	public function __get($strName) {
		switch ($strName) {
			case 'BoxId':
				return new QQNode('box_id', 'integer', $this);
			case 'Box':
				return new QQNodeSampleboxes('box_id', 'integer', $this);
			case 'Samptype':
				return new QQNode('samptype', 'string', $this);
			case 'A0':
				return new QQNode('A0', 'string', $this);
			case 'A1':
				return new QQNode('A1', 'string', $this);
			case 'A2':
				return new QQNode('A2', 'string', $this);
			case 'A3':
				return new QQNode('A3', 'string', $this);
			case 'A4':
				return new QQNode('A4', 'string', $this);
			case 'A5':
				return new QQNode('A5', 'string', $this);
			case 'A6':
				return new QQNode('A6', 'string', $this);
			case 'A7':
				return new QQNode('A7', 'string', $this);
			case 'A8':
				return new QQNode('A8', 'string', $this);
			case 'B0':
				return new QQNode('B0', 'string', $this);
			case 'B1':
				return new QQNode('B1', 'string', $this);
			case 'B2':
				return new QQNode('B2', 'string', $this);
			case 'B3':
				return new QQNode('B3', 'string', $this);
			case 'B4':
				return new QQNode('B4', 'string', $this);
			case 'B5':
				return new QQNode('B5', 'string', $this);
			case 'B6':
				return new QQNode('B6', 'string', $this);
			case 'B7':
				return new QQNode('B7', 'string', $this);
			case 'B8':
				return new QQNode('B8', 'string', $this);
			case 'C0':
				return new QQNode('C0', 'string', $this);
			case 'C1':
				return new QQNode('C1', 'string', $this);
			case 'C2':
				return new QQNode('C2', 'string', $this);
			case 'C3':
				return new QQNode('C3', 'string', $this);
			case 'C4':
				return new QQNode('C4', 'string', $this);
			case 'C5':
				return new QQNode('C5', 'string', $this);
			case 'C6':
				return new QQNode('C6', 'string', $this);
			case 'C7':
				return new QQNode('C7', 'string', $this);
			case 'C8':
				return new QQNode('C8', 'string', $this);
			case 'D0':
				return new QQNode('D0', 'string', $this);
			case 'D1':
				return new QQNode('D1', 'string', $this);
			case 'D2':
				return new QQNode('D2', 'string', $this);
			case 'D3':
				return new QQNode('D3', 'string', $this);
			case 'D4':
				return new QQNode('D4', 'string', $this);
			case 'D5':
				return new QQNode('D5', 'string', $this);
			case 'D6':
				return new QQNode('D6', 'string', $this);
			case 'D7':
				return new QQNode('D7', 'string', $this);
			case 'D8':
				return new QQNode('D8', 'string', $this);
			case 'E0':
				return new QQNode('E0', 'string', $this);
			case 'E1':
				return new QQNode('E1', 'string', $this);
			case 'E2':
				return new QQNode('E2', 'string', $this);
			case 'E3':
				return new QQNode('E3', 'string', $this);
			case 'E4':
				return new QQNode('E4', 'string', $this);
			case 'E5':
				return new QQNode('E5', 'string', $this);
			case 'E6':
				return new QQNode('E6', 'string', $this);
			case 'E7':
				return new QQNode('E7', 'string', $this);
			case 'E8':
				return new QQNode('E8', 'string', $this);
			case 'F0':
				return new QQNode('F0', 'string', $this);
			case 'F1':
				return new QQNode('F1', 'string', $this);
			case 'F2':
				return new QQNode('F2', 'string', $this);
			case 'F3':
				return new QQNode('F3', 'string', $this);
			case 'F4':
				return new QQNode('F4', 'string', $this);
			case 'F5':
				return new QQNode('F5', 'string', $this);
			case 'F6':
				return new QQNode('F6', 'string', $this);
			case 'F7':
				return new QQNode('F7', 'string', $this);
			case 'F8':
				return new QQNode('F8', 'string', $this);
			case 'G0':
				return new QQNode('G0', 'string', $this);
			case 'G1':
				return new QQNode('G1', 'string', $this);
			case 'G2':
				return new QQNode('G2', 'string', $this);
			case 'G3':
				return new QQNode('G3', 'string', $this);
			case 'G4':
				return new QQNode('G4', 'string', $this);
			case 'G5':
				return new QQNode('G5', 'string', $this);
			case 'G6':
				return new QQNode('G6', 'string', $this);
			case 'G7':
				return new QQNode('G7', 'string', $this);
			case 'G8':
				return new QQNode('G8', 'string', $this);
			case 'H0':
				return new QQNode('H0', 'string', $this);
			case 'H1':
				return new QQNode('H1', 'string', $this);
			case 'H2':
				return new QQNode('H2', 'string', $this);
			case 'H3':
				return new QQNode('H3', 'string', $this);
			case 'H4':
				return new QQNode('H4', 'string', $this);
			case 'H5':
				return new QQNode('H5', 'string', $this);
			case 'H6':
				return new QQNode('H6', 'string', $this);
			case 'H7':
				return new QQNode('H7', 'string', $this);
			case 'H8':
				return new QQNode('H8', 'string', $this);
			case 'I0':
				return new QQNode('I0', 'string', $this);
			case 'I1':
				return new QQNode('I1', 'string', $this);
			case 'I2':
				return new QQNode('I2', 'string', $this);
			case 'I3':
				return new QQNode('I3', 'string', $this);
			case 'I4':
				return new QQNode('I4', 'string', $this);
			case 'I5':
				return new QQNode('I5', 'string', $this);
			case 'I6':
				return new QQNode('I6', 'string', $this);
			case 'I7':
				return new QQNode('I7', 'string', $this);
			case 'I8':
				return new QQNode('I8', 'string', $this);
			case 'Username':
				return new QQNode('username', 'string', $this);
			case 'Date':
				return new QQNode('date', 'QDateTime', $this);
			case 'Id':
				return new QQNode('id', 'integer', $this);

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

class QQReverseReferenceNodeSampleloc extends QQReverseReferenceNode {
	protected $strTableName = 'fm__sampleloc'; public static $strPubTableName = 'fm__sampleloc';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Sampleloc';
	public function __get($strName) {
		switch ($strName) {
			case 'BoxId':
				return new QQNode('box_id', 'integer', $this);
			case 'Box':
				return new QQNodeSampleboxes('box_id', 'integer', $this);
			case 'Samptype':
				return new QQNode('samptype', 'string', $this);
			case 'A0':
				return new QQNode('A0', 'string', $this);
			case 'A1':
				return new QQNode('A1', 'string', $this);
			case 'A2':
				return new QQNode('A2', 'string', $this);
			case 'A3':
				return new QQNode('A3', 'string', $this);
			case 'A4':
				return new QQNode('A4', 'string', $this);
			case 'A5':
				return new QQNode('A5', 'string', $this);
			case 'A6':
				return new QQNode('A6', 'string', $this);
			case 'A7':
				return new QQNode('A7', 'string', $this);
			case 'A8':
				return new QQNode('A8', 'string', $this);
			case 'B0':
				return new QQNode('B0', 'string', $this);
			case 'B1':
				return new QQNode('B1', 'string', $this);
			case 'B2':
				return new QQNode('B2', 'string', $this);
			case 'B3':
				return new QQNode('B3', 'string', $this);
			case 'B4':
				return new QQNode('B4', 'string', $this);
			case 'B5':
				return new QQNode('B5', 'string', $this);
			case 'B6':
				return new QQNode('B6', 'string', $this);
			case 'B7':
				return new QQNode('B7', 'string', $this);
			case 'B8':
				return new QQNode('B8', 'string', $this);
			case 'C0':
				return new QQNode('C0', 'string', $this);
			case 'C1':
				return new QQNode('C1', 'string', $this);
			case 'C2':
				return new QQNode('C2', 'string', $this);
			case 'C3':
				return new QQNode('C3', 'string', $this);
			case 'C4':
				return new QQNode('C4', 'string', $this);
			case 'C5':
				return new QQNode('C5', 'string', $this);
			case 'C6':
				return new QQNode('C6', 'string', $this);
			case 'C7':
				return new QQNode('C7', 'string', $this);
			case 'C8':
				return new QQNode('C8', 'string', $this);
			case 'D0':
				return new QQNode('D0', 'string', $this);
			case 'D1':
				return new QQNode('D1', 'string', $this);
			case 'D2':
				return new QQNode('D2', 'string', $this);
			case 'D3':
				return new QQNode('D3', 'string', $this);
			case 'D4':
				return new QQNode('D4', 'string', $this);
			case 'D5':
				return new QQNode('D5', 'string', $this);
			case 'D6':
				return new QQNode('D6', 'string', $this);
			case 'D7':
				return new QQNode('D7', 'string', $this);
			case 'D8':
				return new QQNode('D8', 'string', $this);
			case 'E0':
				return new QQNode('E0', 'string', $this);
			case 'E1':
				return new QQNode('E1', 'string', $this);
			case 'E2':
				return new QQNode('E2', 'string', $this);
			case 'E3':
				return new QQNode('E3', 'string', $this);
			case 'E4':
				return new QQNode('E4', 'string', $this);
			case 'E5':
				return new QQNode('E5', 'string', $this);
			case 'E6':
				return new QQNode('E6', 'string', $this);
			case 'E7':
				return new QQNode('E7', 'string', $this);
			case 'E8':
				return new QQNode('E8', 'string', $this);
			case 'F0':
				return new QQNode('F0', 'string', $this);
			case 'F1':
				return new QQNode('F1', 'string', $this);
			case 'F2':
				return new QQNode('F2', 'string', $this);
			case 'F3':
				return new QQNode('F3', 'string', $this);
			case 'F4':
				return new QQNode('F4', 'string', $this);
			case 'F5':
				return new QQNode('F5', 'string', $this);
			case 'F6':
				return new QQNode('F6', 'string', $this);
			case 'F7':
				return new QQNode('F7', 'string', $this);
			case 'F8':
				return new QQNode('F8', 'string', $this);
			case 'G0':
				return new QQNode('G0', 'string', $this);
			case 'G1':
				return new QQNode('G1', 'string', $this);
			case 'G2':
				return new QQNode('G2', 'string', $this);
			case 'G3':
				return new QQNode('G3', 'string', $this);
			case 'G4':
				return new QQNode('G4', 'string', $this);
			case 'G5':
				return new QQNode('G5', 'string', $this);
			case 'G6':
				return new QQNode('G6', 'string', $this);
			case 'G7':
				return new QQNode('G7', 'string', $this);
			case 'G8':
				return new QQNode('G8', 'string', $this);
			case 'H0':
				return new QQNode('H0', 'string', $this);
			case 'H1':
				return new QQNode('H1', 'string', $this);
			case 'H2':
				return new QQNode('H2', 'string', $this);
			case 'H3':
				return new QQNode('H3', 'string', $this);
			case 'H4':
				return new QQNode('H4', 'string', $this);
			case 'H5':
				return new QQNode('H5', 'string', $this);
			case 'H6':
				return new QQNode('H6', 'string', $this);
			case 'H7':
				return new QQNode('H7', 'string', $this);
			case 'H8':
				return new QQNode('H8', 'string', $this);
			case 'I0':
				return new QQNode('I0', 'string', $this);
			case 'I1':
				return new QQNode('I1', 'string', $this);
			case 'I2':
				return new QQNode('I2', 'string', $this);
			case 'I3':
				return new QQNode('I3', 'string', $this);
			case 'I4':
				return new QQNode('I4', 'string', $this);
			case 'I5':
				return new QQNode('I5', 'string', $this);
			case 'I6':
				return new QQNode('I6', 'string', $this);
			case 'I7':
				return new QQNode('I7', 'string', $this);
			case 'I8':
				return new QQNode('I8', 'string', $this);
			case 'Username':
				return new QQNode('username', 'string', $this);
			case 'Date':
				return new QQNode('date', 'QDateTime', $this);
			case 'Id':
				return new QQNode('id', 'integer', $this);

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