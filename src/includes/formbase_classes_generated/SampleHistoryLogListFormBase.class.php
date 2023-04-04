<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the SampleHistoryLog class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of SampleHistoryLog objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleHistoryLogListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleHistoryLogListFormBase extends QForm {
		protected $dtgSampleHistoryLog;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colSampleId;
		protected $colReleaseDate;
		protected $colFreezerPullId;
		protected $colReceivedDate;
		protected $colNote;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleHistoryLog_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->Id, false)));
			$this->colSampleId = new QDataGridColumn(QApplication::Translate('Sample Id'), '<?= $_ITEM->SampleId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->SampleId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->SampleId, false)));
			$this->colReleaseDate = new QDataGridColumn(QApplication::Translate('Release Date'), '<?= $_FORM->dtgSampleHistoryLog_ReleaseDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReleaseDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReleaseDate, false)));
			$this->colFreezerPullId = new QDataGridColumn(QApplication::Translate('Freezer Pull Id'), '<?= $_ITEM->FreezerPullId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->FreezerPullId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->FreezerPullId, false)));
			$this->colReceivedDate = new QDataGridColumn(QApplication::Translate('Received Date'), '<?= $_FORM->dtgSampleHistoryLog_ReceivedDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReceivedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReceivedDate, false)));
			$this->colNote = new QDataGridColumn(QApplication::Translate('Note'), '<?= QString::Truncate($_ITEM->Note, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->Note), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->Note, false)));

			// Setup DataGrid
			$this->dtgSampleHistoryLog = new QDataGrid($this);
			$this->dtgSampleHistoryLog->CellSpacing = 0;
			$this->dtgSampleHistoryLog->CellPadding = 4;
			$this->dtgSampleHistoryLog->BorderStyle = QBorderStyle::Solid;
			$this->dtgSampleHistoryLog->BorderWidth = 1;
			$this->dtgSampleHistoryLog->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgSampleHistoryLog->Paginator = new QPaginator($this->dtgSampleHistoryLog);
			$this->dtgSampleHistoryLog->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgSampleHistoryLog->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgSampleHistoryLog->SetDataBinder('dtgSampleHistoryLog_Bind');

			$this->dtgSampleHistoryLog->AddColumn($this->colEditLinkColumn);
			$this->dtgSampleHistoryLog->AddColumn($this->colId);
			$this->dtgSampleHistoryLog->AddColumn($this->colSampleId);
			$this->dtgSampleHistoryLog->AddColumn($this->colReleaseDate);
			$this->dtgSampleHistoryLog->AddColumn($this->colFreezerPullId);
			$this->dtgSampleHistoryLog->AddColumn($this->colReceivedDate);
			$this->dtgSampleHistoryLog->AddColumn($this->colNote);
		}
		
		public function dtgSampleHistoryLog_EditLinkColumn_Render(SampleHistoryLog $objSampleHistoryLog) {
			return sprintf('<a href="sample_history_log_edit.php?intId=%s">%s</a>',
				$objSampleHistoryLog->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgSampleHistoryLog_ReleaseDate_Render(SampleHistoryLog $objSampleHistoryLog) {
			if (!is_null($objSampleHistoryLog->ReleaseDate))
				return $objSampleHistoryLog->ReleaseDate->toString(QDateTime::FormatDisplayDate);
			else
				return null;
		}

		public function dtgSampleHistoryLog_ReceivedDate_Render(SampleHistoryLog $objSampleHistoryLog) {
			if (!is_null($objSampleHistoryLog->ReceivedDate))
				return $objSampleHistoryLog->ReceivedDate->toString(QDateTime::FormatDisplayDate);
			else
				return null;
		}


		protected function dtgSampleHistoryLog_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgSampleHistoryLog->TotalItemCount = SampleHistoryLog::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgSampleHistoryLog->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgSampleHistoryLog->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all SampleHistoryLog objects, given the clauses above
			$this->dtgSampleHistoryLog->DataSource = SampleHistoryLog::LoadAll($objClauses);
		}
	}
?>