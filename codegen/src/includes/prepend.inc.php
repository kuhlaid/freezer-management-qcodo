<?php
/**
 * @abstract Default Qcodo 'main' script for code generation.
 * @author w. Patrick Gale
 * 
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
	////////////////
	// Include Files
	////////////////
	// TODO: Include any other include files (if any) here...
	require(__QCODO_CORE__ . '/QSession.class.php');

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
	//QSession::SetMaxMinutes(240); // overrides the default max minutes setting of 120 minutes
		QSession::SetMaxHours(16); 	//QSession::SetMaxHours(0.5); 	// if using database sessions
		QSession::Initialize();

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


	define('_strFormCabinetFreezerView_', 'Freezers');
	define('_strFormFreezerML_', 'Maintenance Logs');
	define('_strFormRacks_', 'Racks');
	define('_strFormBoxes_', 'Boxes');
	define('_strFormMoveRack_', 'Relocate Rack');
	define('_strFormTypesOfFreezer_', 'Freezers');
	define('_strFormTypesOfBoxes_', 'Types of Box');
	define('_strFormTypesOfRack_', 'Types of Rack');
	define('_strFormTypesOfSample_', 'Types of Sample');
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

}
?>
