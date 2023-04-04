<?php
/**
 * @abstract This is a report view of our biological boxes.  The report can be filtered by:
 * - all boxes
 * - stand-alone boxes without racks
 * - boxes outside of our facility (being used in research)
 * - boxes with issues
 * - boxes by type
 * - boxes by sample type
 * - boxes being prepared for shipment to us
 * - boxes without samples logged
 */

// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */

// Include the classfile for FrzBoxesListFormBase
require(__FORMBASE_CLASSES__ . '/BoxListFormBase.class.php');

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();

class BoxListForm8 extends BoxListFormBase {
	protected $lstSearch, $intRack, $btnRack, $txtBox, $intBoxId, $intFreezerId, $calReleaseDate,
	$txtFreezerPullId, $btnReleaseBoxes, $btnDeleteBoxes, $intTotalSamples, $btnFreezerPullBoxes, $intTotalOrphans,
	$objTypeOfBox, $objSampleTypes, $objRackArray, $objFreezerArray, $objSampleSelection, $lstBoxType;

	protected function Form_Create() {
		$strQsOption= QApplication::QueryString('option');
		$intBoxId= QApplication::QueryString('intId');
		if ($strQsOption=='setMovingBox'){
			// set the moving box
			$objBox = Box::Load($intBoxId);
			if ($objBox) {
				QSessionDB::set('__SAMPLE_MOVING_BOX__',serialize($objBox));
				QApplication::Redirect('sample-pull.php');
			}
		}

		$this->objSampleSelection = unserialize(QSessionDB::get('__SAMPLE_SELECTION_SEARCH__'));

		// make things more efficient by just making one query to the type tables
		$objTypeOfBoxArray = TypeOfBox::QueryArray(QQ::All(),null,null,array('id','name','columns','`rows`'));
		if ($objTypeOfBoxArray) foreach ($objTypeOfBoxArray as $objTypeOfBox) {
			$this->objTypeOfBox[$objTypeOfBox->Id] = $objTypeOfBox;
		}

		$objSampleTypesArray = SampleTypes::QueryArray(QQ::All(),null,null,array('id','description'));
		if ($objSampleTypesArray) foreach ($objSampleTypesArray as $objSampleTypes) {
			$this->objSampleTypes[$objSampleTypes->Id] = $objSampleTypes;
		}

		// show box options for selecting the freezer
		foreach (Freezer::$freezerArray as $freezerCode => $freezerName) {
			$this->objFreezerArray[$freezerCode] = "(".$freezerCode.") ".$freezerName;
		}
		// show actual freezers
		$objFreezerArray = Freezer::QueryArray(QQ::All(),null,null,array('id','name'));
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$this->objFreezerArray[$objFreezer->Id] = $objFreezer->__toString();
		}

		$this->objRackArray = array();

		// box release history fields
		$this->calReleaseDate_Create();
		$this->txtFreezerPullId_Create();
		$this->btnReleaseBoxes_Create();
		$this->btnDeleteBoxes_Create();
		$this->btnFreezerPullBoxes_Create();
		$this->lstBoxType_Create();

