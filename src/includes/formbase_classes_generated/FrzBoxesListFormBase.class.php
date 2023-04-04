<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the FrzBoxes class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of FrzBoxes objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FrzBoxesListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FrzBoxesListFormBase extends QForm {
		protected $dtgFrzBoxes;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colBoxid;
		protected $colRack;
		protected $colShelf;
		protected $colFreezer;
		protected $colId;
		protected $colIssues;
		protected $colDescription;
		protected $colBoxTypeId;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFrzBoxes_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colBoxid = new QDataGridColumn(QApplication::Translate('Boxid'), '<?= QString::Truncate($_ITEM->Boxid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Boxid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Boxid, false)));
			$this->colRack = new QDataGridColumn(QApplication::Translate('Rack'), '<?= QString::Truncate($_ITEM->Rack, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Rack), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Rack, false)));
			$this->colShelf = new QDataGridColumn(QApplication::Translate('Shelf'), '<?= $_ITEM->Shelf; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Shelf), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Shelf, false)));
			$this->colFreezer = new QDataGridColumn(QApplication::Translate('Freezer'), '<?= $_ITEM->Freezer; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Freezer), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Freezer, false)));
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Id, false)));
			$this->colIssues = new QDataGridColumn(QApplication::Translate('Issues'), '<?= QString::Truncate($_ITEM->Issues, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Issues), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Issues, false)));
			$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Description, false)));
			$this->colBoxTypeId = new QDataGridColumn(QApplication::Translate('Box Type Id'), '<?= $_ITEM->BoxTypeId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->BoxTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->BoxTypeId, false)));

			// Setup DataGrid
			$this->dtgFrzBoxes = new QDataGrid($this);
			$this->dtgFrzBoxes->CellSpacing = 0;
			$this->dtgFrzBoxes->CellPadding = 4;
			$this->dtgFrzBoxes->BorderStyle = QBorderStyle::Solid;
			$this->dtgFrzBoxes->BorderWidth = 1;
			$this->dtgFrzBoxes->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgFrzBoxes->Paginator = new QPaginator($this->dtgFrzBoxes);
			$this->dtgFrzBoxes->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgFrzBoxes->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgFrzBoxes->SetDataBinder('dtgFrzBoxes_Bind');

			$this->dtgFrzBoxes->AddColumn($this->colEditLinkColumn);
			$this->dtgFrzBoxes->AddColumn($this->colBoxid);
			$this->dtgFrzBoxes->AddColumn($this->colRack);
			$this->dtgFrzBoxes->AddColumn($this->colShelf);
			$this->dtgFrzBoxes->AddColumn($this->colFreezer);
			$this->dtgFrzBoxes->AddColumn($this->colId);
			$this->dtgFrzBoxes->AddColumn($this->colIssues);
			$this->dtgFrzBoxes->AddColumn($this->colDescription);
			$this->dtgFrzBoxes->AddColumn($this->colBoxTypeId);
		}
		
		public function dtgFrzBoxes_EditLinkColumn_Render(FrzBoxes $objFrzBoxes) {
			return sprintf('<a href="frz_boxes_edit.php?intId=%s">%s</a>',
				$objFrzBoxes->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgFrzBoxes_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgFrzBoxes->TotalItemCount = FrzBoxes::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgFrzBoxes->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgFrzBoxes->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all FrzBoxes objects, given the clauses above
			$this->dtgFrzBoxes->DataSource = FrzBoxes::LoadAll($objClauses);
		}
	}
?>