<?php
	/**
	 * This abstract class should never be instantiated.  It contains static methods,
	 * variables and constants to be used throughout the application.
	 *
	 * The static method "Initialize" should be called at the begin of the script by
	 * prepend.inc.
	 * 
	 * wpg - needed to change references from QApplication to QApplicationBase since QApplication is not defined at this point.
	 * 
	 */
	abstract class QApplicationBase extends QBaseClass {
		//////////////////////////
		// Public Static Variables
		//////////////////////////

		/**
		 * Internal bitmask signifying which BrowserType the user is using
		 * Use the QApplicationBase::IsBrowser() method to do browser checking
		 *
		 * @var integer BrowserType
		 */
		protected static $BrowserType = QBrowserType::Unsupported;

		/**
		 * Definition of CacheControl for the HTTP header.  In general, it is
		 * recommended to keep this as "private".  But this can/should be overriden
		 * for file/scripts that have special caching requirements (e.g. dynamically
		 * created images like QImageLabel).
		 *
		 * @var string CacheControl
		 */
		public static $CacheControl = 'private';

		/**
		 * Path of the "web root" or "document root" of the web server
		 * Like "/home/www/htdocs" on Linux/Unix or "c:\inetpub\wwwroot" on Windows
		 *
		 * @var string DocumentRoot
		 */
		public static $DocumentRoot;

		/**
		 * Whether or not we are currently trying to Process the Output of the page.
		 * Used by the OutputPage PHP output_buffering handler.  As of PHP 5.2,
		 * this gets called whenever ob_get_contents() is called.  Because some
		 * classes like QFormBase utilizes ob_get_contents() to perform template
		 * evaluation without wanting to actually perform OutputPage, this flag
		 * can be set/modified by QFormBase::EvaluateTemplate accordingly to
		 * prevent OutputPage from executing.
		 *
		 * @var boolean ProcessOutput
		 */
		public static $ProcessOutput = true;

		/**
		 * Full path of the actual PHP script being run
		 * Like "/home/www/htdocs/folder/script.php" on Linux/Unix
		 * or "c:\inetpub\wwwroot" on Windows
		 *
		 * @var string ScriptFilename
		 */
		public static $ScriptFilename;

		/**
		 * Web-relative path of the actual PHP script being run
		 * So for "http://www.domain.com/folder/script.php",
		 * QApplicationBase::$ScriptName would be "/folder/script.php"
		 *
		 * @var string ScriptName
		 */
		public static $ScriptName;

		/**
		 * Extended Path Information after the script URL (if applicable)
		 * So for "http://www.domain.com/folder/script.php/15/225"
		 * QApplicationBase::$PathInfo would be "/15/255"
		 *
		 * @var string PathInfo
		 */
		public static $PathInfo;

		/**
		 * Query String after the script URL (if applicable)
		 * So for "http://www.domain.com/folder/script.php?item=15&value=22"
		 * QApplicationBase::$QueryString would be "item=15&value=22"
		 *
		 * @var string QueryString
		 */
		public static $QueryString;

		/**
		 * The full Request URI that was requested
		 * So for "http://www.domain.com/folder/script.php/15/25/?item=15&value=22"
		 * QApplicationBase::$RequestUri would be "/folder/script.php/15/25/?item=15&value=22"
		 *
		 * @var string RequestUri
		 */
		public static $RequestUri;

		/**
		 * The IP address of the server running the script/PHP application
		 * This is either the LOCAL_ADDR or the SERVER_ADDR server constant, depending
		 * on the server type, OS and configuration.
		 *
		 * @var string ServerAddress
		 */
		public static $ServerAddress;

		/**
		 * The encoding type for the application (e.g. UTF-8, ISO-8859-1, etc.)
		 *
		 * @var string EncodingType
		 */
		public static $EncodingType = 'UTF-8';

		/**
		 * An array of Database objects, as initialized by QApplicationBase::InitializeDatabaseConnections()
		 *
		 * @var DatabaseBase[] Database
		 */
		public static $Database;

		/**
		 * A flag to indicate whether or not this script is run as a CLI (Command Line Interface)
		 *
		 * @var boolean CliMode
		 */
		public static $CliMode;

		/**
		 * Class File Array - used by QApplicationBase::AutoLoad to more quickly load
		 * core class objects without making a file_exists call.
		 *
		 * @var array ClassFile
		 */
		public static $ClassFile;

		/**
		 * Preloaded Class File Array - used by QApplicationBase::Initialize to load
		 * any core class objects during Initailize()
		 *
		 * @var array ClassFile
		 */
		public static $PreloadedClassFile;

		/**
		 * The QRequestMode enumerated value for the current request mode
		 *
		 * @var string RequestMode
		 */
		public static $RequestMode;

		/**
		 * 2-letter country code to set for internationalization and localization
		 * (e.g. us, uk, jp)
		 *
		 * @var string CountryCode
		 */
		public static $CountryCode;

		/**
		 * 2-letter language code to set for internationalization and localization
		 * (e.g. en, jp, etc.)
		 *
		 * @var string LanguageCode
		 */
		public static $LanguageCode;

		/**
		 * The instance of the active QI18n object (which contains translation strings), if any.
		 *
		 * @var QI18n $LanguageObject
		 */
		public static $LanguageObject;

		////////////////////////
		// Public Overrides
		////////////////////////
		/**
		 * This faux constructor method throws a caller exception.
		 * The Application object should never be instantiated, and this constructor
		 * override simply guarantees it.
		 *
		 * @return void
		 */
		public final function __construct() {
			throw new QCallerException('Application should never be instantiated.  All methods and variables are publically statically accessible.');
		}


		////////////////////////
		// Public Static Methods
		////////////////////////

		/**
		 * This should be the first call to initialize all the static variables
		 * The application object also has static methods that are miscellaneous web
		 * development utilities, etc.
		 *
		 * @return void
		 */
		public static function Initialize() {
			// Are we running as CLI?
			if (PHP_SAPI == 'cli')
				QApplicationBase::$CliMode = true;
			else
				QApplicationBase::$CliMode = false;

			// Setup Server Address
			if (array_key_exists('LOCAL_ADDR', $_SERVER))
				QApplicationBase::$ServerAddress = $_SERVER['LOCAL_ADDR'];
			else if (array_key_exists('SERVER_ADDR', $_SERVER))
				QApplicationBase::$ServerAddress = $_SERVER['SERVER_ADDR'];

			// Setup ScriptFilename and ScriptName
			QApplicationBase::$ScriptFilename = $_SERVER['SCRIPT_FILENAME'];
			QApplicationBase::$ScriptName = $_SERVER['SCRIPT_NAME'];
			
			// Ensure both are set, or we'll have to abort
			if ((!QApplicationBase::$ScriptFilename) || (!QApplicationBase::$ScriptName)) {
				throw new Exception('Error on QApplicationBase::Initialize() - ScriptFilename or ScriptName was not set');
			}

			// Setup PathInfo and QueryString (if applicable)
			QApplicationBase::$PathInfo = array_key_exists('PATH_INFO', $_SERVER) ? trim($_SERVER['PATH_INFO'] ?? '') : null;
			QApplicationBase::$QueryString = array_key_exists('QUERY_STRING', $_SERVER) ? $_SERVER['QUERY_STRING'] : null;

			// Setup RequestUri
			if (defined('__URL_REWRITE__')) {
				switch (strtolower(__URL_REWRITE__)) {
					case 'apache':
						QApplicationBase::$RequestUri = htmlentities($_SERVER['REQUEST_URI'] ?? ''); // clean any suspicious characters (Jan. 2019 - wpg)
						break;

					case 'none':
						QApplicationBase::$RequestUri = sprintf('%s%s%s',
							QApplication::$ScriptName, QApplicationBase::$PathInfo,
							(QApplicationBase::$QueryString) ? sprintf('?%s', QApplicationBase::$QueryString) : null);
						break;

					default:
						throw new Exception('Invalid URL Rewrite type: ' . __URL_REWRITE__);
				}
			} else {
				QApplicationBase::$RequestUri = sprintf('%s%s%s',
					QApplicationBase::$ScriptName, QApplicationBase::$PathInfo,
					(QApplicationBase::$QueryString) ? sprintf('?%s', QApplicationBase::$QueryString) : null);
			}

			// Setup DocumentRoot
			QApplicationBase::$DocumentRoot = trim(__DOCROOT__ ?? '');

			// Setup Browser Type
			if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
				$strUserAgent = trim(strtolower($_SERVER['HTTP_USER_AGENT'] ?? '') ?? '');

				// INTERNET EXPLORER (supporting versions 6.0 and 7.0)
				if (strpos($strUserAgent, 'msie') !== false) {
					QApplicationBase::$BrowserType = QBrowserType::InternetExplorer;

					if (strpos($strUserAgent, 'msie 6.0') !== false)
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::InternetExplorer_6_0;
					else if (strpos($strUserAgent, 'msie 7.0') !== false)
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::InternetExplorer_7_0;
					else
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::Unsupported;

				// FIREFOX (supporting versions 1.0, 1.5 and 2.0)
				} else if ((strpos($strUserAgent, 'firefox') !== false) || (strpos($strUserAgent, 'iceweasel') !== false)) {
					QApplicationBase::$BrowserType = QBrowserType::Firefox;
					$strUserAgent = str_replace('iceweasel/', 'firefox/', $strUserAgent);

					if (strpos($strUserAgent, 'firefox/1.0') !== false)
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::Firefox_1_0;
					else if (strpos($strUserAgent, 'firefox/1.5') !== false)
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::Firefox_1_5;
					else if (strpos($strUserAgent, 'firefox/2.0') !== false)
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::Firefox_2_0;
					else
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::Unsupported;

				// SAFARI (supporting version 2.0 and eventually 3.0)
				} else if (strpos($strUserAgent, 'safari') !== false) {
					QApplicationBase::$BrowserType = QBrowserType::Safari;

					if (strpos($strUserAgent, 'safari/41') !== false)
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::Safari_2_0;
					else if (strpos($strUserAgent, 'safari/52') !== false)
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::Safari_3_0;
					else
						QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::Unsupported;

				// COMPLETELY UNSUPPORTED
				} else
					QApplicationBase::$BrowserType = QBrowserType::Unsupported;

				// MACINTOSH?
				if (strpos($strUserAgent, 'macintosh') !== false)
					QApplicationBase::$BrowserType = QApplicationBase::$BrowserType | QBrowserType::Macintosh;
			}

			// Preload Class Files
			foreach (QApplicationBase::$PreloadedClassFile as $strClassFile)
				require($strClassFile);
		}

		public static function IsBrowser($intBrowserType) {
			return ($intBrowserType & QApplicationBase::$BrowserType);
		}

		/**
		 * This call will initialize the database connection(s) as defined by
		 * the constants DB_CONNECTION_X, where "X" is the index number of a
		 * particular database connection.
		 *
		 * @return void
		 */
		public static function InitializeDatabaseConnections() {
			for ($intIndex = 0; $intIndex <= 9; $intIndex++) {
				$strConstantName = sprintf('DB_CONNECTION_%s', $intIndex);

				if (defined($strConstantName)) {
					// Expected Keys to be Set
					$strExpectedKeys = array(
						'adapter', 'server', 'port', 'database',
						'username', 'password', 'profiling'
					);

					// Lookup the Serialized Array from the DB_CONFIG constants and unserialize it
					$strSerialArray = constant($strConstantName);
					$objConfigArray = unserialize($strSerialArray ?? '');

					// Set All Expected Keys
					foreach ($strExpectedKeys as $strExpectedKey)
						if (!array_key_exists($strExpectedKey, $objConfigArray))
							$objConfigArray[$strExpectedKey] = null;

					if (!$objConfigArray['adapter'])
						throw new Exception('No Adapter Defined for ' . $strConstantName . ': ' . var_export($objConfigArray, true));

					if (!$objConfigArray['server'])
						throw new Exception('No Server Defined for ' . $strConstantName . ': ' . constant($strConstantName));

					$strDatabaseType = 'Q' . $objConfigArray['adapter'] . 'Database';
					if (!class_exists($strDatabaseType)) {
						$strDatabaseAdapter = sprintf('%s/database/%s.class.php', __QCODO_CORE__, $strDatabaseType);
						if (!file_exists($strDatabaseAdapter))
							throw new Exception('Database Type is not valid: ' . $objConfigArray['adapter']);
						require($strDatabaseAdapter);
					}

					QApplicationBase::$Database[$intIndex] = new $strDatabaseType($intIndex, $objConfigArray);
				}
			}
		}

		/**
		 * This is called by the PHP5 Autoloader.  This static method can be overridden.
		 *
		 * @return void
		 */
		public static function Autoload($strClassName) {
			if (array_key_exists($strClassName, QApplicationBase::$ClassFile)) {
				require(QApplicationBase::$ClassFile[$strClassName]);
			} else if (file_exists($strFilePath = sprintf('%s/%s.class.php', __DATA_CLASSES__, $strClassName))) {
				require($strFilePath);
			} else if (file_exists($strFilePath = sprintf('%s/qform/%s.class.php', __QCODO__, $strClassName))) {
				require($strFilePath);
			} else if ((substr($strClassName, 0, 6) == 'QQNode') && file_exists($strFilePath = sprintf('%s/%s.class.php', __DATA_CLASSES__, substr($strClassName, 6)))) {
				require($strFilePath);
			} else if ((substr($strClassName, 0, 22) == 'QQReverseReferenceNode') && file_exists($strFilePath = sprintf('%s/%s.class.php', __DATA_CLASSES__, substr($strClassName, 22)))) {
				require($strFilePath);
			} else if (file_exists($strFilePath = sprintf('%s/%s.class.php', __INCLUDES__, $strClassName))) {
				require($strFilePath);
			}
		}

		/**
		 * Temprorarily overrides the default error handling mechanism.  Remember to call
		 * RestoreErrorHandler to restore the error handler back to the default.
		 *
		 * @param string $strName the name of the new error handler function, or NULL if none
		 * @param integer $intLevel if a error handler function is defined, then the new error reporting level (if any)
		 */
		public static function SetErrorHandler($strName, $intLevel = null) {
			if (!is_null(QApplicationBase::$intStoredErrorLevel))
				throw new QCallerException('Error handler is already currently overridden.  Cannot override twice.  Call RestoreErrorHandler before calling SetErrorHandler again.');
			if (!$strName) {
				// No Error Handling is wanted -- simulate a "On Error, Resume" type of functionality
				set_error_handler('QcodoHandleError', 0);
				QApplicationBase::$intStoredErrorLevel = error_reporting(0);
			} else {
				set_error_handler($strName, $intLevel ?? 0);
				QApplicationBase::$intStoredErrorLevel = -1;
			}
		}

		/**
		 * Restores the temporarily overridden default error handling mechanism back to the default.
		 */
		public static function RestoreErrorHandler() {
			if (is_null(QApplicationBase::$intStoredErrorLevel))
				throw new QCallerException('Error handler is not currently overridden.  Cannot reset something that was never overridden.');
			if (QApplicationBase::$intStoredErrorLevel != -1)
				error_reporting(QApplicationBase::$intStoredErrorLevel);
			restore_error_handler();
			QApplicationBase::$intStoredErrorLevel = null;
		}
		private static $intStoredErrorLevel = null;

		/**
		 * Same as mkdir but correctly implements directory recursion.
		 * At its core, it will use the php MKDIR function.
		 * 
		 * This method does no special error handling.  If you want to use special error handlers,
		 * be sure to set that up BEFORE calling MakeDirectory.
		 *
		 * @param string $strPath actual path of the directoy you want created
		 * @param integer $intMode optional mode
		 * @return boolean the return flag from mkdir
		 */
		public static function MakeDirectory($strPath, $intMode = null) {
			if (is_dir($strPath))
				// Directory Already Exists
				return true;

			// Check to make sure the parent(s) exist, or create if not
			if (!QApplicationBase::MakeDirectory(dirname($strPath), $intMode))
				return false;

			// Create the current node/directory, and return its result
			$blnReturn = mkdir($strPath);

			if ($blnReturn && !is_null($intMode)) {
				// Manually CHMOD to $intMode (if applicable)
				// mkdir doesn't do it for mac, and this will error on windows
				// Therefore, ignore any errors that creep up
				QApplicationBase::SetErrorHandler(null);
				chmod($strPath, $intMode);
				QApplicationBase::RestoreErrorHandler();
			}

			return $blnReturn;
		}


		/**
		 * This will redirect the user to a new web location.  This can be a relative or absolute web path, or it
		 * can be an entire URL.
		 *
		 * @return void
		 */
		public static function Redirect($strLocation) {
			// Clear the output buffer (if any)
			ob_clean();

			if (QApplicationBase::$RequestMode == QRequestMode::Ajax) {
				// AJAX-based Response

				// Response is in XML Format
				header('Content-Type: text/xml');

				// Output it and update render state
				$strLocation = 'document.location="' . $strLocation . '"';
				$strLocation = QString::XmlEscape($strLocation);
				print('<?xml version="1.0"?><response><controls/><commands><command>' . $strLocation . '</command></commands></response>');

			} else {
				// Was "DOCUMENT_ROOT" set?
				if (array_key_exists('DOCUMENT_ROOT', $_SERVER) && ($_SERVER['DOCUMENT_ROOT'])) {
					// If so, we're likley using PHP as a Plugin/Module
					// Use 'header' to redirect
					header(sprintf('Location: %s', $strLocation));
				} else {
					// We're likely using this as a CGI
					// Use JavaScript to redirect
					printf('<script>document.location = "%s";</script>', $strLocation);
				}
			}

			// End the Response Script
			exit();
		}


		/**
		 * This will close the window.  It will immediately end processing of the rest of the script.
		 *
		 * @return void
		 */
		public static function CloseWindow() {
			// Clear the output buffer (if any)
			ob_clean();

			if (QApplicationBase::$RequestMode == QRequestMode::Ajax) {
				// AJAX-based Response

				// Response is in XML Format
				header('Content-Type: text/xml');

				// OUtput it and update render state
				_p('<?xml version="1.0"?><response><controls/><commands><command>window.close();</command></commands></response>', false);

			} else {
				// Use JavaScript to close
				_p('<script>window.close();</script>', false);
			}

			// End the Response Script
			exit();
		}

		/**
		 * Gets the value of the QueryString item $strItem.  Will return NULL if it doesn't exist.
		 *
		 * @return string
		 */
		public static function QueryString($strItem) {
			if (array_key_exists($strItem, $_GET))
				return $_GET[$strItem];
			else
				return null;
		}

		/**
		 * Generates a valid URL Query String based on values in the global $_GET
		 * @return string
		 */
		public static function GenerateQueryString() {
			if (count($_GET)) {
				$strToReturn = '';
				foreach ($_GET as $strKey => $strValue)
					$strToReturn .= '&' . urlencode($strKey) . '=' . urlencode($strValue);
				return '?' . substr($strToReturn, 1);
			} else
				return '';
		}

		/**
		 * By default, this is used by the codegen and form drafts to do a quick check
		 * on the ALLOW_REMOTE_ADMIN constant (as defined in configuration.inc.php).  If enabled,
		 * then anyone can access the page.  If disabled, only "localhost" can access the page.
		 * 
		 * If you want to run a script that should be accessible regardless of
		 * ALLOW_REMOTE_ADMIN, simply remove the CheckRemoteAdmin() method call from that script.
		 *
		 * @param string $strFile script filename doing the check
		 * @param integer $intLine line number of the check call
		 */
		public static function CheckRemoteAdmin() {
			// Allow Remote?
			if (ALLOW_REMOTE_ADMIN === true)
				return;

			// Are we localhost?
			if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
				return;

			// Are we the correct IP?
			if (is_string(ALLOW_REMOTE_ADMIN))
				foreach (explode(',', ALLOW_REMOTE_ADMIN) as $strIpAddress)
					if ($_SERVER['REMOTE_ADDR'] == trim($strIpAddress ?? ''))
						return;

			// If we're here -- then we're not allowed to access.  Present the Error/Issue.
			header($_SERVER['SERVER_PROTOCOL'] . ' 401 Access Denied');
			header('Status: 401 Access Denied', true);

			throw new QRemoteAdminDeniedException();
		}

		/**
		 * Gets the value of the PathInfo item at index $intIndex.  Will return NULL if it doesn't exist.
		 *
		 * The way PathInfo index is determined is, for example, given a URL '/folder/page.php/id/15/blue',
		 * QApplicationBase::PathInfo(0) will return 'id'
		 * QApplicationBase::PathInfo(1) will return '15'
		 * QApplicationBase::PathInfo(2) will return 'blue'
		 *
		 * @return void
		 */
		public static function PathInfo($intIndex) {
			// TODO: Cache PathInfo
			$strPathInfo = QApplicationBase::$PathInfo;
			
			// Remove Trailing '/'
			if (QString::FirstCharacter($strPathInfo) == '/')			
				$strPathInfo = substr($strPathInfo, 1);
			
			$strPathInfoArray = explode('/', $strPathInfo);

			if (array_key_exists($intIndex, $strPathInfoArray))
				return $strPathInfoArray[$intIndex];
			else
				return null;
		}
		
		public static $AlertMessageArray = array();
		public static $JavaScriptArray = array();
		public static $JavaScriptArrayHighPriority = array();

		public static $ErrorFlag = false;
		
		public static function DisplayAlert($strMessage) {
			array_push(QApplicationBase::$AlertMessageArray, $strMessage);
		}
		
		public static function ExecuteJavaScript($strJavaScript, $blnHighPriority = false) {
			if ($blnHighPriority)
				array_push(QApplicationBase::$JavaScriptArrayHighPriority, $strJavaScript);
			else
				array_push(QApplicationBase::$JavaScriptArray, $strJavaScript);
		}

		public static function OutputPage($strBuffer) {
			// If the ProcessOutput flag is set to false, simply return the buffer
			// without processing anything.
			if (!QApplicationBase::$ProcessOutput)
				return $strBuffer;

			if (QApplicationBase::$ErrorFlag) {
				return $strBuffer;
			} else {
				if (QApplicationBase::$RequestMode == QRequestMode::Ajax) {
					return trim($strBuffer ?? '');
				} else {
					// Update Cache-Control setting
					header('Cache-Control: ' . QApplicationBase::$CacheControl);

					$strScript = QApplicationBase::RenderJavaScript(false);

					if ($strScript)
						return sprintf('%s<script>%s</script>', $strBuffer, $strScript);

					return $strBuffer;
				}
			}
		}

		public static function RenderJavaScript($blnOutput = true) {
			$strScript = '';
			foreach (QApplicationBase::$AlertMessageArray as $strAlert) {
				$strAlert = addslashes($strAlert ?? '');
				$strScript .= sprintf('alert("%s"); ', $strAlert);
			}
			foreach (QApplicationBase::$JavaScriptArrayHighPriority as $strJavaScript) {
				$strJavaScript = trim($strJavaScript ?? '');
				if (QString::LastCharacter($strJavaScript) != ';')
					$strScript .= sprintf('%s; ', $strJavaScript);
				else
					$strScript .= sprintf('%s ', $strJavaScript);
			}
			foreach (QApplicationBase::$JavaScriptArray as $strJavaScript) {
				$strJavaScript = trim($strJavaScript ?? '');
				if (QString::LastCharacter($strJavaScript) != ';')
					$strScript .= sprintf('%s; ', $strJavaScript);
				else
					$strScript .= sprintf('%s ', $strJavaScript);
			}

			QApplicationBase::$AlertMessageArray = array();
			QApplicationBase::$JavaScriptArrayHighPriority = array();
			QApplicationBase::$JavaScriptArray = array();

			if ($strScript) {
				if ($blnOutput)
					_p($strScript, false);
				else
					return $strScript;
			} else
				return null;
		}

  		/**
		 * If LanguageCode is specified and QI18n::Initialize() has been called, then this
		 * will perform a translation of the given token for the specified Language Code and optional
		 * Country code.
		 *
		 * Otherwise, this will simply return the token as is.
		 * This method is also used by the global print-translated "_t" function.
		 *
		 * @param string $strToken
		 * @return string the Translated token (if applicable)
		 */
		public static function Translate($strToken) {
			if (QApplicationBase::$LanguageObject)
				return QApplicationBase::$LanguageObject->TranslateToken($strToken);
			else
				return $strToken;
		}

		/**
		 * Global/Central HtmlEntities command to perform the PHP equivalent of htmlentities.
		 * Feel free to override to specify encoding/quoting specific preferences (e.g. ENT_QUOTES/ENT_NOQUOTES, etc.)
		 * 
		 * This method is also used by the global print "_p" function.
		 *
		 * @param string $strText text string to perform html escaping
		 * @return string the html escaped string
		 */
		public static function HtmlEntities($strText) {
			return htmlentities($strText ?? '', ENT_COMPAT); 	// wpg - remove last argument (, QApplicationBase::$EncodingType) if there are crazy characters (notibly one of those Word characters that causes a bug in PHP)
		}

  		/**
		 * For development purposes, this static method outputs all the Application static variables
		 *
		 * @return void
		 */
		public static function VarDump() {
			_p('<div style="background-color: #cccccc; padding: 5px;"><b>Qcodo Settings</b><ul>', false);
			if (ini_get('magic_quotes_gpc') || ini_get('magic_quotes_runtime'))
				printf('<li><font color="red"><b>WARNING:</b> magic_quotes_gpc and magic_quotes_runtime need to be disabled</font>');

			printf('<li>QCODO_VERSION = "%s"</li>', QCODO_VERSION);
			printf('<li>__SUBDIRECTORY__ = "%s"</li>', __SUBDIRECTORY__);
			printf('<li>__VIRTUAL_DIRECTORY__ = "%s"</li>', __VIRTUAL_DIRECTORY__);
			printf('<li>__INCLUDES__ = "%s"</li>', __INCLUDES__);
			printf('<li>__QCODO_CORE__ = "%s"</li>', __QCODO_CORE__);
			printf('<li>ERROR_PAGE_PATH = "%s"</li>', ERROR_PAGE_PATH);
			printf('<li>PHP Include Path = "%s"</li>', get_include_path());
			printf('<li>QApplicationBase::$DocumentRoot = "%s"</li>', QApplicationBase::$DocumentRoot);
			printf('<li>QApplicationBase::$EncodingType = "%s"</li>', QApplicationBase::$EncodingType);
			printf('<li>QApplicationBase::$PathInfo = "%s"</li>', QApplicationBase::$PathInfo);
			printf('<li>QApplicationBase::$QueryString = "%s"</li>', QApplicationBase::$QueryString);
			printf('<li>QApplicationBase::$RequestUri = "%s"</li>', QApplicationBase::$RequestUri);
			printf('<li>QApplicationBase::$ScriptFilename = "%s"</li>', QApplicationBase::$ScriptFilename);
			printf('<li>QApplicationBase::$ScriptName = "%s"</li>', QApplicationBase::$ScriptName);
			printf('<li>QApplicationBase::$ServerAddress = "%s"</li>', QApplicationBase::$ServerAddress);

			if (QApplicationBase::$Database) foreach (QApplicationBase::$Database as $intKey => $objObject) {
				printf('<li>QApplicationBase::$Database[%s] = %s</li>', 
					$intKey,
					var_export(unserialize(constant('DB_CONNECTION_' . $intKey) ?? ''), true));
			}
			_p('</ul></div>', false);
		}
	}

	class QRequestMode {
		const Standard = 'Standard';
		const Ajax = 'Ajax';
	}

	class QBrowserType {
		const InternetExplorer = 1;
		const InternetExplorer_6_0 = 2;
		const InternetExplorer_7_0 = 4;

		const Firefox = 8;
		const Firefox_1_0 = 16;
		const Firefox_1_5 = 32;
		const Firefox_2_0 = 64;

		const Safari = 128;
		const Safari_2_0 = 256;
		const Safari_3_0 = 512;

		const Macintosh = 1024;

		const Unsupported = 2048;
	}
?>