<?php
// This is the HTML template include file (.tpl.php) for the sample_types_list.php
// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent
// code re-generations do not overwrite your changes.

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

$strPageTitle = _strFormTypesOfSample_;
define('__SEL_MENU__', _strFormTypesOfSample_);

require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=$strPageTitle; ?>
	<a href="type_of_sample.php" id="createOpt">Add a sample type</a>
</div>

<?php $this->dtgSampleTypes->Render() ?>

<?php $this->RenderEnd() ?>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>