<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the SampleTypes class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of SampleTypes objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleTypesListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleTypesListFormBase extends QForm {
		protected $dtgSampleTypes;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colLetter;
		protected $colDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleTypes_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Id, false)));
			$this->colLetter = new QDataGridColumn(QApplication::Translate('Letter'), '<?= QString::Truncate($_ITEM->Letter, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Letter), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Letter, false)));
			$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Description, false)));

			// Setup DataGrid
			$this->dtgSampleTypes = new QDataGrid($this);
			$this->dtgSampleTypes->CellSpacing = 0;
			$this->dtgSampleTypes->CellPadding = 4;
			$this->dtgSampleTypes->BorderStyle = QBorderStyle::Solid;
			$this->dtgSampleTypes->BorderWidth = 1;
			$this->dtgSampleTypes->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgSampleTypes->Paginator = new QPaginator($this->dtgSampleTypes);
			$this->dtgSampleTypes->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgSampleTypes->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgSampleTypes->SetDataBinder('dtgSampleTypes_Bind');

			$this->dtgSampleTypes->AddColumn($this->colEditLinkColumn);
			$this->dtgSampleTypes->AddColumn($this->colId);
			$this->dtgSampleTypes->AddColumn($this->colLetter);
			$this->dtgSampleTypes->AddColumn($this->colDescription);
		}
		
		public function dtgSampleTypes_EditLinkColumn_Render(SampleTypes $objSampleTypes) {
			return sprintf('<a href="sample_types_edit.php?intId=%s">%s</a>',
				$objSampleTypes->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgSampleTypes_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgSampleTypes->TotalItemCount = SampleTypes::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgSampleTypes->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgSampleTypes->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all SampleTypes objects, given the clauses above
			$this->dtgSampleTypes->DataSource = SampleTypes::LoadAll($objClauses);
		}
	}
?>