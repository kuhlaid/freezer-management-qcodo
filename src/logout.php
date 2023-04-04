<?php
	require('includes/prepend.inc.php');

	$lv = QSessionDB::get("__LAST_VISITED_PAGE__");
	QSessionDB::DeleteAll();
	QSessionDB::Initialize();
	QSessionDB::set("__LAST_VISITED_PAGE__",$lv);
	QApplication::Redirect(__DOMAIN_URL__.'/secure/logout.php');
?>