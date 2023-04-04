<?php
/**
 * @abstract Hmtl template for the freezer form.
 *
 * Jan. 6, 2017 - wpg
 * - added additional fields 'FreezerType'-'InUse'
 */

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_BDYCOL__', 1);
define('__HIDE_MENU__', true);
$strPageTitle = 'Freezer';
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=$strPageTitle;?>
</div>
<br class="item_divider" />
<br />


<?php $this->txtName->RenderWithName(); ?>
<br />
<br />

<?php $this->txtDescription->RenderWithName(); ?>
<br />
<br />

<?php $this->txtInUseSince->RenderWithName(); ?>
<br />
<br />

<?php $this->txtLocation->RenderWithName(); ?>
<br />
<br />

<?php $this->txtNShelves->RenderWithName(); ?>
<br />
<br />

<?php $this->txtShelfCuIn->RenderWithName(); ?>
<br />
<br />

<?php $this->txtShelfDepthIn->RenderWithName(); ?>
<br />
<br />

<?php $this->txtShelfWidthIn->RenderWithName(); ?>
<br />
<br />

<?php $this->txtShelfHeightIn->RenderWithName(); ?>
<br />
<br />

		<?php $this->txtFreezerType->RenderWithName(); ?>
		<br /><br />

		<?php $this->txtModelNumber->RenderWithName(); ?>
		<br /><br />

		<?php $this->txtAssetNumber->RenderWithName(); ?>
		<br /><br />

		<?php $this->txtAlarmAccount->RenderWithName(); ?>
		<br /><br />

		<?php $this->txtSerialNumber->RenderWithName(); ?>
		<br /><br />

		<?php $this->txtInUse->RenderWithName(); ?>
		<br /><br />

<br />
<?php $this->btnSave->Render(); ?>
&nbsp;&nbsp;&nbsp;
<?php $this->btnCancel->Render(); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php $this->btnDelete->Render(); ?>

<?php $this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>