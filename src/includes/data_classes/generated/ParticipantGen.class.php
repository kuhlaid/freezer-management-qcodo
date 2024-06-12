<?php
/**
 * The abstract ParticipantGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Participant subclass which
 * extends this ParticipantGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Participant class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class ParticipantGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a Participant from PK Info
	 * @param integer $intId
	 * @return Participant
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return Participant::QuerySingle(
				QQ::Equal(QQN::Participant()->Id, $intId)
		);
	}

	/**
	 * Load all Participants
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadAll query
		try {
			return Participant::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all Participants
	 * @return int
	 */
	public static function CountAll() {
		// Call Participant::QueryCount to perform the CountAll query
		return Participant::QueryCount(QQ::All());
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
		$objDatabase = Participant::GetDatabase();

		// Create/Build out the QueryBuilder object with Participant-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'pt__participant');
		Participant::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('pt__participant AS pt__participant');

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
	 * Static Qcodo Query method to query for a single Participant object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Participant the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Participant::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new Participant object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Participant::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of Participant objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Participant[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Participant::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Participant::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of Participant objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Participant::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = Participant::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'participant_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Participant-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	Participant::GetSelectFields($objQueryBuilder);
	Participant::GetFromFields($objQueryBuilder);

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
	return Participant::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this Participant
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'pt__participant';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.caseid AS ' . $strAliasPrefix . 'caseid');
			$objBuilder->AddSelectItem($strTableName . '.title AS ' . $strAliasPrefix . 'title');
			$objBuilder->AddSelectItem($strTableName . '.lastname AS ' . $strAliasPrefix . 'lastname');
			$objBuilder->AddSelectItem($strTableName . '.firstname AS ' . $strAliasPrefix . 'firstname');
			$objBuilder->AddSelectItem($strTableName . '.middlename AS ' . $strAliasPrefix . 'middlename');
			$objBuilder->AddSelectItem($strTableName . '.maidenname AS ' . $strAliasPrefix . 'maidenname');
			$objBuilder->AddSelectItem($strTableName . '.nickname AS ' . $strAliasPrefix . 'nickname');
			$objBuilder->AddSelectItem($strTableName . '.street AS ' . $strAliasPrefix . 'street');
			$objBuilder->AddSelectItem($strTableName . '.streetsort AS ' . $strAliasPrefix . 'streetsort');
			$objBuilder->AddSelectItem($strTableName . '.pobox AS ' . $strAliasPrefix . 'pobox');
			$objBuilder->AddSelectItem($strTableName . '.city AS ' . $strAliasPrefix . 'city');
			$objBuilder->AddSelectItem($strTableName . '.state AS ' . $strAliasPrefix . 'state');
			$objBuilder->AddSelectItem($strTableName . '.zip AS ' . $strAliasPrefix . 'zip');
			$objBuilder->AddSelectItem($strTableName . '.homephone AS ' . $strAliasPrefix . 'homephone');
			$objBuilder->AddSelectItem($strTableName . '.otherphone AS ' . $strAliasPrefix . 'otherphone');
			$objBuilder->AddSelectItem($strTableName . '.gender AS ' . $strAliasPrefix . 'gender');
			$objBuilder->AddSelectItem($strTableName . '.race AS ' . $strAliasPrefix . 'race');
			$objBuilder->AddSelectItem($strTableName . '.dateofbirth AS ' . $strAliasPrefix . 'dateofbirth');
			$objBuilder->AddSelectItem($strTableName . '.numhouse AS ' . $strAliasPrefix . 'numhouse');
			$objBuilder->AddSelectItem($strTableName . '.typedwelling AS ' . $strAliasPrefix . 'typedwelling');
			$objBuilder->AddSelectItem($strTableName . '.typedwellingother AS ' . $strAliasPrefix . 'typedwellingother');
			$objBuilder->AddSelectItem($strTableName . '.rentorown AS ' . $strAliasPrefix . 'rentorown');
			$objBuilder->AddSelectItem($strTableName . '.rentorownother AS ' . $strAliasPrefix . 'rentorownother');
			$objBuilder->AddSelectItem($strTableName . '.maritalstatus AS ' . $strAliasPrefix . 'maritalstatus');
			$objBuilder->AddSelectItem($strTableName . '.email AS ' . $strAliasPrefix . 'email');
			$objBuilder->AddSelectItem($strTableName . '.c1name AS ' . $strAliasPrefix . 'c1name');
			$objBuilder->AddSelectItem($strTableName . '.c1street AS ' . $strAliasPrefix . 'c1street');
			$objBuilder->AddSelectItem($strTableName . '.c1pobox AS ' . $strAliasPrefix . 'c1pobox');
			$objBuilder->AddSelectItem($strTableName . '.c1city AS ' . $strAliasPrefix . 'c1city');
			$objBuilder->AddSelectItem($strTableName . '.c1state AS ' . $strAliasPrefix . 'c1state');
			$objBuilder->AddSelectItem($strTableName . '.c1zip AS ' . $strAliasPrefix . 'c1zip');
			$objBuilder->AddSelectItem($strTableName . '.c1phone AS ' . $strAliasPrefix . 'c1phone');
			$objBuilder->AddSelectItem($strTableName . '.c1relation AS ' . $strAliasPrefix . 'c1relation');
			$objBuilder->AddSelectItem($strTableName . '.c2name AS ' . $strAliasPrefix . 'c2name');
			$objBuilder->AddSelectItem($strTableName . '.c2street AS ' . $strAliasPrefix . 'c2street');
			$objBuilder->AddSelectItem($strTableName . '.c2pobox AS ' . $strAliasPrefix . 'c2pobox');
			$objBuilder->AddSelectItem($strTableName . '.c2city AS ' . $strAliasPrefix . 'c2city');
			$objBuilder->AddSelectItem($strTableName . '.c2state AS ' . $strAliasPrefix . 'c2state');
			$objBuilder->AddSelectItem($strTableName . '.c2zip AS ' . $strAliasPrefix . 'c2zip');
			$objBuilder->AddSelectItem($strTableName . '.c2phone AS ' . $strAliasPrefix . 'c2phone');
			$objBuilder->AddSelectItem($strTableName . '.c2relation AS ' . $strAliasPrefix . 'c2relation');
			$objBuilder->AddSelectItem($strTableName . '.c3name AS ' . $strAliasPrefix . 'c3name');
			$objBuilder->AddSelectItem($strTableName . '.c3street AS ' . $strAliasPrefix . 'c3street');
			$objBuilder->AddSelectItem($strTableName . '.c3pobox AS ' . $strAliasPrefix . 'c3pobox');
			$objBuilder->AddSelectItem($strTableName . '.c3city AS ' . $strAliasPrefix . 'c3city');
			$objBuilder->AddSelectItem($strTableName . '.c3state AS ' . $strAliasPrefix . 'c3state');
			$objBuilder->AddSelectItem($strTableName . '.c3zip AS ' . $strAliasPrefix . 'c3zip');
			$objBuilder->AddSelectItem($strTableName . '.c3phone AS ' . $strAliasPrefix . 'c3phone');
			$objBuilder->AddSelectItem($strTableName . '.c3relation AS ' . $strAliasPrefix . 'c3relation');
			$objBuilder->AddSelectItem($strTableName . '.basecode AS ' . $strAliasPrefix . 'basecode');
			$objBuilder->AddSelectItem($strTableName . '.f1code AS ' . $strAliasPrefix . 'f1code');
			$objBuilder->AddSelectItem($strTableName . '.necode AS ' . $strAliasPrefix . 'necode');
			$objBuilder->AddSelectItem($strTableName . '.currentcode AS ' . $strAliasPrefix . 'currentcode');
			$objBuilder->AddSelectItem($strTableName . '.postcode AS ' . $strAliasPrefix . 'postcode');
			$objBuilder->AddSelectItem($strTableName . '.base1stint AS ' . $strAliasPrefix . 'base1stint');
			$objBuilder->AddSelectItem($strTableName . '.baseclinic AS ' . $strAliasPrefix . 'baseclinic');
			$objBuilder->AddSelectItem($strTableName . '.base2ndint AS ' . $strAliasPrefix . 'base2ndint');
			$objBuilder->AddSelectItem($strTableName . '.f11stint AS ' . $strAliasPrefix . 'f11stint');
			$objBuilder->AddSelectItem($strTableName . '.f1clinic AS ' . $strAliasPrefix . 'f1clinic');
			$objBuilder->AddSelectItem($strTableName . '.f12ndint AS ' . $strAliasPrefix . 'f12ndint');
			$objBuilder->AddSelectItem($strTableName . '.ne1stint AS ' . $strAliasPrefix . 'ne1stint');
			$objBuilder->AddSelectItem($strTableName . '.neclinic AS ' . $strAliasPrefix . 'neclinic');
			$objBuilder->AddSelectItem($strTableName . '.ne2ndint AS ' . $strAliasPrefix . 'ne2ndint');
			$objBuilder->AddSelectItem($strTableName . '.f21stint AS ' . $strAliasPrefix . 'f21stint');
			$objBuilder->AddSelectItem($strTableName . '.f2clinic AS ' . $strAliasPrefix . 'f2clinic');
			$objBuilder->AddSelectItem($strTableName . '.f22ndint AS ' . $strAliasPrefix . 'f22ndint');
			$objBuilder->AddSelectItem($strTableName . '.buddyid AS ' . $strAliasPrefix . 'buddyid');
			$objBuilder->AddSelectItem($strTableName . '.buddydate AS ' . $strAliasPrefix . 'buddydate');
			$objBuilder->AddSelectItem($strTableName . '.acesid AS ' . $strAliasPrefix . 'acesid');
			$objBuilder->AddSelectItem($strTableName . '.aces1stint AS ' . $strAliasPrefix . 'aces1stint');
			$objBuilder->AddSelectItem($strTableName . '.aces2ndint AS ' . $strAliasPrefix . 'aces2ndint');
			$objBuilder->AddSelectItem($strTableName . '.gogoindid AS ' . $strAliasPrefix . 'gogoindid');
			$objBuilder->AddSelectItem($strTableName . '.gogofamid AS ' . $strAliasPrefix . 'gogofamid');
			$objBuilder->AddSelectItem($strTableName . '.gogodate AS ' . $strAliasPrefix . 'gogodate');
			$objBuilder->AddSelectItem($strTableName . '.gogolongid AS ' . $strAliasPrefix . 'gogolongid');
			$objBuilder->AddSelectItem($strTableName . '.gogolongdate AS ' . $strAliasPrefix . 'gogolongdate');
			$objBuilder->AddSelectItem($strTableName . '.joproid AS ' . $strAliasPrefix . 'joproid');
			$objBuilder->AddSelectItem($strTableName . '.joprodate AS ' . $strAliasPrefix . 'joprodate');
			$objBuilder->AddSelectItem($strTableName . '.joprocont AS ' . $strAliasPrefix . 'joprocont');
			$objBuilder->AddSelectItem($strTableName . '.joprocomp AS ' . $strAliasPrefix . 'joprocomp');
			$objBuilder->AddSelectItem($strTableName . '.lastcodeupdate AS ' . $strAliasPrefix . 'lastcodeupdate');
			$objBuilder->AddSelectItem($strTableName . '.postcodeupdate AS ' . $strAliasPrefix . 'postcodeupdate');
			$objBuilder->AddSelectItem($strTableName . '.t0weight AS ' . $strAliasPrefix . 't0weight');
			$objBuilder->AddSelectItem($strTableName . '.t1weight AS ' . $strAliasPrefix . 't1weight');
			$objBuilder->AddSelectItem($strTableName . '.notes AS ' . $strAliasPrefix . 'notes');
			$objBuilder->AddSelectItem($strTableName . '.otherstudy AS ' . $strAliasPrefix . 'otherstudy');
			$objBuilder->AddSelectItem($strTableName . '.homeinterviewer AS ' . $strAliasPrefix . 'homeinterviewer');
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.interviewer_id AS ' . $strAliasPrefix . 'interviewer_id');
			$objBuilder->AddSelectItem($strTableName . '.audit_id AS ' . $strAliasPrefix . 'audit_id');
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
	 * Instantiate a Participant from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this Participant::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return Participant
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
				$strAliasPrefix = 'participant__';


			if ((array_key_exists($strAliasPrefix . 'calllog__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'calllog__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objCalllogArray)) {
					$objPreviousChildItem = $objPreviousItem->_objCalllogArray[$intPreviousChildItemCount - 1];
					$objChildItem = Calllog::InstantiateDbRow($objDbRow, $strAliasPrefix . 'calllog__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objCalllogArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objCalllogArray, Calllog::InstantiateDbRow($objDbRow, $strAliasPrefix . 'calllog__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			if ((array_key_exists($strAliasPrefix . 't3sch__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 't3sch__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objT3SchArray)) {
					$objPreviousChildItem = $objPreviousItem->_objT3SchArray[$intPreviousChildItemCount - 1];
					$objChildItem = T3Sch::InstantiateDbRow($objDbRow, $strAliasPrefix . 't3sch__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objT3SchArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objT3SchArray, T3Sch::InstantiateDbRow($objDbRow, $strAliasPrefix . 't3sch__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'participant__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the Participant object
		$objToReturn = new Participant();
		$objToReturn->__blnRestored = true;

		$objToReturn->strCaseid = $objDbRow->GetColumn($strAliasPrefix . 'caseid', 'VarChar');
		$objToReturn->strTitle = $objDbRow->GetColumn($strAliasPrefix . 'title', 'VarChar');
		$objToReturn->strLastname = $objDbRow->GetColumn($strAliasPrefix . 'lastname', 'VarChar');
		$objToReturn->strFirstname = $objDbRow->GetColumn($strAliasPrefix . 'firstname', 'VarChar');
		$objToReturn->strMiddlename = $objDbRow->GetColumn($strAliasPrefix . 'middlename', 'VarChar');
		$objToReturn->strMaidenname = $objDbRow->GetColumn($strAliasPrefix . 'maidenname', 'VarChar');
		$objToReturn->strNickname = $objDbRow->GetColumn($strAliasPrefix . 'nickname', 'VarChar');
		$objToReturn->strStreet = $objDbRow->GetColumn($strAliasPrefix . 'street', 'VarChar');
		$objToReturn->strStreetsort = $objDbRow->GetColumn($strAliasPrefix . 'streetsort', 'VarChar');
		$objToReturn->strPobox = $objDbRow->GetColumn($strAliasPrefix . 'pobox', 'VarChar');
		$objToReturn->strCity = $objDbRow->GetColumn($strAliasPrefix . 'city', 'VarChar');
		$objToReturn->strState = $objDbRow->GetColumn($strAliasPrefix . 'state', 'VarChar');
		$objToReturn->strZip = $objDbRow->GetColumn($strAliasPrefix . 'zip', 'VarChar');
		$objToReturn->strHomephone = $objDbRow->GetColumn($strAliasPrefix . 'homephone', 'VarChar');
		$objToReturn->strOtherphone = $objDbRow->GetColumn($strAliasPrefix . 'otherphone', 'VarChar');
		$objToReturn->strGender = $objDbRow->GetColumn($strAliasPrefix . 'gender', 'Char');
		$objToReturn->strRace = $objDbRow->GetColumn($strAliasPrefix . 'race', 'Char');
		$objToReturn->dttDateofbirth = $objDbRow->GetColumn($strAliasPrefix . 'dateofbirth', 'Date');
		$objToReturn->intNumhouse = $objDbRow->GetColumn($strAliasPrefix . 'numhouse', 'Integer');
		$objToReturn->strTypedwelling = $objDbRow->GetColumn($strAliasPrefix . 'typedwelling', 'VarChar');
		$objToReturn->strTypedwellingother = $objDbRow->GetColumn($strAliasPrefix . 'typedwellingother', 'VarChar');
		$objToReturn->strRentorown = $objDbRow->GetColumn($strAliasPrefix . 'rentorown', 'VarChar');
		$objToReturn->strRentorownother = $objDbRow->GetColumn($strAliasPrefix . 'rentorownother', 'VarChar');
		$objToReturn->strMaritalstatus = $objDbRow->GetColumn($strAliasPrefix . 'maritalstatus', 'Char');
		$objToReturn->strEmail = $objDbRow->GetColumn($strAliasPrefix . 'email', 'VarChar');
		$objToReturn->strC1name = $objDbRow->GetColumn($strAliasPrefix . 'c1name', 'VarChar');
		$objToReturn->strC1street = $objDbRow->GetColumn($strAliasPrefix . 'c1street', 'VarChar');
		$objToReturn->strC1pobox = $objDbRow->GetColumn($strAliasPrefix . 'c1pobox', 'VarChar');
		$objToReturn->strC1city = $objDbRow->GetColumn($strAliasPrefix . 'c1city', 'VarChar');
		$objToReturn->strC1state = $objDbRow->GetColumn($strAliasPrefix . 'c1state', 'VarChar');
		$objToReturn->strC1zip = $objDbRow->GetColumn($strAliasPrefix . 'c1zip', 'VarChar');
		$objToReturn->strC1phone = $objDbRow->GetColumn($strAliasPrefix . 'c1phone', 'VarChar');
		$objToReturn->strC1relation = $objDbRow->GetColumn($strAliasPrefix . 'c1relation', 'VarChar');
		$objToReturn->strC2name = $objDbRow->GetColumn($strAliasPrefix . 'c2name', 'VarChar');
		$objToReturn->strC2street = $objDbRow->GetColumn($strAliasPrefix . 'c2street', 'VarChar');
		$objToReturn->strC2pobox = $objDbRow->GetColumn($strAliasPrefix . 'c2pobox', 'VarChar');
		$objToReturn->strC2city = $objDbRow->GetColumn($strAliasPrefix . 'c2city', 'VarChar');
		$objToReturn->strC2state = $objDbRow->GetColumn($strAliasPrefix . 'c2state', 'VarChar');
		$objToReturn->strC2zip = $objDbRow->GetColumn($strAliasPrefix . 'c2zip', 'VarChar');
		$objToReturn->strC2phone = $objDbRow->GetColumn($strAliasPrefix . 'c2phone', 'VarChar');
		$objToReturn->strC2relation = $objDbRow->GetColumn($strAliasPrefix . 'c2relation', 'VarChar');
		$objToReturn->strC3name = $objDbRow->GetColumn($strAliasPrefix . 'c3name', 'VarChar');
		$objToReturn->strC3street = $objDbRow->GetColumn($strAliasPrefix . 'c3street', 'VarChar');
		$objToReturn->strC3pobox = $objDbRow->GetColumn($strAliasPrefix . 'c3pobox', 'VarChar');
		$objToReturn->strC3city = $objDbRow->GetColumn($strAliasPrefix . 'c3city', 'VarChar');
		$objToReturn->strC3state = $objDbRow->GetColumn($strAliasPrefix . 'c3state', 'VarChar');
		$objToReturn->strC3zip = $objDbRow->GetColumn($strAliasPrefix . 'c3zip', 'VarChar');
		$objToReturn->strC3phone = $objDbRow->GetColumn($strAliasPrefix . 'c3phone', 'VarChar');
		$objToReturn->strC3relation = $objDbRow->GetColumn($strAliasPrefix . 'c3relation', 'VarChar');
		$objToReturn->intBasecode = $objDbRow->GetColumn($strAliasPrefix . 'basecode', 'Integer');
		$objToReturn->intF1code = $objDbRow->GetColumn($strAliasPrefix . 'f1code', 'Integer');
		$objToReturn->intNecode = $objDbRow->GetColumn($strAliasPrefix . 'necode', 'Integer');
		$objToReturn->intCurrentcode = $objDbRow->GetColumn($strAliasPrefix . 'currentcode', 'Integer');
		$objToReturn->intPostcode = $objDbRow->GetColumn($strAliasPrefix . 'postcode', 'Integer');
		$objToReturn->dttBase1stint = $objDbRow->GetColumn($strAliasPrefix . 'base1stint', 'Date');
		$objToReturn->dttBaseclinic = $objDbRow->GetColumn($strAliasPrefix . 'baseclinic', 'Date');
		$objToReturn->dttBase2ndint = $objDbRow->GetColumn($strAliasPrefix . 'base2ndint', 'Date');
		$objToReturn->dttF11stint = $objDbRow->GetColumn($strAliasPrefix . 'f11stint', 'Date');
		$objToReturn->dttF1clinic = $objDbRow->GetColumn($strAliasPrefix . 'f1clinic', 'Date');
		$objToReturn->dttF12ndint = $objDbRow->GetColumn($strAliasPrefix . 'f12ndint', 'Date');
		$objToReturn->dttNe1stint = $objDbRow->GetColumn($strAliasPrefix . 'ne1stint', 'Date');
		$objToReturn->dttNeclinic = $objDbRow->GetColumn($strAliasPrefix . 'neclinic', 'Date');
		$objToReturn->dttNe2ndint = $objDbRow->GetColumn($strAliasPrefix . 'ne2ndint', 'Date');
		$objToReturn->dttF21stint = $objDbRow->GetColumn($strAliasPrefix . 'f21stint', 'Date');
		$objToReturn->dttF2clinic = $objDbRow->GetColumn($strAliasPrefix . 'f2clinic', 'Date');
		$objToReturn->dttF22ndint = $objDbRow->GetColumn($strAliasPrefix . 'f22ndint', 'Date');
		$objToReturn->intBuddyid = $objDbRow->GetColumn($strAliasPrefix . 'buddyid', 'Integer');
		$objToReturn->dttBuddydate = $objDbRow->GetColumn($strAliasPrefix . 'buddydate', 'Date');
		$objToReturn->strAcesid = $objDbRow->GetColumn($strAliasPrefix . 'acesid', 'VarChar');
		$objToReturn->dttAces1stint = $objDbRow->GetColumn($strAliasPrefix . 'aces1stint', 'Date');
		$objToReturn->dttAces2ndint = $objDbRow->GetColumn($strAliasPrefix . 'aces2ndint', 'Date');
		$objToReturn->intGogoindid = $objDbRow->GetColumn($strAliasPrefix . 'gogoindid', 'Integer');
		$objToReturn->intGogofamid = $objDbRow->GetColumn($strAliasPrefix . 'gogofamid', 'Integer');
		$objToReturn->dttGogodate = $objDbRow->GetColumn($strAliasPrefix . 'gogodate', 'Date');
		$objToReturn->intGogolongid = $objDbRow->GetColumn($strAliasPrefix . 'gogolongid', 'Integer');
		$objToReturn->dttGogolongdate = $objDbRow->GetColumn($strAliasPrefix . 'gogolongdate', 'Date');
		$objToReturn->strJoproid = $objDbRow->GetColumn($strAliasPrefix . 'joproid', 'VarChar');
		$objToReturn->dttJoprodate = $objDbRow->GetColumn($strAliasPrefix . 'joprodate', 'Date');
		$objToReturn->intJoprocont = $objDbRow->GetColumn($strAliasPrefix . 'joprocont', 'Integer');
		$objToReturn->intJoprocomp = $objDbRow->GetColumn($strAliasPrefix . 'joprocomp', 'Integer');
		$objToReturn->dttLastcodeupdate = $objDbRow->GetColumn($strAliasPrefix . 'lastcodeupdate', 'Date');
		$objToReturn->dttPostcodeupdate = $objDbRow->GetColumn($strAliasPrefix . 'postcodeupdate', 'Date');
		$objToReturn->fltT0weight = $objDbRow->GetColumn($strAliasPrefix . 't0weight', 'Float');
		$objToReturn->fltT1weight = $objDbRow->GetColumn($strAliasPrefix . 't1weight', 'Float');
		$objToReturn->strNotes = $objDbRow->GetColumn($strAliasPrefix . 'notes', 'VarChar');
		$objToReturn->strOtherstudy = $objDbRow->GetColumn($strAliasPrefix . 'otherstudy', 'Char');
		$objToReturn->strHomeinterviewer = $objDbRow->GetColumn($strAliasPrefix . 'homeinterviewer', 'VarChar');
		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->intInterviewerId = $objDbRow->GetColumn($strAliasPrefix . 'interviewer_id', 'Integer');
		$objToReturn->intAuditId = $objDbRow->GetColumn($strAliasPrefix . 'audit_id', 'Integer');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'participant__';

		// Check for Interviewer Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'interviewer_id__userid')))
			$objToReturn->objInterviewer = User::InstantiateDbRow($objDbRow, $strAliasPrefix . 'interviewer_id__', $strExpandAsArrayNodes);




		// Check for Calllog Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'calllog__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'calllog__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objCalllogArray, Calllog::InstantiateDbRow($objDbRow, $strAliasPrefix . 'calllog__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objCalllog = Calllog::InstantiateDbRow($objDbRow, $strAliasPrefix . 'calllog__', $strExpandAsArrayNodes);
		}

		// Check for T3Sch Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 't3sch__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 't3sch__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objT3SchArray, T3Sch::InstantiateDbRow($objDbRow, $strAliasPrefix . 't3sch__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objT3Sch = T3Sch::InstantiateDbRow($objDbRow, $strAliasPrefix . 't3sch__', $strExpandAsArrayNodes);
		}

		return $objToReturn;
	}

	/**
	 * Instantiate an array of Participants from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return Participant[]
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
				$objItem = Participant::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, Participant::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single Participant object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return Participant
	 */
	public static function LoadById($intId) {
		return Participant::QuerySingle(
				QQ::Equal(QQN::Participant()->Id, $intId)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by Acesid Index(es)
	 * @param string $strAcesid
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByAcesid($strAcesid, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByAcesid query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->Acesid, $strAcesid),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by Acesid Index(es)
	 * @param string $strAcesid
	 * @return int
		*/
	public static function CountByAcesid($strAcesid) {
		// Call Participant::QueryCount to perform the CountByAcesid query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->Acesid, $strAcesid)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by Basecode Index(es)
	 * @param integer $intBasecode
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByBasecode($intBasecode, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByBasecode query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->Basecode, $intBasecode),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by Basecode Index(es)
	 * @param integer $intBasecode
	 * @return int
		*/
	public static function CountByBasecode($intBasecode) {
		// Call Participant::QueryCount to perform the CountByBasecode query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->Basecode, $intBasecode)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by Buddyid Index(es)
	 * @param integer $intBuddyid
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByBuddyid($intBuddyid, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByBuddyid query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->Buddyid, $intBuddyid),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by Buddyid Index(es)
	 * @param integer $intBuddyid
	 * @return int
		*/
	public static function CountByBuddyid($intBuddyid) {
		// Call Participant::QueryCount to perform the CountByBuddyid query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->Buddyid, $intBuddyid)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by InterviewerId Index(es)
	 * @param integer $intInterviewerId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByInterviewerId($intInterviewerId, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByInterviewerId query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->InterviewerId, $intInterviewerId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by InterviewerId Index(es)
	 * @param integer $intInterviewerId
	 * @return int
		*/
	public static function CountByInterviewerId($intInterviewerId) {
		// Call Participant::QueryCount to perform the CountByInterviewerId query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->InterviewerId, $intInterviewerId)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by F1code Index(es)
	 * @param integer $intF1code
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByF1code($intF1code, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByF1code query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->F1code, $intF1code),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by F1code Index(es)
	 * @param integer $intF1code
	 * @return int
		*/
	public static function CountByF1code($intF1code) {
		// Call Participant::QueryCount to perform the CountByF1code query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->F1code, $intF1code)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by Gogofamid Index(es)
	 * @param integer $intGogofamid
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByGogofamid($intGogofamid, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByGogofamid query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->Gogofamid, $intGogofamid),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by Gogofamid Index(es)
	 * @param integer $intGogofamid
	 * @return int
		*/
	public static function CountByGogofamid($intGogofamid) {
		// Call Participant::QueryCount to perform the CountByGogofamid query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->Gogofamid, $intGogofamid)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by Gogoindid Index(es)
	 * @param integer $intGogoindid
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByGogoindid($intGogoindid, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByGogoindid query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->Gogoindid, $intGogoindid),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by Gogoindid Index(es)
	 * @param integer $intGogoindid
	 * @return int
		*/
	public static function CountByGogoindid($intGogoindid) {
		// Call Participant::QueryCount to perform the CountByGogoindid query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->Gogoindid, $intGogoindid)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by Gogolongid Index(es)
	 * @param integer $intGogolongid
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByGogolongid($intGogolongid, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByGogolongid query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->Gogolongid, $intGogolongid),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by Gogolongid Index(es)
	 * @param integer $intGogolongid
	 * @return int
		*/
	public static function CountByGogolongid($intGogolongid) {
		// Call Participant::QueryCount to perform the CountByGogolongid query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->Gogolongid, $intGogolongid)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by Necode Index(es)
	 * @param integer $intNecode
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByNecode($intNecode, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByNecode query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->Necode, $intNecode),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by Necode Index(es)
	 * @param integer $intNecode
	 * @return int
		*/
	public static function CountByNecode($intNecode) {
		// Call Participant::QueryCount to perform the CountByNecode query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->Necode, $intNecode)
		);
	}

	/**
	 * Load an array of Participant objects,
	 * by Zip Index(es)
	 * @param string $strZip
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Participant[]
		*/
	public static function LoadArrayByZip($strZip, $objOptionalClauses = null) {
		// Call Participant::QueryArray to perform the LoadArrayByZip query
		try {
			return Participant::QueryArray(
					QQ::Equal(QQN::Participant()->Zip, $strZip),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Participants
	 * by Zip Index(es)
	 * @param string $strZip
	 * @return int
		*/
	public static function CountByZip($strZip) {
		// Call Participant::QueryCount to perform the CountByZip query
		return Participant::QueryCount(
				QQ::Equal(QQN::Participant()->Zip, $strZip)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this Participant
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeParticipant::$strPubTableName.' (
						caseid,
						title,
						lastname,
						firstname,
						middlename,
						maidenname,
						nickname,
						street,
						streetsort,
						pobox,
						city,
						state,
						zip,
						homephone,
						otherphone,
						gender,
						race,
						dateofbirth,
						numhouse,
						typedwelling,
						typedwellingother,
						rentorown,
						rentorownother,
						maritalstatus,
						email,
						c1name,
						c1street,
						c1pobox,
						c1city,
						c1state,
						c1zip,
						c1phone,
						c1relation,
						c2name,
						c2street,
						c2pobox,
						c2city,
						c2state,
						c2zip,
						c2phone,
						c2relation,
						c3name,
						c3street,
						c3pobox,
						c3city,
						c3state,
						c3zip,
						c3phone,
						c3relation,
						basecode,
						f1code,
						necode,
						currentcode,
						postcode,
						base1stint,
						baseclinic,
						base2ndint,
						f11stint,
						f1clinic,
						f12ndint,
						ne1stint,
						neclinic,
						ne2ndint,
						f21stint,
						f2clinic,
						f22ndint,
						buddyid,
						buddydate,
						acesid,
						aces1stint,
						aces2ndint,
						gogoindid,
						gogofamid,
						gogodate,
						gogolongid,
						gogolongdate,
						joproid,
						joprodate,
						joprocont,
						joprocomp,
						lastcodeupdate,
						postcodeupdate,
						t0weight,
						t1weight,
						notes,
						otherstudy,
						homeinterviewer,
						interviewer_id,
						audit_id
						) VALUES (
						' . $objDatabase->SqlVariable($this->strCaseid) . ',
								' . $objDatabase->SqlVariable($this->strTitle) . ',
										' . $objDatabase->SqlVariable($this->strLastname) . ',
												' . $objDatabase->SqlVariable($this->strFirstname) . ',
														' . $objDatabase->SqlVariable($this->strMiddlename) . ',
																' . $objDatabase->SqlVariable($this->strMaidenname) . ',
																		' . $objDatabase->SqlVariable($this->strNickname) . ',
																				' . $objDatabase->SqlVariable($this->strStreet) . ',
																						' . $objDatabase->SqlVariable($this->strStreetsort) . ',
																								' . $objDatabase->SqlVariable($this->strPobox) . ',
																										' . $objDatabase->SqlVariable($this->strCity) . ',
																												' . $objDatabase->SqlVariable($this->strState) . ',
																														' . $objDatabase->SqlVariable($this->strZip) . ',
																																' . $objDatabase->SqlVariable($this->strHomephone) . ',
																																		' . $objDatabase->SqlVariable($this->strOtherphone) . ',
																																				' . $objDatabase->SqlVariable($this->strGender) . ',
																																						' . $objDatabase->SqlVariable($this->strRace) . ',
																																								' . $objDatabase->SqlVariable($this->dttDateofbirth) . ',
																																										' . $objDatabase->SqlVariable($this->intNumhouse) . ',
																																												' . $objDatabase->SqlVariable($this->strTypedwelling) . ',
																																														' . $objDatabase->SqlVariable($this->strTypedwellingother) . ',
																																																' . $objDatabase->SqlVariable($this->strRentorown) . ',
																																																		' . $objDatabase->SqlVariable($this->strRentorownother) . ',
																																																				' . $objDatabase->SqlVariable($this->strMaritalstatus) . ',
																																																						' . $objDatabase->SqlVariable($this->strEmail) . ',
																																																								' . $objDatabase->SqlVariable($this->strC1name) . ',
																																																										' . $objDatabase->SqlVariable($this->strC1street) . ',
																																																												' . $objDatabase->SqlVariable($this->strC1pobox) . ',
																																																														' . $objDatabase->SqlVariable($this->strC1city) . ',
																																																																' . $objDatabase->SqlVariable($this->strC1state) . ',
																																																																		' . $objDatabase->SqlVariable($this->strC1zip) . ',
																																																																				' . $objDatabase->SqlVariable($this->strC1phone) . ',
																																																																						' . $objDatabase->SqlVariable($this->strC1relation) . ',
																																																																								' . $objDatabase->SqlVariable($this->strC2name) . ',
																																																																										' . $objDatabase->SqlVariable($this->strC2street) . ',
																																																																												' . $objDatabase->SqlVariable($this->strC2pobox) . ',
																																																																														' . $objDatabase->SqlVariable($this->strC2city) . ',
																																																																																' . $objDatabase->SqlVariable($this->strC2state) . ',
																																																																																		' . $objDatabase->SqlVariable($this->strC2zip) . ',
																																																																																				' . $objDatabase->SqlVariable($this->strC2phone) . ',
																																																																																						' . $objDatabase->SqlVariable($this->strC2relation) . ',
																																																																																								' . $objDatabase->SqlVariable($this->strC3name) . ',
																																																																																										' . $objDatabase->SqlVariable($this->strC3street) . ',
																																																																																												' . $objDatabase->SqlVariable($this->strC3pobox) . ',
																																																																																														' . $objDatabase->SqlVariable($this->strC3city) . ',
																																																																																																' . $objDatabase->SqlVariable($this->strC3state) . ',
																																																																																																		' . $objDatabase->SqlVariable($this->strC3zip) . ',
																																																																																																				' . $objDatabase->SqlVariable($this->strC3phone) . ',
																																																																																																						' . $objDatabase->SqlVariable($this->strC3relation) . ',
																																																																																																								' . $objDatabase->SqlVariable($this->intBasecode) . ',
																																																																																																										' . $objDatabase->SqlVariable($this->intF1code) . ',
																																																																																																												' . $objDatabase->SqlVariable($this->intNecode) . ',
																																																																																																														' . $objDatabase->SqlVariable($this->intCurrentcode) . ',
																																																																																																																' . $objDatabase->SqlVariable($this->intPostcode) . ',
																																																																																																																		' . $objDatabase->SqlVariable($this->dttBase1stint) . ',
																																																																																																																				' . $objDatabase->SqlVariable($this->dttBaseclinic) . ',
																																																																																																																						' . $objDatabase->SqlVariable($this->dttBase2ndint) . ',
																																																																																																																								' . $objDatabase->SqlVariable($this->dttF11stint) . ',
																																																																																																																										' . $objDatabase->SqlVariable($this->dttF1clinic) . ',
																																																																																																																												' . $objDatabase->SqlVariable($this->dttF12ndint) . ',
																																																																																																																														' . $objDatabase->SqlVariable($this->dttNe1stint) . ',
																																																																																																																																' . $objDatabase->SqlVariable($this->dttNeclinic) . ',
																																																																																																																																		' . $objDatabase->SqlVariable($this->dttNe2ndint) . ',
																																																																																																																																				' . $objDatabase->SqlVariable($this->dttF21stint) . ',
																																																																																																																																						' . $objDatabase->SqlVariable($this->dttF2clinic) . ',
																																																																																																																																								' . $objDatabase->SqlVariable($this->dttF22ndint) . ',
																																																																																																																																										' . $objDatabase->SqlVariable($this->intBuddyid) . ',
																																																																																																																																												' . $objDatabase->SqlVariable($this->dttBuddydate) . ',
																																																																																																																																														' . $objDatabase->SqlVariable($this->strAcesid) . ',
																																																																																																																																																' . $objDatabase->SqlVariable($this->dttAces1stint) . ',
																																																																																																																																																		' . $objDatabase->SqlVariable($this->dttAces2ndint) . ',
																																																																																																																																																				' . $objDatabase->SqlVariable($this->intGogoindid) . ',
																																																																																																																																																						' . $objDatabase->SqlVariable($this->intGogofamid) . ',
																																																																																																																																																								' . $objDatabase->SqlVariable($this->dttGogodate) . ',
																																																																																																																																																										' . $objDatabase->SqlVariable($this->intGogolongid) . ',
																																																																																																																																																												' . $objDatabase->SqlVariable($this->dttGogolongdate) . ',
																																																																																																																																																														' . $objDatabase->SqlVariable($this->strJoproid) . ',
																																																																																																																																																																' . $objDatabase->SqlVariable($this->dttJoprodate) . ',
																																																																																																																																																																		' . $objDatabase->SqlVariable($this->intJoprocont) . ',
																																																																																																																																																																				' . $objDatabase->SqlVariable($this->intJoprocomp) . ',
																																																																																																																																																																						' . $objDatabase->SqlVariable($this->dttLastcodeupdate) . ',
																																																																																																																																																																								' . $objDatabase->SqlVariable($this->dttPostcodeupdate) . ',
																																																																																																																																																																										' . $objDatabase->SqlVariable($this->fltT0weight) . ',
																																																																																																																																																																												' . $objDatabase->SqlVariable($this->fltT1weight) . ',
																																																																																																																																																																														' . $objDatabase->SqlVariable($this->strNotes) . ',
																																																																																																																																																																																' . $objDatabase->SqlVariable($this->strOtherstudy) . ',
																																																																																																																																																																																		' . $objDatabase->SqlVariable($this->strHomeinterviewer) . ',
																																																																																																																																																																																				' . $objDatabase->SqlVariable($this->intInterviewerId) . ',
																																																																																																																																																																																						' . $objDatabase->SqlVariable($this->intAuditId) . '
																																																																																																																																																																																								)
																																																																																																																																																																																								');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeParticipant::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeParticipant::$strPubTableName.'
						SET
						caseid = ' . $objDatabase->SqlVariable($this->strCaseid) . ',
						title = ' . $objDatabase->SqlVariable($this->strTitle) . ',
						lastname = ' . $objDatabase->SqlVariable($this->strLastname) . ',
						firstname = ' . $objDatabase->SqlVariable($this->strFirstname) . ',
						middlename = ' . $objDatabase->SqlVariable($this->strMiddlename) . ',
						maidenname = ' . $objDatabase->SqlVariable($this->strMaidenname) . ',
						nickname = ' . $objDatabase->SqlVariable($this->strNickname) . ',
						street = ' . $objDatabase->SqlVariable($this->strStreet) . ',
						streetsort = ' . $objDatabase->SqlVariable($this->strStreetsort) . ',
						pobox = ' . $objDatabase->SqlVariable($this->strPobox) . ',
						city = ' . $objDatabase->SqlVariable($this->strCity) . ',
								state = ' . $objDatabase->SqlVariable($this->strState) . ',
										zip = ' . $objDatabase->SqlVariable($this->strZip) . ',
												homephone = ' . $objDatabase->SqlVariable($this->strHomephone) . ',
														otherphone = ' . $objDatabase->SqlVariable($this->strOtherphone) . ',
																gender = ' . $objDatabase->SqlVariable($this->strGender) . ',
																		race = ' . $objDatabase->SqlVariable($this->strRace) . ',
																				dateofbirth = ' . $objDatabase->SqlVariable($this->dttDateofbirth) . ',
																						numhouse = ' . $objDatabase->SqlVariable($this->intNumhouse) . ',
																								typedwelling = ' . $objDatabase->SqlVariable($this->strTypedwelling) . ',
																										typedwellingother = ' . $objDatabase->SqlVariable($this->strTypedwellingother) . ',
																												rentorown = ' . $objDatabase->SqlVariable($this->strRentorown) . ',
																														rentorownother = ' . $objDatabase->SqlVariable($this->strRentorownother) . ',
																																maritalstatus = ' . $objDatabase->SqlVariable($this->strMaritalstatus) . ',
																																		email = ' . $objDatabase->SqlVariable($this->strEmail) . ',
																																				c1name = ' . $objDatabase->SqlVariable($this->strC1name) . ',
																																						c1street = ' . $objDatabase->SqlVariable($this->strC1street) . ',
																																								c1pobox = ' . $objDatabase->SqlVariable($this->strC1pobox) . ',
																																										c1city = ' . $objDatabase->SqlVariable($this->strC1city) . ',
																																												c1state = ' . $objDatabase->SqlVariable($this->strC1state) . ',
																																														c1zip = ' . $objDatabase->SqlVariable($this->strC1zip) . ',
																																																c1phone = ' . $objDatabase->SqlVariable($this->strC1phone) . ',
																																																		c1relation = ' . $objDatabase->SqlVariable($this->strC1relation) . ',
																																																				c2name = ' . $objDatabase->SqlVariable($this->strC2name) . ',
																																																						c2street = ' . $objDatabase->SqlVariable($this->strC2street) . ',
																																																								c2pobox = ' . $objDatabase->SqlVariable($this->strC2pobox) . ',
																																																										c2city = ' . $objDatabase->SqlVariable($this->strC2city) . ',
																																																												c2state = ' . $objDatabase->SqlVariable($this->strC2state) . ',
																																																														c2zip = ' . $objDatabase->SqlVariable($this->strC2zip) . ',
																																																																c2phone = ' . $objDatabase->SqlVariable($this->strC2phone) . ',
																																																																		c2relation = ' . $objDatabase->SqlVariable($this->strC2relation) . ',
																																																																				c3name = ' . $objDatabase->SqlVariable($this->strC3name) . ',
																																																																						c3street = ' . $objDatabase->SqlVariable($this->strC3street) . ',
																																																																								c3pobox = ' . $objDatabase->SqlVariable($this->strC3pobox) . ',
																																																																										c3city = ' . $objDatabase->SqlVariable($this->strC3city) . ',
																																																																												c3state = ' . $objDatabase->SqlVariable($this->strC3state) . ',
																																																																														c3zip = ' . $objDatabase->SqlVariable($this->strC3zip) . ',
																																																																																c3phone = ' . $objDatabase->SqlVariable($this->strC3phone) . ',
																																																																																		c3relation = ' . $objDatabase->SqlVariable($this->strC3relation) . ',
																																																																																				basecode = ' . $objDatabase->SqlVariable($this->intBasecode) . ',
																																																																																						f1code = ' . $objDatabase->SqlVariable($this->intF1code) . ',
																																																																																								necode = ' . $objDatabase->SqlVariable($this->intNecode) . ',
																																																																																										currentcode = ' . $objDatabase->SqlVariable($this->intCurrentcode) . ',
																																																																																												postcode = ' . $objDatabase->SqlVariable($this->intPostcode) . ',
																																																																																														base1stint = ' . $objDatabase->SqlVariable($this->dttBase1stint) . ',
																																																																																																baseclinic = ' . $objDatabase->SqlVariable($this->dttBaseclinic) . ',
																																																																																																		base2ndint = ' . $objDatabase->SqlVariable($this->dttBase2ndint) . ',
																																																																																																				f11stint = ' . $objDatabase->SqlVariable($this->dttF11stint) . ',
																																																																																																						f1clinic = ' . $objDatabase->SqlVariable($this->dttF1clinic) . ',
																																																																																																								f12ndint = ' . $objDatabase->SqlVariable($this->dttF12ndint) . ',
																																																																																																										ne1stint = ' . $objDatabase->SqlVariable($this->dttNe1stint) . ',
																																																																																																												neclinic = ' . $objDatabase->SqlVariable($this->dttNeclinic) . ',
																																																																																																														ne2ndint = ' . $objDatabase->SqlVariable($this->dttNe2ndint) . ',
																																																																																																																f21stint = ' . $objDatabase->SqlVariable($this->dttF21stint) . ',
																																																																																																																		f2clinic = ' . $objDatabase->SqlVariable($this->dttF2clinic) . ',
																																																																																																																				f22ndint = ' . $objDatabase->SqlVariable($this->dttF22ndint) . ',
																																																																																																																						buddyid = ' . $objDatabase->SqlVariable($this->intBuddyid) . ',
																																																																																																																								buddydate = ' . $objDatabase->SqlVariable($this->dttBuddydate) . ',
																																																																																																																										acesid = ' . $objDatabase->SqlVariable($this->strAcesid) . ',
																																																																																																																												aces1stint = ' . $objDatabase->SqlVariable($this->dttAces1stint) . ',
																																																																																																																														aces2ndint = ' . $objDatabase->SqlVariable($this->dttAces2ndint) . ',
																																																																																																																																gogoindid = ' . $objDatabase->SqlVariable($this->intGogoindid) . ',
																																																																																																																																		gogofamid = ' . $objDatabase->SqlVariable($this->intGogofamid) . ',
																																																																																																																																				gogodate = ' . $objDatabase->SqlVariable($this->dttGogodate) . ',
																																																																																																																																						gogolongid = ' . $objDatabase->SqlVariable($this->intGogolongid) . ',
																																																																																																																																								gogolongdate = ' . $objDatabase->SqlVariable($this->dttGogolongdate) . ',
																																																																																																																																										joproid = ' . $objDatabase->SqlVariable($this->strJoproid) . ',
																																																																																																																																												joprodate = ' . $objDatabase->SqlVariable($this->dttJoprodate) . ',
																																																																																																																																														joprocont = ' . $objDatabase->SqlVariable($this->intJoprocont) . ',
																																																																																																																																																joprocomp = ' . $objDatabase->SqlVariable($this->intJoprocomp) . ',
																																																																																																																																																		lastcodeupdate = ' . $objDatabase->SqlVariable($this->dttLastcodeupdate) . ',
																																																																																																																																																				postcodeupdate = ' . $objDatabase->SqlVariable($this->dttPostcodeupdate) . ',
																																																																																																																																																						t0weight = ' . $objDatabase->SqlVariable($this->fltT0weight) . ',
																																																																																																																																																								t1weight = ' . $objDatabase->SqlVariable($this->fltT1weight) . ',
																																																																																																																																																										notes = ' . $objDatabase->SqlVariable($this->strNotes) . ',
																																																																																																																																																												otherstudy = ' . $objDatabase->SqlVariable($this->strOtherstudy) . ',
																																																																																																																																																														homeinterviewer = ' . $objDatabase->SqlVariable($this->strHomeinterviewer) . ',
																																																																																																																																																																interviewer_id = ' . $objDatabase->SqlVariable($this->intInterviewerId) . ',
																																																																																																																																																																		audit_id = ' . $objDatabase->SqlVariable($this->intAuditId) . '
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
	 * Delete this Participant
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this Participant with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeParticipant::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all Participants
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeParticipant::$strPubTableName.'');
	}

	/**
	 * Truncate participant table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeParticipant::$strPubTableName.'');
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
			case 'Caseid':
				/**
				 * Gets the value for strCaseid (Not Null)
				 * @return string
				 */
				return $this->strCaseid;

			case 'Title':
				/**
				 * Gets the value for strTitle
				 * @return string
				 */
				return $this->strTitle;

			case 'Lastname':
				/**
				 * Gets the value for strLastname
				 * @return string
				 */
				return $this->strLastname;

			case 'Firstname':
				/**
				 * Gets the value for strFirstname
				 * @return string
				 */
				return $this->strFirstname;

			case 'Middlename':
				/**
				 * Gets the value for strMiddlename
				 * @return string
				 */
				return $this->strMiddlename;

			case 'Maidenname':
				/**
				 * Gets the value for strMaidenname
				 * @return string
				 */
				return $this->strMaidenname;

			case 'Nickname':
				/**
				 * Gets the value for strNickname
				 * @return string
				 */
				return $this->strNickname;

			case 'Street':
				/**
				 * Gets the value for strStreet
				 * @return string
				 */
				return $this->strStreet;

			case 'Streetsort':
				/**
				 * Gets the value for strStreetsort (Not Null)
				 * @return string
				 */
				return $this->strStreetsort;

			case 'Pobox':
				/**
				 * Gets the value for strPobox
				 * @return string
				 */
				return $this->strPobox;

			case 'City':
				/**
				 * Gets the value for strCity
				 * @return string
				 */
				return $this->strCity;

			case 'State':
				/**
				 * Gets the value for strState
				 * @return string
				 */
				return $this->strState;

			case 'Zip':
				/**
				 * Gets the value for strZip
				 * @return string
				 */
				return $this->strZip;

			case 'Homephone':
				/**
				 * Gets the value for strHomephone
				 * @return string
				 */
				return $this->strHomephone;

			case 'Otherphone':
				/**
				 * Gets the value for strOtherphone
				 * @return string
				 */
				return $this->strOtherphone;

			case 'Gender':
				/**
				 * Gets the value for strGender
				 * @return string
				 */
				return $this->strGender;

			case 'Race':
				/**
				 * Gets the value for strRace
				 * @return string
				 */
				return $this->strRace;

			case 'Dateofbirth':
				/**
				 * Gets the value for dttDateofbirth
				 * @return QDateTime
				 */
				return $this->dttDateofbirth;

			case 'Numhouse':
				/**
				 * Gets the value for intNumhouse
				 * @return integer
				 */
				return $this->intNumhouse;

			case 'Typedwelling':
				/**
				 * Gets the value for strTypedwelling
				 * @return string
				 */
				return $this->strTypedwelling;

			case 'Typedwellingother':
				/**
				 * Gets the value for strTypedwellingother
				 * @return string
				 */
				return $this->strTypedwellingother;

			case 'Rentorown':
				/**
				 * Gets the value for strRentorown
				 * @return string
				 */
				return $this->strRentorown;

			case 'Rentorownother':
				/**
				 * Gets the value for strRentorownother
				 * @return string
				 */
				return $this->strRentorownother;

			case 'Maritalstatus':
				/**
				 * Gets the value for strMaritalstatus
				 * @return string
				 */
				return $this->strMaritalstatus;

			case 'Email':
				/**
				 * Gets the value for strEmail
				 * @return string
				 */
				return $this->strEmail;

			case 'C1name':
				/**
				 * Gets the value for strC1name
				 * @return string
				 */
				return $this->strC1name;

			case 'C1street':
				/**
				 * Gets the value for strC1street
				 * @return string
				 */
				return $this->strC1street;

			case 'C1pobox':
				/**
				 * Gets the value for strC1pobox
				 * @return string
				 */
				return $this->strC1pobox;

			case 'C1city':
				/**
				 * Gets the value for strC1city
				 * @return string
				 */
				return $this->strC1city;

			case 'C1state':
				/**
				 * Gets the value for strC1state
				 * @return string
				 */
				return $this->strC1state;

			case 'C1zip':
				/**
				 * Gets the value for strC1zip
				 * @return string
				 */
				return $this->strC1zip;

			case 'C1phone':
				/**
				 * Gets the value for strC1phone
				 * @return string
				 */
				return $this->strC1phone;

			case 'C1relation':
				/**
				 * Gets the value for strC1relation
				 * @return string
				 */
				return $this->strC1relation;

			case 'C2name':
				/**
				 * Gets the value for strC2name
				 * @return string
				 */
				return $this->strC2name;

			case 'C2street':
				/**
				 * Gets the value for strC2street
				 * @return string
				 */
				return $this->strC2street;

			case 'C2pobox':
				/**
				 * Gets the value for strC2pobox
				 * @return string
				 */
				return $this->strC2pobox;

			case 'C2city':
				/**
				 * Gets the value for strC2city
				 * @return string
				 */
				return $this->strC2city;

			case 'C2state':
				/**
				 * Gets the value for strC2state
				 * @return string
				 */
				return $this->strC2state;

			case 'C2zip':
				/**
				 * Gets the value for strC2zip
				 * @return string
				 */
				return $this->strC2zip;

			case 'C2phone':
				/**
				 * Gets the value for strC2phone
				 * @return string
				 */
				return $this->strC2phone;

			case 'C2relation':
				/**
				 * Gets the value for strC2relation
				 * @return string
				 */
				return $this->strC2relation;

			case 'C3name':
				/**
				 * Gets the value for strC3name
				 * @return string
				 */
				return $this->strC3name;

			case 'C3street':
				/**
				 * Gets the value for strC3street
				 * @return string
				 */
				return $this->strC3street;

			case 'C3pobox':
				/**
				 * Gets the value for strC3pobox
				 * @return string
				 */
				return $this->strC3pobox;

			case 'C3city':
				/**
				 * Gets the value for strC3city
				 * @return string
				 */
				return $this->strC3city;

			case 'C3state':
				/**
				 * Gets the value for strC3state
				 * @return string
				 */
				return $this->strC3state;

			case 'C3zip':
				/**
				 * Gets the value for strC3zip
				 * @return string
				 */
				return $this->strC3zip;

			case 'C3phone':
				/**
				 * Gets the value for strC3phone
				 * @return string
				 */
				return $this->strC3phone;

			case 'C3relation':
				/**
				 * Gets the value for strC3relation
				 * @return string
				 */
				return $this->strC3relation;

			case 'Basecode':
				/**
				 * Gets the value for intBasecode
				 * @return integer
				 */
				return $this->intBasecode;

			case 'F1code':
				/**
				 * Gets the value for intF1code
				 * @return integer
				 */
				return $this->intF1code;

			case 'Necode':
				/**
				 * Gets the value for intNecode
				 * @return integer
				 */
				return $this->intNecode;

			case 'Currentcode':
				/**
				 * Gets the value for intCurrentcode
				 * @return integer
				 */
				return $this->intCurrentcode;

			case 'Postcode':
				/**
				 * Gets the value for intPostcode
				 * @return integer
				 */
				return $this->intPostcode;

			case 'Base1stint':
				/**
				 * Gets the value for dttBase1stint
				 * @return QDateTime
				 */
				return $this->dttBase1stint;

			case 'Baseclinic':
				/**
				 * Gets the value for dttBaseclinic
				 * @return QDateTime
				 */
				return $this->dttBaseclinic;

			case 'Base2ndint':
				/**
				 * Gets the value for dttBase2ndint
				 * @return QDateTime
				 */
				return $this->dttBase2ndint;

			case 'F11stint':
				/**
				 * Gets the value for dttF11stint
				 * @return QDateTime
				 */
				return $this->dttF11stint;

			case 'F1clinic':
				/**
				 * Gets the value for dttF1clinic
				 * @return QDateTime
				 */
				return $this->dttF1clinic;

			case 'F12ndint':
				/**
				 * Gets the value for dttF12ndint
				 * @return QDateTime
				 */
				return $this->dttF12ndint;

			case 'Ne1stint':
				/**
				 * Gets the value for dttNe1stint
				 * @return QDateTime
				 */
				return $this->dttNe1stint;

			case 'Neclinic':
				/**
				 * Gets the value for dttNeclinic
				 * @return QDateTime
				 */
				return $this->dttNeclinic;

			case 'Ne2ndint':
				/**
				 * Gets the value for dttNe2ndint
				 * @return QDateTime
				 */
				return $this->dttNe2ndint;

			case 'F21stint':
				/**
				 * Gets the value for dttF21stint
				 * @return QDateTime
				 */
				return $this->dttF21stint;

			case 'F2clinic':
				/**
				 * Gets the value for dttF2clinic
				 * @return QDateTime
				 */
				return $this->dttF2clinic;

			case 'F22ndint':
				/**
				 * Gets the value for dttF22ndint
				 * @return QDateTime
				 */
				return $this->dttF22ndint;

			case 'Buddyid':
				/**
				 * Gets the value for intBuddyid
				 * @return integer
				 */
				return $this->intBuddyid;

			case 'Buddydate':
				/**
				 * Gets the value for dttBuddydate
				 * @return QDateTime
				 */
				return $this->dttBuddydate;

			case 'Acesid':
				/**
				 * Gets the value for strAcesid
				 * @return string
				 */
				return $this->strAcesid;

			case 'Aces1stint':
				/**
				 * Gets the value for dttAces1stint
				 * @return QDateTime
				 */
				return $this->dttAces1stint;

			case 'Aces2ndint':
				/**
				 * Gets the value for dttAces2ndint
				 * @return QDateTime
				 */
				return $this->dttAces2ndint;

			case 'Gogoindid':
				/**
				 * Gets the value for intGogoindid
				 * @return integer
				 */
				return $this->intGogoindid;

			case 'Gogofamid':
				/**
				 * Gets the value for intGogofamid
				 * @return integer
				 */
				return $this->intGogofamid;

			case 'Gogodate':
				/**
				 * Gets the value for dttGogodate
				 * @return QDateTime
				 */
				return $this->dttGogodate;

			case 'Gogolongid':
				/**
				 * Gets the value for intGogolongid
				 * @return integer
				 */
				return $this->intGogolongid;

			case 'Gogolongdate':
				/**
				 * Gets the value for dttGogolongdate
				 * @return QDateTime
				 */
				return $this->dttGogolongdate;

			case 'Joproid':
				/**
				 * Gets the value for strJoproid
				 * @return string
				 */
				return $this->strJoproid;

			case 'Joprodate':
				/**
				 * Gets the value for dttJoprodate
				 * @return QDateTime
				 */
				return $this->dttJoprodate;

			case 'Joprocont':
				/**
				 * Gets the value for intJoprocont (Not Null)
				 * @return integer
				 */
				return $this->intJoprocont;

			case 'Joprocomp':
				/**
				 * Gets the value for intJoprocomp (Not Null)
				 * @return integer
				 */
				return $this->intJoprocomp;

			case 'Lastcodeupdate':
				/**
				 * Gets the value for dttLastcodeupdate
				 * @return QDateTime
				 */
				return $this->dttLastcodeupdate;

			case 'Postcodeupdate':
				/**
				 * Gets the value for dttPostcodeupdate
				 * @return QDateTime
				 */
				return $this->dttPostcodeupdate;

			case 'T0weight':
				/**
				 * Gets the value for fltT0weight
				 * @return double
				 */
				return $this->fltT0weight;

			case 'T1weight':
				/**
				 * Gets the value for fltT1weight
				 * @return double
				 */
				return $this->fltT1weight;

			case 'Notes':
				/**
				 * Gets the value for strNotes
				 * @return string
				 */
				return $this->strNotes;

			case 'Otherstudy':
				/**
				 * Gets the value for strOtherstudy
				 * @return string
				 */
				return $this->strOtherstudy;

			case 'Homeinterviewer':
				/**
				 * Gets the value for strHomeinterviewer
				 * @return string
				 */
				return $this->strHomeinterviewer;

			case 'Id':
				/**
				 * Gets the value for intId (Read-Only PK)
				 * @return integer
				 */
				return $this->intId;

			case 'InterviewerId':
				/**
				 * Gets the value for intInterviewerId
				 * @return integer
				 */
				return $this->intInterviewerId;

			case 'AuditId':
				/**
				 * Gets the value for intAuditId
				 * @return integer
				 */
				return $this->intAuditId;


				///////////////////
				// Member Objects
				///////////////////
			case 'Interviewer':
				/**
				 * Gets the value for the User object referenced by intInterviewerId
				 * @return User
				 */
				try {
					if ((!$this->objInterviewer) && (!is_null($this->intInterviewerId)))
						$this->objInterviewer = User::Load($this->intInterviewerId);
					return $this->objInterviewer;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_Calllog':
				/**
				 * Gets the value for the private _objCalllog (Read-Only)
				 * if set due to an expansion on the calllog.participant_id reverse relationship
				 * @return Calllog
				 */
				return $this->_objCalllog;

			case '_CalllogArray':
				/**
				 * Gets the value for the private _objCalllogArray (Read-Only)
				 * if set due to an ExpandAsArray on the calllog.participant_id reverse relationship
				 * @return Calllog[]
				 */
				return (array) $this->_objCalllogArray;

			case '_T3Sch':
				/**
				 * Gets the value for the private _objT3Sch (Read-Only)
				 * if set due to an expansion on the t3_sch.participant_id reverse relationship
				 * @return T3Sch
				 */
				return $this->_objT3Sch;

			case '_T3SchArray':
				/**
				 * Gets the value for the private _objT3SchArray (Read-Only)
				 * if set due to an ExpandAsArray on the t3_sch.participant_id reverse relationship
				 * @return T3Sch[]
				 */
				return (array) $this->_objT3SchArray;

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
			case 'Caseid':
				/**
				 * Sets the value for strCaseid (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strCaseid = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Title':
				/**
				 * Sets the value for strTitle
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strTitle = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Lastname':
				/**
				 * Sets the value for strLastname
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strLastname = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Firstname':
				/**
				 * Sets the value for strFirstname
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strFirstname = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Middlename':
				/**
				 * Sets the value for strMiddlename
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strMiddlename = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Maidenname':
				/**
				 * Sets the value for strMaidenname
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strMaidenname = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Nickname':
				/**
				 * Sets the value for strNickname
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strNickname = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Street':
				/**
				 * Sets the value for strStreet
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strStreet = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Streetsort':
				/**
				 * Sets the value for strStreetsort (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strStreetsort = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Pobox':
				/**
				 * Sets the value for strPobox
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strPobox = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'City':
				/**
				 * Sets the value for strCity
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strCity = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'State':
				/**
				 * Sets the value for strState
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strState = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Zip':
				/**
				 * Sets the value for strZip
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strZip = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Homephone':
				/**
				 * Sets the value for strHomephone
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strHomephone = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Otherphone':
				/**
				 * Sets the value for strOtherphone
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strOtherphone = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Gender':
				/**
				 * Sets the value for strGender
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strGender = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Race':
				/**
				 * Sets the value for strRace
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strRace = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Dateofbirth':
				/**
				 * Sets the value for dttDateofbirth
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttDateofbirth = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Numhouse':
				/**
				 * Sets the value for intNumhouse
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intNumhouse = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Typedwelling':
				/**
				 * Sets the value for strTypedwelling
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strTypedwelling = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Typedwellingother':
				/**
				 * Sets the value for strTypedwellingother
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strTypedwellingother = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Rentorown':
				/**
				 * Sets the value for strRentorown
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strRentorown = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Rentorownother':
				/**
				 * Sets the value for strRentorownother
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strRentorownother = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Maritalstatus':
				/**
				 * Sets the value for strMaritalstatus
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strMaritalstatus = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Email':
				/**
				 * Sets the value for strEmail
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strEmail = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C1name':
				/**
				 * Sets the value for strC1name
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC1name = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C1street':
				/**
				 * Sets the value for strC1street
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC1street = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C1pobox':
				/**
				 * Sets the value for strC1pobox
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC1pobox = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C1city':
				/**
				 * Sets the value for strC1city
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC1city = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C1state':
				/**
				 * Sets the value for strC1state
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC1state = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C1zip':
				/**
				 * Sets the value for strC1zip
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC1zip = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C1phone':
				/**
				 * Sets the value for strC1phone
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC1phone = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C1relation':
				/**
				 * Sets the value for strC1relation
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC1relation = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C2name':
				/**
				 * Sets the value for strC2name
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC2name = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C2street':
				/**
				 * Sets the value for strC2street
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC2street = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C2pobox':
				/**
				 * Sets the value for strC2pobox
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC2pobox = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C2city':
				/**
				 * Sets the value for strC2city
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC2city = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C2state':
				/**
				 * Sets the value for strC2state
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC2state = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C2zip':
				/**
				 * Sets the value for strC2zip
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC2zip = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C2phone':
				/**
				 * Sets the value for strC2phone
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC2phone = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C2relation':
				/**
				 * Sets the value for strC2relation
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC2relation = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C3name':
				/**
				 * Sets the value for strC3name
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC3name = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C3street':
				/**
				 * Sets the value for strC3street
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC3street = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C3pobox':
				/**
				 * Sets the value for strC3pobox
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC3pobox = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C3city':
				/**
				 * Sets the value for strC3city
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC3city = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C3state':
				/**
				 * Sets the value for strC3state
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC3state = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C3zip':
				/**
				 * Sets the value for strC3zip
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC3zip = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C3phone':
				/**
				 * Sets the value for strC3phone
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC3phone = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'C3relation':
				/**
				 * Sets the value for strC3relation
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strC3relation = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Basecode':
				/**
				 * Sets the value for intBasecode
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intBasecode = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F1code':
				/**
				 * Sets the value for intF1code
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intF1code = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Necode':
				/**
				 * Sets the value for intNecode
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intNecode = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Currentcode':
				/**
				 * Sets the value for intCurrentcode
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intCurrentcode = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Postcode':
				/**
				 * Sets the value for intPostcode
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intPostcode = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Base1stint':
				/**
				 * Sets the value for dttBase1stint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttBase1stint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Baseclinic':
				/**
				 * Sets the value for dttBaseclinic
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttBaseclinic = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Base2ndint':
				/**
				 * Sets the value for dttBase2ndint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttBase2ndint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F11stint':
				/**
				 * Sets the value for dttF11stint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttF11stint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F1clinic':
				/**
				 * Sets the value for dttF1clinic
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttF1clinic = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F12ndint':
				/**
				 * Sets the value for dttF12ndint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttF12ndint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Ne1stint':
				/**
				 * Sets the value for dttNe1stint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttNe1stint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Neclinic':
				/**
				 * Sets the value for dttNeclinic
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttNeclinic = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Ne2ndint':
				/**
				 * Sets the value for dttNe2ndint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttNe2ndint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F21stint':
				/**
				 * Sets the value for dttF21stint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttF21stint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F2clinic':
				/**
				 * Sets the value for dttF2clinic
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttF2clinic = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'F22ndint':
				/**
				 * Sets the value for dttF22ndint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttF22ndint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Buddyid':
				/**
				 * Sets the value for intBuddyid
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intBuddyid = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Buddydate':
				/**
				 * Sets the value for dttBuddydate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttBuddydate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Acesid':
				/**
				 * Sets the value for strAcesid
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strAcesid = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Aces1stint':
				/**
				 * Sets the value for dttAces1stint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttAces1stint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Aces2ndint':
				/**
				 * Sets the value for dttAces2ndint
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttAces2ndint = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Gogoindid':
				/**
				 * Sets the value for intGogoindid
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intGogoindid = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Gogofamid':
				/**
				 * Sets the value for intGogofamid
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intGogofamid = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Gogodate':
				/**
				 * Sets the value for dttGogodate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttGogodate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Gogolongid':
				/**
				 * Sets the value for intGogolongid
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intGogolongid = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Gogolongdate':
				/**
				 * Sets the value for dttGogolongdate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttGogolongdate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Joproid':
				/**
				 * Sets the value for strJoproid
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strJoproid = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Joprodate':
				/**
				 * Sets the value for dttJoprodate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttJoprodate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Joprocont':
				/**
				 * Sets the value for intJoprocont (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intJoprocont = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Joprocomp':
				/**
				 * Sets the value for intJoprocomp (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intJoprocomp = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Lastcodeupdate':
				/**
				 * Sets the value for dttLastcodeupdate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttLastcodeupdate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Postcodeupdate':
				/**
				 * Sets the value for dttPostcodeupdate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttPostcodeupdate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'T0weight':
				/**
				 * Sets the value for fltT0weight
				 * @param double $mixValue
				 * @return double
				 */
				try {
					return ($this->fltT0weight = QType::Cast($mixValue, QType::Float));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'T1weight':
				/**
				 * Sets the value for fltT1weight
				 * @param double $mixValue
				 * @return double
				 */
				try {
					return ($this->fltT1weight = QType::Cast($mixValue, QType::Float));
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

			case 'Otherstudy':
				/**
				 * Sets the value for strOtherstudy
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strOtherstudy = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Homeinterviewer':
				/**
				 * Sets the value for strHomeinterviewer
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strHomeinterviewer = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'InterviewerId':
				/**
				 * Sets the value for intInterviewerId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objInterviewer = null;
					return ($this->intInterviewerId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'AuditId':
				/**
				 * Sets the value for intAuditId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intAuditId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				///////////////////
				// Member Objects
				///////////////////
			case 'Interviewer':
				/**
				 * Sets the value for the User object referenced by intInterviewerId
				 * @param User $mixValue
				 * @return User
				 */
				if (is_null($mixValue)) {
					$this->intInterviewerId = null;
					$this->objInterviewer = null;
					return null;
				} else {
					// Make sure $mixValue actually is a User object
					try {
						$mixValue = QType::Cast($mixValue, 'User');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED User object
					if (is_null($mixValue->Userid))
						throw new QCallerException('Unable to set an unsaved Interviewer for this Participant');

					// Update Local Member Variables
					$this->objInterviewer = $mixValue;
					$this->intInterviewerId = $mixValue->Userid;

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



	// Related Objects' Methods for Calllog
	//-------------------------------------------------------------------

	/**
	 * Gets all associated Calllogs as an array of Calllog objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Calllog[]
		*/
	public function GetCalllogArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Calllog::LoadArrayByParticipantId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated Calllogs
	 * @return int
		*/
	public function CountCalllogs() {
		if ((is_null($this->intId)))
			return 0;

		return Calllog::CountByParticipantId($this->intId);
	}

	/**
	 * Associates a Calllog
	 * @param Calllog $objCalllog
	 * @return void
		*/
	public function AssociateCalllog(Calllog $objCalllog) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateCalllog on this unsaved Participant.');
		if ((is_null($objCalllog->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateCalllog on this Participant with an unsaved Calllog.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				calllog
				SET
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objCalllog->Id) . '
				');
	}

	/**
	 * Unassociates a Calllog
	 * @param Calllog $objCalllog
	 * @return void
		*/
	public function UnassociateCalllog(Calllog $objCalllog) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCalllog on this unsaved Participant.');
		if ((is_null($objCalllog->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCalllog on this Participant with an unsaved Calllog.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				calllog
				SET
				participant_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objCalllog->Id) . ' AND
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all Calllogs
	 * @return void
		*/
	public function UnassociateAllCalllogs() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCalllog on this unsaved Participant.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				calllog
				SET
				participant_id = null
				WHERE
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated Calllog
	 * @param Calllog $objCalllog
	 * @return void
		*/
	public function DeleteAssociatedCalllog(Calllog $objCalllog) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCalllog on this unsaved Participant.');
		if ((is_null($objCalllog->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCalllog on this Participant with an unsaved Calllog.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				calllog
				WHERE
				id = ' . $objDatabase->SqlVariable($objCalllog->Id) . ' AND
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated Calllogs
	 * @return void
		*/
	public function DeleteAllCalllogs() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCalllog on this unsaved Participant.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				calllog
				WHERE
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}



	// Related Objects' Methods for T3Sch
	//-------------------------------------------------------------------

	/**
	 * Gets all associated T3Sches as an array of T3Sch objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return T3Sch[]
		*/
	public function GetT3SchArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return T3Sch::LoadArrayByParticipantId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated T3Sches
	 * @return int
		*/
	public function CountT3Sches() {
		if ((is_null($this->intId)))
			return 0;

		return T3Sch::CountByParticipantId($this->intId);
	}

	/**
	 * Associates a T3Sch
	 * @param T3Sch $objT3Sch
	 * @return void
		*/
	public function AssociateT3Sch(T3Sch $objT3Sch) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateT3Sch on this unsaved Participant.');
		if ((is_null($objT3Sch->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateT3Sch on this Participant with an unsaved T3Sch.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				t3_sch
				SET
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objT3Sch->Id) . '
				');
	}

	/**
	 * Unassociates a T3Sch
	 * @param T3Sch $objT3Sch
	 * @return void
		*/
	public function UnassociateT3Sch(T3Sch $objT3Sch) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateT3Sch on this unsaved Participant.');
		if ((is_null($objT3Sch->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateT3Sch on this Participant with an unsaved T3Sch.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				t3_sch
				SET
				participant_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objT3Sch->Id) . ' AND
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all T3Sches
	 * @return void
		*/
	public function UnassociateAllT3Sches() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateT3Sch on this unsaved Participant.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				t3_sch
				SET
				participant_id = null
				WHERE
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated T3Sch
	 * @param T3Sch $objT3Sch
	 * @return void
		*/
	public function DeleteAssociatedT3Sch(T3Sch $objT3Sch) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateT3Sch on this unsaved Participant.');
		if ((is_null($objT3Sch->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateT3Sch on this Participant with an unsaved T3Sch.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				t3_sch
				WHERE
				id = ' . $objDatabase->SqlVariable($objT3Sch->Id) . ' AND
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated T3Sches
	 * @return void
		*/
	public function DeleteAllT3Sches() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateT3Sch on this unsaved Participant.');

		// Get the Database Object for this Class
		$objDatabase = Participant::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				t3_sch
				WHERE
				participant_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database column participant.caseid
	 * @var string strCaseid
	 */
	protected $strCaseid;
	const CaseidMaxLength = 10;
	const CaseidDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.title
	 * @var string strTitle
	 */
	protected $strTitle;
	const TitleMaxLength = 8;
	const TitleDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.lastname
	 * @var string strLastname
	 */
	protected $strLastname;
	const LastnameMaxLength = 60;
	const LastnameDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.firstname
	 * @var string strFirstname
	 */
	protected $strFirstname;
	const FirstnameMaxLength = 60;
	const FirstnameDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.middlename
	 * @var string strMiddlename
	 */
	protected $strMiddlename;
	const MiddlenameMaxLength = 60;
	const MiddlenameDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.maidenname
	 * @var string strMaidenname
	 */
	protected $strMaidenname;
	const MaidennameMaxLength = 60;
	const MaidennameDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.nickname
	 * @var string strNickname
	 */
	protected $strNickname;
	const NicknameMaxLength = 60;
	const NicknameDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.street
	 * @var string strStreet
	 */
	protected $strStreet;
	const StreetMaxLength = 200;
	const StreetDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.streetsort
	 * @var string strStreetsort
	 */
	protected $strStreetsort;
	const StreetsortMaxLength = 200;
	const StreetsortDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.pobox
	 * @var string strPobox
	 */
	protected $strPobox;
	const PoboxMaxLength = 60;
	const PoboxDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.city
	 * @var string strCity
	 */
	protected $strCity;
	const CityMaxLength = 60;
	const CityDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.state
	 * @var string strState
	 */
	protected $strState;
	const StateMaxLength = 4;
	const StateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.zip
	 * @var string strZip
	 */
	protected $strZip;
	const ZipMaxLength = 10;
	const ZipDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.homephone
	 * @var string strHomephone
	 */
	protected $strHomephone;
	const HomephoneMaxLength = 30;
	const HomephoneDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.otherphone
	 * @var string strOtherphone
	 */
	protected $strOtherphone;
	const OtherphoneMaxLength = 30;
	const OtherphoneDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.gender
	 * @var string strGender
	 */
	protected $strGender;
	const GenderMaxLength = 2;
	const GenderDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.race
	 * @var string strRace
	 */
	protected $strRace;
	const RaceMaxLength = 2;
	const RaceDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.dateofbirth
	 * @var QDateTime dttDateofbirth
	 */
	protected $dttDateofbirth;
	const DateofbirthDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.numhouse
	 * @var integer intNumhouse
	 */
	protected $intNumhouse;
	const NumhouseDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.typedwelling
	 * @var string strTypedwelling
	 */
	protected $strTypedwelling;
	const TypedwellingMaxLength = 4;
	const TypedwellingDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.typedwellingother
	 * @var string strTypedwellingother
	 */
	protected $strTypedwellingother;
	const TypedwellingotherMaxLength = 200;
	const TypedwellingotherDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.rentorown
	 * @var string strRentorown
	 */
	protected $strRentorown;
	const RentorownMaxLength = 4;
	const RentorownDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.rentorownother
	 * @var string strRentorownother
	 */
	protected $strRentorownother;
	const RentorownotherMaxLength = 200;
	const RentorownotherDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.maritalstatus
	 * @var string strMaritalstatus
	 */
	protected $strMaritalstatus;
	const MaritalstatusMaxLength = 2;
	const MaritalstatusDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.email
	 * @var string strEmail
	 */
	protected $strEmail;
	const EmailMaxLength = 510;
	const EmailDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c1name
	 * @var string strC1name
	 */
	protected $strC1name;
	const C1nameMaxLength = 100;
	const C1nameDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c1street
	 * @var string strC1street
	 */
	protected $strC1street;
	const C1streetMaxLength = 200;
	const C1streetDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c1pobox
	 * @var string strC1pobox
	 */
	protected $strC1pobox;
	const C1poboxMaxLength = 60;
	const C1poboxDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c1city
	 * @var string strC1city
	 */
	protected $strC1city;
	const C1cityMaxLength = 60;
	const C1cityDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c1state
	 * @var string strC1state
	 */
	protected $strC1state;
	const C1stateMaxLength = 4;
	const C1stateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c1zip
	 * @var string strC1zip
	 */
	protected $strC1zip;
	const C1zipMaxLength = 10;
	const C1zipDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c1phone
	 * @var string strC1phone
	 */
	protected $strC1phone;
	const C1phoneMaxLength = 30;
	const C1phoneDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c1relation
	 * @var string strC1relation
	 */
	protected $strC1relation;
	const C1relationMaxLength = 60;
	const C1relationDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c2name
	 * @var string strC2name
	 */
	protected $strC2name;
	const C2nameMaxLength = 100;
	const C2nameDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c2street
	 * @var string strC2street
	 */
	protected $strC2street;
	const C2streetMaxLength = 200;
	const C2streetDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c2pobox
	 * @var string strC2pobox
	 */
	protected $strC2pobox;
	const C2poboxMaxLength = 60;
	const C2poboxDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c2city
	 * @var string strC2city
	 */
	protected $strC2city;
	const C2cityMaxLength = 60;
	const C2cityDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c2state
	 * @var string strC2state
	 */
	protected $strC2state;
	const C2stateMaxLength = 4;
	const C2stateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c2zip
	 * @var string strC2zip
	 */
	protected $strC2zip;
	const C2zipMaxLength = 10;
	const C2zipDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c2phone
	 * @var string strC2phone
	 */
	protected $strC2phone;
	const C2phoneMaxLength = 28;
	const C2phoneDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c2relation
	 * @var string strC2relation
	 */
	protected $strC2relation;
	const C2relationMaxLength = 60;
	const C2relationDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c3name
	 * @var string strC3name
	 */
	protected $strC3name;
	const C3nameMaxLength = 100;
	const C3nameDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c3street
	 * @var string strC3street
	 */
	protected $strC3street;
	const C3streetMaxLength = 200;
	const C3streetDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c3pobox
	 * @var string strC3pobox
	 */
	protected $strC3pobox;
	const C3poboxMaxLength = 60;
	const C3poboxDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c3city
	 * @var string strC3city
	 */
	protected $strC3city;
	const C3cityMaxLength = 60;
	const C3cityDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c3state
	 * @var string strC3state
	 */
	protected $strC3state;
	const C3stateMaxLength = 4;
	const C3stateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c3zip
	 * @var string strC3zip
	 */
	protected $strC3zip;
	const C3zipMaxLength = 10;
	const C3zipDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c3phone
	 * @var string strC3phone
	 */
	protected $strC3phone;
	const C3phoneMaxLength = 30;
	const C3phoneDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.c3relation
	 * @var string strC3relation
	 */
	protected $strC3relation;
	const C3relationMaxLength = 60;
	const C3relationDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.basecode
	 * @var integer intBasecode
	 */
	protected $intBasecode;
	const BasecodeDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.f1code
	 * @var integer intF1code
	 */
	protected $intF1code;
	const F1codeDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.necode
	 * @var integer intNecode
	 */
	protected $intNecode;
	const NecodeDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.currentcode
	 * @var integer intCurrentcode
	 */
	protected $intCurrentcode;
	const CurrentcodeDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.postcode
	 * @var integer intPostcode
	 */
	protected $intPostcode;
	const PostcodeDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.base1stint
	 * @var QDateTime dttBase1stint
	 */
	protected $dttBase1stint;
	const Base1stintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.baseclinic
	 * @var QDateTime dttBaseclinic
	 */
	protected $dttBaseclinic;
	const BaseclinicDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.base2ndint
	 * @var QDateTime dttBase2ndint
	 */
	protected $dttBase2ndint;
	const Base2ndintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.f11stint
	 * @var QDateTime dttF11stint
	 */
	protected $dttF11stint;
	const F11stintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.f1clinic
	 * @var QDateTime dttF1clinic
	 */
	protected $dttF1clinic;
	const F1clinicDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.f12ndint
	 * @var QDateTime dttF12ndint
	 */
	protected $dttF12ndint;
	const F12ndintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.ne1stint
	 * @var QDateTime dttNe1stint
	 */
	protected $dttNe1stint;
	const Ne1stintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.neclinic
	 * @var QDateTime dttNeclinic
	 */
	protected $dttNeclinic;
	const NeclinicDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.ne2ndint
	 * @var QDateTime dttNe2ndint
	 */
	protected $dttNe2ndint;
	const Ne2ndintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.f21stint
	 * @var QDateTime dttF21stint
	 */
	protected $dttF21stint;
	const F21stintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.f2clinic
	 * @var QDateTime dttF2clinic
	 */
	protected $dttF2clinic;
	const F2clinicDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.f22ndint
	 * @var QDateTime dttF22ndint
	 */
	protected $dttF22ndint;
	const F22ndintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.buddyid
	 * @var integer intBuddyid
	 */
	protected $intBuddyid;
	const BuddyidDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.buddydate
	 * @var QDateTime dttBuddydate
	 */
	protected $dttBuddydate;
	const BuddydateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.acesid
	 * @var string strAcesid
	 */
	protected $strAcesid;
	const AcesidMaxLength = 10;
	const AcesidDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.aces1stint
	 * @var QDateTime dttAces1stint
	 */
	protected $dttAces1stint;
	const Aces1stintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.aces2ndint
	 * @var QDateTime dttAces2ndint
	 */
	protected $dttAces2ndint;
	const Aces2ndintDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.gogoindid
	 * @var integer intGogoindid
	 */
	protected $intGogoindid;
	const GogoindidDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.gogofamid
	 * @var integer intGogofamid
	 */
	protected $intGogofamid;
	const GogofamidDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.gogodate
	 * @var QDateTime dttGogodate
	 */
	protected $dttGogodate;
	const GogodateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.gogolongid
	 * @var integer intGogolongid
	 */
	protected $intGogolongid;
	const GogolongidDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.gogolongdate
	 * @var QDateTime dttGogolongdate
	 */
	protected $dttGogolongdate;
	const GogolongdateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.joproid
	 * @var string strJoproid
	 */
	protected $strJoproid;
	const JoproidMaxLength = 14;
	const JoproidDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.joprodate
	 * @var QDateTime dttJoprodate
	 */
	protected $dttJoprodate;
	const JoprodateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.joprocont
	 * @var integer intJoprocont
	 */
	protected $intJoprocont;
	const JoprocontDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.joprocomp
	 * @var integer intJoprocomp
	 */
	protected $intJoprocomp;
	const JoprocompDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.lastcodeupdate
	 * @var QDateTime dttLastcodeupdate
	 */
	protected $dttLastcodeupdate;
	const LastcodeupdateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.postcodeupdate
	 * @var QDateTime dttPostcodeupdate
	 */
	protected $dttPostcodeupdate;
	const PostcodeupdateDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.t0weight
	 * @var double fltT0weight
	 */
	protected $fltT0weight;
	const T0weightDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.t1weight
	 * @var double fltT1weight
	 */
	protected $fltT1weight;
	const T1weightDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.notes
	 * @var string strNotes
	 */
	protected $strNotes;
	const NotesMaxLength = 8000;
	const NotesDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.otherstudy
	 * @var string strOtherstudy
	 */
	protected $strOtherstudy;
	const OtherstudyMaxLength = 2;
	const OtherstudyDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.homeinterviewer
	 * @var string strHomeinterviewer
	 */
	protected $strHomeinterviewer;
	const HomeinterviewerMaxLength = 60;
	const HomeinterviewerDefault = null;


	/**
	 * Protected member variable that maps to the database PK Identity column participant.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.interviewer_id
	 * @var integer intInterviewerId
	 */
	protected $intInterviewerId;
	const InterviewerIdDefault = null;


	/**
	 * Protected member variable that maps to the database column participant.audit_id
	 * @var integer intAuditId
	 */
	protected $intAuditId;
	const AuditIdDefault = null;


	/**
	 * Private member variable that stores a reference to a single Calllog object
	 * (of type Calllog), if this Participant object was restored with
	 * an expansion on the calllog association table.
	 * @var Calllog _objCalllog;
	 */
	private $_objCalllog;

	/**
	 * Private member variable that stores a reference to an array of Calllog objects
	 * (of type Calllog[]), if this Participant object was restored with
	 * an ExpandAsArray on the calllog association table.
	 * @var Calllog[] _objCalllogArray;
	 */
	private $_objCalllogArray = array();

	/**
	 * Private member variable that stores a reference to a single T3Sch object
	 * (of type T3Sch), if this Participant object was restored with
	 * an expansion on the t3_sch association table.
	 * @var T3Sch _objT3Sch;
	*/
	private $_objT3Sch;

	/**
	 * Private member variable that stores a reference to an array of T3Sch objects
	 * (of type T3Sch[]), if this Participant object was restored with
	 * an ExpandAsArray on the t3_sch association table.
	 * @var T3Sch[] _objT3SchArray;
	 */
	private $_objT3SchArray = array();

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
	 * in the database column participant.interviewer_id.
	 *
	 * NOTE: Always use the Interviewer property getter to correctly retrieve this User object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var User objInterviewer
	 */
	protected $objInterviewer;






	////////////////////////////////////////
	// METHODS for WEB SERVICES
	////////////////////////////////////////

	public static function GetSoapComplexTypeXml() {
		$strToReturn = '<complexType name="Participant"><sequence>';
		$strToReturn .= '<element name="Caseid" type="xsd:string"/>';
		$strToReturn .= '<element name="Title" type="xsd:string"/>';
		$strToReturn .= '<element name="Lastname" type="xsd:string"/>';
		$strToReturn .= '<element name="Firstname" type="xsd:string"/>';
		$strToReturn .= '<element name="Middlename" type="xsd:string"/>';
		$strToReturn .= '<element name="Maidenname" type="xsd:string"/>';
		$strToReturn .= '<element name="Nickname" type="xsd:string"/>';
		$strToReturn .= '<element name="Street" type="xsd:string"/>';
		$strToReturn .= '<element name="Streetsort" type="xsd:string"/>';
		$strToReturn .= '<element name="Pobox" type="xsd:string"/>';
		$strToReturn .= '<element name="City" type="xsd:string"/>';
		$strToReturn .= '<element name="State" type="xsd:string"/>';
		$strToReturn .= '<element name="Zip" type="xsd:string"/>';
		$strToReturn .= '<element name="Homephone" type="xsd:string"/>';
		$strToReturn .= '<element name="Otherphone" type="xsd:string"/>';
		$strToReturn .= '<element name="Gender" type="xsd:string"/>';
		$strToReturn .= '<element name="Race" type="xsd:string"/>';
		$strToReturn .= '<element name="Dateofbirth" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Numhouse" type="xsd:int"/>';
		$strToReturn .= '<element name="Typedwelling" type="xsd:string"/>';
		$strToReturn .= '<element name="Typedwellingother" type="xsd:string"/>';
		$strToReturn .= '<element name="Rentorown" type="xsd:string"/>';
		$strToReturn .= '<element name="Rentorownother" type="xsd:string"/>';
		$strToReturn .= '<element name="Maritalstatus" type="xsd:string"/>';
		$strToReturn .= '<element name="Email" type="xsd:string"/>';
		$strToReturn .= '<element name="C1name" type="xsd:string"/>';
		$strToReturn .= '<element name="C1street" type="xsd:string"/>';
		$strToReturn .= '<element name="C1pobox" type="xsd:string"/>';
		$strToReturn .= '<element name="C1city" type="xsd:string"/>';
		$strToReturn .= '<element name="C1state" type="xsd:string"/>';
		$strToReturn .= '<element name="C1zip" type="xsd:string"/>';
		$strToReturn .= '<element name="C1phone" type="xsd:string"/>';
		$strToReturn .= '<element name="C1relation" type="xsd:string"/>';
		$strToReturn .= '<element name="C2name" type="xsd:string"/>';
		$strToReturn .= '<element name="C2street" type="xsd:string"/>';
		$strToReturn .= '<element name="C2pobox" type="xsd:string"/>';
		$strToReturn .= '<element name="C2city" type="xsd:string"/>';
		$strToReturn .= '<element name="C2state" type="xsd:string"/>';
		$strToReturn .= '<element name="C2zip" type="xsd:string"/>';
		$strToReturn .= '<element name="C2phone" type="xsd:string"/>';
		$strToReturn .= '<element name="C2relation" type="xsd:string"/>';
		$strToReturn .= '<element name="C3name" type="xsd:string"/>';
		$strToReturn .= '<element name="C3street" type="xsd:string"/>';
		$strToReturn .= '<element name="C3pobox" type="xsd:string"/>';
		$strToReturn .= '<element name="C3city" type="xsd:string"/>';
		$strToReturn .= '<element name="C3state" type="xsd:string"/>';
		$strToReturn .= '<element name="C3zip" type="xsd:string"/>';
		$strToReturn .= '<element name="C3phone" type="xsd:string"/>';
		$strToReturn .= '<element name="C3relation" type="xsd:string"/>';
		$strToReturn .= '<element name="Basecode" type="xsd:int"/>';
		$strToReturn .= '<element name="F1code" type="xsd:int"/>';
		$strToReturn .= '<element name="Necode" type="xsd:int"/>';
		$strToReturn .= '<element name="Currentcode" type="xsd:int"/>';
		$strToReturn .= '<element name="Postcode" type="xsd:int"/>';
		$strToReturn .= '<element name="Base1stint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Baseclinic" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Base2ndint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="F11stint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="F1clinic" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="F12ndint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Ne1stint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Neclinic" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Ne2ndint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="F21stint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="F2clinic" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="F22ndint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Buddyid" type="xsd:int"/>';
		$strToReturn .= '<element name="Buddydate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Acesid" type="xsd:string"/>';
		$strToReturn .= '<element name="Aces1stint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Aces2ndint" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Gogoindid" type="xsd:int"/>';
		$strToReturn .= '<element name="Gogofamid" type="xsd:int"/>';
		$strToReturn .= '<element name="Gogodate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Gogolongid" type="xsd:int"/>';
		$strToReturn .= '<element name="Gogolongdate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Joproid" type="xsd:string"/>';
		$strToReturn .= '<element name="Joprodate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Joprocont" type="xsd:int"/>';
		$strToReturn .= '<element name="Joprocomp" type="xsd:int"/>';
		$strToReturn .= '<element name="Lastcodeupdate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Postcodeupdate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="T0weight" type="xsd:float"/>';
		$strToReturn .= '<element name="T1weight" type="xsd:float"/>';
		$strToReturn .= '<element name="Notes" type="xsd:string"/>';
		$strToReturn .= '<element name="Otherstudy" type="xsd:string"/>';
		$strToReturn .= '<element name="Homeinterviewer" type="xsd:string"/>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Interviewer" type="xsd1:User"/>';
		$strToReturn .= '<element name="AuditId" type="xsd:int"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('Participant', $strComplexTypeArray)) {
			$strComplexTypeArray['Participant'] = Participant::GetSoapComplexTypeXml();
			User::AlterSoapComplexTypeArray($strComplexTypeArray);
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, Participant::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new Participant();
		if (property_exists($objSoapObject, 'Caseid'))
			$objToReturn->strCaseid = $objSoapObject->Caseid;
		if (property_exists($objSoapObject, 'Title'))
			$objToReturn->strTitle = $objSoapObject->Title;
		if (property_exists($objSoapObject, 'Lastname'))
			$objToReturn->strLastname = $objSoapObject->Lastname;
		if (property_exists($objSoapObject, 'Firstname'))
			$objToReturn->strFirstname = $objSoapObject->Firstname;
		if (property_exists($objSoapObject, 'Middlename'))
			$objToReturn->strMiddlename = $objSoapObject->Middlename;
		if (property_exists($objSoapObject, 'Maidenname'))
			$objToReturn->strMaidenname = $objSoapObject->Maidenname;
		if (property_exists($objSoapObject, 'Nickname'))
			$objToReturn->strNickname = $objSoapObject->Nickname;
		if (property_exists($objSoapObject, 'Street'))
			$objToReturn->strStreet = $objSoapObject->Street;
		if (property_exists($objSoapObject, 'Streetsort'))
			$objToReturn->strStreetsort = $objSoapObject->Streetsort;
		if (property_exists($objSoapObject, 'Pobox'))
			$objToReturn->strPobox = $objSoapObject->Pobox;
		if (property_exists($objSoapObject, 'City'))
			$objToReturn->strCity = $objSoapObject->City;
		if (property_exists($objSoapObject, 'State'))
			$objToReturn->strState = $objSoapObject->State;
		if (property_exists($objSoapObject, 'Zip'))
			$objToReturn->strZip = $objSoapObject->Zip;
		if (property_exists($objSoapObject, 'Homephone'))
			$objToReturn->strHomephone = $objSoapObject->Homephone;
		if (property_exists($objSoapObject, 'Otherphone'))
			$objToReturn->strOtherphone = $objSoapObject->Otherphone;
		if (property_exists($objSoapObject, 'Gender'))
			$objToReturn->strGender = $objSoapObject->Gender;
		if (property_exists($objSoapObject, 'Race'))
			$objToReturn->strRace = $objSoapObject->Race;
		if (property_exists($objSoapObject, 'Dateofbirth'))
			$objToReturn->dttDateofbirth = new QDateTime($objSoapObject->Dateofbirth);
		if (property_exists($objSoapObject, 'Numhouse'))
			$objToReturn->intNumhouse = $objSoapObject->Numhouse;
		if (property_exists($objSoapObject, 'Typedwelling'))
			$objToReturn->strTypedwelling = $objSoapObject->Typedwelling;
		if (property_exists($objSoapObject, 'Typedwellingother'))
			$objToReturn->strTypedwellingother = $objSoapObject->Typedwellingother;
		if (property_exists($objSoapObject, 'Rentorown'))
			$objToReturn->strRentorown = $objSoapObject->Rentorown;
		if (property_exists($objSoapObject, 'Rentorownother'))
			$objToReturn->strRentorownother = $objSoapObject->Rentorownother;
		if (property_exists($objSoapObject, 'Maritalstatus'))
			$objToReturn->strMaritalstatus = $objSoapObject->Maritalstatus;
		if (property_exists($objSoapObject, 'Email'))
			$objToReturn->strEmail = $objSoapObject->Email;
		if (property_exists($objSoapObject, 'C1name'))
			$objToReturn->strC1name = $objSoapObject->C1name;
		if (property_exists($objSoapObject, 'C1street'))
			$objToReturn->strC1street = $objSoapObject->C1street;
		if (property_exists($objSoapObject, 'C1pobox'))
			$objToReturn->strC1pobox = $objSoapObject->C1pobox;
		if (property_exists($objSoapObject, 'C1city'))
			$objToReturn->strC1city = $objSoapObject->C1city;
		if (property_exists($objSoapObject, 'C1state'))
			$objToReturn->strC1state = $objSoapObject->C1state;
		if (property_exists($objSoapObject, 'C1zip'))
			$objToReturn->strC1zip = $objSoapObject->C1zip;
		if (property_exists($objSoapObject, 'C1phone'))
			$objToReturn->strC1phone = $objSoapObject->C1phone;
		if (property_exists($objSoapObject, 'C1relation'))
			$objToReturn->strC1relation = $objSoapObject->C1relation;
		if (property_exists($objSoapObject, 'C2name'))
			$objToReturn->strC2name = $objSoapObject->C2name;
		if (property_exists($objSoapObject, 'C2street'))
			$objToReturn->strC2street = $objSoapObject->C2street;
		if (property_exists($objSoapObject, 'C2pobox'))
			$objToReturn->strC2pobox = $objSoapObject->C2pobox;
		if (property_exists($objSoapObject, 'C2city'))
			$objToReturn->strC2city = $objSoapObject->C2city;
		if (property_exists($objSoapObject, 'C2state'))
			$objToReturn->strC2state = $objSoapObject->C2state;
		if (property_exists($objSoapObject, 'C2zip'))
			$objToReturn->strC2zip = $objSoapObject->C2zip;
		if (property_exists($objSoapObject, 'C2phone'))
			$objToReturn->strC2phone = $objSoapObject->C2phone;
		if (property_exists($objSoapObject, 'C2relation'))
			$objToReturn->strC2relation = $objSoapObject->C2relation;
		if (property_exists($objSoapObject, 'C3name'))
			$objToReturn->strC3name = $objSoapObject->C3name;
		if (property_exists($objSoapObject, 'C3street'))
			$objToReturn->strC3street = $objSoapObject->C3street;
		if (property_exists($objSoapObject, 'C3pobox'))
			$objToReturn->strC3pobox = $objSoapObject->C3pobox;
		if (property_exists($objSoapObject, 'C3city'))
			$objToReturn->strC3city = $objSoapObject->C3city;
		if (property_exists($objSoapObject, 'C3state'))
			$objToReturn->strC3state = $objSoapObject->C3state;
		if (property_exists($objSoapObject, 'C3zip'))
			$objToReturn->strC3zip = $objSoapObject->C3zip;
		if (property_exists($objSoapObject, 'C3phone'))
			$objToReturn->strC3phone = $objSoapObject->C3phone;
		if (property_exists($objSoapObject, 'C3relation'))
			$objToReturn->strC3relation = $objSoapObject->C3relation;
		if (property_exists($objSoapObject, 'Basecode'))
			$objToReturn->intBasecode = $objSoapObject->Basecode;
		if (property_exists($objSoapObject, 'F1code'))
			$objToReturn->intF1code = $objSoapObject->F1code;
		if (property_exists($objSoapObject, 'Necode'))
			$objToReturn->intNecode = $objSoapObject->Necode;
		if (property_exists($objSoapObject, 'Currentcode'))
			$objToReturn->intCurrentcode = $objSoapObject->Currentcode;
		if (property_exists($objSoapObject, 'Postcode'))
			$objToReturn->intPostcode = $objSoapObject->Postcode;
		if (property_exists($objSoapObject, 'Base1stint'))
			$objToReturn->dttBase1stint = new QDateTime($objSoapObject->Base1stint);
		if (property_exists($objSoapObject, 'Baseclinic'))
			$objToReturn->dttBaseclinic = new QDateTime($objSoapObject->Baseclinic);
		if (property_exists($objSoapObject, 'Base2ndint'))
			$objToReturn->dttBase2ndint = new QDateTime($objSoapObject->Base2ndint);
		if (property_exists($objSoapObject, 'F11stint'))
			$objToReturn->dttF11stint = new QDateTime($objSoapObject->F11stint);
		if (property_exists($objSoapObject, 'F1clinic'))
			$objToReturn->dttF1clinic = new QDateTime($objSoapObject->F1clinic);
		if (property_exists($objSoapObject, 'F12ndint'))
			$objToReturn->dttF12ndint = new QDateTime($objSoapObject->F12ndint);
		if (property_exists($objSoapObject, 'Ne1stint'))
			$objToReturn->dttNe1stint = new QDateTime($objSoapObject->Ne1stint);
		if (property_exists($objSoapObject, 'Neclinic'))
			$objToReturn->dttNeclinic = new QDateTime($objSoapObject->Neclinic);
		if (property_exists($objSoapObject, 'Ne2ndint'))
			$objToReturn->dttNe2ndint = new QDateTime($objSoapObject->Ne2ndint);
		if (property_exists($objSoapObject, 'F21stint'))
			$objToReturn->dttF21stint = new QDateTime($objSoapObject->F21stint);
		if (property_exists($objSoapObject, 'F2clinic'))
			$objToReturn->dttF2clinic = new QDateTime($objSoapObject->F2clinic);
		if (property_exists($objSoapObject, 'F22ndint'))
			$objToReturn->dttF22ndint = new QDateTime($objSoapObject->F22ndint);
		if (property_exists($objSoapObject, 'Buddyid'))
			$objToReturn->intBuddyid = $objSoapObject->Buddyid;
		if (property_exists($objSoapObject, 'Buddydate'))
			$objToReturn->dttBuddydate = new QDateTime($objSoapObject->Buddydate);
		if (property_exists($objSoapObject, 'Acesid'))
			$objToReturn->strAcesid = $objSoapObject->Acesid;
		if (property_exists($objSoapObject, 'Aces1stint'))
			$objToReturn->dttAces1stint = new QDateTime($objSoapObject->Aces1stint);
		if (property_exists($objSoapObject, 'Aces2ndint'))
			$objToReturn->dttAces2ndint = new QDateTime($objSoapObject->Aces2ndint);
		if (property_exists($objSoapObject, 'Gogoindid'))
			$objToReturn->intGogoindid = $objSoapObject->Gogoindid;
		if (property_exists($objSoapObject, 'Gogofamid'))
			$objToReturn->intGogofamid = $objSoapObject->Gogofamid;
		if (property_exists($objSoapObject, 'Gogodate'))
			$objToReturn->dttGogodate = new QDateTime($objSoapObject->Gogodate);
		if (property_exists($objSoapObject, 'Gogolongid'))
			$objToReturn->intGogolongid = $objSoapObject->Gogolongid;
		if (property_exists($objSoapObject, 'Gogolongdate'))
			$objToReturn->dttGogolongdate = new QDateTime($objSoapObject->Gogolongdate);
		if (property_exists($objSoapObject, 'Joproid'))
			$objToReturn->strJoproid = $objSoapObject->Joproid;
		if (property_exists($objSoapObject, 'Joprodate'))
			$objToReturn->dttJoprodate = new QDateTime($objSoapObject->Joprodate);
		if (property_exists($objSoapObject, 'Joprocont'))
			$objToReturn->intJoprocont = $objSoapObject->Joprocont;
		if (property_exists($objSoapObject, 'Joprocomp'))
			$objToReturn->intJoprocomp = $objSoapObject->Joprocomp;
		if (property_exists($objSoapObject, 'Lastcodeupdate'))
			$objToReturn->dttLastcodeupdate = new QDateTime($objSoapObject->Lastcodeupdate);
		if (property_exists($objSoapObject, 'Postcodeupdate'))
			$objToReturn->dttPostcodeupdate = new QDateTime($objSoapObject->Postcodeupdate);
		if (property_exists($objSoapObject, 'T0weight'))
			$objToReturn->fltT0weight = $objSoapObject->T0weight;
		if (property_exists($objSoapObject, 'T1weight'))
			$objToReturn->fltT1weight = $objSoapObject->T1weight;
		if (property_exists($objSoapObject, 'Notes'))
			$objToReturn->strNotes = $objSoapObject->Notes;
		if (property_exists($objSoapObject, 'Otherstudy'))
			$objToReturn->strOtherstudy = $objSoapObject->Otherstudy;
		if (property_exists($objSoapObject, 'Homeinterviewer'))
			$objToReturn->strHomeinterviewer = $objSoapObject->Homeinterviewer;
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if ((property_exists($objSoapObject, 'Interviewer')) &&
				($objSoapObject->Interviewer))
			$objToReturn->Interviewer = User::GetObjectFromSoapObject($objSoapObject->Interviewer);
		if (property_exists($objSoapObject, 'AuditId'))
			$objToReturn->intAuditId = $objSoapObject->AuditId;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, Participant::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn ?? '') ?? '');
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->dttDateofbirth)
			$objObject->dttDateofbirth = $objObject->dttDateofbirth->toString(QDateTime::FormatSoap);
		if ($objObject->dttBase1stint)
			$objObject->dttBase1stint = $objObject->dttBase1stint->toString(QDateTime::FormatSoap);
		if ($objObject->dttBaseclinic)
			$objObject->dttBaseclinic = $objObject->dttBaseclinic->toString(QDateTime::FormatSoap);
		if ($objObject->dttBase2ndint)
			$objObject->dttBase2ndint = $objObject->dttBase2ndint->toString(QDateTime::FormatSoap);
		if ($objObject->dttF11stint)
			$objObject->dttF11stint = $objObject->dttF11stint->toString(QDateTime::FormatSoap);
		if ($objObject->dttF1clinic)
			$objObject->dttF1clinic = $objObject->dttF1clinic->toString(QDateTime::FormatSoap);
		if ($objObject->dttF12ndint)
			$objObject->dttF12ndint = $objObject->dttF12ndint->toString(QDateTime::FormatSoap);
		if ($objObject->dttNe1stint)
			$objObject->dttNe1stint = $objObject->dttNe1stint->toString(QDateTime::FormatSoap);
		if ($objObject->dttNeclinic)
			$objObject->dttNeclinic = $objObject->dttNeclinic->toString(QDateTime::FormatSoap);
		if ($objObject->dttNe2ndint)
			$objObject->dttNe2ndint = $objObject->dttNe2ndint->toString(QDateTime::FormatSoap);
		if ($objObject->dttF21stint)
			$objObject->dttF21stint = $objObject->dttF21stint->toString(QDateTime::FormatSoap);
		if ($objObject->dttF2clinic)
			$objObject->dttF2clinic = $objObject->dttF2clinic->toString(QDateTime::FormatSoap);
		if ($objObject->dttF22ndint)
			$objObject->dttF22ndint = $objObject->dttF22ndint->toString(QDateTime::FormatSoap);
		if ($objObject->dttBuddydate)
			$objObject->dttBuddydate = $objObject->dttBuddydate->toString(QDateTime::FormatSoap);
		if ($objObject->dttAces1stint)
			$objObject->dttAces1stint = $objObject->dttAces1stint->toString(QDateTime::FormatSoap);
		if ($objObject->dttAces2ndint)
			$objObject->dttAces2ndint = $objObject->dttAces2ndint->toString(QDateTime::FormatSoap);
		if ($objObject->dttGogodate)
			$objObject->dttGogodate = $objObject->dttGogodate->toString(QDateTime::FormatSoap);
		if ($objObject->dttGogolongdate)
			$objObject->dttGogolongdate = $objObject->dttGogolongdate->toString(QDateTime::FormatSoap);
		if ($objObject->dttJoprodate)
			$objObject->dttJoprodate = $objObject->dttJoprodate->toString(QDateTime::FormatSoap);
		if ($objObject->dttLastcodeupdate)
			$objObject->dttLastcodeupdate = $objObject->dttLastcodeupdate->toString(QDateTime::FormatSoap);
		if ($objObject->dttPostcodeupdate)
			$objObject->dttPostcodeupdate = $objObject->dttPostcodeupdate->toString(QDateTime::FormatSoap);
		if ($objObject->objInterviewer)
			$objObject->objInterviewer = User::GetSoapObjectFromObject($objObject->objInterviewer, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intInterviewerId = null;
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeParticipant extends QQNode {
	protected $strTableName = 'pt__participant'; public static $strPubTableName = 'pt__participant';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Participant';
	public function __get($strName) {
		switch ($strName) {
			case 'Caseid':
				return new QQNode('caseid', 'string', $this);
			case 'Title':
				return new QQNode('title', 'string', $this);
			case 'Lastname':
				return new QQNode('lastname', 'string', $this);
			case 'Firstname':
				return new QQNode('firstname', 'string', $this);
			case 'Middlename':
				return new QQNode('middlename', 'string', $this);
			case 'Maidenname':
				return new QQNode('maidenname', 'string', $this);
			case 'Nickname':
				return new QQNode('nickname', 'string', $this);
			case 'Street':
				return new QQNode('street', 'string', $this);
			case 'Streetsort':
				return new QQNode('streetsort', 'string', $this);
			case 'Pobox':
				return new QQNode('pobox', 'string', $this);
			case 'City':
				return new QQNode('city', 'string', $this);
			case 'State':
				return new QQNode('state', 'string', $this);
			case 'Zip':
				return new QQNode('zip', 'string', $this);
			case 'Homephone':
				return new QQNode('homephone', 'string', $this);
			case 'Otherphone':
				return new QQNode('otherphone', 'string', $this);
			case 'Gender':
				return new QQNode('gender', 'string', $this);
			case 'Race':
				return new QQNode('race', 'string', $this);
			case 'Dateofbirth':
				return new QQNode('dateofbirth', 'QDateTime', $this);
			case 'Numhouse':
				return new QQNode('numhouse', 'integer', $this);
			case 'Typedwelling':
				return new QQNode('typedwelling', 'string', $this);
			case 'Typedwellingother':
				return new QQNode('typedwellingother', 'string', $this);
			case 'Rentorown':
				return new QQNode('rentorown', 'string', $this);
			case 'Rentorownother':
				return new QQNode('rentorownother', 'string', $this);
			case 'Maritalstatus':
				return new QQNode('maritalstatus', 'string', $this);
			case 'Email':
				return new QQNode('email', 'string', $this);
			case 'C1name':
				return new QQNode('c1name', 'string', $this);
			case 'C1street':
				return new QQNode('c1street', 'string', $this);
			case 'C1pobox':
				return new QQNode('c1pobox', 'string', $this);
			case 'C1city':
				return new QQNode('c1city', 'string', $this);
			case 'C1state':
				return new QQNode('c1state', 'string', $this);
			case 'C1zip':
				return new QQNode('c1zip', 'string', $this);
			case 'C1phone':
				return new QQNode('c1phone', 'string', $this);
			case 'C1relation':
				return new QQNode('c1relation', 'string', $this);
			case 'C2name':
				return new QQNode('c2name', 'string', $this);
			case 'C2street':
				return new QQNode('c2street', 'string', $this);
			case 'C2pobox':
				return new QQNode('c2pobox', 'string', $this);
			case 'C2city':
				return new QQNode('c2city', 'string', $this);
			case 'C2state':
				return new QQNode('c2state', 'string', $this);
			case 'C2zip':
				return new QQNode('c2zip', 'string', $this);
			case 'C2phone':
				return new QQNode('c2phone', 'string', $this);
			case 'C2relation':
				return new QQNode('c2relation', 'string', $this);
			case 'C3name':
				return new QQNode('c3name', 'string', $this);
			case 'C3street':
				return new QQNode('c3street', 'string', $this);
			case 'C3pobox':
				return new QQNode('c3pobox', 'string', $this);
			case 'C3city':
				return new QQNode('c3city', 'string', $this);
			case 'C3state':
				return new QQNode('c3state', 'string', $this);
			case 'C3zip':
				return new QQNode('c3zip', 'string', $this);
			case 'C3phone':
				return new QQNode('c3phone', 'string', $this);
			case 'C3relation':
				return new QQNode('c3relation', 'string', $this);
			case 'Basecode':
				return new QQNode('basecode', 'integer', $this);
			case 'F1code':
				return new QQNode('f1code', 'integer', $this);
			case 'Necode':
				return new QQNode('necode', 'integer', $this);
			case 'Currentcode':
				return new QQNode('currentcode', 'integer', $this);
			case 'Postcode':
				return new QQNode('postcode', 'integer', $this);
			case 'Base1stint':
				return new QQNode('base1stint', 'QDateTime', $this);
			case 'Baseclinic':
				return new QQNode('baseclinic', 'QDateTime', $this);
			case 'Base2ndint':
				return new QQNode('base2ndint', 'QDateTime', $this);
			case 'F11stint':
				return new QQNode('f11stint', 'QDateTime', $this);
			case 'F1clinic':
				return new QQNode('f1clinic', 'QDateTime', $this);
			case 'F12ndint':
				return new QQNode('f12ndint', 'QDateTime', $this);
			case 'Ne1stint':
				return new QQNode('ne1stint', 'QDateTime', $this);
			case 'Neclinic':
				return new QQNode('neclinic', 'QDateTime', $this);
			case 'Ne2ndint':
				return new QQNode('ne2ndint', 'QDateTime', $this);
			case 'F21stint':
				return new QQNode('f21stint', 'QDateTime', $this);
			case 'F2clinic':
				return new QQNode('f2clinic', 'QDateTime', $this);
			case 'F22ndint':
				return new QQNode('f22ndint', 'QDateTime', $this);
			case 'Buddyid':
				return new QQNode('buddyid', 'integer', $this);
			case 'Buddydate':
				return new QQNode('buddydate', 'QDateTime', $this);
			case 'Acesid':
				return new QQNode('acesid', 'string', $this);
			case 'Aces1stint':
				return new QQNode('aces1stint', 'QDateTime', $this);
			case 'Aces2ndint':
				return new QQNode('aces2ndint', 'QDateTime', $this);
			case 'Gogoindid':
				return new QQNode('gogoindid', 'integer', $this);
			case 'Gogofamid':
				return new QQNode('gogofamid', 'integer', $this);
			case 'Gogodate':
				return new QQNode('gogodate', 'QDateTime', $this);
			case 'Gogolongid':
				return new QQNode('gogolongid', 'integer', $this);
			case 'Gogolongdate':
				return new QQNode('gogolongdate', 'QDateTime', $this);
			case 'Joproid':
				return new QQNode('joproid', 'string', $this);
			case 'Joprodate':
				return new QQNode('joprodate', 'QDateTime', $this);
			case 'Joprocont':
				return new QQNode('joprocont', 'integer', $this);
			case 'Joprocomp':
				return new QQNode('joprocomp', 'integer', $this);
			case 'Lastcodeupdate':
				return new QQNode('lastcodeupdate', 'QDateTime', $this);
			case 'Postcodeupdate':
				return new QQNode('postcodeupdate', 'QDateTime', $this);
			case 'T0weight':
				return new QQNode('t0weight', 'double', $this);
			case 'T1weight':
				return new QQNode('t1weight', 'double', $this);
			case 'Notes':
				return new QQNode('notes', 'string', $this);
			case 'Otherstudy':
				return new QQNode('otherstudy', 'string', $this);
			case 'Homeinterviewer':
				return new QQNode('homeinterviewer', 'string', $this);
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'InterviewerId':
				return new QQNode('interviewer_id', 'integer', $this);
			case 'Interviewer':
				return new QQNodeUser('interviewer_id', 'integer', $this);
			case 'AuditId':
				return new QQNode('audit_id', 'integer', $this);
			case 'Calllog':
				return new QQReverseReferenceNodeCalllog($this, 'calllog', 'reverse_reference', 'participant_id');
			case 'T3Sch':
				return new QQReverseReferenceNodeT3Sch($this, 't3sch', 'reverse_reference', 'participant_id');

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

class QQReverseReferenceNodeParticipant extends QQReverseReferenceNode {
	protected $strTableName = 'pt__participant'; public static $strPubTableName = 'pt__participant';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Participant';
	public function __get($strName) {
		switch ($strName) {
			case 'Caseid':
				return new QQNode('caseid', 'string', $this);
			case 'Title':
				return new QQNode('title', 'string', $this);
			case 'Lastname':
				return new QQNode('lastname', 'string', $this);
			case 'Firstname':
				return new QQNode('firstname', 'string', $this);
			case 'Middlename':
				return new QQNode('middlename', 'string', $this);
			case 'Maidenname':
				return new QQNode('maidenname', 'string', $this);
			case 'Nickname':
				return new QQNode('nickname', 'string', $this);
			case 'Street':
				return new QQNode('street', 'string', $this);
			case 'Streetsort':
				return new QQNode('streetsort', 'string', $this);
			case 'Pobox':
				return new QQNode('pobox', 'string', $this);
			case 'City':
				return new QQNode('city', 'string', $this);
			case 'State':
				return new QQNode('state', 'string', $this);
			case 'Zip':
				return new QQNode('zip', 'string', $this);
			case 'Homephone':
				return new QQNode('homephone', 'string', $this);
			case 'Otherphone':
				return new QQNode('otherphone', 'string', $this);
			case 'Gender':
				return new QQNode('gender', 'string', $this);
			case 'Race':
				return new QQNode('race', 'string', $this);
			case 'Dateofbirth':
				return new QQNode('dateofbirth', 'QDateTime', $this);
			case 'Numhouse':
				return new QQNode('numhouse', 'integer', $this);
			case 'Typedwelling':
				return new QQNode('typedwelling', 'string', $this);
			case 'Typedwellingother':
				return new QQNode('typedwellingother', 'string', $this);
			case 'Rentorown':
				return new QQNode('rentorown', 'string', $this);
			case 'Rentorownother':
				return new QQNode('rentorownother', 'string', $this);
			case 'Maritalstatus':
				return new QQNode('maritalstatus', 'string', $this);
			case 'Email':
				return new QQNode('email', 'string', $this);
			case 'C1name':
				return new QQNode('c1name', 'string', $this);
			case 'C1street':
				return new QQNode('c1street', 'string', $this);
			case 'C1pobox':
				return new QQNode('c1pobox', 'string', $this);
			case 'C1city':
				return new QQNode('c1city', 'string', $this);
			case 'C1state':
				return new QQNode('c1state', 'string', $this);
			case 'C1zip':
				return new QQNode('c1zip', 'string', $this);
			case 'C1phone':
				return new QQNode('c1phone', 'string', $this);
			case 'C1relation':
				return new QQNode('c1relation', 'string', $this);
			case 'C2name':
				return new QQNode('c2name', 'string', $this);
			case 'C2street':
				return new QQNode('c2street', 'string', $this);
			case 'C2pobox':
				return new QQNode('c2pobox', 'string', $this);
			case 'C2city':
				return new QQNode('c2city', 'string', $this);
			case 'C2state':
				return new QQNode('c2state', 'string', $this);
			case 'C2zip':
				return new QQNode('c2zip', 'string', $this);
			case 'C2phone':
				return new QQNode('c2phone', 'string', $this);
			case 'C2relation':
				return new QQNode('c2relation', 'string', $this);
			case 'C3name':
				return new QQNode('c3name', 'string', $this);
			case 'C3street':
				return new QQNode('c3street', 'string', $this);
			case 'C3pobox':
				return new QQNode('c3pobox', 'string', $this);
			case 'C3city':
				return new QQNode('c3city', 'string', $this);
			case 'C3state':
				return new QQNode('c3state', 'string', $this);
			case 'C3zip':
				return new QQNode('c3zip', 'string', $this);
			case 'C3phone':
				return new QQNode('c3phone', 'string', $this);
			case 'C3relation':
				return new QQNode('c3relation', 'string', $this);
			case 'Basecode':
				return new QQNode('basecode', 'integer', $this);
			case 'F1code':
				return new QQNode('f1code', 'integer', $this);
			case 'Necode':
				return new QQNode('necode', 'integer', $this);
			case 'Currentcode':
				return new QQNode('currentcode', 'integer', $this);
			case 'Postcode':
				return new QQNode('postcode', 'integer', $this);
			case 'Base1stint':
				return new QQNode('base1stint', 'QDateTime', $this);
			case 'Baseclinic':
				return new QQNode('baseclinic', 'QDateTime', $this);
			case 'Base2ndint':
				return new QQNode('base2ndint', 'QDateTime', $this);
			case 'F11stint':
				return new QQNode('f11stint', 'QDateTime', $this);
			case 'F1clinic':
				return new QQNode('f1clinic', 'QDateTime', $this);
			case 'F12ndint':
				return new QQNode('f12ndint', 'QDateTime', $this);
			case 'Ne1stint':
				return new QQNode('ne1stint', 'QDateTime', $this);
			case 'Neclinic':
				return new QQNode('neclinic', 'QDateTime', $this);
			case 'Ne2ndint':
				return new QQNode('ne2ndint', 'QDateTime', $this);
			case 'F21stint':
				return new QQNode('f21stint', 'QDateTime', $this);
			case 'F2clinic':
				return new QQNode('f2clinic', 'QDateTime', $this);
			case 'F22ndint':
				return new QQNode('f22ndint', 'QDateTime', $this);
			case 'Buddyid':
				return new QQNode('buddyid', 'integer', $this);
			case 'Buddydate':
				return new QQNode('buddydate', 'QDateTime', $this);
			case 'Acesid':
				return new QQNode('acesid', 'string', $this);
			case 'Aces1stint':
				return new QQNode('aces1stint', 'QDateTime', $this);
			case 'Aces2ndint':
				return new QQNode('aces2ndint', 'QDateTime', $this);
			case 'Gogoindid':
				return new QQNode('gogoindid', 'integer', $this);
			case 'Gogofamid':
				return new QQNode('gogofamid', 'integer', $this);
			case 'Gogodate':
				return new QQNode('gogodate', 'QDateTime', $this);
			case 'Gogolongid':
				return new QQNode('gogolongid', 'integer', $this);
			case 'Gogolongdate':
				return new QQNode('gogolongdate', 'QDateTime', $this);
			case 'Joproid':
				return new QQNode('joproid', 'string', $this);
			case 'Joprodate':
				return new QQNode('joprodate', 'QDateTime', $this);
			case 'Joprocont':
				return new QQNode('joprocont', 'integer', $this);
			case 'Joprocomp':
				return new QQNode('joprocomp', 'integer', $this);
			case 'Lastcodeupdate':
				return new QQNode('lastcodeupdate', 'QDateTime', $this);
			case 'Postcodeupdate':
				return new QQNode('postcodeupdate', 'QDateTime', $this);
			case 'T0weight':
				return new QQNode('t0weight', 'double', $this);
			case 'T1weight':
				return new QQNode('t1weight', 'double', $this);
			case 'Notes':
				return new QQNode('notes', 'string', $this);
			case 'Otherstudy':
				return new QQNode('otherstudy', 'string', $this);
			case 'Homeinterviewer':
				return new QQNode('homeinterviewer', 'string', $this);
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'InterviewerId':
				return new QQNode('interviewer_id', 'integer', $this);
			case 'Interviewer':
				return new QQNodeUser('interviewer_id', 'integer', $this);
			case 'AuditId':
				return new QQNode('audit_id', 'integer', $this);
			case 'Calllog':
				return new QQReverseReferenceNodeCalllog($this, 'calllog', 'reverse_reference', 'participant_id');
			case 'T3Sch':
				return new QQReverseReferenceNodeT3Sch($this, 't3sch', 'reverse_reference', 'participant_id');

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