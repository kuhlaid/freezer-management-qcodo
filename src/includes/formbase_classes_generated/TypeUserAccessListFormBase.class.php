<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the TypeUserAccess class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of TypeUserAccess objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this TypeUserAccessListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class TypeUserAccessListFormBase extends QForm {
		protected $dtgTypeUserAccess;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgTypeUserAccess_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Name, false)));
			$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Description, false)));

			// Setup DataGrid
			$this->dtgTypeUserAccess = new QDataGrid($this);
			$this->dtgTypeUserAccess->CellSpacing = 0;
			$this->dtgTypeUserAccess->CellPadding = 4;
			$this->dtgTypeUserAccess->BorderStyle = QBorderStyle::Solid;
			$this->dtgTypeUserAccess->BorderWidth = 1;
			$this->dtgTypeUserAccess->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgTypeUserAccess->Paginator = new QPaginator($this->dtgTypeUserAccess);
			$this->dtgTypeUserAccess->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgTypeUserAccess->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgTypeUserAccess->SetDataBinder('dtgTypeUserAccess_Bind');

			$this->dtgTypeUserAccess->AddColumn($this->colEditLinkColumn);
			$this->dtgTypeUserAccess->AddColumn($this->colId);
			$this->dtgTypeUserAccess->AddColumn($this->colName);
			$this->dtgTypeUserAccess->AddColumn($this->colDescription);
		}
		
		public function dtgTypeUserAccess_EditLinkColumn_Render(TypeUserAccess $objTypeUserAccess) {
			return sprintf('<a href="type_user_access_edit.php?intId=%s">%s</a>',
				$objTypeUserAccess->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgTypeUserAccess_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgTypeUserAccess->TotalItemCount = TypeUserAccess::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgTypeUserAccess->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgTypeUserAccess->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all TypeUserAccess objects, given the clauses above
			$this->dtgTypeUserAccess->DataSource = TypeUserAccess::LoadAll($objClauses);
		}
	}
?>