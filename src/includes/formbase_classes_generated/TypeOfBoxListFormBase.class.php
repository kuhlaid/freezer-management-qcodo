<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the TypeOfBox class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of TypeOfBox objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this TypeOfBoxListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class TypeOfBoxListFormBase extends QForm {
		protected $dtgTypeOfBox;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colWidth;
		protected $colHeight;
		protected $colRows;
		protected $colColumns;
		protected $colDescription;


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

			// Datagrid Paginator
			$this->dtgTypeOfBox->Paginator = new QPaginator($this->dtgTypeOfBox);
			$this->dtgTypeOfBox->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgTypeOfBox->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgTypeOfBox->SetDataBinder('dtgTypeOfBox_Bind');

			$this->dtgTypeOfBox->AddColumn($this->colEditLinkColumn);
			$this->dtgTypeOfBox->AddColumn($this->colId);
			$this->dtgTypeOfBox->AddColumn($this->colName);
			$this->dtgTypeOfBox->AddColumn($this->colWidth);
			$this->dtgTypeOfBox->AddColumn($this->colHeight);
			$this->dtgTypeOfBox->AddColumn($this->colRows);
			$this->dtgTypeOfBox->AddColumn($this->colColumns);
			$this->dtgTypeOfBox->AddColumn($this->colDescription);
		}
		
		public function dtgTypeOfBox_EditLinkColumn_Render(TypeOfBox $objTypeOfBox) {
			return sprintf('<a href="type_of_box_edit.php?intId=%s">%s</a>',
				$objTypeOfBox->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgTypeOfBox_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgTypeOfBox->TotalItemCount = TypeOfBox::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgTypeOfBox->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgTypeOfBox->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all TypeOfBox objects, given the clauses above
			$this->dtgTypeOfBox->DataSource = TypeOfBox::LoadAll($objClauses);
		}
	}
?>