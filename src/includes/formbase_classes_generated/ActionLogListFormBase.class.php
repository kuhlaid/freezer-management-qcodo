<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the ActionLog class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of ActionLog objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ActionLogListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ActionLogListFormBase extends QForm {
		protected $dtgActionLog;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colJsonData;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgActionLog_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ActionLog()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ActionLog()->Id, false)));
			$this->colJsonData = new QDataGridColumn(QApplication::Translate('Json Data'), '<?= QString::Truncate($_ITEM->JsonData, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ActionLog()->JsonData), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ActionLog()->JsonData, false)));

			// Setup DataGrid
			$this->dtgActionLog = new QDataGrid($this);
			$this->dtgActionLog->CellSpacing = 0;
			$this->dtgActionLog->CellPadding = 4;
			$this->dtgActionLog->BorderStyle = QBorderStyle::Solid;
			$this->dtgActionLog->BorderWidth = 1;
			$this->dtgActionLog->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgActionLog->Paginator = new QPaginator($this->dtgActionLog);
			$this->dtgActionLog->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgActionLog->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgActionLog->SetDataBinder('dtgActionLog_Bind');

			$this->dtgActionLog->AddColumn($this->colEditLinkColumn);
			$this->dtgActionLog->AddColumn($this->colId);
			$this->dtgActionLog->AddColumn($this->colJsonData);
		}
		
		public function dtgActionLog_EditLinkColumn_Render(ActionLog $objActionLog) {
			return sprintf('<a href="action_log_edit.php?intId=%s">%s</a>',
				$objActionLog->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgActionLog_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgActionLog->TotalItemCount = ActionLog::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgActionLog->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgActionLog->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all ActionLog objects, given the clauses above
			$this->dtgActionLog->DataSource = ActionLog::LoadAll($objClauses);
		}
	}
?>