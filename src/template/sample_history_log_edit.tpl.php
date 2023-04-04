<?php
// This is the HTML template include file (.tpl.php) for the sample_history_log_edit.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

$strPageTitle = $this->strTitleVerb . ' SampleHistoryLog';
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title_action">
	<?php _p($this->strTitleVerb); ?>
</div>
<div class="title">
	<?php _t('SampleHistoryLog')?>
</div>
<br class="item_divider" />

<?php $this->lblId->RenderWithName(); ?>
<br class="item_divider" />

<?php $this->txtSampleId->RenderWithName(); ?>
<br class="item_divider" />

<?php $this->calReleaseDate->RenderWithName(); ?>
<br class="item_divider" />

<?php $this->txtFreezerPullId->RenderWithName(); ?>
<br class="item_divider" />

<?php $this->calReceivedDate->RenderWithName(); ?>
<br class="item_divider" />


<br />
<?php $this->btnSave->Render(); ?>
&nbsp;&nbsp;&nbsp;
<?php $this->btnCancel->Render(); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php $this->btnDelete->Render(); ?>

<?php $this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>