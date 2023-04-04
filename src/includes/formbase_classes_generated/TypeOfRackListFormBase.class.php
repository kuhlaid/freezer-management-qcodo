<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the TypeOfRack class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of TypeOfRack objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this TypeOfRackListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class TypeOfRackListFormBase extends QForm {
		protected $dtgTypeOfRack;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colWidth;
		protected $colHeight;
		protected $colDepth;
		protected $colRows;
		protected $colColumns;
		protected $colBoxCount;
		protected $colBoxType;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgTypeOfRack_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Name, false)));
			$this->colWidth = new QDataGridColumn(QApplication::Translate('Width'), '<?= $_ITEM->Width; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Width), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Width, false)));
			$this->colHeight = new QDataGridColumn(QApplication::Translate('Height'), '<?= $_ITEM->Height; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Height), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Height, false)));
			$this->colDepth = new QDataGridColumn(QApplication::Translate('Depth'), '<?= $_ITEM->Depth; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Depth), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Depth, false)));
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

			// Datagrid Paginator
			$this->dtgTypeOfRack->Paginator = new QPaginator($this->dtgTypeOfRack);
			$this->dtgTypeOfRack->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgTypeOfRack->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgTypeOfRack->SetDataBinder('dtgTypeOfRack_Bind');

			$this->dtgTypeOfRack->AddColumn($this->colEditLinkColumn);
			$this->dtgTypeOfRack->AddColumn($this->colId);
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
			return sprintf('<a href="type_of_rack_edit.php?intId=%s">%s</a>',
				$objTypeOfRack->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgTypeOfRack_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgTypeOfRack->TotalItemCount = TypeOfRack::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgTypeOfRack->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgTypeOfRack->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all TypeOfRack objects, given the clauses above
			$this->dtgTypeOfRack->DataSource = TypeOfRack::LoadAll($objClauses);
		}
	}
?>