<?php
/**
 * @abstract Template file for generating the view for pulling samples.  Each box needing to be pulled and the
 * slots with the samples will be listed to help the 'sample puller' with finding samples.
 * @author w. Patrick Gale May 2014
 *
 * - adding txtTransferBox, btnTransferSamples, and txtFreezerPullId controls (OCt. 29, 2015 - wpg)
 * - adding note on way to update selections from initial estimated samples to pull and actual pulled (Jan. 29, 2016 - wpg)
 */

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

$strPageTitle = _strFormSamplePull_;

// define('__SEL_BDYCOL__', 1);
// define('__HIDE_MENU__', true);
require(__INCLUDES__ . '/header.inc.php');
?>
<?php $this->RenderBegin(); ?>
<div class="title">
	<?=$strPageTitle; ?>
</div>
<div>This report shows the samples needing to be pulled from the
	freezers.</div>
<style type="text/css" media="screen, print">
.slot {
	border: 1px solid #efefef;
	border-right: 1px solid #858585;
	border-bottom: 1px solid #858585;
	height:10px;
	width:10px;
	margin:0px;
	padding:0px;
}
.stp {
	background-color: green;
}

.box {
	padding: 0px;
	margin: 0px;
	line-height: 0px;
}
.boxWrapper {
	padding-right: 10px;
	padding-bottom: 10px;
	float: left;
	width: 150px;
	height: 200px;
}
</style>
<br/>
<?php
$this->strBoxes->RenderNoBreaks();
print '<div class="fltL noPrint" style="width:100%;">';
$this->txtFreezerPullId->RenderNoBreaks(); $this->btnReleaseSamples->Render();
print '<br>';
$this->txtTransferBox->RenderNoBreaks();
$this->btnTransferSamples->Render();
print '</div>';
//$this->objDefaultWaitIcon->Render();
print '<h2>Samples List</h2>';
$this->btnRemoveSamples->RenderNoBreaks();

$freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__'));
//var_dump(array_values($freezerPullArray));	// used for testing
$this->dtgSample->Render();
$this->RenderEnd();?>

<div class="noPrint">
<h3 class="error">TODO</h3>
<div>- add a box view that uses a selected box to move samples to (Jan.
	29, 2016 - wpg)</div>
<?php /* ?>
<div>- alert user when they are selecting checkboxes for a locked sample pull or either disable the checkboxes (Jan. 29, 2016 - wpg)
</div>
<?php */ ?>

<h3>Selecting samples</h3>
<div>When trying to find samples to pull from inventory, this sample
	selection tool provides you a template to use for finding where samples
	are located. However, inevitably when pulling samples from a box the
	one you selected here in the inventory system may not have the
	volume/quantity you are looking for so you need to select a
	replacement. Eventually this system may have logic to handle this but
	in the meantime, use this selection list to find the samples your hope
	to pull. Then when actually pulling the samples, scan the samples or
	log them into an excel spreadsheet (with the sample locations you are
	using to place them in the new box, and ideally the location of the box
	they were removed from). Then use the Excel list to run this sample
	search criteria again and change the selections from the initial
	selections to the final selections. Copy the selected samples (will
	have export capability at some point here) to Excel and change the
	final sample location slots and box id, then update the database. TODO:
	would be nice to have an update script generated or some other method
	to make the switch either by upload (using an update script against the
	sample ID) or other.</div>
</div>
<?php
require(__INCLUDES__ .'/footer.inc.php');
?>