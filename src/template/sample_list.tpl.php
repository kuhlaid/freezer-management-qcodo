<?php
// This is the HTML template include file (.tpl.php) for the box_list.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_MENU__', _strFormSamples_);
$strPageTitle = _strFormSamples_;
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=_strFormSamples_; ?>
</div>
<div>This is the main samples listing</div>
<hr class="item_divider" />
<div class="fltL" style="padding-right: 20px;">
	<?php $this->lstTimepoint->RenderNoBreaks() ?>
</div>
<div class="fltL">
	<?php $this->txtBarcode->RenderNoBreaks() ?>
</div>
<div class="fltL">
	<?php $this->lstSampleType->RenderNoBreaks() ?>
</div>
<br class="clr" />
<div class="fltL" style="padding-right: 20px;">
<?php $this->lstInventoriedBox->RenderNoBreaks() ?>
</div>
<div class="fltL">
	<?php $this->blnOrphan->RenderNoBreaks() ?>
</div>
<br class="clr" />
<?php $this->dtgSample->Render() ?>

<?php $this->RenderEnd() ?>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>