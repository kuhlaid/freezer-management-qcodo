<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the T3SchTyp class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of T3SchTyp objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this T3SchTypListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class T3SchTypListPanelBase extends QPanel {
	public $dtgT3SchTyp;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colName;
	protected $colStudy;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgT3SchTyp_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::T3SchTyp()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::T3SchTyp()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::T3SchTyp()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::T3SchTyp()->Name, false)));
		$this->colStudy = new QDataGridColumn(QApplication::Translate('Study'), '<?= QString::Truncate($_ITEM->Study, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::T3SchTyp()->Study), 'ReverseOrderByClause' => QQ::OrderBy(QQN::T3SchTyp()->Study, false)));

		// Setup DataGrid
		$this->dtgT3SchTyp = new QDataGrid($this);
		$this->dtgT3SchTyp->CellSpacing = 0;
		$this->dtgT3SchTyp->CellPadding = 4;
		$this->dtgT3SchTyp->BorderStyle = QBorderStyle::Solid;
		$this->dtgT3SchTyp->BorderWidth = 1;
		$this->dtgT3SchTyp->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgT3SchTyp->Paginator = new QPaginator($this->dtgT3SchTyp);
		$this->dtgT3SchTyp->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgT3SchTyp->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgT3SchTyp->SetDataBinder('dtgT3SchTyp_Bind', $this);

		$this->dtgT3SchTyp->AddColumn($this->colEditLinkColumn);
		$this->dtgT3SchTyp->AddColumn($this->colId);
		$this->dtgT3SchTyp->AddColumn($this->colName);
		$this->dtgT3SchTyp->AddColumn($this->colStudy);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('T3SchTyp');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgT3SchTyp_EditLinkColumn_Render(T3SchTyp $objT3SchTyp) {
		$strControlId = 'btnEdit' . $this->dtgT3SchTyp->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgT3SchTyp, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objT3SchTyp->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objT3SchTyp = T3SchTyp::Load($strParameterArray[0]);

		$objEditPanel = new T3SchTypEditPanel($this, $this->strCloseEditPanelMethod, $objT3SchTyp);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new T3SchTypEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgT3SchTyp_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgT3SchTyp->TotalItemCount = T3SchTyp::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgT3SchTyp->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgT3SchTyp->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgT3SchTyp->DataSource = T3SchTyp::LoadAll($objClauses);
	}
}
?>