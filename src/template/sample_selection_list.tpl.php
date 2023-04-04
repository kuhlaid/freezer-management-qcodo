<?php
/**
 * @abstract Template for showing the log of sample selection queries.
 * @author w. Patrick Gale
 * - added menu selection constant (Jan. 21, 2016 - wpg)
 */

	// kick user away from script if they are not going through the proper channels
	if (!defined('__PREPEND_INCLUDED__')) exit;

	define('__SEL_MENU__', _strFormSampleSelection_);
	$strPageTitle = _strFormSampleSelection_;
	require(__INCLUDES__ . '/header.inc.php');
?>

	<?php $this->RenderBegin() ?>
		<div class="title"><?=$strPageTitle; ?><a href="sample_selection.php" id="createOpt">Start a sample selection</a></div>
		<br class="item_divider" />

		<?php $this->dtgSampleSelection->Render() ?>

	<?php $this->RenderEnd() ?>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>