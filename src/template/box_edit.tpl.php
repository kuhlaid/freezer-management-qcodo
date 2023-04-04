<?php
// This is the HTML template include file (.tpl.php) for the box_edit.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_BDYCOL__', 1);
define('__HIDE_MENU__', true);
$strPageTitle = 'Box';
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<?php $this->objDefaultWaitIcon->Render();?>
<div class="title">
	<?=$strPageTitle;?>
</div>
<br class="item_divider" />

<?php $this->txtName->RenderWithName(); ?>
<br />
<br />

<?php $this->lstSampleType->RenderWithName(); ?>
<br />
<br />

<?php $this->lstBoxType->RenderWithName(); ?>
<br />
<br />

<?php $this->txtIssues->RenderWithName(); ?>
<br />
<br />

<?php $this->txtDescription->RenderWithName(); ?>
<br />
<br />
<?php $this->chkComplete->RenderNoBreaks(); ?>
<hr />
<h2>Location:</h2>
<?php $this->lstRack->RenderWithName(); ?>
<br />
<br />

<?php $this->txtFreezer->RenderWithName(); ?>
<br />
<br />

<?php $this->txtShelf->RenderWithName(); ?>
<br />
<br />




<br />
<?php $this->btnSave->Render(); ?>
&nbsp;&nbsp;&nbsp;
<?php $this->btnCancel->Render(); ?>

<?php $this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>