<?php
// This is the HTML template include file (.tpl.php) for the freezer_maintenance_edit.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_BDYCOL__', 1);
define('__HIDE_MENU__', true);
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title">Freezer maintenance activity</div>
<br />

<?php $this->calLogDate->RenderWithName(); ?>
<br />
<br />

<?php $this->txtMainLog->RenderWithName(); ?>
<br />
<br />

<?php $this->lstFreezersAsFrzMain->RenderWithName(true); ?>
<br />

<?php $this->chkAlertUser->RenderWithName(); ?>
<br class="item_divider" />

<br />
<?php $this->btnSave->Render(); ?>
&nbsp;&nbsp;&nbsp;
<?php $this->btnCancel->Render(); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php $this->btnDelete->Render(); ?>

<?php $this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>