<?php
// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_MENU__', _strFormStudyProject_);
$strPageTitle = _strFormStudyProject_;
require(__INCLUDES__ . '/header.inc.php');
?>

<?php $this->RenderBegin() ?>
<div class="title">
	<?=$strPageTitle;?>
	<div  id="createOpt">Add a <a href="study_project.php">study/project</a></div>
</div>
<div>This view lists the studies or projects that will be assigned to freezer samples.</div>
		<br class="item_divider" />

		<?php $this->dtgFmStudy->Render() ?>

	<?php $this->RenderEnd() ?>
	
<?php require(__INCLUDES__ . '/footer.inc.php'); ?>