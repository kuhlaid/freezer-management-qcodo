<?php
/**
 * Oct. 6, 2020 - wpg
 * - adding filtering by freezer
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/FreezerMaintenanceListFormBase.class.php');
QApplication::CheckRemoteAdmin();

// admin business logic
class FreezerMaintenanceListForm8 extends FreezerMaintenanceListFormBase {
	protected $colFreezers, $lstFreezers;
	protected function Form_Create() {
		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFreezerMaintenance_EditLinkColumn_Render($_ITEM) ?>');
		$this->colLogDate = new QDataGridColumn(QApplication::Translate('Date'), '<?= $_FORM->dtgFreezerMaintenance_LogDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->LogDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->LogDate, false)));
		$this->colMainLog = new QDataGridColumn(QApplication::Translate('Log'), '<?= $_ITEM->MainLog; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->MainLog), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->MainLog, false)));
		$this->colFreezers = new QDataGridColumn(QApplication::Translate('Freezers'), '<?= $_FORM->dtgFreezerMaintenance_Freezers_Render($_ITEM); ?>');
		$this->colAlertUser = new QDataGridColumn(QApplication::Translate('Alert User'), '<?= ($_ITEM->AlertUser) ? __CHECK_ICON__ : "" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->AlertUser), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->AlertUser, false)));
		$this->colAlertUser->HtmlEntities = $this->colEditLinkColumn->HtmlEntities = $this->colFreezers->HtmlEntities = false;

		$this->colAlertUser->HorizontalAlign = QHorizontalAlign::Center;

		// Setup DataGrid
		$this->dtgFreezerMaintenance = new QDataGrid($this);
		$this->dtgFreezerMaintenance->CellSpacing = 0;
		$this->dtgFreezerMaintenance->CellPadding = 4;
		$this->dtgFreezerMaintenance->BorderStyle = QBorderStyle::Solid;
		$this->dtgFreezerMaintenance->BorderWidth = 1;
		$this->dtgFreezerMaintenance->GridLines = QGridLines::Both;
		$this->dtgFreezerMaintenance->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgFreezerMaintenance->Paginator = new QPaginator($this->dtgFreezerMaintenance);
		$this->dtgFreezerMaintenance->ItemsPerPage = __ITEMS_PER_PAGE__;

		$this->dtgFreezerMaintenance->SortColumnIndex = 1;
		$this->dtgFreezerMaintenance->SortDirection = 1;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgFreezerMaintenance->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgFreezerMaintenance->SetDataBinder('dtgFreezerMaintenance_Bind');

		$this->showColumns();
		$this->lstFreezers_Create();
	}

	// select a freezer to show information on
	protected function lstFreezers_Create() {
		$this->lstFreezers = new QListBox($this);
		$this->lstFreezers->Name = "Filter by freezer: ";
		$this->lstFreezers->HtmlAfter = '<br/><br/>';
		$objFreezerArray = Freezer::QueryArray(QQ::Equal(QQN::Freezer()->InUse,1),QQ::Clause(QQ::OrderBy(QQN::Freezer()->Name)),null, array('name','id'));
		$this->lstFreezers->AddItem("-- all freezers --",null);
		if ($objFreezerArray) foreach ($objFreezerArray as $objFreezer) {
			$objListItem = new QListItem($objFreezer->__toString(), $objFreezer->Id);
			$this->lstFreezers->AddItem($objListItem);
		}
		$this->lstFreezers->AddAction(new QChangeEvent(), new QServerAction('dtgFreezerMaintenance_Bind'));
	}

	protected function showColumns() {
		$this->dtgFreezerMaintenance->AddColumn($this->colEditLinkColumn);
		$this->dtgFreezerMaintenance->AddColumn($this->colLogDate);
		$this->dtgFreezerMaintenance->AddColumn($this->colMainLog);
		$this->dtgFreezerMaintenance->AddColumn($this->colFreezers);
		$this->dtgFreezerMaintenance->AddColumn($this->colAlertUser);
	}
	
	public function dtgFreezerMaintenance_EditLinkColumn_Render(FreezerMaintenance $objFreezerMaintenance) {
		return sprintf('<a href="freezer-maintenance.php?intId=%s">%s</a>',
				$objFreezerMaintenance->Id,
				QApplication::Translate('Edit'));
	}

	public function dtgFreezerMaintenance_Freezers_Render(FreezerMaintenance $objFreezerMaintenance) {
		$objFreezerArray = $objFreezerMaintenance->GetFreezerAsFrzMainArray();
		$temp='';
		if ($objFreezerArray) foreach($objFreezerArray as $objFreezer) {
			$temp.="<a href='freezer-view.php?intFreezer=".$objFreezer->Id."' title='View freezer inventory'>".$objFreezer->__toString()."</a><br/>";
		}
		return $temp;
	}

	protected function dtgFreezerMaintenance_Bind() {
		// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()
		if ($this->lstFreezers->SelectedValue != '') $this->dtgFreezerMaintenance->TotalItemCount = FreezerMaintenance::CountByFreezerAsFrzMain($this->lstFreezers->SelectedValue);
		else $this->dtgFreezerMaintenance->TotalItemCount = FreezerMaintenance::CountAll();

		// Setup the $objClauses Array
		$objClauses = array();

		// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
		// the OrderByClause to the $objClauses array
		if ($objClause = $this->dtgFreezerMaintenance->OrderByClause)
			array_push($objClauses, $objClause);

		// Add the LimitClause information, as well
		if ($objClause = $this->dtgFreezerMaintenance->LimitClause)
			array_push($objClauses, $objClause);

		if ($this->lstFreezers->SelectedValue != '') $this->dtgFreezerMaintenance->DataSource =  FreezerMaintenance::LoadArrayByFreezerAsFrzMain($this->lstFreezers->SelectedValue,$objClauses);
		else $this->dtgFreezerMaintenance->DataSource = FreezerMaintenance::LoadAll($objClauses);
	}
	
}

class FreezerMaintenanceListForm13 extends FreezerMaintenanceListForm8 {

	protected function showColumns() {
		$this->dtgFreezerMaintenance->AddColumn($this->colLogDate);
		$this->dtgFreezerMaintenance->AddColumn($this->colMainLog);
		$this->dtgFreezerMaintenance->AddColumn($this->colFreezers);
	}
}
// go to the centralized form executing access control function to run the form and check access control
ACL_Run('freezer-maintenance-logs');
?>