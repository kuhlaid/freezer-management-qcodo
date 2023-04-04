<?php
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/TypeOfRackEditFormBase.class.php');
QApplication::CheckRemoteAdmin();

class TypeOfRackEditForm extends TypeOfRackEditFormBase {

	protected function RedirectToListPage() {
		QApplication::Redirect('types_of_rack.php');
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('type_of_rack');
?>