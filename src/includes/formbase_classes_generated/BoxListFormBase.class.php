<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Box class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Box objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this BoxListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class BoxListFormBase extends QForm {
		protected $dtgBox;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colName;
		protected $colRackId;
		protected $colShelf;
		protected $colFreezer;
		protected $colId;
		protected $colIssues;
		protected $colDescription;
		protected $colBoxTypeId;
		protected $colSampleTypeId;
		protected $colCreated;
		protected $colPreparedById;
		protected $colComplete;
		protected $colClinicShipmentId;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgBox_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Name, false)));
			$this->colRackId = new QDataGridColumn(QApplication::Translate('Rack Id'), '<?= $_FORM->dtgBox_Rack_Render($_ITEM); ?>');
			$this->colShelf = new QDataGridColumn(QApplication::Translate('Shelf'), '<?= $_ITEM->Shelf; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Shelf), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Shelf, false)));
			$this->colFreezer = new QDataGridColumn(QApplication::Translate('Freezer'), '<?= $_ITEM->Freezer; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Freezer), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Freezer, false)));
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Id, false)));
			$this->colIssues = new QDataGridColumn(QApplication::Translate('Issues'), '<?= QString::Truncate($_ITEM->Issues, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Issues), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Issues, false)));
			$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Description, false)));
			$this->colBoxTypeId = new QDataGridColumn(QApplication::Translate('Box Type Id'), '<?= $_FORM->dtgBox_BoxType_Render($_ITEM); ?>');
			$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type Id'), '<?= $_FORM->dtgBox_SampleType_Render($_ITEM); ?>');
			$this->colCreated = new QDataGridColumn(QApplication::Translate('Created'), '<?= $_FORM->dtgBox_Created_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Created), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Created, false)));
			$this->colPreparedById = new QDataGridColumn(QApplication::Translate('Prepared By Id'), '<?= $_ITEM->PreparedById; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->PreparedById), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->PreparedById, false)));
			$this->colComplete = new QDataGridColumn(QApplication::Translate('Complete'), '<?= ($_ITEM->Complete) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Complete), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Complete, false)));
			$this->colClinicShipmentId = new QDataGridColumn(QApplication::Translate('Clinic Shipment Id'), '<?= $_FORM->dtgBox_ClinicShipment_Render($_ITEM); ?>');

			// Setup DataGrid
			$this->dtgBox = new QDataGrid($this);
			$this->dtgBox->CellSpacing = 0;
			$this->dtgBox->CellPadding = 4;
			$this->dtgBox->BorderStyle = QBorderStyle::Solid;
			$this->dtgBox->BorderWidth = 1;
			$this->dtgBox->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgBox->Paginator = new QPaginator($this->dtgBox);
			$this->dtgBox->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgBox->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgBox->SetDataBinder('dtgBox_Bind');

			$this->dtgBox->AddColumn($this->colEditLinkColumn);
			$this->dtgBox->AddColumn($this->colName);
			$this->dtgBox->AddColumn($this->colRackId);
			$this->dtgBox->AddColumn($this->colShelf);
			$this->dtgBox->AddColumn($this->colFreezer);
			$this->dtgBox->AddColumn($this->colId);
			$this->dtgBox->AddColumn($this->colIssues);
			$this->dtgBox->AddColumn($this->colDescription);
			$this->dtgBox->AddColumn($this->colBoxTypeId);
			$this->dtgBox->AddColumn($this->colSampleTypeId);
			$this->dtgBox->AddColumn($this->colCreated);
			$this->dtgBox->AddColumn($this->colPreparedById);
			$this->dtgBox->AddColumn($this->colComplete);
			$this->dtgBox->AddColumn($this->colClinicShipmentId);
		}
		
		public function dtgBox_EditLinkColumn_Render(Box $objBox) {
			return sprintf('<a href="box_edit.php?intId=%s">%s</a>',
				$objBox->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgBox_Rack_Render(Box $objBox) {
			if (!is_null($objBox->Rack))
				return $objBox->Rack->__toString();
			else
				return null;
		}

		public function dtgBox_BoxType_Render(Box $objBox) {
			if (!is_null($objBox->BoxType))
				return $objBox->BoxType->__toString();
			else
				return null;
		}

		public function dtgBox_SampleType_Render(Box $objBox) {
			if (!is_null($objBox->SampleType))
				return $objBox->SampleType->__toString();
			else
				return null;
		}

		public function dtgBox_Created_Render(Box $objBox) {
			if (!is_null($objBox->Created))
				return $objBox->Created->toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgBox_ClinicShipment_Render(Box $objBox) {
			if (!is_null($objBox->ClinicShipment))
				return $objBox->ClinicShipment->__toString();
			else
				return null;
		}


		protected function dtgBox_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgBox->TotalItemCount = Box::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgBox->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgBox->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Box objects, given the clauses above
			$this->dtgBox->DataSource = Box::LoadAll($objClauses);
		}
	}
?>