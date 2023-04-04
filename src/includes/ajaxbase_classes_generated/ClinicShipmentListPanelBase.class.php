<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the ClinicShipment class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of ClinicShipment objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this ClinicShipmentListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class ClinicShipmentListPanelBase extends QPanel {
	public $dtgClinicShipment;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colShipTime;
	protected $colPreparedBy;
	protected $colTrackingNumber;

	public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Record Method Callbacks
		$this->strSetEditPanelMethod = $strSetEditPanelMethod;
		$this->strCloseEditPanelMethod = $strCloseEditPanelMethod;

		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgClinicShipment_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->Id, false)));
		$this->colShipTime = new QDataGridColumn(QApplication::Translate('Ship Time'), '<?= $_CONTROL->ParentControl->dtgClinicShipment_ShipTime_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->ShipTime), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClinicShipment()->ShipTime, false)));
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
		$this->dtgClinicShipment->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgClinicShipment->SetDataBinder('dtgClinicShipment_Bind', $this);

		$this->dtgClinicShipment->AddColumn($this->colEditLinkColumn);
		$this->dtgClinicShipment->AddColumn($this->colId);
		$this->dtgClinicShipment->AddColumn($this->colShipTime);
		$this->dtgClinicShipment->AddColumn($this->colPreparedBy);
		$this->dtgClinicShipment->AddColumn($this->colTrackingNumber);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('ClinicShipment');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgClinicShipment_EditLinkColumn_Render(ClinicShipment $objClinicShipment) {
		$strControlId = 'btnEdit' . $this->dtgClinicShipment->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgClinicShipment, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objClinicShipment->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objClinicShipment = ClinicShipment::Load($strParameterArray[0]);

		$objEditPanel = new ClinicShipmentEditPanel($this, $this->strCloseEditPanelMethod, $objClinicShipment);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new ClinicShipmentEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgClinicShipment_ShipTime_Render(ClinicShipment $objClinicShipment) {
		if (!is_null($objClinicShipment->ShipTime))
			return $objClinicShipment->ShipTime->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}


	public function dtgClinicShipment_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgClinicShipment->TotalItemCount = ClinicShipment::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgClinicShipment->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgClinicShipment->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgClinicShipment->DataSource = ClinicShipment::LoadAll($objClauses);
	}
}
?>