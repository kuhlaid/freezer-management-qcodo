<?php
// This is the HTML template include file (.tpl.php) for the box_list.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_MENU__', _strFormRacks_);
$strPageTitle = _strFormRacks_;
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=_strFormRacks_; ?>
	<div  id="createOpt">Add a <a href="rack.php">rack</a> or <a href="rack.php?blnDuplicate=true">duplicate rack</a></div>
</div>
<div>This view lists the inventory of racks for storing sample boxes.</div>
<hr class="item_divider" />
<?php $this->txtBox->RenderNoBreaks() ?>
<?php $this->dtgRack->Render() ?>

<?php $this->RenderEnd() ?>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>