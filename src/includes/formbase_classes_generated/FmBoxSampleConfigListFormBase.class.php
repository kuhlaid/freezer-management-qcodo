<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the FmBoxSampleConfig class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of FmBoxSampleConfig objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FmBoxSampleConfigListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FmBoxSampleConfigListFormBase extends QForm {
		protected $dtgFmBoxSampleConfig;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colConfig;
		protected $colDescription;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFmBoxSampleConfig_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Id, false)));
			$this->colConfig = new QDataGridColumn(QApplication::Translate('Config'), '<?= QString::Truncate($_ITEM->Config, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Config), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Config, false)));
			$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Description, false)));

			// Setup DataGrid
			$this->dtgFmBoxSampleConfig = new QDataGrid($this);
			$this->dtgFmBoxSampleConfig->CellSpacing = 0;
			$this->dtgFmBoxSampleConfig->CellPadding = 4;
			$this->dtgFmBoxSampleConfig->BorderStyle = QBorderStyle::Solid;
			$this->dtgFmBoxSampleConfig->BorderWidth = 1;
			$this->dtgFmBoxSampleConfig->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgFmBoxSampleConfig->Paginator = new QPaginator($this->dtgFmBoxSampleConfig);
			$this->dtgFmBoxSampleConfig->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgFmBoxSampleConfig->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgFmBoxSampleConfig->SetDataBinder('dtgFmBoxSampleConfig_Bind');

			$this->dtgFmBoxSampleConfig->AddColumn($this->colEditLinkColumn);
			$this->dtgFmBoxSampleConfig->AddColumn($this->colId);
			$this->dtgFmBoxSampleConfig->AddColumn($this->colConfig);
			$this->dtgFmBoxSampleConfig->AddColumn($this->colDescription);
		}
		
		public function dtgFmBoxSampleConfig_EditLinkColumn_Render(FmBoxSampleConfig $objFmBoxSampleConfig) {
			return sprintf('<a href="fm_box_sample_config_edit.php?intId=%s">%s</a>',
				$objFmBoxSampleConfig->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgFmBoxSampleConfig_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgFmBoxSampleConfig->TotalItemCount = FmBoxSampleConfig::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgFmBoxSampleConfig->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgFmBoxSampleConfig->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all FmBoxSampleConfig objects, given the clauses above
			$this->dtgFmBoxSampleConfig->DataSource = FmBoxSampleConfig::LoadAll($objClauses);
		}
	}
?>