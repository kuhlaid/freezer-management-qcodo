<?php
/**
 * The abstract UserLoginTrackGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the UserLoginTrack subclass which
 * extends this UserLoginTrackGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the UserLoginTrack class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class UserLoginTrackGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a UserLoginTrack from PK Info
	 * @param integer $intId
	 * @return UserLoginTrack
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return UserLoginTrack::QuerySingle(
				QQ::Equal(QQN::UserLoginTrack()->Id, $intId)
		);
	}

	/**
	 * Load all UserLoginTracks
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return UserLoginTrack[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call UserLoginTrack::QueryArray to perform the LoadAll query
		try {
			return UserLoginTrack::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all UserLoginTracks
	 * @return int
	 */
	public static function CountAll() {
		// Call UserLoginTrack::QueryCount to perform the CountAll query
		return UserLoginTrack::QueryCount(QQ::All());
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
		$objDatabase = UserLoginTrack::GetDatabase();

		// Create/Build out the QueryBuilder object with UserLoginTrack-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'pt__user_login_track');
		UserLoginTrack::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('pt__user_login_track AS pt__user_login_track');

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
	 * Static Qcodo Query method to query for a single UserLoginTrack object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return UserLoginTrack the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = UserLoginTrack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new UserLoginTrack object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return UserLoginTrack::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of UserLoginTrack objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return UserLoginTrack[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = UserLoginTrack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return UserLoginTrack::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of UserLoginTrack objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = UserLoginTrack::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = UserLoginTrack::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'user_login_track_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with UserLoginTrack-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	UserLoginTrack::GetSelectFields($objQueryBuilder);
	UserLoginTrack::GetFromFields($objQueryBuilder);

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
	return UserLoginTrack::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this UserLoginTrack
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'pt__user_login_track';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.user_id AS ' . $strAliasPrefix . 'user_id');
			$objBuilder->AddSelectItem($strTableName . '.login_passed AS ' . $strAliasPrefix . 'login_passed');
			$objBuilder->AddSelectItem($strTableName . '.attempted AS ' . $strAliasPrefix . 'attempted');
			$objBuilder->AddSelectItem($strTableName . '.ip AS ' . $strAliasPrefix . 'ip');
			$objBuilder->AddSelectItem($strTableName . '.user_name_attempt AS ' . $strAliasPrefix . 'user_name_attempt');
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
	 * Instantiate a UserLoginTrack from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this UserLoginTrack::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return UserLoginTrack
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;


		// Create a new instance of the UserLoginTrack object
		$objToReturn = new UserLoginTrack();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->intUserId = $objDbRow->GetColumn($strAliasPrefix . 'user_id', 'Integer');
		$objToReturn->blnLoginPassed = $objDbRow->GetColumn($strAliasPrefix . 'login_passed', 'Bit');
		$objToReturn->dttAttempted = $objDbRow->GetColumn($strAliasPrefix . 'attempted', 'DateTime');
		$objToReturn->strIp = $objDbRow->GetColumn($strAliasPrefix . 'ip', 'VarChar');
		$objToReturn->strUserNameAttempt = $objDbRow->GetColumn($strAliasPrefix . 'user_name_attempt', 'VarChar');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'user_login_track__';




		return $objToReturn;
	}

	/**
	 * Instantiate an array of UserLoginTracks from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return UserLoginTrack[]
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
				$objItem = UserLoginTrack::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, UserLoginTrack::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single UserLoginTrack object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return UserLoginTrack
	 */
	public static function LoadById($intId) {
		return UserLoginTrack::QuerySingle(
				QQ::Equal(QQN::UserLoginTrack()->Id, $intId)
		);
	}

	/**
	 * Load an array of UserLoginTrack objects,
	 * by UserId Index(es)
	 * @param integer $intUserId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return UserLoginTrack[]
		*/
	public static function LoadArrayByUserId($intUserId, $objOptionalClauses = null) {
		// Call UserLoginTrack::QueryArray to perform the LoadArrayByUserId query
		try {
			return UserLoginTrack::QueryArray(
					QQ::Equal(QQN::UserLoginTrack()->UserId, $intUserId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count UserLoginTracks
	 * by UserId Index(es)
	 * @param integer $intUserId
	 * @return int
		*/
	public static function CountByUserId($intUserId) {
		// Call UserLoginTrack::QueryCount to perform the CountByUserId query
		return UserLoginTrack::QueryCount(
				QQ::Equal(QQN::UserLoginTrack()->UserId, $intUserId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this UserLoginTrack
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = UserLoginTrack::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeUserLoginTrack::$strPubTableName.' (
						user_id,
						login_passed,
						attempted,
						ip,
						user_name_attempt
				) VALUES (
						' . $objDatabase->SqlVariable($this->intUserId) . ',
						' . $objDatabase->SqlVariable($this->blnLoginPassed) . ',
						' . $objDatabase->SqlVariable($this->dttAttempted) . ',
						' . $objDatabase->SqlVariable($this->strIp) . ',
						' . $objDatabase->SqlVariable($this->strUserNameAttempt) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeUserLoginTrack::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeUserLoginTrack::$strPubTableName.'
						SET
						user_id = ' . $objDatabase->SqlVariable($this->intUserId) . ',
						login_passed = ' . $objDatabase->SqlVariable($this->blnLoginPassed) . ',
						attempted = ' . $objDatabase->SqlVariable($this->dttAttempted) . ',
						ip = ' . $objDatabase->SqlVariable($this->strIp) . ',
						user_name_attempt = ' . $objDatabase->SqlVariable($this->strUserNameAttempt) . '
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
	 * Delete this UserLoginTrack
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this UserLoginTrack with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = UserLoginTrack::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeUserLoginTrack::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all UserLoginTracks
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = UserLoginTrack::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeUserLoginTrack::$strPubTableName.'');
	}

	/**
	 * Truncate user_login_track table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = UserLoginTrack::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeUserLoginTrack::$strPubTableName.'');
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

			case 'UserId':
				/**
				 * Gets the value for intUserId
				 * @return integer
				 */
				return $this->intUserId;

			case 'LoginPassed':
				/**
				 * Gets the value for blnLoginPassed
				 * @return boolean
				 */
				return $this->blnLoginPassed;

			case 'Attempted':
				/**
				 * Gets the value for dttAttempted (Not Null)
				 * @return QDateTime
				 */
				return $this->dttAttempted;

			case 'Ip':
				/**
				 * Gets the value for strIp
				 * @return string
				 */
				return $this->strIp;

			case 'UserNameAttempt':
				/**
				 * Gets the value for strUserNameAttempt
				 * @return string
				 */
				return $this->strUserNameAttempt;


				///////////////////
				// Member Objects
				///////////////////

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
			case 'UserId':
				/**
				 * Sets the value for intUserId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intUserId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'LoginPassed':
				/**
				 * Sets the value for blnLoginPassed
				 * @param boolean $mixValue
				 * @return boolean
				 */
				try {
					return ($this->blnLoginPassed = QType::Cast($mixValue, QType::Boolean));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Attempted':
				/**
				 * Sets the value for dttAttempted (Not Null)
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttAttempted = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Ip':
				/**
				 * Sets the value for strIp
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strIp = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'UserNameAttempt':
				/**
				 * Sets the value for strUserNameAttempt
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strUserNameAttempt = QType::Cast($mixValue, QType::String));
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




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column user_login_track.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column user_login_track.user_id
	 * @var integer intUserId
	 */
	protected $intUserId;
	const UserIdDefault = null;


	/**
	 * Protected member variable that maps to the database column user_login_track.login_passed
	 * @var boolean blnLoginPassed
	 */
	protected $blnLoginPassed;
	const LoginPassedDefault = null;


	/**
	 * Protected member variable that maps to the database column user_login_track.attempted
	 * @var QDateTime dttAttempted
	 */
	protected $dttAttempted;
	const AttemptedDefault = null;


	/**
	 * Protected member variable that maps to the database column user_login_track.ip
	 * @var string strIp
	 */
	protected $strIp;
	const IpMaxLength = 15;
	const IpDefault = null;


	/**
	 * Protected member variable that maps to the database column user_login_track.user_name_attempt
	 * @var string strUserNameAttempt
	 */
	protected $strUserNameAttempt;
	const UserNameAttemptMaxLength = 45;
	const UserNameAttemptDefault = null;


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
		$strToReturn = '<complexType name="UserLoginTrack"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="UserId" type="xsd:int"/>';
		$strToReturn .= '<element name="LoginPassed" type="xsd:boolean"/>';
		$strToReturn .= '<element name="Attempted" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Ip" type="xsd:string"/>';
		$strToReturn .= '<element name="UserNameAttempt" type="xsd:string"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('UserLoginTrack', $strComplexTypeArray)) {
			$strComplexTypeArray['UserLoginTrack'] = UserLoginTrack::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, UserLoginTrack::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new UserLoginTrack();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'UserId'))
			$objToReturn->intUserId = $objSoapObject->UserId;
		if (property_exists($objSoapObject, 'LoginPassed'))
			$objToReturn->blnLoginPassed = $objSoapObject->LoginPassed;
		if (property_exists($objSoapObject, 'Attempted'))
			$objToReturn->dttAttempted = new QDateTime($objSoapObject->Attempted);
		if (property_exists($objSoapObject, 'Ip'))
			$objToReturn->strIp = $objSoapObject->Ip;
		if (property_exists($objSoapObject, 'UserNameAttempt'))
			$objToReturn->strUserNameAttempt = $objSoapObject->UserNameAttempt;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, UserLoginTrack::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn ?? '') ?? '');
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->dttAttempted)
			$objObject->dttAttempted = $objObject->dttAttempted->toString(QDateTime::FormatSoap);
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeUserLoginTrack extends QQNode {
	protected $strTableName = 'pt__user_login_track'; public static $strPubTableName = 'pt__user_login_track';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'UserLoginTrack';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'UserId':
				return new QQNode('user_id', 'integer', $this);
			case 'LoginPassed':
				return new QQNode('login_passed', 'boolean', $this);
			case 'Attempted':
				return new QQNode('attempted', 'QDateTime', $this);
			case 'Ip':
				return new QQNode('ip', 'string', $this);
			case 'UserNameAttempt':
				return new QQNode('user_name_attempt', 'string', $this);

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

class QQReverseReferenceNodeUserLoginTrack extends QQReverseReferenceNode {
	protected $strTableName = 'pt__user_login_track'; public static $strPubTableName = 'pt__user_login_track';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'UserLoginTrack';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'UserId':
				return new QQNode('user_id', 'integer', $this);
			case 'LoginPassed':
				return new QQNode('login_passed', 'boolean', $this);
			case 'Attempted':
				return new QQNode('attempted', 'QDateTime', $this);
			case 'Ip':
				return new QQNode('ip', 'string', $this);
			case 'UserNameAttempt':
				return new QQNode('user_name_attempt', 'string', $this);

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