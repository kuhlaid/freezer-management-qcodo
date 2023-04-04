<?php
if (!defined('__PREPEND_INCLUDED__')) exit;
/*
 * @abstract Executes the requested script after being checked for access. Moved access to one file so
* we can easily see what a type of user can access.  This provides access for Freezer read-only access.
* @author w. Patrick Gale - Jan. 2013
*/
if (__ACCESSED_CONTROLLED_SCRIPT__=='index')
	IndexForm13::Run('IndexForm13', 'template/index.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='freezers')
FreezerListForm13::Run('FreezerListForm13', 'template/freezer_list.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='FreezerView_af')
	FreezerView13_af::Run('FreezerView13_af', 'template/freezer-view.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='FreezerView_a')
	FreezerView13_a::Run('FreezerView13_a', 'template/freezer-view.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='readme')
ReadmeForm::Run('ReadmeForm', 'template/readme.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_list')
LnTankListForm13::Run('LnTankListForm13', 'template/ln_tank_list.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_level_list')
LnTankLevelListForm13::Run('LnTankLevelListForm13', 'template/ln_tank_level_list.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='freezer-maintenance-logs')
FreezerMaintenanceListForm13::Run('FreezerMaintenanceListForm13', 'template/freezer_maintenance_list.tpl.php');

// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='frz_inventory_list')
// FrzInventoryListForm13::Run('FrzInventoryListForm13', 'template/frz_inventory_list.tpl.php');

// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='freezer-maintenance-logs')
// FreezerMaintenanceListForm13::Run('FreezerMaintenanceListForm13', 'template/freezer_maintenance_list.tpl.php');
// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='freezer-maintenance')
// FreezerMaintenanceEditForm13::Run('FreezerMaintenanceEditForm13', 'template/freezer_maintenance_edit.tpl.php');

// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='FreezerView13_bf')
// FreezerView13_bf::Run('FreezerView13_bf', 'template/freezer-view.tpl.php');

// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='FreezerView13_b')
// FreezerView13_b::Run('FreezerView13_b', 'template/freezer-view.tpl.php');
// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='FreezerView13_a')
// FreezerView13_a::Run('FreezerView13_a', 'template/freezer-view.tpl.php');

// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_level_edit')
// LnTankLevelEditForm13::Run('LnTankLevelEditForm13', 'template/ln_tank_level_edit.tpl.php');
// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_level_list')
// LnTankLevelListForm13::Run('LnTankLevelListForm13', 'template/ln_tank_level_list.tpl.php');
// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_edit')
// LnTankEditForm13::Run('LnTankEditForm13', 'template/ln_tank_edit.tpl.php');
// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_list')
// LnTankListForm13::Run('LnTankListForm13', 'template/ln_tank_list.tpl.php');

// elseif (__ACCESSED_CONTROLLED_SCRIPT__=='readme')
// ReadmeForm::Run('ReadmeForm', 'template/readme.tpl.php');
?>