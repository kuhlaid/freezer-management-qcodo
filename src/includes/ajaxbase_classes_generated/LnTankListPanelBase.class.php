<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the LnTank class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of LnTank objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this LnTankListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class LnTankListPanelBase extends QPanel {
	public $dtgLnTank;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colDateOrdered;
	protected $colCost;
	protected $colDateReceived;
	protected $colDateAttached;
	protected $colSerialNumber;
	protected $colNote;
	protected $colPickedUp;
	protected $colElectronicGauge;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgLnTank_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTank()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTank()->Id, false)));
		$this->colDateOrdered = new QDataGridColumn(QApplication::Translate('Date Ordered'), '<?= $_CONTROL->ParentControl->dtgLnTank_DateOrdered_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTank()->DateOrdered), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTank()->DateOrdered, false)));
		$this->colCost = new QDataGridColumn(QApplication::Translate('Cost'), '<?= $_ITEM->Cost; ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTank()->Cost), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTank()->Cost, false)));
		$this->colDateReceived = new QDataGridColumn(QApplication::Translate('Date Received'), '<?= $_CONTROL->ParentControl->dtgLnTank_DateReceived_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTank()->DateReceived), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTank()->DateReceived, false)));
		$this->colDateAttached = new QDataGridColumn(QApplication::Translate('Date Attached'), '<?= $_CONTROL->ParentControl->dtgLnTank_DateAttached_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTank()->DateAttached), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTank()->DateAttached, false)));
		$this->colSerialNumber = new QDataGridColumn(QApplication::Translate('Serial Number'), '<?= QString::Truncate($_ITEM->SerialNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTank()->SerialNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTank()->SerialNumber, false)));
		$this->colNote = new QDataGridColumn(QApplication::Translate('Note'), '<?= QString::Truncate($_ITEM->Note, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTank()->Note), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTank()->Note, false)));
		$this->colPickedUp = new QDataGridColumn(QApplication::Translate('Picked Up'), '<?= $_CONTROL->ParentControl->dtgLnTank_PickedUp_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTank()->PickedUp), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTank()->PickedUp, false)));
		$this->colElectronicGauge = new QDataGridColumn(QApplication::Translate('Electronic Gauge'), '<?= ($_ITEM->ElectronicGauge) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTank()->ElectronicGauge), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTank()->ElectronicGauge, false)));

		// Setup DataGrid
		$this->dtgLnTank = new QDataGrid($this);
		$this->dtgLnTank->CellSpacing = 0;
		$this->dtgLnTank->CellPadding = 4;
		$this->dtgLnTank->BorderStyle = QBorderStyle::Solid;
		$this->dtgLnTank->BorderWidth = 1;
		$this->dtgLnTank->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgLnTank->Paginator = new QPaginator($this->dtgLnTank);
		$this->dtgLnTank->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgLnTank->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgLnTank->SetDataBinder('dtgLnTank_Bind', $this);

		$this->dtgLnTank->AddColumn($this->colEditLinkColumn);
		$this->dtgLnTank->AddColumn($this->colId);
		$this->dtgLnTank->AddColumn($this->colDateOrdered);
		$this->dtgLnTank->AddColumn($this->colCost);
		$this->dtgLnTank->AddColumn($this->colDateReceived);
		$this->dtgLnTank->AddColumn($this->colDateAttached);
		$this->dtgLnTank->AddColumn($this->colSerialNumber);
		$this->dtgLnTank->AddColumn($this->colNote);
		$this->dtgLnTank->AddColumn($this->colPickedUp);
		$this->dtgLnTank->AddColumn($this->colElectronicGauge);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('LnTank');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgLnTank_EditLinkColumn_Render(LnTank $objLnTank) {
		$strControlId = 'btnEdit' . $this->dtgLnTank->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgLnTank, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objLnTank->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objLnTank = LnTank::Load($strParameterArray[0]);

		$objEditPanel = new LnTankEditPanel($this, $this->strCloseEditPanelMethod, $objLnTank);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new LnTankEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgLnTank_DateOrdered_Render(LnTank $objLnTank) {
		if (!is_null($objLnTank->DateOrdered))
			return $objLnTank->DateOrdered->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgLnTank_DateReceived_Render(LnTank $objLnTank) {
		if (!is_null($objLnTank->DateReceived))
			return $objLnTank->DateReceived->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgLnTank_DateAttached_Render(LnTank $objLnTank) {
		if (!is_null($objLnTank->DateAttached))
			return $objLnTank->DateAttached->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgLnTank_PickedUp_Render(LnTank $objLnTank) {
		if (!is_null($objLnTank->PickedUp))
			return $objLnTank->PickedUp->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}


	public function dtgLnTank_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgLnTank->TotalItemCount = LnTank::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgLnTank->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgLnTank->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgLnTank->DataSource = LnTank::LoadAll($objClauses);
	}
}
?>