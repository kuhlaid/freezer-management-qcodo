<?php
/**
 * This is the abstract Form class for the List All functionality
 * of the FreezerMaintenance class.  This code-generated class
 * contains a Qform datagrid to display an HTML page that can
 * list a collection of FreezerMaintenance objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Form which extends this FreezerMaintenanceListFormBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage FormBaseObjects
 *
 */
abstract class FreezerMaintenanceListFormBase extends QForm {
	protected $dtgFreezerMaintenance;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colLogDate;
		protected $colMainLog;
		protected $colAlertUser;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFreezerMaintenance_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->Id, false)));
			$this->colLogDate = new QDataGridColumn(QApplication::Translate('Log Date'), '<?= $_FORM->dtgFreezerMaintenance_LogDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->LogDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->LogDate, false)));
			$this->colMainLog = new QDataGridColumn(QApplication::Translate('Main Log'), '<?= QString::Truncate($_ITEM->MainLog, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->MainLog), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->MainLog, false)));
			$this->colAlertUser = new QDataGridColumn(QApplication::Translate('Alert User'), '<?= ($_ITEM->AlertUser) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->AlertUser), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FreezerMaintenance()->AlertUser, false)));

		// Setup DataGrid
		$this->dtgFreezerMaintenance = new QDataGrid($this);
		$this->dtgFreezerMaintenance->CellSpacing = 0;
		$this->dtgFreezerMaintenance->CellPadding = 4;
		$this->dtgFreezerMaintenance->BorderStyle = QBorderStyle::Solid;
		$this->dtgFreezerMaintenance->BorderWidth = 1;
		$this->dtgFreezerMaintenance->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgFreezerMaintenance->Paginator = new QPaginator($this->dtgFreezerMaintenance);
		$this->dtgFreezerMaintenance->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgFreezerMaintenance->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgFreezerMaintenance->SetDataBinder('dtgFreezerMaintenance_Bind');

			$this->dtgFreezerMaintenance->AddColumn($this->colEditLinkColumn);
			$this->dtgFreezerMaintenance->AddColumn($this->colId);
			$this->dtgFreezerMaintenance->AddColumn($this->colLogDate);
			$this->dtgFreezerMaintenance->AddColumn($this->colMainLog);
			$this->dtgFreezerMaintenance->AddColumn($this->colAlertUser);
		}
		
		public function dtgFreezerMaintenance_EditLinkColumn_Render(FreezerMaintenance $objFreezerMaintenance) {
			return sprintf('<a href="freezer_maintenance_edit.php?intId=%s">%s</a>',
				$objFreezerMaintenance->Id, 
				QApplication::Translate('Edit'));
	}

	public function dtgFreezerMaintenance_LogDate_Render(FreezerMaintenance $objFreezerMaintenance) {
		if (!is_null($objFreezerMaintenance->LogDate))
			return $objFreezerMaintenance->LogDate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}


	protected function dtgFreezerMaintenance_Bind() {
		// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

		// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
		$this->dtgFreezerMaintenance->TotalItemCount = FreezerMaintenance::CountAll();

		// Setup the $objClauses Array
		$objClauses = array();

		// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
		// the OrderByClause to the $objClauses array
		if ($objClause = $this->dtgFreezerMaintenance->OrderByClause)
			array_push($objClauses, $objClause);

		// Add the LimitClause information, as well
		if ($objClause = $this->dtgFreezerMaintenance->LimitClause)
			array_push($objClauses, $objClause);

		// Set the DataSource to be the array of all FreezerMaintenance objects, given the clauses above
		$this->dtgFreezerMaintenance->DataSource = FreezerMaintenance::LoadAll($objClauses);
	}
}
?>