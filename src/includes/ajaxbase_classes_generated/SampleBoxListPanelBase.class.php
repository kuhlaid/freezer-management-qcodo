<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the SampleBox class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of SampleBox objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SampleBoxListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleBoxListPanelBase extends QPanel {
	public $dtgSampleBox;
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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSampleBox_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleBox()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleBox()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleBox()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleBox()->Name, false)));

		// Setup DataGrid
		$this->dtgSampleBox = new QDataGrid($this);
		$this->dtgSampleBox->CellSpacing = 0;
		$this->dtgSampleBox->CellPadding = 4;
		$this->dtgSampleBox->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleBox->BorderWidth = 1;
		$this->dtgSampleBox->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSampleBox->Paginator = new QPaginator($this->dtgSampleBox);
		$this->dtgSampleBox->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleBox->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleBox->SetDataBinder('dtgSampleBox_Bind', $this);

		$this->dtgSampleBox->AddColumn($this->colEditLinkColumn);
		$this->dtgSampleBox->AddColumn($this->colId);
		$this->dtgSampleBox->AddColumn($this->colName);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('SampleBox');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSampleBox_EditLinkColumn_Render(SampleBox $objSampleBox) {
		$strControlId = 'btnEdit' . $this->dtgSampleBox->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSampleBox, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSampleBox->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSampleBox = SampleBox::Load($strParameterArray[0]);

		$objEditPanel = new SampleBoxEditPanel($this, $this->strCloseEditPanelMethod, $objSampleBox);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SampleBoxEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgSampleBox_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSampleBox->TotalItemCount = SampleBox::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSampleBox->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSampleBox->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSampleBox->DataSource = SampleBox::LoadAll($objClauses);
	}
}
?>