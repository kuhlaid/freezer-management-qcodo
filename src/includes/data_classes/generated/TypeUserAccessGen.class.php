<?php
/**
 * The abstract TypeUserAccessGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the TypeUserAccess subclass which
 * extends this TypeUserAccessGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the TypeUserAccess class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class TypeUserAccessGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a TypeUserAccess from PK Info
	 * @param integer $intId
	 * @return TypeUserAccess
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return TypeUserAccess::QuerySingle(
				QQ::Equal(QQN::TypeUserAccess()->Id, $intId)
		);
	}

	/**
	 * Load all TypeUserAccesses
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return TypeUserAccess[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call TypeUserAccess::QueryArray to perform the LoadAll query
		try {
			return TypeUserAccess::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all TypeUserAccesses
	 * @return int
	 */
	public static function CountAll() {
		// Call TypeUserAccess::QueryCount to perform the CountAll query
		return TypeUserAccess::QueryCount(QQ::All());
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
		$objDatabase = TypeUserAccess::GetDatabase();

		// Create/Build out the QueryBuilder object with TypeUserAccess-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'pt__type_user_access');
		TypeUserAccess::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('pt__type_user_access AS pt__type_user_access');

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
	 * Static Qcodo Query method to query for a single TypeUserAccess object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return TypeUserAccess the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = TypeUserAccess::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new TypeUserAccess object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return TypeUserAccess::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of TypeUserAccess objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return TypeUserAccess[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = TypeUserAccess::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return TypeUserAccess::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of TypeUserAccess objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = TypeUserAccess::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = TypeUserAccess::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'type_user_access_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with TypeUserAccess-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	TypeUserAccess::GetSelectFields($objQueryBuilder);
	TypeUserAccess::GetFromFields($objQueryBuilder);

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
	return TypeUserAccess::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this TypeUserAccess
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'pt__type_user_access';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.name AS ' . $strAliasPrefix . 'name');
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
	 * Instantiate a TypeUserAccess from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this TypeUserAccess::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return TypeUserAccess
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
				$strAliasPrefix = 'type_user_access__';

			if ((array_key_exists($strAliasPrefix . 'userasacl__user_id__userid', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'userasacl__user_id__userid')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objUserAsAclArray)) {
					$objPreviousChildItem = $objPreviousItem->_objUserAsAclArray[$intPreviousChildItemCount - 1];
					$objChildItem = User::InstantiateDbRow($objDbRow, $strAliasPrefix . 'userasacl__user_id__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objUserAsAclArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objUserAsAclArray, User::InstantiateDbRow($objDbRow, $strAliasPrefix . 'userasacl__user_id__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}


			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'type_user_access__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the TypeUserAccess object
		$objToReturn = new TypeUserAccess();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
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
			$strAliasPrefix = 'type_user_access__';



		// Check for UserAsAcl Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'userasacl__user_id__userid'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'userasacl__user_id__userid', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objUserAsAclArray, User::InstantiateDbRow($objDbRow, $strAliasPrefix . 'userasacl__user_id__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objUserAsAcl = User::InstantiateDbRow($objDbRow, $strAliasPrefix . 'userasacl__user_id__', $strExpandAsArrayNodes);
		}


		return $objToReturn;
	}

	/**
	 * Instantiate an array of TypeUserAccesses from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return TypeUserAccess[]
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
				$objItem = TypeUserAccess::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, TypeUserAccess::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single TypeUserAccess object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return TypeUserAccess
	 */
	public static function LoadById($intId) {
		return TypeUserAccess::QuerySingle(
				QQ::Equal(QQN::TypeUserAccess()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////
	/**
	* Load an array of User objects for a given UserAsAcl
	* via the acl_user_assn table
	* @param integer $intUserId
	* @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	* @return TypeUserAccess[]
	*/
	public static function LoadArrayByUserAsAcl($intUserId, $objOptionalClauses = null) {
		// Call TypeUserAccess::QueryArray to perform the LoadArrayByUserAsAcl query
		try {
			return TypeUserAccess::QueryArray(
					QQ::Equal(QQN::TypeUserAccess()->UserAsAcl->UserId, $intUserId),
					$objOptionalClauses
			);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count TypeUserAccesses for a given UserAsAcl
	 * via the acl_user_assn table
	 * @param integer $intUserId
	 * @return int
		*/
	public static function CountByUserAsAcl($intUserId) {
		return TypeUserAccess::QueryCount(
				QQ::Equal(QQN::TypeUserAccess()->UserAsAcl->UserId, $intUserId)
		);
	}



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this TypeUserAccess
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = TypeUserAccess::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeTypeUserAccess::$strPubTableName.' (
						name,
						description
				) VALUES (
						' . $objDatabase->SqlVariable($this->strName) . ',
						' . $objDatabase->SqlVariable($this->strDescription) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeTypeUserAccess::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeTypeUserAccess::$strPubTableName.'
						SET
						name = ' . $objDatabase->SqlVariable($this->strName) . ',
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
	 * Delete this TypeUserAccess
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this TypeUserAccess with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = TypeUserAccess::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeTypeUserAccess::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all TypeUserAccesses
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = TypeUserAccess::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeTypeUserAccess::$strPubTableName.'');
	}

	/**
	 * Truncate type_user_access table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = TypeUserAccess::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeTypeUserAccess::$strPubTableName.'');
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

			case '_UserAsAcl':
				/**
				 * Gets the value for the private _objUserAsAcl (Read-Only)
				 * if set due to an expansion on the acl_user_assn association table
				 * @return User
				 */
				return $this->_objUserAsAcl;

			case '_UserAsAclArray':
				/**
				 * Gets the value for the private _objUserAsAclArray (Read-Only)
				 * if set due to an ExpandAsArray on the acl_user_assn association table
				 * @return User[]
				 */
				return (array) $this->_objUserAsAclArray;

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


	// Related Many-to-Many Objects' Methods for UserAsAcl
	//-------------------------------------------------------------------

	/**
	 * Gets all many-to-many associated UsersAsAcl as an array of User objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return User[]
		*/
	public function GetUserAsAclArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return User::LoadArrayByTypeUserAccessAsAcl($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all many-to-many associated UsersAsAcl
	 * @return int
		*/
	public function CountUsersAsAcl() {
		if ((is_null($this->intId)))
			return 0;

		return User::CountByTypeUserAccessAsAcl($this->intId);
	}

	/**
	 * Checks to see if an association exists with a specific UserAsAcl
	 * @param User $objUser
	 * @return bool
		*/
	public function IsUserAsAclAssociated(User $objUser) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call IsUserAsAclAssociated on this unsaved TypeUserAccess.');
		if ((is_null($objUser->Userid)))
			throw new QUndefinedPrimaryKeyException('Unable to call IsUserAsAclAssociated on this TypeUserAccess with an unsaved User.');

		$intRowCount = TypeUserAccess::QueryCount(
				QQ::AndCondition(
						QQ::Equal(QQN::TypeUserAccess()->Id, $this->intId),
						QQ::Equal(QQN::TypeUserAccess()->UserAsAcl->UserId, $objUser->Userid)
				)
		);

		return ($intRowCount > 0);
	}

	/**
	 * Associates a UserAsAcl
	 * @param User $objUser
	 * @return void
		*/
	public function AssociateUserAsAcl(User $objUser) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateUserAsAcl on this unsaved TypeUserAccess.');
		if ((is_null($objUser->Userid)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateUserAsAcl on this TypeUserAccess with an unsaved User.');

		// Get the Database Object for this Class
		$objDatabase = TypeUserAccess::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				INSERT INTO '.QQNodeTypeUserAccessUserAsAcl::$strPubTableName.' (
				user_type_id,
				user_id
		) VALUES (
				' . $objDatabase->SqlVariable($this->intId) . ',
				' . $objDatabase->SqlVariable($objUser->Userid) . '
		)
				');
	}

	/**
	 * Unassociates a UserAsAcl
	 * @param User $objUser
	 * @return void
		*/
	public function UnassociateUserAsAcl(User $objUser) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateUserAsAcl on this unsaved TypeUserAccess.');
		if ((is_null($objUser->Userid)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateUserAsAcl on this TypeUserAccess with an unsaved User.');

		// Get the Database Object for this Class
		$objDatabase = TypeUserAccess::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeTypeUserAccessUserAsAcl::$strPubTableName.'
				WHERE
				user_type_id = ' . $objDatabase->SqlVariable($this->intId) . ' AND
				user_id = ' . $objDatabase->SqlVariable($objUser->Userid) . '
				');
	}

	/**
	 * Unassociates all UsersAsAcl
	 * @return void
		*/
	public function UnassociateAllUsersAsAcl() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAllUserAsAclArray on this unsaved TypeUserAccess.');

		// Get the Database Object for this Class
		$objDatabase = TypeUserAccess::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeTypeUserAccessUserAsAcl::$strPubTableName.'
				WHERE
				user_type_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}



	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column type_user_access.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column type_user_access.name
	 * @var string strName
	 */
	protected $strName;
	const NameMaxLength = 45;
	const NameDefault = null;


	/**
	 * Protected member variable that maps to the database column type_user_access.description
	 * @var string strDescription
	 */
	protected $strDescription;
	const DescriptionMaxLength = 245;
	const DescriptionDefault = null;


	/**
	 * Private member variable that stores a reference to a single UserAsAcl object
	 * (of type User), if this TypeUserAccess object was restored with
	 * an expansion on the acl_user_assn association table.
	 * @var User _objUserAsAcl;
	 */
	private $_objUserAsAcl;

	/**
	 * Private member variable that stores a reference to an array of UserAsAcl objects
	 * (of type User[]), if this TypeUserAccess object was restored with
	 * an ExpandAsArray on the acl_user_assn association table.
	 * @var User[] _objUserAsAclArray;
	 */
	private $_objUserAsAclArray = array();

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
		$strToReturn = '<complexType name="TypeUserAccess"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Name" type="xsd:string"/>';
		$strToReturn .= '<element name="Description" type="xsd:string"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('TypeUserAccess', $strComplexTypeArray)) {
			$strComplexTypeArray['TypeUserAccess'] = TypeUserAccess::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, TypeUserAccess::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new TypeUserAccess();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Name'))
			$objToReturn->strName = $objSoapObject->Name;
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
			array_push($objArrayToReturn, TypeUserAccess::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeTypeUserAccessUserAsAcl extends QQAssociationNode {
	protected $strType = 'association';
	protected $strName = 'userasacl';

	protected $strTableName = 'pt__acl_user_assn'; public static $strPubTableName = 'pt__acl_user_assn';
	protected $strPrimaryKey = 'user_type_id';
	protected $strClassName = 'User';

	public function __get($strName) {
		switch ($strName) {
			case 'UserId':
				return new QQNode('user_id', 'integer', $this);
			case 'User':
				return new QQNodeUser('user_id', 'integer', $this);
			case '_ChildTableNode':
				return new QQNodeUser('user_id', 'integer', $this);
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

class QQNodeTypeUserAccess extends QQNode {
	protected $strTableName = 'pt__type_user_access'; public static $strPubTableName = 'pt__type_user_access';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'TypeUserAccess';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'UserAsAcl':
				return new QQNodeTypeUserAccessUserAsAcl($this);

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

class QQReverseReferenceNodeTypeUserAccess extends QQReverseReferenceNode {
	protected $strTableName = 'pt__type_user_access'; public static $strPubTableName = 'pt__type_user_access';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'TypeUserAccess';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'UserAsAcl':
				return new QQNodeTypeUserAccessUserAsAcl($this);

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