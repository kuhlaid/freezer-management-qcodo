<?php
// Include prepend.inc to load Qcodo
require('../includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
// require('prepend.inc.php');				/* if you DO have "includes/" in your include_path */

// Include the classfile for SampleboxesListFormBase
require(__FORMBASE_CLASSES__ . '/SampleboxesListFormBase.class.php');

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();

/**
 * This is a quick-and-dirty draft form object to do the List All functionality
 * of the Sampleboxes class.  It extends from the code-generated
 * abstract SampleboxesListFormBase class.
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
class SampleboxesListForm extends SampleboxesListFormBase {
	// Override Form Event Handlers as Needed
	//		protected function Form_Run() {}

	//		protected function Form_Load() {}

	//		protected function Form_Create() {
	//			parent::Form_Create();
	//		}

	//		protected function Form_PreRender() {}

	//		protected function Form_Exit() {}
}

// Go ahead and run this form object to generate the page and event handlers, using
// generated/sampleboxes_list.tpl.php as the included HTML template file
SampleboxesListForm::Run('SampleboxesListForm', 'generated/sampleboxes_list.tpl.php');
?>