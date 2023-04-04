<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the TypeOfRack class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of TypeOfRack objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this TypeOfRackListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class TypeOfRackListPanelBase extends QPanel {
	public $dtgTypeOfRack;
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
	protected $colDepth;
	protected $colRows;
	protected $colColumns;
	protected $colBoxCount;
	protected $colBoxType;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgTypeOfRack_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Id, false)));
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Name, false)));
		$this->colWidth = new QDataGridColumn(QApplication::Translate('Width'), '<?= $_ITEM->Width; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Width), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Width, false)));
		$this->colHeight = new QDataGridColumn(QApplication::Translate('Height'), '<?= $_ITEM->Height; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Height), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Height, false)));
		$this->colDepth = new QDataGridColumn(QApplication::Translate('Depth'), '<?= $_ITEM->Depth; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Depth), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Depth, false)));
		$this->colRows = new QDataGridColumn(QApplication::Translate('Rows'), '<?= $_ITEM->Rows; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Rows), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Rows, false)));
		$this->colColumns = new QDataGridColumn(QApplication::Translate('Columns'), '<?= $_ITEM->Columns; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Columns), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->Columns, false)));
		$this->colBoxCount = new QDataGridColumn(QApplication::Translate('Box Count'), '<?= $_ITEM->BoxCount; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->BoxCount), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->BoxCount, false)));
		$this->colBoxType = new QDataGridColumn(QApplication::Translate('Box Type'), '<?= $_ITEM->BoxType; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->BoxType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TypeOfRack()->BoxType, false)));

		// Setup DataGrid
		$this->dtgTypeOfRack = new QDataGrid($this);
		$this->dtgTypeOfRack->CellSpacing = 0;
		$this->dtgTypeOfRack->CellPadding = 4;
		$this->dtgTypeOfRack->BorderStyle = QBorderStyle::Solid;
		$this->dtgTypeOfRack->BorderWidth = 1;
		$this->dtgTypeOfRack->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgTypeOfRack->Paginator = new QPaginator($this->dtgTypeOfRack);
		$this->dtgTypeOfRack->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgTypeOfRack->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgTypeOfRack->SetDataBinder('dtgTypeOfRack_Bind', $this);

		$this->dtgTypeOfRack->AddColumn($this->colEditLinkColumn);
		$this->dtgTypeOfRack->AddColumn($this->colId);
		$this->dtgTypeOfRack->AddColumn($this->colName);
		$this->dtgTypeOfRack->AddColumn($this->colWidth);
		$this->dtgTypeOfRack->AddColumn($this->colHeight);
		$this->dtgTypeOfRack->AddColumn($this->colDepth);
		$this->dtgTypeOfRack->AddColumn($this->colRows);
		$this->dtgTypeOfRack->AddColumn($this->colColumns);
		$this->dtgTypeOfRack->AddColumn($this->colBoxCount);
		$this->dtgTypeOfRack->AddColumn($this->colBoxType);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('TypeOfRack');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgTypeOfRack_EditLinkColumn_Render(TypeOfRack $objTypeOfRack) {
		$strControlId = 'btnEdit' . $this->dtgTypeOfRack->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgTypeOfRack, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objTypeOfRack->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objTypeOfRack = TypeOfRack::Load($strParameterArray[0]);

		$objEditPanel = new TypeOfRackEditPanel($this, $this->strCloseEditPanelMethod, $objTypeOfRack);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new TypeOfRackEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgTypeOfRack_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgTypeOfRack->TotalItemCount = TypeOfRack::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgTypeOfRack->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgTypeOfRack->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgTypeOfRack->DataSource = TypeOfRack::LoadAll($objClauses);
	}
}
?>