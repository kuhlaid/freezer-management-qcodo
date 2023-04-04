<?php
/**
 * @abstract Lists complete boxes (where samples were not checked) that have been logged out of our inventory for analysis, what freezer pull ID they
 * are associated with and when the boxes were released and received.
 * @author w. Patrick Gale (July 2013)
 */

// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/BoxHistoryLogListFormBase.class.php');
QApplication::CheckRemoteAdmin();

class BoxHistoryLogListForm extends BoxHistoryLogListFormBase {

	protected function Form_Create() {
		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgBoxHistoryLog_EditLinkColumn_Render($_ITEM) ?>');

		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->Id, false)));
		$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box'), '<?= $_FORM->dtgBoxHistoryLog_Box_Render($_ITEM); ?>');
		$this->colReleaseDate = new QDataGridColumn(QApplication::Translate('Release Date'), '<?= $_FORM->dtgBoxHistoryLog_ReleaseDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReleaseDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReleaseDate, false)));
		$this->colFreezerPullId = new QDataGridColumn(QApplication::Translate('Freezer Pull Id'), '#<?= $_ITEM->FreezerPullId; ?>-fp', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->FreezerPullId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->FreezerPullId, false)));
		$this->colReceivedDate = new QDataGridColumn(QApplication::Translate('Received Date'), '<?= $_FORM->dtgBoxHistoryLog_ReceivedDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReceivedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReceivedDate, false)));
		$this->colEditLinkColumn->HtmlEntities = $this->colBoxId->HtmlEntities = false;
		$this->colBoxId->CssClass = 'bld fs18';
		$this->colBoxId->HorizontalAlign = QHorizontalAlign::Center;

		// Setup DataGrid
		$this->dtgBoxHistoryLog = new QDataGrid($this);
		$this->dtgBoxHistoryLog->CellSpacing = 0;
		$this->dtgBoxHistoryLog->CellPadding = 4;
		$this->dtgBoxHistoryLog->BorderStyle = QBorderStyle::Solid;
		$this->dtgBoxHistoryLog->BorderWidth = 1;
		$this->dtgBoxHistoryLog->GridLines = QGridLines::Both;
		$this->dtgBoxHistoryLog->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgBoxHistoryLog->Paginator = new QPaginator($this->dtgBoxHistoryLog);
		$this->dtgBoxHistoryLog->ItemsPerPage = __ITEMS_PER_PAGE__;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgBoxHistoryLog->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgBoxHistoryLog->SetDataBinder('dtgBoxHistoryLog_Bind');

		$this->dtgBoxHistoryLog->AddColumn($this->colEditLinkColumn);
		$this->dtgBoxHistoryLog->AddColumn($this->colBoxId);
		$this->dtgBoxHistoryLog->AddColumn($this->colReleaseDate);
		$this->dtgBoxHistoryLog->AddColumn($this->colFreezerPullId);
		$this->dtgBoxHistoryLog->AddColumn($this->colReceivedDate);
	}


	public function dtgBoxHistoryLog_Box_Render(BoxHistoryLog $objBoxHistoryLog) {
		if (!is_null($objBoxHistoryLog->Box))
			return "<a href='boxes.php?intBoxId=".$objBoxHistoryLog->Box->Id."'>".$objBoxHistoryLog->Box->__toString()."</a>";
		else
			return null;
	}

	public function dtgBoxHistoryLog_EditLinkColumn_Render(BoxHistoryLog $objBoxHistoryLog) {
		return sprintf('<a href="box_history_log.php?intId=%s">%s</a>',
				$objBoxHistoryLog->Id,
				QApplication::Translate('Edit'));
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('box_history_logs');
?>