<?php
/**
 * @abstract Main landing page for the application.
 * @author w. Patrick Gale
 * - adding view only class (Jan. 15, 2016 - wpg)
 */

// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');

// freezer admin
class IndexForm8 extends QForm {
	protected function Form_Create() {
		QApplication::Redirect('freezers.php');
	}
}

// view only
class IndexForm13 extends IndexForm8 {

}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('index');
?>