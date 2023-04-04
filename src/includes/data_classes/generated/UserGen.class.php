<?php
/**
 * The abstract UserGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the User subclass which
 * extends this UserGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the User class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class UserGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a User from PK Info
	 * @param integer $intUserid
	 * @return User
	 */
	public static function Load($intUserid) {
		// Use QuerySingle to Perform the Query
		return User::QuerySingle(
				QQ::Equal(QQN::User()->Userid, $intUserid)
		);
	}

	/**
	 * Load all Users
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return User[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call User::QueryArray to perform the LoadAll query
		try {
			return User::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all Users
	 * @return int
	 */
	public static function CountAll() {
		// Call User::QueryCount to perform the CountAll query
		return User::QueryCount(QQ::All());
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
		$objDatabase = User::GetDatabase();

		// Create/Build out the QueryBuilder object with User-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'pt__user');
		User::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('pt__user AS pt__user');

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
	 * Static Qcodo Query method to query for a single User object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return User the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = User::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new User object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return User::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of User objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return User[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = User::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return User::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of User objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = User::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = User::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'user_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with User-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	User::GetSelectFields($objQueryBuilder);
	User::GetFromFields($objQueryBuilder);

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
	return User::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this User
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'pt__user';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.userid AS ' . $strAliasPrefix . 'userid');
			$objBuilder->AddSelectItem($strTableName . '.username AS ' . $strAliasPrefix . 'username');
			$objBuilder->AddSelectItem($strTableName . '.firstname AS ' . $strAliasPrefix . 'firstname');
			$objBuilder->AddSelectItem($strTableName . '.lastname AS ' . $strAliasPrefix . 'lastname');
			$objBuilder->AddSelectItem($strTableName . '.email AS ' . $strAliasPrefix . 'email');
			$objBuilder->AddSelectItem($strTableName . '.active AS ' . $strAliasPrefix . 'active');
			$objBuilder->AddSelectItem($strTableName . '.onyen AS ' . $strAliasPrefix . 'onyen');
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
	 * Instantiate a User from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this User::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return User
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;

		// See if we're doing an array expansion on the previous item
		if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intUserid == $objDbRow->GetColumn($strAliasPrefix . 'userid', 'Integer'))) {

			// We are.  Now, prepare to check for ExpandAsArray clauses
			$blnExpandedViaArray = false;
			if (!$strAliasPrefix)
				$strAliasPrefix = 'user__';

			if ((array_key_exists($strAliasPrefix . 'typeuseraccessasacl__user_type_id__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'typeuseraccessasacl__user_type_id__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objTypeUserAccessAsAclArray)) {
					$objPreviousChildItem = $objPreviousItem->_objTypeUserAccessAsAclArray[$intPreviousChildItemCount - 1];
					$objChildItem = TypeUserAccess::InstantiateDbRow($objDbRow, $strAliasPrefix . 'typeuseraccessasacl__user_type_id__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objTypeUserAccessAsAclArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objTypeUserAccessAsAclArray, TypeUserAccess::InstantiateDbRow($objDbRow, $strAliasPrefix . 'typeuseraccessasacl__user_type_id__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}


			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'user__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the User object
		$objToReturn = new User();
		$objToReturn->__blnRestored = true;

		$objToReturn->intUserid = $objDbRow->GetColumn($strAliasPrefix . 'userid', 'Integer');
		$objToReturn->strUsername = $objDbRow->GetColumn($strAliasPrefix . 'username', 'VarChar');
		$objToReturn->strFirstname = $objDbRow->GetColumn($strAliasPrefix . 'firstname', 'VarChar');
		$objToReturn->strLastname = $objDbRow->GetColumn($strAliasPrefix . 'lastname', 'VarChar');
		$objToReturn->strEmail = $objDbRow->GetColumn($strAliasPrefix . 'email', 'VarChar');
		$objToReturn->intActive = $objDbRow->GetColumn($strAliasPrefix . 'active', 'Integer');
		$objToReturn->strOnyen = $objDbRow->GetColumn($strAliasPrefix . 'onyen', 'VarChar');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'user__';



		// Check for TypeUserAccessAsAcl Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'typeuseraccessasacl__user_type_id__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'typeuseraccessasacl__user_type_id__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objTypeUserAccessAsAclArray, TypeUserAccess::InstantiateDbRow($objDbRow, $strAliasPrefix . 'typeuseraccessasacl__user_type_id__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objTypeUserAccessAsAcl = TypeUserAccess::InstantiateDbRow($objDbRow, $strAliasPrefix . 'typeuseraccessasacl__user_type_id__', $strExpandAsArrayNodes);
		}


		return $objToReturn;
	}

	/**
	 * Instantiate an array of Users from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return User[]
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
				$objItem = User::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, User::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single User object,
	 * by Userid Index(es)
	 * @param integer $intUserid
	 * @return User
	 */
	public static function LoadByUserid($intUserid) {
		return User::QuerySingle(
				QQ::Equal(QQN::User()->Userid, $intUserid)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////
	/**
	* Load an array of TypeUserAccess objects for a given TypeUserAccessAsAcl
	* via the acl_user_assn table
	* @param integer $intUserTypeId
	* @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	* @return User[]
	*/
	public static function LoadArrayByTypeUserAccessAsAcl($intUserTypeId, $objOptionalClauses = null) {
		// Call User::QueryArray to perform the LoadArrayByTypeUserAccessAsAcl query
		try {
			return User::QueryArray(
					QQ::Equal(QQN::User()->TypeUserAccessAsAcl->UserTypeId, $intUserTypeId),
					$objOptionalClauses
			);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Users for a given TypeUserAccessAsAcl
	 * via the acl_user_assn table
	 * @param integer $intUserTypeId
	 * @return int
		*/
	public static function CountByTypeUserAccessAsAcl($intUserTypeId) {
		return User::QueryCount(
				QQ::Equal(QQN::User()->TypeUserAccessAsAcl->UserTypeId, $intUserTypeId)
		);
	}



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this User
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = User::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeUser::$strPubTableName.' (
						username,
						firstname,
						lastname,
						email,
						active,
						onyen
				) VALUES (
						' . $objDatabase->SqlVariable($this->strUsername) . ',
						' . $objDatabase->SqlVariable($this->strFirstname) . ',
						' . $objDatabase->SqlVariable($this->strLastname) . ',
						' . $objDatabase->SqlVariable($this->strEmail) . ',
						' . $objDatabase->SqlVariable($this->intActive) . ',
						' . $objDatabase->SqlVariable($this->strOnyen) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intUserid = $objDatabase->InsertId(QQNodeUser::$strPubTableName, 'userid');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeUser::$strPubTableName.'
						SET
						username = ' . $objDatabase->SqlVariable($this->strUsername) . ',
						firstname = ' . $objDatabase->SqlVariable($this->strFirstname) . ',
						lastname = ' . $objDatabase->SqlVariable($this->strLastname) . ',
						email = ' . $objDatabase->SqlVariable($this->strEmail) . ',
						active = ' . $objDatabase->SqlVariable($this->intActive) . ',
						onyen = ' . $objDatabase->SqlVariable($this->strOnyen) . '
						WHERE
						userid = ' . $objDatabase->SqlVariable($this->intUserid) . '
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
	 * Delete this User
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intUserid)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this User with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = User::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeUser::$strPubTableName.'
				WHERE
				userid = ' . $objDatabase->SqlVariable($this->intUserid) . '');
	}

	/**
	 * Delete all Users
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = User::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeUser::$strPubTableName.'');
	}

	/**
	 * Truncate user table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = User::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeUser::$strPubTableName.'');
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
			case 'Userid':
				/**
				 * Gets the value for intUserid (Read-Only PK)
				 * @return integer
				 */
				return $this->intUserid;

			case 'Username':
				/**
				 * Gets the value for strUsername
				 * @return string
				 */
				return $this->strUsername;

			case 'Firstname':
				/**
				 * Gets the value for strFirstname (Not Null)
				 * @return string
				 */
				return $this->strFirstname;

			case 'Lastname':
				/**
				 * Gets the value for strLastname (Not Null)
				 * @return string
				 */
				return $this->strLastname;

			case 'Email':
				/**
				 * Gets the value for strEmail (Not Null)
				 * @return string
				 */
				return $this->strEmail;

			case 'Active':
				/**
				 * Gets the value for intActive (Not Null)
				 * @return integer
				 */
				return $this->intActive;

			case 'Onyen':
				/**
				 * Gets the value for strOnyen
				 * @return string
				 */
				return $this->strOnyen;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_TypeUserAccessAsAcl':
				/**
				 * Gets the value for the private _objTypeUserAccessAsAcl (Read-Only)
				 * if set due to an expansion on the acl_user_assn association table
				 * @return TypeUserAccess
				 */
				return $this->_objTypeUserAccessAsAcl;

			case '_TypeUserAccessAsAclArray':
				/**
				 * Gets the value for the private _objTypeUserAccessAsAclArray (Read-Only)
				 * if set due to an ExpandAsArray on the acl_user_assn association table
				 * @return TypeUserAccess[]
				 */
				return (array) $this->_objTypeUserAccessAsAclArray;

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
			case 'Username':
				/**
				 * Sets the value for strUsername
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strUsername = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Firstname':
				/**
				 * Sets the value for strFirstname (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strFirstname = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Lastname':
				/**
				 * Sets the value for strLastname (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strLastname = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Email':
				/**
				 * Sets the value for strEmail (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strEmail = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Active':
				/**
				 * Sets the value for intActive (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intActive = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Onyen':
				/**
				 * Sets the value for strOnyen
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strOnyen = QType::Cast($mixValue, QType::String));
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


	// Related Many-to-Many Objects' Methods for TypeUserAccessAsAcl
	//-------------------------------------------------------------------

	/**
	 * Gets all many-to-many associated TypeUserAccessesAsAcl as an array of TypeUserAccess objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return TypeUserAccess[]
		*/
	public function GetTypeUserAccessAsAclArray($objOptionalClauses = null) {
		if ((is_null($this->intUserid)))
			return array();

		try {
			return TypeUserAccess::LoadArrayByUserAsAcl($this->intUserid, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all many-to-many associated TypeUserAccessesAsAcl
	 * @return int
		*/
	public function CountTypeUserAccessesAsAcl() {
		if ((is_null($this->intUserid)))
			return 0;

		return TypeUserAccess::CountByUserAsAcl($this->intUserid);
	}

	/**
	 * Checks to see if an association exists with a specific TypeUserAccessAsAcl
	 * @param TypeUserAccess $objTypeUserAccess
	 * @return bool
		*/
	public function IsTypeUserAccessAsAclAssociated(TypeUserAccess $objTypeUserAccess) {
		if ((is_null($this->intUserid)))
			throw new QUndefinedPrimaryKeyException('Unable to call IsTypeUserAccessAsAclAssociated on this unsaved User.');
		if ((is_null($objTypeUserAccess->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call IsTypeUserAccessAsAclAssociated on this User with an unsaved TypeUserAccess.');

		$intRowCount = User::QueryCount(
				QQ::AndCondition(
						QQ::Equal(QQN::User()->Userid, $this->intUserid),
						QQ::Equal(QQN::User()->TypeUserAccessAsAcl->UserTypeId, $objTypeUserAccess->Id)
				)
		);

		return ($intRowCount > 0);
	}

	/**
	 * Associates a TypeUserAccessAsAcl
	 * @param TypeUserAccess $objTypeUserAccess
	 * @return void
		*/
	public function AssociateTypeUserAccessAsAcl(TypeUserAccess $objTypeUserAccess) {
		if ((is_null($this->intUserid)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateTypeUserAccessAsAcl on this unsaved User.');
		if ((is_null($objTypeUserAccess->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateTypeUserAccessAsAcl on this User with an unsaved TypeUserAccess.');

		// Get the Database Object for this Class
		$objDatabase = User::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				INSERT INTO '.QQNodeUserTypeUserAccessAsAcl::$strPubTableName.' (
				user_id,
				user_type_id
		) VALUES (
				' . $objDatabase->SqlVariable($this->intUserid) . ',
				' . $objDatabase->SqlVariable($objTypeUserAccess->Id) . '
		)
				');
	}

	/**
	 * Unassociates a TypeUserAccessAsAcl
	 * @param TypeUserAccess $objTypeUserAccess
	 * @return void
		*/
	public function UnassociateTypeUserAccessAsAcl(TypeUserAccess $objTypeUserAccess) {
		if ((is_null($this->intUserid)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateTypeUserAccessAsAcl on this unsaved User.');
		if ((is_null($objTypeUserAccess->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateTypeUserAccessAsAcl on this User with an unsaved TypeUserAccess.');

		// Get the Database Object for this Class
		$objDatabase = User::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeUserTypeUserAccessAsAcl::$strPubTableName.'
				WHERE
				user_id = ' . $objDatabase->SqlVariable($this->intUserid) . ' AND
				user_type_id = ' . $objDatabase->SqlVariable($objTypeUserAccess->Id) . '
				');
	}

	/**
	 * Unassociates all TypeUserAccessesAsAcl
	 * @return void
		*/
	public function UnassociateAllTypeUserAccessesAsAcl() {
		if ((is_null($this->intUserid)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAllTypeUserAccessAsAclArray on this unsaved User.');

		// Get the Database Object for this Class
		$objDatabase = User::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeUserTypeUserAccessAsAcl::$strPubTableName.'
				WHERE
				user_id = ' . $objDatabase->SqlVariable($this->intUserid) . '
				');
	}



	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column user.userid
	 * @var integer intUserid
	 */
	protected $intUserid;
	const UseridDefault = null;


	/**
	 * Protected member variable that maps to the database column user.username
	 * @var string strUsername
	 */
	protected $strUsername;
	const UsernameMaxLength = 50;
	const UsernameDefault = null;


	/**
	 * Protected member variable that maps to the database column user.firstname
	 * @var string strFirstname
	 */
	protected $strFirstname;
	const FirstnameMaxLength = 50;
	const FirstnameDefault = null;


	/**
	 * Protected member variable that maps to the database column user.lastname
	 * @var string strLastname
	 */
	protected $strLastname;
	const LastnameMaxLength = 50;
	const LastnameDefault = null;


	/**
	 * Protected member variable that maps to the database column user.email
	 * @var string strEmail
	 */
	protected $strEmail;
	const EmailMaxLength = 100;
	const EmailDefault = null;


	/**
	 * Protected member variable that maps to the database column user.active
	 * @var integer intActive
	 */
	protected $intActive;
	const ActiveDefault = null;


	/**
	 * Protected member variable that maps to the database column user.onyen
	 * @var string strOnyen
	 */
	protected $strOnyen;
	const OnyenMaxLength = 90;
	const OnyenDefault = null;


	/**
	 * Private member variable that stores a reference to a single TypeUserAccessAsAcl object
	 * (of type TypeUserAccess), if this User object was restored with
	 * an expansion on the acl_user_assn association table.
	 * @var TypeUserAccess _objTypeUserAccessAsAcl;
	 */
	private $_objTypeUserAccessAsAcl;

	/**
	 * Private member variable that stores a reference to an array of TypeUserAccessAsAcl objects
	 * (of type TypeUserAccess[]), if this User object was restored with
	 * an ExpandAsArray on the acl_user_assn association table.
	 * @var TypeUserAccess[] _objTypeUserAccessAsAclArray;
	 */
	private $_objTypeUserAccessAsAclArray = array();

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
		$strToReturn = '<complexType name="User"><sequence>';
		$strToReturn .= '<element name="Userid" type="xsd:int"/>';
		$strToReturn .= '<element name="Username" type="xsd:string"/>';
		$strToReturn .= '<element name="Firstname" type="xsd:string"/>';
		$strToReturn .= '<element name="Lastname" type="xsd:string"/>';
		$strToReturn .= '<element name="Email" type="xsd:string"/>';
		$strToReturn .= '<element name="Active" type="xsd:int"/>';
		$strToReturn .= '<element name="Onyen" type="xsd:string"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('User', $strComplexTypeArray)) {
			$strComplexTypeArray['User'] = User::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, User::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new User();
		if (property_exists($objSoapObject, 'Userid'))
			$objToReturn->intUserid = $objSoapObject->Userid;
		if (property_exists($objSoapObject, 'Username'))
			$objToReturn->strUsername = $objSoapObject->Username;
		if (property_exists($objSoapObject, 'Firstname'))
			$objToReturn->strFirstname = $objSoapObject->Firstname;
		if (property_exists($objSoapObject, 'Lastname'))
			$objToReturn->strLastname = $objSoapObject->Lastname;
		if (property_exists($objSoapObject, 'Email'))
			$objToReturn->strEmail = $objSoapObject->Email;
		if (property_exists($objSoapObject, 'Active'))
			$objToReturn->intActive = $objSoapObject->Active;
		if (property_exists($objSoapObject, 'Onyen'))
			$objToReturn->strOnyen = $objSoapObject->Onyen;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, User::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeUserTypeUserAccessAsAcl extends QQAssociationNode {
	protected $strType = 'association';
	protected $strName = 'typeuseraccessasacl';

	protected $strTableName = 'pt__acl_user_assn'; public static $strPubTableName = 'pt__acl_user_assn';
	protected $strPrimaryKey = 'user_id';
	protected $strClassName = 'TypeUserAccess';

	public function __get($strName) {
		switch ($strName) {
			case 'UserTypeId':
				return new QQNode('user_type_id', 'integer', $this);
			case 'TypeUserAccess':
				return new QQNodeTypeUserAccess('user_type_id', 'integer', $this);
			case '_ChildTableNode':
				return new QQNodeTypeUserAccess('user_type_id', 'integer', $this);
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

class QQNodeUser extends QQNode {
	protected $strTableName = 'pt__user'; public static $strPubTableName = 'pt__user';
	protected $strPrimaryKey = 'userid';
	protected $strClassName = 'User';
	public function __get($strName) {
		switch ($strName) {
			case 'Userid':
				return new QQNode('userid', 'integer', $this);
			case 'Username':
				return new QQNode('username', 'string', $this);
			case 'Firstname':
				return new QQNode('firstname', 'string', $this);
			case 'Lastname':
				return new QQNode('lastname', 'string', $this);
			case 'Email':
				return new QQNode('email', 'string', $this);
			case 'Active':
				return new QQNode('active', 'integer', $this);
			case 'Onyen':
				return new QQNode('onyen', 'string', $this);
			case 'TypeUserAccessAsAcl':
				return new QQNodeUserTypeUserAccessAsAcl($this);

			case '_PrimaryKeyNode':
				return new QQNode('userid', 'integer', $this);
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

class QQReverseReferenceNodeUser extends QQReverseReferenceNode {
	protected $strTableName = 'pt__user'; public static $strPubTableName = 'pt__user';
	protected $strPrimaryKey = 'userid';
	protected $strClassName = 'User';
	public function __get($strName) {
		switch ($strName) {
			case 'Userid':
				return new QQNode('userid', 'integer', $this);
			case 'Username':
				return new QQNode('username', 'string', $this);
			case 'Firstname':
				return new QQNode('firstname', 'string', $this);
			case 'Lastname':
				return new QQNode('lastname', 'string', $this);
			case 'Email':
				return new QQNode('email', 'string', $this);
			case 'Active':
				return new QQNode('active', 'integer', $this);
			case 'Onyen':
				return new QQNode('onyen', 'string', $this);
			case 'TypeUserAccessAsAcl':
				return new QQNodeUserTypeUserAccessAsAcl($this);

			case '_PrimaryKeyNode':
				return new QQNode('userid', 'integer', $this);
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