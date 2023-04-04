<?php
	// Include prepend.inc to load Qcodo
	require('includes/prepend.inc.php');

	QApplication::CheckRemoteAdmin();

	$strPageTitle = 'Code generation';
	require(__INCLUDES__ . '/header.simple.inc.php');
?>

	<div id="titleBar">
		<h1><?=$strPageTitle;?></h1>
	</div>

	<div id="draftList">
		<p class="create"><a href="/_devtools/codegen.php">Generate new code from the database</a> &nbsp;|&nbsp; <a href="/ajax_drafts/index.php">View Ajax forms</a> &nbsp;|&nbsp; <a href="/form_drafts/index.php">View PHP forms</a></p>
	</div>

<?php require (__INCLUDES__ . '/footer.inc.php'); ?>