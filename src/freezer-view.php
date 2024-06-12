<?php
/**
 * @abstract This report helps to show racks and space in the freezers.
 * @author w. Patrick Gale (2012)
 * 
 * Oct. 5, 2020 - wpg
 * - adding a string to show alerts regarding a freezer
 * 
 * March 19, 2020 - wpg
 * - updating the hoverover content of racks to show box sample type
 * - working on updating the shelf views to show empty racks
 * 
 * Logic:
 * 
 * This report view is used to give a broad look at what racks or boxes are on each shelf of the -80 freezers (not the LN freezer).
 * A freezer list is provided so a user can select the freezer they wish to view.  Additional tabs are available to show either the
 * space available or contents of the freezer.  The contents are shown as either racks or standalone boxes; clicking on a rack or box
 * will redirect the user to a listing of the boxes within the rack or the details of the selected box.
 * 
 * 5\30\2013 - wpg
 * Adding tabs for showing space available or contents of the freezers, and creating appropriate reporting views (previously
 * there was only a freezer selection list, that when selected, would show the racks or boxes in each shelf of the freezer).
 * Wanted to add a 'space avaiable' for each freezer so we could keep track of how fast the freezers were filling during sample
 * collection periods.
 *
 * - adding view-only access (Jan. 16, 2016 - wpg)
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');
require(__FORMBASE_CLASSES__ . '/BoxListFormBase.class.php');
QApplication::CheckRemoteAdmin();

// base class that was built for content view but will be used to extend into space available
class FreezerView extends BoxListFormBase {
	protected $lstSearch, $freezerView, $q_status, $objTypeOfRackArray, $objTypeOfBoxArray, $strNotice;
	protected function Form_Create() {
		// preload the types of boxes and racks so we don't make multiple trips for this data
		$this->objTypeOfRackArray = TypeOfRack::QueryArray(QQ::All(),null,null,array('id','name','`rows`','columns','box_count','depth'));
		$this->objTypeOfBoxArray = TypeOfBox::QueryArray(QQ::All(),null,null,array('id','width','height'));

		// define the width we are wanting to display the freezer space on the screen
		define("__FREEZER_VIEW_FREEZER_WIDTH__", 790);
		define("__FREEZER_VIEW_FREEZER_HEIGHT__", 90);

		$this->freezerView_Create();
		$this->lstSearch_Create();
		$this->strNotice_Create();
		//$this->freezerViewSet();
	}

	protected function strNotice_Create() {
		$this->strNotice = new QPlain($this);
		// here we need to query the maintenance log for any alerts
		$objFreezerMaintenanceArray = FreezerMaintenance::QueryArray(
			QQ::AndCondition(
			QQ::Equal(QQN::FreezerMaintenance()->FreezerAsFrzMain->FreezerId, __QUERY_STATUS_FVintF__),
			QQ::Equal(QQN::FreezerMaintenance()->AlertUser, 1)
			)
		);
		$strReturn = '';
		if ($objFreezerMaintenanceArray) foreach($objFreezerMaintenanceArray as $objFreezerMaintenance){
			$strReturn .= '<div class="alert alert-danger"><a href="freezer-maintenance.php?intId='.$objFreezerMaintenance->Id.'" title="Edit the log">'.$objFreezerMaintenance->MainLog.'</a><div>- '.$objFreezerMaintenance->LogDate->toString(QDateTime::FormatDisplayDate).'</div></div>';
		}
			$this->strNotice->Text = $strReturn;
	}

	// select a freezer to show information on
	protected function lstSearch_Create() {
		$this->lstSearch = new QListBox($this);
		$this->lstSearch->Name = "<span class='title cGray'>Select a freezer: </span>";
		$this->lstSearch->CssClass = 'title';
		$this->lstSearch->HtmlAfter = '<br/><br/>';
		//if (__QUERY_STATUS_FVintF__ == '')
		$objFreezerArray = Freezer::QueryArray(QQ::Equal(QQN::Freezer()->InUse,1),QQ::Clause(QQ::OrderBy(QQN::Freezer()->Name)),null, array('name','id'));
		$this->lstSearch->AddItem("-- all freezers --",null);
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$objListItem = new QListItem($objFreezer->__toString(), $objFreezer->Id);
			if ((__QUERY_STATUS_FVintF__) && (__QUERY_STATUS_FVintF__ == $objFreezer->Id))
				$objListItem->Selected = true;
			$this->lstSearch->AddItem($objListItem);
		}
		$this->lstSearch->AddAction(new QChangeEvent(), new QServerAction('freezerViewChange'));
	}

	//@BL using a plain component to build the custom freezer view
	protected function freezerView_Create(){
		$this->freezerView = new QPlain($this);
	}

	// what happens when we select a freezer to view information on
	protected function freezerViewChange() {
		QApplication::Redirect('?intFreezer='.$this->lstSearch->SelectedValue.'&strTabStatus='.__QUERY_STATUS_FV__);
	}

	// output shelf wrapper html
	protected function startShelfView($n,$w=__FREEZER_VIEW_FREEZER_WIDTH__) {
		return "<div class='fshelf' style='float:left;border:1px dashed #000;width:".$w."px;min-height:60px;padding:0px;margin-bottom:20px;'><div class='fshelfnumb' style='text-align:left;height:auto;padding:3px;width:auto;color:#fff;background-color:#627DBD;font-size:14px;'>shelf ".$n."</div>";
	}

	// build the actual view for the freezer
	//select boxes from selected freezer order by shelf desc and rack; for each shelf display each box unless it is in a rack then just show rack
	protected function freezerViewSet() {
		$objDbResult='';
		$strFreezerShelfWidthPx=__FREEZER_VIEW_FREEZER_WIDTH__;
		$strFreezerShelfWidthIn=$strFreezerShelfHeightIn=90;
		$strFreezerWidthMultiplier=0;	// will be used to determine the width of the racks and boxes relative to the displayed shelf width
		if ($this->lstSearch->SelectedValue) {
			$objFreezer = Freezer::QuerySingle(QQ::Equal(QQN::Freezer()->Id, $this->lstSearch->SelectedValue),null,null,array('shelf_width_in','shelf_height_in'));
			if ($objFreezer->ShelfWidthIn) {
				$strFreezerShelfWidthIn=$objFreezer->ShelfWidthIn;
			}
			if ($objFreezer->ShelfHeightIn) {
				$strFreezerShelfHeightIn=$objFreezer->ShelfHeightIn;
			}
			$objDbResult = Box::LoadArrayByFreezerId($this->lstSearch->SelectedValue,QQ::Clause(QQ::OrderBy(QQN::Box()->Shelf,1,QQN::Box()->Rack,1,QQN::Box()->Name,1)),null,array('id','name','box_type_id'));
		}
		$strShelfContents=$shelf=$rack=$boxes='';
		if ($objDbResult)
			foreach ($objDbResult as $objBox){
			// check to see which self we first have samples on
		if ($shelf =='' && $objBox->Shelf!=1){
			for($i=1; $i<$objBox->Shelf; $i++ ){
				$strShelfContents.=$this->startShelfView($i,$strFreezerShelfWidthPx);
				$strShelfContents.="</div>";
			}
			//$shelf=$objBox->Shelf;
		}

		// foreach box check to see if we are changing shelves and if so then
		if ($objBox->Shelf != $shelf){

			if ($boxes!="")$strShelfContents.=$boxes;	// add any boxes to the end if we have some
			if ($strShelfContents!="" && $shelf !='')$strShelfContents.="</div>";

			$shelf=$objBox->Shelf;
			$boxes='';	// reset boxes when moving to another shelf
			$strShelfContents.=$this->startShelfView($objBox->Shelf,$strFreezerShelfWidthPx);
		}
		// if the box is in a rack
		// else the box is not in a rack
		if ($objBox->RackId != ''){
			// if we are changing racks then add it
			if ($objBox->RackId != $rack){
				$rack = trim($objBox->RackId ?? '');
				$notes='';
				$rWidth = 113;
				if ($objBox->RackId) {
					$depth='';
					$objRack = Rack::QuerySingle(QQ::Equal(QQN::Rack()->Id, $objBox->RackId),null,null,array('id','rack_type_id','notes','name'));
					//$objBoxArray = Box::QueryArray(QQ::Equal(QQN::Box()->RackId, $intRackId)
					if ($this->objTypeOfRackArray) foreach($this->objTypeOfRackArray as $objTypeOfRack) {
						if ($objTypeOfRack->Id == $objRack->RackTypeId) {
							$depth = $objTypeOfRack->Depth;
							break;
						}
					}
					// if we know the rack depth then we will try to determine a good width to display the rack
					if ($depth != '' && $strFreezerShelfWidthIn) {
						$rCount = $strFreezerShelfWidthIn/$depth;	// determine how many racks will fit on a shelf
						$rWidth=(__FREEZER_VIEW_FREEZER_WIDTH__-(16*$rCount))/$rCount; // we need to subtract the total freezer shelf width (pixels) by (the number of racks that can fit per shelf times the padding/margin/border we will display for each rack) and divide that by the number of racks that will fit on the shelf and that should tell us how wide to draw the racks on the screen to be proportional to the shelf width (we are not concerned with the height so much)
					}
				}
				if ($objRack && $objRack->Notes != '') $notes=" <span class='sm cGray'>".$objRack->Notes."</span>";
				$strShelfContents.="<a class='frack' style='float:left;border:1px solid #000;width:".$rWidth."px;height:100px;padding:5px;margin:2px;background-color:#EDEDED;display:block;' href='boxes.php?intRack=".$objRack->Id."' title='View boxes for this rack'>".$objRack->Name.$notes."</a>";
			}
		}
		else {
			if ($objBox->BoxTypeId && $strFreezerShelfWidthIn) {
				$width=$height='';
				if ($this->objTypeOfBoxArray) foreach($this->objTypeOfBoxArray as $objTypeOfBox) {
					if ($objTypeOfBox->Id == $objBox->BoxTypeId) {
						$width = $objTypeOfBox->Width;
						$height = $objTypeOfBox->Height;
						break;
					}
				}
				// if we know the box width then we will try to determine a good width to display the box
				if ($width != '') {
					$bCount = $strFreezerShelfWidthIn/$width;	// determine how many boxes of this type will fit on a shelf
					$this->bWidth=(__FREEZER_VIEW_FREEZER_WIDTH__-(10*$bCount))/$bCount; // we need to subtract the total freezer shelf width (pixels) by (the number of boxes that can fit per shelf times the padding/margin/border we will display for each box) and divide that by the number of boxes that will fit on the shelf and that should tell us how wide to draw the boxes on the screen to be proportional to the shelf width (we are not concerned with the height so much)
				}


				// if we know the box width then we will try to determine a good width to display the box
				if ($height != '') {
					$bCount = $strFreezerShelfHeightIn/$height;	// determine how many boxes of this type will fit on a shelf
					$this->bHeight=99;//(__FREEZER_VIEW_FREEZER_HEIGHT__-(10*$bCount))/$bCount; // we need to subtract the total freezer shelf width (pixels) by (the number of boxes that can fit per shelf times the padding/margin/border we will display for each box) and divide that by the number of boxes that will fit on the shelf and that should tell us how wide to draw the boxes on the screen to be proportional to the shelf width (we are not concerned with the height so much)
				}
			}

			// we only have raw boxes
			if ($showLink)
				$boxes.="<a class='fbox' style='height:90px;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."' href='boxes.php?intBoxId=".$objBox->Id."'>".$objBox->Name."</a>";//$objBox->Name;
			else
				$boxes.="<div class='fbox' style='height:90px;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."' >".$objBox->Name."</div>";//$objBox->Name;
		}
		}
		if ($boxes!="")$strShelfContents.=$boxes;
		$strShelfContents.="</div>";

		$this->freezerView->Text = '<div>'.$strShelfContents.'<br/></div>';
	}
}

// shows the contents of the selected freezer
class FreezerView8_bf extends FreezerView {
	// nothing needed for this since everything is ready from base class I built
}

/*
 class FreezerListForm8 extends FreezerListFormBase {
protected function Form_Create() {
// Setup DataGrid Columns
$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFreezer_EditLinkColumn_Render($_ITEM) ?>');

$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Id, false)));
$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= $_FORM->dtgFreezer_NameLinkColumn_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Name, false)));
$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= $_ITEM->Description; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Description, false)));
$this->colInUseSince = new QDataGridColumn(QApplication::Translate('In Use Since'), '<?= QString::Truncate($_ITEM->InUseSince, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->InUseSince), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->InUseSince, false)));
$this->colLocation = new QDataGridColumn(QApplication::Translate('Location'), '<?= QString::Truncate($_ITEM->Location, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Location), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Location, false)));
$this->colNShelves = new QDataGridColumn(QApplication::Translate('N Shelves'), '<?= $_ITEM->NShelves; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->NShelves), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->NShelves, false)));
$this->colShelfCuIn = new QDataGridColumn(QApplication::Translate('Shelf (cu in.)'), '<?= $_ITEM->ShelfCuIn; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfCuIn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfCuIn, false)));
$this->colShelfDepthIn = new QDataGridColumn(QApplication::Translate('Shelf Depth (in.)'), '<?= $_ITEM->ShelfDepthIn ? $_ITEM->ShelfDepthIn."\"" : ""; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfDepthIn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfDepthIn, false)));
$this->colShelfWidthIn = new QDataGridColumn(QApplication::Translate('Shelf Width (in.)'), '<?= $_ITEM->ShelfWidthIn ? $_ITEM->ShelfWidthIn."\"" : ""; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfWidthIn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfWidthIn, false)));
$this->colShelfHeightIn = new QDataGridColumn(QApplication::Translate('Shelf Height (in.)'), '<?= $_ITEM->ShelfHeightIn ? $_ITEM->ShelfHeightIn."\"" : ""; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfHeightIn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfHeightIn, false)));
$this->colEditLinkColumn->HtmlEntities = $this->colName->HtmlEntities = false;
$this->colName->HorizontalAlign = QHorizontalAlign::Center;

// Setup DataGrid
$this->dtgFreezer = new QDataGrid($this);
$this->dtgFreezer->CellSpacing = 0;
$this->dtgFreezer->CellPadding = 4;
$this->dtgFreezer->BorderStyle = QBorderStyle::Solid;
$this->dtgFreezer->BorderWidth = 1;
$this->dtgFreezer->GridLines = QGridLines::Both;

// Datagrid Paginator
$this->dtgFreezer->Paginator = new QPaginator($this->dtgFreezer);
$this->dtgFreezer->ItemsPerPage = __ITEMS_PER_PAGE__;

// Specify Whether or Not to Refresh using Ajax
$this->dtgFreezer->UseAjax = false;

// Specify the local databind method this datagrid will use
$this->dtgFreezer->SetDataBinder('dtgFreezer_Bind');

$this->showColumns();
}

protected function showColumns() {
$this->dtgFreezer->AddColumn($this->colEditLinkColumn);
$this->dtgFreezer->AddColumn($this->colName);
$this->dtgFreezer->AddColumn($this->colDescription);
$this->dtgFreezer->AddColumn($this->colInUseSince);
$this->dtgFreezer->AddColumn($this->colLocation);
$this->dtgFreezer->AddColumn($this->colNShelves);
$this->dtgFreezer->AddColumn($this->colShelfCuIn);
$this->dtgFreezer->AddColumn($this->colShelfDepthIn);
$this->dtgFreezer->AddColumn($this->colShelfWidthIn);
$this->dtgFreezer->AddColumn($this->colShelfHeightIn);
}

public function dtgFreezer_EditLinkColumn_Render(Freezer $objFreezer) {
return sprintf('<a href="freezer.php?intId=%s" title="Edit freezer meta data">%s</a>',
		$objFreezer->Id,
		QApplication::Translate('Edit'));
}


public function dtgFreezer_NameLinkColumn_Render(Freezer $objFreezer) {
// @todo - need to store these image file references in the database at some point instead of hard coding
$fi = '<img src="'.__IMAGE_ASSETS__.'/upright-freezer.jpg" border="0" height="150px">';
if ($objFreezer->Id == 1)
	$fi = '<img src="'.__IMAGE_ASSETS__.'/chest-freezer.jpg" border="0" height="150px">';
elseif ($objFreezer->Id == 7)
$fi = '<img src="'.__IMAGE_ASSETS__.'/ln-freezer.jpg" border="0" height="150px">';
elseif ($objFreezer->Id == 9)
$fi = '<img src="'.__IMAGE_ASSETS__.'/plasma-freezer.jpg" border="0" height="150px">';

return sprintf('<a href="freezer-view.php?intFreezer=%s" title="View freezer contents" class="bld fs14">%s<br/>%s</a>',
		$objFreezer->Id,
		$objFreezer->Name,
		$fi);
}
}

*/

