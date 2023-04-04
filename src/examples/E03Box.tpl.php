<?php
/**
 * @abstract The HMTL template is used with the E03Box.php script. Most of the work is performed by the E03Box.php script.
 * Ideally this script would pull the specs of the box (column width) in order to build out the form but that is the todo list.
 */
// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

$strPageTitle = _strFormE03SampleBox_;
define('__SEL_MENU__',_strFormE03SampleBox_);
require(__INCLUDES__ . '/header.inc.php');
?>
<style media="screen">
.hover {
	background: #efefef;
}

.nohover {
	background: #fff;
}

td {
	font-size: 11px;
	border: 1px solid #ccc;
	padding: 1px;
}

table {
	border: 1px solid #000;
}
</style>
<?php $this->RenderBegin() ?>
<?php print $_glblWrapper;  // NOTE: this flex bootstrap tag MUST BE inside the Qcodo form and not outside of it?> 
<div class="p-2 col-md-12">
    <?php // build the page title and critical links ?>
    <div class="d-flex justify-content-between">
        <div class="h1 p-1"><span class="oi oi-droplet"></span> &nbsp;<?=$strPageTitle;?></div>
    </div>
	<div>
	<?php $this->objDefaultWaitIcon->Render();?>
	<?php $this->lstSampleType->RenderNoName(); ?>
	<br />

	<div id="ST_SL">
		Both the box and the lid should have a barcode with the following Box
		ID:<br />
		<div
			style="border: 1px solid #000; padding: 3px; width: 150px; text-align: center;">
			<?php $this->txtName->RenderNoNameNB(); ?>
			<br /> <img src="<?=__IMAGE_ASSETS__;?>/barcode.gif" border="0"
				width="100px" title="sample barcode">
		</div>
		<hr />
		<br /> Please make sure there is a
		<?php $this->lblColor->RenderNoNameNB(); ?>
		colored sticker on the cover of the box, and fold one over the upper
		left-hand corner of the box.
		<div>
			<strong><em>Please click in the field where you will enter the first
					sample before scanning.</em> </strong>
	</div>
		<table width="600">
			<?php
			//@BL generate the sample locations for the box with 9x9 config (standard box)
			$count=1;
			for($a=1;$a<=9;$a++) {?>
			<tr>
				<?php for($i=1;$i<=9;$i++) {?>
				<td height="50" class="nohover text-center"
					onmouseover="this.className='hover'"
					onmouseout="this.className='nohover'"><?php
					$obj = '$this->txtS'.$count.'->RenderWithName()';
					eval("return $obj;");
					//print $count;
					$count++;
					?>
				</td>
				<?php } ?>
			</tr>
			<?php } ?>
		</table>
		<br />
		<div>
			<?php $this->chkComplete->RenderNoBreaks(); ?>
		</div>

		<br />
		<?php $this->btnSave->Render(); ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render(); ?>
	</div>
</div>
<?php $this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>