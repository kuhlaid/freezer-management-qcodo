<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the SampleHistoryLog class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of SampleHistoryLog objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SampleHistoryLogListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleHistoryLogListPanelBase extends QPanel {
	public $dtgSampleHistoryLog;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colSampleId;
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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSampleHistoryLog_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->Id, false)));
		$this->colSampleId = new QDataGridColumn(QApplication::Translate('Sample Id'), '<?= $_ITEM->SampleId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->SampleId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->SampleId, false)));
		$this->colReleaseDate = new QDataGridColumn(QApplication::Translate('Release Date'), '<?= $_CONTROL->ParentControl->dtgSampleHistoryLog_ReleaseDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReleaseDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReleaseDate, false)));
		$this->colFreezerPullId = new QDataGridColumn(QApplication::Translate('Freezer Pull Id'), '<?= $_ITEM->FreezerPullId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->FreezerPullId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->FreezerPullId, false)));
		$this->colReceivedDate = new QDataGridColumn(QApplication::Translate('Received Date'), '<?= $_CONTROL->ParentControl->dtgSampleHistoryLog_ReceivedDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReceivedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleHistoryLog()->ReceivedDate, false)));

		// Setup DataGrid
		$this->dtgSampleHistoryLog = new QDataGrid($this);
		$this->dtgSampleHistoryLog->CellSpacing = 0;
		$this->dtgSampleHistoryLog->CellPadding = 4;
		$this->dtgSampleHistoryLog->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleHistoryLog->BorderWidth = 1;
		$this->dtgSampleHistoryLog->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSampleHistoryLog->Paginator = new QPaginator($this->dtgSampleHistoryLog);
		$this->dtgSampleHistoryLog->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleHistoryLog->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleHistoryLog->SetDataBinder('dtgSampleHistoryLog_Bind', $this);

		$this->dtgSampleHistoryLog->AddColumn($this->colEditLinkColumn);
		$this->dtgSampleHistoryLog->AddColumn($this->colId);
		$this->dtgSampleHistoryLog->AddColumn($this->colSampleId);
		$this->dtgSampleHistoryLog->AddColumn($this->colReleaseDate);
		$this->dtgSampleHistoryLog->AddColumn($this->colFreezerPullId);
		$this->dtgSampleHistoryLog->AddColumn($this->colReceivedDate);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('SampleHistoryLog');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSampleHistoryLog_EditLinkColumn_Render(SampleHistoryLog $objSampleHistoryLog) {
		$strControlId = 'btnEdit' . $this->dtgSampleHistoryLog->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSampleHistoryLog, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSampleHistoryLog->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSampleHistoryLog = SampleHistoryLog::Load($strParameterArray[0]);

		$objEditPanel = new SampleHistoryLogEditPanel($this, $this->strCloseEditPanelMethod, $objSampleHistoryLog);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SampleHistoryLogEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgSampleHistoryLog_ReleaseDate_Render(SampleHistoryLog $objSampleHistoryLog) {
		if (!is_null($objSampleHistoryLog->ReleaseDate))
			return $objSampleHistoryLog->ReleaseDate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgSampleHistoryLog_ReceivedDate_Render(SampleHistoryLog $objSampleHistoryLog) {
		if (!is_null($objSampleHistoryLog->ReceivedDate))
			return $objSampleHistoryLog->ReceivedDate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}


	public function dtgSampleHistoryLog_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSampleHistoryLog->TotalItemCount = SampleHistoryLog::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSampleHistoryLog->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSampleHistoryLog->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSampleHistoryLog->DataSource = SampleHistoryLog::LoadAll($objClauses);
	}
}
?>