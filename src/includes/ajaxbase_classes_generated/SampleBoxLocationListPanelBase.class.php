<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the SampleBoxLocation class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of SampleBoxLocation objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SampleBoxLocationListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleBoxLocationListPanelBase extends QPanel {
	public $dtgSampleBoxLocation;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colBoxId;
	protected $colBoxSampleSlot;
	protected $colSampleId;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSampleBoxLocation_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleBoxLocation()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleBoxLocation()->Id, false)));
		$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box Id'), '<?= $_CONTROL->ParentControl->dtgSampleBoxLocation_Box_Render($_ITEM); ?>');
		$this->colBoxSampleSlot = new QDataGridColumn(QApplication::Translate('Box Sample Slot'), '<?= $_ITEM->BoxSampleSlot; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleBoxLocation()->BoxSampleSlot), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleBoxLocation()->BoxSampleSlot, false)));
		$this->colSampleId = new QDataGridColumn(QApplication::Translate('Sample Id'), '<?= $_ITEM->SampleId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleBoxLocation()->SampleId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleBoxLocation()->SampleId, false)));

		// Setup DataGrid
		$this->dtgSampleBoxLocation = new QDataGrid($this);
		$this->dtgSampleBoxLocation->CellSpacing = 0;
		$this->dtgSampleBoxLocation->CellPadding = 4;
		$this->dtgSampleBoxLocation->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleBoxLocation->BorderWidth = 1;
		$this->dtgSampleBoxLocation->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSampleBoxLocation->Paginator = new QPaginator($this->dtgSampleBoxLocation);
		$this->dtgSampleBoxLocation->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleBoxLocation->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleBoxLocation->SetDataBinder('dtgSampleBoxLocation_Bind', $this);

		$this->dtgSampleBoxLocation->AddColumn($this->colEditLinkColumn);
		$this->dtgSampleBoxLocation->AddColumn($this->colId);
		$this->dtgSampleBoxLocation->AddColumn($this->colBoxId);
		$this->dtgSampleBoxLocation->AddColumn($this->colBoxSampleSlot);
		$this->dtgSampleBoxLocation->AddColumn($this->colSampleId);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('SampleBoxLocation');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSampleBoxLocation_EditLinkColumn_Render(SampleBoxLocation $objSampleBoxLocation) {
		$strControlId = 'btnEdit' . $this->dtgSampleBoxLocation->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSampleBoxLocation, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSampleBoxLocation->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSampleBoxLocation = SampleBoxLocation::Load($strParameterArray[0]);

		$objEditPanel = new SampleBoxLocationEditPanel($this, $this->strCloseEditPanelMethod, $objSampleBoxLocation);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SampleBoxLocationEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgSampleBoxLocation_Box_Render(SampleBoxLocation $objSampleBoxLocation) {
		if (!is_null($objSampleBoxLocation->Box))
			return $objSampleBoxLocation->Box->__toString();
		else
			return null;
	}


	public function dtgSampleBoxLocation_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSampleBoxLocation->TotalItemCount = SampleBoxLocation::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSampleBoxLocation->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSampleBoxLocation->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSampleBoxLocation->DataSource = SampleBoxLocation::LoadAll($objClauses);
	}
}
?>