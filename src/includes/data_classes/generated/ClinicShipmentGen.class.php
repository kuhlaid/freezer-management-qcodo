<?php
/**
 * The abstract ClinicShipmentGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the ClinicShipment subclass which
 * extends this ClinicShipmentGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the ClinicShipment class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class ClinicShipmentGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a ClinicShipment from PK Info
	 * @param integer $intId
	 * @return ClinicShipment
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return ClinicShipment::QuerySingle(
				QQ::Equal(QQN::ClinicShipment()->Id, $intId)
		);
	}

	/**
	 * Load all ClinicShipments
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return ClinicShipment[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call ClinicShipment::QueryArray to perform the LoadAll query
		try {
			return ClinicShipment::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all ClinicShipments
	 * @return int
	 */
	public static function CountAll() {
		// Call ClinicShipment::QueryCount to perform the CountAll query
		return ClinicShipment::QueryCount(QQ::All());
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
		$objDatabase = ClinicShipment::GetDatabase();

		// Create/Build out the QueryBuilder object with ClinicShipment-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__clinic_shipment');
		ClinicShipment::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__clinic_shipment AS fm__clinic_shipment');

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
	 * Static Qcodo Query method to query for a single ClinicShipment object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return ClinicShipment the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = ClinicShipment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new ClinicShipment object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return ClinicShipment::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of ClinicShipment objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return ClinicShipment[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = ClinicShipment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return ClinicShipment::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of ClinicShipment objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = ClinicShipment::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = ClinicShipment::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'clinic_shipment_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with ClinicShipment-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	ClinicShipment::GetSelectFields($objQueryBuilder);
	ClinicShipment::GetFromFields($objQueryBuilder);

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
	return ClinicShipment::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this ClinicShipment
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__clinic_shipment';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.ship_time AS ' . $strAliasPrefix . 'ship_time');
			$objBuilder->AddSelectItem($strTableName . '.prepared_by AS ' . $strAliasPrefix . 'prepared_by');
			$objBuilder->AddSelectItem($strTableName . '.tracking_number AS ' . $strAliasPrefix . 'tracking_number');
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
	 * Instantiate a ClinicShipment from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this ClinicShipment::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return ClinicShipment
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
				$strAliasPrefix = 'clinic_shipment__';


			if ((array_key_exists($strAliasPrefix . 'box__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'box__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objBoxArray)) {
					$objPreviousChildItem = $objPreviousItem->_objBoxArray[$intPreviousChildItemCount - 1];
					$objChildItem = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objBoxArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objBoxArray, Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'clinic_shipment__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the ClinicShipment object
		$objToReturn = new ClinicShipment();
		$objToReturn->__blnRestored = true;

		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->dttShipTime = $objDbRow->GetColumn($strAliasPrefix . 'ship_time', 'DateTime');
		$objToReturn->intPreparedBy = $objDbRow->GetColumn($strAliasPrefix . 'prepared_by', 'Integer');
		$objToReturn->strTrackingNumber = $objDbRow->GetColumn($strAliasPrefix . 'tracking_number', 'VarChar');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'clinic_shipment__';




		// Check for Box Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'box__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'box__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objBoxArray, Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objBox = Box::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box__', $strExpandAsArrayNodes);
		}

		return $objToReturn;
	}

	/**
	 * Instantiate an array of ClinicShipments from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return ClinicShipment[]
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
				$objItem = ClinicShipment::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, ClinicShipment::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single ClinicShipment object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return ClinicShipment
	 */
	public static function LoadById($intId) {
		return ClinicShipment::QuerySingle(
				QQ::Equal(QQN::ClinicShipment()->Id, $intId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this ClinicShipment
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = ClinicShipment::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeClinicShipment::$strPubTableName.' (
						ship_time,
						prepared_by,
						tracking_number
				) VALUES (
						' . $objDatabase->SqlVariable($this->dttShipTime) . ',
						' . $objDatabase->SqlVariable($this->intPreparedBy) . ',
						' . $objDatabase->SqlVariable($this->strTrackingNumber) . '
				)
						');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeClinicShipment::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeClinicShipment::$strPubTableName.'
						SET
						ship_time = ' . $objDatabase->SqlVariable($this->dttShipTime) . ',
						prepared_by = ' . $objDatabase->SqlVariable($this->intPreparedBy) . ',
						tracking_number = ' . $objDatabase->SqlVariable($this->strTrackingNumber) . '
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
	 * Delete this ClinicShipment
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this ClinicShipment with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = ClinicShipment::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeClinicShipment::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all ClinicShipments
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = ClinicShipment::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeClinicShipment::$strPubTableName.'');
	}

	/**
	 * Truncate clinic_shipment table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = ClinicShipment::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeClinicShipment::$strPubTableName.'');
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

			case 'ShipTime':
				/**
				 * Gets the value for dttShipTime
				 * @return QDateTime
				 */
				return $this->dttShipTime;

			case 'PreparedBy':
				/**
				 * Gets the value for intPreparedBy
				 * @return integer
				 */
				return $this->intPreparedBy;

			case 'TrackingNumber':
				/**
				 * Gets the value for strTrackingNumber
				 * @return string
				 */
				return $this->strTrackingNumber;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_Box':
				/**
				 * Gets the value for the private _objBox (Read-Only)
				 * if set due to an expansion on the box.clinic_shipment_id reverse relationship
				 * @return Box
				 */
				return $this->_objBox;

			case '_BoxArray':
				/**
				 * Gets the value for the private _objBoxArray (Read-Only)
				 * if set due to an ExpandAsArray on the box.clinic_shipment_id reverse relationship
				 * @return Box[]
				 */
				return (array) $this->_objBoxArray;

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
			case 'ShipTime':
				/**
				 * Sets the value for dttShipTime
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttShipTime = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'PreparedBy':
				/**
				 * Sets the value for intPreparedBy
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intPreparedBy = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'TrackingNumber':
				/**
				 * Sets the value for strTrackingNumber
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strTrackingNumber = QType::Cast($mixValue, QType::String));
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



	// Related Objects' Methods for Box
	//-------------------------------------------------------------------

	/**
	 * Gets all associated Boxes as an array of Box objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
		*/
	public function GetBoxArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Box::LoadArrayByClinicShipmentId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated Boxes
	 * @return int
		*/
	public function CountBoxes() {
		if ((is_null($this->intId)))
			return 0;

		return Box::CountByClinicShipmentId($this->intId);
	}

	/**
	 * Associates a Box
	 * @param Box $objBox
	 * @return void
		*/
	public function AssociateBox(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBox on this unsaved ClinicShipment.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBox on this ClinicShipment with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = ClinicShipment::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box
				SET
				clinic_shipment_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . '
				');
	}

	/**
	 * Unassociates a Box
	 * @param Box $objBox
	 * @return void
		*/
	public function UnassociateBox(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this unsaved ClinicShipment.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this ClinicShipment with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = ClinicShipment::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box
				SET
				clinic_shipment_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . ' AND
				clinic_shipment_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all Boxes
	 * @return void
		*/
	public function UnassociateAllBoxes() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this unsaved ClinicShipment.');

		// Get the Database Object for this Class
		$objDatabase = ClinicShipment::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box
				SET
				clinic_shipment_id = null
				WHERE
				clinic_shipment_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated Box
	 * @param Box $objBox
	 * @return void
		*/
	public function DeleteAssociatedBox(Box $objBox) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this unsaved ClinicShipment.');
		if ((is_null($objBox->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this ClinicShipment with an unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = ClinicShipment::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				box
				WHERE
				id = ' . $objDatabase->SqlVariable($objBox->Id) . ' AND
				clinic_shipment_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated Boxes
	 * @return void
		*/
	public function DeleteAllBoxes() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBox on this unsaved ClinicShipment.');

		// Get the Database Object for this Class
		$objDatabase = ClinicShipment::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				box
				WHERE
				clinic_shipment_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database PK Identity column clinic_shipment.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column clinic_shipment.ship_time
	 * @var QDateTime dttShipTime
	 */
	protected $dttShipTime;
	const ShipTimeDefault = null;


	/**
	 * Protected member variable that maps to the database column clinic_shipment.prepared_by
	 * @var integer intPreparedBy
	 */
	protected $intPreparedBy;
	const PreparedByDefault = null;


	/**
	 * Protected member variable that maps to the database column clinic_shipment.tracking_number
	 * @var string strTrackingNumber
	 */
	protected $strTrackingNumber;
	const TrackingNumberMaxLength = 50;
	const TrackingNumberDefault = null;


	/**
	 * Private member variable that stores a reference to a single Box object
	 * (of type Box), if this ClinicShipment object was restored with
	 * an expansion on the box association table.
	 * @var Box _objBox;
	 */
	private $_objBox;

	/**
	 * Private member variable that stores a reference to an array of Box objects
	 * (of type Box[]), if this ClinicShipment object was restored with
	 * an ExpandAsArray on the box association table.
	 * @var Box[] _objBoxArray;
	 */
	private $_objBoxArray = array();

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
		$strToReturn = '<complexType name="ClinicShipment"><sequence>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="ShipTime" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="PreparedBy" type="xsd:int"/>';
		$strToReturn .= '<element name="TrackingNumber" type="xsd:string"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('ClinicShipment', $strComplexTypeArray)) {
			$strComplexTypeArray['ClinicShipment'] = ClinicShipment::GetSoapComplexTypeXml();
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, ClinicShipment::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new ClinicShipment();
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'ShipTime'))
			$objToReturn->dttShipTime = new QDateTime($objSoapObject->ShipTime);
		if (property_exists($objSoapObject, 'PreparedBy'))
			$objToReturn->intPreparedBy = $objSoapObject->PreparedBy;
		if (property_exists($objSoapObject, 'TrackingNumber'))
			$objToReturn->strTrackingNumber = $objSoapObject->TrackingNumber;
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, ClinicShipment::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->dttShipTime)
			$objObject->dttShipTime = $objObject->dttShipTime->toString(QDateTime::FormatSoap);
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeClinicShipment extends QQNode {
	protected $strTableName = 'fm__clinic_shipment'; public static $strPubTableName = 'fm__clinic_shipment';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'ClinicShipment';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'ShipTime':
				return new QQNode('ship_time', 'QDateTime', $this);
			case 'PreparedBy':
				return new QQNode('prepared_by', 'integer', $this);
			case 'TrackingNumber':
				return new QQNode('tracking_number', 'string', $this);
			case 'Box':
				return new QQReverseReferenceNodeBox($this, 'box', 'reverse_reference', 'clinic_shipment_id');

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

class QQReverseReferenceNodeClinicShipment extends QQReverseReferenceNode {
	protected $strTableName = 'fm__clinic_shipment'; public static $strPubTableName = 'fm__clinic_shipment';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'ClinicShipment';
	public function __get($strName) {
		switch ($strName) {
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'ShipTime':
				return new QQNode('ship_time', 'QDateTime', $this);
			case 'PreparedBy':
				return new QQNode('prepared_by', 'integer', $this);
			case 'TrackingNumber':
				return new QQNode('tracking_number', 'string', $this);
			case 'Box':
				return new QQReverseReferenceNodeBox($this, 'box', 'reverse_reference', 'clinic_shipment_id');

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