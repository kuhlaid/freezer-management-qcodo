<?php
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/TypeOfRackListFormBase.class.php');
QApplication::CheckRemoteAdmin();

class TypeOfRackListForm extends TypeOfRackListFormBase {
	protected function Form_Create() {
		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgTypeOfRack_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Name, false)));
		$this->colWidth = new QDataGridColumn(QApplication::Translate('Width (in.)'), '<?= $_ITEM->Width ? $_ITEM->Width.\'"\' : ""; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Width), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Width, false)));
		$this->colHeight = new QDataGridColumn(QApplication::Translate('Height (in.)'), '<?= $_ITEM->Height ? $_ITEM->Height.\'"\' : ""; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Height), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Height, false)));
		$this->colDepth = new QDataGridColumn(QApplication::Translate('Depth (in.)'), '<?= $_ITEM->Depth ? $_ITEM->Depth.\'"\' : ""; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Depth), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Depth, false)));
		$this->colRows = new QDataGridColumn(QApplication::Translate('Rows'), '<?= $_ITEM->Rows; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Rows), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Rows, false)));
		$this->colColumns = new QDataGridColumn(QApplication::Translate('Columns'), '<?= $_ITEM->Columns; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Columns), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Columns, false)));
		$this->colBoxCount = new QDataGridColumn(QApplication::Translate('Box Count'), '<?= $_ITEM->BoxCount; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->BoxCount), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->BoxCount, false)));
		$this->colBoxType = new QDataGridColumn(QApplication::Translate('Box Type'), '<?= $_ITEM->BoxType; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->BoxType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->BoxType, false)));

		// Setup DataGrid
		$this->dtgTypeOfRack = new QDataGrid($this);
		$this->dtgTypeOfRack->CellSpacing = 0;
		$this->dtgTypeOfRack->CellPadding = 4;
		$this->dtgTypeOfRack->BorderStyle = QBorderStyle::Solid;
		$this->dtgTypeOfRack->BorderWidth = 1;
		$this->dtgTypeOfRack->GridLines = QGridLines::Both;
		$this->dtgTypeOfRack->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgTypeOfRack->Paginator = new QPaginator($this->dtgTypeOfRack);
		$this->dtgTypeOfRack->ItemsPerPage = __ITEMS_PER_PAGE__;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgTypeOfRack->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgTypeOfRack->SetDataBinder('dtgTypeOfRack_Bind');

		$this->dtgTypeOfRack->AddColumn($this->colEditLinkColumn);
		$this->dtgTypeOfRack->AddColumn($this->colName);
		$this->dtgTypeOfRack->AddColumn($this->colWidth);
		$this->dtgTypeOfRack->AddColumn($this->colHeight);
		$this->dtgTypeOfRack->AddColumn($this->colDepth);
		$this->dtgTypeOfRack->AddColumn($this->colRows);
		$this->dtgTypeOfRack->AddColumn($this->colColumns);
		$this->dtgTypeOfRack->AddColumn($this->colBoxCount);
		$this->dtgTypeOfRack->AddColumn($this->colBoxType);
	}

	public function dtgTypeOfRack_EditLinkColumn_Render(TypeOfRack $objTypeOfRack) {
		return sprintf('<a href="type_of_rack.php?intId=%s">%s</a>',
				$objTypeOfRack->Id,
				QApplication::Translate('Edit'));
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('types_of_rack');
?>