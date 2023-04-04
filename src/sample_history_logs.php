<?php
/**
 * @abstract Lists samples that have been logged out of our inventory for analysis, what freezer pull ID they
 * are associated with and when the samples were released and received.
 * @author w. Patrick Gale (July 2013)
 */
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/SampleHistoryLogListFormBase.class.php');
QApplication::CheckRemoteAdmin();


class SampleHistoryLogListForm extends SampleHistoryLogListFormBase {

	protected function Form_Create() {
		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleHistoryLog_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colSampleId = new QDataGridColumn(QApplication::Translate('Sample ID'), '<?= $_ITEM->SampleId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->SampleId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->SampleId, false)));
		$this->colReleaseDate = new QDataGridColumn(QApplication::Translate('Released On'), '<?= $_FORM->dtgSampleHistoryLog_ReleaseDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReleaseDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReleaseDate, false)));
		$this->colFreezerPullId = new QDataGridColumn(QApplication::Translate('Freezer Pull ID'), '#<?= $_ITEM->FreezerPullId; ?>-fp', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->FreezerPullId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->FreezerPullId, false)));
		$this->colReceivedDate = new QDataGridColumn(QApplication::Translate('Received On'), '<?= $_FORM->dtgSampleHistoryLog_ReceivedDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReceivedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReceivedDate, false)));

		// Setup DataGrid
		$this->dtgSampleHistoryLog = new QDataGrid($this);
		$this->dtgSampleHistoryLog->CellSpacing = 0;
		$this->dtgSampleHistoryLog->CellPadding = 4;
		$this->dtgSampleHistoryLog->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleHistoryLog->BorderWidth = 1;
		$this->dtgSampleHistoryLog->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSampleHistoryLog->Paginator = new QPaginator($this->dtgSampleHistoryLog);
		$this->dtgSampleHistoryLog->ItemsPerPage = __ITEMS_PER_PAGE__;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleHistoryLog->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleHistoryLog->SetDataBinder('dtgSampleHistoryLog_Bind');

		$this->dtgSampleHistoryLog->AddColumn($this->colSampleId);
		$this->dtgSampleHistoryLog->AddColumn($this->colReleaseDate);
		$this->dtgSampleHistoryLog->AddColumn($this->colFreezerPullId);
		$this->dtgSampleHistoryLog->AddColumn($this->colReceivedDate);
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('sample_history_logs');

?>