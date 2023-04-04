<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the FmStudy class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of FmStudy objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FmStudyListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FmStudyListFormBase extends QForm {
		protected $dtgFmStudy;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFmStudy_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmStudy()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmStudy()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmStudy()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmStudy()->Name, false)));

			// Setup DataGrid
			$this->dtgFmStudy = new QDataGrid($this);
			$this->dtgFmStudy->CellSpacing = 0;
			$this->dtgFmStudy->CellPadding = 4;
			$this->dtgFmStudy->BorderStyle = QBorderStyle::Solid;
			$this->dtgFmStudy->BorderWidth = 1;
			$this->dtgFmStudy->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgFmStudy->Paginator = new QPaginator($this->dtgFmStudy);
			$this->dtgFmStudy->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgFmStudy->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgFmStudy->SetDataBinder('dtgFmStudy_Bind');

			$this->dtgFmStudy->AddColumn($this->colEditLinkColumn);
			$this->dtgFmStudy->AddColumn($this->colId);
			$this->dtgFmStudy->AddColumn($this->colName);
		}
		
		public function dtgFmStudy_EditLinkColumn_Render(FmStudy $objFmStudy) {
			return sprintf('<a href="fm_study_edit.php?intId=%s">%s</a>',
				$objFmStudy->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgFmStudy_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgFmStudy->TotalItemCount = FmStudy::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgFmStudy->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgFmStudy->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all FmStudy objects, given the clauses above
			$this->dtgFmStudy->DataSource = FmStudy::LoadAll($objClauses);
		}
	}
?>