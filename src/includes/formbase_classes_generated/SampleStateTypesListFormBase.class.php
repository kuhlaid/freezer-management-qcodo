<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the SampleStateTypes class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of SampleStateTypes objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleStateTypesListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleStateTypesListFormBase extends QForm {
		protected $dtgSampleStateTypes;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleStateTypes_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleStateTypes()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleStateTypes()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleStateTypes()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleStateTypes()->Name, false)));

			// Setup DataGrid
			$this->dtgSampleStateTypes = new QDataGrid($this);
			$this->dtgSampleStateTypes->CellSpacing = 0;
			$this->dtgSampleStateTypes->CellPadding = 4;
			$this->dtgSampleStateTypes->BorderStyle = QBorderStyle::Solid;
			$this->dtgSampleStateTypes->BorderWidth = 1;
			$this->dtgSampleStateTypes->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgSampleStateTypes->Paginator = new QPaginator($this->dtgSampleStateTypes);
			$this->dtgSampleStateTypes->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgSampleStateTypes->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgSampleStateTypes->SetDataBinder('dtgSampleStateTypes_Bind');

			$this->dtgSampleStateTypes->AddColumn($this->colEditLinkColumn);
			$this->dtgSampleStateTypes->AddColumn($this->colId);
			$this->dtgSampleStateTypes->AddColumn($this->colName);
		}
		
		public function dtgSampleStateTypes_EditLinkColumn_Render(SampleStateTypes $objSampleStateTypes) {
			return sprintf('<a href="sample_state_types_edit.php?intId=%s">%s</a>',
				$objSampleStateTypes->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgSampleStateTypes_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgSampleStateTypes->TotalItemCount = SampleStateTypes::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgSampleStateTypes->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgSampleStateTypes->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all SampleStateTypes objects, given the clauses above
			$this->dtgSampleStateTypes->DataSource = SampleStateTypes::LoadAll($objClauses);
		}
	}
?>