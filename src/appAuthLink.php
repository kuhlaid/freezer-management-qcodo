<?php
// verify if a user has access to the application or not

	require('includes/prepend.inc.php');

	// need to check querystring for session data string
		$onyen = QApplication::QueryString('onyen');
		// see if user have access
		$objUser = User::QuerySingle(
			QQ::AndCondition(
				QQ::Equal(QQN::User()->Onyen, $onyen),
				QQ::Equal(QQN::User()->Active, 1)
			));
		
		// if user has access
		if (isset($objUser)) {	
				$objTypeUserAccessArray = TypeUserAccess::LoadArrayByUserAsAcl($objUser->Userid);

				if ($objTypeUserAccessArray) foreach ($objTypeUserAccessArray as $objTypeUserAccess) {
					// if freemzer admin, then give access
					if ($objTypeUserAccess->Id == 8){
						print 'true';
						break;
					}
				}
		}
else print 'false';
?>
