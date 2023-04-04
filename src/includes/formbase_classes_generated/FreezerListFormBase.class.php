<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Freezer class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Freezer objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FreezerListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FreezerListFormBase extends QForm {
		protected $dtgFreezer;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colDescription;
		protected $colInUseSince;
		protected $colLocation;
		protected $colNShelves;
		protected $colShelfCuIn;
		protected $colShelfDepthIn;
		protected $colShelfWidthIn;
		protected $colShelfHeightIn;
		protected $colFreezerType;
		protected $colModelNumber;
		protected $colAssetNumber;
		protected $colAlarmAccount;
		protected $colSerialNumber;
		protected $colInUse;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFreezer_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Name, false)));
			$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Description, false)));
			$this->colInUseSince = new QDataGridColumn(QApplication::Translate('In Use Since'), '<?= QString::Truncate($_ITEM->InUseSince, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->InUseSince), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->InUseSince, false)));
			$this->colLocation = new QDataGridColumn(QApplication::Translate('Location'), '<?= QString::Truncate($_ITEM->Location, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->Location), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->Location, false)));
			$this->colNShelves = new QDataGridColumn(QApplication::Translate('N Shelves'), '<?= $_ITEM->NShelves; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->NShelves), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->NShelves, false)));
			$this->colShelfCuIn = new QDataGridColumn(QApplication::Translate('Shelf Cu In'), '<?= $_ITEM->ShelfCuIn; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfCuIn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfCuIn, false)));
			$this->colShelfDepthIn = new QDataGridColumn(QApplication::Translate('Shelf Depth In'), '<?= $_ITEM->ShelfDepthIn; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfDepthIn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfDepthIn, false)));
			$this->colShelfWidthIn = new QDataGridColumn(QApplication::Translate('Shelf Width In'), '<?= $_ITEM->ShelfWidthIn; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfWidthIn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfWidthIn, false)));
			$this->colShelfHeightIn = new QDataGridColumn(QApplication::Translate('Shelf Height In'), '<?= $_ITEM->ShelfHeightIn; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfHeightIn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ShelfHeightIn, false)));
			$this->colFreezerType = new QDataGridColumn(QApplication::Translate('Freezer Type'), '<?= QString::Truncate($_ITEM->FreezerType, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->FreezerType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->FreezerType, false)));
			$this->colModelNumber = new QDataGridColumn(QApplication::Translate('Model Number'), '<?= QString::Truncate($_ITEM->ModelNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->ModelNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->ModelNumber, false)));
			$this->colAssetNumber = new QDataGridColumn(QApplication::Translate('Asset Number'), '<?= QString::Truncate($_ITEM->AssetNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->AssetNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->AssetNumber, false)));
			$this->colAlarmAccount = new QDataGridColumn(QApplication::Translate('Alarm Account'), '<?= QString::Truncate($_ITEM->AlarmAccount, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->AlarmAccount), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->AlarmAccount, false)));
			$this->colSerialNumber = new QDataGridColumn(QApplication::Translate('Serial Number'), '<?= QString::Truncate($_ITEM->SerialNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->SerialNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->SerialNumber, false)));
			$this->colInUse = new QDataGridColumn(QApplication::Translate('In Use'), '<?= $_ITEM->InUse; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Freezer()->InUse), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Freezer()->InUse, false)));

			// Setup DataGrid
			$this->dtgFreezer = new QDataGrid($this);
			$this->dtgFreezer->CellSpacing = 0;
			$this->dtgFreezer->CellPadding = 4;
			$this->dtgFreezer->BorderStyle = QBorderStyle::Solid;
			$this->dtgFreezer->BorderWidth = 1;
			$this->dtgFreezer->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgFreezer->Paginator = new QPaginator($this->dtgFreezer);
			$this->dtgFreezer->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgFreezer->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgFreezer->SetDataBinder('dtgFreezer_Bind');

			$this->dtgFreezer->AddColumn($this->colEditLinkColumn);
			$this->dtgFreezer->AddColumn($this->colId);
			$this->dtgFreezer->AddColumn($this->colName);
			$this->dtgFreezer->AddColumn($this->colDescription);
			$this->dtgFreezer->AddColumn($this->colInUseSince);
			$this->dtgFreezer->AddColumn($this->colLocation);
			$this->dtgFreezer->AddColumn($this->colNShelves);
			$this->dtgFreezer->AddColumn($this->colShelfCuIn);
			$this->dtgFreezer->AddColumn($this->colShelfDepthIn);
			$this->dtgFreezer->AddColumn($this->colShelfWidthIn);
			$this->dtgFreezer->AddColumn($this->colShelfHeightIn);
			$this->dtgFreezer->AddColumn($this->colFreezerType);
			$this->dtgFreezer->AddColumn($this->colModelNumber);
			$this->dtgFreezer->AddColumn($this->colAssetNumber);
			$this->dtgFreezer->AddColumn($this->colAlarmAccount);
			$this->dtgFreezer->AddColumn($this->colSerialNumber);
			$this->dtgFreezer->AddColumn($this->colInUse);
		}
		
		public function dtgFreezer_EditLinkColumn_Render(Freezer $objFreezer) {
			return sprintf('<a href="freezer_edit.php?intId=%s">%s</a>',
				$objFreezer->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgFreezer_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgFreezer->TotalItemCount = Freezer::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgFreezer->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgFreezer->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Freezer objects, given the clauses above
			$this->dtgFreezer->DataSource = Freezer::LoadAll($objClauses);
		}
	}
?>