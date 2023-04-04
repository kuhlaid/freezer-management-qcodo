<?php
exit;
/**
 * @abstract This is a report view of different states of our biological boxes.  The report shows:
 * - boxes
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();

class BoxReportForm8 extends QForm {

}


// go to the centralized form executing access control function to run the form and check access control
ACL_Run('box_report');
?>