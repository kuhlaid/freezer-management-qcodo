<?php
// This is the HTML template include file (.tpl.php) for the freezer_list.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_MENU__',_strFormTypesOfFreezer_);
$strPageTitle = _strFormTypesOfFreezer_;
require(__INCLUDES__ . '/header.inc.php');

$addLink='';
if(checkAccess(8))
	$addLink = '<a href="freezer.php" id="createOpt">Add a freezer</a>';
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=$strPageTitle; ?>
	<?=$addLink;?>
</div>
<?php $this->lstFreezerStatus->RenderNoBreaks() ?>
<div class='tab_bar'>
	<br />
	<?php 	print '<a href="freezer-view.php" class="status_tab">Space used/available</a> ';
	print '<a href="freezers.php" class="status_tab_active">Descriptions</a>';
	?>
</div>
<br />
<br class="item_divider" />

<?php $this->dtgFreezer->Render() ?>

<?php $this->RenderEnd() ?>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>