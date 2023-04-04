<?php
	// This is the HTML template include file (.tpl.php) for the sample_selection_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
	// code re-generations do not overwrite your changes.

	// kick user away from script if they are not going through the proper channels
	if (!defined('__PREPEND_INCLUDED__')) exit;

	$strPageTitle = 'Sample Search Log';
	require(__INCLUDES__ . '/header.inc.php');
?>

	<?php $this->RenderBegin() ?>
		<div class="title"><?=$strPageTitle;?></div>
		<br class="item_divider" />

		<?php $this->txtDescription->RenderWithName(); ?>
		<br class="item_divider" />

<?php // only show the other fields if we are editing
if ($this->blnEditMode) {
/*?>
		<?php $this->txtParticipantSelect->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtSampleType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtStudySelect->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtSampleSelect->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />
<?php
*/
} ?>
		<?php $this->chkLock->RenderWithName(); ?>
		<br class="item_divider" />

		<br />
		<?php $this->btnSave->Render(); ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render(); ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render(); ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnCloseSampleSelection->Render(); ?>

	<?php $this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>