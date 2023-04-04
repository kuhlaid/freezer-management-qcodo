<?php
// This is the HTML template include file (.tpl.php) for the box_list.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_MENU__', _strFormBoxes_);
$strPageTitle = _strFormBoxes_;

require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=_strFormBoxes_; ?>
	<div  id="createOpt">Add a <a href="box.php">box</a> or <a href="box.php?blnDuplicate=true">duplicate box</a></div>
</div>
<br class="item_divider" />
<?php $this->lstSearch->RenderNoBreaks() ?>
<?php $this->lstBoxType->RenderNoBreaks() ?>
<?php $this->btnRack->RenderNoBreaks() ?>
<?php $this->txtBox->RenderNoBreaks() ?>
<hr />

 <div id="BHL" class='pd5'>
	<?php $this->calReleaseDate->RenderNoBreaks(); ?>
	<br /> <br />
	<?php $this->txtFreezerPullId->RenderNoBreaks(); ?>
	<br /> <br />
	<?php $this->btnReleaseBoxes->RenderNoBreaks(); ?>
	<?php $this->btnFreezerPullBoxes->RenderNoBreaks(); ?>
	<?php $this->btnDeleteBoxes->RenderNoBreaks(); ?>
</div>
<?php $this->dtgBox->Render() ?> 


<?php $this->RenderEnd() ?>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>