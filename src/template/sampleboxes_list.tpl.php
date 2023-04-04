<?php
	// This is the HTML template include file (.tpl.php) for the sampleboxes_list.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
	
	// kick user away from script if they are not going through the proper channels
	if (!defined('__PREPEND_INCLUDED__')) exit;

	$strPageTitle = QApplication::Translate('List All') . ' Sampleboxeses';
	require(__INCLUDES__ . '/header.inc.php');
?>
Part of the sample entry application in T2, logs the current location of each sample box within the system, who touched it, tracking number, etc.  Built to be a little more robust than it ended up being.
	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _t('List All'); ?></div>
		<div class="title"><?php _t('Sampleboxeses'); ?></div>
		<br class="item_divider" />

		<?php $this->dtgSampleboxes->Render() ?>
		<br />
		<a href="sampleboxes_edit.php"><?php _t('Create a New'); ?> <?php _t('Sampleboxes');?></a>
		 &nbsp;|&nbsp;
		<a href="<?php _p(__VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__) ?>/index.php"><?php _t('Go to "Form Drafts"'); ?></a>

	<?php $this->RenderEnd() ?>
	
<?php require(__INCLUDES__ . '/footer.inc.php'); ?>