<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the SampleRack class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of SampleRack objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleRackListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleRackListFormBase extends QForm {
		protected $dtgSampleRack;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colBoxCount;
		protected $colRackTypeId;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleRack_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleRack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleRack()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleRack()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleRack()->Name, false)));
			$this->colBoxCount = new QDataGridColumn(QApplication::Translate('Box Count'), '<?= $_ITEM->BoxCount; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleRack()->BoxCount), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleRack()->BoxCount, false)));
			$this->colRackTypeId = new QDataGridColumn(QApplication::Translate('Rack Type Id'), '<?= $_FORM->dtgSampleRack_RackType_Render($_ITEM); ?>');

			// Setup DataGrid
			$this->dtgSampleRack = new QDataGrid($this);
			$this->dtgSampleRack->CellSpacing = 0;
			$this->dtgSampleRack->CellPadding = 4;
			$this->dtgSampleRack->BorderStyle = QBorderStyle::Solid;
			$this->dtgSampleRack->BorderWidth = 1;
			$this->dtgSampleRack->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgSampleRack->Paginator = new QPaginator($this->dtgSampleRack);
			$this->dtgSampleRack->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgSampleRack->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgSampleRack->SetDataBinder('dtgSampleRack_Bind');

			$this->dtgSampleRack->AddColumn($this->colEditLinkColumn);
			$this->dtgSampleRack->AddColumn($this->colId);
			$this->dtgSampleRack->AddColumn($this->colName);
			$this->dtgSampleRack->AddColumn($this->colBoxCount);
			$this->dtgSampleRack->AddColumn($this->colRackTypeId);
		}
		
		public function dtgSampleRack_EditLinkColumn_Render(SampleRack $objSampleRack) {
			return sprintf('<a href="sample_rack_edit.php?intId=%s">%s</a>',
				$objSampleRack->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgSampleRack_RackType_Render(SampleRack $objSampleRack) {
			if (!is_null($objSampleRack->RackType))
				return $objSampleRack->RackType->__toString();
			else
				return null;
		}


		protected function dtgSampleRack_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgSampleRack->TotalItemCount = SampleRack::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgSampleRack->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgSampleRack->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all SampleRack objects, given the clauses above
			$this->dtgSampleRack->DataSource = SampleRack::LoadAll($objClauses);
		}
	}
?>