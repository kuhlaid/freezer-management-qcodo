<?php
// print phpinfo();
// $servername = getenv('DB_SERVER');
// $username = getenv('DB_USER');
// $password = getenv('DB_PASSWORD');
// $database =  getenv('DB_NAME');
// $port = 3306;

// // Create connection
// $conn = new mysqli($servername, $username, $password, $database, $port);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully!!";
// exit; 

require('includes/prepend.inc.php');

if (!defined('__LOGGED_USER_ID__'))
	define ('__LOGGED_USER_ID__', '');
$lv = QSessionDB::get("__LAST_VISITED_PAGE__");
QSessionDB::DeleteAll();
QSessionDB::Initialize();
QSessionDB::set("__LAST_VISITED_PAGE__",$lv);
$onyen = 'user1';	// auto login

//require_once( 'includes/onyen_auth.php' );

// if there was a problem with the authentication
if (QSessionDB::get('onyenErr')=="yes" || $onyen == '') {
	errorAlert("There was a problem logging in.  Please try again.  Note: you must login within 2 minutes or your login will fail and you will need to try again. Err:lo_oa1", "document.location.href='".__SUBDIRECTORY__."/login.php'");
}
// else authentication passed
else {
	$objUser = User::QuerySingle(
			QQ::AndCondition(
					QQ::Equal(QQN::User()->Onyen, $onyen),
					QQ::Equal(QQN::User()->Active, 1)
			)
	);

	// audit track login attempts
	$objUserLoginTrack = new UserLoginTrack();
	$objUserLoginTrack->Attempted = QDateTime::Now(true);
	$objUserLoginTrack->Ip = $_SERVER['REMOTE_ADDR'];

	// if user logged in
	if (isset($objUser)) {
		QSessionDB::set(__SESSION_PREFIX__.'LoggedInUserObj', serialize($objUser));	// save user object to session
		// successful login attempt tracking
		$objUserLoginTrack->UserId = $objUser->Userid;
		$objUserLoginTrack->LoginPassed = true;
		$objUserLoginTrack->Save();
			
		// if we have a last visited page saved then redirect to that
		// else redirect to the main admin page
		//if (QSessionDB::get('__LAST_VISITED_PAGE__'))
		//	header("Location: ".QSessionDB::get('__LAST_VISITED_PAGE__'));
		//else

		header("Location: ".__SUBDIRECTORY__."/index.php");
	}
	else {
		QSessionDB::set('error', 'Your login failed, please try again.');
		// failed login attempt tracking
		$objUserLoginTrack->LoginPassed = false;
		$objUserLoginTrack->UserNameAttempt = $onyen;
		$objUserLoginTrack->Save();
	}

}

?>