		$this->intRack = QApplication::QueryString('intRack');
		$this->intBoxId = QApplication::QueryString('intBoxId');
		$this->intFreezerId = QApplication::QueryString('intFreezerId');

		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Box Name'), '<?= $_FORM->dtgBox_EditLinkColumn_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Name, false)),array('<h2>Total samples</h2>'));
		$this->colRackId = new QDataGridColumn(QApplication::Translate('Rack'), '<?= $_FORM->dtgBox_Rack_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Rack->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Rack->Name, false)));
		$this->colShelf = new QDataGridColumn(QApplication::Translate('Shelf'), '<?= $_ITEM->Shelf; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Shelf), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Shelf, false)));
		$this->colFreezer = new QDataGridColumn(QApplication::Translate('Freezer'), '<?= $_FORM->dtgBox_FreezerColumn_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Freezer), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Freezer, false)));
		$this->colIssues = new QDataGridColumn(QApplication::Translate('Issues'), '<?= $_FORM->dtgBox_IssuesColumn_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Issues), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Issues, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= $_FORM->dtgBox_Description_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Description, false)),array('<?= $_FORM->dtgBox_TotalSamplesColumn_Render(); ?>'));
		$this->colBoxTypeId = new QDataGridColumn(QApplication::Translate('Box Type'), '<?= $_FORM->dtgBox_BoxType_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->BoxType->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->BoxType->Id, false)));
		$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type'), '<?= $_FORM->dtgBox_SampleType_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->SampleType->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->SampleType->Description, false)));
		$this->colCreated = new QDataGridColumn(QApplication::Translate('Created'), '<?= $_FORM->dtgBox_Created_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Created), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Created, false)));
		$this->colPreparedById = new QDataGridColumn(QApplication::Translate('Prepared By Id'), '<?= $_ITEM->PreparedById; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->PreparedById), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->PreparedById, false)));
		$this->colComplete = new QDataGridColumn(QApplication::Translate('Complete'), '<?= ($_ITEM->Complete) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Complete), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Complete, false)));
		$this->colClinicShipmentId = new QDataGridColumn(QApplication::Translate('Clinic Shipment Id'), '<?= $_FORM->dtgBox_ClinicShipment_Render($_ITEM); ?>');
		$this->colIssues->HtmlEntities = $this->colDescription->HtmlEntities = $this->colRackId->HtmlEntities = $this->colName->HtmlEntities = $this->colEditLinkColumn->HtmlEntities = $this->colFreezer->HtmlEntities = false;
		$this->colName->Wrap = $this->colFreezer->Wrap = false;

		// Setup DataGrid
		$this->dtgBox = new QDataGrid($this);
		$this->dtgBox->CellSpacing = 0;
		$this->dtgBox->CellPadding = 4;
		$this->dtgBox->BorderStyle = QBorderStyle::Solid;
		$this->dtgBox->BorderWidth = 1;
		$this->dtgBox->GridLines = QGridLines::Both;
		$this->dtgBox->ShowFooter = true;
		$this->dtgBox->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgBox->Paginator = new QPaginator($this->dtgBox);

		// make sure we do not display more than 100 boxes for our search sanity (as more than 100 boxes is a ridiculous number of queries)
		$ipp = __ITEMS_PER_PAGE__;
		if ($ipp > 100) $ipp = 100;
		$this->dtgBox->ItemsPerPage = $ipp;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgBox->UseAjax = false;

		$this->dtgBox->Noun = 'box';
		$this->dtgBox->NounPlural = 'boxes';

		$this->dtgBox->SortColumnIndex = 0;
		$this->dtgBox->SortDirection = 1;

		// Specify the local databind method this datagrid will use
		$this->dtgBox->SetDataBinder('dtgBox_Bind');

		$this->dtgBox->AddColumn($this->colEditLinkColumn);
		$this->dtgBox->AddColumn($this->colName);
		$this->dtgBox->AddColumn($this->colDescription);
		$this->dtgBox->AddColumn($this->colRackId);
		$this->dtgBox->AddColumn($this->colShelf);
		$this->dtgBox->AddColumn($this->colFreezer);
		$this->dtgBox->AddColumn($this->colIssues);
		$this->dtgBox->AddColumn($this->colBoxTypeId);
		$this->dtgBox->AddColumn($this->colSampleTypeId);
		//			$this->dtgBox->AddColumn($this->colCreated);
		//			$this->dtgBox->AddColumn($this->colPreparedById);
		//			$this->dtgBox->AddColumn($this->colComplete);
		//			$this->dtgBox->AddColumn($this->colClinicShipmentId);

		$this->lstSearch_Create();
		$this->btnRack_Create();
		$this->txtBox_Create();
	}


	public function dtgBox_BoxType_Render(Box $objBox) {
		if (!is_null($objBox->BoxTypeId))
			return $this->objTypeOfBox[$objBox->BoxTypeId]->__toString();
		else
			return null;
	}

	public function dtgBox_SampleType_Render(Box $objBox) {
		if (!is_null($objBox->SampleTypeId))
			return $this->objSampleTypes[$objBox->SampleTypeId]->__toString();
		else
			return null;
	}

	// print the total samples for the displayed boxes
	public function dtgBox_TotalSamplesColumn_Render() {
		return $this->intTotalSamples." (inventoried samples)<br/>".$this->intTotalOrphans." (orphan samples)";
	}

	// Create and Setup calReleaseDate
	protected function calReleaseDate_Create() {
		$this->calReleaseDate = new QJsCalendar($this);
		$this->calReleaseDate->Name = QApplication::Translate('Release Date: ');
		$this->calReleaseDate->DateTime = QDateTime::Now();
		$this->calReleaseDate->Required = true;
	}

	// Create and Setup txtFreezerPullId
	protected function txtFreezerPullId_Create() {
		$this->txtFreezerPullId = new QIntegerTextBox($this);
		$this->txtFreezerPullId->Name = QApplication::Translate('Freezer Pull Id: ');
		$this->txtFreezerPullId->Required = false;
		if (QSessionDB::get("boxes.php__selectedFreezerPullID") != '')
		$this->txtFreezerPullId->Text = QSessionDB::get("boxes.php__selectedFreezerPullID");
		$this->txtFreezerPullId->HtmlAfter = sprintf(' <a href="javascript:__resetTextBox(%s, %s)" style="font-family: verdana, arial, helvetica; font-size: 8pt; text-decoration: none;">%s</a>',
					"'" . $this->FormId . "'",
					"'" . $this->txtFreezerPullId->ControlId . "'",
					QApplication::Translate('Reset'));
	}

	protected function btnReleaseBoxes_Create() {
		$this->btnReleaseBoxes = new QButton($this);
		$this->btnReleaseBoxes->Text = QApplication::Translate('Release selected boxes');
		$this->btnReleaseBoxes->AddAction(new QClickEvent(), new QServerAction('btnReleaseBoxes_Click'));
		$this->btnReleaseBoxes->PrimaryButton = true;
		$this->btnReleaseBoxes->CausesValidation = true;
	}

	protected function btnDeleteBoxes_Create() {
		$this->btnDeleteBoxes = new QButton($this);
		$this->btnDeleteBoxes->Text = QApplication::Translate('Delete selected boxes');
		$this->btnDeleteBoxes->AddAction(new QClickEvent(), new QConfirmAction('Are you SURE you want to DELETE these boxes and samples?'));
		$this->btnDeleteBoxes->AddAction(new QClickEvent(), new QServerAction('btnDeleteBoxes_Click'));
	}
	protected function btnFreezerPullBoxes_Create() {
		$this->btnFreezerPullBoxes = new QButton($this);
		$this->btnFreezerPullBoxes->Text = QApplication::Translate('Show boxes by freezer pull ID');
		$this->btnFreezerPullBoxes->AddAction(new QClickEvent(), new QServerAction('btnFreezerPullBoxes_Click'));
		$this->btnFreezerPullBoxes->PrimaryButton = true;
		$this->btnFreezerPullBoxes->CausesValidation = true;
	}

	protected function btnFreezerPullBoxes_Click($strFormId, $strControlId, $strParameter) {
		if ($this->txtFreezerPullId->Text != '')
		QSessionDB::set("boxes.php__selectedFreezerPullID", $this->txtFreezerPullId->Text);
		else
			QSessionDB::delete("boxes.php__selectedFreezerPullID");

		// refresh the list of boxes
		$this->dtgBox_Bind();
	}

	protected function btnReleaseBoxes_Click($strFormId, $strControlId, $strParameter) {
		// save changes

		foreach ($this->GetAllControls() as $objControl) {
			$checkBoxId = substr($objControl->ControlId,6);
			// if the control is a checkbox and is checked then we will release the boxes
			if ($checkBoxId != '' && $objControl->Checked) {
				//
				$objBoxHistoryLog = new BoxHistoryLog();
				$objBoxHistoryLog->BoxId = $checkBoxId;
				$objBoxHistoryLog->ReleaseDate = $this->calReleaseDate->DateTime;
				$objBoxHistoryLog->FreezerPullId = $this->txtFreezerPullId->Text;
				$objBoxHistoryLog->Save();
				// update box information
				$objBox = Box::QuerySingle(QQ::Equal(QQN::Box()->Id, $checkBoxId));
				if ($objBox) {
					$objBox->Freezer = '-2';
					$objBox->Shelf = NULL;
					$objBox->RackId = NULL;
					$objBox->Save();
				}
			}
		}

		QSessionDB::set("error", "Boxes released from freezer inventory");
		// refresh the list of boxes
		$this->dtgBox_Bind();
	}
	// remove the boxes and samples from inventory
	protected function btnDeleteBoxes_Click($strFormId, $strControlId, $strParameter) {
		foreach ($this->GetAllControls() as $objControl) {
			$checkBoxId = substr($objControl->ControlId,6);
			// if the control is a checkbox and is checked then we will delete the boxes
			if ($checkBoxId != '' && $objControl->Checked) {
				// get box information
				$objBox = Box::QuerySingle(QQ::Equal(QQN::Box()->Id, $checkBoxId));
				if ($objBox) {
					ActionLog::LogBoxAction(3,$objBox);	// track the box update
					$objSampleArray = Sample::LoadArrayByBoxId($checkBoxId);
					// for all of the samples in the box, delete them
					if ($objSampleArray) foreach($objSampleArray as $objSample) {
						ActionLog::LogSampleAction(6,$objSample);	// track the sample delete
						$objSample->Delete();
					}
					// for all box history logs then delete
					$objBoxHistoryLogArray = BoxHistoryLog::LoadArrayByBoxId($checkBoxId);
					if ($objBoxHistoryLogArray) foreach($objBoxHistoryLogArray as $objBoxHistoryLog) {
						ActionLog::LogBoxHistoryAction(10,$objBoxHistoryLog);	// track the box history delete
						$objBoxHistoryLog->Delete();
					}
				}
				$objBox->Delete();
			}
		}
		QSessionDB::set("error", "Boxes deleted from freezer inventory");
		// refresh the list of boxes
		$this->RedirectToListPage();
	}

	public function dtgBox_EditLinkColumn_Render(Box $objBox) {
		$boxName = $objBox->Name;
		// if someone is searching on box name then run highlighter
		if ($this->txtBox->Text != '')
			$boxName = highlightResults(trim($this->txtBox->Text), $objBox->Name);

		//			$objSample = Sample::QuerySingle(QQ::Equal(QQN::Sample()->BoxId, $objBox->Id), QQ::Clause(QQ::LimitInfo(1)), null, array('sample_type_id'));
		$sampleType = '';
		// 			if ($objSample) {
		// 				//$sampleType = $objSample->SampleTypeId;
		// 				$objSampleType = SampleTypes::QuerySingle(QQ::Equal(QQN::SampleTypes()->Id, $objSample->SampleTypeId), QQ::Clause(QQ::LimitInfo(1)), null, array('description'));
		// 			}

		// 			if ($objSampleType) $sampleType = $objSampleType->Description;

		// 			return sprintf('<div class="fs18 bld">%s</div><div class="sm"><a href="box-view.php?intId=%s">%s</a> | <a href="box.php?intId=%s">%s</a></div>(%s)',
		// 				$boxName,
		// 				$objBox->Id,
		// 				QApplication::Translate('Sample layout'),
		// 				$objBox->Id,
		// 				QApplication::Translate('Box Description'),
		// 				$sampleType);

		$boxLoggedOutFlag = false;
		$boxLoggedOut = '';
		$boxHistoryLog_Id = $boxHistoryLog_FreezerPullId = '';

		// find out if the box is logged out of our freezers or not and leave a notice if they are
		$objBoxHistoryLog = BoxHistoryLog::QuerySingle(
				QQ::AndCondition(
						QQ::Equal(QQN::BoxHistoryLog()->BoxId, $objBox->Id),
						QQ::IsNull(QQN::BoxHistoryLog()->ReceivedDate)
				),null,null,array('id','freezer_pull_id'));
		if ($objBoxHistoryLog) {
			$boxHistoryLog_Id = $objBoxHistoryLog->Id;
			$boxHistoryLog_FreezerPullId = $objBoxHistoryLog->FreezerPullId;
		}

		if ($boxHistoryLog_Id != '') {
			$boxLoggedOut = "<div class='sm nrml notfbtn pd5 cfff'><a href='box_history_log.php?intId=".$boxHistoryLog_Id."' style='color:#fff !important;'>Note: box logged out for <b>#".$boxHistoryLog_FreezerPullId."-fp</b></a></div>";
			$boxLoggedOutFlag = true;
		}
		//else {
			// choose a box to log out
			// we will use explicitly defined control ids.
			$strControlId = 'chkBox' . $objBox->Id;

			// Let's see if the Checkbox exists already
			$chkBox = $this->GetControl($strControlId);

			if (!$chkBox) {
				// Define the Checkbox -- it's parent is the Datagrid (b/c the datagrid is the one calling
				// this method which is responsible for rendering the checkbox.  Also, we must
				// explicitly specify the control ID
				$chkBox = new QCheckBox($this->dtgBox, $strControlId);
				$chkBox->Name = 'Checkout of freezer: ';
				// We'll use Control Parameters to help us identify the Person ID being copied
				$chkBox->ActionParameter = $objBox->Id;

				// Let's assign a server action on click
				$chkBox->AddAction(new QClickEvent(), new QAjaxAction('chkBox_Click'));
			}
			$boxLoggedOut .= "<hr/>".$chkBox->RenderNoBreaks(false);
		//}

		$rackSelected='';
		// allow quick moving of a box to a selected rack
		if (FM2013Session::GetSession(1)!='' && $objBox->RackId != FM2013Session::GetSession(1)) {
			$rackSelected = '<div><a href="rack.php?intMoveBoxId='.$objBox->Id.'" class="bld">Move box to rack '.Rack::getSelectedName().'</a></div>';
		}
		$intSampleBoxOphan = $intSampleBoxSlotFullCount = 0;
		$intSampleBoxOphan = Sample::QueryCount(
				QQ::AndCondition(
						QQ::Equal(QQN::Sample()->BoxId, $objBox->Id),
						QQ::IsNull(QQN::Sample()->BoxSampleSlot)
				)
		);
		$intSampleBoxSlotFullCount = Sample::QueryCount(
				QQ::AndCondition(
						QQ::Equal(QQN::Sample()->BoxId, $objBox->Id),
						QQ::IsNotNull(QQN::Sample()->BoxSampleSlot)
				)
		);

		$sampleLayout = '';
		// check to see if we show the 'sample layout' link
		if ($objBox->Freezer){
			if ($objBox->Freezer > 0) {
				$sampleLayout = sprintf('<a href="box-view.php?intId=%s">%s</a> | ',
						$objBox->Id,
						'Sample layout');
			}
			// 			if ($boxLoggedOutFlag)
			// 				$boxLoggedOut = '';
		}
		$inventoried = '';
		// check to see if the box inventory has been verified
		if ($objBox->Complete){
			$inventoried = '<img src="'.__IMAGE_ASSETS__.'/tick.png" border="0" title="samples have been inventoried">';
			$this->intTotalSamples += $intSampleBoxSlotFullCount;
		}
		else
			$inventoried = '<img src="'.__IMAGE_ASSETS__.'/req.gif" border="0" title="samples need to be inventoried">';

		$movingBox = '';
		// if we are in sample search/selection mode show link to set a box as the 'moving' box
		if($this->objSampleSelection) {
			$movingBox = ' <a href="?option=setMovingBox&intId='.$objBox->Id.'" class="bld">...set moving box</a>';
		}

		$this->intTotalOrphans += $intSampleBoxOphan;
		return sprintf('<div><span class="fs18 bld">%s</span>'.$movingBox.'</div><div class="sm">%s <b>%s</b> samples logged (%s ophans)</div><div class="sm">%s<a href="box.php?intId=%s">%s</a></div>%s%s',
				$boxName,
				$inventoried,
				$intSampleBoxSlotFullCount,
				$intSampleBoxOphan,
				$sampleLayout,
				$objBox->Id,
				QApplication::Translate('Box Description'),
				$boxLoggedOut,
				$rackSelected);
	}

	// This chkBox_Click action will select a box for checking out
	protected function chkBox_Click($strFormId, $strControlId, $strParameter) {
		// We look to the Parameter for the ID of the person being checked
		$intParticipantId = $strParameter;

	}

	public function dtgBox_Rack_Render(Box $objBox) {
		if (!is_null($objBox->RackId) && $this->objRackArray) {
			// we will check our Rack array to see if we need to get the specs on another rack
			if (!isset($this->objRackArray[$objBox->RackId])) {
				$objRack = Rack::QuerySingle(QQ::Equal(QQN::Rack()->Id,$objBox->RackId),null,null,array('id','name'));
				if ($objRack)
					$this->objRackArray[$objBox->RackId] = $objRack;
			}
			return sprintf('<b>%s</b> (<a href="racks.php?intRackId=%s" class="sm">specs.</a> | <a href="boxes.php?intRack=%s" class="sm">contents</a>)',
					$this->objRackArray[$objBox->RackId]->__toString(),
					$objBox->RackId,
					$objBox->RackId);
		}
		else
			return null;
	}

	public function dtgBox_IssuesColumn_Render(Box $objBox) {
		// if someone is searching on box name then run highlighter
		if ($this->txtBox->Text != '')
			return highlightResults(trim($this->txtBox->Text), $objBox->Issues);
		else
			return $objBox->Issues;
	}

	public function dtgBox_Description_Render(Box $objBox) {
		// if someone is searching on box name then run highlighter
		if ($this->txtBox->Text != '')
			return highlightResults(trim($this->txtBox->Text), $objBox->Description);
		else
			return $objBox->Description;
	}

	public function dtgBox_FreezerColumn_Render(Box $objBox) {
		if ($objBox->Freezer){
			if ($objBox->Freezer > 0)
				return sprintf('<a href="freezer-view.php?intFreezer=%s">%s</a>',
						$objBox->Freezer,
						$this->objFreezerArray[$objBox->Freezer]);
			else
				return $this->objFreezerArray[$objBox->Freezer];
		}
	}

	protected function btnRack_Create() {
		if ($this->intRack != '') {
			$this->btnRack = new QButton($this);
			$this->btnRack->HtmlBefore = 'Filtering by rack: ';
			$moveBoxes = '';
			if (FM2013Session::GetSession(1)=='') $moveBoxes = ' or <a href="rack.php?intSelectRackId='.$this->intRack.'" title="Boxes need moving to this rack" class="bld">Move boxes to rack</a>';
			$this->btnRack->HtmlAfter = ' or <a href="move-rack.php?intRack='.$this->intRack.'" title="Rack needs to be moved to another freezer location" class="bld">Relocate rack</a> '.$moveBoxes.'<br/><br/>';
			$this->btnRack->Text = QApplication::Translate('Turn off');
			$this->lstSearch->Enabled = false;
			$this->lstSearch->Visible = false;
			$this->btnRack->AddAction(new QClickEvent(), new QServerAction('RedirectToListPage'));
		}
		else
			$this->btnRack = new QPlain($this);
	}

	protected function RedirectToListPage() {
		QApplication::Redirect('boxes.php');
	}

	protected function lstSearch_Create() {
		$this->lstSearch = new QListBox($this);
		$this->lstSearch->Name = QApplication::Translate('Filter by misc:');
		$this->lstSearch->CssClass = '';
		$this->lstSearch->HtmlAfter = '<br/><br/>';
		$this->lstSearch->AddItem("--all boxes--",null);
		$this->lstSearch->AddItem('A - Not in a rack', 'A');
		$this->lstSearch->AddItem('B - Previously logged in inventory but missing at last inventory', 'B');
		$this->lstSearch->AddItem('C - Outside our facility (being analyzed)', 'C');
		$this->lstSearch->AddItem('D - Has issues noted', 'D');
		$this->lstSearch->AddItem('E - No samples logged for the box (old sample inventory)', 'E');
		$this->lstSearch->AddItem('H - Boxes logged out of inventory', 'H');
		$this->lstSearch->AddItem('I - Samples inventoried', 'I');
		$this->lstSearch->AddItem('J - Samples NOT inventoried', 'J');
		$this->lstSearch->AddAction(new QChangeEvent(), new QServerAction('lstSearch_Change'));
	}
	protected function lstBoxType_Create() {
		$this->lstBoxType = new QListBox($this);
		$this->lstBoxType->Name = QApplication::Translate('Filter by box type:');
		$this->lstBoxType->CssClass = '';
		$this->lstBoxType->HtmlAfter = '<br/><br/>';
		$this->lstBoxType->AddItem("--all types--",null);
		if ($this->objTypeOfBox) foreach($this->objTypeOfBox as $objTypeOfBox){
			$this->lstBoxType->AddItem($objTypeOfBox->__toString(), $objTypeOfBox->Id);
		}
		$this->lstBoxType->AddAction(new QChangeEvent(), new QServerAction('lstSearch_Change'));	
	}

	protected function lstSearch_Change() {
		QSessionDB::Delete("boxes.php__selectedFreezerPullID");
		$this->dtgBox_Bind();
	}

	protected function txtBox_Create() {
		if ($this->intBoxId != '') {
			$this->txtBox = new QButton($this);
			$this->txtBox->HtmlAfter = '<br/><br/>';
			$this->txtBox->Text = QApplication::Translate('Turn off');
			$this->lstSearch->Enabled = false;
			$this->lstSearch->Visible = false;
			$this->txtBox->AddAction(new QClickEvent(), new QServerAction('RedirectToListPage'));
		}
		else {
			$this->txtBox = new QTextBox($this);
			$this->txtBox->AddAction(new QChangeEvent(), new QServerAction('dtgBox_Bind'));
		}
		$this->txtBox->Name = QApplication::Translate('Filter by box name, issue or description:');
		$this->txtBox->CssClass = '';
	}


	protected function dtgBox_Bind() {
		//@BL if the status filter has not been selected then we run everything normally
		// else we have to run a manual query for selecting status types
		$this->intTotalSamples = $this->intTotalOrphans = 0;

		// if we have selected a box only show that box
		// else we only want to show the boxes by freezer pull ID
		// else we are searching on boxes based on a text search
		if ($this->intBoxId != '') {
			$strAndCondition = "QQ::Like(QQN::Box()->Id,".$this->intBoxId.")";
		}
		elseif (QSessionDB::get("boxes.php__selectedFreezerPullID")!="") {
			$objDatabase = Box::GetDatabase();
			$strQuery = "SELECT `name`
					,rack_id
					,shelf
					,freezer
					,id
					,issues
					,`description`
					,box_type_id
					,sample_type_id
					,created
					,prepared_by_id
					,complete
					,clinic_shipment_id
					FROM fm__box
					WHERE id IN (SELECT box_id
					FROM fm__box_history_log
					where freezer_pull_id=".QSessionDB::get("boxes.php__selectedFreezerPullID")." and received_date IS NULL)";
			$objDbResult = $objDatabase->Query($strQuery);
			$intBoxArray = array();
			$ds = Box::InstantiateDbResult($objDbResult);
			while ($objDbRow = $objDbResult->FetchArray()) {
				array_push($intBoxArray, $objDbRow);
			}
			$this->dtgBox->TotalItemCount = count($intBoxArray);
			$this->dtgBox->DataSource = $ds;
			return;
		}
		elseif ($this->txtBox->Text != '') {
			$strAndCondition = "QQ::OrCondition(QQ::Like(QQN::Box()->Name,'%".trim($this->txtBox->Text)."%'),QQ::Like(QQN::Box()->Issues,'%".trim($this->txtBox->Text)."%'),QQ::Like(QQN::Box()->Description,'%".trim($this->txtBox->Text)."%'))";
		}
		elseif ($this->lstBoxType->SelectedValue != ''){
			// filter by box type
			$strAndCondition = "QQ::Like(QQN::Box()->BoxTypeId,".$this->lstBoxType->SelectedValue.")";
		}
		// if searching on a particular Box then use the filter
		elseif ($this->lstSearch->SelectedValue != ''){
			if ($this->lstSearch->SelectedValue == 'A')
				$strAndCondition = "QQ::OrCondition(QQ::OrCondition(QQ::Equal(QQN::Box()->Rack,''),QQ::IsNull(QQN::Box()->Rack)), QQ::OrCondition(QQ::Equal(QQN::Box()->Freezer,'-1'), QQ::Equal(QQN::Box()->Freezer,'-2')))";
			elseif ($this->lstSearch->SelectedValue == 'B')
			$strAndCondition = "QQ::Equal(QQN::Box()->Freezer,'-1')";
			elseif ($this->lstSearch->SelectedValue == 'C')
			$strAndCondition = "QQ::Equal(QQN::Box()->Freezer,'-2')";
			elseif ($this->lstSearch->SelectedValue == 'D')
			$strAndCondition = "QQ::AndCondition(QQ::NotEqual(QQN::Box()->Issues,''),QQ::IsNotNull(QQN::Box()->Issues))";
			elseif ($this->lstSearch->SelectedValue == 'E') {

				$objDatabase = Box::GetDatabase();
				$strQuery = "SELECT id,name,rack_id,shelf,freezer,issues,description,box_type_id,sample_type_id FROM box b WHERE id NOT IN (SELECT f.box_ident from frz_inventory f WHERE b.id=f.box_ident) ORDER BY b.name";
				$objDbResult = $objDatabase->Query($strQuery);
				$intBoxArray = array();
				$ds = Box::InstantiateDbResult($objDbResult);
				$this->dtgBox->TotalItemCount = count($ds);
				$this->dtgBox->DataSource = $ds;
				return;
			}
			// 			elseif ($this->lstSearch->SelectedValue == 'F') {
			// 				$objDatabase = Box::GetDatabase();
			// 				$strQuery = "SELECT * FROM box b WHERE name LIKE '%PLB%' ORDER BY b.name";
			// 				$objDbResult = $objDatabase->Query($strQuery);
			// 				$intBoxArray = array();
			// 				$ds = Box::InstantiateDbResult($objDbResult);
			// 				while ($objDbRow = $objDbResult->FetchArray()) {
			// 					array_push($intBoxArray, $objDbRow);
			// 				}
			// 				$this->dtgBox->TotalItemCount = count($intBoxArray);
			// 				$this->dtgBox->DataSource = $ds;
			// 				return;
			// 			}
			elseif ($this->lstSearch->SelectedValue == 'H') {
				$objDatabase = Box::GetDatabase();
				$strQuery = "SELECT DISTINCT b.id,b.name,b.rack_id,b.shelf,b.freezer,b.issues,b.description,b.box_type_id,b.sample_type_id FROM fm__box b
						INNER JOIN fm__box_history_log bh ON bh.box_id=b.id
						WHERE bh.received_date IS NULL ORDER BY b.name";
				$objDbResult = $objDatabase->Query($strQuery);
				$ds = Box::InstantiateDbResult($objDbResult);
				$this->dtgBox->TotalItemCount = count($ds);
				$this->dtgBox->DataSource = $ds;
				return;
			}
			elseif ($this->lstSearch->SelectedValue == 'I')
			$strAndCondition = "QQ::Equal(QQN::Box()->Complete,1)";
			elseif ($this->lstSearch->SelectedValue == 'J')
			$strAndCondition = "QQ::OrCondition(
				QQ::Equal(QQN::Box()->Complete, 0),
				QQ::IsNull(QQN::Box()->Complete)
			)";
			elseif ($this->lstSearch->SelectedValue == 'G')
			$strAndCondition = "QQ::OrCondition(QQ::Like(QQN::Box()->Name,'E03-%'),QQ::Like(QQN::Box()->Name,'E03%'),QQ::Like(QQN::Box()->Name,'AG19-%'))";
		}
		else {
			// coming from freezer contents view
			if ($this->intRack != '') {
				if ($this->intFreezerId != '')
					$strAndCondition = "QQ::AndCondition(QQ::Equal(QQN::Box()->RackId,".$this->intRack.")
							,QQ::Equal(QQN::Box()->Freezer,".$this->intFreezerId."))";
				else
					$strAndCondition = "QQ::Equal(QQN::Box()->RackId,".$this->intRack.")";
			}
			else $strAndCondition = "QQ::All()";
		}
		// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
		$this->dtgBox->TotalItemCount = Box::QueryCount(eval("return $strAndCondition;"));

		// Setup the $objClauses Array
		$objClauses = array();

		// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
		// the OrderByClause to the $objClauses array
		if ($objClause = $this->dtgBox->OrderByClause)
			array_push($objClauses, $objClause);

		// Add the LimitClause information, as well
		if ($objClause = $this->dtgBox->LimitClause)
			array_push($objClauses, $objClause);


		$this->dtgBox->DataSource = Box::QueryArray(eval("return $strAndCondition;"), $objClauses, null, array('id','name','rack_id','description','shelf','freezer','issues','box_type_id','sample_type_id', 'complete'));
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('box_list');
?>