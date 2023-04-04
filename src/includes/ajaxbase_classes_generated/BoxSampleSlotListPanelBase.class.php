<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the BoxSampleSlot class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of BoxSampleSlot objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this BoxSampleSlotListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class BoxSampleSlotListPanelBase extends QPanel {
	public $dtgBoxSampleSlot;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colSlotName;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgBoxSampleSlot_EditLinkColumn_Render($_ITEM) ?>');
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
		$this->dtgBoxSampleSlot->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgBoxSampleSlot->SetDataBinder('dtgBoxSampleSlot_Bind', $this);

		$this->dtgBoxSampleSlot->AddColumn($this->colEditLinkColumn);
		$this->dtgBoxSampleSlot->AddColumn($this->colId);
		$this->dtgBoxSampleSlot->AddColumn($this->colSlotName);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('BoxSampleSlot');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgBoxSampleSlot_EditLinkColumn_Render(BoxSampleSlot $objBoxSampleSlot) {
		$strControlId = 'btnEdit' . $this->dtgBoxSampleSlot->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgBoxSampleSlot, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objBoxSampleSlot->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objBoxSampleSlot = BoxSampleSlot::Load($strParameterArray[0]);

		$objEditPanel = new BoxSampleSlotEditPanel($this, $this->strCloseEditPanelMethod, $objBoxSampleSlot);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new BoxSampleSlotEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgBoxSampleSlot_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgBoxSampleSlot->TotalItemCount = BoxSampleSlot::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgBoxSampleSlot->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgBoxSampleSlot->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgBoxSampleSlot->DataSource = BoxSampleSlot::LoadAll($objClauses);
	}
}
?>