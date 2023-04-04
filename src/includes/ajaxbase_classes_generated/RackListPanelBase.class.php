<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Rack class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Rack objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this RackListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class RackListPanelBase extends QPanel {
	public $dtgRack;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colName;
	protected $colRackTypeId;
	protected $colNotes;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgRack_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Name, false)));
		$this->colRackTypeId = new QDataGridColumn(QApplication::Translate('Rack Type Id'), '<?= $_CONTROL->ParentControl->dtgRack_RackType_Render($_ITEM); ?>');
		$this->colNotes = new QDataGridColumn(QApplication::Translate('Notes'), '<?= QString::Truncate($_ITEM->Notes, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Rack()->Notes), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Rack()->Notes, false)));

		// Setup DataGrid
		$this->dtgRack = new QDataGrid($this);
		$this->dtgRack->CellSpacing = 0;
		$this->dtgRack->CellPadding = 4;
		$this->dtgRack->BorderStyle = QBorderStyle::Solid;
		$this->dtgRack->BorderWidth = 1;
		$this->dtgRack->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgRack->Paginator = new QPaginator($this->dtgRack);
		$this->dtgRack->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgRack->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgRack->SetDataBinder('dtgRack_Bind', $this);

		$this->dtgRack->AddColumn($this->colEditLinkColumn);
		$this->dtgRack->AddColumn($this->colId);
		$this->dtgRack->AddColumn($this->colName);
		$this->dtgRack->AddColumn($this->colRackTypeId);
		$this->dtgRack->AddColumn($this->colNotes);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Rack');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgRack_EditLinkColumn_Render(Rack $objRack) {
		$strControlId = 'btnEdit' . $this->dtgRack->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgRack, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objRack->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objRack = Rack::Load($strParameterArray[0]);

		$objEditPanel = new RackEditPanel($this, $this->strCloseEditPanelMethod, $objRack);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new RackEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgRack_RackType_Render(Rack $objRack) {
		if (!is_null($objRack->RackType))
			return $objRack->RackType->__toString();
		else
			return null;
	}


	public function dtgRack_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgRack->TotalItemCount = Rack::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgRack->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgRack->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgRack->DataSource = Rack::LoadAll($objClauses);
	}
}
?>