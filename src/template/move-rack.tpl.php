<?php
/**
 * @abstract Html template for relocating a rack to another freezer location
 * @author w. Patrick Gale (March 2014)
 *
 */

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

$strPageTitle = _strFormMoveRack_;
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin();
$this->objDefaultWaitIcon->Render(); ?>
<div class="title">
	<?=$strPageTitle; ?>
</div>
<hr />

<table>
	<tr>
		<td style="width: 300px; vertical-align: middle; padding-right: 40px;"><?php $this->strRack->RenderWithName(); ?>
		</td>
		<td
			style="text-align: center; vertical-align: middle; padding-right: 40px;"
			class="fs18 bld">move to</br>=>
		</td>
		<td style="vertical-align: middle;">
		<?php $this->lstRack->RenderWithName(); ?><br/>
		<?php $this->txtFreezer->RenderWithName(); ?>
			<br /> <?php $this->txtShelf->RenderWithName(); ?>
		</td>
	</tr>
</table>
<br class="clr" />
<?php $this->btnSave->Render(); ?>
&nbsp;&nbsp;&nbsp;
<?php $this->btnCancel->Render(); ?>
<?php $this->RenderEnd() ?>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>