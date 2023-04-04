<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the BoxHistoryLog class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of BoxHistoryLog objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this BoxHistoryLogListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class BoxHistoryLogListPanelBase extends QPanel {
	public $dtgBoxHistoryLog;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colBoxId;
	protected $colReleaseDate;
	protected $colFreezerPullId;
	protected $colReceivedDate;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgBoxHistoryLog_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->Id, false)));
		$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box Id'), '<?= $_CONTROL->ParentControl->dtgBoxHistoryLog_Box_Render($_ITEM); ?>');
		$this->colReleaseDate = new QDataGridColumn(QApplication::Translate('Release Date'), '<?= $_CONTROL->ParentControl->dtgBoxHistoryLog_ReleaseDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReleaseDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReleaseDate, false)));
		$this->colFreezerPullId = new QDataGridColumn(QApplication::Translate('Freezer Pull Id'), '<?= $_ITEM->FreezerPullId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->FreezerPullId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->FreezerPullId, false)));
		$this->colReceivedDate = new QDataGridColumn(QApplication::Translate('Received Date'), '<?= $_CONTROL->ParentControl->dtgBoxHistoryLog_ReceivedDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReceivedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::BoxHistoryLog()->ReceivedDate, false)));

		// Setup DataGrid
		$this->dtgBoxHistoryLog = new QDataGrid($this);
		$this->dtgBoxHistoryLog->CellSpacing = 0;
		$this->dtgBoxHistoryLog->CellPadding = 4;
		$this->dtgBoxHistoryLog->BorderStyle = QBorderStyle::Solid;
		$this->dtgBoxHistoryLog->BorderWidth = 1;
		$this->dtgBoxHistoryLog->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgBoxHistoryLog->Paginator = new QPaginator($this->dtgBoxHistoryLog);
		$this->dtgBoxHistoryLog->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgBoxHistoryLog->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgBoxHistoryLog->SetDataBinder('dtgBoxHistoryLog_Bind', $this);

		$this->dtgBoxHistoryLog->AddColumn($this->colEditLinkColumn);
		$this->dtgBoxHistoryLog->AddColumn($this->colId);
		$this->dtgBoxHistoryLog->AddColumn($this->colBoxId);
		$this->dtgBoxHistoryLog->AddColumn($this->colReleaseDate);
		$this->dtgBoxHistoryLog->AddColumn($this->colFreezerPullId);
		$this->dtgBoxHistoryLog->AddColumn($this->colReceivedDate);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('BoxHistoryLog');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgBoxHistoryLog_EditLinkColumn_Render(BoxHistoryLog $objBoxHistoryLog) {
		$strControlId = 'btnEdit' . $this->dtgBoxHistoryLog->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgBoxHistoryLog, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objBoxHistoryLog->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objBoxHistoryLog = BoxHistoryLog::Load($strParameterArray[0]);

		$objEditPanel = new BoxHistoryLogEditPanel($this, $this->strCloseEditPanelMethod, $objBoxHistoryLog);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new BoxHistoryLogEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgBoxHistoryLog_Box_Render(BoxHistoryLog $objBoxHistoryLog) {
		if (!is_null($objBoxHistoryLog->Box))
			return $objBoxHistoryLog->Box->__toString();
		else
			return null;
	}

	public function dtgBoxHistoryLog_ReleaseDate_Render(BoxHistoryLog $objBoxHistoryLog) {
		if (!is_null($objBoxHistoryLog->ReleaseDate))
			return $objBoxHistoryLog->ReleaseDate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgBoxHistoryLog_ReceivedDate_Render(BoxHistoryLog $objBoxHistoryLog) {
		if (!is_null($objBoxHistoryLog->ReceivedDate))
			return $objBoxHistoryLog->ReceivedDate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}


	public function dtgBoxHistoryLog_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgBoxHistoryLog->TotalItemCount = BoxHistoryLog::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgBoxHistoryLog->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgBoxHistoryLog->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgBoxHistoryLog->DataSource = BoxHistoryLog::LoadAll($objClauses);
	}
}
?>