<?php
// creating a variable for storing update information to the script
$__script_log__ = <<<MLS
Logic:
Just simple list of types of boxes that can be found in the freezer for the purpose of tracking
meta data on box types (size, slots, rows, and columns).

6/4/2013 - wpg
	Adding to the application
MLS;
define('__script_log__', $__script_log__);
unset($__script_log__);
/**
 * @author w. Patrick Gale (June 2013)
 * @abstract List of types of sample boxes
*/
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/TypeOfBoxListFormBase.class.php');
QApplication::CheckRemoteAdmin();

class TypeOfBoxListForm8 extends TypeOfBoxListFormBase {
	protected function Form_Create() {
		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgTypeOfBox_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Name, false)));
		$this->colWidth = new QDataGridColumn(QApplication::Translate('Width'), '<?= $_ITEM->Width; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Width), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Width, false)));
		$this->colHeight = new QDataGridColumn(QApplication::Translate('Height'), '<?= $_ITEM->Height; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Height), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Height, false)));
		$this->colRows = new QDataGridColumn(QApplication::Translate('Rows'), '<?= $_ITEM->Rows; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Rows), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Rows, false)));
		$this->colColumns = new QDataGridColumn(QApplication::Translate('Columns'), '<?= $_ITEM->Columns; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Columns), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Columns, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Description, false)));

		// Setup DataGrid
		$this->dtgTypeOfBox = new QDataGrid($this);
		$this->dtgTypeOfBox->CellSpacing = 0;
		$this->dtgTypeOfBox->CellPadding = 4;
		$this->dtgTypeOfBox->BorderStyle = QBorderStyle::Solid;
		$this->dtgTypeOfBox->BorderWidth = 1;
		$this->dtgTypeOfBox->GridLines = QGridLines::Both;
		$this->dtgTypeOfBox->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgTypeOfBox->Paginator = new QPaginator($this->dtgTypeOfBox);
		$this->dtgTypeOfBox->ItemsPerPage = __ITEMS_PER_PAGE__;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgTypeOfBox->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgTypeOfBox->SetDataBinder('dtgTypeOfBox_Bind');

		$this->dtgTypeOfBox->AddColumn($this->colEditLinkColumn);
		$this->dtgTypeOfBox->AddColumn($this->colName);
		$this->dtgTypeOfBox->AddColumn($this->colWidth);
		$this->dtgTypeOfBox->AddColumn($this->colHeight);
		$this->dtgTypeOfBox->AddColumn($this->colRows);
		$this->dtgTypeOfBox->AddColumn($this->colColumns);
		$this->dtgTypeOfBox->AddColumn($this->colDescription);
	}

	public function dtgTypeOfBox_EditLinkColumn_Render(TypeOfBox $objTypeOfBox) {
		return sprintf('<a href="type_of_box.php?intId=%s">%s</a>',
				$objTypeOfBox->Id,
				QApplication::Translate('Edit'));
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('types_of_boxes');
?>