<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Co2 class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Co2 objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this Co2ListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class Co2ListPanelBase extends QPanel {
	public $dtgCo2;
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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCo2_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Co2()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Co2()->Id, false)));
		$this->colDateOrdered = new QDataGridColumn(QApplication::Translate('Date Ordered'), '<?= $_CONTROL->ParentControl->dtgCo2_DateOrdered_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Co2()->DateOrdered), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Co2()->DateOrdered, false)));
		$this->colCost = new QDataGridColumn(QApplication::Translate('Cost'), '<?= $_ITEM->Cost; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Co2()->Cost), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Co2()->Cost, false)));
		$this->colDateReceived = new QDataGridColumn(QApplication::Translate('Date Received'), '<?= $_CONTROL->ParentControl->dtgCo2_DateReceived_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Co2()->DateReceived), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Co2()->DateReceived, false)));
		$this->colDateAttached = new QDataGridColumn(QApplication::Translate('Date Attached'), '<?= $_CONTROL->ParentControl->dtgCo2_DateAttached_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Co2()->DateAttached), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Co2()->DateAttached, false)));
		$this->colSerialNumber = new QDataGridColumn(QApplication::Translate('Serial Number'), '<?= QString::Truncate($_ITEM->SerialNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Co2()->SerialNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Co2()->SerialNumber, false)));
		$this->colNote = new QDataGridColumn(QApplication::Translate('Note'), '<?= QString::Truncate($_ITEM->Note, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Co2()->Note), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Co2()->Note, false)));
		$this->colPickedUp = new QDataGridColumn(QApplication::Translate('Picked Up'), '<?= $_CONTROL->ParentControl->dtgCo2_PickedUp_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Co2()->PickedUp), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Co2()->PickedUp, false)));

		// Setup DataGrid
		$this->dtgCo2 = new QDataGrid($this);
		$this->dtgCo2->CellSpacing = 0;
		$this->dtgCo2->CellPadding = 4;
		$this->dtgCo2->BorderStyle = QBorderStyle::Solid;
		$this->dtgCo2->BorderWidth = 1;
		$this->dtgCo2->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgCo2->Paginator = new QPaginator($this->dtgCo2);
		$this->dtgCo2->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgCo2->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgCo2->SetDataBinder('dtgCo2_Bind', $this);

		$this->dtgCo2->AddColumn($this->colEditLinkColumn);
		$this->dtgCo2->AddColumn($this->colId);
		$this->dtgCo2->AddColumn($this->colDateOrdered);
		$this->dtgCo2->AddColumn($this->colCost);
		$this->dtgCo2->AddColumn($this->colDateReceived);
		$this->dtgCo2->AddColumn($this->colDateAttached);
		$this->dtgCo2->AddColumn($this->colSerialNumber);
		$this->dtgCo2->AddColumn($this->colNote);
		$this->dtgCo2->AddColumn($this->colPickedUp);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Co2');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgCo2_EditLinkColumn_Render(Co2 $objCo2) {
		$strControlId = 'btnEdit' . $this->dtgCo2->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgCo2, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objCo2->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objCo2 = Co2::Load($strParameterArray[0]);

		$objEditPanel = new Co2EditPanel($this, $this->strCloseEditPanelMethod, $objCo2);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new Co2EditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgCo2_DateOrdered_Render(Co2 $objCo2) {
		if (!is_null($objCo2->DateOrdered))
			return $objCo2->DateOrdered->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgCo2_DateReceived_Render(Co2 $objCo2) {
		if (!is_null($objCo2->DateReceived))
			return $objCo2->DateReceived->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgCo2_DateAttached_Render(Co2 $objCo2) {
		if (!is_null($objCo2->DateAttached))
			return $objCo2->DateAttached->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgCo2_PickedUp_Render(Co2 $objCo2) {
		if (!is_null($objCo2->PickedUp))
			return $objCo2->PickedUp->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}


	public function dtgCo2_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgCo2->TotalItemCount = Co2::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgCo2->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgCo2->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgCo2->DataSource = Co2::LoadAll($objClauses);
	}
}
?>