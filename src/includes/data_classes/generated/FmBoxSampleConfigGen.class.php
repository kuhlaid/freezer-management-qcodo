<?php
	/**
	 * The abstract FmBoxSampleConfigGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the FmBoxSampleConfig subclass which
	 * extends this FmBoxSampleConfigGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the FmBoxSampleConfig class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class FmBoxSampleConfigGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a FmBoxSampleConfig from PK Info
		 * @param integer $intId
		 * @return FmBoxSampleConfig
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return FmBoxSampleConfig::QuerySingle(
				QQ::Equal(QQN::FmBoxSampleConfig()->Id, $intId)
			);
		}

		/**
		 * Load all FmBoxSampleConfigs
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FmBoxSampleConfig[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call FmBoxSampleConfig::QueryArray to perform the LoadAll query
			try {
				return FmBoxSampleConfig::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all FmBoxSampleConfigs
		 * @return int
		 */
		public static function CountAll() {
			// Call FmBoxSampleConfig::QueryCount to perform the CountAll query
			return FmBoxSampleConfig::QueryCount(QQ::All());
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
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			// Create/Build out the QueryBuilder object with FmBoxSampleConfig-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__box_sample_config');
			FmBoxSampleConfig::GetSelectFields($objQueryBuilder,null,$selectionArray);
			$objQueryBuilder->AddFromItem('`fm__box_sample_config` AS `fm__box_sample_config`');

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
		 * Static Qcodo Query method to query for a single FmBoxSampleConfig object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FmBoxSampleConfig the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FmBoxSampleConfig::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new FmBoxSampleConfig object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return FmBoxSampleConfig::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of FmBoxSampleConfig objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FmBoxSampleConfig[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FmBoxSampleConfig::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return FmBoxSampleConfig::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of FmBoxSampleConfig objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FmBoxSampleConfig::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'fm__box_sample_config_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with FmBoxSampleConfig-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				FmBoxSampleConfig::GetSelectFields($objQueryBuilder);
				FmBoxSampleConfig::GetFromFields($objQueryBuilder);

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
			return FmBoxSampleConfig::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this FmBoxSampleConfig
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 * @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`fm__box_sample_config`';
				$strAliasPrefix = '`';
			}

			// wpg - if we are not passing in an array of participant fields we want then get them all
			if (!$selectionArray){
				$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
				$objBuilder->AddSelectItem($strTableName . '.`config` AS ' . $strAliasPrefix . 'config`');
				$objBuilder->AddSelectItem($strTableName . '.`description` AS ' . $strAliasPrefix . 'description`');
			}
			elseif($selectionArray==array(1)) {
				return;
			}
			else {
				foreach($selectionArray AS $field){
					$objBuilder->AddSelectItem($strTableName . '.`'.$field.'` AS ' . $strAliasPrefix . $field.'`');
				}
			}
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a FmBoxSampleConfig from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this FmBoxSampleConfig::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return FmBoxSampleConfig
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
					$strAliasPrefix = 'fm__box_sample_config__';


				if ((array_key_exists($strAliasPrefix . 'fmboxassampleconfig__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'fmboxassampleconfig__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objFmBoxAsSampleConfigArray)) {
						$objPreviousChildItem = $objPreviousItem->_objFmBoxAsSampleConfigArray[$intPreviousChildItemCount - 1];
						$objChildItem = FmBox::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fmboxassampleconfig__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objFmBoxAsSampleConfigArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objFmBoxAsSampleConfigArray, FmBox::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fmboxassampleconfig__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'fm__box_sample_config__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the FmBoxSampleConfig object
			$objToReturn = new FmBoxSampleConfig();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->strConfig = $objDbRow->GetColumn($strAliasPrefix . 'config', 'VarChar');
			$objToReturn->strDescription = $objDbRow->GetColumn($strAliasPrefix . 'description', 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'fm__box_sample_config__';




			// Check for FmBoxAsSampleConfig Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'fmboxassampleconfig__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'fmboxassampleconfig__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objFmBoxAsSampleConfigArray, FmBox::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fmboxassampleconfig__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objFmBoxAsSampleConfig = FmBox::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fmboxassampleconfig__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of FmBoxSampleConfigs from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return FmBoxSampleConfig[]
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
					$objItem = FmBoxSampleConfig::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, FmBoxSampleConfig::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single FmBoxSampleConfig object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return FmBoxSampleConfig
		*/
		public static function LoadById($intId) {
			return FmBoxSampleConfig::QuerySingle(
				QQ::Equal(QQN::FmBoxSampleConfig()->Id, $intId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this FmBoxSampleConfig
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `fm__box_sample_config` (
							`config`,
							`description`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strConfig) . ',
							' . $objDatabase->SqlVariable($this->strDescription) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('fm__box_sample_config', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`fm__box_sample_config`
						SET
							`config` = ' . $objDatabase->SqlVariable($this->strConfig) . ',
							`description` = ' . $objDatabase->SqlVariable($this->strDescription) . '
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
		 * Delete this FmBoxSampleConfig
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this FmBoxSampleConfig with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = FmBoxSampleConfig::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fm__box_sample_config`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all FmBoxSampleConfigs
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fm__box_sample_config`');
		}

		/**
		 * Truncate fm__box_sample_config table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `fm__box_sample_config`');
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

				case 'Config':
					/**
					 * Gets the value for strConfig 
					 * @return string
					 */
					return $this->strConfig;

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

				case '_FmBoxAsSampleConfig':
					/**
					 * Gets the value for the private _objFmBoxAsSampleConfig (Read-Only)
					 * if set due to an expansion on the fm__box.sample_config_id reverse relationship
					 * @return FmBox
					 */
					return $this->_objFmBoxAsSampleConfig;

				case '_FmBoxAsSampleConfigArray':
					/**
					 * Gets the value for the private _objFmBoxAsSampleConfigArray (Read-Only)
					 * if set due to an ExpandAsArray on the fm__box.sample_config_id reverse relationship
					 * @return FmBox[]
					 */
					return (array) $this->_objFmBoxAsSampleConfigArray;

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
				case 'Config':
					/**
					 * Sets the value for strConfig 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strConfig = QType::Cast($mixValue, QType::String));
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

			
		
		// Related Objects' Methods for FmBoxAsSampleConfig
		//-------------------------------------------------------------------

		/**
		 * Gets all associated FmBoxesAsSampleConfig as an array of FmBox objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FmBox[]
		*/ 
		public function GetFmBoxAsSampleConfigArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return FmBox::LoadArrayBySampleConfigId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated FmBoxesAsSampleConfig
		 * @return int
		*/ 
		public function CountFmBoxesAsSampleConfig() {
			if ((is_null($this->intId)))
				return 0;

			return FmBox::CountBySampleConfigId($this->intId);
		}

		/**
		 * Associates a FmBoxAsSampleConfig
		 * @param FmBox $objFmBox
		 * @return void
		*/ 
		public function AssociateFmBoxAsSampleConfig(FmBox $objFmBox) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFmBoxAsSampleConfig on this unsaved FmBoxSampleConfig.');
			if ((is_null($objFmBox->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFmBoxAsSampleConfig on this FmBoxSampleConfig with an unsaved FmBox.');

			// Get the Database Object for this Class
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fm__box`
				SET
					`sample_config_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFmBox->Id) . '
			');
		}

		/**
		 * Unassociates a FmBoxAsSampleConfig
		 * @param FmBox $objFmBox
		 * @return void
		*/ 
		public function UnassociateFmBoxAsSampleConfig(FmBox $objFmBox) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmBoxAsSampleConfig on this unsaved FmBoxSampleConfig.');
			if ((is_null($objFmBox->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmBoxAsSampleConfig on this FmBoxSampleConfig with an unsaved FmBox.');

			// Get the Database Object for this Class
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fm__box`
				SET
					`sample_config_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFmBox->Id) . ' AND
					`sample_config_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all FmBoxesAsSampleConfig
		 * @return void
		*/ 
		public function UnassociateAllFmBoxesAsSampleConfig() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmBoxAsSampleConfig on this unsaved FmBoxSampleConfig.');

			// Get the Database Object for this Class
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fm__box`
				SET
					`sample_config_id` = null
				WHERE
					`sample_config_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated FmBoxAsSampleConfig
		 * @param FmBox $objFmBox
		 * @return void
		*/ 
		public function DeleteAssociatedFmBoxAsSampleConfig(FmBox $objFmBox) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmBoxAsSampleConfig on this unsaved FmBoxSampleConfig.');
			if ((is_null($objFmBox->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmBoxAsSampleConfig on this FmBoxSampleConfig with an unsaved FmBox.');

			// Get the Database Object for this Class
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fm__box`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFmBox->Id) . ' AND
					`sample_config_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated FmBoxesAsSampleConfig
		 * @return void
		*/ 
		public function DeleteAllFmBoxesAsSampleConfig() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmBoxAsSampleConfig on this unsaved FmBoxSampleConfig.');

			// Get the Database Object for this Class
			$objDatabase = FmBoxSampleConfig::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fm__box`
				WHERE
					`sample_config_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column fm__box_sample_config.id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column fm__box_sample_config.config
		 * @var string strConfig
		 */
		protected $strConfig;
		const ConfigDefault = null;


		/**
		 * Protected member variable that maps to the database column fm__box_sample_config.description
		 * @var string strDescription
		 */
		protected $strDescription;
		const DescriptionMaxLength = 145;
		const DescriptionDefault = null;


		/**
		 * Private member variable that stores a reference to a single FmBoxAsSampleConfig object
		 * (of type FmBox), if this FmBoxSampleConfig object was restored with
		 * an expansion on the fm__box association table.
		 * @var FmBox _objFmBoxAsSampleConfig;
		 */
		private $_objFmBoxAsSampleConfig;

		/**
		 * Private member variable that stores a reference to an array of FmBoxAsSampleConfig objects
		 * (of type FmBox[]), if this FmBoxSampleConfig object was restored with
		 * an ExpandAsArray on the fm__box association table.
		 * @var FmBox[] _objFmBoxAsSampleConfigArray;
		 */
		private $_objFmBoxAsSampleConfigArray = array();

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
			$strToReturn = '<complexType name="FmBoxSampleConfig"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Config" type="xsd:string"/>';
			$strToReturn .= '<element name="Description" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('FmBoxSampleConfig', $strComplexTypeArray)) {
				$strComplexTypeArray['FmBoxSampleConfig'] = FmBoxSampleConfig::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, FmBoxSampleConfig::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new FmBoxSampleConfig();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'Config'))
				$objToReturn->strConfig = $objSoapObject->Config;
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
				array_push($objArrayToReturn, FmBoxSampleConfig::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn ?? '') ?? '');
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeFmBoxSampleConfig extends QQNode {
		protected $strTableName = 'fm__box_sample_config';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'FmBoxSampleConfig';
		protected $strDbSchema = '';	// wpg - added so we would have the database schema
		
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Config':
					return new QQNode('config', 'string', $this);
				case 'Description':
					return new QQNode('description', 'string', $this);
				case 'FmBoxAsSampleConfig':
					return new QQReverseReferenceNodeFmBox($this, 'fmboxassampleconfig', 'reverse_reference', 'sample_config_id');

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

	class QQReverseReferenceNodeFmBoxSampleConfig extends QQReverseReferenceNode {
		protected $strTableName = 'fm__box_sample_config';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'FmBoxSampleConfig';
		protected $strDbSchema = '';	// wpg - added so we would have the database schema
		
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Config':
					return new QQNode('config', 'string', $this);
				case 'Description':
					return new QQNode('description', 'string', $this);
				case 'FmBoxAsSampleConfig':
					return new QQReverseReferenceNodeFmBox($this, 'fmboxassampleconfig', 'reverse_reference', 'sample_config_id');

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