<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Rack class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Rack objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this RackListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class RackListFormBase extends QForm {
		protected $dtgRack;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colRackTypeId;
		protected $colNotes;
		protected $colShelf;
		protected $colFreezer;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgRack_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Name, false)));
			$this->colRackTypeId = new QDataGridColumn(QApplication::Translate('Rack Type Id'), '<?= $_FORM->dtgRack_RackType_Render($_ITEM); ?>');
			$this->colNotes = new QDataGridColumn(QApplication::Translate('Notes'), '<?= QString::Truncate($_ITEM->Notes, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Notes), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Notes, false)));
			$this->colShelf = new QDataGridColumn(QApplication::Translate('Shelf'), '<?= $_ITEM->Shelf; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Shelf), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Shelf, false)));
			$this->colFreezer = new QDataGridColumn(QApplication::Translate('Freezer'), '<?= $_ITEM->Freezer; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Freezer), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Freezer, false)));

			// Setup DataGrid
			$this->dtgRack = new QDataGrid($this);
			$this->dtgRack->CellSpacing = 0;
			$this->dtgRack->CellPadding = 4;
			$this->dtgRack->BorderStyle = QBorderStyle::Solid;
			$this->dtgRack->BorderWidth = 1;
			$this->dtgRack->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRack->Paginator = new QPaginator($this->dtgRack);
			$this->dtgRack->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRack->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgRack->SetDataBinder('dtgRack_Bind');

			$this->dtgRack->AddColumn($this->colEditLinkColumn);
			$this->dtgRack->AddColumn($this->colId);
			$this->dtgRack->AddColumn($this->colName);
			$this->dtgRack->AddColumn($this->colRackTypeId);
			$this->dtgRack->AddColumn($this->colNotes);
			$this->dtgRack->AddColumn($this->colShelf);
			$this->dtgRack->AddColumn($this->colFreezer);
		}
		
		public function dtgRack_EditLinkColumn_Render(Rack $objRack) {
			return sprintf('<a href="rack_edit.php?intId=%s">%s</a>',
				$objRack->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgRack_RackType_Render(Rack $objRack) {
			if (!is_null($objRack->RackType))
				return $objRack->RackType->__toString();
			else
				return null;
		}


		protected function dtgRack_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgRack->TotalItemCount = Rack::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgRack->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgRack->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Rack objects, given the clauses above
			$this->dtgRack->DataSource = Rack::LoadAll($objClauses);
		}
	}
?>