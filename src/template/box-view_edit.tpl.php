<?php
/**
 * Sept. 19, 2018 - wpg
 * - adding an isset function to line 62 to check for an empty object
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
<?php $this->RenderBegin() ?>
<?php /*$this->objDefaultWaitIcon->Render();?>
<div class="error">
Certain conditions must be met before any sample entry. First, if this
view has no samples entered then a study type must be selected (this
		will be used for parsing sample barcodes, etc.). Secondly the type of
sample must be selected so we know what to save the sample as. If we
are scanning barcodes that are able to be parsed to determine the
participant and sample type etc. then will need to know how to parse
ahead of time so we will know how it is handled. Also the box type must
be specified so we know how many rows and columns to build for the box.

Maybe also have labels after the sample barcode textboxes that show the
participant ID, sample type and sample number. For adding samples to a
box, will need to select the study type (determined by one of the
	samples in the box) before anything else is able to be selected or
entered on the form.<br /> <br /> Need to determine how to handle
duplicate barcodes/labels (especially ones with just written labels,
	not barcoded, and do not have a sample number) that need to have a
sample number attached to them or something so we don't think they are
duplicates and should not be logged. Might be good to just add a sample
number in parentheses if the label is missing one just for tracking
online, even though we are not able to specifically track that sample
from the others with the same label (although it does not seem
	necessary since they should have all been processed the same). May just
be better to leave off sample number and just allow duplicate entries
for a box since it will happen for older samples. Maybe just add an
checkbox that says if we know that the samples are barcoded and should
be checked for duplicates then check, otherwise allow duplicates.
</div>
<?php */ ?>
<?php // if we are in sample search/selection mode
if(isset($objSampleSelection)) {?>
	<a href="box-sample-pull.php?intId=<?=QApplication::QueryString('intId')?>">Switch to sample pull view</a>
<?php }
?>
<div class="title">
	<?=$strPageTitle; ?>: <a href="boxes.php?intBoxId=<?=QApplication::QueryString('intId')?>"><?=_editIcon('Go to general box details');?></a> 	<?php $this->txtName->RenderNoNameNB();
	// show link for turning on the automatic refresh of the page when updating the sample inventory through the database
	if (QApplication::QueryString('autoRefresh')!=1) {?>
	<br /> <a
		href="?intId=<?=QApplication::QueryString('intId')?>&autoRefresh=1">Enable
		auto refresh</a>
	<?php } ?> <?php $this->btnDeleteSamples->RenderNoBreaks(); ?>
</div>
<br class="clr" />
<div class='tab_bar'>
	<br />
	<?php 	$arrayStatus = array("Box layout"=>'a', "Box content details"=>'b');
	foreach ($arrayStatus as $key => $value) {
			if (__QUERY_STATUS_BV__ == $value) $class = "status_tab_active";
			else $class = "status_tab";
			print '<a href="?strTabStatus='.$value.'&intId='.__QUERY_STATUS_BVint__.'" class="'.$class.'">'.$key.'</a> ';
		}
		?>
</div>
<br />

<?php // if viewing the box layout
if (__QUERY_STATUS_BV__=='a') { ?>
<style type="text/css" media="screen">
.hover {
	background: #efefef;
}

.nohover {
	background: #fff;
}

td {
	font-size: 11px;
	border: 1px solid #efefef;
	border-right: 2px solid #858585;
	border-bottom: 2px solid #858585;
	padding: 1px;
}

table {
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
	<?php $this->lstSampleType->RenderNoNameNB(); ?>
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
	<table>
		<?php
		//@BL generate the sample locations for the box with 9x9 config (JoCoOA T3 standard box)
		$count=1;
for($a=1;$a<=$this->rowCount;$a++) {?>
		<tr valign="top">
			<?php for($i=1;$i<=$this->columnCount;$i++) {?>
			<td align="center" height="70" class="nohover"
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
</div>
<?php $this->btnSave->Render(); ?>
&nbsp;&nbsp;&nbsp;

<?php $this->btnCancel->Render(); ?>

<div id="sampleImport">
	<h1>Import samples</h1>
	<div>
		Below you may enter or paste the contents of the samples and their
		locations to go into this box. Ideally, paste a list of samples copied
		from an Excel file with three columns for study_case, barcode, and
		location - in that order - into the field below; each column should be
		separated by a tab and only one sample per line. <b>DO NOT INCLUDE
			BLANK LINES AT THE END!!!</b><br /> Below is an example of two
		samples to be imported: <i> <pre>
X0001	BCD-X0001-01	1
X0002	BCD-X0002-03	4
</pre>
		</i>
	</div>

	<?php $this->txtSamples->RenderNoName(); ?>

	<?php $this->btnAdd->RenderNoName(); ?>
</div>
<?php }
else { ?>
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
<br />

<?php // else we just want to see the box content details
 	$this->dtgSample->Render();
}
$this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php');

?>