<?php
	// This is the HTML template include file (.tpl.php) for the type_of_rack_list.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
	
	// kick user away from script if they are not going through the proper channels
	if (!defined('__PREPEND_INCLUDED__')) exit;

	$strPageTitle = _strFormTypesOfRack_;
	define('__SEL_MENU__', _strFormTypesOfRack_);

	require(__INCLUDES__ . '/header.inc.php');
?>

	<?php $this->RenderBegin() ?>
		<div class="title"><?=$strPageTitle; ?><a href="type_of_rack.php" id="createOpt">Add a rack type</a></div>

		<?php $this->dtgTypeOfRack->Render() ?>

	<?php $this->RenderEnd() ?>
	
<?php require(__INCLUDES__ . '/footer.inc.php'); ?>