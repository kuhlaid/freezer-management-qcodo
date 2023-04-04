<?php
define('__APPLICATION_NAME__', getenv('APPLICATION_NAME'));
define('__APPLICATION_TITLE__', getenv('APPLICATION_TITLE'));
define('__DB_ADAPTER__', getenv('DB_ADAPTER'));
define('__DB_NAME__', getenv('DB_NAME'));
define('__DB_PASSWORD__', getenv('DB_PASSWORD'));
define('__DB_SERVER__', getenv('DB_SERVER'));
define('__DB_PORT__', getenv('DB_PORT'));
define('__DB_USER__', getenv('DB_USER'));
define('__DOMAIN_URL__', getenv('DOMAIN_URL'));
define('__DOCROOT__', getenv('ROOT_DIR'));
define('__VERSION_Num__', getenv('VERSION_Num'));
define('__COOKIE_DOMAIN_HOST__', getenv('COOKIE_DOMAIN_HOST'));

define('MYSQL_CLIENT_SSL','');	// this is the mysqli.default_socket

	// wpg - database connection for storing data dictionary info
	define('DB_CONNECTION_1', serialize(array(
				'adapter' => __DB_ADAPTER__,
				'server'   => __DB_SERVER__,
				'port'     => __DB_PORT__,				
				'database' => __DB_NAME__,
				'username' => __DB_USER__,
				'password' => __DB_PASSWORD__,
				'dbschema' => '',
  				'profiling' => false)));
	
	define ('__VIRTUAL_DIRECTORY__', '');
	define ('__SUBDIRECTORY__', getenv('SUBDIRECTORY'));
	define ('__SESSION_PREFIX__', '_fm2013');	// used to define the session objects
	define ('__URLROOT__', __SUBDIRECTORY__);
	
	define ('ALLOW_REMOTE_ADMIN', true);
	define ('__URL_REWRITE__', 'none');

	define ('__INCLUDES__', __DOCROOT__ .  __SUBDIRECTORY__ . '/includes');
	define ('__RESOURCES__', __SUBDIRECTORY__ . '/resources');
	define ('__QCODO__', __DOCROOT__.'/_core_qcodo');
	define ('__QCOREBASE__', __QCODO__);
	define ('__ZENDGDATA_LIB__', __QCODO__.'/ZendGdata-1.11.2/library');
	define ('__APPLICATION_ROOT__',__QCODO__);	// needed for fck editor class code
	define ('__QCODO_URL__', '/_core_qcodo');
	define ('__QCODO_CORE__', __DOCROOT__.'/_core_qcodo/_core');
	define ('__DEVTOOLS_CLI__', __DOCROOT__ .  __SUBDIRECTORY__ . '/_devtools_cli');
	define ('__DEVTOOLS__', __DOCROOT__ .  __SUBDIRECTORY__ . '/_devtools');
	define ('__DATA_CLASSES__', __INCLUDES__ . '/data_classes');
	define ('__DATAGEN_CLASSES__', __INCLUDES__ . '/data_classes/generated');
	define ('__FORMBASE_CLASSES__', __INCLUDES__ . '/formbase_classes_generated');
	define ('__FORM_DRAFTS__', __SUBDIRECTORY__.'/form_drafts');
	define ('__PANELBASE_CLASSES__', __INCLUDES__ . '/ajaxbase_classes_generated');
	define ('__PANEL_DRAFTS__', __SUBDIRECTORY__.'/ajax_drafts');
	define ('__ADMIN_FORM_DIR__', '/admin');
	define ('__PHPEXCEL_CLASSES__', __QCODO__.'/PHPExcel_1.8.0/Classes');
	define ('__EXAMPLES__', null);
	define ('__JS_ASSETS__', __QCODO_URL__ . '/assets/js');
	define ('__CSS_ASSETS__', __QCODO_URL__ . '/assets/css');
	define ('__QCSS_ASSETS__', __QCODO_URL__ . '/assets/css');
	define ('__IMAGE_ASSETS__', __QCODO_URL__ . '/assets/images');
	define ('__PHP_ASSETS__', __QCODO_URL__ . '/assets/php');
	define ('__PHP_ASSETS_PATH__', __QCODO_URL__ . '/assets/php');
	define ('__CAL_ASSETS__', __QCODO_URL__ . '/assets/calendar');

	function _editIcon($title=''){
		return '<img src="'.__IMAGE_ASSETS__.'/edit_f2.png" border="0" width="20px" title="'.$title.'">';
	}

	define ('__ADD_ICON__', '<img src="'.__IMAGE_ASSETS__.'/add.png" border="0" width="20px">');
	define ('__CHECK_ICON__', '<img src="'.__IMAGE_ASSETS__.'/tick.png" border="0" alt="true">');
	define ('__DOWNLOAD_ICON__', '<img src="'.__IMAGE_ASSETS__.'/file_f2.png" border="0" alt="download" height="15px" title="download">'); 
	
	// timeline code directories
	define('__TIMELINE_JS__', __SUBDIRECTORY__.'/TimelineJS-master/compiled/js');
	define('__TIMELINE_CSS__', __SUBDIRECTORY__.'/TimelineJS-master/compiled/css');
	
	if ((function_exists('date_default_timezone_set')) && (!ini_get('date.timezone')))
		date_default_timezone_set('America/New_York');

	define('ERROR_PAGE_PATH', __DOCROOT__.__PHP_ASSETS_PATH__ . '/_core/error_page.php');
?>