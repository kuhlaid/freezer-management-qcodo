<?php
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/SampleTypesListFormBase.class.php');
QApplication::CheckRemoteAdmin();


class SampleTypesListForm extends SampleTypesListFormBase {

	protected function Form_Create() {
		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleTypes_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Type Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Id, false)));
		$this->colLetter = new QDataGridColumn(QApplication::Translate('Letter'), '<?= QString::Truncate($_ITEM->Letter, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Letter), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Letter, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Description, false)));

		// Setup DataGrid
		$this->dtgSampleTypes = new QDataGrid($this);
		$this->dtgSampleTypes->CellSpacing = 0;
		$this->dtgSampleTypes->CellPadding = 4;
		$this->dtgSampleTypes->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleTypes->BorderWidth = 1;
		$this->dtgSampleTypes->GridLines = QGridLines::Both;
		$this->dtgSampleTypes->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgSampleTypes->Paginator = new QPaginator($this->dtgSampleTypes);
		$this->dtgSampleTypes->ItemsPerPage = __ITEMS_PER_PAGE__;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleTypes->UseAjax = false;

		$this->dtgSampleTypes->SortColumnIndex = 3;
		//$this->dtgSampleTypes->SortDirection = 1;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleTypes->SetDataBinder('dtgSampleTypes_Bind');

		$this->dtgSampleTypes->AddColumn($this->colEditLinkColumn);
		$this->dtgSampleTypes->AddColumn($this->colId);
		$this->dtgSampleTypes->AddColumn($this->colLetter);
		$this->dtgSampleTypes->AddColumn($this->colDescription);
	}

	public function dtgSampleTypes_EditLinkColumn_Render(SampleTypes $objSampleTypes) {
		return sprintf('<a href="type_of_sample.php?intId=%s">%s</a>',
				$objSampleTypes->Id,
				QApplication::Translate('Edit'));
	}
}


// go to the centralized form executing access control function to run the form and check access control
ACL_Run('types_of_sample');
?>