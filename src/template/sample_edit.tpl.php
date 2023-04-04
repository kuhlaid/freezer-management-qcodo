<?php
// This is the HTML template include file (.tpl.php) for the sample_edit.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_BDYCOL__', 1);
define('__HIDE_MENU__', true);
$strPageTitle = 'Sample';
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=$strPageTitle;?>
</div>
<br class="item_divider" />

<div class="fltL" style="width: 200px;">
	<?php $this->lstStudyType->RenderWithName(); ?>
</div>
<div class="fltL" style="width: 200px;">
	<?php $this->lstSampleType->RenderWithName(); ?>
</div>
<br class="clr" />
<br />


<div class="fltL" style="width: 200px;">
	<?php $this->txtSampleNumber->RenderWithName(); ?>
</div>
<div class="fltL" style="width: 200px;">
	<?php $this->txtBarcode->RenderWithName(); ?>
</div>
<br class="clr" />
<br />


<?php $this->txtStudyCase->RenderWithName(); ?>
<br />
<br />

<?php $this->lstBox->RenderWithName(); ?>
<br />
<br />

<?php $this->txtBoxSampleSlot->RenderWithName(); ?>
<br />
<br />

<?php /*
$this->txtParentId->RenderWithName(); ?>
<br/><br/>
		*/ ?>

<?php $this->lstContainerType->RenderWithName(); ?>
<br />
<br />

<?php $this->lstStateType->RenderWithName(); ?>
<br />
<br />

<?php $this->calStateDate->RenderWithName(); ?>
<br />
<br />

<div class="fltL" style="width: 200px;">
	<?php $this->txtVolume->RenderWithName(); ?>
</div>
<div class="fltL" style="width: 200px;">
	<?php $this->txtVolumeUnit->RenderWithName(); ?>
</div>
<br class="clr" />
<br />

<div class="fltL" style="width: 200px;">
	<?php $this->txtConcentration->RenderWithName(); ?>
</div>
<div class="fltL" style="width: 200px;">
	<?php $this->txtConcentrationUnit->RenderWithName(); ?>
</div>
<br class="clr" />
<br />

<?php $this->txtNotes->RenderWithName(); ?>
<br />
<br />


<br />
<?php $this->btnSave->Render(); ?>
&nbsp;&nbsp;&nbsp;
<?php $this->btnCancel->Render(); ?>

<?php $this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>