<?php
/**
 * The abstract SamplesGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Samples subclass which
 * extends this SamplesGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Samples class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class SamplesGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a Samples from PK Info
	 * @param integer $intId
	 * @return Samples
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return Samples::QuerySingle(
				QQ::Equal(QQN::Samples()->Id, $intId)
		);
	}

	/**
	 * Load all Sampleses
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Samples[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call Samples::QueryArray to perform the LoadAll query
		try {
			return Samples::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all Sampleses
	 * @return int
	 */
	public static function CountAll() {
		// Call Samples::QueryCount to perform the CountAll query
		return Samples::QueryCount(QQ::All());
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
	protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
		// Get the Database Object for this Class
		$objDatabase = Samples::GetDatabase();

		// Create/Build out the QueryBuilder object with Samples-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__samples');
		Samples::GetSelectFields($objQueryBuilder);
		$objQueryBuilder->AddFromItem('fm__`samples` AS fm__`samples`');

		// Set "CountOnly" option (if applicable)
		if ($blnCountOnly)
			$objQueryBuilder->SetCountOnlyFlag();

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
	 * Static Qcodo Query method to query for a single Samples object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Samples the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Samples::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new Samples object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Samples::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of Samples objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Samples[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Samples::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Samples::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of Samples objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Samples::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
	$objDatabase = Samples::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'samples_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Samples-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	Samples::GetSelectFields($objQueryBuilder);
	Samples::GetFromFields($objQueryBuilder);

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
	return Samples::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this Samples
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
		if ($strPrefix) {
			$strTableName = 'fm__`' . $strPrefix . '`';
			$strAliasPrefix = '`' . $strPrefix . '__';
		} else {
			$strTableName = 'fm__`samples`';
			$strAliasPrefix = '`';
		}

		$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
		$objBuilder->AddSelectItem($strTableName . '.`caseid` AS ' . $strAliasPrefix . 'caseid`');
		$objBuilder->AddSelectItem($strTableName . '.`samplenum` AS ' . $strAliasPrefix . 'samplenum`');
		$objBuilder->AddSelectItem($strTableName . '.`samploc` AS ' . $strAliasPrefix . 'samploc`');
		$objBuilder->AddSelectItem($strTableName . '.`samptype` AS ' . $strAliasPrefix . 'samptype`');
		$objBuilder->AddSelectItem($strTableName . '.`boxid` AS ' . $strAliasPrefix . 'boxid`');
		$objBuilder->AddSelectItem($strTableName . '.`username` AS ' . $strAliasPrefix . 'username`');
		$objBuilder->AddSelectItem($strTableName . '.`thawed` AS ' . $strAliasPrefix . 'thawed`');
		$objBuilder->AddSelectItem($strTableName . '.`onmanifest` AS ' . $strAliasPrefix . 'onmanifest`');
		$objBuilder->AddSelectItem($strTableName . '.`loggedout` AS ' . $strAliasPrefix . 'loggedout`');
		$objBuilder->AddSelectItem($strTableName . '.`toenaildate` AS ' . $strAliasPrefix . 'toenaildate`');
		$objBuilder->AddSelectItem($strTableName . '.`toenailshipped` AS ' . $strAliasPrefix . 'toenailshipped`');
		$objBuilder->AddSelectItem($strTableName . '.`chlclin` AS ' . $strAliasPrefix . 'chlclin`');
		$objBuilder->AddSelectItem($strTableName . '.`chllabcorp` AS ' . $strAliasPrefix . 'chllabcorp`');
		$objBuilder->AddSelectItem($strTableName . '.`bscbook` AS ' . $strAliasPrefix . 'bscbook`');
		$objBuilder->AddSelectItem($strTableName . '.`bscpage` AS ' . $strAliasPrefix . 'bscpage`');
	}



	///////////////////////////////
	// INSTANTIATION-RELATED METHODS
	///////////////////////////////

	/**
	 * Instantiate a Samples from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this Samples::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return Samples
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;


		// Create a new instance of the Samples object
		$objToReturn = new Samples();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strCaseid = $objDbRow->GetColumn($strAliasPrefix . 'caseid', 'VarChar');
		$objToReturn->strSamplenum = $objDbRow->GetColumn($strAliasPrefix . 'samplenum', 'VarChar');
		$objToReturn->strSamploc = $objDbRow->GetColumn($strAliasPrefix . 'samploc', 'VarChar');
		$objToReturn->strSamptype = $objDbRow->GetColumn($strAliasPrefix . 'samptype', 'VarChar');
		$objToReturn->intBoxid = $objDbRow->GetColumn($strAliasPrefix . 'boxid', 'Integer');
		$objToReturn->strUsername = $objDbRow->GetColumn($strAliasPrefix . 'username', 'VarChar');
		$objToReturn->intThawed = $objDbRow->GetColumn($strAliasPrefix . 'thawed', 'Integer');
		$objToReturn->intOnmanifest = $objDbRow->GetColumn($strAliasPrefix . 'onmanifest', 'Integer');
		$objToReturn->intLoggedout = $objDbRow->GetColumn($strAliasPrefix . 'loggedout', 'Integer');
		$objToReturn->dttToenaildate = $objDbRow->GetColumn($strAliasPrefix . 'toenaildate', 'Date');
		$objToReturn->intToenailshipped = $objDbRow->GetColumn($strAliasPrefix . 'toenailshipped', 'Integer');
		$objToReturn->dttChlclin = $objDbRow->GetColumn($strAliasPrefix . 'chlclin', 'Date');
		$objToReturn->dttChllabcorp = $objDbRow->GetColumn($strAliasPrefix . 'chllabcorp', 'Date');
		$objToReturn->strBscbook = $objDbRow->GetColumn($strAliasPrefix . 'bscbook', 'VarChar');
		$objToReturn->strBscpage = $objDbRow->GetColumn($strAliasPrefix . 'bscpage', 'VarChar');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'samples__';




		return $objToReturn;
	}

	/**
	 * Instantiate an array of Sampleses from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return Samples[]
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
				$objItem = Samples::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, Samples::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single Samples object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return Samples
	 */
	public static function LoadById($intId) {
		return Samples::QuerySingle(
				QQ::Equal(QQN::Samples()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this Samples
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = Samples::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO `'.QQNodeSamples::$strPubTableName.'` (
						`caseid`,
						`samplenum`,
						`samploc`,
						`samptype`,
						`boxid`,
						`username`,
						`thawed`,
						`onmanifest`,
						`loggedout`,
						`toenaildate`,
						`toenailshipped`,
						`chlclin`,
						`chllabcorp`,
						`bscbook`,
						`bscpage`
				) VALUES (
						' . $objDatabase->SqlVariable($this->strCaseid) . ',
						' . $objDatabase->SqlVariable($this->strSamplenum) . ',
						' . $objDatabase->SqlVariable($this->strSamploc) . ',
						' . $objDatabase->SqlVariable($this->strSamptype) . ',
						' . $objDatabase->SqlVariable($this->intBoxid) . ',
						' . $objDatabase->SqlVariable($this->strUsername) . ',
						' . $objDatabase->SqlVariable($this->intThawed) . ',
						' . $objDatabase->SqlVariable($this->intOnmanifest) . ',
						' . $objDatabase->SqlVariable($this->intLoggedout) . ',
						' . $objDatabase->SqlVariable($this->dttToenaildate) . ',
						' . $objDatabase->SqlVariable($this->intToenailshipped) . ',
								' . $objDatabase->SqlVariable($this->dttChlclin) . ',
										' . $objDatabase->SqlVariable($this->dttChllabcorp) . ',
												' . $objDatabase->SqlVariable($this->strBscbook) . ',
														' . $objDatabase->SqlVariable($this->strBscpage) . '
																)
																');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeSamples::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						`'.QQNodeSamples::$strPubTableName.'`
						SET
						`caseid` = ' . $objDatabase->SqlVariable($this->strCaseid) . ',
						`samplenum` = ' . $objDatabase->SqlVariable($this->strSamplenum) . ',
						`samploc` = ' . $objDatabase->SqlVariable($this->strSamploc) . ',
						`samptype` = ' . $objDatabase->SqlVariable($this->strSamptype) . ',
						`boxid` = ' . $objDatabase->SqlVariable($this->intBoxid) . ',
						`username` = ' . $objDatabase->SqlVariable($this->strUsername) . ',
						`thawed` = ' . $objDatabase->SqlVariable($this->intThawed) . ',
						`onmanifest` = ' . $objDatabase->SqlVariable($this->intOnmanifest) . ',
						`loggedout` = ' . $objDatabase->SqlVariable($this->intLoggedout) . ',
						`toenaildate` = ' . $objDatabase->SqlVariable($this->dttToenaildate) . ',
						`toenailshipped` = ' . $objDatabase->SqlVariable($this->intToenailshipped) . ',
								`chlclin` = ' . $objDatabase->SqlVariable($this->dttChlclin) . ',
										`chllabcorp` = ' . $objDatabase->SqlVariable($this->dttChllabcorp) . ',
												`bscbook` = ' . $objDatabase->SqlVariable($this->strBscbook) . ',
														`bscpage` = ' . $objDatabase->SqlVariable($this->strBscpage) . '
																WHERE
																`id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
	 * Delete this Samples
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this Samples with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = Samples::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				`'.QQNodeSamples::$strPubTableName.'`
				WHERE
				`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all Sampleses
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = Samples::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				`'.QQNodeSamples::$strPubTableName.'`');
	}

	/**
	 * Truncate samples table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = Samples::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE `'.QQNodeSamples::$strPubTableName.'`');
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

			case 'Caseid':
				/**
				 * Gets the value for strCaseid (Not Null)
				 * @return string
				 */
				return $this->strCaseid;

			case 'Samplenum':
				/**
				 * Gets the value for strSamplenum (Not Null)
				 * @return string
				 */
				return $this->strSamplenum;

			case 'Samploc':
				/**
				 * Gets the value for strSamploc (Not Null)
				 * @return string
				 */
				return $this->strSamploc;

			case 'Samptype':
				/**
				 * Gets the value for strSamptype (Not Null)
				 * @return string
				 */
				return $this->strSamptype;

			case 'Boxid':
				/**
				 * Gets the value for intBoxid (Not Null)
				 * @return integer
				 */
				return $this->intBoxid;

			case 'Username':
				/**
				 * Gets the value for strUsername (Not Null)
				 * @return string
				 */
				return $this->strUsername;

			case 'Thawed':
				/**
				 * Gets the value for intThawed (Not Null)
				 * @return integer
				 */
				return $this->intThawed;

			case 'Onmanifest':
				/**
				 * Gets the value for intOnmanifest (Not Null)
				 * @return integer
				 */
				return $this->intOnmanifest;

			case 'Loggedout':
				/**
				 * Gets the value for intLoggedout (Not Null)
				 * @return integer
				 */
				return $this->intLoggedout;

			case 'Toenaildate':
				/**
				 * Gets the value for dttToenaildate
				 * @return QDateTime
				 */
				return $this->dttToenaildate;

			case 'Toenailshipped':
				/**
				 * Gets the value for intToenailshipped (Not Null)
				 * @return integer
				 */
				return $this->intToenailshipped;

			case 'Chlclin':
				/**
				 * Gets the value for dttChlclin
				 * @return QDateTime
				 */
				return $this->dttChlclin;

			case 'Chllabcorp':
				/**
				 * Gets the value for dttChllabcorp
				 * @return QDateTime
				 */
				return $this->dttChllabcorp;

			case 'Bscbook':
				/**
				 * Gets the value for strBscbook
				 * @return string
				 */
				return $this->strBscbook;

			case 'Bscpage':
				/**
				 * Gets the value for strBscpage
				 * @return string
				 */
				return $this->strBscpage;


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

			case 'Samplenum':
				/**
				 * Sets the value for strSamplenum (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strSamplenum = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Samploc':
				/**
				 * Sets the value for strSamploc (Not Null)
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strSamploc = QType::Cast($mixValue, QType::String));
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

			case 'Boxid':
				/**
				 * Sets the value for intBoxid (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intBoxid = QType::Cast($mixValue, QType::Integer));
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

			case 'Thawed':
				/**
				 * Sets the value for intThawed (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intThawed = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Onmanifest':
				/**
				 * Sets the value for intOnmanifest (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intOnmanifest = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Loggedout':
				/**
				 * Sets the value for intLoggedout (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intLoggedout = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Toenaildate':
				/**
				 * Sets the value for dttToenaildate
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttToenaildate = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Toenailshipped':
				/**
				 * Sets the value for intToenailshipped (Not Null)
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intToenailshipped = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Chlclin':
				/**
				 * Sets the value for dttChlclin
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttChlclin = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Chllabcorp':
				/**
				 * Sets the value for dttChllabcorp
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttChllabcorp = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Bscbook':
				/**
				 * Sets the value for strBscbook
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strBscbook = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Bscpage':
				/**
				 * Sets the value for strBscpage
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strBscpage = QType::Cast($mixValue, QType::String));
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
	 * Protected member variable that maps to the database PK Identity column samples.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.caseid
	 * @var string strCaseid
	 */
	protected $strCaseid;
	const CaseidMaxLength = 5;
	const CaseidDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.samplenum
	 * @var string strSamplenum
	 */
	protected $strSamplenum;
	const SamplenumMaxLength = 3;
	const SamplenumDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.samploc
	 * @var string strSamploc
	 */
	protected $strSamploc;
	const SamplocMaxLength = 2;
	const SamplocDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.samptype
	 * @var string strSamptype
	 */
	protected $strSamptype;
	const SamptypeMaxLength = 25;
	const SamptypeDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.boxid
	 * @var integer intBoxid
	 */
	protected $intBoxid;
	const BoxidDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.username
	 * @var string strUsername
	 */
	protected $strUsername;
	const UsernameMaxLength = 30;
	const UsernameDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.thawed
	 * @var integer intThawed
	 */
	protected $intThawed;
	const ThawedDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.onmanifest
	 * @var integer intOnmanifest
	 */
	protected $intOnmanifest;
	const OnmanifestDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.loggedout
	 * @var integer intLoggedout
	 */
	protected $intLoggedout;
	const LoggedoutDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.toenaildate
	 * @var QDateTime dttToenaildate
	 */
	protected $dttToenaildate;
	const ToenaildateDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.toenailshipped
	 * @var integer intToenailshipped
	 */
	protected $intToenailshipped;
	const ToenailshippedDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.chlclin
	 * @var QDateTime dttChlclin
	 */
	protected $dttChlclin;
	const ChlclinDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.chllabcorp
	 * @var QDateTime dttChllabcorp
	 */
	protected $dttChllabcorp;
	const ChllabcorpDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.bscbook
	 * @var string strBscbook
	 */
	protected $strBscbook;
	const BscbookMaxLength = 1;
	const BscbookDefault = null;


	/**
	 * Protected member variable that maps to the database column samples.bscpage
	 * @var string strBscpage
	 */
	protected $strBscpage;
	const BscpageMaxLength = 3;
	const BscpageDefault = null;


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
		$strToReturn = '<complexType name="Samples"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Caseid" type="xsd:string"/>';
		$strToReturn .= '<element name="Samplenum" type="xsd:string"/>';
		$strToReturn .= '<element name="Samploc" type="xsd:string"/>';
		$strToReturn .= '<element name="Samptype" type="xsd:string"/>';
		$strToReturn .= '<element name="Boxid" type="xsd:int"/>';
		$strToReturn .= '<element name="Username" type="xsd:string"/>';
		$strToReturn .= '<element name="Thawed" type="xsd:int"/>';
		$strToReturn .= '<element name="Onmanifest" type="xsd:int"/>';
		$strToReturn .= '<element name="Loggedout" type="xsd:int"/>';
		$strToReturn .= '<element name="Toenaildate" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Toenailshipped" type="xsd:int"/>';
		$strToReturn .= '<element name="Chlclin" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Chllabcorp" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="Bscbook" type="xsd:string"/>';
		$strToReturn .= '<element name="Bscpage" type="xsd:string"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('Samples', $strComplexTypeArray)) {
			$strComplexTypeArray['Samples'] = Samples::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, Samples::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new Samples();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Caseid'))
			$objToReturn->strCaseid = $objSoapObject->Caseid;
		if (property_exists($objSoapObject, 'Samplenum'))
			$objToReturn->strSamplenum = $objSoapObject->Samplenum;
		if (property_exists($objSoapObject, 'Samploc'))
			$objToReturn->strSamploc = $objSoapObject->Samploc;
		if (property_exists($objSoapObject, 'Samptype'))
			$objToReturn->strSamptype = $objSoapObject->Samptype;
		if (property_exists($objSoapObject, 'Boxid'))
			$objToReturn->intBoxid = $objSoapObject->Boxid;
		if (property_exists($objSoapObject, 'Username'))
			$objToReturn->strUsername = $objSoapObject->Username;
		if (property_exists($objSoapObject, 'Thawed'))
			$objToReturn->intThawed = $objSoapObject->Thawed;
		if (property_exists($objSoapObject, 'Onmanifest'))
			$objToReturn->intOnmanifest = $objSoapObject->Onmanifest;
		if (property_exists($objSoapObject, 'Loggedout'))
			$objToReturn->intLoggedout = $objSoapObject->Loggedout;
		if (property_exists($objSoapObject, 'Toenaildate'))
			$objToReturn->dttToenaildate = new QDateTime($objSoapObject->Toenaildate);
		if (property_exists($objSoapObject, 'Toenailshipped'))
			$objToReturn->intToenailshipped = $objSoapObject->Toenailshipped;
		if (property_exists($objSoapObject, 'Chlclin'))
			$objToReturn->dttChlclin = new QDateTime($objSoapObject->Chlclin);
		if (property_exists($objSoapObject, 'Chllabcorp'))
			$objToReturn->dttChllabcorp = new QDateTime($objSoapObject->Chllabcorp);
		if (property_exists($objSoapObject, 'Bscbook'))
			$objToReturn->strBscbook = $objSoapObject->Bscbook;
		if (property_exists($objSoapObject, 'Bscpage'))
			$objToReturn->strBscpage = $objSoapObject->Bscpage;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, Samples::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn ?? '') ?? '');
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->dttToenaildate)
			$objObject->dttToenaildate = $objObject->dttToenaildate->toString(QDateTime::FormatSoap);
		if ($objObject->dttChlclin)
			$objObject->dttChlclin = $objObject->dttChlclin->toString(QDateTime::FormatSoap);
		if ($objObject->dttChllabcorp)
			$objObject->dttChllabcorp = $objObject->dttChllabcorp->toString(QDateTime::FormatSoap);
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeSamples extends QQNode {
	protected $strTableName = 'fm__samples'; public static $strPubTableName = 'fm__samples';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Samples';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Caseid':
				return new QQNode('caseid', 'string', $this);
			case 'Samplenum':
				return new QQNode('samplenum', 'string', $this);
			case 'Samploc':
				return new QQNode('samploc', 'string', $this);
			case 'Samptype':
				return new QQNode('samptype', 'string', $this);
			case 'Boxid':
				return new QQNode('boxid', 'integer', $this);
			case 'Username':
				return new QQNode('username', 'string', $this);
			case 'Thawed':
				return new QQNode('thawed', 'integer', $this);
			case 'Onmanifest':
				return new QQNode('onmanifest', 'integer', $this);
			case 'Loggedout':
				return new QQNode('loggedout', 'integer', $this);
			case 'Toenaildate':
				return new QQNode('toenaildate', 'QDateTime', $this);
			case 'Toenailshipped':
				return new QQNode('toenailshipped', 'integer', $this);
			case 'Chlclin':
				return new QQNode('chlclin', 'QDateTime', $this);
			case 'Chllabcorp':
				return new QQNode('chllabcorp', 'QDateTime', $this);
			case 'Bscbook':
				return new QQNode('bscbook', 'string', $this);
			case 'Bscpage':
				return new QQNode('bscpage', 'string', $this);

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

class QQReverseReferenceNodeSamples extends QQReverseReferenceNode {
	protected $strTableName = 'fm__samples'; public static $strPubTableName = 'fm__samples';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Samples';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Caseid':
				return new QQNode('caseid', 'string', $this);
			case 'Samplenum':
				return new QQNode('samplenum', 'string', $this);
			case 'Samploc':
				return new QQNode('samploc', 'string', $this);
			case 'Samptype':
				return new QQNode('samptype', 'string', $this);
			case 'Boxid':
				return new QQNode('boxid', 'integer', $this);
			case 'Username':
				return new QQNode('username', 'string', $this);
			case 'Thawed':
				return new QQNode('thawed', 'integer', $this);
			case 'Onmanifest':
				return new QQNode('onmanifest', 'integer', $this);
			case 'Loggedout':
				return new QQNode('loggedout', 'integer', $this);
			case 'Toenaildate':
				return new QQNode('toenaildate', 'QDateTime', $this);
			case 'Toenailshipped':
				return new QQNode('toenailshipped', 'integer', $this);
			case 'Chlclin':
				return new QQNode('chlclin', 'QDateTime', $this);
			case 'Chllabcorp':
				return new QQNode('chllabcorp', 'QDateTime', $this);
			case 'Bscbook':
				return new QQNode('bscbook', 'string', $this);
			case 'Bscpage':
				return new QQNode('bscpage', 'string', $this);

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