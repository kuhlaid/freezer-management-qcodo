<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the BoxSampleSlot class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of BoxSampleSlot objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this BoxSampleSlotListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class BoxSampleSlotListFormBase extends QForm {
		protected $dtgBoxSampleSlot;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colSlotName;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgBoxSampleSlot_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxSampleSlot()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxSampleSlot()->Id, false)));
			$this->colSlotName = new QDataGridColumn(QApplication::Translate('Slot Name'), '<?= QString::Truncate($_ITEM->SlotName, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxSampleSlot()->SlotName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxSampleSlot()->SlotName, false)));

			// Setup DataGrid
			$this->dtgBoxSampleSlot = new QDataGrid($this);
			$this->dtgBoxSampleSlot->CellSpacing = 0;
			$this->dtgBoxSampleSlot->CellPadding = 4;
			$this->dtgBoxSampleSlot->BorderStyle = QBorderStyle::Solid;
			$this->dtgBoxSampleSlot->BorderWidth = 1;
			$this->dtgBoxSampleSlot->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgBoxSampleSlot->Paginator = new QPaginator($this->dtgBoxSampleSlot);
			$this->dtgBoxSampleSlot->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgBoxSampleSlot->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgBoxSampleSlot->SetDataBinder('dtgBoxSampleSlot_Bind');

			$this->dtgBoxSampleSlot->AddColumn($this->colEditLinkColumn);
			$this->dtgBoxSampleSlot->AddColumn($this->colId);
			$this->dtgBoxSampleSlot->AddColumn($this->colSlotName);
		}
		
		public function dtgBoxSampleSlot_EditLinkColumn_Render(BoxSampleSlot $objBoxSampleSlot) {
			return sprintf('<a href="box_sample_slot_edit.php?intId=%s">%s</a>',
				$objBoxSampleSlot->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgBoxSampleSlot_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgBoxSampleSlot->TotalItemCount = BoxSampleSlot::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgBoxSampleSlot->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgBoxSampleSlot->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all BoxSampleSlot objects, given the clauses above
			$this->dtgBoxSampleSlot->DataSource = BoxSampleSlot::LoadAll($objClauses);
		}
	}
?>