<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the CurrentLnTank class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of CurrentLnTank objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this CurrentLnTankListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class CurrentLnTankListPanelBase extends QPanel {
	public $dtgCurrentLnTank;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colLnTankId;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCurrentLnTank_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CurrentLnTank()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CurrentLnTank()->Id, false)));
		$this->colLnTankId = new QDataGridColumn(QApplication::Translate('Ln Tank Id'), '<?= $_CONTROL->ParentControl->dtgCurrentLnTank_LnTank_Render($_ITEM); ?>');

		// Setup DataGrid
		$this->dtgCurrentLnTank = new QDataGrid($this);
		$this->dtgCurrentLnTank->CellSpacing = 0;
		$this->dtgCurrentLnTank->CellPadding = 4;
		$this->dtgCurrentLnTank->BorderStyle = QBorderStyle::Solid;
		$this->dtgCurrentLnTank->BorderWidth = 1;
		$this->dtgCurrentLnTank->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgCurrentLnTank->Paginator = new QPaginator($this->dtgCurrentLnTank);
		$this->dtgCurrentLnTank->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgCurrentLnTank->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgCurrentLnTank->SetDataBinder('dtgCurrentLnTank_Bind', $this);

		$this->dtgCurrentLnTank->AddColumn($this->colEditLinkColumn);
		$this->dtgCurrentLnTank->AddColumn($this->colId);
		$this->dtgCurrentLnTank->AddColumn($this->colLnTankId);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('CurrentLnTank');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgCurrentLnTank_EditLinkColumn_Render(CurrentLnTank $objCurrentLnTank) {
		$strControlId = 'btnEdit' . $this->dtgCurrentLnTank->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgCurrentLnTank, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objCurrentLnTank->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objCurrentLnTank = CurrentLnTank::Load($strParameterArray[0]);

		$objEditPanel = new CurrentLnTankEditPanel($this, $this->strCloseEditPanelMethod, $objCurrentLnTank);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new CurrentLnTankEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgCurrentLnTank_LnTank_Render(CurrentLnTank $objCurrentLnTank) {
		if (!is_null($objCurrentLnTank->LnTank))
			return $objCurrentLnTank->LnTank->__toString();
		else
			return null;
	}


	public function dtgCurrentLnTank_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgCurrentLnTank->TotalItemCount = CurrentLnTank::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgCurrentLnTank->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgCurrentLnTank->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgCurrentLnTank->DataSource = CurrentLnTank::LoadAll($objClauses);
	}
}
?>