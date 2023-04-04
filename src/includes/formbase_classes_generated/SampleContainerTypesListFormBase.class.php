<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the SampleContainerTypes class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of SampleContainerTypes objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleContainerTypesListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleContainerTypesListFormBase extends QForm {
		protected $dtgSampleContainerTypes;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleContainerTypes_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleContainerTypes()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleContainerTypes()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleContainerTypes()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleContainerTypes()->Name, false)));
			$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleContainerTypes()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleContainerTypes()->Description, false)));

			// Setup DataGrid
			$this->dtgSampleContainerTypes = new QDataGrid($this);
			$this->dtgSampleContainerTypes->CellSpacing = 0;
			$this->dtgSampleContainerTypes->CellPadding = 4;
			$this->dtgSampleContainerTypes->BorderStyle = QBorderStyle::Solid;
			$this->dtgSampleContainerTypes->BorderWidth = 1;
			$this->dtgSampleContainerTypes->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgSampleContainerTypes->Paginator = new QPaginator($this->dtgSampleContainerTypes);
			$this->dtgSampleContainerTypes->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgSampleContainerTypes->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgSampleContainerTypes->SetDataBinder('dtgSampleContainerTypes_Bind');

			$this->dtgSampleContainerTypes->AddColumn($this->colEditLinkColumn);
			$this->dtgSampleContainerTypes->AddColumn($this->colId);
			$this->dtgSampleContainerTypes->AddColumn($this->colName);
			$this->dtgSampleContainerTypes->AddColumn($this->colDescription);
		}
		
		public function dtgSampleContainerTypes_EditLinkColumn_Render(SampleContainerTypes $objSampleContainerTypes) {
			return sprintf('<a href="sample_container_types_edit.php?intId=%s">%s</a>',
				$objSampleContainerTypes->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgSampleContainerTypes_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgSampleContainerTypes->TotalItemCount = SampleContainerTypes::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgSampleContainerTypes->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgSampleContainerTypes->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all SampleContainerTypes objects, given the clauses above
			$this->dtgSampleContainerTypes->DataSource = SampleContainerTypes::LoadAll($objClauses);
		}
	}
?>