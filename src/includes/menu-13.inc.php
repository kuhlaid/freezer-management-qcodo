<?php
/**
 * @abstract The left menu for freezer view-only access.\
 * @author w. Patrick Gale
 * - adding basic access (Jan. 15, 2016 - wpg)
 */
?>
<h3>View-only</h3>

<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/freezers.php"
	title="Lists freezer names, locations, and other hardware specifications"
	id="mmI" class="<?=mainMenuSel(_strFormTypesOfFreezer_);?>"><?=_strFormTypesOfFreezer_;?>
</a>


<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/freezer-maintenance-logs.php"
	title="Shows freezer maintenance logs" id="mmI"
	class="<?=mainMenuSel(_strFormFreezerML_);?>" title=""><?=_strFormFreezerML_;?>
</a>
<br />

<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/ln_tanks.php" id="mmI"
	class="<?=mainMenuSel(_strFormLNTanks_);?>"><?=_strFormLNTanks_;?> </a>

<a href="<?=__DOMAIN_URL__.__SUBDIRECTORY__;?>/ln_tank_levels.php" id="mmI"
	class="<?=mainMenuSel(_strFormLNTankStatus_);?>"><?=_strFormLNTankStatus_;?>
</a>
<?php /* ?>
<?php */ ?>

<h3>Other</h3>
<a href="https://itsapps.unc.edu/EHS/" id="mmI" target="_blank">Blood
	Borne Pathogen Training</a>

<a href="https://itsapps.unc.edu/LabSafetyPlan/" id="mmI"
	target="_blank">Laboratory Safety Plan</a>
<hr />
