<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Calllog class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Calllog objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this CalllogListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class CalllogListPanelBase extends QPanel {
	public $dtgCalllog;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colCaseid;
	protected $colNumcalled;
	protected $colCalldate;
	protected $colCalltime;
	protected $colCalloutcome;
	protected $colComments;
	protected $colUsername;
	protected $colReference;
	protected $colCalldt;
	protected $colParticipantId;
	protected $colInterviewerId;
	protected $colCallEnd;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCalllog_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Id, false)));
		$this->colCaseid = new QDataGridColumn(QApplication::Translate('Caseid'), '<?= QString::Truncate($_ITEM->Caseid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Caseid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Caseid, false)));
		$this->colNumcalled = new QDataGridColumn(QApplication::Translate('Numcalled'), '<?= QString::Truncate($_ITEM->Numcalled, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Numcalled), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Numcalled, false)));
		$this->colCalldate = new QDataGridColumn(QApplication::Translate('Calldate'), '<?= $_CONTROL->ParentControl->dtgCalllog_Calldate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Calldate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Calldate, false)));
		$this->colCalltime = new QDataGridColumn(QApplication::Translate('Calltime'), '<?= QString::Truncate($_ITEM->Calltime, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Calltime), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Calltime, false)));
		$this->colCalloutcome = new QDataGridColumn(QApplication::Translate('Calloutcome'), '<?= QString::Truncate($_ITEM->Calloutcome, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Calloutcome), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Calloutcome, false)));
		$this->colComments = new QDataGridColumn(QApplication::Translate('Comments'), '<?= QString::Truncate($_ITEM->Comments, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Comments), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Comments, false)));
		$this->colUsername = new QDataGridColumn(QApplication::Translate('Username'), '<?= QString::Truncate($_ITEM->Username, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Username), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Username, false)));
		$this->colReference = new QDataGridColumn(QApplication::Translate('Reference'), '<?= QString::Truncate($_ITEM->Reference, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Reference), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Reference, false)));
		$this->colCalldt = new QDataGridColumn(QApplication::Translate('Calldt'), '<?= $_CONTROL->ParentControl->dtgCalllog_Calldt_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->Calldt), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->Calldt, false)));
		$this->colParticipantId = new QDataGridColumn(QApplication::Translate('Participant Id'), '<?= $_CONTROL->ParentControl->dtgCalllog_Participant_Render($_ITEM); ?>');
		$this->colInterviewerId = new QDataGridColumn(QApplication::Translate('Interviewer Id'), '<?= $_CONTROL->ParentControl->dtgCalllog_Interviewer_Render($_ITEM); ?>');
		$this->colCallEnd = new QDataGridColumn(QApplication::Translate('Call End'), '<?= $_CONTROL->ParentControl->dtgCalllog_CallEnd_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Calllog()->CallEnd), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Calllog()->CallEnd, false)));

		// Setup DataGrid
		$this->dtgCalllog = new QDataGrid($this);
		$this->dtgCalllog->CellSpacing = 0;
		$this->dtgCalllog->CellPadding = 4;
		$this->dtgCalllog->BorderStyle = QBorderStyle::Solid;
		$this->dtgCalllog->BorderWidth = 1;
		$this->dtgCalllog->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgCalllog->Paginator = new QPaginator($this->dtgCalllog);
		$this->dtgCalllog->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgCalllog->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgCalllog->SetDataBinder('dtgCalllog_Bind', $this);

		$this->dtgCalllog->AddColumn($this->colEditLinkColumn);
		$this->dtgCalllog->AddColumn($this->colId);
		$this->dtgCalllog->AddColumn($this->colCaseid);
		$this->dtgCalllog->AddColumn($this->colNumcalled);
		$this->dtgCalllog->AddColumn($this->colCalldate);
		$this->dtgCalllog->AddColumn($this->colCalltime);
		$this->dtgCalllog->AddColumn($this->colCalloutcome);
		$this->dtgCalllog->AddColumn($this->colComments);
		$this->dtgCalllog->AddColumn($this->colUsername);
		$this->dtgCalllog->AddColumn($this->colReference);
		$this->dtgCalllog->AddColumn($this->colCalldt);
		$this->dtgCalllog->AddColumn($this->colParticipantId);
		$this->dtgCalllog->AddColumn($this->colInterviewerId);
		$this->dtgCalllog->AddColumn($this->colCallEnd);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Calllog');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgCalllog_EditLinkColumn_Render(Calllog $objCalllog) {
		$strControlId = 'btnEdit' . $this->dtgCalllog->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgCalllog, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objCalllog->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objCalllog = Calllog::Load($strParameterArray[0]);

		$objEditPanel = new CalllogEditPanel($this, $this->strCloseEditPanelMethod, $objCalllog);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new CalllogEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgCalllog_Calldate_Render(Calllog $objCalllog) {
		if (!is_null($objCalllog->Calldate))
			return $objCalllog->Calldate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgCalllog_Calldt_Render(Calllog $objCalllog) {
		if (!is_null($objCalllog->Calldt))
			return $objCalllog->Calldt->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}

	public function dtgCalllog_Participant_Render(Calllog $objCalllog) {
		if (!is_null($objCalllog->Participant))
			return $objCalllog->Participant->__toString();
		else
			return null;
	}

	public function dtgCalllog_Interviewer_Render(Calllog $objCalllog) {
		if (!is_null($objCalllog->Interviewer))
			return $objCalllog->Interviewer->__toString();
		else
			return null;
	}

	public function dtgCalllog_CallEnd_Render(Calllog $objCalllog) {
		if (!is_null($objCalllog->CallEnd))
			return $objCalllog->CallEnd->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}


	public function dtgCalllog_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgCalllog->TotalItemCount = Calllog::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgCalllog->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgCalllog->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgCalllog->DataSource = Calllog::LoadAll($objClauses);
	}
}
?>