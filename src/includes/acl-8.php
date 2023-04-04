<?php
if (!defined('__PREPEND_INCLUDED__')) exit;
/*
 * @abstract Executes the requested script after being checked for access. Moved access to one file so
* we can easily see what a type of user can access.  This provides access for Freezer admin.
* @author w. Patrick Gale - Jan. 2013
*/
if (__ACCESSED_CONTROLLED_SCRIPT__=='index')
	IndexForm8::Run('IndexForm8', 'template/index.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='frz_inventory_list')
FrzInventoryListForm8::Run('FrzInventoryListForm8', 'template/frz_inventory_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='frz_inventory_edit')
FrzInventoryEditForm8::Run('FrzInventoryEditForm8', 'template/frz_inventory_edit.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='freezer-maintenance-logs')
FreezerMaintenanceListForm8::Run('FreezerMaintenanceListForm8', 'template/freezer_maintenance_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='freezer-maintenance')
FreezerMaintenanceEditForm8::Run('FreezerMaintenanceEditForm8', 'template/freezer_maintenance_edit.tpl.php');


elseif (__ACCESSED_CONTROLLED_SCRIPT__=='move-rack')
MoveRackForm8::Run('MoveRackForm8', 'template/move-rack.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='sample_list')
SampleListForm8::Run('SampleListForm8', 'template/sample_list.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='sample_consents')
SampleConsentListForm8::Run('SampleConsentListForm8', 'template/sample_consent_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='sample_consent')
SampleConsentEditForm8::Run('SampleConsentEditForm8', 'template/sample_consent_edit.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='box-view_edit')
BoxEditForm8::Run('BoxEditForm8', 'template/box-view_edit.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='box-view_list')
BoxListForm8::Run('BoxListForm8', 'template/box-view_edit.tpl.php');

// added additional view for pulling samples (Aug. 24, 2017 - wpg)
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='box-sample-pull')
	BoxSamplePullForm8::Run('BoxSamplePullForm8', 'template/box-sample-pull.tpl.php');

// sample pull report access
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='sample-pull')
SamplePullReport::Run('SamplePullReport', 'template/sample-pull.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='box_list')
BoxListForm8::Run('BoxListForm8', 'template/box_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='rack_list')
RackListForm8::Run('RackListForm8', 'template/rack_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='rack_edit')
RackEditForm8::Run('RackEditForm8', 'template/rack_edit.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='FreezerView_bf')
FreezerView8_bf::Run('FreezerView8_bf', 'template/freezer-view.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='FreezerView_af')
FreezerView8_af::Run('FreezerView8_af', 'template/freezer-view.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='FreezerView_b')
FreezerView8_b::Run('FreezerView8_b', 'template/freezer-view.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='FreezerView_a')
FreezerView8_a::Run('FreezerView8_a', 'template/freezer-view.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='types_of_boxes')
TypeOfBoxListForm8::Run('TypeOfBoxListForm8', 'template/type_of_box_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='type_of_box')
TypeOfBoxEditForm8::Run('TypeOfBoxEditForm8', 'template/type_of_box_edit.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='find_samples')
FindSamples8::Run('FindSamples8', 'template/find_samples.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='add_samples')
AddSamples8::Run('AddSamples8', 'template/add_samples.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='freezers')
FreezerListForm8::Run('FreezerListForm8', 'template/freezer_list.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='freezer')
FreezerEditForm::Run('FreezerEditForm', 'template/freezer_edit.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='box_edit')
BoxEditForm8::Run('BoxEditForm8', 'template/box_edit.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='co_2_edit')
Co2EditForm8::Run('Co2EditForm8', 'template/co_2_edit.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='co_2_list')
Co2ListForm8::Run('Co2ListForm8', 'template/co_2_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='box_report')
BoxListForm8::Run('BoxListForm8', 'template/box_report.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='box-view_list')
BoxListFormV2_8::Run('BoxListFormV2_8', 'template/box-view_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_level_edit')
LnTankLevelEditForm8::Run('LnTankLevelEditForm8', 'template/ln_tank_level_edit.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_level_list')
LnTankLevelListForm8::Run('LnTankLevelListForm8', 'template/ln_tank_level_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_edit')
LnTankEditForm8::Run('LnTankEditForm8', 'template/ln_tank_edit.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ln_tank_list')
LnTankListForm8::Run('LnTankListForm8', 'template/ln_tank_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='sample_edit')
SampleEditForm8::Run('SampleEditForm8', 'template/sample_edit.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='readme')
ReadmeForm::Run('ReadmeForm', 'template/readme.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='sample_history_logs')
SampleHistoryLogListForm::Run('SampleHistoryLogListForm', 'template/sample_history_log_list.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='box_history_logs')
BoxHistoryLogListForm::Run('BoxHistoryLogListForm', 'template/box_history_log_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='box_history_log')
BoxHistoryLogEditForm::Run('BoxHistoryLogEditForm', 'template/box_history_log_edit.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='types_of_rack')
TypeOfRackListForm::Run('TypeOfRackListForm', 'template/type_of_rack_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='type_of_rack')
TypeOfRackEditForm::Run('TypeOfRackEditForm', 'template/type_of_rack_edit.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='types_of_sample')
SampleTypesListForm::Run('SampleTypesListForm', 'template/sample_types_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='type_of_sample')
SampleTypesEditForm8::Run('SampleTypesEditForm8', 'template/sample_types_edit.tpl.php');

elseif (__ACCESSED_CONTROLLED_SCRIPT__=='sample_selections')
SampleSelectionListForm::Run('SampleSelectionListForm', 'template/sample_selection_list.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='sample_selection')
SampleSelectionEditForm::Run('SampleSelectionEditForm', 'template/sample_selection_edit.tpl.php');
// added Oct. 30, 2018 - wpg
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='ActionLogs')
	ActionLogListForm::Run('ActionLogListForm', 'template/ActionLogs.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='study_project_list')
	FmStudyListForm8::Run('FmStudyListForm8', 'template/study_projects.tpl.php');
elseif (__ACCESSED_CONTROLLED_SCRIPT__=='study_project')
	FmStudyEditForm8::Run('FmStudyEditForm8', 'template/study_project.tpl.php');
?>