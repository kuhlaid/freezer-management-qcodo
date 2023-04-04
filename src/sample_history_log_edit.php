<?php
// Include prepend.inc to load Qcodo
require('../includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
// require('prepend.inc.php');				/* if you DO have "includes/" in your include_path */

// Include the classfile for SampleHistoryLogEditFormBase
require(__FORMBASE_CLASSES__ . '/SampleHistoryLogEditFormBase.class.php');

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();

/**
 * This is a quick-and-dirty draft form object to do Create, Edit, and Delete functionality
 * of the SampleHistoryLog class.  It extends from the code-generated
 * abstract SampleHistoryLogEditFormBase class.
 *
 * Any display customizations and presentation-tier logic can be implemented
 * here by overriding existing or implementing new methods, properties and variables.
 *
 * Additional qform control objects can also be defined and used here, as well.
 *
 * @package My Application
 * @subpackage FormDraftObjects
 *
*/
class SampleHistoryLogEditForm extends SampleHistoryLogEditFormBase {
	// Override Form Event Handlers as Needed
	//		protected function Form_Run() {}

	//		protected function Form_Load() {}

	//		protected function Form_Create() {
	//			parent::Form_Create();
	//		}

	//		protected function Form_PreRender() {}

	//		protected function Form_Exit() {}
}

// Go ahead and run this form object to render the page and its event handlers, using
// generated/sample_history_log_edit.tpl.php as the included HTML template file
SampleHistoryLogEditForm::Run('SampleHistoryLogEditForm', 'generated/sample_history_log_edit.tpl.php');
?>