// shows the available space of the selected freezer
class FreezerView8_af extends FreezerView {
	protected $bHeight, $bWidth;

	protected function Form_Create() {
		parent::Form_Create();
		$this->freezerViewSet(1);
	}

	protected function freezerViewSetV2($showLink=false) {
		$intShelfCount=0;
		$this->bHeight = 14;
		$this->bWidth = 113;
		$strFreezerShelfWidthPx=__FREEZER_VIEW_FREEZER_WIDTH__;
		$strFreezerShelfWidthIn=$strFreezerShelfHeightIn=90;
		$strFreezerWidthMultiplier=0;	// will be used to determine the width of the racks and boxes relative to the displayed shelf width
		if ($this->lstSearch->SelectedValue) {
			$objFreezer = Freezer::QuerySingle(QQ::Equal(QQN::Freezer()->Id, $this->lstSearch->SelectedValue),null,null,array('shelf_width_in','shelf_height_in','n_shelves'));
			if ($objFreezer->ShelfWidthIn) {
				$strFreezerShelfWidthIn=$objFreezer->ShelfWidthIn;
			}
			if ($objFreezer->ShelfHeightIn) {
				$strFreezerShelfHeightIn=$objFreezer->ShelfHeightIn;
			}
			if ($objFreezer->NShelves)
				$intShelfCount = $objFreezer->NShelves;
			$objDbResult = Box::LoadArrayByFreezerId($this->lstSearch->SelectedValue,QQ::Clause(QQ::OrderBy(QQN::Box()->Shelf,1,QQN::Box()->Rack,1,QQN::Box()->Name,1)),null,array('id','name','box_type_id'));
		}
		
		$strShelfContents='';
		// for each shelf
		if ($intShelfCount>0){
			for($i=1; $i<=$intShelfCount; $i++ ){
				$shelf=$rack=$boxes=$strRacksBoxes=$shelfBoxContent='';
				$strShelfContents.=$this->startShelfView($i,$strFreezerShelfWidthPx);
				// check to see if racks are stored on this shelf
				$objRackArray = Rack::QueryArray(QQ::AndCondition(
					QQ::Equal(QQN::Rack()->Shelf, $i),
					QQ::Equal(QQN::Rack()->Freezer, $this->lstSearch->SelectedValue)
				),null,null,array('id','rack_type_id','notes','name'));
				$intRackIdArray = $boxInRackArray = $objRackBoxArray = $objBoxNoRackArray = [];
				if ($objRackArray) foreach($objRackArray as $objRack){
					array_push($intRackIdArray,$objRack->Id);
					//$objRackByIdArray[$objRack->Id] = $objRack;
				}
				// next we need to find the boxes on this freezer shelf
				$objBoxArray = Box::QueryArray(
					QQ::AndCondition(
						QQ::Equal(QQN::Box()->Shelf, $i),
						QQ::Equal(QQN::Box()->Freezer, $this->lstSearch->SelectedValue)),
						QQ::Clause(QQ::OrderBy(QQN::Box()->Name,1)),null,array('id','name','box_type_id','sample_type_id','rack_id','complete','issues','description'));
				
				// now we need to create a multi-dimensional array of boxes to racks
				if ($objBoxArray) foreach($objBoxArray as $objBox){
					// if the box is not in a rack make note of it
					if ($objBox->RackId=='') {
						//error_log('no rack'.$objBox->Name);
						array_push($objBoxNoRackArray,$objBox);
					}
					else{
						if (!array_key_exists($objBox->RackId,$boxInRackArray))
							$boxInRackArray[$objBox->RackId]=[];
						array_push($boxInRackArray[$objBox->RackId],$objBox);
					}
				}
				unset($objBoxArray);

				// for each rack
				if ($objRackArray) foreach($objRackArray as $objRack) {
					$rackBoxes=	$depth=$notes=$inventoriedBoxes='';
					$rWidth = 113;
					$rackBoxSlots=$intRackBoxCount=$intBoxesInventoried=$blnEmptyRack=0;
					// get the rack specs
					if ($this->objTypeOfRackArray) foreach($this->objTypeOfRackArray as $objTypeOfRack) {
						if ($objTypeOfRack->Id == $objRack->RackTypeId) {
							$depth = $objTypeOfRack->Depth;
							$rackBoxSlots = $objTypeOfRack->BoxCount;
							break;
						}
					}
					// if boxes exist in the rack then let's keep track of the box basic info
					if (array_key_exists($objRack->Id,$boxInRackArray)) {
						$intRackBoxCount=count($boxInRackArray[$objRack->Id]);
						// for each box in the rack
						foreach($boxInRackArray[$objRack->Id] as $objBox) {
							// find out how many boxes are inventoried
							if ($objBox->Complete) $intBoxesInventoried++;

							// keep a list of box descriptions in a rack
							$strSampleType='';
							if (array_key_exists($objBox->SampleTypeId, SampleTypes::$NameArray) && $objBox->SampleTypeId!='')
								$strSampleType=SampleTypes::$NameArray[$objBox->SampleTypeId];
							if ($rackBoxes != '')$rackBoxes.=", ";
							$rackBoxes .= $objBox->Name."(".$strSampleType.")";
						}
						// if we know the rack depth then we will try to determine a good width to display the rack
						// ignoring our chest freezers since they would need to be handled differently
						if ($depth != '' && $strFreezerShelfWidthIn && $objBox->Freezer!=1 && $objBox->Freezer!=7) {
							$rCount = floor($strFreezerShelfWidthIn/$depth);	// determine how many racks will fit on a shelf
							$rWidth=(__FREEZER_VIEW_FREEZER_WIDTH__-(16*$rCount))/$rCount; // we need to subtract the total freezer shelf width (pixels) by (the number of racks that can fit per shelf times the padding/margin/border we will display for each rack) and divide that by the number of racks that will fit on the shelf and that should tell us how wide to draw the racks on the screen to be proportional to the shelf width (we are not concerned with the height so much)
						}

						// get available slots
						if ($rackBoxSlots) {
							if ($rackBoxSlots-$intRackBoxCount)
								$availableSlots = "<div class='bld'>".($rackBoxSlots-$intRackBoxCount)." slots available</div>";
							else 
								$availableSlots = "<div class='bld error'>Rack full</div>";

							// show inventoried boxes or not
							if ($intBoxesInventoried-$intRackBoxCount)
								$inventoriedBoxes = "<div class='sm cGray'>".$intBoxesInventoried."/".$intRackBoxCount." boxes inventoried</div>";
							else
								$inventoriedBoxes = "<div class='req3'>All <b>".$intRackBoxCount."</b> boxes inventoried</div>";
						}
						else
							$availableSlots = "<div class='bld txtalignC'>-unknown slots-</div>";

						$rackBoxes='';
						$objBoxArray = Box::QueryArray(QQ::Equal(QQN::Box()->RackId, $objRack->Id),QQ::Clause(QQ::OrderBy(QQN::Box()->Name,1)),null,array('id','name','box_type_id','sample_type_id'));
						if ($objBoxArray) foreach($objBoxArray as $objBox){
							// keep a list of box descriptions in a rack
							$strSampleType='';
							if (array_key_exists($objBox->SampleTypeId, SampleTypes::$NameArray) && $objBox->SampleTypeId!='')
								$strSampleType=SampleTypes::$NameArray[$objBox->SampleTypeId];
							if ($rackBoxes != '')$rackBoxes.=", ";
							$rackBoxes .= $objBox->Name."(".$strSampleType.")";
						}

						if ($objRack && $objRack->Notes != '') $notes=" <span class='sm cGray'>".$objRack->Notes."</span>";
					}
					else{
						$blnEmptyRack=1;
						// empty rack
						$availableSlots = "<div class='bld'>".($rackBoxSlots-$intRackBoxCount)." slots available</div>";
					}
				
					$linkScript='boxes.php?intRack=';
					$linkTitle='View the following boxes for this rack: ';
					if ($blnEmptyRack) {
						$linkScript='racks.php?intRackId=';
						$linkTitle='View the specs for this rack ';
					}
					// build rack html component
					if ($showLink)
						$strRacksBoxes.="<a style='overflow:auto;float:left;border:1px solid #000;width:".$rWidth."px;height:100px;padding:5px;margin:2px;background-color:#EDEDED;display:block;' href='".$linkScript.$objRack->Id."&intFreezerId=".$this->lstSearch->SelectedValue."' title='".$linkTitle.$rackBoxes."'>".$objRack->Name.$availableSlots.$inventoriedBoxes.$notes."</a>";
					else
						$strRacksBoxes.="<div style='overflow:auto;float:left;border:1px solid #000;width:".$rWidth."px;height:100px;padding:5px;margin:2px;background-color:#EDEDED;display:block;' title='Viewing of boxes is disabled'>".$objRack->Name.$availableSlots.$inventoriedBoxes.$notes."</div>";
				

					//$strRacksBoxes.=$objRack->Name."(".$rackBoxes.")";
				}
				// for boxes without a rack
				if (count($objBoxNoRackArray)>0) {
					foreach($objBoxNoRackArray as $objBox) {
						if ($objBox->BoxTypeId && $strFreezerShelfWidthIn) {
							$width=$height='';

							if ($this->objTypeOfBoxArray) foreach($this->objTypeOfBoxArray as $objTypeOfBox) {
								if ($objTypeOfBox->Id == $objBox->BoxTypeId) {
									$width = $objTypeOfBox->Width;
									$height = $objTypeOfBox->Height;
									break;
								}
							}
							// if we know the box width then we will try to determine a good width to display the box
							if ($width != '') {
								$bCount = $strFreezerShelfWidthIn/$width;	// determine how many boxes of this type will fit on a shelf
								$this->bWidth=(__FREEZER_VIEW_FREEZER_WIDTH__-(10*$bCount))/$bCount; // we need to subtract the total freezer shelf width (pixels) by (the number of boxes that can fit per shelf times the padding/margin/border we will display for each box) and divide that by the number of boxes that will fit on the shelf and that should tell us how wide to draw the boxes on the screen to be proportional to the shelf width (we are not concerned with the height so much)
							}

							// if we know the box width then we will try to determine a good width to display the box
							if ($height != '') {
								$bCount = $strFreezerShelfHeightIn/$height;	// determine how many boxes of this type will fit on a shelf
								$this->bHeight=(__FREEZER_VIEW_FREEZER_HEIGHT__-(5*$bCount))/$bCount; // we need to subtract the total freezer shelf width (pixels) by (the number of boxes that can fit per shelf times the padding/margin/border we will display for each box) and divide that by the number of boxes that will fit on the shelf and that should tell us how wide to draw the boxes on the screen to be proportional to the shelf width (we are not concerned with the height so much)
							}
						}

						// give us some height if we have calculated it at 0
						if ($this->bHeight == 0) $this->bHeight = 90;

						// class='req3'
						if ($objBox->Complete==1){
							if ($showLink)
								$shelfBoxContent.="<a class='fbox req3' style='height:".$this->bHeight."px;color:#fff;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."' href='boxes.php?intBoxId=".$objBox->Id."'>".$objBox->Name."</a>";//$objBox->Name;
							else
								$shelfBoxContent.="<div class='fbox req3' style='height:".$this->bHeight."px;color:#fff;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."'>".$objBox->Name."</div>";
						}
						else {
							// we only have raw boxes
							if ($showLink)
								$shelfBoxContent.="<a class='fbox' style='height:".$this->bHeight."px;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."' href='boxes.php?intBoxId=".$objBox->Id."'>".$objBox->Name."</a>";//$objBox->Name;
							else
								$shelfBoxContent.="<div class='fbox' style='height:".$this->bHeight."px;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."'>".$objBox->Name."</div>";
						}
					}
				}

				if ($strRacksBoxes=="" && $shelfBoxContent=="")
					$strShelfContents.= '<h1 class="txtalignC cGray">Empty shelf</h1>';
				else 
					$strShelfContents.=$strRacksBoxes.$shelfBoxContent;
				$strShelfContents.="</div>";
			}
		}
		$this->freezerView->Text = '<div>'.$strShelfContents.'<br/></div>';
	}

	

