<?php
	// This is the HTML template include file (.tpl.php) for the sampleloc_list.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
	
	// kick user away from script if they are not going through the proper channels
	if (!defined('__PREPEND_INCLUDED__')) exit;

	$strPageTitle = QApplication::Translate('List All') . ' Samplelocs';
	require(__INCLUDES__ . '/header.inc.php');
?>
The location of T2 samples within each box collected at T2.
	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _t('List All'); ?></div>
		<div class="title"><?php _t('Samplelocs'); ?></div>
		<br class="item_divider" />

		<?php $this->dtgSampleloc->Render() ?>

	<?php $this->RenderEnd() ?>
	
<?php require(__INCLUDES__ . '/footer.inc.php'); ?>