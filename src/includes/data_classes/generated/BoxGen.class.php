<?php
/**
 * The abstract BoxGen class defined here is
 * code-generated and contains all the basic CRUD-type functionality as well as
 * basic methods to handle relationships and index-based loading.
 *
 * To use, you should use the Box subclass which
 * extends this BoxGen class.
 *
 * Because subsequent re-code generations will overwrite any changes to this
 * file, you should leave this file unaltered to prevent yourself from losing
 * any information or code changes.  All customizations should be done by
 * overriding existing or implementing new methods, properties and variables
 * in the Box class.
 *
 * @package My Application
 * @subpackage GeneratedDataObjects
 *
 */
class BoxGen extends QBaseClass {
	///////////////////////////////
	// COMMON LOAD METHODS
	///////////////////////////////

	/**
	 * Load a Box from PK Info
	 * @param integer $intId
	 * @return Box
	 */
	public static function Load($intId) {
		// Use QuerySingle to Perform the Query
		return Box::QuerySingle(
				QQ::Equal(QQN::Box()->Id, $intId)
		);
	}

	/**
	 * Load all Boxes
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
	 */
	public static function LoadAll($objOptionalClauses = null) {
		// Call Box::QueryArray to perform the LoadAll query
		try {
			return Box::QueryArray(QQ::All(), $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count all Boxes
	 * @return int
	 */
	public static function CountAll() {
		// Call Box::QueryCount to perform the CountAll query
		return Box::QueryCount(QQ::All());
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
		$objDatabase = Box::GetDatabase();

		// Create/Build out the QueryBuilder object with Box-specific SELET and FROM fields
		$objQueryBuilder = new QQueryBuilder($objDatabase, 'fm__box');
		Box::GetSelectFields($objQueryBuilder,null,$selectionArray);
		$objQueryBuilder->AddFromItem('fm__box AS fm__box');

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
	 * Static Qcodo Query method to query for a single Box object.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Box the queried object
	 */
	public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Box::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query, Get the First Row, and Instantiate a new Box object
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Box::InstantiateDbRow($objDbResult->GetNextRow());
	}

	/**
	 * Static Qcodo Query method to query for an array of Box objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return Box[] the queried objects as an array
	 */
	public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Box::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false,$selectionArray);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Perform the Query and Instantiate the Array Result
		$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		return Box::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
	}

	/**
	 * Static Qcodo Query method to query for a count of Box objects.
	 * Uses BuildQueryStatment to perform most of the work.
	 * @param QQCondition $objConditions any conditions on the query, itself
	 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
	 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
	 * @return integer the count of queried objects as an integer
	 */
	public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null,$selectionArray = null) {
		// Get the Query Statement
		try {
			$strQuery = Box::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true,$selectionArray);
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
	$objDatabase = Box::GetDatabase();

	// Lookup the QCache for This Query Statement
	$objCache = new QCache('query', 'box_' . serialize($strConditions));
	if (!($strQuery = $objCache->GetData())) {
	// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Box-specific fields
	$objQueryBuilder = new QQueryBuilder($objDatabase);
	Box::GetSelectFields($objQueryBuilder);
	Box::GetFromFields($objQueryBuilder);

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
	return Box::InstantiateDbResult($objDbResult);
	}*/

	/**
	 * Updates a QQueryBuilder with the SELECT fields for this Box
	* @param QQueryBuilder $objBuilder the Query Builder object to update
	* @param string $strPrefix optional prefix to add to the SELECT fields
	* @param array $selectionArray optional array of SELECT field items (wpg - added Sept 2012)
	*/
	public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null, $selectionArray = null) {
		if ($strPrefix) {
			$strTableName = $strPrefix;
			$strAliasPrefix = $strPrefix . '__';
		} else {
			$strTableName = 'fm__box';
			$strAliasPrefix = '';
		}

		// wpg - if we are not passing in an array of participant fields we want then get them all
		if (!$selectionArray){
			$objBuilder->AddSelectItem($strTableName . '.name AS ' . $strAliasPrefix . 'name');
			$objBuilder->AddSelectItem($strTableName . '.rack_id AS ' . $strAliasPrefix . 'rack_id');
			$objBuilder->AddSelectItem($strTableName . '.shelf AS ' . $strAliasPrefix . 'shelf');
			$objBuilder->AddSelectItem($strTableName . '.freezer AS ' . $strAliasPrefix . 'freezer');
			$objBuilder->AddSelectItem($strTableName . '.id AS ' . $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName . '.issues AS ' . $strAliasPrefix . 'issues');
			$objBuilder->AddSelectItem($strTableName . '.description AS ' . $strAliasPrefix . 'description');
			$objBuilder->AddSelectItem($strTableName . '.box_type_id AS ' . $strAliasPrefix . 'box_type_id');
			$objBuilder->AddSelectItem($strTableName . '.sample_type_id AS ' . $strAliasPrefix . 'sample_type_id');
			$objBuilder->AddSelectItem($strTableName . '.created AS ' . $strAliasPrefix . 'created');
			$objBuilder->AddSelectItem($strTableName . '.prepared_by_id AS ' . $strAliasPrefix . 'prepared_by_id');
			$objBuilder->AddSelectItem($strTableName . '.complete AS ' . $strAliasPrefix . 'complete');
			$objBuilder->AddSelectItem($strTableName . '.clinic_shipment_id AS ' . $strAliasPrefix . 'clinic_shipment_id');
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
	 * Instantiate a Box from a Database Row.
	 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
	 * is calling this Box::InstantiateDbRow in order to perform
	 * early binding on referenced objects.
	 * @param DatabaseRowBase $objDbRow
	 * @param string $strAliasPrefix
	 * @return Box
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
				$strAliasPrefix = 'box__';


			if ((array_key_exists($strAliasPrefix . 'boxhistorylog__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'boxhistorylog__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objBoxHistoryLogArray)) {
					$objPreviousChildItem = $objPreviousItem->_objBoxHistoryLogArray[$intPreviousChildItemCount - 1];
					$objChildItem = BoxHistoryLog::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxhistorylog__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objBoxHistoryLogArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objBoxHistoryLogArray, BoxHistoryLog::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxhistorylog__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			if ((array_key_exists($strAliasPrefix . 'frzinventoryasident__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'frzinventoryasident__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objFrzInventoryAsIdentArray)) {
					$objPreviousChildItem = $objPreviousItem->_objFrzInventoryAsIdentArray[$intPreviousChildItemCount - 1];
					$objChildItem = FrzInventory::InstantiateDbRow($objDbRow, $strAliasPrefix . 'frzinventoryasident__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objFrzInventoryAsIdentArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objFrzInventoryAsIdentArray, FrzInventory::InstantiateDbRow($objDbRow, $strAliasPrefix . 'frzinventoryasident__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			if ((array_key_exists($strAliasPrefix . 'sample__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'sample__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objSampleArray)) {
					$objPreviousChildItem = $objPreviousItem->_objSampleArray[$intPreviousChildItemCount - 1];
					$objChildItem = Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sample__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objSampleArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objSampleArray, Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sample__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			if ((array_key_exists($strAliasPrefix . 'sampleboxlocation__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'sampleboxlocation__id')))) {
				if ($intPreviousChildItemCount = count($objPreviousItem->_objSampleBoxLocationArray)) {
					$objPreviousChildItem = $objPreviousItem->_objSampleBoxLocationArray[$intPreviousChildItemCount - 1];
					$objChildItem = SampleBoxLocation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleboxlocation__', $strExpandAsArrayNodes, $objPreviousChildItem);
					if ($objChildItem)
						array_push($objPreviousItem->_objSampleBoxLocationArray, $objChildItem);
				} else
					array_push($objPreviousItem->_objSampleBoxLocationArray, SampleBoxLocation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleboxlocation__', $strExpandAsArrayNodes));
				$blnExpandedViaArray = true;
			}

			// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
			if ($blnExpandedViaArray)
				return false;
			else if ($strAliasPrefix == 'box__')
				$strAliasPrefix = null;
		}

		// Create a new instance of the Box object
		$objToReturn = new Box();
		$objToReturn->__blnRestored = true;

		$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
		$objToReturn->intRackId = $objDbRow->GetColumn($strAliasPrefix . 'rack_id', 'Integer');
		$objToReturn->intShelf = $objDbRow->GetColumn($strAliasPrefix . 'shelf', 'Integer');
		$objToReturn->intFreezer = $objDbRow->GetColumn($strAliasPrefix . 'freezer', 'Integer');
		$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
		$objToReturn->strIssues = $objDbRow->GetColumn($strAliasPrefix . 'issues', 'VarChar');
		$objToReturn->strDescription = $objDbRow->GetColumn($strAliasPrefix . 'description', 'VarChar');
		$objToReturn->intBoxTypeId = $objDbRow->GetColumn($strAliasPrefix . 'box_type_id', 'Integer');
		$objToReturn->intSampleTypeId = $objDbRow->GetColumn($strAliasPrefix . 'sample_type_id', 'Integer');
		$objToReturn->dttCreated = $objDbRow->GetColumn($strAliasPrefix . 'created', 'DateTime');
		$objToReturn->intPreparedById = $objDbRow->GetColumn($strAliasPrefix . 'prepared_by_id', 'Integer');
		$objToReturn->blnComplete = $objDbRow->GetColumn($strAliasPrefix . 'complete', 'Bit');
		$objToReturn->intClinicShipmentId = $objDbRow->GetColumn($strAliasPrefix . 'clinic_shipment_id', 'Integer');

		// Instantiate Virtual Attributes
		foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
			$strVirtualPrefix = $strAliasPrefix . '__';
			$strVirtualPrefixLength = strlen($strVirtualPrefix);
			if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
				$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
		}

		// Prepare to Check for Early/Virtual Binding
		if (!$strAliasPrefix)
			$strAliasPrefix = 'box__';

		// Check for Rack Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'rack_id__id')))
			$objToReturn->objRack = Rack::InstantiateDbRow($objDbRow, $strAliasPrefix . 'rack_id__', $strExpandAsArrayNodes);

		// Check for BoxType Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'box_type_id__id')))
			$objToReturn->objBoxType = TypeOfBox::InstantiateDbRow($objDbRow, $strAliasPrefix . 'box_type_id__', $strExpandAsArrayNodes);

		// Check for SampleType Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'sample_type_id__id')))
			$objToReturn->objSampleType = SampleTypes::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sample_type_id__', $strExpandAsArrayNodes);

		// Check for ClinicShipment Early Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'clinic_shipment_id__id')))
			$objToReturn->objClinicShipment = ClinicShipment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'clinic_shipment_id__', $strExpandAsArrayNodes);




		// Check for BoxHistoryLog Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'boxhistorylog__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'boxhistorylog__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objBoxHistoryLogArray, BoxHistoryLog::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxhistorylog__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objBoxHistoryLog = BoxHistoryLog::InstantiateDbRow($objDbRow, $strAliasPrefix . 'boxhistorylog__', $strExpandAsArrayNodes);
		}

		// Check for FrzInventoryAsIdent Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'frzinventoryasident__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'frzinventoryasident__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objFrzInventoryAsIdentArray, FrzInventory::InstantiateDbRow($objDbRow, $strAliasPrefix . 'frzinventoryasident__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objFrzInventoryAsIdent = FrzInventory::InstantiateDbRow($objDbRow, $strAliasPrefix . 'frzinventoryasident__', $strExpandAsArrayNodes);
		}

		// Check for Sample Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'sample__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'sample__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objSampleArray, Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sample__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objSample = Sample::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sample__', $strExpandAsArrayNodes);
		}

		// Check for SampleBoxLocation Virtual Binding
		if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'sampleboxlocation__id'))) {
			if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'sampleboxlocation__id', $strExpandAsArrayNodes)))
				array_push($objToReturn->_objSampleBoxLocationArray, SampleBoxLocation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleboxlocation__', $strExpandAsArrayNodes));
			else
				$objToReturn->_objSampleBoxLocation = SampleBoxLocation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'sampleboxlocation__', $strExpandAsArrayNodes);
		}

