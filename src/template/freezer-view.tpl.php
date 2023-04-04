<?php
/**
 * @author w. Patrick Gale
 * - adding tab for freezer descriptions so users can easily switch between the contents and the freezer descriptions/list (Jan. 21, 2016 - wpg)
 */

// kick user away from script if they are not going through the proper channels
if (!defined('__PREPEND_INCLUDED__')) exit;

define('__SEL_MENU__', _strFormCabinetFreezerView_);
$strPageTitle = _strFormCabinetFreezerView_;
require(__INCLUDES__ . '/header.inc.php');

// @todo - need to store these image file references in the database at some point instead of hard coding
$fi = '<img src="'.__IMAGE_ASSETS__.'/upright-freezer.jpg" border="0" height="140px">';
if (__QUERY_STATUS_FVintF__ == 1)
	$fi = '<img src="'.__IMAGE_ASSETS__.'/chest-freezer.jpg" border="0" height="140px">';
elseif (__QUERY_STATUS_FVintF__ == 7)
$fi = '<img src="'.__IMAGE_ASSETS__.'/ln-freezer.jpg" border="0" height="140px">';
elseif (__QUERY_STATUS_FVintF__ == 9)
$fi = '<img src="'.__IMAGE_ASSETS__.'/plasma-freezer.jpg" border="0" height="140px">';
// added July 25, 2017 - wpg
elseif (__QUERY_STATUS_FVintF__== 12)
$fi = '<img src="'.__IMAGE_ASSETS__.'/MVE-815P-190.png" border="0" height="140px">';
?>

<?php $this->RenderBegin() ?>
<div class="fltR">
	<?=$fi;?>
</div>
<div class="title">
	<?=_strFormCabinetFreezerView_; ?>
</div>
<div>This view shows the racks and boxes stored in a selected freezer
	below. Racks or boxes will be highlighted in green if they have been
	inventoried.</div>
<hr />
<?php $this->lstSearch->RenderNoBreaks(); ?>
<?php $this->strNotice->RenderNoBreaks(); ?>
<div class='tab_bar'>
	<br />
	<?php 	print '<a href="?strTabStatus=a&intFreezer='.$this->lstSearch->SelectedValue.'" class="status_tab_active">Space used/available</a> ';
	print '<a href="freezers.php" class="status_tab">Descriptions</a>';
	// 	$arrayStatus = array("Space used/available"=>'a', "Descriptions"=>'b');//, "Contents"=>'b'
	// 	foreach ($arrayStatus as $key => $value) {
	// 			if (__QUERY_STATUS_FV__ == $value) $class = "status_tab_active";
	// 			else $class = "status_tab";
	// 			print '<a href="?strTabStatus='.$value.'&intFreezer='.$this->lstSearch->SelectedValue.'" class="'.$class.'">'.$key.'</a> ';
	// 		}
	?>
</div>
<br />
<?php $this->freezerView->Render(); ?>
<br class="clr" />
<?php $this->RenderEnd() ?>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>