	//select boxes from selected freezer order by shelf desc and rack; for each shelf display each box unless it is in a rack then just show rack
	protected function freezerViewSet($showLink=false) {
		$this->freezerViewSetV2($showLink);
		return;

		$this->bHeight = 14;
		$this->bWidth = 113;
		$objDbResult='';
		$strFreezerShelfWidthPx=__FREEZER_VIEW_FREEZER_WIDTH__;
		$strFreezerShelfWidthIn=$strFreezerShelfHeightIn=90;
		$strFreezerWidthMultiplier=0;	// will be used to determine the width of the racks and boxes relative to the displayed shelf width
		if ($this->lstSearch->SelectedValue) {
			$objFreezer = Freezer::QuerySingle(QQ::Equal(QQN::Freezer()->Id, $this->lstSearch->SelectedValue),null,null,array('shelf_width_in','shelf_height_in','n_shelves'));
			if ($objFreezer->ShelfWidthIn) {
				$strFreezerShelfWidthIn=$objFreezer->ShelfWidthIn;
			}
			if ($objFreezer->ShelfHeightIn) {
				$strFreezerShelfHeightIn=$objFreezer->ShelfHeightIn;
			}
			$objDbResult = Box::LoadArrayByFreezerId($this->lstSearch->SelectedValue,QQ::Clause(QQ::OrderBy(QQN::Box()->Shelf,1,QQN::Box()->Rack,1,QQN::Box()->Name,1)),null,array('id','name','box_type_id'));
		}
		$strShelfContents=$shelf=$rack=$boxes=$shelfBoxContent=$shelfRackContent='';
		if ($objDbResult)
			// for each box
			foreach ($objDbResult as $objBox){

			// check to see which self we first have samples on
			if ($shelf =='' && $objBox->Shelf!=1){
				for($i=1; $i<$objBox->Shelf; $i++ ){
					$strShelfContents.=$this->startShelfView($i,$strFreezerShelfWidthPx);
					if ($shelfBoxContent=="" && $shelfRackContent=="")
						$strShelfContents.= '<h1 class="txtalignC cGray">Empty shelf</h1>';
					$strShelfContents.="</div>";
				}
			}

			// foreach box check to see if we are changing shelves and if so then
			if ($objBox->Shelf != $shelf){

				if ($shelfRackContent!="")$strShelfContents.=$shelfRackContent;
				if ($shelfBoxContent!="")$strShelfContents.=$shelfBoxContent;	// add any boxes to the end if we have some

				// finish building shelf if we had some racks to display
				if ($strShelfContents!="" && $shelf !='')$strShelfContents.="</div>";

				$emptyShelves = 0;
				if ($shelf !='')
					$emptyShelves = intval($objBox->Shelf - $shelf);


				// check to see if we have a few empty shelves
				if ($emptyShelves > 1) for($i=$shelf+1; $i<$objBox->Shelf; $i++ ){
					$strShelfContents.=$this->startShelfView($i,$strFreezerShelfWidthPx);
					$strShelfContents.= '<h1 class="txtalignC cGray">Empty shelf</h1>';
					$strShelfContents.="</div>";
				}

				$shelf=$objBox->Shelf;

				$boxes=$shelfBoxContent=$shelfRackContent='';	// reset boxes when moving to another shelf
				$strShelfContents.=$this->startShelfView($objBox->Shelf,$strFreezerShelfWidthPx);
			}



			// if the box is in a rack
			// else show box
			if ($objBox->RackId != ''){
				// if we are changing racks then add it
				if ($objBox->RackId != $rack){

					$rack = trim($objBox->RackId ?? '');
					$notes='';
					$rWidth = 113;
					if ($objBox->RackId) {
						$depth='';
						$rackBoxSlots=$intRackBoxCount=$intBoxesInventoried=0;
						$intRackBoxCount = Box::QueryCount(
								QQ::AndCondition(
										QQ::Equal(QQN::Box()->RackId, $objBox->RackId),
										QQ::Equal(QQN::Box()->Freezer, $objBox->Freezer)
								));
						// find out how many boxes have been inventoried for the rack
						$intBoxesInventoried = Box::QueryCount(
								QQ::AndCondition(
										QQ::Equal(QQN::Box()->RackId, $objBox->RackId),
										QQ::Equal(QQN::Box()->Freezer, $objBox->Freezer),
										QQ::Equal(QQN::Box()->Complete, 1)
								));
						$objRack = Rack::QuerySingle(QQ::Equal(QQN::Rack()->Id, $objBox->RackId),null,null,array('id','rack_type_id','notes','name'));
						if ($this->objTypeOfRackArray) foreach($this->objTypeOfRackArray as $objTypeOfRack) {
							if ($objTypeOfRack->Id == $objRack->RackTypeId) {
								$depth = $objTypeOfRack->Depth;
								$rackBoxSlots = $objTypeOfRack->BoxCount;
								break;
							}
						}
						// if we know the rack depth then we will try to determine a good width to display the rack
						// ignoring our chest freezers since they would need to be handled differently
						if ($depth != '' && $strFreezerShelfWidthIn && $objBox->Freezer!=1 && $objBox->Freezer!=7) {
							$rCount = floor($strFreezerShelfWidthIn/$depth);	// determine how many racks will fit on a shelf
							$rWidth=(__FREEZER_VIEW_FREEZER_WIDTH__-(16*$rCount))/$rCount; // we need to subtract the total freezer shelf width (pixels) by (the number of racks that can fit per shelf times the padding/margin/border we will display for each rack) and divide that by the number of racks that will fit on the shelf and that should tell us how wide to draw the racks on the screen to be proportional to the shelf width (we are not concerned with the height so much)
						}
					}
					$inventoriedBoxes='';
					// get available slots
					if ($rackBoxSlots) {
						if ($rackBoxSlots-$intRackBoxCount)
							$availableSlots = "<div class='bld'>".($rackBoxSlots-$intRackBoxCount)." slots available</div>";
						else 
							$availableSlots = "<div class='bld error'>Rack full</div>";

						// show inventoried boxes or not
						if ($intBoxesInventoried-$intRackBoxCount)
							$inventoriedBoxes = "<div class='sm cGray'>".$intBoxesInventoried."/".$intRackBoxCount." boxes inventoried</div>";
						else
							$inventoriedBoxes = "<div class='req3'>All <b>".$intRackBoxCount."</b> boxes inventoried</div>";
					}
					else
						$availableSlots = "<div class='bld txtalignC'>-unknown slots-</div>";

					$rackBoxes='';
					$objBoxArray = Box::QueryArray(QQ::Equal(QQN::Box()->RackId, $objRack->Id),QQ::Clause(QQ::OrderBy(QQN::Box()->Name,1)),null,array('id','name','box_type_id','sample_type_id'));
					if ($objBoxArray) foreach($objBoxArray as $objBox){
						// keep a list of box descriptions in a rack
						$strSampleType='';
						if (array_key_exists($objBox->SampleTypeId, SampleTypes::$NameArray) && $objBox->SampleTypeId!='')
							$strSampleType=SampleTypes::$NameArray[$objBox->SampleTypeId];
						if ($rackBoxes != '')$rackBoxes.=", ";
						$rackBoxes .= $objBox->Name."(".$strSampleType.")";
					}

					if ($objRack && $objRack->Notes != '') $notes=" <span class='sm cGray'>".$objRack->Notes."</span>";

					if ($showLink)
						$shelfRackContent.="<a style='overflow:auto;float:left;border:1px solid #000;width:".$rWidth."px;height:100px;padding:5px;margin:2px;background-color:#EDEDED;display:block;' href='boxes.php?intRack=".$objRack->Id."&intFreezerId=".$this->lstSearch->SelectedValue."' title='View the following boxes for this rack: ".$rackBoxes."'>".$objRack->Name.$availableSlots.$inventoriedBoxes.$notes."</a>";
					else
						$shelfRackContent.="<div style='overflow:auto;float:left;border:1px solid #000;width:".$rWidth."px;height:100px;padding:5px;margin:2px;background-color:#EDEDED;display:block;' title='Viewing of boxes is disabled'>".$objRack->Name.$availableSlots.$inventoriedBoxes.$notes."</div>";
				}
			}
			else {
				if ($objBox->BoxTypeId && $strFreezerShelfWidthIn) {
					$width=$height='';

					if ($this->objTypeOfBoxArray) foreach($this->objTypeOfBoxArray as $objTypeOfBox) {
						if ($objTypeOfBox->Id == $objBox->BoxTypeId) {
							$width = $objTypeOfBox->Width;
							$height = $objTypeOfBox->Height;
							break;
						}
					}
					// if we know the box width then we will try to determine a good width to display the box
					if ($width != '') {
						$bCount = $strFreezerShelfWidthIn/$width;	// determine how many boxes of this type will fit on a shelf
						$this->bWidth=(__FREEZER_VIEW_FREEZER_WIDTH__-(10*$bCount))/$bCount; // we need to subtract the total freezer shelf width (pixels) by (the number of boxes that can fit per shelf times the padding/margin/border we will display for each box) and divide that by the number of boxes that will fit on the shelf and that should tell us how wide to draw the boxes on the screen to be proportional to the shelf width (we are not concerned with the height so much)
					}

					// if we know the box width then we will try to determine a good width to display the box
					if ($height != '') {
						$bCount = $strFreezerShelfHeightIn/$height;	// determine how many boxes of this type will fit on a shelf
						$this->bHeight=(__FREEZER_VIEW_FREEZER_HEIGHT__-(5*$bCount))/$bCount; // we need to subtract the total freezer shelf width (pixels) by (the number of boxes that can fit per shelf times the padding/margin/border we will display for each box) and divide that by the number of boxes that will fit on the shelf and that should tell us how wide to draw the boxes on the screen to be proportional to the shelf width (we are not concerned with the height so much)
					}
				}

				// give us some height if we have calculated it at 0
				if ($this->bHeight == 0) $this->bHeight = 90;

				// class='req3'
				if ($objBox->Complete==1){
					if ($showLink)
						$shelfBoxContent.="<a class='fbox req3' style='height:".$this->bHeight."px;color:#fff;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."' href='boxes.php?intBoxId=".$objBox->Id."'>".$objBox->Name."</a>";//$objBox->Name;
					else
						$shelfBoxContent.="<div class='fbox req3' style='height:".$this->bHeight."px;color:#fff;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."'>".$objBox->Name."</div>";
				}else {
					// we only have raw boxes
					if ($showLink)
						$shelfBoxContent.="<a class='fbox' style='height:".$this->bHeight."px;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."' href='boxes.php?intBoxId=".$objBox->Id."'>".$objBox->Name."</a>";//$objBox->Name;
					else
						$shelfBoxContent.="<div class='fbox' style='height:".$this->bHeight."px;width:".$this->bWidth."px;float:left;padding:2px;border:1px dotted #ccc;margin:2px;display:block;' title='".$objBox->Issues."; ".$objBox->Description."'>".$objBox->Name."</div>";
				}
			}
		}
		if ($shelfRackContent!="")$strShelfContents.=$shelfRackContent;
		if ($shelfBoxContent!="")$strShelfContents.=$shelfBoxContent;

		$strShelfContents.="</div>";

		// check to see if the bottom shelves are empty
		if ($objFreezer->NShelves > $shelf && $shelf !=''){
			for($i=$shelf+1; $i<=$objFreezer->NShelves; $i++ ){
				$strShelfContents.=$this->startShelfView($i,$strFreezerShelfWidthPx);
				$strShelfContents.= '<h1 class="txtalignC cGray">Empty shelf</h1>';
				$strShelfContents.="</div>";
			}
		}

		$this->freezerView->Text = '<div>'.$strShelfContents.'<br/></div>';	// print the freezer view
	}
}

