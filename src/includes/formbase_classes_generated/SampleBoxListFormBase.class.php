<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the SampleBox class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of SampleBox objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleBoxListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleBoxListFormBase extends QForm {
		protected $dtgSampleBox;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleBox_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleBox()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleBox()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleBox()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleBox()->Name, false)));

			// Setup DataGrid
			$this->dtgSampleBox = new QDataGrid($this);
			$this->dtgSampleBox->CellSpacing = 0;
			$this->dtgSampleBox->CellPadding = 4;
			$this->dtgSampleBox->BorderStyle = QBorderStyle::Solid;
			$this->dtgSampleBox->BorderWidth = 1;
			$this->dtgSampleBox->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgSampleBox->Paginator = new QPaginator($this->dtgSampleBox);
			$this->dtgSampleBox->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgSampleBox->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgSampleBox->SetDataBinder('dtgSampleBox_Bind');

			$this->dtgSampleBox->AddColumn($this->colEditLinkColumn);
			$this->dtgSampleBox->AddColumn($this->colId);
			$this->dtgSampleBox->AddColumn($this->colName);
		}
		
		public function dtgSampleBox_EditLinkColumn_Render(SampleBox $objSampleBox) {
			return sprintf('<a href="sample_box_edit.php?intId=%s">%s</a>',
				$objSampleBox->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgSampleBox_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgSampleBox->TotalItemCount = SampleBox::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgSampleBox->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgSampleBox->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all SampleBox objects, given the clauses above
			$this->dtgSampleBox->DataSource = SampleBox::LoadAll($objClauses);
		}
	}
?>