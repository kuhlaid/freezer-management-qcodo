<?php
	// This is the HTML template include file (.tpl.php) for the box_history_log_list.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
	
	// kick user away from script if they are not going through the proper channels
	if (!defined('__PREPEND_INCLUDED__')) exit;

	define('__SEL_MENU__', _strFormBoxHistoryLog_);
	$strPageTitle = _strFormBoxHistoryLog_;
	require(__INCLUDES__ . '/header.inc.php');
?>

	<?php $this->RenderBegin() ?>
		<div class="title"><?=$strPageTitle; ?></div>
		<div>Lists boxes that have been released to researchers for analysis.  Does not currently include individual samples pulled from boxes; these are listed under the Samples History  view with a filter of 'Outside our facility (being analyzed)'.</div>
		<hr class="item_divider" />

		<?php $this->dtgBoxHistoryLog->Render() ?>
		
	<?php $this->RenderEnd() ?>
	
<?php require(__INCLUDES__ . '/footer.inc.php'); ?>