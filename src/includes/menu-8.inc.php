<?php
/**
 * @abstract The left menu for freezer Admin access.
 */
?>
<h3>Admin</h3>

<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/freezers.php"
	title="Lists freezer names, locations, and other hardware specifications"
	id="mmI" class="<?=mainMenuSel(_strFormTypesOfFreezer_);?>"><?=_strFormTypesOfFreezer_;?>
</a>

<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/freezer-maintenance-logs.php"
	title="Shows freezer maintenance logs" id="mmI"
	class="<?=mainMenuSel(_strFormFreezerML_);?>" title=""><?=_strFormFreezerML_;?>
</a>
<br />

<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/types_of_rack.php"
	title="Lists specifications for types of racks used in the freezers"
	id="mmI" class="<?=mainMenuSel(_strFormTypesOfRack_);?>"><?=_strFormTypesOfRack_;?>
</a>
<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/racks.php"
	title="Lists rack names, locations in freezers, box count, etc."
	id="mmI" class="<?=mainMenuSel(_strFormRacks_);?>"><?=_strFormRacks_;?>
</a>
<br />
<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/types_of_boxes.php"
	title="Lists types of boxes found in the freezers and their specifications"
	id="mmI" class="<?=mainMenuSel(_strFormTypesOfBoxes_);?>"><?=_strFormTypesOfBoxes_;?>
</a>
<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/boxes.php"
	title="Lists the boxes of samples found in the freezers, where they are located, any issues, sample type, etc."
	id="mmI" class="<?=mainMenuSel(_strFormBoxes_);?>"><?=_strFormBoxes_;?>
</a>
<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/box_history_logs.php"
	title="Lists boxes released to researchers for analysis, when they were returned and the freezer pull ID they are associated with"
	id="mmI" class="<?=mainMenuSel(_strFormBoxHistoryLog_);?>"><?=_strFormBoxHistoryLog_;?>
</a>

<br />
<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/types_of_sample.php"
	title="Lists the types of samples found in the freezers" id="mmI"
	class="<?=mainMenuSel(_strFormTypesOfSample_);?>"><?=_strFormTypesOfSample_;?>
</a>
<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/samples.php"
	title="Lists the details of samples found in the freezers" id="mmI"
	class="<?=mainMenuSel(_strFormSamples_);?>"><?=_strFormSamples_;?> </a>


<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/sample_history_logs.php"
	title="Lists samples released to researchers for analysis, when they were returned and the freezer pull ID they are associated with"
	id="mmI" class="<?=mainMenuSel(_strFormSampleHistoryLog_);?>" title=""><?=_strFormSampleHistoryLog_;?>
</a>
<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/sample_selections.php"
	title="A log of sample searches for freezer pulls or analysis" id="mmI"
	class="<?=mainMenuSel(_strFormSampleSelection_);?>"><?=_strFormSampleSelection_;?>
</a>

<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/find_samples.php"
	title="A search tool for finds samples for a selected set of participant IDs"
	id="mmI" class="<?=mainMenuSel(_strFormFindSamples_);?>"><?=_strFormFindSamples_;?>
</a>

<div style="display: none;" id="dmI">
	<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/sample-pull.php"
		title="Report of samples to be pulled"
		class="<?=mainMenuSel(_strFormSamplePull_);?>"><?=_strFormSamplePull_;?>
	</a>
</div>

<br />
<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/study_projects.php"
	title="Lists the studies/projects" id="mmI"
	class="<?=mainMenuSel(_strFormStudyProject_);?>"><?=_strFormStudyProject_;?>
</a>

<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/ActionLogs.php"
	title="Shows a log of actions performed in the freezer inventory" id="mmI"
	class="<?=mainMenuSel(_strFormActionLogs_);?>"><?=_strFormActionLogs_;?>
</a>

<hr />
