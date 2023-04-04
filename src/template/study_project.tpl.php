<?php
// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_BDYCOL__', 1);
define('__HIDE_MENU__', true);
$strPageTitle = 'Study/Project';
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
	<div class="title">
		<?=$strPageTitle;?>
	</div>

		<?php $this->txtName->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $this->btnSave->Render(); ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render(); ?>
		<?php 
		// we do not want to delete studies once they are assigned to samples, so the delete option is disabled
		// $this->btnDelete->Render(); ?>

<?php $this->RenderEnd(); ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>