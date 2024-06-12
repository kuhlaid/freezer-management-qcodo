<?php
/**
 * @abstract Beginning html script.
 * @author w. Patrick Gale
 *
 */

// if opening a sample pull
if (unserialize(QSessionDB::get('__SAMPLE_SELECTION_SEARCH__') ?? '')!='')
$objSampleSelection = unserialize(QSessionDB::get('__SAMPLE_SELECTION_SEARCH__') ?? '');
$objMovingBox = unserialize(QSessionDB::get('__SAMPLE_MOVING_BOX__') ?? '');	// see if we have a moving box

// finds out if a page is selected or not
function mainMenuSel($page) {
	// if the selected page matches the menu item then highlight it
	if (defined('__SEL_MENU__') && $page == __SEL_MENU__) return 'active';
}

// we are trying to figure out how many columns the main body of the app will occupy (defaut to two)
function mainBdyCol() {
	if (defined('__SEL_BDYCOL__')) return __SEL_BDYCOL__;
}

function showSamplePull() {
	$th = unserialize(QSessionDB::get('__MAIN_APP_THIS__') ?? '');
	// web service call to show or hide samples need processing link/alert
	QApplication::ExecuteJavaScript(sprintf('$.get("sample-pull.php?option=c", function(data) { if(data==1) $("#dmI").show("slow");});', $th));
}

// full application block if not going through the ACL
if (!defined('__ACCESSED_CONTROLLED_SCRIPT__')) exit;

//@BL changing to HTML5 doctype definition
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?php _p(QApplication::$EncodingType); ?>" />
<title><?=__APPLICATION_NAME__;?> <?php if (isset($strPageTitle)) { ?> -
	<?=$strPageTitle; ?> <?php } ?>
</title>
<link rel="stylesheet" type="text/css" media="screen, projection"
	href="<?php _p(__CSS_ASSETS__); ?>/styleV2.css?v=<?=__VERSION_Num__;?>" />
<link rel="stylesheet" type="text/css" media="print"
	href="<?php _p(__CSS_ASSETS__); ?>/print.css?v=<?=__VERSION_Num__;?>" />
<link rel="icon shortcut" type="image/ico" href="https://www.unc.edu/wp-content/themes/unc/assets/images/favicon/favicon.ico?v=1" />
<script src="<?=__JS_ASSETS__;?>/jquery-1.7.1.min.js"
	type="text/javascript"></script>
<script src="<?=__JS_ASSETS__;?>/jquery-ui-1.8.17.custom.min.js"
	type="text/javascript"></script>

<?php // add some Bootstrap ?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php /* if we were to use the jquery validation engine...
<script src="<?=__JS_ASSETS__;?>/jquery.validationEngine-en.js"></script>
<script src="<?=__JS_ASSETS__;?>/jquery.validationEngine.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php _p(__QCSS_ASSETS__); ?>/validationEngine.jquery.css" />
*/
?>
<script>
//reset link function for components
function __resetTextBox(strFormId, strControlId) {
	var objListBox = document.forms[strFormId].elements[strControlId];
	//console.log(objListBox);
	objListBox.value = "";
};
</script>
</head>
<body>
	<a name="top"></a>
	<div class="mainWrapper" style="">
		<?php // hide the menu if this constant is defined
if (!defined('__HIDE_MENU__')) {?>
		<div class="noPrint"
			style="width: 125px; float: left; padding: 10px; padding-left: 0px; margin-right: 15px;">

			<?php if (defined('__LOGGED_USER_ID__')) {

				// if freezer admin
				if(checkAccess(8))
					require('menu-8.inc.php');	// show the left menu items - freezer admin

				// if view-only
				if(checkAccess(13))
					require('menu-13.inc.php');	// show the left menu items - freezer view-only


				//@BL if set then show user access menu
				if (defined('__strUserAccessMenu__')) print __strUserAccessMenu__."<br/><br/>";

				print "<div class='sm'>You are logged in as: <b>".__LOGGED_USER_NAME__."</b></div>";
				?>
			<br /> <br /> <a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/logout.php" id="mmI"><img
				src="<?=__IMAGE_ASSETS__;?>/closebox.png"
				style="float: right; border: none; width: 15px;">LOGOUT</a> <br />
			<?php

			}
	else { ?>
			<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/index.php" id="mmI" class="active">Login</a>
			<br />
			<?php }	?>
		</div>
		<?php } ?>
		<div id="bdyCol<?=mainBdyCol();?>">
			<?php
			if (trim(QSessionDB::get('error') ?? '') != '') {
		QApplication::ExecuteJavaScript('$("#warning-err").fadeIn(2000, function() {$("#warning-err").fadeOut(8000);});', $this);
		?>
			<div class="warning" id="warning-err">
				Notice: <b><?=QSessionDB::get('error');?> </b>
			</div>
			<?php } ?>