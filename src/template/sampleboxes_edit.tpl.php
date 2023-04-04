<?php
	// This is the HTML template include file (.tpl.php) for the sampleboxes_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
	
	// kick user away from script if they are not going through the proper channels
	if (!defined('__PREPEND_INCLUDED__')) exit;

	$strPageTitle = $this->strTitleVerb . ' Sampleboxes';
	require(__INCLUDES__ . '/header.inc.php');
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('Sampleboxes')?></div>
		<br class="item_divider" />

		<?php $this->txtId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtIncounty->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->calIncountydate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtCountyuser->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtChapelhilluser->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtIntransit->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->calIntransitdate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtTrackingnum->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtReadytoship->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->calReadytoshipdate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtInchapelhill->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtIncdc->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->calIncdcdate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtCdcuser->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->calInchapelhilldate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtSamptype->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtFreezer->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtRack->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtBox->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $this->btnSave->Render(); ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render(); ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render(); ?>

	<?php $this->RenderEnd(); ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>