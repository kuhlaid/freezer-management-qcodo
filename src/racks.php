<?php
/**
 * @abstract This is a report view of our sample racks.
 * @author w. Patrick Gale - July 2012
 *
 * March 18, 2020 - wpg
 * - adding ID column
 * 
 * - updated the freezer array (Feb. 4, 2016 - wpg)
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */

// Include the classfile for RackListFormBase
require(__FORMBASE_CLASSES__ . '/RackListFormBase.class.php');

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();


class RackListForm8 extends RackListFormBase {
	protected $colBoxCount, $colFreezer, $objTypeOfRackArray,$intRack, $txtBox, $objFreezerArray;
	protected function Form_Create() {
		$this->txtBox_Create();
		$this->intRack = QApplication::QueryString('intRackId');

		// show box options for selecting the freezer
		foreach (Freezer::$freezerArray as $freezerCode => $freezerName) {
			$this->objFreezerArray[$freezerCode] = "(".$freezerCode.") ".$freezerName;
		}
		// show actual freezers
		$objFreezerArray = Freezer::QueryArray(QQ::All(),null,null,array('id','name'));
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$this->objFreezerArray[$objFreezer->Id] = $objFreezer->__toString();
		}

		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Options'), '<?= $_FORM->dtgRack_EditLinkColumn_Render($_ITEM) ?>');
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Name, false)));
		$this->colRackTypeId = new QDataGridColumn(QApplication::Translate('Type'), '<?= $_FORM->dtgRack_RackType_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->RackType->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->RackType->Id, false)));
		$this->colBoxCount = new QDataGridColumn(QApplication::Translate('Boxes'), '<?= $_FORM->dtgRack_BoxCount_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->RackType->BoxCount), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->RackType->BoxCount, false)));
		$this->colNotes = new QDataGridColumn(QApplication::Translate('Notes'), '<?= QString::Truncate($_ITEM->Notes, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Notes), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Notes, false)));
		$this->colFreezer = new QDataGridColumn(QApplication::Translate('Location'), '<?= $_FORM->dtgRack_Freezer_Render($_ITEM); ?>');
		$this->colBoxCount->HtmlEntities = $this->colFreezer->HtmlEntities = $this->colEditLinkColumn->HtmlEntities = false;
		$this->colFreezer->Wrap = false;

		// Setup DataGrid
		$this->dtgRack = new QDataGrid($this);
		$this->dtgRack->CellSpacing = 0;
		$this->dtgRack->CellPadding = 4;
		$this->dtgRack->BorderStyle = QBorderStyle::Solid;
		$this->dtgRack->BorderWidth = 1;
		$this->dtgRack->GridLines = QGridLines::Both;
		$this->dtgRack->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgRack->Paginator = new QPaginator($this->dtgRack);
		$this->dtgRack->ItemsPerPage = __ITEMS_PER_PAGE__;

		$this->dtgRack->SortColumnIndex=1;
		$this->dtgRack->SortDirection = 1;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgRack->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgRack->SetDataBinder('dtgRack_Bind');

		$this->dtgRack->AddColumn($this->colEditLinkColumn);
		$this->dtgRack->AddColumn($this->colId);
		$this->dtgRack->AddColumn($this->colName);
		$this->dtgRack->AddColumn($this->colRackTypeId);
		$this->dtgRack->AddColumn($this->colBoxCount);
		$this->dtgRack->AddColumn($this->colFreezer);
		$this->dtgRack->AddColumn($this->colNotes);
		$this->objTypeOfRackArray = TypeOfRack::QueryArray(QQ::All(),null,null,array('id','name','`rows`','columns','box_count'));
	}

	protected function txtBox_Create() {
		$this->txtBox = new QTextBox($this);
		$this->txtBox->AddAction(new QChangeEvent(), new QServerAction('dtgRack_Bind'));
		$this->txtBox->Name = QApplication::Translate('Filter by rack name:');
		$this->txtBox->CssClass = '';
	}

	public function dtgRack_EditLinkColumn_Render(Rack $objRack) {
		return sprintf('<a href="rack.php?intId=%s">%s</a>
		<br/><a href="move-rack.php?intRack=%s" title="Rack needs to be moved to another freezer location" class="bld">Relocate</a>',
				$objRack->Id,
				QApplication::Translate('Edit'),
				$objRack->Id);
	}

	public function dtgRack_RackType_Render(Rack $objRack) {
		if (!is_null($objRack->RackTypeId))
			if ($this->objTypeOfRackArray) foreach($this->objTypeOfRackArray as $objTypeOfRack) {
			if ($objTypeOfRack->Id == $objRack->RackTypeId) return $objTypeOfRack->__toString();
		}
		else
			return null;
	}

	public function dtgRack_BoxCount_Render(Rack $objRack) {
		$objBoxArray = Box::QueryArray(QQ::Equal(QQN::Box()->RackId, $objRack->Id),null,null,array('id','name'));
		$a='';
		if ($objBoxArray) foreach($objBoxArray as $objBox){
			if($a!='') $a.=", ";
			$a.="<a href='boxes.php?intBoxId=".$objBox->Id."'>".$objBox->Name."</a>";
		}
		return $a;
	}

	public function dtgRack_Freezer_Render(Rack $objRack) {
		// 		$objBoxArray = Box::QueryArray(QQ::Equal(QQN::Box()->RackId, $objRack->Id),QQ::Clause(QQ::OrderBy(QQN::Box()->Freezer, QQN::Box()->Shelf)),null,array('freezer', 'shelf'));
		// 		$temp=$f=$s='';
		// 		if ($objBoxArray) foreach($objBoxArray as $objBox){
		// 			// if the box freezer and shelf location has changed then we need to show it
		// 			if ($objBox->Freezer && $objBox->Freezer!=$f || $s!=$objBox->Shelf)
			// 				$temp.=	'<a href="freezer-view.php?intFreezer='.$objBox->Freezer.'">Freezer #'.$objBox->Freezer.'</a>'.($objBox->Shelf ? "<br/>Shelf #".$objBox->Shelf:'');

			// 			$f=$objBox->Freezer;
			// 			$s=$objBox->Shelf;
			// 		}
			// 		else
				// 			return null;

				$freezerName='';
			if (array_key_exists($objRack->Freezer, $this->objFreezerArray) && trim($objRack->Freezer ?? '')!="")
				$freezerName=$this->objFreezerArray[$objRack->Freezer];
			return '<a href="freezer-view.php?intFreezer='.$objRack->Freezer.'">'.$freezerName.'</a>'.($objRack->Shelf ? "<br/>Shelf #".$objRack->Shelf:'');
	}

	protected function dtgRack_Bind() {
		// filter by rack
		if ($this->intRack != '') {
			$strAndCondition = "QQ::Equal(QQN::Rack()->Id,".$this->intRack.")";
		}
		elseif ($this->txtBox->Text != '') {
			$strAndCondition = "QQ::OrCondition(QQ::Like(QQN::Rack()->Name,'%".$this->txtBox->Text."%'))";
		}
		else $strAndCondition = "QQ::All()";

		// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
		$this->dtgRack->TotalItemCount = Rack::QueryCount(eval("return $strAndCondition;"));

		// Setup the $objClauses Array
		$objClauses = array();

		// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
		// the OrderByClause to the $objClauses array
		if ($objClause = $this->dtgRack->OrderByClause)
			array_push($objClauses, $objClause);

		// Add the LimitClause information, as well
		if ($objClause = $this->dtgRack->LimitClause)
			array_push($objClauses, $objClause);

		// Set the DataSource to be the array of all Rack objects, given the clauses above
		$this->dtgRack->DataSource = Rack::QueryArray(eval("return $strAndCondition;"),$objClauses,null,array('id','name','notes','rack_type_id','freezer','shelf'));
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('rack_list');
?>