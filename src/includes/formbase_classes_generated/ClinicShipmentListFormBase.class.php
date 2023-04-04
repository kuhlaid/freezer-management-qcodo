<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the ClinicShipment class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of ClinicShipment objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ClinicShipmentListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ClinicShipmentListFormBase extends QForm {
		protected $dtgClinicShipment;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colShipTime;
		protected $colPreparedBy;
		protected $colTrackingNumber;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgClinicShipment_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->Id, false)));
			$this->colShipTime = new QDataGridColumn(QApplication::Translate('Ship Time'), '<?= $_FORM->dtgClinicShipment_ShipTime_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->ShipTime), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->ShipTime, false)));
			$this->colPreparedBy = new QDataGridColumn(QApplication::Translate('Prepared By'), '<?= $_ITEM->PreparedBy; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->PreparedBy), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->PreparedBy, false)));
			$this->colTrackingNumber = new QDataGridColumn(QApplication::Translate('Tracking Number'), '<?= QString::Truncate($_ITEM->TrackingNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->TrackingNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->TrackingNumber, false)));

			// Setup DataGrid
			$this->dtgClinicShipment = new QDataGrid($this);
			$this->dtgClinicShipment->CellSpacing = 0;
			$this->dtgClinicShipment->CellPadding = 4;
			$this->dtgClinicShipment->BorderStyle = QBorderStyle::Solid;
			$this->dtgClinicShipment->BorderWidth = 1;
			$this->dtgClinicShipment->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgClinicShipment->Paginator = new QPaginator($this->dtgClinicShipment);
			$this->dtgClinicShipment->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgClinicShipment->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgClinicShipment->SetDataBinder('dtgClinicShipment_Bind');

			$this->dtgClinicShipment->AddColumn($this->colEditLinkColumn);
			$this->dtgClinicShipment->AddColumn($this->colId);
			$this->dtgClinicShipment->AddColumn($this->colShipTime);
			$this->dtgClinicShipment->AddColumn($this->colPreparedBy);
			$this->dtgClinicShipment->AddColumn($this->colTrackingNumber);
		}
		
		public function dtgClinicShipment_EditLinkColumn_Render(ClinicShipment $objClinicShipment) {
			return sprintf('<a href="clinic_shipment_edit.php?intId=%s">%s</a>',
				$objClinicShipment->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgClinicShipment_ShipTime_Render(ClinicShipment $objClinicShipment) {
			if (!is_null($objClinicShipment->ShipTime))
				return $objClinicShipment->ShipTime->toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}


		protected function dtgClinicShipment_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgClinicShipment->TotalItemCount = ClinicShipment::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgClinicShipment->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgClinicShipment->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all ClinicShipment objects, given the clauses above
			$this->dtgClinicShipment->DataSource = ClinicShipment::LoadAll($objClauses);
		}
	}
?>