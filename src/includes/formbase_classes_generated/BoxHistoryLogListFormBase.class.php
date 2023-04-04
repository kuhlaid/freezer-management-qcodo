<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the BoxHistoryLog class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of BoxHistoryLog objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this BoxHistoryLogListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class BoxHistoryLogListFormBase extends QForm {
		protected $dtgBoxHistoryLog;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colBoxId;
		protected $colReleaseDate;
		protected $colFreezerPullId;
		protected $colReceivedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgBoxHistoryLog_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->Id, false)));
			$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box Id'), '<?= $_FORM->dtgBoxHistoryLog_Box_Render($_ITEM); ?>');
			$this->colReleaseDate = new QDataGridColumn(QApplication::Translate('Release Date'), '<?= $_FORM->dtgBoxHistoryLog_ReleaseDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReleaseDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReleaseDate, false)));
			$this->colFreezerPullId = new QDataGridColumn(QApplication::Translate('Freezer Pull Id'), '<?= $_ITEM->FreezerPullId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->FreezerPullId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->FreezerPullId, false)));
			$this->colReceivedDate = new QDataGridColumn(QApplication::Translate('Received Date'), '<?= $_FORM->dtgBoxHistoryLog_ReceivedDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReceivedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReceivedDate, false)));

			// Setup DataGrid
			$this->dtgBoxHistoryLog = new QDataGrid($this);
			$this->dtgBoxHistoryLog->CellSpacing = 0;
			$this->dtgBoxHistoryLog->CellPadding = 4;
			$this->dtgBoxHistoryLog->BorderStyle = QBorderStyle::Solid;
			$this->dtgBoxHistoryLog->BorderWidth = 1;
			$this->dtgBoxHistoryLog->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgBoxHistoryLog->Paginator = new QPaginator($this->dtgBoxHistoryLog);
			$this->dtgBoxHistoryLog->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgBoxHistoryLog->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgBoxHistoryLog->SetDataBinder('dtgBoxHistoryLog_Bind');

			$this->dtgBoxHistoryLog->AddColumn($this->colEditLinkColumn);
			$this->dtgBoxHistoryLog->AddColumn($this->colId);
			$this->dtgBoxHistoryLog->AddColumn($this->colBoxId);
			$this->dtgBoxHistoryLog->AddColumn($this->colReleaseDate);
			$this->dtgBoxHistoryLog->AddColumn($this->colFreezerPullId);
			$this->dtgBoxHistoryLog->AddColumn($this->colReceivedDate);
		}
		
		public function dtgBoxHistoryLog_EditLinkColumn_Render(BoxHistoryLog $objBoxHistoryLog) {
			return sprintf('<a href="box_history_log_edit.php?intId=%s">%s</a>',
				$objBoxHistoryLog->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgBoxHistoryLog_Box_Render(BoxHistoryLog $objBoxHistoryLog) {
			if (!is_null($objBoxHistoryLog->Box))
				return $objBoxHistoryLog->Box->__toString();
			else
				return null;
		}

		public function dtgBoxHistoryLog_ReleaseDate_Render(BoxHistoryLog $objBoxHistoryLog) {
			if (!is_null($objBoxHistoryLog->ReleaseDate))
				return $objBoxHistoryLog->ReleaseDate->toString(QDateTime::FormatDisplayDate);
			else
				return null;
		}

		public function dtgBoxHistoryLog_ReceivedDate_Render(BoxHistoryLog $objBoxHistoryLog) {
			if (!is_null($objBoxHistoryLog->ReceivedDate))
				return $objBoxHistoryLog->ReceivedDate->toString(QDateTime::FormatDisplayDate);
			else
				return null;
		}


		protected function dtgBoxHistoryLog_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgBoxHistoryLog->TotalItemCount = BoxHistoryLog::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgBoxHistoryLog->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgBoxHistoryLog->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all BoxHistoryLog objects, given the clauses above
			$this->dtgBoxHistoryLog->DataSource = BoxHistoryLog::LoadAll($objClauses);
		}
	}
?>