<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the TypeOfBox class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of TypeOfBox objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this TypeOfBoxListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class TypeOfBoxListPanelBase extends QPanel {
	public $dtgTypeOfBox;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colName;
	protected $colWidth;
	protected $colHeight;
	protected $colRows;
	protected $colColumns;
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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgTypeOfBox_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Name, false)));
		$this->colWidth = new QDataGridColumn(QApplication::Translate('Width'), '<?= $_ITEM->Width; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Width), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Width, false)));
		$this->colHeight = new QDataGridColumn(QApplication::Translate('Height'), '<?= $_ITEM->Height; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Height), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Height, false)));
		$this->colRows = new QDataGridColumn(QApplication::Translate('Rows'), '<?= $_ITEM->Rows; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Rows), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Rows, false)));
		$this->colColumns = new QDataGridColumn(QApplication::Translate('Columns'), '<?= $_ITEM->Columns; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Columns), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Columns, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfBox()->Description, false)));

		// Setup DataGrid
		$this->dtgTypeOfBox = new QDataGrid($this);
		$this->dtgTypeOfBox->CellSpacing = 0;
		$this->dtgTypeOfBox->CellPadding = 4;
		$this->dtgTypeOfBox->BorderStyle = QBorderStyle::Solid;
		$this->dtgTypeOfBox->BorderWidth = 1;
		$this->dtgTypeOfBox->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgTypeOfBox->Paginator = new QPaginator($this->dtgTypeOfBox);
		$this->dtgTypeOfBox->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgTypeOfBox->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgTypeOfBox->SetDataBinder('dtgTypeOfBox_Bind', $this);

		$this->dtgTypeOfBox->AddColumn($this->colEditLinkColumn);
		$this->dtgTypeOfBox->AddColumn($this->colId);
		$this->dtgTypeOfBox->AddColumn($this->colName);
		$this->dtgTypeOfBox->AddColumn($this->colWidth);
		$this->dtgTypeOfBox->AddColumn($this->colHeight);
		$this->dtgTypeOfBox->AddColumn($this->colRows);
		$this->dtgTypeOfBox->AddColumn($this->colColumns);
		$this->dtgTypeOfBox->AddColumn($this->colDescription);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('TypeOfBox');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgTypeOfBox_EditLinkColumn_Render(TypeOfBox $objTypeOfBox) {
		$strControlId = 'btnEdit' . $this->dtgTypeOfBox->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgTypeOfBox, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objTypeOfBox->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objTypeOfBox = TypeOfBox::Load($strParameterArray[0]);

		$objEditPanel = new TypeOfBoxEditPanel($this, $this->strCloseEditPanelMethod, $objTypeOfBox);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new TypeOfBoxEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgTypeOfBox_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgTypeOfBox->TotalItemCount = TypeOfBox::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgTypeOfBox->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgTypeOfBox->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgTypeOfBox->DataSource = TypeOfBox::LoadAll($objClauses);
	}
}
?>