		return $objToReturn;
	}

	/**
	 * Instantiate an array of Boxes from a Database Result
	 * @param DatabaseResultBase $objDbResult
	 * @return Box[]
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
				$objItem = Box::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
				if ($objItem) {
					array_push($objToReturn, $objItem);
					$objLastRowItem = $objItem;
				}
			}
		} else {
			while ($objDbRow = $objDbResult->GetNextRow())
				array_push($objToReturn, Box::InstantiateDbRow($objDbRow));
		}

		return $objToReturn;
	}



	///////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Single Load and Array)
	///////////////////////////////////////////////////

	/**
	 * Load a single Box object,
	 * by Id Index(es)
	 * @param integer $intId
	 * @return Box
	 */
	public static function LoadById($intId) {
		return Box::QuerySingle(
				QQ::Equal(QQN::Box()->Id, $intId)
		);
	}

	/**
	 * Load an array of Box objects,
	 * by BoxTypeId Index(es)
	 * @param integer $intBoxTypeId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
		*/
	public static function LoadArrayByBoxTypeId($intBoxTypeId, $objOptionalClauses = null) {
		// Call Box::QueryArray to perform the LoadArrayByBoxTypeId query
		try {
			return Box::QueryArray(
					QQ::Equal(QQN::Box()->BoxTypeId, $intBoxTypeId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Boxes
	 * by BoxTypeId Index(es)
	 * @param integer $intBoxTypeId
	 * @return int
		*/
	public static function CountByBoxTypeId($intBoxTypeId) {
		// Call Box::QueryCount to perform the CountByBoxTypeId query
		return Box::QueryCount(
				QQ::Equal(QQN::Box()->BoxTypeId, $intBoxTypeId)
		);
	}

	/**
	 * Load an array of Box objects,
	 * by SampleTypeId Index(es)
	 * @param integer $intSampleTypeId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
		*/
	public static function LoadArrayBySampleTypeId($intSampleTypeId, $objOptionalClauses = null) {
		// Call Box::QueryArray to perform the LoadArrayBySampleTypeId query
		try {
			return Box::QueryArray(
					QQ::Equal(QQN::Box()->SampleTypeId, $intSampleTypeId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Boxes
	 * by SampleTypeId Index(es)
	 * @param integer $intSampleTypeId
	 * @return int
		*/
	public static function CountBySampleTypeId($intSampleTypeId) {
		// Call Box::QueryCount to perform the CountBySampleTypeId query
		return Box::QueryCount(
				QQ::Equal(QQN::Box()->SampleTypeId, $intSampleTypeId)
		);
	}

	/**
	 * Load an array of Box objects,
	 * by ClinicShipmentId Index(es)
	 * @param integer $intClinicShipmentId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
		*/
	public static function LoadArrayByClinicShipmentId($intClinicShipmentId, $objOptionalClauses = null) {
		// Call Box::QueryArray to perform the LoadArrayByClinicShipmentId query
		try {
			return Box::QueryArray(
					QQ::Equal(QQN::Box()->ClinicShipmentId, $intClinicShipmentId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Boxes
	 * by ClinicShipmentId Index(es)
	 * @param integer $intClinicShipmentId
	 * @return int
		*/
	public static function CountByClinicShipmentId($intClinicShipmentId) {
		// Call Box::QueryCount to perform the CountByClinicShipmentId query
		return Box::QueryCount(
				QQ::Equal(QQN::Box()->ClinicShipmentId, $intClinicShipmentId)
		);
	}

	/**
	 * Load an array of Box objects,
	 * by RackId Index(es)
	 * @param integer $intRackId
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Box[]
		*/
	public static function LoadArrayByRackId($intRackId, $objOptionalClauses = null) {
		// Call Box::QueryArray to perform the LoadArrayByRackId query
		try {
			return Box::QueryArray(
					QQ::Equal(QQN::Box()->RackId, $intRackId),
					$objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Count Boxes
	 * by RackId Index(es)
	 * @param integer $intRackId
	 * @return int
		*/
	public static function CountByRackId($intRackId) {
		// Call Box::QueryCount to perform the CountByRackId query
		return Box::QueryCount(
				QQ::Equal(QQN::Box()->RackId, $intRackId)
		);
	}



	////////////////////////////////////////////////////
	// INDEX-BASED LOAD METHODS (Array via Many to Many)
	////////////////////////////////////////////////////



	//////////////////
	// SAVE AND DELETE
	//////////////////

	/**
	 * Save this Box
	 * @param bool $blnForceInsert
	 * @param bool $blnForceUpdate
	 * @return int
		*/
	public function Save($blnForceInsert = false, $blnForceUpdate = false) {
		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		$mixToReturn = null;

		try {
			if ((!$this->__blnRestored) || ($blnForceInsert)) {
				// Perform an INSERT query
				$objDatabase->NonQuery('
						INSERT INTO '.QQNodeBox::$strPubTableName.' (
						name,
						rack_id,
						shelf,
						freezer,
						issues,
						description,
						box_type_id,
						sample_type_id,
						created,
						prepared_by_id,
						complete,
						clinic_shipment_id
				) VALUES (
						' . $objDatabase->SqlVariable($this->strName) . ',
						' . $objDatabase->SqlVariable($this->intRackId) . ',
						' . $objDatabase->SqlVariable($this->intShelf) . ',
						' . $objDatabase->SqlVariable($this->intFreezer) . ',
						' . $objDatabase->SqlVariable($this->strIssues) . ',
						' . $objDatabase->SqlVariable($this->strDescription) . ',
						' . $objDatabase->SqlVariable($this->intBoxTypeId) . ',
						' . $objDatabase->SqlVariable($this->intSampleTypeId) . ',
						' . $objDatabase->SqlVariable($this->dttCreated) . ',
						' . $objDatabase->SqlVariable($this->intPreparedById) . ',
						' . $objDatabase->SqlVariable($this->blnComplete) . ',
								' . $objDatabase->SqlVariable($this->intClinicShipmentId) . '
										)
										');

				// Update Identity column and return its value
				$mixToReturn = $this->intId = $objDatabase->InsertId(QQNodeBox::$strPubTableName, 'id');
			} else {
				// Perform an UPDATE query

				// First checking for Optimistic Locking constraints (if applicable)

				// Perform the UPDATE query
				$objDatabase->NonQuery('
						UPDATE
						'.QQNodeBox::$strPubTableName.'
						SET
						name = ' . $objDatabase->SqlVariable($this->strName) . ',
						rack_id = ' . $objDatabase->SqlVariable($this->intRackId) . ',
						shelf = ' . $objDatabase->SqlVariable($this->intShelf) . ',
						freezer = ' . $objDatabase->SqlVariable($this->intFreezer) . ',
						issues = ' . $objDatabase->SqlVariable($this->strIssues) . ',
						description = ' . $objDatabase->SqlVariable($this->strDescription) . ',
						box_type_id = ' . $objDatabase->SqlVariable($this->intBoxTypeId) . ',
						sample_type_id = ' . $objDatabase->SqlVariable($this->intSampleTypeId) . ',
						created = ' . $objDatabase->SqlVariable($this->dttCreated) . ',
						prepared_by_id = ' . $objDatabase->SqlVariable($this->intPreparedById) . ',
						complete = ' . $objDatabase->SqlVariable($this->blnComplete) . ',
								clinic_shipment_id = ' . $objDatabase->SqlVariable($this->intClinicShipmentId) . '
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
	 * Delete this Box
	 * @return void
		*/
	public function Delete() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Cannot delete this Box with an unset primary key.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();


		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeBox::$strPubTableName.'
				WHERE
				id = ' . $objDatabase->SqlVariable($this->intId) . '');
	}

	/**
	 * Delete all Boxes
	 * @return void
		*/
	public static function DeleteAll() {
		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				DELETE FROM
				'.QQNodeBox::$strPubTableName.'');
	}

	/**
	 * Truncate box table
	 * @return void
		*/
	public static function Truncate() {
		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the Query
		$objDatabase->NonQuery('
				TRUNCATE '.QQNodeBox::$strPubTableName.'');
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
			case 'Name':
				/**
				 * Gets the value for strName (Not Null)
				 * @return string
				 */
				return $this->strName;

			case 'RackId':
				/**
				 * Gets the value for intRackId
				 * @return integer
				 */
				return $this->intRackId;

			case 'Shelf':
				/**
				 * Gets the value for intShelf
				 * @return integer
				 */
				return $this->intShelf;

			case 'Freezer':
				/**
				 * Gets the value for intFreezer
				 * @return integer
				 */
				return $this->intFreezer;

			case 'Id':
				/**
				 * Gets the value for intId (Read-Only PK)
				 * @return integer
				 */
				return $this->intId;

			case 'Issues':
				/**
				 * Gets the value for strIssues
				 * @return string
				 */
				return $this->strIssues;

			case 'Description':
				/**
				 * Gets the value for strDescription
				 * @return string
				 */
				return $this->strDescription;

			case 'BoxTypeId':
				/**
				 * Gets the value for intBoxTypeId
				 * @return integer
				 */
				return $this->intBoxTypeId;

			case 'SampleTypeId':
				/**
				 * Gets the value for intSampleTypeId
				 * @return integer
				 */
				return $this->intSampleTypeId;

			case 'Created':
				/**
				 * Gets the value for dttCreated
				 * @return QDateTime
				 */
				return $this->dttCreated;

			case 'PreparedById':
				/**
				 * Gets the value for intPreparedById
				 * @return integer
				 */
				return $this->intPreparedById;

			case 'Complete':
				/**
				 * Gets the value for blnComplete
				 * @return boolean
				 */
				return $this->blnComplete;

			case 'ClinicShipmentId':
				/**
				 * Gets the value for intClinicShipmentId
				 * @return integer
				 */
				return $this->intClinicShipmentId;


				///////////////////
				// Member Objects
				///////////////////
			case 'Rack':
				/**
				 * Gets the value for the Rack object referenced by intRackId
				 * @return Rack
				 */
				try {
					if ((!$this->objRack) && (!is_null($this->intRackId)))
						$this->objRack = Rack::Load($this->intRackId);
					return $this->objRack;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'BoxType':
				/**
				 * Gets the value for the TypeOfBox object referenced by intBoxTypeId
				 * @return TypeOfBox
				 */
				try {
					if ((!$this->objBoxType) && (!is_null($this->intBoxTypeId)))
						$this->objBoxType = TypeOfBox::Load($this->intBoxTypeId);
					return $this->objBoxType;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'SampleType':
				/**
				 * Gets the value for the SampleTypes object referenced by intSampleTypeId
				 * @return SampleTypes
				 */
				try {
					if ((!$this->objSampleType) && (!is_null($this->intSampleTypeId)))
						$this->objSampleType = SampleTypes::Load($this->intSampleTypeId);
					return $this->objSampleType;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'ClinicShipment':
				/**
				 * Gets the value for the ClinicShipment object referenced by intClinicShipmentId
				 * @return ClinicShipment
				 */
				try {
					if ((!$this->objClinicShipment) && (!is_null($this->intClinicShipmentId)))
						$this->objClinicShipment = ClinicShipment::Load($this->intClinicShipmentId);
					return $this->objClinicShipment;
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

			case '_BoxHistoryLog':
				/**
				 * Gets the value for the private _objBoxHistoryLog (Read-Only)
				 * if set due to an expansion on the box_history_log.box_id reverse relationship
				 * @return BoxHistoryLog
				 */
				return $this->_objBoxHistoryLog;

			case '_BoxHistoryLogArray':
				/**
				 * Gets the value for the private _objBoxHistoryLogArray (Read-Only)
				 * if set due to an ExpandAsArray on the box_history_log.box_id reverse relationship
				 * @return BoxHistoryLog[]
				 */
				return (array) $this->_objBoxHistoryLogArray;

			case '_FrzInventoryAsIdent':
				/**
				 * Gets the value for the private _objFrzInventoryAsIdent (Read-Only)
				 * if set due to an expansion on the frz_inventory.box_ident reverse relationship
				 * @return FrzInventory
				 */
				return $this->_objFrzInventoryAsIdent;

			case '_FrzInventoryAsIdentArray':
				/**
				 * Gets the value for the private _objFrzInventoryAsIdentArray (Read-Only)
				 * if set due to an ExpandAsArray on the frz_inventory.box_ident reverse relationship
				 * @return FrzInventory[]
				 */
				return (array) $this->_objFrzInventoryAsIdentArray;

			case '_Sample':
				/**
				 * Gets the value for the private _objSample (Read-Only)
				 * if set due to an expansion on the sample.box_id reverse relationship
				 * @return Sample
				 */
				return $this->_objSample;

			case '_SampleArray':
				/**
				 * Gets the value for the private _objSampleArray (Read-Only)
				 * if set due to an ExpandAsArray on the sample.box_id reverse relationship
				 * @return Sample[]
				 */
				return (array) $this->_objSampleArray;

			case '_SampleBoxLocation':
				/**
				 * Gets the value for the private _objSampleBoxLocation (Read-Only)
				 * if set due to an expansion on the sample_box_location.box_id reverse relationship
				 * @return SampleBoxLocation
				 */
				return $this->_objSampleBoxLocation;

			case '_SampleBoxLocationArray':
				/**
				 * Gets the value for the private _objSampleBoxLocationArray (Read-Only)
				 * if set due to an ExpandAsArray on the sample_box_location.box_id reverse relationship
				 * @return SampleBoxLocation[]
				 */
				return (array) $this->_objSampleBoxLocationArray;

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

			case 'RackId':
				/**
				 * Sets the value for intRackId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objRack = null;
					return ($this->intRackId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Shelf':
				/**
				 * Sets the value for intShelf
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intShelf = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Freezer':
				/**
				 * Sets the value for intFreezer
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intFreezer = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Issues':
				/**
				 * Sets the value for strIssues
				 * @param string $mixValue
				 * @return string
				 */
				try {
					return ($this->strIssues = QType::Cast($mixValue, QType::String));
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

			case 'BoxTypeId':
				/**
				 * Sets the value for intBoxTypeId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objBoxType = null;
					return ($this->intBoxTypeId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'SampleTypeId':
				/**
				 * Sets the value for intSampleTypeId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objSampleType = null;
					return ($this->intSampleTypeId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Created':
				/**
				 * Sets the value for dttCreated
				 * @param QDateTime $mixValue
				 * @return QDateTime
				 */
				try {
					return ($this->dttCreated = QType::Cast($mixValue, QType::DateTime));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'PreparedById':
				/**
				 * Sets the value for intPreparedById
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					return ($this->intPreparedById = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'Complete':
				/**
				 * Sets the value for blnComplete
				 * @param boolean $mixValue
				 * @return boolean
				 */
				try {
					return ($this->blnComplete = QType::Cast($mixValue, QType::Boolean));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			case 'ClinicShipmentId':
				/**
				 * Sets the value for intClinicShipmentId
				 * @param integer $mixValue
				 * @return integer
				 */
				try {
					$this->objClinicShipment = null;
					return ($this->intClinicShipmentId = QType::Cast($mixValue, QType::Integer));
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}


				///////////////////
				// Member Objects
				///////////////////
			case 'Rack':
				/**
				 * Sets the value for the Rack object referenced by intRackId
				 * @param Rack $mixValue
				 * @return Rack
				 */
				if (is_null($mixValue)) {
					$this->intRackId = null;
					$this->objRack = null;
					return null;
				} else {
					// Make sure $mixValue actually is a Rack object
					try {
						$mixValue = QType::Cast($mixValue, 'Rack');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED Rack object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved Rack for this Box');

					// Update Local Member Variables
					$this->objRack = $mixValue;
					$this->intRackId = $mixValue->Id;

					// Return $mixValue
					return $mixValue;
				}
				break;

			case 'BoxType':
				/**
				 * Sets the value for the TypeOfBox object referenced by intBoxTypeId
				 * @param TypeOfBox $mixValue
				 * @return TypeOfBox
				 */
				if (is_null($mixValue)) {
					$this->intBoxTypeId = null;
					$this->objBoxType = null;
					return null;
				} else {
					// Make sure $mixValue actually is a TypeOfBox object
					try {
						$mixValue = QType::Cast($mixValue, 'TypeOfBox');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED TypeOfBox object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved BoxType for this Box');

					// Update Local Member Variables
					$this->objBoxType = $mixValue;
					$this->intBoxTypeId = $mixValue->Id;

					// Return $mixValue
					return $mixValue;
				}
				break;

			case 'SampleType':
				/**
				 * Sets the value for the SampleTypes object referenced by intSampleTypeId
				 * @param SampleTypes $mixValue
				 * @return SampleTypes
				 */
				if (is_null($mixValue)) {
					$this->intSampleTypeId = null;
					$this->objSampleType = null;
					return null;
				} else {
					// Make sure $mixValue actually is a SampleTypes object
					try {
						$mixValue = QType::Cast($mixValue, 'SampleTypes');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED SampleTypes object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved SampleType for this Box');

					// Update Local Member Variables
					$this->objSampleType = $mixValue;
					$this->intSampleTypeId = $mixValue->Id;

					// Return $mixValue
					return $mixValue;
				}
				break;

			case 'ClinicShipment':
				/**
				 * Sets the value for the ClinicShipment object referenced by intClinicShipmentId
				 * @param ClinicShipment $mixValue
				 * @return ClinicShipment
				 */
				if (is_null($mixValue)) {
					$this->intClinicShipmentId = null;
					$this->objClinicShipment = null;
					return null;
				} else {
					// Make sure $mixValue actually is a ClinicShipment object
					try {
						$mixValue = QType::Cast($mixValue, 'ClinicShipment');
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

					// Make sure $mixValue is a SAVED ClinicShipment object
					if (is_null($mixValue->Id))
						throw new QCallerException('Unable to set an unsaved ClinicShipment for this Box');

					// Update Local Member Variables
					$this->objClinicShipment = $mixValue;
					$this->intClinicShipmentId = $mixValue->Id;

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



	// Related Objects' Methods for BoxHistoryLog
	//-------------------------------------------------------------------

	/**
	 * Gets all associated BoxHistoryLogs as an array of BoxHistoryLog objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return BoxHistoryLog[]
		*/
	public function GetBoxHistoryLogArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return BoxHistoryLog::LoadArrayByBoxId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated BoxHistoryLogs
	 * @return int
		*/
	public function CountBoxHistoryLogs() {
		if ((is_null($this->intId)))
			return 0;

		return BoxHistoryLog::CountByBoxId($this->intId);
	}

	/**
	 * Associates a BoxHistoryLog
	 * @param BoxHistoryLog $objBoxHistoryLog
	 * @return void
		*/
	public function AssociateBoxHistoryLog(BoxHistoryLog $objBoxHistoryLog) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBoxHistoryLog on this unsaved Box.');
		if ((is_null($objBoxHistoryLog->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateBoxHistoryLog on this Box with an unsaved BoxHistoryLog.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box_history_log
				SET
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objBoxHistoryLog->Id) . '
				');
	}

	/**
	 * Unassociates a BoxHistoryLog
	 * @param BoxHistoryLog $objBoxHistoryLog
	 * @return void
		*/
	public function UnassociateBoxHistoryLog(BoxHistoryLog $objBoxHistoryLog) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxHistoryLog on this unsaved Box.');
		if ((is_null($objBoxHistoryLog->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxHistoryLog on this Box with an unsaved BoxHistoryLog.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box_history_log
				SET
				box_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objBoxHistoryLog->Id) . ' AND
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all BoxHistoryLogs
	 * @return void
		*/
	public function UnassociateAllBoxHistoryLogs() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxHistoryLog on this unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				box_history_log
				SET
				box_id = null
				WHERE
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated BoxHistoryLog
	 * @param BoxHistoryLog $objBoxHistoryLog
	 * @return void
		*/
	public function DeleteAssociatedBoxHistoryLog(BoxHistoryLog $objBoxHistoryLog) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxHistoryLog on this unsaved Box.');
		if ((is_null($objBoxHistoryLog->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxHistoryLog on this Box with an unsaved BoxHistoryLog.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				box_history_log
				WHERE
				id = ' . $objDatabase->SqlVariable($objBoxHistoryLog->Id) . ' AND
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated BoxHistoryLogs
	 * @return void
		*/
	public function DeleteAllBoxHistoryLogs() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateBoxHistoryLog on this unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				box_history_log
				WHERE
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}



	// Related Objects' Methods for FrzInventoryAsIdent
	//-------------------------------------------------------------------

	/**
	 * Gets all associated FrzInventoriesAsIdent as an array of FrzInventory objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return FrzInventory[]
		*/
	public function GetFrzInventoryAsIdentArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return FrzInventory::LoadArrayByBoxIdent($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated FrzInventoriesAsIdent
	 * @return int
		*/
	public function CountFrzInventoriesAsIdent() {
		if ((is_null($this->intId)))
			return 0;

		return FrzInventory::CountByBoxIdent($this->intId);
	}

	/**
	 * Associates a FrzInventoryAsIdent
	 * @param FrzInventory $objFrzInventory
	 * @return void
		*/
	public function AssociateFrzInventoryAsIdent(FrzInventory $objFrzInventory) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateFrzInventoryAsIdent on this unsaved Box.');
		if ((is_null($objFrzInventory->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateFrzInventoryAsIdent on this Box with an unsaved FrzInventory.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				frz_inventory
				SET
				box_ident = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objFrzInventory->Id) . '
				');
	}

	/**
	 * Unassociates a FrzInventoryAsIdent
	 * @param FrzInventory $objFrzInventory
	 * @return void
		*/
	public function UnassociateFrzInventoryAsIdent(FrzInventory $objFrzInventory) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFrzInventoryAsIdent on this unsaved Box.');
		if ((is_null($objFrzInventory->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFrzInventoryAsIdent on this Box with an unsaved FrzInventory.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				frz_inventory
				SET
				box_ident = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objFrzInventory->Id) . ' AND
				box_ident = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all FrzInventoriesAsIdent
	 * @return void
		*/
	public function UnassociateAllFrzInventoriesAsIdent() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFrzInventoryAsIdent on this unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				frz_inventory
				SET
				box_ident = null
				WHERE
				box_ident = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated FrzInventoryAsIdent
	 * @param FrzInventory $objFrzInventory
	 * @return void
		*/
	public function DeleteAssociatedFrzInventoryAsIdent(FrzInventory $objFrzInventory) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFrzInventoryAsIdent on this unsaved Box.');
		if ((is_null($objFrzInventory->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFrzInventoryAsIdent on this Box with an unsaved FrzInventory.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				frz_inventory
				WHERE
				id = ' . $objDatabase->SqlVariable($objFrzInventory->Id) . ' AND
				box_ident = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated FrzInventoriesAsIdent
	 * @return void
		*/
	public function DeleteAllFrzInventoriesAsIdent() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFrzInventoryAsIdent on this unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				frz_inventory
				WHERE
				box_ident = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}



	// Related Objects' Methods for Sample
	//-------------------------------------------------------------------

	/**
	 * Gets all associated Samples as an array of Sample objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return Sample[]
		*/
	public function GetSampleArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return Sample::LoadArrayByBoxId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated Samples
	 * @return int
		*/
	public function CountSamples() {
		if ((is_null($this->intId)))
			return 0;

		return Sample::CountByBoxId($this->intId);
	}

	/**
	 * Associates a Sample
	 * @param Sample $objSample
	 * @return void
		*/
	public function AssociateSample(Sample $objSample) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSample on this unsaved Box.');
		if ((is_null($objSample->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSample on this Box with an unsaved Sample.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample
				SET
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objSample->Id) . '
				');
	}

	/**
	 * Unassociates a Sample
	 * @param Sample $objSample
	 * @return void
		*/
	public function UnassociateSample(Sample $objSample) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSample on this unsaved Box.');
		if ((is_null($objSample->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSample on this Box with an unsaved Sample.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample
				SET
				box_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objSample->Id) . ' AND
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all Samples
	 * @return void
		*/
	public function UnassociateAllSamples() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSample on this unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample
				SET
				box_id = null
				WHERE
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated Sample
	 * @param Sample $objSample
	 * @return void
		*/
	public function DeleteAssociatedSample(Sample $objSample) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSample on this unsaved Box.');
		if ((is_null($objSample->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSample on this Box with an unsaved Sample.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				sample
				WHERE
				id = ' . $objDatabase->SqlVariable($objSample->Id) . ' AND
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated Samples
	 * @return void
		*/
	public function DeleteAllSamples() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSample on this unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				sample
				WHERE
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}



	// Related Objects' Methods for SampleBoxLocation
	//-------------------------------------------------------------------

	/**
	 * Gets all associated SampleBoxLocations as an array of SampleBoxLocation objects
	 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
	 * @return SampleBoxLocation[]
		*/
	public function GetSampleBoxLocationArray($objOptionalClauses = null) {
		if ((is_null($this->intId)))
			return array();

		try {
			return SampleBoxLocation::LoadArrayByBoxId($this->intId, $objOptionalClauses);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
	}

	/**
	 * Counts all associated SampleBoxLocations
	 * @return int
		*/
	public function CountSampleBoxLocations() {
		if ((is_null($this->intId)))
			return 0;

		return SampleBoxLocation::CountByBoxId($this->intId);
	}

	/**
	 * Associates a SampleBoxLocation
	 * @param SampleBoxLocation $objSampleBoxLocation
	 * @return void
		*/
	public function AssociateSampleBoxLocation(SampleBoxLocation $objSampleBoxLocation) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSampleBoxLocation on this unsaved Box.');
		if ((is_null($objSampleBoxLocation->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call AssociateSampleBoxLocation on this Box with an unsaved SampleBoxLocation.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample_box_location
				SET
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
				id = ' . $objDatabase->SqlVariable($objSampleBoxLocation->Id) . '
				');
	}

	/**
	 * Unassociates a SampleBoxLocation
	 * @param SampleBoxLocation $objSampleBoxLocation
	 * @return void
		*/
	public function UnassociateSampleBoxLocation(SampleBoxLocation $objSampleBoxLocation) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleBoxLocation on this unsaved Box.');
		if ((is_null($objSampleBoxLocation->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleBoxLocation on this Box with an unsaved SampleBoxLocation.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample_box_location
				SET
				box_id = null
				WHERE
				id = ' . $objDatabase->SqlVariable($objSampleBoxLocation->Id) . ' AND
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Unassociates all SampleBoxLocations
	 * @return void
		*/
	public function UnassociateAllSampleBoxLocations() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleBoxLocation on this unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				UPDATE
				sample_box_location
				SET
				box_id = null
				WHERE
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes an associated SampleBoxLocation
	 * @param SampleBoxLocation $objSampleBoxLocation
	 * @return void
		*/
	public function DeleteAssociatedSampleBoxLocation(SampleBoxLocation $objSampleBoxLocation) {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleBoxLocation on this unsaved Box.');
		if ((is_null($objSampleBoxLocation->Id)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleBoxLocation on this Box with an unsaved SampleBoxLocation.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				sample_box_location
				WHERE
				id = ' . $objDatabase->SqlVariable($objSampleBoxLocation->Id) . ' AND
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}

	/**
	 * Deletes all associated SampleBoxLocations
	 * @return void
		*/
	public function DeleteAllSampleBoxLocations() {
		if ((is_null($this->intId)))
			throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSampleBoxLocation on this unsaved Box.');

		// Get the Database Object for this Class
		$objDatabase = Box::GetDatabase();

		// Perform the SQL Query
		$objDatabase->NonQuery('
				DELETE FROM
				sample_box_location
				WHERE
				box_id = ' . $objDatabase->SqlVariable($this->intId) . '
				');
	}




	///////////////////////////////////////////////////////////////////////
	// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
	///////////////////////////////////////////////////////////////////////

	/**
	 * Protected member variable that maps to the database column box.name
	 * @var string strName
	 */
	protected $strName;
	const NameMaxLength = 216;
	const NameDefault = null;


	/**
	 * Protected member variable that maps to the database column box.rack_id
	 * @var integer intRackId
	 */
	protected $intRackId;
	const RackIdDefault = null;


	/**
	 * Protected member variable that maps to the database column box.shelf
	 * @var integer intShelf
	 */
	protected $intShelf;
	const ShelfDefault = null;


	/**
	 * Protected member variable that maps to the database column box.freezer
	 * @var integer intFreezer
	 */
	protected $intFreezer;
	const FreezerDefault = null;


	/**
	 * Protected member variable that maps to the database PK Identity column box.id
	 * @var integer intId
	 */
	protected $intId;
	const IdDefault = null;


	/**
	 * Protected member variable that maps to the database column box.issues
	 * @var string strIssues
	 */
	protected $strIssues;
	const IssuesMaxLength = 1000;
	const IssuesDefault = null;


	/**
	 * Protected member variable that maps to the database column box.description
	 * @var string strDescription
	 */
	protected $strDescription;
	const DescriptionMaxLength = 2000;
	const DescriptionDefault = null;


	/**
	 * Protected member variable that maps to the database column box.box_type_id
	 * @var integer intBoxTypeId
	 */
	protected $intBoxTypeId;
	const BoxTypeIdDefault = null;


	/**
	 * Protected member variable that maps to the database column box.sample_type_id
	 * @var integer intSampleTypeId
	 */
	protected $intSampleTypeId;
	const SampleTypeIdDefault = null;


	/**
	 * Protected member variable that maps to the database column box.created
	 * @var QDateTime dttCreated
	 */
	protected $dttCreated;
	const CreatedDefault = null;


	/**
	 * Protected member variable that maps to the database column box.prepared_by_id
	 * @var integer intPreparedById
	 */
	protected $intPreparedById;
	const PreparedByIdDefault = null;


	/**
	 * Protected member variable that maps to the database column box.complete
	 * @var boolean blnComplete
	 */
	protected $blnComplete;
	const CompleteDefault = null;


	/**
	 * Protected member variable that maps to the database column box.clinic_shipment_id
	 * @var integer intClinicShipmentId
	 */
	protected $intClinicShipmentId;
	const ClinicShipmentIdDefault = null;


	/**
	 * Private member variable that stores a reference to a single BoxHistoryLog object
	 * (of type BoxHistoryLog), if this Box object was restored with
	 * an expansion on the box_history_log association table.
	 * @var BoxHistoryLog _objBoxHistoryLog;
	 */
	private $_objBoxHistoryLog;

	/**
	 * Private member variable that stores a reference to an array of BoxHistoryLog objects
	 * (of type BoxHistoryLog[]), if this Box object was restored with
	 * an ExpandAsArray on the box_history_log association table.
	 * @var BoxHistoryLog[] _objBoxHistoryLogArray;
	 */
	private $_objBoxHistoryLogArray = array();

	/**
	 * Private member variable that stores a reference to a single FrzInventoryAsIdent object
	 * (of type FrzInventory), if this Box object was restored with
	 * an expansion on the frz_inventory association table.
	 * @var FrzInventory _objFrzInventoryAsIdent;
	*/
	private $_objFrzInventoryAsIdent;

	/**
	 * Private member variable that stores a reference to an array of FrzInventoryAsIdent objects
	 * (of type FrzInventory[]), if this Box object was restored with
	 * an ExpandAsArray on the frz_inventory association table.
	 * @var FrzInventory[] _objFrzInventoryAsIdentArray;
	 */
	private $_objFrzInventoryAsIdentArray = array();

	/**
	 * Private member variable that stores a reference to a single Sample object
	 * (of type Sample), if this Box object was restored with
	 * an expansion on the sample association table.
	 * @var Sample _objSample;
	*/
	private $_objSample;

	/**
	 * Private member variable that stores a reference to an array of Sample objects
	 * (of type Sample[]), if this Box object was restored with
	 * an ExpandAsArray on the sample association table.
	 * @var Sample[] _objSampleArray;
	 */
	private $_objSampleArray = array();

	/**
	 * Private member variable that stores a reference to a single SampleBoxLocation object
	 * (of type SampleBoxLocation), if this Box object was restored with
	 * an expansion on the sample_box_location association table.
	 * @var SampleBoxLocation _objSampleBoxLocation;
	*/
	private $_objSampleBoxLocation;

	/**
	 * Private member variable that stores a reference to an array of SampleBoxLocation objects
	 * (of type SampleBoxLocation[]), if this Box object was restored with
	 * an ExpandAsArray on the sample_box_location association table.
	 * @var SampleBoxLocation[] _objSampleBoxLocationArray;
	 */
	private $_objSampleBoxLocationArray = array();

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
	 * in the database column box.rack_id.
	 *
	 * NOTE: Always use the Rack property getter to correctly retrieve this Rack object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var Rack objRack
	 */
	protected $objRack;

	/**
	 * Protected member variable that contains the object pointed by the reference
	 * in the database column box.box_type_id.
	 *
	 * NOTE: Always use the BoxType property getter to correctly retrieve this TypeOfBox object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var TypeOfBox objBoxType
	 */
	protected $objBoxType;

	/**
	 * Protected member variable that contains the object pointed by the reference
	 * in the database column box.sample_type_id.
	 *
	 * NOTE: Always use the SampleType property getter to correctly retrieve this SampleTypes object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var SampleTypes objSampleType
	 */
	protected $objSampleType;

	/**
	 * Protected member variable that contains the object pointed by the reference
	 * in the database column box.clinic_shipment_id.
	 *
	 * NOTE: Always use the ClinicShipment property getter to correctly retrieve this ClinicShipment object.
	 * (Because this class implements late binding, this variable reference MAY be null.)
	 * @var ClinicShipment objClinicShipment
	 */
	protected $objClinicShipment;






	////////////////////////////////////////
	// METHODS for WEB SERVICES
	////////////////////////////////////////

	public static function GetSoapComplexTypeXml() {
		$strToReturn = '<complexType name="Box"><sequence>';
		$strToReturn .= '<element name="Name" type="xsd:string"/>';
		$strToReturn .= '<element name="Rack" type="xsd1:Rack"/>';
		$strToReturn .= '<element name="Shelf" type="xsd:int"/>';
		$strToReturn .= '<element name="Freezer" type="xsd:int"/>';
		$strToReturn .= '<element name="Id" type="xsd:int"/>';
		$strToReturn .= '<element name="Issues" type="xsd:string"/>';
		$strToReturn .= '<element name="Description" type="xsd:string"/>';
		$strToReturn .= '<element name="BoxType" type="xsd1:TypeOfBox"/>';
		$strToReturn .= '<element name="SampleType" type="xsd1:SampleTypes"/>';
		$strToReturn .= '<element name="Created" type="xsd:dateTime"/>';
		$strToReturn .= '<element name="PreparedById" type="xsd:int"/>';
		$strToReturn .= '<element name="Complete" type="xsd:boolean"/>';
		$strToReturn .= '<element name="ClinicShipment" type="xsd1:ClinicShipment"/>';
		$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
		$strToReturn .= '</sequence></complexType>';
		return $strToReturn;
	}

	public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
		if (!array_key_exists('Box', $strComplexTypeArray)) {
			$strComplexTypeArray['Box'] = Box::GetSoapComplexTypeXml();
			Rack::AlterSoapComplexTypeArray($strComplexTypeArray);
			TypeOfBox::AlterSoapComplexTypeArray($strComplexTypeArray);
			SampleTypes::AlterSoapComplexTypeArray($strComplexTypeArray);
			ClinicShipment::AlterSoapComplexTypeArray($strComplexTypeArray);
		}
	}

	public static function GetArrayFromSoapArray($objSoapArray) {
		$objArrayToReturn = array();

		foreach ($objSoapArray as $objSoapObject)
			array_push($objArrayToReturn, Box::GetObjectFromSoapObject($objSoapObject));

		return $objArrayToReturn;
	}

	public static function GetObjectFromSoapObject($objSoapObject) {
		$objToReturn = new Box();
		if (property_exists($objSoapObject, 'Name'))
			$objToReturn->strName = $objSoapObject->Name;
		if ((property_exists($objSoapObject, 'Rack')) &&
				($objSoapObject->Rack))
			$objToReturn->Rack = Rack::GetObjectFromSoapObject($objSoapObject->Rack);
		if (property_exists($objSoapObject, 'Shelf'))
			$objToReturn->intShelf = $objSoapObject->Shelf;
		if (property_exists($objSoapObject, 'Freezer'))
			$objToReturn->intFreezer = $objSoapObject->Freezer;
		if (property_exists($objSoapObject, 'Id'))
			$objToReturn->intId = $objSoapObject->Id;
		if (property_exists($objSoapObject, 'Issues'))
			$objToReturn->strIssues = $objSoapObject->Issues;
		if (property_exists($objSoapObject, 'Description'))
			$objToReturn->strDescription = $objSoapObject->Description;
		if ((property_exists($objSoapObject, 'BoxType')) &&
				($objSoapObject->BoxType))
			$objToReturn->BoxType = TypeOfBox::GetObjectFromSoapObject($objSoapObject->BoxType);
		if ((property_exists($objSoapObject, 'SampleType')) &&
				($objSoapObject->SampleType))
			$objToReturn->SampleType = SampleTypes::GetObjectFromSoapObject($objSoapObject->SampleType);
		if (property_exists($objSoapObject, 'Created'))
			$objToReturn->dttCreated = new QDateTime($objSoapObject->Created);
		if (property_exists($objSoapObject, 'PreparedById'))
			$objToReturn->intPreparedById = $objSoapObject->PreparedById;
		if (property_exists($objSoapObject, 'Complete'))
			$objToReturn->blnComplete = $objSoapObject->Complete;
		if ((property_exists($objSoapObject, 'ClinicShipment')) &&
				($objSoapObject->ClinicShipment))
			$objToReturn->ClinicShipment = ClinicShipment::GetObjectFromSoapObject($objSoapObject->ClinicShipment);
		if (property_exists($objSoapObject, '__blnRestored'))
			$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
		return $objToReturn;
	}

	public static function GetSoapArrayFromArray($objArray) {
		if (!$objArray)
			return null;

		$objArrayToReturn = array();

		foreach ($objArray as $objObject)
			array_push($objArrayToReturn, Box::GetSoapObjectFromObject($objObject, true));

		return unserialize(serialize($objArrayToReturn));
	}

	public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
		if ($objObject->objRack)
			$objObject->objRack = Rack::GetSoapObjectFromObject($objObject->objRack, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intRackId = null;
		if ($objObject->objBoxType)
			$objObject->objBoxType = TypeOfBox::GetSoapObjectFromObject($objObject->objBoxType, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intBoxTypeId = null;
		if ($objObject->objSampleType)
			$objObject->objSampleType = SampleTypes::GetSoapObjectFromObject($objObject->objSampleType, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intSampleTypeId = null;
		if ($objObject->dttCreated)
			$objObject->dttCreated = $objObject->dttCreated->toString(QDateTime::FormatSoap);
		if ($objObject->objClinicShipment)
			$objObject->objClinicShipment = ClinicShipment::GetSoapObjectFromObject($objObject->objClinicShipment, false);
		else if (!$blnBindRelatedObjects)
			$objObject->intClinicShipmentId = null;
		return $objObject;
	}
}





/////////////////////////////////////
// ADDITIONAL CLASSES for QCODO QUERY
/////////////////////////////////////

class QQNodeBox extends QQNode {
	protected $strTableName = 'fm__box'; public static $strPubTableName = 'fm__box';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Box';
	public function __get($strName) {
		switch ($strName) {
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'RackId':
				return new QQNode('rack_id', 'integer', $this);
			case 'Rack':
				return new QQNodeRack('rack_id', 'integer', $this);
			case 'Shelf':
				return new QQNode('shelf', 'integer', $this);
			case 'Freezer':
				return new QQNode('freezer', 'integer', $this);
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Issues':
				return new QQNode('issues', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'BoxTypeId':
				return new QQNode('box_type_id', 'integer', $this);
			case 'BoxType':
				return new QQNodeTypeOfBox('box_type_id', 'integer', $this);
			case 'SampleTypeId':
				return new QQNode('sample_type_id', 'integer', $this);
			case 'SampleType':
				return new QQNodeSampleTypes('sample_type_id', 'integer', $this);
			case 'Created':
				return new QQNode('created', 'QDateTime', $this);
			case 'PreparedById':
				return new QQNode('prepared_by_id', 'integer', $this);
			case 'Complete':
				return new QQNode('complete', 'boolean', $this);
			case 'ClinicShipmentId':
				return new QQNode('clinic_shipment_id', 'integer', $this);
			case 'ClinicShipment':
				return new QQNodeClinicShipment('clinic_shipment_id', 'integer', $this);
			case 'BoxHistoryLog':
				return new QQReverseReferenceNodeBoxHistoryLog($this, 'boxhistorylog', 'reverse_reference', 'box_id');
			case 'FrzInventoryAsIdent':
				return new QQReverseReferenceNodeFrzInventory($this, 'frzinventoryasident', 'reverse_reference', 'box_ident');
			case 'Sample':
				return new QQReverseReferenceNodeSample($this, 'sample', 'reverse_reference', 'box_id');
			case 'SampleBoxLocation':
				return new QQReverseReferenceNodeSampleBoxLocation($this, 'sampleboxlocation', 'reverse_reference', 'box_id');

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

class QQReverseReferenceNodeBox extends QQReverseReferenceNode {
	protected $strTableName = 'fm__box'; public static $strPubTableName = 'fm__box';
	protected $strPrimaryKey = 'id';
	protected $strClassName = 'Box';
	public function __get($strName) {
		switch ($strName) {
			case 'Name':
				return new QQNode('name', 'string', $this);
			case 'RackId':
				return new QQNode('rack_id', 'integer', $this);
			case 'Rack':
				return new QQNodeRack('rack_id', 'integer', $this);
			case 'Shelf':
				return new QQNode('shelf', 'integer', $this);
			case 'Freezer':
				return new QQNode('freezer', 'integer', $this);
			case 'Id':
				return new QQNode('id', 'integer', $this);
			case 'Issues':
				return new QQNode('issues', 'string', $this);
			case 'Description':
				return new QQNode('description', 'string', $this);
			case 'BoxTypeId':
				return new QQNode('box_type_id', 'integer', $this);
			case 'BoxType':
				return new QQNodeTypeOfBox('box_type_id', 'integer', $this);
			case 'SampleTypeId':
				return new QQNode('sample_type_id', 'integer', $this);
			case 'SampleType':
				return new QQNodeSampleTypes('sample_type_id', 'integer', $this);
			case 'Created':
				return new QQNode('created', 'QDateTime', $this);
			case 'PreparedById':
				return new QQNode('prepared_by_id', 'integer', $this);
			case 'Complete':
				return new QQNode('complete', 'boolean', $this);
			case 'ClinicShipmentId':
				return new QQNode('clinic_shipment_id', 'integer', $this);
			case 'ClinicShipment':
				return new QQNodeClinicShipment('clinic_shipment_id', 'integer', $this);
			case 'BoxHistoryLog':
				return new QQReverseReferenceNodeBoxHistoryLog($this, 'boxhistorylog', 'reverse_reference', 'box_id');
			case 'FrzInventoryAsIdent':
				return new QQReverseReferenceNodeFrzInventory($this, 'frzinventoryasident', 'reverse_reference', 'box_ident');
			case 'Sample':
				return new QQReverseReferenceNodeSample($this, 'sample', 'reverse_reference', 'box_id');
			case 'SampleBoxLocation':
				return new QQReverseReferenceNodeSampleBoxLocation($this, 'sampleboxlocation', 'reverse_reference', 'box_id');

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