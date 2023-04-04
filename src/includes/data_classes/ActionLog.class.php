<?php
/**
 * Nov. 15, 2019 - wpg
 * - adding LogSampleAction function
 * 
 * Sept. 19, 2019 - wpg
 * - adding Rack actions and the getAction function
 */
	require(__DATAGEN_CLASSES__ . '/ActionLogGen.class.php');

	/**
	 * The ActionLog class defined here contains any
	 * customized code for the ActionLog class in the
	 * Object Relational Model.  It represents the "ActionLog" table 
	 * in the database, and extends from the code generated abstract ActionLogGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package My Application
	 * @subpackage DataObjects
	 * 
	 */
	class ActionLog extends ActionLogGen {
		// note the key needs to be in quotes even though it is a number
		public static $strAction = '{
			"1":"Box update",
			"2":"Box insert",
			"3":"Box delete",
			"4":"Sample insert",
			"5":"Sample update",
			"6":"Sample delete",
			"7":"Rack insert",
			"8":"Rack update",
			"9":"Rack delete",
			"10":"Box history delete"
		}';

		public static function getAction($intAction){
			$actionLogJson = json_decode(ActionLog::$strAction);
			if ($intAction!='')
				return $actionLogJson->{$intAction};
			else return 'no action';
		}

		public static $basicBoxTemplate = '{
			"name":"",
			"rack_id":"",
			"shelf":"",
			"freezer":"",
			"id":"",
			"issues":"",
			"description":"",
			"box_type_id":"",
			"sample_type_id":"",
			"created":"",
			"prepared_by_id":"",
			"complete":"",
			"clinic_shipment_id":"",
			"LogDate":"",
			"Action":""
		}';

		public static $basicRackTemplate = '{
			"name":"",
			"rack_type_id":"",
			"shelf":"",
			"freezer":"",
			"id":"",
			"notes":"",
			"LogDate":"",
			"Action":""
		}';

		public static $basicSampleTemplate = '{
			"name":"",
			"study_type_id":"",
			"sample_type_id":"",
			"sample_number":"",
			"id":"",
			"barcode":"",
			"study_case":"",
			"box_id":"",
			"box_sample_slot":"",
			"notes":"",
			"LogDate":"",
			"Action":""
		}';

		public static $basicBoxHistoryTemplate = '{
			"release_date":"",
			"freezer_pull_id":"",
			"received_date":"",
			"id":"",
			"box_id":"",
			"LogDate":"",
			"Action":""
		}';

		// log an action made on the box (reminder: this action only tracks changes made through the application and not manual SQL queries)
		public static function LogBoxAction($action,$objBox) {
			$objActionLog = new ActionLog();
			$objJsonData = json_decode(ActionLog::$basicBoxTemplate);
			$objJsonData->{'Action'} = $action;
			$objJsonData->{'LogDate'} = QDateTime::Now(true)->toString(QDateTime::FormatDisplayDateTime);
			$objJsonData->{'rack_id'} = $objBox->RackId;
			$objJsonData->{'shelf'} = $objBox->Shelf;
			$objJsonData->{'freezer'} = $objBox->Freezer;
			$objJsonData->{'id'} = $objBox->Id;
			$objJsonData->{'issues'} = $objBox->Issues;
			$objJsonData->{'description'} = $objBox->Description;
			$objJsonData->{'box_type_id'} = $objBox->BoxTypeId;
			$objJsonData->{'sample_type_id'} = $objBox->SampleTypeId;
			$objJsonData->{'created'} = $objBox->Created;
			$objJsonData->{'name'} = $objBox->Name;
			$objActionLog->JsonData = json_encode($objJsonData);
			$objActionLog->Save();
		}

		// log an action made on the box history (reminder: this action only tracks changes made through the application and not manual SQL queries)
		public static function LogBoxHistoryAction($action,$objBoxHistoryLog) {
			$objActionLog = new ActionLog();
			$objJsonData = json_decode(ActionLog::$basicBoxHistoryTemplate);
			$objJsonData->{'Action'} = $action;
			$objJsonData->{'LogDate'} = QDateTime::Now(true)->toString(QDateTime::FormatDisplayDateTime);
			$objJsonData->{'release_date'} = $objBoxHistoryLog->ReleaseDate;
			$objJsonData->{'freezer_pull_id'} = $objBoxHistoryLog->FreezerPullId;
			$objJsonData->{'received_date'} = $objBoxHistoryLog->ReceivedDate;
			$objJsonData->{'id'} = $objBoxHistoryLog->Id;
			$objJsonData->{'box_id'} = $objBoxHistoryLog->BoxId;
			$objActionLog->JsonData = json_encode($objJsonData);
			$objActionLog->Save();
		}

		public static function LogRackAction($action,$objRack) {
			$objActionLog = new ActionLog();
			$objJsonData = json_decode(ActionLog::$basicRackTemplate);
			$objJsonData->{'Action'} = $action;
			$objJsonData->{'LogDate'} = QDateTime::Now(true)->toString(QDateTime::FormatDisplayDateTime);
			$objJsonData->{'rack_type_id'} = $objRack->RackTypeId;
			$objJsonData->{'shelf'} = $objRack->Shelf;
			$objJsonData->{'freezer'} = $objRack->Freezer;
			$objJsonData->{'id'} = $objRack->Id;
			$objJsonData->{'notes'} = $objRack->Notes;
			$objJsonData->{'name'} = $objRack->Name;
			$objActionLog->JsonData = json_encode($objJsonData);
			$objActionLog->Save();
		}

		public static function LogSampleAction($action,$objSample) {
			$objActionLog = new ActionLog();
			$objJsonData = json_decode(ActionLog::$basicSampleTemplate);
			$objJsonData->{'Action'} = $action;
			$objJsonData->{'LogDate'} = QDateTime::Now(true)->toString(QDateTime::FormatDisplayDateTime);
			$objJsonData->{'sample_number'} = $objSample->SampleNumber;
			$objJsonData->{'sample_type_id'} = $objSample->SampleTypeId;
			$objJsonData->{'study_type_id'} = $objSample->StudyTypeId;
			$objJsonData->{'id'} = $objSample->Id;
			$objJsonData->{'notes'} = $objSample->Notes;
			$objJsonData->{'barcode'} = $objSample->Barcode;
			$objJsonData->{'study_case'} = $objSample->StudyCase;
			$objJsonData->{'box_id'} = $objSample->BoxId;
			$objJsonData->{'box_sample_slot'} = $objSample->BoxSampleSlot;
			$objActionLog->JsonData = json_encode($objJsonData);
			$objActionLog->Save();
		}
	}
?>