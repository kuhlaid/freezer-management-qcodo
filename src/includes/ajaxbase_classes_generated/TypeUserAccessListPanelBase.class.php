<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the TypeUserAccess class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of TypeUserAccess objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this TypeUserAccessListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class TypeUserAccessListPanelBase extends QPanel {
	public $dtgTypeUserAccess;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colName;
	protected $colDescription;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgTypeUserAccess_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Name, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeUserAccess()->Description, false)));

		// Setup DataGrid
		$this->dtgTypeUserAccess = new QDataGrid($this);
		$this->dtgTypeUserAccess->CellSpacing = 0;
		$this->dtgTypeUserAccess->CellPadding = 4;
		$this->dtgTypeUserAccess->BorderStyle = QBorderStyle::Solid;
		$this->dtgTypeUserAccess->BorderWidth = 1;
		$this->dtgTypeUserAccess->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgTypeUserAccess->Paginator = new QPaginator($this->dtgTypeUserAccess);
		$this->dtgTypeUserAccess->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgTypeUserAccess->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgTypeUserAccess->SetDataBinder('dtgTypeUserAccess_Bind', $this);

		$this->dtgTypeUserAccess->AddColumn($this->colEditLinkColumn);
		$this->dtgTypeUserAccess->AddColumn($this->colId);
		$this->dtgTypeUserAccess->AddColumn($this->colName);
		$this->dtgTypeUserAccess->AddColumn($this->colDescription);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('TypeUserAccess');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgTypeUserAccess_EditLinkColumn_Render(TypeUserAccess $objTypeUserAccess) {
		$strControlId = 'btnEdit' . $this->dtgTypeUserAccess->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgTypeUserAccess, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objTypeUserAccess->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objTypeUserAccess = TypeUserAccess::Load($strParameterArray[0]);

		$objEditPanel = new TypeUserAccessEditPanel($this, $this->strCloseEditPanelMethod, $objTypeUserAccess);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new TypeUserAccessEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgTypeUserAccess_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgTypeUserAccess->TotalItemCount = TypeUserAccess::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgTypeUserAccess->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgTypeUserAccess->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgTypeUserAccess->DataSource = TypeUserAccess::LoadAll($objClauses);
	}
}
?>