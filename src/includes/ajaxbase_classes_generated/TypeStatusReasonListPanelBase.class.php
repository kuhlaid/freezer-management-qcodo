<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the TypeStatusReason class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of TypeStatusReason objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this TypeStatusReasonListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class TypeStatusReasonListPanelBase extends QPanel {
	public $dtgTypeStatusReason;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colName;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgTypeStatusReason_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeStatusReason()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeStatusReason()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeStatusReason()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeStatusReason()->Name, false)));

		// Setup DataGrid
		$this->dtgTypeStatusReason = new QDataGrid($this);
		$this->dtgTypeStatusReason->CellSpacing = 0;
		$this->dtgTypeStatusReason->CellPadding = 4;
		$this->dtgTypeStatusReason->BorderStyle = QBorderStyle::Solid;
		$this->dtgTypeStatusReason->BorderWidth = 1;
		$this->dtgTypeStatusReason->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgTypeStatusReason->Paginator = new QPaginator($this->dtgTypeStatusReason);
		$this->dtgTypeStatusReason->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgTypeStatusReason->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgTypeStatusReason->SetDataBinder('dtgTypeStatusReason_Bind', $this);

		$this->dtgTypeStatusReason->AddColumn($this->colEditLinkColumn);
		$this->dtgTypeStatusReason->AddColumn($this->colId);
		$this->dtgTypeStatusReason->AddColumn($this->colName);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('TypeStatusReason');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgTypeStatusReason_EditLinkColumn_Render(TypeStatusReason $objTypeStatusReason) {
		$strControlId = 'btnEdit' . $this->dtgTypeStatusReason->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgTypeStatusReason, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objTypeStatusReason->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objTypeStatusReason = TypeStatusReason::Load($strParameterArray[0]);

		$objEditPanel = new TypeStatusReasonEditPanel($this, $this->strCloseEditPanelMethod, $objTypeStatusReason);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new TypeStatusReasonEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgTypeStatusReason_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgTypeStatusReason->TotalItemCount = TypeStatusReason::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgTypeStatusReason->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgTypeStatusReason->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgTypeStatusReason->DataSource = TypeStatusReason::LoadAll($objClauses);
	}
}
?>