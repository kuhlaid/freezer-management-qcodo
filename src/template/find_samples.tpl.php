<?php
/**
 * Aug. 20, 2017 - wpg
 * - adding an 'auto select one sample from each subject' button
 *
 * - adding strParticipantSampleRpt control to show the number of samples available and participants missing samples for the
 * list of participants being searched (Oct. 1, 2015 - wpg)
 * - adding note on way to update selections from initial estimated samples to pull and actual pulled (Jan. 29, 2016 - wpg)
 */

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_MENU__', _strFormFindSamples_);
$strPageTitle = _strFormFindSamples_;
require(__INCLUDES__ . '/header.inc.php');
// $linkCheckboxShowHide='';
// if ($this->sampleChkBx=='show')
// 	$linkCheckboxShowHide = '<a href="?sampleChkBx=hide">Hide sample selection checkboxes</a>';
// else
// 	$linkCheckboxShowHide = '<a href="?sampleChkBx=show">Show sample selection checkboxes</a>';
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=_strFormFindSamples_;?>
</div>
<br class="item_divider" />

<?php $this->txtParticipants->RenderNoName(); ?>
<br />
<br />

<?php $this->lstSampleType->RenderNoBreaks(); ?>
&nbsp;&nbsp;&nbsp;
<?php $this->chkInventory->RenderNoBreaks(); ?>
<br />
<br />

<?php $this->lstStudyType->RenderWithName(); ?>
<br />
<br />

<?php $this->btnSearch->Render(); ?>&nbsp;&nbsp;&nbsp;<?php $this->btnAutoSelect->Render(); ?>
<hr />

<?php $this->btnExport->Render();?><?//=$linkCheckboxShowHide;?>
<br />
<?php $this->dtgSample->Render(); ?>

<br />
<?php $this->strParticipantSampleRpt->RenderWithName(); ?>

<h3 class="error">TODO</h3>
<div>- alert user when they are selecting checkboxes for a locked sample pull or either disable the checkboxes (Jan. 29, 2016 - wpg)
</div>

<h3>Selecting samples</h3>
<div>
When trying to find samples to pull from inventory, this sample selection tool provides you a template to use for finding
where samples are located.  However, inevitably when pulling samples from a box the one you selected here
in the inventory system may not have the volume/quantity you are looking for so you need to select a replacement.  Eventually
this system may have logic to handle this but in the meantime, use this selection list to find the samples your hope
to pull.  Then when actually pulling the samples, scan the samples or log them into an excel spreadsheet (with
the sample locations you are using to place them in the new box, and ideally the location of the box they were removed
from).  Then use the Excel list to run this sample search criteria again and change the selections from the initial
selections to the final selections.  Copy the selected samples (will have export capability at some point here) to
Excel and change the final sample location slots and box id, then update the database.  TODO: would be nice to have
an update script generated or some other method to make the switch either by upload (using an update script against
the sample ID) or other.
</div>
<?php $this->RenderEnd(); ?>

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>