// gives general stats on the contents of all freezers
class FreezerView8_b extends FreezerView {
	protected function freezerViewSet() {
		$this->freezerView->Text = '<h2>TODO: Things to consider reporting on for each freezer</h2>
				<div>- boxes without new sample locations logged</div>
				<div>- number of racks and boxes</div>
				<div>- number of samples stored</div>
				<div>- types of sample in a box (color coded using small square colored blocks) or a rack</div>';
	}
}

// shows the general space available stats for all freezers
class FreezerView8_a extends FreezerView {
	protected function freezerViewSet() {
		$this->freezerView->Text = '<h2>TODO: Things to consider reporting on for each freezer</h2>
				<div>- a broad picture of estimated space avaiable for each freezer in graph view (calculated by cubic inches)</div>
				<div>- estimated number of standard boxes that can be added to a freezer before it is full</div>
				<div>- racks listing number of empty/full slots</div>';
	}
}


class FreezerView13_af extends FreezerView8_af {
	protected function Form_Create() {
		parent::Form_Create();
		$this->freezerViewSet();
	}
}

class FreezerView13_a extends FreezerView {

}


$intFreezer = QApplication::QueryString('intFreezer');	// get selected freezer
$q_status = QApplication::QueryString('strTabStatus');	// look at tab status

// default to 'space available'
if ($q_status == '')
	$q_status = 'a';

define("__QUERY_STATUS_FVintF__", $intFreezer);
define("__QUERY_STATUS_FV__", $q_status);

// go to the centralized form executing access control function to run the form and check access control
if (__QUERY_STATUS_FV__=='a') {
	if (__QUERY_STATUS_FVintF__!='') ACL_Run('FreezerView_af');	// show space available for the selected freeer
	else ACL_Run('FreezerView_a');	// else show space available stats for all freezers
}
elseif (__QUERY_STATUS_FV__=='b') {
	ACL_Run('FreezerList_b');	// else show content stats of freezers
}
?>