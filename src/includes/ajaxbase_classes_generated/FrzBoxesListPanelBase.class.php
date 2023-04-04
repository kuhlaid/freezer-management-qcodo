<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the FrzBoxes class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of FrzBoxes objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this FrzBoxesListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class FrzBoxesListPanelBase extends QPanel {
	public $dtgFrzBoxes;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colBoxid;
	protected $colRack;
	protected $colShelf;
	protected $colFreezer;
	protected $colId;
	protected $colIssues;
	protected $colDescription;
	protected $colBoxTypeId;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgFrzBoxes_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colBoxid = new QDataGridColumn(QApplication::Translate('Boxid'), '<?= QString::Truncate($_ITEM->Boxid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Boxid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Boxid, false)));
		$this->colRack = new QDataGridColumn(QApplication::Translate('Rack'), '<?= QString::Truncate($_ITEM->Rack, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Rack), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Rack, false)));
		$this->colShelf = new QDataGridColumn(QApplication::Translate('Shelf'), '<?= $_ITEM->Shelf; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Shelf), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Shelf, false)));
		$this->colFreezer = new QDataGridColumn(QApplication::Translate('Freezer'), '<?= $_ITEM->Freezer; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Freezer), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Freezer, false)));
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Id, false)));
		$this->colIssues = new QDataGridColumn(QApplication::Translate('Issues'), '<?= QString::Truncate($_ITEM->Issues, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Issues), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Issues, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->Description, false)));
		$this->colBoxTypeId = new QDataGridColumn(QApplication::Translate('Box Type Id'), '<?= $_ITEM->BoxTypeId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->BoxTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzBoxes()->BoxTypeId, false)));

		// Setup DataGrid
		$this->dtgFrzBoxes = new QDataGrid($this);
		$this->dtgFrzBoxes->CellSpacing = 0;
		$this->dtgFrzBoxes->CellPadding = 4;
		$this->dtgFrzBoxes->BorderStyle = QBorderStyle::Solid;
		$this->dtgFrzBoxes->BorderWidth = 1;
		$this->dtgFrzBoxes->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgFrzBoxes->Paginator = new QPaginator($this->dtgFrzBoxes);
		$this->dtgFrzBoxes->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgFrzBoxes->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgFrzBoxes->SetDataBinder('dtgFrzBoxes_Bind', $this);

		$this->dtgFrzBoxes->AddColumn($this->colEditLinkColumn);
		$this->dtgFrzBoxes->AddColumn($this->colBoxid);
		$this->dtgFrzBoxes->AddColumn($this->colRack);
		$this->dtgFrzBoxes->AddColumn($this->colShelf);
		$this->dtgFrzBoxes->AddColumn($this->colFreezer);
		$this->dtgFrzBoxes->AddColumn($this->colId);
		$this->dtgFrzBoxes->AddColumn($this->colIssues);
		$this->dtgFrzBoxes->AddColumn($this->colDescription);
		$this->dtgFrzBoxes->AddColumn($this->colBoxTypeId);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('FrzBoxes');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgFrzBoxes_EditLinkColumn_Render(FrzBoxes $objFrzBoxes) {
		$strControlId = 'btnEdit' . $this->dtgFrzBoxes->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgFrzBoxes, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objFrzBoxes->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objFrzBoxes = FrzBoxes::Load($strParameterArray[0]);

		$objEditPanel = new FrzBoxesEditPanel($this, $this->strCloseEditPanelMethod, $objFrzBoxes);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new FrzBoxesEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgFrzBoxes_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgFrzBoxes->TotalItemCount = FrzBoxes::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgFrzBoxes->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgFrzBoxes->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgFrzBoxes->DataSource = FrzBoxes::LoadAll($objClauses);
	}
}
?>