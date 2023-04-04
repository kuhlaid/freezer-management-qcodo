<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the SampleTypes class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of SampleTypes objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SampleTypesListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleTypesListPanelBase extends QPanel {
	public $dtgSampleTypes;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colLetter;
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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSampleTypes_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Id, false)));
		$this->colLetter = new QDataGridColumn(QApplication::Translate('Letter'), '<?= QString::Truncate($_ITEM->Letter, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Letter), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Letter, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleTypes()->Description, false)));

		// Setup DataGrid
		$this->dtgSampleTypes = new QDataGrid($this);
		$this->dtgSampleTypes->CellSpacing = 0;
		$this->dtgSampleTypes->CellPadding = 4;
		$this->dtgSampleTypes->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleTypes->BorderWidth = 1;
		$this->dtgSampleTypes->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSampleTypes->Paginator = new QPaginator($this->dtgSampleTypes);
		$this->dtgSampleTypes->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleTypes->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleTypes->SetDataBinder('dtgSampleTypes_Bind', $this);

		$this->dtgSampleTypes->AddColumn($this->colEditLinkColumn);
		$this->dtgSampleTypes->AddColumn($this->colId);
		$this->dtgSampleTypes->AddColumn($this->colLetter);
		$this->dtgSampleTypes->AddColumn($this->colDescription);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('SampleTypes');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSampleTypes_EditLinkColumn_Render(SampleTypes $objSampleTypes) {
		$strControlId = 'btnEdit' . $this->dtgSampleTypes->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSampleTypes, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSampleTypes->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSampleTypes = SampleTypes::Load($strParameterArray[0]);

		$objEditPanel = new SampleTypesEditPanel($this, $this->strCloseEditPanelMethod, $objSampleTypes);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SampleTypesEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgSampleTypes_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSampleTypes->TotalItemCount = SampleTypes::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSampleTypes->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSampleTypes->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSampleTypes->DataSource = SampleTypes::LoadAll($objClauses);
	}
}
?>