<?php
/**
 * The abstract SampleSelectionGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the SampleSelection subclass which
 * extends this SampleSelectionGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the SampleSelection class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class SampleSelectionGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a SampleSelection from PK Info
	 * @param integer $intId
	 * @return SampleSelection
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return SampleSelection::QuerySingle(
				QQ::Equal(QQN::SampleSelection()->Id, $intId)
		);
	}

	/**
	 * Load all SampleSelections
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return SampleSelection[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call SampleSelection::QueryArray to perform the LoadAll query
		try {
			return SampleSelection::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all SampleSelections
	 * @return int
	 */
	public static function CountAll() {
		// Call SampleSelection::QueryCount to perform the CountAll query
		return SampleSelection::QueryCount(QQ::All());
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
		$objDatabase = SampleSelection::GetDatabase();

		// Create/Build out the QueryBuilder object with SampleSelection-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__sample_selection');
		SampleSelection::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__sample_selection AS fm__sample_selection');

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
	 * Static Qcodo Query method to query for a single SampleSelection object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return SampleSelection the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleSelection::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new SampleSelection object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return SampleSelection::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of SampleSelection objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return SampleSelection[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleSelection::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return SampleSelection::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of SampleSelection objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = SampleSelection::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = SampleSelection::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'sample_selection_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with SampleSelection-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	SampleSelection::GetSelectFields($objQueryBuilder);
	SampleSelection::GetFromFields($objQueryBuilder);

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
	return SampleSelection::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this SampleSelection
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__sample_selection';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.participant_select AS ' . $strAliasPrefix . 'participant_select');
			$objBuilder->AddSelectItem($strTableName . '.sample_type AS ' . $strAliasPrefix . 'sample_type');
			$objBuilder->AddSelectItem($strTableName . '.study_select AS ' . $strAliasPrefix . 'study_select');
			$objBuilder->AddSelectItem($strTableName . '.sample_select AS ' . $strAliasPrefix . 'sample_select');
			$objBuilder->AddSelectItem($strTableName . '.description AS ' . $strAliasPrefix . 'description');
			$objBuilder->AddSelectItem($strTableName . '.`lock` AS ' . $strAliasPrefix . '`lock`');
			$objBuilder->AddSelectItem($strTableName . '.samples_transferred AS ' . $strAliasPrefix . 'samples_transferred');
			$objBuilder->AddSelectItem($strTableName . '.date_selected AS ' . $strAliasPrefix . 'date_selected');
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
	 * Instantiate a SampleSelection from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this SampleSelection::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return SampleSelection
		*/
	public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
		// If blank row, return null
		if (!$objDbRow)
			return null;


		// Create a new instance of the SampleSelection object
		$objToReturn = new SampleSelection();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strParticipantSelect = $objDbRow->GetColumn($strAliasPrefix . 'participant_select', 'VarChar');
		$objToReturn->intSampleType = $objDbRow->GetColumn($strAliasPrefix . 'sample_type', 'Integer');
		$objToReturn->strStudySelect = $objDbRow->GetColumn($strAliasPrefix . 'study_select', 'VarChar');
		$objToReturn->strSampleSelect = $objDbRow->GetColumn($strAliasPrefix . 'sample_select', 'Blob');
		$objToReturn->strDescription = $objDbRow->GetColumn($strAliasPrefix . 'description', 'VarChar');
		$objToReturn->blnLock = $objDbRow->GetColumn($strAliasPrefix . '`lock`', 'Bit');
		$objToReturn->blnSamplesTransferred = $objDbRow->GetColumn($strAliasPrefix . 'samples_transferred', 'Bit');
		$objToReturn->dttDateSelected = $objDbRow->GetColumn($strAliasPrefix . 'date_selected', 'Date');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'sample_selection__';




		return $objToReturn;
	}

	/**
	 * Instantiate an array of SampleSelections from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return SampleSelection[]
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
				$objItem = SampleSelection::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, SampleSelection::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////
		
	/**
	 * Load a single SampleSelection object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return SampleSelection
	*/
	public static function LoadById($intId) {
		return SampleSelection::QuerySingle(
				QQ::Equal(QQN::SampleSelection()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this SampleSelection
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = SampleSelection::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeSampleSelection::$strPubTableName.' (
						participant_select,
						sample_type,
						study_select,
						sample_select,
						description,
						`lock`,
						samples_transferred,
						date_selected
				) VALUES (
						' . $objDatabase->SqlVariable($this->strParticipantSelect) . ',
						' . $objDatabase->SqlVariable($this->intSampleType) . ',
						' . $objDatabase->SqlVariable($this->strStudySelect) . ',
						' . $objDatabase->SqlVariable($this->strSampleSelect) . ',
						' . $objDatabase->SqlVariable($this->strDescription) . ',
						' . $objDatabase->SqlVariable($this->blnLock) . ',
						' . $objDatabase->SqlVariable($this->blnSamplesTransferred) . ',
						' . $objDatabase->SqlVariable($this->dttDateSelected) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeSampleSelection::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeSampleSelection::$strPubTableName.'
						SET
						participant_select = ' . $objDatabase->SqlVariable($this->strParticipantSelect) . ',
						sample_type = ' . $objDatabase->SqlVariable($this->intSampleType) . ',
						study_select = ' . $objDatabase->SqlVariable($this->strStudySelect) . ',
						sample_select = ' . $objDatabase->SqlVariable($this->strSampleSelect) . ',
						description = ' . $objDatabase->SqlVariable($this->strDescription) . ',
						`lock` = ' . $objDatabase->SqlVariable($this->blnLock) . ',
						samples_transferred = ' . $objDatabase->SqlVariable($this->blnSamplesTransferred) . ',
						date_selected = ' . $objDatabase->SqlVariable($this->dttDateSelected) . '
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
	 * Delete this SampleSelection
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this SampleSelection with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = SampleSelection::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleSelection::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all SampleSelections
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = SampleSelection::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeSampleSelection::$strPubTableName.'');
	}

	/**
	 * Truncate sample_selection table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = SampleSelection::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeSampleSelection::$strPubTableName.'');
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

			case 'ParticipantSelect':
				/**
				 * Gets the value for strParticipantSelect
				 * @return string
				 */
				return $this->strParticipantSelect;

			case 'SampleType':
				/**
				 * Gets the value for intSampleType
				 * @return integer
				 */
				return $this->intSampleType;

			case 'StudySelect':
				/**
				 * Gets the value for strStudySelect
				 * @return string
				 */
				return $this->strStudySelect;

			case 'SampleSelect':
				/**
				 * Gets the value for strSampleSelect
				 * @return string
				 */
				return $this->strSampleSelect;

			case 'Description':
				/**
				 * Gets the value for strDescription
				 * @return string
				 */
				return $this->strDescription;

			case 'Lock':
				/**
				 * Gets the value for blnLock
				 * @return boolean
				 */
				return $this->blnLock;

			case 'SamplesTransferred':
				/**
				 * Gets the value for blnSamplesTransferred
				 * @return boolean
				 */
				return $this->blnSamplesTransferred;

			case 'DateSelected':
				/**
				 * Gets the value for dttDateSelected
				 * @return QDateTime
				 */
				return $this->dttDateSelected;


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
			case 'ParticipantSelect':
				/**
				 * Sets the value for strParticipantSelect
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strParticipantSelect = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'SampleType':
				/**
				 * Sets the value for intSampleType
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intSampleType = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'StudySelect':
				/**
				 * Sets the value for strStudySelect
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strStudySelect = QType::Cast($mixValue, QType::String));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'SampleSelect':
				/**
				 * Sets the value for strSampleSelect
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strSampleSelect = QType::Cast($mixValue, QType::String));
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

			case 'Lock':
				/**
				 * Sets the value for blnLock
				 * @param boolean $mixValue
				 * @return boolean
				 */
				try {
					return ($this->blnLock = QType::Cast($mixValue, QType::Boolean));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'SamplesTransferred':
				/**
				 * Sets the value for blnSamplesTransferred
				 * @param boolean $mixValue
				 * @return boolean
				 */
				try {
					return ($this->blnSamplesTransferred = QType::Cast($mixValue, QType::Boolean));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'DateSelected':
				/**
				 * Sets the value for dttDateSelected
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttDateSelected = QType::Cast($mixValue, QType::DateTime));
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
	 * Protected member variable that maps to the database PK Identity column sample_selection.id
	 * @var integer intId
	*/
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_selection.participant_select
	 * @var string strParticipantSelect
	 */
	protected $strParticipantSelect;
	const ParticipantSelectMaxLength = 4000;
	const ParticipantSelectDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_selection.sample_type
	 * @var integer intSampleType
	 */
	protected $intSampleType;
	const SampleTypeDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_selection.study_select
	 * @var string strStudySelect
	 */
	protected $strStudySelect;
	const StudySelectMaxLength = 250;
	const StudySelectDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_selection.sample_select
	 * @var string strSampleSelect
	 */
	protected $strSampleSelect;
	const SampleSelectDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_selection.description
	 * @var string strDescription
	 */
	protected $strDescription;
	const DescriptionMaxLength = 500;
	const DescriptionDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_selection.lock
	 * @var boolean blnLock
	 */
	protected $blnLock;
	const LockDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_selection.samples_transferred
	 * @var boolean blnSamplesTransferred
	 */
	protected $blnSamplesTransferred;
	const SamplesTransferredDefault = null;


	/**
	 * Protected member variable that maps to the database column sample_selection.date_selected
	 * @var QDateTime dttDateSelected
	 */
	protected $dttDateSelected;
	const DateSelectedDefault = null;


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
		$strToReturn = '<complexType name="SampleSelection"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="ParticipantSelect" type="xsd:string"/>';
		$strToReturn .= '<element name="SampleType" type="xsd:int"/>';
		$strToReturn .= '<element name="StudySelect" type="xsd:string"/>';
		$strToReturn .= '<element name="SampleSelect" type="xsd:string"/>';
		$strToReturn .= '<element name="Description" type="xsd:string"/>';
		$strToReturn .= '<element name="Lock" type="xsd:boolean"/>';
		$strToReturn .= '<element name="SamplesTransferred" type="xsd:boolean"/>';
		$strToReturn .= '<element name="DateSelected" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('SampleSelection', $strComplexTypeArray)) {
			$strComplexTypeArray['SampleSelection'] = SampleSelection::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, SampleSelection::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new SampleSelection();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'ParticipantSelect'))
			$objToReturn->strParticipantSelect = $objSoapObject->ParticipantSelect;
		if (property_exists($objSoapObject, 'SampleType'))
			$objToReturn->intSampleType = $objSoapObject->SampleType;
		if (property_exists($objSoapObject, 'StudySelect'))
			$objToReturn->strStudySelect = $objSoapObject->StudySelect;
		if (property_exists($objSoapObject, 'SampleSelect'))
			$objToReturn->strSampleSelect = $objSoapObject->SampleSelect;
		if (property_exists($objSoapObject, 'Description'))
			$objToReturn->strDescription = $objSoapObject->Description;
		if (property_exists($objSoapObject, 'Lock'))
			$objToReturn->blnLock = $objSoapObject->Lock;
		if (property_exists($objSoapObject, 'SamplesTransferred'))
			$objToReturn->blnSamplesTransferred = $objSoapObject->SamplesTransferred;
		if (property_exists($objSoapObject, 'DateSelected'))
			$objToReturn->dttDateSelected = new QDateTime($objSoapObject->DateSelected);
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, SampleSelection::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->dttDateSelected)
			$objObject->dttDateSelected = $objObject->dttDateSelected->toString(QDateTime::FormatSoap);
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeSampleSelection extends QQNode {
	protected $strTableName = 'fm__sample_selection'; public static $strPubTableName = 'fm__sample_selection';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'SampleSelection';
	protected $strDbSchema = '';	// wpg - added so we would have the database schema

	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'ParticipantSelect':
				return new QQNode('participant_select', 'string', $this);
			case 'SampleType':
				return new QQNode('sample_type', 'integer', $this);
			case 'StudySelect':
				return new QQNode('study_select', 'string', $this);
			case 'SampleSelect':
				return new QQNode('sample_select', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'Lock':
				return new QQNode('lock', 'boolean', $this);
			case 'SamplesTransferred':
				return new QQNode('samples_transferred', 'boolean', $this);
			case 'DateSelected':
				return new QQNode('date_selected', 'QDateTime', $this);

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

class QQReverseReferenceNodeSampleSelection extends QQReverseReferenceNode {
	protected $strTableName = 'fm__sample_selection'; public static $strPubTableName = 'fm__sample_selection';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'SampleSelection';
	protected $strDbSchema = '';	// wpg - added so we would have the database schema

	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'ParticipantSelect':
				return new QQNode('participant_select', 'string', $this);
			case 'SampleType':
				return new QQNode('sample_type', 'integer', $this);
			case 'StudySelect':
				return new QQNode('study_select', 'string', $this);
			case 'SampleSelect':
				return new QQNode('sample_select', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'Lock':
				return new QQNode('lock', 'boolean', $this);
			case 'SamplesTransferred':
				return new QQNode('samples_transferred', 'boolean', $this);
			case 'DateSelected':
				return new QQNode('date_selected', 'QDateTime', $this);

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