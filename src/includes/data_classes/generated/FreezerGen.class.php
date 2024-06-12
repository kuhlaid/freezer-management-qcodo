<?php
	/**
	 * The abstract FreezerGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Freezer subclass which
	 * extends this FreezerGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Freezer class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class FreezerGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Freezer from PK Info
		 * @param integer $intId
		 * @return Freezer
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return Freezer::QuerySingle(
				QQ::Equal(QQN::Freezer()->Id, $intId)
			);
		}

		/**
		 * Load all Freezers
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Freezer[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Freezer::QueryArray to perform the LoadAll query
			try {
				return Freezer::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Freezers
		 * @return int
		 */
		public static function CountAll() {
			// Call Freezer::QueryCount to perform the CountAll query
			return Freezer::QueryCount(QQ::All());
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
			$objDatabase = Freezer::GetDatabase();

			// Create/Build out the QueryBuilder object with Freezer-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__freezer');
			Freezer::GetSelectFields($objQueryBuilder,null,$selectionArray);
			$objQueryBuilder->AddFromItem('fm__freezer AS fm__freezer');

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
		 * Static Qcodo Query method to query for a single Freezer object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Freezer the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Freezer::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Freezer object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Freezer::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Freezer objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Freezer[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Freezer::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Freezer::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Freezer objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Freezer::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
			$objDatabase = Freezer::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'freezer_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Freezer-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Freezer::GetSelectFields($objQueryBuilder);
				Freezer::GetFromFields($objQueryBuilder);

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
			return Freezer::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Freezer
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 * @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'fm__freezer';
				$strAliasPrefix = '';
			}

			// wpg - if we are not passing in an array of participant fields we want then get them all
			if (!$selectionArray){
				$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
				$objBuilder->AddSelectItem($strTableName . '.name AS ' . $strAliasPrefix . 'name');
				$objBuilder->AddSelectItem($strTableName . '.description AS ' . $strAliasPrefix . 'description');
				$objBuilder->AddSelectItem($strTableName . '.in_use_since AS ' . $strAliasPrefix . 'in_use_since');
				$objBuilder->AddSelectItem($strTableName . '.location AS ' . $strAliasPrefix . 'location');
				$objBuilder->AddSelectItem($strTableName . '.n_shelves AS ' . $strAliasPrefix . 'n_shelves');
				$objBuilder->AddSelectItem($strTableName . '.shelf_cu_in AS ' . $strAliasPrefix . 'shelf_cu_in');
				$objBuilder->AddSelectItem($strTableName . '.shelf_depth_in AS ' . $strAliasPrefix . 'shelf_depth_in');
				$objBuilder->AddSelectItem($strTableName . '.shelf_width_in AS ' . $strAliasPrefix . 'shelf_width_in');
				$objBuilder->AddSelectItem($strTableName . '.shelf_height_in AS ' . $strAliasPrefix . 'shelf_height_in');
				$objBuilder->AddSelectItem($strTableName . '.freezer_type AS ' . $strAliasPrefix . 'freezer_type');
				$objBuilder->AddSelectItem($strTableName . '.ModelNumber AS ' . $strAliasPrefix . 'ModelNumber');
				$objBuilder->AddSelectItem($strTableName . '.AssetNumber AS ' . $strAliasPrefix . 'AssetNumber');
				$objBuilder->AddSelectItem($strTableName . '.AlarmAccount AS ' . $strAliasPrefix . 'AlarmAccount');
				$objBuilder->AddSelectItem($strTableName . '.SerialNumber AS ' . $strAliasPrefix . 'SerialNumber');
				$objBuilder->AddSelectItem($strTableName . '.InUse AS ' . $strAliasPrefix . 'InUse');
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
		 * Instantiate a Freezer from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Freezer::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Freezer
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
					$strAliasPrefix = 'freezer__';

				if ((array_key_exists($strAliasPrefix . 'freezermaintenanceasfrzmain__freezer_maintenance_id__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'freezermaintenanceasfrzmain__freezer_maintenance_id__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objFreezerMaintenanceAsFrzMainArray)) {
						$objPreviousChildItem = $objPreviousItem->_objFreezerMaintenanceAsFrzMainArray[$intPreviousChildItemCount - 1];
						$objChildItem = FreezerMaintenance::InstantiateDbRow($objDbRow, $strAliasPrefix . 'freezermaintenanceasfrzmain__freezer_maintenance_id__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objFreezerMaintenanceAsFrzMainArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objFreezerMaintenanceAsFrzMainArray, FreezerMaintenance::InstantiateDbRow($objDbRow, $strAliasPrefix . 'freezermaintenanceasfrzmain__freezer_maintenance_id__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}


				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'freezer__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Freezer object
			$objToReturn = new Freezer();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
			$objToReturn->strDescription = $objDbRow->GetColumn($strAliasPrefix . 'description', 'VarChar');
			$objToReturn->strInUseSince = $objDbRow->GetColumn($strAliasPrefix . 'in_use_since', 'VarChar');
			$objToReturn->strLocation = $objDbRow->GetColumn($strAliasPrefix . 'location', 'VarChar');
			$objToReturn->intNShelves = $objDbRow->GetColumn($strAliasPrefix . 'n_shelves', 'Integer');
			$objToReturn->fltShelfCuIn = $objDbRow->GetColumn($strAliasPrefix . 'shelf_cu_in', 'Float');
			$objToReturn->fltShelfDepthIn = $objDbRow->GetColumn($strAliasPrefix . 'shelf_depth_in', 'Float');
			$objToReturn->fltShelfWidthIn = $objDbRow->GetColumn($strAliasPrefix . 'shelf_width_in', 'Float');
			$objToReturn->fltShelfHeightIn = $objDbRow->GetColumn($strAliasPrefix . 'shelf_height_in', 'Float');
			$objToReturn->strFreezerType = $objDbRow->GetColumn($strAliasPrefix . 'freezer_type', 'VarChar');
			$objToReturn->strModelNumber = $objDbRow->GetColumn($strAliasPrefix . 'ModelNumber', 'VarChar');
			$objToReturn->strAssetNumber = $objDbRow->GetColumn($strAliasPrefix . 'AssetNumber', 'VarChar');
			$objToReturn->strAlarmAccount = $objDbRow->GetColumn($strAliasPrefix . 'AlarmAccount', 'VarChar');
			$objToReturn->strSerialNumber = $objDbRow->GetColumn($strAliasPrefix . 'SerialNumber', 'VarChar');
			$objToReturn->intInUse = $objDbRow->GetColumn($strAliasPrefix . 'InUse', 'Integer');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix ?? '');
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'freezer__';



			// Check for FreezerMaintenanceAsFrzMain Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'freezermaintenanceasfrzmain__freezer_maintenance_id__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'freezermaintenanceasfrzmain__freezer_maintenance_id__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objFreezerMaintenanceAsFrzMainArray, FreezerMaintenance::InstantiateDbRow($objDbRow, $strAliasPrefix . 'freezermaintenanceasfrzmain__freezer_maintenance_id__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objFreezerMaintenanceAsFrzMain = FreezerMaintenance::InstantiateDbRow($objDbRow, $strAliasPrefix . 'freezermaintenanceasfrzmain__freezer_maintenance_id__', $strExpandAsArrayNodes);
			}


			return $objToReturn;
		}

		/**
		 * Instantiate an array of Freezers from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Freezer[]
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
					$objItem = Freezer::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Freezer::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Freezer object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return Freezer
		*/
		public static function LoadById($intId) {
			return Freezer::QuerySingle(
				QQ::Equal(QQN::Freezer()->Id, $intId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////
			/**
		 * Load an array of FreezerMaintenance objects for a given FreezerMaintenanceAsFrzMain
		 * via the frz_main_assn table
		 * @param integer $intFreezerMaintenanceId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Freezer[]
		*/
		public static function LoadArrayByFreezerMaintenanceAsFrzMain($intFreezerMaintenanceId, $objOptionalClauses = null) {
			// Call Freezer::QueryArray to perform the LoadArrayByFreezerMaintenanceAsFrzMain query
			try {
				return Freezer::QueryArray(
					QQ::Equal(QQN::Freezer()->FreezerMaintenanceAsFrzMain->FreezerMaintenanceId, $intFreezerMaintenanceId),
					$objOptionalClauses
				);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Freezers for a given FreezerMaintenanceAsFrzMain
		 * via the frz_main_assn table
		 * @param integer $intFreezerMaintenanceId
		 * @return int
		*/
		public static function CountByFreezerMaintenanceAsFrzMain($intFreezerMaintenanceId) {
			return Freezer::QueryCount(
				QQ::Equal(QQN::Freezer()->FreezerMaintenanceAsFrzMain->FreezerMaintenanceId, $intFreezerMaintenanceId)
			);
		}



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Freezer
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Freezer::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO '.QQNodeFreezer::$strPubTableName.' (
							name,
							description,
							in_use_since,
							location,
							n_shelves,
							shelf_cu_in,
							shelf_depth_in,
							shelf_width_in,
							shelf_height_in,
							freezer_type,
							ModelNumber,
							AssetNumber,
							AlarmAccount,
							SerialNumber,
							InUse
						) VALUES (
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->strDescription) . ',
							' . $objDatabase->SqlVariable($this->strInUseSince) . ',
							' . $objDatabase->SqlVariable($this->strLocation) . ',
							' . $objDatabase->SqlVariable($this->intNShelves) . ',
							' . $objDatabase->SqlVariable($this->fltShelfCuIn) . ',
							' . $objDatabase->SqlVariable($this->fltShelfDepthIn) . ',
							' . $objDatabase->SqlVariable($this->fltShelfWidthIn) . ',
							' . $objDatabase->SqlVariable($this->fltShelfHeightIn) . ',
							' . $objDatabase->SqlVariable($this->strFreezerType) . ',
							' . $objDatabase->SqlVariable($this->strModelNumber) . ',
							' . $objDatabase->SqlVariable($this->strAssetNumber) . ',
							' . $objDatabase->SqlVariable($this->strAlarmAccount) . ',
							' . $objDatabase->SqlVariable($this->strSerialNumber) . ',
							' . $objDatabase->SqlVariable($this->intInUse) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeFreezer::$strPubTableName, 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							'.QQNodeFreezer::$strPubTableName.'
						SET
							name = ' . $objDatabase->SqlVariable($this->strName) . ',
							description = ' . $objDatabase->SqlVariable($this->strDescription) . ',
							in_use_since = ' . $objDatabase->SqlVariable($this->strInUseSince) . ',
							location = ' . $objDatabase->SqlVariable($this->strLocation) . ',
							n_shelves = ' . $objDatabase->SqlVariable($this->intNShelves) . ',
							shelf_cu_in = ' . $objDatabase->SqlVariable($this->fltShelfCuIn) . ',
							shelf_depth_in = ' . $objDatabase->SqlVariable($this->fltShelfDepthIn) . ',
							shelf_width_in = ' . $objDatabase->SqlVariable($this->fltShelfWidthIn) . ',
							shelf_height_in = ' . $objDatabase->SqlVariable($this->fltShelfHeightIn) . ',
							freezer_type = ' . $objDatabase->SqlVariable($this->strFreezerType) . ',
							ModelNumber = ' . $objDatabase->SqlVariable($this->strModelNumber) . ',
							AssetNumber = ' . $objDatabase->SqlVariable($this->strAssetNumber) . ',
							AlarmAccount = ' . $objDatabase->SqlVariable($this->strAlarmAccount) . ',
							SerialNumber = ' . $objDatabase->SqlVariable($this->strSerialNumber) . ',
							InUse = ' . $objDatabase->SqlVariable($this->intInUse) . '
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
		 * Delete this Freezer
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Freezer with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Freezer::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					'.QQNodeFreezer::$strPubTableName.'
				WHERE
					id = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all Freezers
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Freezer::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					'.QQNodeFreezer::$strPubTableName.'');
		}

		/**
		 * Truncate freezer table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Freezer::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE '.QQNodeFreezer::$strPubTableName.'');
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
					 * Gets the value for strDescription (Not Null)
					 * @return string
					 */
					return $this->strDescription;

				case 'InUseSince':
					/**
					 * Gets the value for strInUseSince 
					 * @return string
					 */
					return $this->strInUseSince;

				case 'Location':
					/**
					 * Gets the value for strLocation (Not Null)
					 * @return string
					 */
					return $this->strLocation;

				case 'NShelves':
					/**
					 * Gets the value for intNShelves 
					 * @return integer
					 */
					return $this->intNShelves;

				case 'ShelfCuIn':
					/**
					 * Gets the value for fltShelfCuIn 
					 * @return double
					 */
					return $this->fltShelfCuIn;

				case 'ShelfDepthIn':
					/**
					 * Gets the value for fltShelfDepthIn 
					 * @return double
					 */
					return $this->fltShelfDepthIn;

				case 'ShelfWidthIn':
					/**
					 * Gets the value for fltShelfWidthIn 
					 * @return double
					 */
					return $this->fltShelfWidthIn;

				case 'ShelfHeightIn':
					/**
					 * Gets the value for fltShelfHeightIn 
					 * @return double
					 */
					return $this->fltShelfHeightIn;

				case 'FreezerType':
					/**
					 * Gets the value for strFreezerType 
					 * @return string
					 */
					return $this->strFreezerType;

				case 'ModelNumber':
					/**
					 * Gets the value for strModelNumber 
					 * @return string
					 */
					return $this->strModelNumber;

				case 'AssetNumber':
					/**
					 * Gets the value for strAssetNumber 
					 * @return string
					 */
					return $this->strAssetNumber;

				case 'AlarmAccount':
					/**
					 * Gets the value for strAlarmAccount 
					 * @return string
					 */
					return $this->strAlarmAccount;

				case 'SerialNumber':
					/**
					 * Gets the value for strSerialNumber 
					 * @return string
					 */
					return $this->strSerialNumber;

				case 'InUse':
					/**
					 * Gets the value for intInUse 
					 * @return integer
					 */
					return $this->intInUse;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_FreezerMaintenanceAsFrzMain':
					/**
					 * Gets the value for the private _objFreezerMaintenanceAsFrzMain (Read-Only)
					 * if set due to an expansion on the frz_main_assn association table
					 * @return FreezerMaintenance
					 */
					return $this->_objFreezerMaintenanceAsFrzMain;

				case '_FreezerMaintenanceAsFrzMainArray':
					/**
					 * Gets the value for the private _objFreezerMaintenanceAsFrzMainArray (Read-Only)
					 * if set due to an ExpandAsArray on the frz_main_assn association table
					 * @return FreezerMaintenance[]
					 */
					return (array) $this->_objFreezerMaintenanceAsFrzMainArray;

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
					 * Sets the value for strDescription (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strDescription = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'InUseSince':
					/**
					 * Sets the value for strInUseSince 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strInUseSince = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Location':
					/**
					 * Sets the value for strLocation (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strLocation = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'NShelves':
					/**
					 * Sets the value for intNShelves 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intNShelves = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShelfCuIn':
					/**
					 * Sets the value for fltShelfCuIn 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltShelfCuIn = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShelfDepthIn':
					/**
					 * Sets the value for fltShelfDepthIn 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltShelfDepthIn = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShelfWidthIn':
					/**
					 * Sets the value for fltShelfWidthIn 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltShelfWidthIn = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShelfHeightIn':
					/**
					 * Sets the value for fltShelfHeightIn 
					 * @param double $mixValue
					 * @return double
					 */
					try {
						return ($this->fltShelfHeightIn = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FreezerType':
					/**
					 * Sets the value for strFreezerType 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strFreezerType = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ModelNumber':
					/**
					 * Sets the value for strModelNumber 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strModelNumber = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AssetNumber':
					/**
					 * Sets the value for strAssetNumber 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strAssetNumber = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AlarmAccount':
					/**
					 * Sets the value for strAlarmAccount 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strAlarmAccount = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SerialNumber':
					/**
					 * Sets the value for strSerialNumber 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strSerialNumber = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'InUse':
					/**
					 * Sets the value for intInUse 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intInUse = QType::Cast($mixValue, QType::Integer));
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

			
		// Related Many-to-Many Objects' Methods for FreezerMaintenanceAsFrzMain
		//-------------------------------------------------------------------

		/**
		 * Gets all many-to-many associated FreezerMaintenancesAsFrzMain as an array of FreezerMaintenance objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FreezerMaintenance[]
		*/ 
		public function GetFreezerMaintenanceAsFrzMainArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return FreezerMaintenance::LoadArrayByFreezerAsFrzMain($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all many-to-many associated FreezerMaintenancesAsFrzMain
		 * @return int
		*/ 
		public function CountFreezerMaintenancesAsFrzMain() {
			if ((is_null($this->intId)))
				return 0;

			return FreezerMaintenance::CountByFreezerAsFrzMain($this->intId);
		}

		/**
		 * Checks to see if an association exists with a specific FreezerMaintenanceAsFrzMain
		 * @param FreezerMaintenance $objFreezerMaintenance
		 * @return bool
		*/
		public function IsFreezerMaintenanceAsFrzMainAssociated(FreezerMaintenance $objFreezerMaintenance) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call IsFreezerMaintenanceAsFrzMainAssociated on this unsaved Freezer.');
			if ((is_null($objFreezerMaintenance->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call IsFreezerMaintenanceAsFrzMainAssociated on this Freezer with an unsaved FreezerMaintenance.');

			$intRowCount = Freezer::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::Freezer()->Id, $this->intId),
					QQ::Equal(QQN::Freezer()->FreezerMaintenanceAsFrzMain->FreezerMaintenanceId, $objFreezerMaintenance->Id)
				)
			);

			return ($intRowCount > 0);
		}

		/**
		 * Associates a FreezerMaintenanceAsFrzMain
		 * @param FreezerMaintenance $objFreezerMaintenance
		 * @return void
		*/ 
		public function AssociateFreezerMaintenanceAsFrzMain(FreezerMaintenance $objFreezerMaintenance) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFreezerMaintenanceAsFrzMain on this unsaved Freezer.');
			if ((is_null($objFreezerMaintenance->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFreezerMaintenanceAsFrzMain on this Freezer with an unsaved FreezerMaintenance.');

			// Get the Database Object for this Class
			$objDatabase = Freezer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				INSERT INTO '.QQNodeFreezerFreezerMaintenanceAsFrzMain::$strPubTableName.' (
					freezer_id,
					freezer_maintenance_id
				) VALUES (
					' . $objDatabase->SqlVariable($this->intId) . ',
					' . $objDatabase->SqlVariable($objFreezerMaintenance->Id) . '
				)
			');
		}

		/**
		 * Unassociates a FreezerMaintenanceAsFrzMain
		 * @param FreezerMaintenance $objFreezerMaintenance
		 * @return void
		*/ 
		public function UnassociateFreezerMaintenanceAsFrzMain(FreezerMaintenance $objFreezerMaintenance) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFreezerMaintenanceAsFrzMain on this unsaved Freezer.');
			if ((is_null($objFreezerMaintenance->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFreezerMaintenanceAsFrzMain on this Freezer with an unsaved FreezerMaintenance.');

			// Get the Database Object for this Class
			$objDatabase = Freezer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					'.QQNodeFreezerFreezerMaintenanceAsFrzMain::$strPubTableName.'
				WHERE
					freezer_id = ' . $objDatabase->SqlVariable($this->intId) . ' AND
					freezer_maintenance_id = ' . $objDatabase->SqlVariable($objFreezerMaintenance->Id) . '
			');
		}

		/**
		 * Unassociates all FreezerMaintenancesAsFrzMain
		 * @return void
		*/ 
		public function UnassociateAllFreezerMaintenancesAsFrzMain() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAllFreezerMaintenanceAsFrzMainArray on this unsaved Freezer.');

			// Get the Database Object for this Class
			$objDatabase = Freezer::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					'.QQNodeFreezerFreezerMaintenanceAsFrzMain::$strPubTableName.'
				WHERE
					freezer_id = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}



		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column freezer.id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.name
		 * @var string strName
		 */
		protected $strName;
		const NameMaxLength = 45;
		const NameDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.description
		 * @var string strDescription
		 */
		protected $strDescription;
		const DescriptionMaxLength = 2000;
		const DescriptionDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.in_use_since
		 * @var string strInUseSince
		 */
		protected $strInUseSince;
		const InUseSinceMaxLength = 150;
		const InUseSinceDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.location
		 * @var string strLocation
		 */
		protected $strLocation;
		const LocationMaxLength = 145;
		const LocationDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.n_shelves
		 * @var integer intNShelves
		 */
		protected $intNShelves;
		const NShelvesDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.shelf_cu_in
		 * @var double fltShelfCuIn
		 */
		protected $fltShelfCuIn;
		const ShelfCuInDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.shelf_depth_in
		 * @var double fltShelfDepthIn
		 */
		protected $fltShelfDepthIn;
		const ShelfDepthInDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.shelf_width_in
		 * @var double fltShelfWidthIn
		 */
		protected $fltShelfWidthIn;
		const ShelfWidthInDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.shelf_height_in
		 * @var double fltShelfHeightIn
		 */
		protected $fltShelfHeightIn;
		const ShelfHeightInDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.freezer_type
		 * @var string strFreezerType
		 */
		protected $strFreezerType;
		const FreezerTypeMaxLength = 50;
		const FreezerTypeDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.ModelNumber
		 * @var string strModelNumber
		 */
		protected $strModelNumber;
		const ModelNumberMaxLength = 50;
		const ModelNumberDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.AssetNumber
		 * @var string strAssetNumber
		 */
		protected $strAssetNumber;
		const AssetNumberMaxLength = 20;
		const AssetNumberDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.AlarmAccount
		 * @var string strAlarmAccount
		 */
		protected $strAlarmAccount;
		const AlarmAccountMaxLength = 20;
		const AlarmAccountDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.SerialNumber
		 * @var string strSerialNumber
		 */
		protected $strSerialNumber;
		const SerialNumberMaxLength = 50;
		const SerialNumberDefault = null;


		/**
		 * Protected member variable that maps to the database column freezer.InUse
		 * @var integer intInUse
		 */
		protected $intInUse;
		const InUseDefault = null;


		/**
		 * Private member variable that stores a reference to a single FreezerMaintenanceAsFrzMain object
		 * (of type FreezerMaintenance), if this Freezer object was restored with
		 * an expansion on the frz_main_assn association table.
		 * @var FreezerMaintenance _objFreezerMaintenanceAsFrzMain;
		 */
		private $_objFreezerMaintenanceAsFrzMain;

		/**
		 * Private member variable that stores a reference to an array of FreezerMaintenanceAsFrzMain objects
		 * (of type FreezerMaintenance[]), if this Freezer object was restored with
		 * an ExpandAsArray on the frz_main_assn association table.
		 * @var FreezerMaintenance[] _objFreezerMaintenanceAsFrzMainArray;
		 */
		private $_objFreezerMaintenanceAsFrzMainArray = array();

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
			$strToReturn = '<complexType name="Freezer"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
			$strToReturn .= '<element name="Description" type="xsd:string"/>';
			$strToReturn .= '<element name="InUseSince" type="xsd:string"/>';
			$strToReturn .= '<element name="Location" type="xsd:string"/>';
			$strToReturn .= '<element name="NShelves" type="xsd:int"/>';
			$strToReturn .= '<element name="ShelfCuIn" type="xsd:float"/>';
			$strToReturn .= '<element name="ShelfDepthIn" type="xsd:float"/>';
			$strToReturn .= '<element name="ShelfWidthIn" type="xsd:float"/>';
			$strToReturn .= '<element name="ShelfHeightIn" type="xsd:float"/>';
			$strToReturn .= '<element name="FreezerType" type="xsd:string"/>';
			$strToReturn .= '<element name="ModelNumber" type="xsd:string"/>';
			$strToReturn .= '<element name="AssetNumber" type="xsd:string"/>';
			$strToReturn .= '<element name="AlarmAccount" type="xsd:string"/>';
			$strToReturn .= '<element name="SerialNumber" type="xsd:string"/>';
			$strToReturn .= '<element name="InUse" type="xsd:int"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Freezer', $strComplexTypeArray)) {
				$strComplexTypeArray['Freezer'] = Freezer::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Freezer::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Freezer();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'Name'))
				$objToReturn->strName = $objSoapObject->Name;
			if (property_exists($objSoapObject, 'Description'))
				$objToReturn->strDescription = $objSoapObject->Description;
			if (property_exists($objSoapObject, 'InUseSince'))
				$objToReturn->strInUseSince = $objSoapObject->InUseSince;
			if (property_exists($objSoapObject, 'Location'))
				$objToReturn->strLocation = $objSoapObject->Location;
			if (property_exists($objSoapObject, 'NShelves'))
				$objToReturn->intNShelves = $objSoapObject->NShelves;
			if (property_exists($objSoapObject, 'ShelfCuIn'))
				$objToReturn->fltShelfCuIn = $objSoapObject->ShelfCuIn;
			if (property_exists($objSoapObject, 'ShelfDepthIn'))
				$objToReturn->fltShelfDepthIn = $objSoapObject->ShelfDepthIn;
			if (property_exists($objSoapObject, 'ShelfWidthIn'))
				$objToReturn->fltShelfWidthIn = $objSoapObject->ShelfWidthIn;
			if (property_exists($objSoapObject, 'ShelfHeightIn'))
				$objToReturn->fltShelfHeightIn = $objSoapObject->ShelfHeightIn;
			if (property_exists($objSoapObject, 'FreezerType'))
				$objToReturn->strFreezerType = $objSoapObject->FreezerType;
			if (property_exists($objSoapObject, 'ModelNumber'))
				$objToReturn->strModelNumber = $objSoapObject->ModelNumber;
			if (property_exists($objSoapObject, 'AssetNumber'))
				$objToReturn->strAssetNumber = $objSoapObject->AssetNumber;
			if (property_exists($objSoapObject, 'AlarmAccount'))
				$objToReturn->strAlarmAccount = $objSoapObject->AlarmAccount;
			if (property_exists($objSoapObject, 'SerialNumber'))
				$objToReturn->strSerialNumber = $objSoapObject->SerialNumber;
			if (property_exists($objSoapObject, 'InUse'))
				$objToReturn->intInUse = $objSoapObject->InUse;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Freezer::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn ?? '') ?? '');
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeFreezerFreezerMaintenanceAsFrzMain extends QQAssociationNode {
		protected $strType = 'association';
		protected $strName = 'freezermaintenanceasfrzmain';

		protected $strTableName = 'fm__frz_main_assn'; public static $strPubTableName = 'fm__frz_main_assn';
		protected $strPrimaryKey = 'freezer_id';
		protected $strClassName = 'FreezerMaintenance';
		protected $strDbSchema = '';	// wpg - added so we would have the database schema

		public function __get($strName) {
			switch ($strName) {
				case 'FreezerMaintenanceId':
					return new QQNode('freezer_maintenance_id', 'integer', $this);
				case 'FreezerMaintenance':
					return new QQNodeFreezerMaintenance('freezer_maintenance_id', 'integer', $this);
				case '_ChildTableNode':
					return new QQNodeFreezerMaintenance('freezer_maintenance_id', 'integer', $this);
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

	class QQNodeFreezer extends QQNode {
		protected $strTableName = 'fm__freezer'; public static $strPubTableName = 'fm__freezer';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Freezer';
		protected $strDbSchema = '';	// wpg - added so we would have the database schema
		
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'Description':
					return new QQNode('description', 'string', $this);
				case 'InUseSince':
					return new QQNode('in_use_since', 'string', $this);
				case 'Location':
					return new QQNode('location', 'string', $this);
				case 'NShelves':
					return new QQNode('n_shelves', 'integer', $this);
				case 'ShelfCuIn':
					return new QQNode('shelf_cu_in', 'double', $this);
				case 'ShelfDepthIn':
					return new QQNode('shelf_depth_in', 'double', $this);
				case 'ShelfWidthIn':
					return new QQNode('shelf_width_in', 'double', $this);
				case 'ShelfHeightIn':
					return new QQNode('shelf_height_in', 'double', $this);
				case 'FreezerType':
					return new QQNode('freezer_type', 'string', $this);
				case 'ModelNumber':
					return new QQNode('ModelNumber', 'string', $this);
				case 'AssetNumber':
					return new QQNode('AssetNumber', 'string', $this);
				case 'AlarmAccount':
					return new QQNode('AlarmAccount', 'string', $this);
				case 'SerialNumber':
					return new QQNode('SerialNumber', 'string', $this);
				case 'InUse':
					return new QQNode('InUse', 'integer', $this);
				case 'FreezerMaintenanceAsFrzMain':
					return new QQNodeFreezerFreezerMaintenanceAsFrzMain($this);

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

	class QQReverseReferenceNodeFreezer extends QQReverseReferenceNode {
		protected $strTableName = 'fm__freezer'; public static $strPubTableName = 'fm__freezer';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Freezer';
		protected $strDbSchema = '';	// wpg - added so we would have the database schema
		
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'Description':
					return new QQNode('description', 'string', $this);
				case 'InUseSince':
					return new QQNode('in_use_since', 'string', $this);
				case 'Location':
					return new QQNode('location', 'string', $this);
				case 'NShelves':
					return new QQNode('n_shelves', 'integer', $this);
				case 'ShelfCuIn':
					return new QQNode('shelf_cu_in', 'double', $this);
				case 'ShelfDepthIn':
					return new QQNode('shelf_depth_in', 'double', $this);
				case 'ShelfWidthIn':
					return new QQNode('shelf_width_in', 'double', $this);
				case 'ShelfHeightIn':
					return new QQNode('shelf_height_in', 'double', $this);
				case 'FreezerType':
					return new QQNode('freezer_type', 'string', $this);
				case 'ModelNumber':
					return new QQNode('ModelNumber', 'string', $this);
				case 'AssetNumber':
					return new QQNode('AssetNumber', 'string', $this);
				case 'AlarmAccount':
					return new QQNode('AlarmAccount', 'string', $this);
				case 'SerialNumber':
					return new QQNode('SerialNumber', 'string', $this);
				case 'InUse':
					return new QQNode('InUse', 'integer', $this);
				case 'FreezerMaintenanceAsFrzMain':
					return new QQNodeFreezerFreezerMaintenanceAsFrzMain($this);

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