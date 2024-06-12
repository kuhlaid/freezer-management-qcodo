<?php
/**
 * @abstract Default Qcodo 'main' script with added features.
 * @author w. Patrick Gale
 * 
 * Oct. 30, 2018 - wpg
 * - adding a centralized session handler (FM2013Session)
 * 
 * - adding 'view-only' user account access (Jan. 15, 2016 - wpg)
 */

if (!defined('__PREPEND_INCLUDED__')) {
	// Ensure prepend.inc is only executed once
	define('__PREPEND_INCLUDED__', 1);


	///////////////////////////////////
	// Define Server-specific constants
	///////////////////////////////////
	/*
	 * This assumes that the configuration include file is in the same directory
	* as this prepend include file.  For security reasons, you can feel free
	* to move the configuration file anywhere you want.  But be sure to provide
	* a relative or absolute path to the file.
	*/
	require(dirname(__FILE__) . '/configuration.inc.php');

	//////////////////////////////
	// Include the Qcodo Framework
	//////////////////////////////
	require(__QCODO_CORE__ . '/qcodo.inc.php');

	///////////////////////////////
	// Define the Application Class
	///////////////////////////////
	/**
	 * The Application class is an abstract class that statically provides
	 * information and global utilities for the entire web application.
	 *
	 * Custom constants for this webapp, as well as global variables and global
	 * methods should be declared in this abstract class (declared statically).
	 *
	 * This Application class should extend from the ApplicationBase class in
	 * the framework.
	*/
	abstract class QApplication extends QApplicationBase {
		/**
		 * This is called by the PHP5 Autoloader.  This method overrides the
		 * one in ApplicationBase.
		 *
		 * @return void
		 */
		public static function Autoload($strClassName) {
			// First use the Qcodo Autoloader
			parent::Autoload($strClassName);

			// TODO: Run any custom autoloading functionality (if any) here...
		}

		////////////////////////////
		// QApplication Customizations (e.g. EncodingType, etc.)
		////////////////////////////
		// public static $EncodingType = 'ISO-8859-1';

		////////////////////////////
		// Additional Static Methods
		////////////////////////////
		// TODO: Define any other custom global WebApplication functions (if any) here...
	}


	//////////////////////////
	// Custom Global Functions
	//////////////////////////
	// TODO: Define any custom global functions (if any) here...

	/**
	 * Will compare a date to the current date and return a formatted date or countdown until time
	 *
	 * @param unknown_type $date
	 * @param unknown_type $format
	 * @return unknown
	 */
	function dateOff($date, $format = null){
		if ($date == "") {
			return;
		}
		$Date_exp = explode("-", $date);	// break the formatting from the database 2006/12/31
		$date = strtotime($Date_exp[1]."/".$Date_exp[2]."/".$Date_exp[0]);	// reconstruct date in proper format 12/31/2006

		$offset = (strftime("%j")+strftime("%Y")*365)-(strftime("%j",$date)+strftime("%Y",$date)*365);
		if ($offset > 0){
			if ($format==null) $return = strftime("%B %d, %Y",$date)."<br/><span class='error bld'>Grant Expired</span>";
			elseif ($format=='passed') $return = "<span class='error bld'>".strftime("%B %d, %Y",$date)."</span>";
			elseif ($format=='normal') $return = strftime("%B %d, %Y",$date);
		}
		elseif ($offset <= 0){
			$offset = (strftime("%j",$date)+strftime("%Y",$date)*365) - (strftime("%j")+strftime("%Y")*365);
			$notice = 'gen_small2b';

			// if the grant expires within the next 30 days then display the number of days left in red
			if (intval($offset) < 30) $notice = 'error bld';
			if ($format==null) $return = strftime("%B %d, %Y",$date)."<br/><span class='$notice'>".$offset. " days left</span>";
			elseif ($format=='passed') $return = strftime("%B %d, %Y",$date);
			elseif ($format=='normal') $return = strftime("%B %d, %Y",$date);
		}
		return $return;
	}

	/**
	 * Datagrid filtering refresh
	 *
	 * @param datagrid object $objDataGrid
	 */
	function searchFilterChange($objDataGrid) {
		// if the datagrid has been created
		if ($objDataGrid){
			$objDataGrid->Paginator->PageNumber = 1;
			$objDataGrid->Refresh();
		}
	}

	/**
	 * Handles the viewing of versioning and update information for scripts.
	 * @param $log
	 * @return unknown_type
	 */
	function scriptLog($log){
		return '<div style="padding-top:500px;color:#000;"><hr/>Page change notices:<div style="font-size:11px;color:#888;">
				'.nl2br($log).'</div></div>';
	}

	/**
	 * wpg - Takes search results text ($rowtext) and looks through it to find the items ($search) being searched on.
	 * Prints and hightlights the results found.
	 *
	 * @param search_string $search
	 * @param text_searching_on $text
	 * @param type_of_text $textType
	 */
	function highlightResults($strSearch,$strSubject) {
		// we need to parse the results if we are looking for more than one item
		// 		$searchItemArray = explode("+", $strSearch);

		// 		$return = '';
		// 		if (count($searchItemArray)==1)
		// 			return str_ireplace($strSearch, "<span class='hghLight'>".$strSearch."</span>", $strSubject);
		// 		elseif (count($searchItemArray) > 1){
		// 			foreach ($searchItemArray as $searchItem){
		// 				$pos = stripos($strSubject, $searchItem);	// search case-insensitive instance of search item
		// 				if ($pos !== false)
		// 					return str_ireplace($searchItem, "<span class='hghLight'>".$searchItem."</span>", $strSubject);
		// 			}
		// 		}

		// 		return str_ireplace($strSearch, "<span class='hghLight'>".$strSearch."</span>", $strSubject);

		// code pulled from PHP.net
		$needle = $strSearch;
		$haystack =	$strSubject;
		$ind = stripos($haystack, $needle);
		$len = strlen($needle ?? '');
		if($ind !== false){
			return substr($haystack, 0, $ind) . "<span class='hghLight bld'>" . substr($haystack, $ind, $len) . "</span>" .
					highlightResults($needle, substr($haystack, $ind + $len));
		} else return $haystack;
	}

	/**
	 * Wrapper for question labels in forms
	 * @param $t
	 */
	function questionWrap($t) {
		return '<b>'.$t.'</b>';
	}

	function errorAlert( $text, $action='window.history.go(-1);', $mode=1 ) {
		$text = nl2br( $text );
		$text = addslashes( $text  ?? '');
		$text = strip_tags( $text );

		switch ( $mode ) {
			case 2:
				echo "<script>$action</script> \n";
				break;

			case 1:
			default:
				echo "<script>alert('$text'); $action</script> \n";
				break;
		}

		exit;
	}

	/**
	 * wpg - call this function if someone has restricted access to something; right now we are redirecting to logout page
	 *
	 */
	function restrictedAccess() {
		// we want to call the last visited function on the restricted pages (we will ignore the public pages)
		getVisitedPage();

		QApplication::Redirect(__SUBDIRECTORY__.'/logout.php');
	}

	/**
	 * wpg - We just need to make sure the user is logged in
	 *
	 * @param int $accessKey
	 */
	function checkAccess($accessKey = '') {
		// we want to call the last visited function on the restricted pages (we will ignore the public pages)
		getVisitedPage();

		//@BL if the page just requires the user to be logged in then check
		if ($accessKey == '' && defined('__LOGGED_USER_ID__'))
			return true;

		// first if the user doesn't even have access to anything then no go
		if (!defined('__USER_ACL__')) {
			errorAlert("FM2013 - Your session has expired or you do not have permissions to access this application yet.  Please try logging in again. Err:acl_vk_no", "document.location.href='".__URLROOT__."/login.php'");
			return false;
		}

		$objTypeUserAccessArray = unserialize(__USER_ACL__ ?? '');	// we need to parse out the array from the access constant

		// we will check each user login access type
		if ($objTypeUserAccessArray) foreach ($objTypeUserAccessArray as $objTypeUserAccess) {
			//@BL if user access matches the passed access key then let them in
			//				if ($objTypeUserAccess->Id == $accessKey) {
			//					return true; // user has access
			//				}


			//------------ user access switch
			if ($objTypeUserAccess->Id == QSessionDB::get(__SESSION_PREFIX__.'__ACX__') && $objTypeUserAccess->Id == $accessKey) {
				return true; // user has access
			}
		}

		return false;
	}


	/**
	 *
	 *
	 */
	function switchItemsPerPage() {
		$intItemsPerPage = QApplication::QueryString('itemsPerPage');	// get the navigation preference the user is requesting
		if ($intItemsPerPage != '') {
			QSessionDB::set("__ITEMS_PER_PAGE__", $intItemsPerPage);
			// wpg - removed redirect to last visited page since the samples needing processing notification was causing problems with this
			//				$redirectBack = QSessionDB::get("__LAST_VISITED_PAGE__");
			//				if ($redirectBack)
			//					QApplication::Redirect($redirectBack);
			//				else
			QApplication::Redirect('?');
		}
	}

	function checkItemsPerPage() {
		// if the items per page is already defined then just return it
		if (defined('__ITEMS_PER_PAGE__')) return __ITEMS_PER_PAGE__;

		$intItemsPerPage = QSessionDB::get("__ITEMS_PER_PAGE__");
		if ($intItemsPerPage != '') {
			define('__ITEMS_PER_PAGE__', $intItemsPerPage);	// specify the number of list items to show for the user
		}
		else
			define('__ITEMS_PER_PAGE__', 25);	// specify the number of list items to show for the user by default
	}

	////////////////
	// Include Files
	////////////////
	// TODO: Include any other include files (if any) here...
	require(__QCODO_CORE__ . '/QSessionDB.class.php');

	require_once(__QCODO_CORE__ . '/crypt/StonePhpSafeCrypt.php');

	///////////////////////
	// Setup Error Handling
	///////////////////////
	/*
	 * Set Error/Exception Handling to the default
	* Qcodo HandleError and HandlException functions
	* (Only in non CLI mode)
	*
	* Feel free to change, if needed, to your own
	* custom error handling script(s).
	*/
		// if (array_key_exists('SERVER_PROTOCOL', $_SERVER)) {
		// 	set_error_handler('QcodoHandleError');
		// 	set_exception_handler('QcodoHandleException');	//QcodoHandleException_pg for custom
		// }


	////////////////////////////////////////////////
	// Initialize the Application and DB Connections
	////////////////////////////////////////////////
	QApplication::Initialize();
	QApplication::InitializeDatabaseConnections();


	/////////////////////////////
	// Start Session Handler (if required)
	/////////////////////////////
	//session_start();
	// wpg - note for file sessions (not database) the
	//QSessionDB::SetMaxMinutes(240); // overrides the default max minutes setting of 120 minutes
		QSessionDB::SetMaxHours(16); 	//QSessionDB::SetMaxHours(0.5); 	// if using database sessions
		QSessionDB::Initialize();

	// check to see if the user is switching the items per page and set the items per page
	switchItemsPerPage();
	checkItemsPerPage();
	$strItemsPerPage = "";
	$itemsPerPageArray = array(10, 25, 50, 100, 1000);
	$strItemsPerPage = "
			<div style='padding-top:5px;' class='sm'>Set items/page
			";
	foreach ($itemsPerPageArray as $value) {
		$selectedIPP = "";
		if ($value == checkItemsPerPage()) $strItemsPerPage .= "<a href='?itemsPerPage=".$value."' class='paginator_selected_page'>".$value."</a>";
		else $strItemsPerPage .= "<a href='?itemsPerPage=".$value."' class='paginator_page'>".$value."</a>";

		$strItemsPerPage .= ' ';
	}
	$strItemsPerPage .=
	"
			</div>
			";

	/**
	 * If someone isn't logged in and they try to access a restricted page, save the page address
	 * which will be used to redirect to once they login.
	 * @return unknown_type
	 */
	function getVisitedPage(){
		// as long as we are not tracking a page then get it
		// if (!defined('__NO_VISIT_TRACK__')) {
		// 	// we need to get the last page visited so we can redirect back to it once we have switched items per page setting
		// 	//if ("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] != __APP_DOMAIN__."/logout.php")
		// 	QSessionDB::set("__LAST_VISITED_PAGE__", "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		// }
	}

	// finds out what access the user has selected
	function accessMenuSel($access) {
		// if the selected access matches the menu item then highlight it
		if (defined('__SEL_ACCESS_MENU__') && $access == __SEL_ACCESS_MENU__) return 'active';
	}

	// centralized access control to easily see which forms users are able to access
	// argument is the script name we are wanting to access
	function ACL_Run($script=''){
		define('__ACCESSED_CONTROLLED_SCRIPT__',$script);

		// for Freezer admin
		if(checkAccess(8)) {
			require_once(__INCLUDES__ . '/acl-8.php');
			exit;
		}

		// for basic view-only users...
		if (checkAccess(13)){
			require_once(__INCLUDES__ . '/acl-13.php');
			exit;
		}

		exit;	// stop any other activities if we call this function
	}

	define('__PAGINATION_OPTIONS__', '&nbsp;&nbsp;'.$strItemsPerPage);

	//////////////////////////////////////////////
	// Setup Internationalization and Localization (if applicable)
	// Note, this is where you would implement code to do Language Setting discovery, as well, for example:
	// * Checking against $_GET['language_code']
	// * checking against session (example provided below)
	// * Checking the URL
	// * etc.
	// TODO: options to do this are left to the developer
	//////////////////////////////////////////////
	if (isset($_SESSION)) {
		if (array_key_exists('country_code', $_SESSION))
			QApplication::$CountryCode = $_SESSION['country_code'];
		if (array_key_exists('language_code', $_SESSION))
			QApplication::$LanguageCode = $_SESSION['language_code'];
	}

	// Initialize I18n if QApplication::$LanguageCode is set
	if (QApplication::$LanguageCode)
		QI18n::Initialize();


	// enable or disable demo mode
	$strDemoMode = QApplication::QueryString('demoMode');	// on or off settings
	// set demo mode
	if ($strDemoMode=='on'){
		QSessionDB::set(__SESSION_PREFIX__.'DEMO_MODE__',true);
		QSessionDB::set('error', 'Enabling demo mode');
		header("Location: ".__SUBDIRECTORY__."/");
		exit;
	}
	if ($strDemoMode=='off') {
		QSessionDB::Delete(__SESSION_PREFIX__.'DEMO_MODE__');
		QSessionDB::set('error', 'Disabling demo mode');
		header("Location: ".__SUBDIRECTORY__."/");
		exit;
	}
	// if we are in demo mode then go on
	if (QSessionDB::get(__SESSION_PREFIX__.'DEMO_MODE__'))
		define ('__DEMO_MODE__', true);

	if (QSessionDB::get(__SESSION_PREFIX__.'LoggedInUserObj')) {
		$objUser = unserialize(QSessionDB::get(__SESSION_PREFIX__.'LoggedInUserObj') ?? '');

		// if the user is logged in then set access
		if ($objUser) {
			define ('__LOGGED_USER_ID__', $objUser->Userid);
			//@BL might as well save the user name to a constant for later use
			define('__LOGGED_USER_NAME__', $objUser->Firstname." ".$objUser->Lastname);

			//@BL might as well save the username to a constant for later use
			define('__LOGGED_USERNAME__', $objUser->Username);

			$userAccess = $strUserAccessMenu = '';
			// find out what the user access rights are
			$objLoginArray = TypeUserAccess::LoadArrayByUserAsAcl(__LOGGED_USER_ID__);

			if ($objLoginArray) {
				$userAccess = serialize($objLoginArray);
				define ('__USER_ACL__', $userAccess);	// specifies the access that is allowed for the user
			}
			else {
				print 'You are missing permissions'; exit;
			}


			// show the user access points and allow the user to choose which one they want

			$strUserAccessMenu =  '<br/><br/><h3>User access</h3>';
			$admin = false;
			// check to see if we are switching user access
			$strAcx = QApplication::QueryString('acx');

			// we will check each user login staff type matches the page or function access
			foreach ($objLoginArray as $objTypeUserAccess) {
				// only concern ourselves with freezer admin user access types
				if ($objTypeUserAccess->Id == 8 || $objTypeUserAccess->Id == 13) {
					// we will only build the demo mode switcher if we are an admin
					// 						if ($objTypeUserAccess->Id == 4)
					// 							$admin=true;

					// if the user is first logging in we default their login to the first login access
					if (QSessionDB::get(__SESSION_PREFIX__.'__ACX__') == "") {
						QSessionDB::set(__SESSION_PREFIX__.'__ACX__', $objTypeUserAccess->Id);
						define('__SEL_ACCESS_MENU__', QSessionDB::get(__SESSION_PREFIX__.'__ACX__'));
					}

					// switch the user access if requested
					// else we just build the menu list
					if ($strAcx == $objTypeUserAccess->Id) {
						QSessionDB::set(__SESSION_PREFIX__.'__ACX__', $strAcx);	// save access pref
						if (!defined('__SEL_ACCESS_MENU__'))
							define('__SEL_ACCESS_MENU__', QSessionDB::get(__SESSION_PREFIX__.'__ACX__'));

						QSessionDB::set('error', 'You have changed your access');
						header("Location: ".__SUBDIRECTORY__."/");
						exit;
					}
					elseif (!$strAcx) {
						if (!defined('__SEL_ACCESS_MENU__'))
							define('__SEL_ACCESS_MENU__', QSessionDB::get(__SESSION_PREFIX__.'__ACX__'));
					}

					$strUserAccessMenu .= '<a href="?acx='.$objTypeUserAccess->Id.'" id="mmI" class="'.accessMenuSel($objTypeUserAccess->Id).'" title="Change your access">'.$objTypeUserAccess->Name.'</a>';
				}
			}
		}
		else QSessionDB::set('error', "Sorry, you do not have access to the application yet.  Go see Patrick about that.");

		// set a constant to hold the use access menu that will be used in the header script
		if ($admin) {
			$dmOff = $dmOn = '';
			// show demo mode enabled or disabled
			if (defined('__DEMO_MODE__')) {
				$dmOn = 'active';
			}
			else {
				$dmOff = 'active';
			}
			// add demo mode links
			$strUserAccessMenu .= '<br/><br/><h3>Demo Mode</h3><a href="?demoMode=on" id="dmI" class="'.$dmOn.'" title="Turn on demo mode">Demo On</a>';
			$strUserAccessMenu .= '<a href="?demoMode=off" id="mmI" class="'.$dmOff.'" title="Turn off demo mode">Demo Off</a>';

		}
		define('__strUserAccessMenu__', $strUserAccessMenu);
	}

	define('_strFormCabinetFreezerView_', 'Freezers');
	define('_strFormFreezerML_', 'Maintenance Logs');
	define('_strFormRacks_', 'Racks');
	define('_strFormBoxes_', 'Boxes');
	define('_strFormMoveRack_', 'Relocate Rack');
	define('_strFormTypesOfFreezer_', 'Freezers');
	define('_strFormTypesOfBoxes_', 'Types of Box');
	define('_strFormTypesOfRack_', 'Types of Rack');
	define('_strFormTypesOfSample_', 'Types of Sample');
	define('_strFormStudyProject_', 'Studies/Projects');
	define('_strFormFindSamples_', 'Find Samples');
	define('_strFormSampleSelection_', 'Sample Selection');
	define('_strFormSampleConsent_', 'Sample Consents');
	define('_strFormReadme_', 'Managing the Freezers');
	define('_strFormSamples_', 'Samples');
	define('_strFormSampleHistoryLog_', 'Sample History Log');
	define('_strFormSamplePull_', 'Sample Pull');
	define('_strFormBoxHistoryLog_', 'Box History Log');
	define('_strFormSamplesLeg_', 'Legacy frz_inventory table (samples)');
	define('_strFormLNTanks_', 'Liquid Nitrogen tank log');
	define('_strFormCO2Tanks_', 'CO2 tank log');
	define('_strFormLNTankStatus_', 'Liquid Nitrogen tank status');
	define('_strFormActionLogs_', 'Action Logs');

	/**
	 * @abstract General class to handle all session related activities for the application 
	 * so we don't have to worry about naming or renaming of sessions.
	 */
	class FM2013Session {
		// rack ID selected to move boxes to =__selectRackPushBoxes__
		public static $sessionsArray = array(
			1=>"__selectRackPushBoxes__",
			2=>"__sampleSelection__"
		);
		public static function DeleteSession($index){
			QSessionDB::Delete(__SESSION_PREFIX__.FM2013Session::$sessionsArray[$index]);
		}
		public static function DeleteSelectionSessions(){
			foreach (FM2013Session::$sessionsArray as $key=>$val){
				FM2013Session::DeleteSession($key);
			}
		}
		public static function GetSession($index){
			return QSessionDB::get(__SESSION_PREFIX__.FM2013Session::$sessionsArray[$index]);
		}
		public static function SetSession($index,$value){
			QSessionDB::set(__SESSION_PREFIX__.FM2013Session::$sessionsArray[$index],$value);
		}
	}
}
?>
