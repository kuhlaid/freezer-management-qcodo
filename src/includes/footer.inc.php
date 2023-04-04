<?php
/**
 * Aug. 30, 2017 - wpg
 * - finished adding the moving box scripts to show where samples are in the moving box
 *
 * Aug. 24, 2017 - wpg
 * - adding a link to prompt the user to set a moving box for a sample pull if one is not selected
 *
 */

?><div id="hdBanner" class="noPrint">
	<?=__APPLICATION_NAME__;?>
	<div class="sm" style="margin-left: 2px;">Freezer management
		application</div>
</div>
<style type="text/css" media="screen, print">
.tinySlot {
	border: 1px solid #efefef;
	border-right: 1px solid #858585;
	border-bottom: 1px solid #858585;
	height: 10px;
	width: 10px;
	margin: 0px;
	padding: 0px;
}
.rackSlot {
	border: 1px solid #efefef;
	border-right: 1px solid #858585;
	border-bottom: 1px solid #858585;
	height: 10px;
	width: 20px;
	margin: 0px;
	padding: 0px;
}
.tinyBox {
	padding: 0px;
	margin: 0px;
	line-height: 0px;
}
.tinyBox .stp, .stp {
	background-color: green;
	color: #fff;
}
</style>
<?php 
if (!defined('__HIDE_FOOTER__')) {
if (defined('__script_log__')) print scriptLog(__script_log__);	// print out script log?>
<?php
// This example footer.inc.php is intended to be modfied for your application.
QSessionDB::set('error', ' ');

// again, replace '1' with whatever database connection you are using
//QApplication::$Database[1]->OutputProfiling();

// if we are in sample search/selection mode
if(isset($objSampleSelection)) {


	function boxBuild($startSlot,$highlightSlot,$columnCount,$stopSlot){
		$strMoveBoxSamples='';
		$count=$startSlot;
		for($a=$startSlot;$a<=$stopSlot;$a++) {
			$stp = '';
			if ($highlightSlot == $a) $stp = 'stp';

			$strMoveBoxSamples.= '<img src="'.__IMAGE_ASSETS__.'/blank.gif" class="tinySlot '.$stp.'"/>';

			// we have reached the end of the column
			if (($count % $columnCount) == 0 )
				$strMoveBoxSamples.= '<br/>
						';
				$count++;
		}
		return $strMoveBoxSamples;
	}

	function movingBoxStart() {
		return '<div class="tinyBox">';
	}

	function movingBoxEnd() {
		return '</div></div>';
	}
	?>
<div class="txtalignC noPrint"
	style="position: fixed; top: 0px; right: 0px; background-color:#fff; border:1px solid #000; padding:5px; opacity: 0.8;
	filter: alpha(opacity = 80)">
	<div>
		Sample search mode enabled:
		<div>
			<div class="sm"><?=$objSampleSelection->__toString();?></div>
			<a href="sample_selection.php?intId=<?=$objSampleSelection->Id;?>" class="bld">End sample pull</a> |
			<a href="sample-pull.php" class="bld">View sample pull</a>
		</div>
		<?php
		$intBoxCount = $sampleSlot = 0;
		$boxId = $boxRowCount = $boxColumnCount = $strSampleToPull = '';
		$strMoveBoxSamples='';
		if ($objMovingBox) {
			$objSampleMoveArray = Sample::QueryArray(QQ::Equal(QQN::Sample()->BoxId, $objMovingBox->Id), QQ::Clause(QQ::OrderBy(QQN::Sample()->BoxSampleSlot)));

			if ($objSampleMoveArray) foreach ($objSampleMoveArray as $objSampleMove) {
				//if ($strSampleToPull != "") $strSampleToPull .= "<br/>";
				//$strSampleToPull .= "<b>".$objSampleMove->StudyCase."</b> (<i>".$objSampleMove->Barcode."</i>) - <b>".$objSampleMove->Box->Name."</b> (<i>".$objSampleMove->BoxSampleSlot."</i>)";
				// we are starting with our first sample or a new box
				// else we are staying with the box we have already started
				if ($boxId != $objSampleMove->BoxId){
					if ($boxId != "") {
						$intBoxCount++;
						// need to close the box
						$strMoveBoxSamples .= boxBuild($sampleSlot+1,null,$boxColumnCount,($boxColumnCount*$boxRowCount));
						$strMoveBoxSamples .= movingBoxEnd();
					}
					//QApplication::DisplayAlert($objSampleMove->BoxSampleSlot);
					// start the box
					$strMoveBoxSamples .= movingBoxStart();
					$strMoveBoxSamples .= boxBuild(1,$objSampleMove->BoxSampleSlot,$objSampleMove->Box->BoxType->Columns,$objSampleMove->BoxSampleSlot);
				}
				else {
					//QApplication::DisplayAlert($objSampleMove->BoxSampleSlot);
					// continue with the box
					$strMoveBoxSamples .= boxBuild($sampleSlot+1,$objSampleMove->BoxSampleSlot,$objSampleMove->Box->BoxType->Columns,$objSampleMove->BoxSampleSlot);
				}

				// save the selected box, sample slot location, and box size
				$boxId = $objSampleMove->BoxId;
				if ($objSampleMove->Box->BoxType->Columns)
					$boxColumnCount = $objSampleMove->Box->BoxType->Columns;
				if ($objSampleMove->Box->BoxType->Rows)
					$boxRowCount = $objSampleMove->Box->BoxType->Rows;
				if ($objSampleMove->BoxSampleSlot)
					$sampleSlot = $objSampleMove->BoxSampleSlot;
			}
			else {
				// no samples exist in the moving box
				$strMoveBoxSamples = movingBoxStart();
				// build the empty box view
				for ($c=1; $c <= $objMovingBox->BoxType->Rows; $c++) {
					$strMoveBoxSamples .= boxBuild(1,null,$objMovingBox->BoxType->Columns,$objMovingBox->BoxType->Columns);
				}
				$strMoveBoxSamples .= movingBoxEnd();
			}
			$strMovingBoxTxt = "Moving box set to: <a href='box-view.php?intId=".$objMovingBox->Id."' class='bld'>".$objMovingBox->Name."</a>";
		}
		else {
			$strMovingBoxTxt = "<a href='boxes.php' class='bld'>Please set a moving box</a>";
		}

		// need to close the box
		if (is_int($sampleSlot) && is_int($boxColumnCount) && is_int($boxRowCount))
			$strMoveBoxSamples .= boxBuild($sampleSlot+1,null,$boxColumnCount,($boxColumnCount*$boxRowCount));
		print $strMovingBoxTxt.$strMoveBoxSamples;

		?>
	</div>
	<?php } 
// if we are in box-move-to-rack mode
$objRack = Rack::LoadById(FM2013Session::GetSession(1));
if($objRack) {
	function rackBuild($intRows, $intColumns, $intBoxCount){
		$strMoveBoxSamples='';
		$columnCount=0;
		for($a=1; $a <= $intRows*$intColumns; $a++) {
			$columnCount++;
			$stp = '';
			if ($a <= $intBoxCount) $stp = 'stp';	// hightlight boxes occupying the rack
			$strMoveBoxSamples.= '<img src="'.__IMAGE_ASSETS__.'/blank.gif" class="rackSlot '.$stp.'"/>';
			// we have reached the end of the column
			if ($columnCount == $intColumns) {
				$strMoveBoxSamples.= '<br/>';
				$columnCount=0;
			}
		}
		return $strMoveBoxSamples;
	}
	?>
	asdf
<div class="txtalignC noPrint"
	style="position: fixed; top: 0px; right: 0px; background-color:#fff; border:1px solid #000; padding:5px; opacity: 0.8;
	filter: alpha(opacity = 80)">
	<div>
		Rack selection mode enabled:
		<div>
			<a href="rack.php?intDeselectRackId=<?=FM2013Session::GetSession(1);?>" class="bld">End rack selection</a>
		</div>
		<?php
		$intBoxCount = $sampleSlot = 0;
		$boxId = $rackRowCount = $rackColumnCount = '';
		$intBoxCount = Box::QueryCount(QQ::Equal(QQN::Box()->RackId,$objRack->Id));
		$strMoveBoxSamples = rackBuild($objRack->RackType->Rows, $objRack->RackType->Columns, $intBoxCount);
		$strMovingBoxTxt = "<div class='fs14'><a href='boxes.php?intRack=".$objRack->Id."' class='bld'>Rack: ".$objRack->Name."</a></div>";
		print $strMovingBoxTxt.$strMoveBoxSamples;
		?>
	</div>
	<?php } ?>
</div>

<div style="clear: both;"></div>
<div>
	<br />
</div>

</div>
<?php } ?>
</body>
</html>