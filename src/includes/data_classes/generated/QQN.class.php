<?php
class QQN {
	static public function ActionLog() {
		return new QQNodeActionLog('fm__action_log', null);
	}
	static public function Box() {
		return new QQNodeBox('fm__box', null);
	}
	static public function BoxHistoryLog() {
		return new QQNodeBoxHistoryLog('fm__box_history_log', null);
	}
	static public function FreezerMaintenance() {
		return new QQNodeFreezerMaintenance('fm__freezer_maintenance', null);
	}
	static public function Rack() {
		return new QQNodeRack('fm__rack', null);
	}
	static public function Sample() {
		return new QQNodeSample('fm__sample', null);
	}
	static public function SampleHistoryLog() {
		return new QQNodeSampleHistoryLog('fm__sample_history_log', null);
	}
	static public function SampleContainerTypes() {
		return new QQNodeSampleContainerTypes('fm__sample_container_types', null);
	}
	static public function SampleStateTypes() {
		return new QQNodeSampleStateTypes('fm__sample_state_types', null);
	}
	static public function SampleTypes() {
		return new QQNodeSampleTypes('fm__sample_types', null);
	}
	static public function Sampleboxes() {
		return new QQNodeSampleboxes('fm__sampleboxes', null);
	}
	static public function SampleSelection() {
		return new QQNodeSampleSelection('fm__sample_selection', null);
	}
	static public function Session() {
		return new QQNodeSession('fm__session', null);
	}
	static public function TypeOfBox() {
		return new QQNodeTypeOfBox('fm__type_of_box', null);
	}
	static public function TypeOfRack() {
		return new QQNodeTypeOfRack('fm__type_of_rack', null);
	}
	static public function TypeUserAccess() {
		return new QQNodeTypeUserAccess('pt__type_user_access', null);
	}
	static public function User() {
		return new QQNodeUser('pt__user', null);
	}
	static public function Freezer() {
		return new QQNodeFreezer('fm__freezer', null);
	}
	static public function UserLoginTrack() {
		return new QQNodeUserLoginTrack('pt__user_login_track', null);
	}
	static public function FmStudy() {
		return new QQNodeFmStudy('fm__study', null);
	}
}
?>