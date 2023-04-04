<?php
/**
 * @abstract HTML template for the box view used for sample pulls.
 * @author w. Patrick Gale
 *
 * Aug. 30, 2017 - wpg
 * - adding anchor to last pulled sample so user does not have to scroll down the page each time a sample is pulled
 * - adding checkboxes for freezer pull selections (in the case where we choose additional samples once we have a chance to look at the sample volume)
 *
 * Aug. 27, 2017 - wpg
 * - adding buttons to pull samples for a sample request and move to the 'moving' box
 *
 * Aug. 24, 2017 - wpg
 * - setting up basic shell
 */
// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

$strPageTitle = Box::$formName;

define('__SEL_BDYCOL__', 1);
define('__HIDE_MENU__', true);
require(__INCLUDES__ . '/header.inc.php');

?>
<?php // adding a timer to refresh this page every 10 seconds ?>
<script
	type="text/javascript"
	src="<?php _p(__JS_ASSETS__); ?>/jquery.timer.js"></script>
<script type="text/javascript">
var refresher = $.timer(function() {
	location.reload();
});

<?php // setting a timer to check the current page locks every 2 seconds
if (QApplication::QueryString('autoRefresh')==1) {?>
refresher.set({ time : 5000, autostart : true });
<?php } ?>
</script>
<?php $this->RenderBegin();


/* ?>
<div class="txtalignC noPrint"
	style="position: fixed; top: 0px; left: 0px; background-color:#fff; border:1px solid #000; padding:5px; opacity: 0.8;
	filter: alpha(opacity = 80)"><?php $this->txtSampleMoveBox->RenderNoBreaks(); ?></div>
<?php */ ?>
<div class="title">
	<?=$strPageTitle; ?>: <a href="boxes.php?intBoxId=<?=QApplication::QueryString('intId')?>"><?=_editIcon('Go to general box details');?></a> <?php $this->txtName->RenderNoNameNB();
	// show link for turning on the automatic refresh of the page when updating the sample inventory through the database
	if (QApplication::QueryString('autoRefresh')!=1) {?>
	<br /> <a
		href="?intId=<?=QApplication::QueryString('intId')?>&autoRefresh=1">Enable
		auto refresh</a>
	<?php } ?>
</div>
<br class="clr" />
<style type="text/css" media="screen">
.hover {
	background: #efefef;
}

.nohover {
	background: #fff;
}

#boxTop .stp {
	background-color: green;
	color: #fff;
}

#boxTop td {
	font-size: 11px;
	border: 1px solid #efefef;
	border-right: 2px solid #858585;
	border-bottom: 2px solid #858585;
	padding: 1px;
}

#boxTop {
	background-color: #ccc;
}

.s1 {
	background-color: #961A58;
	color: #fff;
	padding: 3px;
}

/* urine */
.s2 {
	background-color: yellow;
	color: #000;
	padding: 3px;
}

/* plasma */
.sPurple,.s8 {
	background-color: purple;
	color: #fff;
	padding: 3px;
}

/* wppr */
.s3 {
	background-color: #1B60E0;
	color: #fff;
	padding: 3px;
}

/* red cell */
.s9 {
	background-color: #C90000;
	color: #fff;
	padding: 3px;
}

/* buffy coat */
.s10 {
	background-color: #efefef;
	color: #000;
	padding: 3px;
}
</style>
<div class="fltL" style="width: 400px">
	<?php $this->lstSampleType->RenderNoBreaks(); ?>
</div>
<div class="fltL" style="width: 400px">
	<div class="bld fs18">Location in freezer:</div>
	<div class="fltL" style="width: 125px">
		<?php $this->txtFreezer->RenderNoNameNB(); ?>
	</div>
	<div class="fltL" style="width: 125px">
		<?php $this->txtShelf->RenderNoNameNB(); ?>
	</div>
	<div class="fltL" style="width: 125px">
		<?php $this->lstRack->RenderNoNameNB(); ?>
	</div>
</div>
<br class="clr" />
<?php $this->lstStudy->RenderNoNameNB(); ?>
<br class="clr" />
<br />
<div id="ST_SL">
	<a name="top"></a>
	<table id="boxTop">
		<?php
		//@BL generate the sample locations for the box
		$count=1;
		for($a=1;$a<=$this->rowCount;$a++) {?>
		<tr valign="top">
			<?php for($i=1;$i<=$this->columnCount;$i++) {
				$stp='';
				// highlight the cells we are looking to pull (Aug. 24, 2017 - wpg)
				if (in_array($count, $this->highlightSlots)) $stp='stp';
				?>
			<td align="center" height="70" class="nohover <?=$stp;?>"
				onmouseover="this.className='hover'"
				onmouseout="this.className='nohover <?=$stp;?>'"><a name="slot<?=$count;?>"></a><?php
				$obj = '$this->txtS'.$count.'->RenderNoBreaks();';
				eval("return $obj;");

				// build checkbox fields for freezer pull selections
				$obj = '$this->chkS'.$count.'->RenderNoBreaks();';
				//$obj .= '$this->chkS'.$count.'->Checked = true;';
				eval("return $obj;");

				$obj = '$this->btnS'.$count.'->RenderNoBreaks();';
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
</div>

<?php /* ?>
<br />
<div id="movingBox">
	<a name="top"></a>
	<table>
		<?php
		//@BL generate the sample locations for the box
		$count=1;
		for($a=1;$a<=$this->rowCount;$a++) {?>
		<tr valign="top">
			<?php for($i=1;$i<=$this->columnCount;$i++) {
				$stp='';
				// highlight the cells we are looking to pull (Aug. 24, 2017 - wpg)
				if (in_array($count, $this->highlightSlots)) $stp='stp';
				?>
			<td align="center" height="70" class="nohover <?=$stp;?>"
				onmouseover="this.className='hover'"
				onmouseout="this.className='nohover <?=$stp;?>'"><?php
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
</div>
<?php */ ?>

<?php $this->RenderEnd();
require(__INCLUDES__ .'/footer.inc.php');?>