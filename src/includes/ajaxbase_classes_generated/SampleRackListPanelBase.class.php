<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the SampleRack class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of SampleRack objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SampleRackListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleRackListPanelBase extends QPanel {
	public $dtgSampleRack;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colName;
	protected $colBoxCount;
	protected $colRackTypeId;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSampleRack_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleRack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleRack()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleRack()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleRack()->Name, false)));
		$this->colBoxCount = new QDataGridColumn(QApplication::Translate('Box Count'), '<?= $_ITEM->BoxCount; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleRack()->BoxCount), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleRack()->BoxCount, false)));
		$this->colRackTypeId = new QDataGridColumn(QApplication::Translate('Rack Type Id'), '<?= $_CONTROL->ParentControl->dtgSampleRack_RackType_Render($_ITEM); ?>');

		// Setup DataGrid
		$this->dtgSampleRack = new QDataGrid($this);
		$this->dtgSampleRack->CellSpacing = 0;
		$this->dtgSampleRack->CellPadding = 4;
		$this->dtgSampleRack->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleRack->BorderWidth = 1;
		$this->dtgSampleRack->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSampleRack->Paginator = new QPaginator($this->dtgSampleRack);
		$this->dtgSampleRack->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleRack->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleRack->SetDataBinder('dtgSampleRack_Bind', $this);

		$this->dtgSampleRack->AddColumn($this->colEditLinkColumn);
		$this->dtgSampleRack->AddColumn($this->colId);
		$this->dtgSampleRack->AddColumn($this->colName);
		$this->dtgSampleRack->AddColumn($this->colBoxCount);
		$this->dtgSampleRack->AddColumn($this->colRackTypeId);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('SampleRack');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSampleRack_EditLinkColumn_Render(SampleRack $objSampleRack) {
		$strControlId = 'btnEdit' . $this->dtgSampleRack->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSampleRack, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSampleRack->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSampleRack = SampleRack::Load($strParameterArray[0]);

		$objEditPanel = new SampleRackEditPanel($this, $this->strCloseEditPanelMethod, $objSampleRack);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SampleRackEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgSampleRack_RackType_Render(SampleRack $objSampleRack) {
		if (!is_null($objSampleRack->RackType))
			return $objSampleRack->RackType->__toString();
		else
			return null;
	}


	public function dtgSampleRack_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSampleRack->TotalItemCount = SampleRack::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSampleRack->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSampleRack->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSampleRack->DataSource = SampleRack::LoadAll($objClauses);
	}
}
?>