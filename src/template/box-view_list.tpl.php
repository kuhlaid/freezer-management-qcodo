<?php
// This is the HTML template include file (.tpl.php) for the t_3_0_0_edit.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

$strPageTitle = Box::$formName;
define('__SEL_MENU__', Box::$formName);

require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=$strPageTitle; ?>
</div>
<hr />
<?php $this->lstSearch->RenderNoBreaks() ?>
<div id="B">
	<?php // Boxes in progress?>
	<?php $this->dtgBox2->RenderWithName() ?>
</div>


<?php $this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>