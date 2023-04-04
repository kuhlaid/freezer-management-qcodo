<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the LnTankLevel class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of LnTankLevel objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this LnTankLevelListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class LnTankLevelListPanelBase extends QPanel {
	public $dtgLnTankLevel;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colLnTankId;
	protected $colDateChecked;
	protected $colTankLevel;
	protected $colFreezerFull;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgLnTankLevel_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTankLevel()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTankLevel()->Id, false)));
		$this->colLnTankId = new QDataGridColumn(QApplication::Translate('Ln Tank Id'), '<?= $_CONTROL->ParentControl->dtgLnTankLevel_LnTank_Render($_ITEM); ?>');
		$this->colDateChecked = new QDataGridColumn(QApplication::Translate('Date Checked'), '<?= $_CONTROL->ParentControl->dtgLnTankLevel_DateChecked_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTankLevel()->DateChecked), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTankLevel()->DateChecked, false)));
		$this->colTankLevel = new QDataGridColumn(QApplication::Translate('Tank Level'), '<?= $_ITEM->TankLevel; ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTankLevel()->TankLevel), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTankLevel()->TankLevel, false)));
		$this->colFreezerFull = new QDataGridColumn(QApplication::Translate('Freezer Full'), '<?= ($_ITEM->FreezerFull) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::LnTankLevel()->FreezerFull), 'ReverseOrderByClause' => QQ::OrderBy(QQN::LnTankLevel()->FreezerFull, false)));

		// Setup DataGrid
		$this->dtgLnTankLevel = new QDataGrid($this);
		$this->dtgLnTankLevel->CellSpacing = 0;
		$this->dtgLnTankLevel->CellPadding = 4;
		$this->dtgLnTankLevel->BorderStyle = QBorderStyle::Solid;
		$this->dtgLnTankLevel->BorderWidth = 1;
		$this->dtgLnTankLevel->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgLnTankLevel->Paginator = new QPaginator($this->dtgLnTankLevel);
		$this->dtgLnTankLevel->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgLnTankLevel->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgLnTankLevel->SetDataBinder('dtgLnTankLevel_Bind', $this);

		$this->dtgLnTankLevel->AddColumn($this->colEditLinkColumn);
		$this->dtgLnTankLevel->AddColumn($this->colId);
		$this->dtgLnTankLevel->AddColumn($this->colLnTankId);
		$this->dtgLnTankLevel->AddColumn($this->colDateChecked);
		$this->dtgLnTankLevel->AddColumn($this->colTankLevel);
		$this->dtgLnTankLevel->AddColumn($this->colFreezerFull);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('LnTankLevel');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgLnTankLevel_EditLinkColumn_Render(LnTankLevel $objLnTankLevel) {
		$strControlId = 'btnEdit' . $this->dtgLnTankLevel->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgLnTankLevel, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objLnTankLevel->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objLnTankLevel = LnTankLevel::Load($strParameterArray[0]);

		$objEditPanel = new LnTankLevelEditPanel($this, $this->strCloseEditPanelMethod, $objLnTankLevel);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new LnTankLevelEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgLnTankLevel_LnTank_Render(LnTankLevel $objLnTankLevel) {
		if (!is_null($objLnTankLevel->LnTank))
			return $objLnTankLevel->LnTank->__toString();
		else
			return null;
	}

	public function dtgLnTankLevel_DateChecked_Render(LnTankLevel $objLnTankLevel) {
		if (!is_null($objLnTankLevel->DateChecked))
			return $objLnTankLevel->DateChecked->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}


	public function dtgLnTankLevel_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgLnTankLevel->TotalItemCount = LnTankLevel::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgLnTankLevel->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgLnTankLevel->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgLnTankLevel->DataSource = LnTankLevel::LoadAll($objClauses);
	}
}
?>