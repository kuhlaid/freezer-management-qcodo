<?php
	/**
	 * The abstract FmStudyGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the FmStudy subclass which
	 * extends this FmStudyGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the FmStudy class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class FmStudyGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a FmStudy from PK Info
		 * @param integer $intId
		 * @return FmStudy
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return FmStudy::QuerySingle(
				QQ::Equal(QQN::FmStudy()->Id, $intId)
			);
		}

		/**
		 * Load all FmStudies
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FmStudy[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call FmStudy::QueryArray to perform the LoadAll query
			try {
				return FmStudy::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all FmStudies
		 * @return int
		 */
		public static function CountAll() {
			// Call FmStudy::QueryCount to perform the CountAll query
			return FmStudy::QueryCount(QQ::All());
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
			$objDatabase = FmStudy::GetDatabase();

			// Create/Build out the QueryBuilder object with FmStudy-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__study');
			FmStudy::GetSelectFields($objQueryBuilder,null,$selectionArray);
			$objQueryBuilder->AddFromItem('`fm__study` AS `fm__study`');

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
		 * Static Qcodo Query method to query for a single FmStudy object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FmStudy the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FmStudy::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new FmStudy object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return FmStudy::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of FmStudy objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return FmStudy[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FmStudy::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return FmStudy::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of FmStudy objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
			// Get the Query Statement
			try {
				$strQuery = FmStudy::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
			$objDatabase = FmStudy::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'fm__study_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with FmStudy-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				FmStudy::GetSelectFields($objQueryBuilder);
				FmStudy::GetFromFields($objQueryBuilder);

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
			return FmStudy::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this FmStudy
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 * @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`fm__study`';
				$strAliasPrefix = '`';
			}

			// wpg - if we are not passing in an array of participant fields we want then get them all
			if (!$selectionArray){
				$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
				$objBuilder->AddSelectItem($strTableName . '.`name` AS ' . $strAliasPrefix . 'name`');
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
		 * Instantiate a FmStudy from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this FmStudy::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return FmStudy
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
					$strAliasPrefix = 'fm__study__';


				if ((array_key_exists($strAliasPrefix . 'fmsampleasstudytype__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'fmsampleasstudytype__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objFmSampleAsStudyTypeArray)) {
						$objPreviousChildItem = $objPreviousItem->_objFmSampleAsStudyTypeArray[$intPreviousChildItemCount - 1];
						$objChildItem = FmSample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fmsampleasstudytype__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objFmSampleAsStudyTypeArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objFmSampleAsStudyTypeArray, FmSample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fmsampleasstudytype__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'fm__study__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the FmStudy object
			$objToReturn = new FmStudy();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'fm__study__';




			// Check for FmSampleAsStudyType Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'fmsampleasstudytype__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'fmsampleasstudytype__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objFmSampleAsStudyTypeArray, FmSample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fmsampleasstudytype__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objFmSampleAsStudyType = FmSample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fmsampleasstudytype__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of FmStudies from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return FmStudy[]
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
					$objItem = FmStudy::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, FmStudy::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single FmStudy object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return FmStudy
		*/
		public static function LoadById($intId) {
			return FmStudy::QuerySingle(
				QQ::Equal(QQN::FmStudy()->Id, $intId)
			);
		}
			
		/**
		 * Load a single FmStudy object,
		 * by Name Index(es)
		 * @param string $strName
		 * @return FmStudy
		*/
		public static function LoadByName($strName) {
			return FmStudy::QuerySingle(
				QQ::Equal(QQN::FmStudy()->Name, $strName)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this FmStudy
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = FmStudy::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `fm__study` (
							`name`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strName) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('fm__study', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`fm__study`
						SET
							`name` = ' . $objDatabase->SqlVariable($this->strName) . '
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
		 * Delete this FmStudy
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this FmStudy with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = FmStudy::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fm__study`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all FmStudies
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = FmStudy::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fm__study`');
		}

		/**
		 * Truncate fm__study table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = FmStudy::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `fm__study`');
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
					 * Gets the value for strName (Unique)
					 * @return string
					 */
					return $this->strName;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_FmSampleAsStudyType':
					/**
					 * Gets the value for the private _objFmSampleAsStudyType (Read-Only)
					 * if set due to an expansion on the fm__sample.study_type_id reverse relationship
					 * @return FmSample
					 */
					return $this->_objFmSampleAsStudyType;

				case '_FmSampleAsStudyTypeArray':
					/**
					 * Gets the value for the private _objFmSampleAsStudyTypeArray (Read-Only)
					 * if set due to an ExpandAsArray on the fm__sample.study_type_id reverse relationship
					 * @return FmSample[]
					 */
					return (array) $this->_objFmSampleAsStudyTypeArray;

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
					 * Sets the value for strName (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strName = QType::Cast($mixValue, QType::String));
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

			
		
		// Related Objects' Methods for FmSampleAsStudyType
		//-------------------------------------------------------------------

		/**
		 * Gets all associated FmSamplesAsStudyType as an array of FmSample objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FmSample[]
		*/ 
		public function GetFmSampleAsStudyTypeArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return FmSample::LoadArrayByStudyTypeId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated FmSamplesAsStudyType
		 * @return int
		*/ 
		public function CountFmSamplesAsStudyType() {
			if ((is_null($this->intId)))
				return 0;

			return FmSample::CountByStudyTypeId($this->intId);
		}

		/**
		 * Associates a FmSampleAsStudyType
		 * @param FmSample $objFmSample
		 * @return void
		*/ 
		public function AssociateFmSampleAsStudyType(FmSample $objFmSample) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFmSampleAsStudyType on this unsaved FmStudy.');
			if ((is_null($objFmSample->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFmSampleAsStudyType on this FmStudy with an unsaved FmSample.');

			// Get the Database Object for this Class
			$objDatabase = FmStudy::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fm__sample`
				SET
					`study_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFmSample->Id) . '
			');
		}

		/**
		 * Unassociates a FmSampleAsStudyType
		 * @param FmSample $objFmSample
		 * @return void
		*/ 
		public function UnassociateFmSampleAsStudyType(FmSample $objFmSample) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmSampleAsStudyType on this unsaved FmStudy.');
			if ((is_null($objFmSample->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmSampleAsStudyType on this FmStudy with an unsaved FmSample.');

			// Get the Database Object for this Class
			$objDatabase = FmStudy::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fm__sample`
				SET
					`study_type_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFmSample->Id) . ' AND
					`study_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all FmSamplesAsStudyType
		 * @return void
		*/ 
		public function UnassociateAllFmSamplesAsStudyType() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmSampleAsStudyType on this unsaved FmStudy.');

			// Get the Database Object for this Class
			$objDatabase = FmStudy::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`fm__sample`
				SET
					`study_type_id` = null
				WHERE
					`study_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated FmSampleAsStudyType
		 * @param FmSample $objFmSample
		 * @return void
		*/ 
		public function DeleteAssociatedFmSampleAsStudyType(FmSample $objFmSample) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmSampleAsStudyType on this unsaved FmStudy.');
			if ((is_null($objFmSample->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmSampleAsStudyType on this FmStudy with an unsaved FmSample.');

			// Get the Database Object for this Class
			$objDatabase = FmStudy::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fm__sample`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFmSample->Id) . ' AND
					`study_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated FmSamplesAsStudyType
		 * @return void
		*/ 
		public function DeleteAllFmSamplesAsStudyType() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFmSampleAsStudyType on this unsaved FmStudy.');

			// Get the Database Object for this Class
			$objDatabase = FmStudy::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`fm__sample`
				WHERE
					`study_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column fm__study.id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column fm__study.name
		 * @var string strName
		 */
		protected $strName;
		const NameMaxLength = 145;
		const NameDefault = null;


		/**
		 * Private member variable that stores a reference to a single FmSampleAsStudyType object
		 * (of type FmSample), if this FmStudy object was restored with
		 * an expansion on the fm__sample association table.
		 * @var FmSample _objFmSampleAsStudyType;
		 */
		private $_objFmSampleAsStudyType;

		/**
		 * Private member variable that stores a reference to an array of FmSampleAsStudyType objects
		 * (of type FmSample[]), if this FmStudy object was restored with
		 * an ExpandAsArray on the fm__sample association table.
		 * @var FmSample[] _objFmSampleAsStudyTypeArray;
		 */
		private $_objFmSampleAsStudyTypeArray = array();

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
			$strToReturn = '<complexType name="FmStudy"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('FmStudy', $strComplexTypeArray)) {
				$strComplexTypeArray['FmStudy'] = FmStudy::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, FmStudy::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new FmStudy();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'Name'))
				$objToReturn->strName = $objSoapObject->Name;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, FmStudy::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeFmStudy extends QQNode {
		protected $strTableName = 'fm__study';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'FmStudy';
		protected $strDbSchema = '';	// wpg - added so we would have the database schema
		
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'FmSampleAsStudyType':
					return new QQReverseReferenceNodeFmSample($this, 'fmsampleasstudytype', 'reverse_reference', 'study_type_id');

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

	class QQReverseReferenceNodeFmStudy extends QQReverseReferenceNode {
		protected $strTableName = 'fm__study';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'FmStudy';
		protected $strDbSchema = '';	// wpg - added so we would have the database schema
		
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'FmSampleAsStudyType':
					return new QQReverseReferenceNodeFmSample($this, 'fmsampleasstudytype', 'reverse_reference', 'study_type_id');

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