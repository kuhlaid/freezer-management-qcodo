<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the T3Sch class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of T3Sch objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this T3SchListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class T3SchListPanelBase extends QPanel {
	public $dtgT3Sch;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colParticipantId;
	protected $colScheduleIn;
	protected $colScheduleOut;
	protected $colNote;
	protected $colInterviewerId;
	protected $colScheduleTypeId;
	protected $colCreatedOn;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgT3Sch_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::T3Sch()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::T3Sch()->Id, false)));
		$this->colParticipantId = new QDataGridColumn(QApplication::Translate('Participant Id'), '<?= $_CONTROL->ParentControl->dtgT3Sch_Participant_Render($_ITEM); ?>');
		$this->colScheduleIn = new QDataGridColumn(QApplication::Translate('Schedule In'), '<?= $_CONTROL->ParentControl->dtgT3Sch_ScheduleIn_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::T3Sch()->ScheduleIn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::T3Sch()->ScheduleIn, false)));
		$this->colScheduleOut = new QDataGridColumn(QApplication::Translate('Schedule Out'), '<?= $_CONTROL->ParentControl->dtgT3Sch_ScheduleOut_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::T3Sch()->ScheduleOut), 'ReverseOrderByClause' => QQ::OrderBy(QQN::T3Sch()->ScheduleOut, false)));
		$this->colNote = new QDataGridColumn(QApplication::Translate('Note'), '<?= QString::Truncate($_ITEM->Note, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::T3Sch()->Note), 'ReverseOrderByClause' => QQ::OrderBy(QQN::T3Sch()->Note, false)));
		$this->colInterviewerId = new QDataGridColumn(QApplication::Translate('Interviewer Id'), '<?= $_CONTROL->ParentControl->dtgT3Sch_Interviewer_Render($_ITEM); ?>');
		$this->colScheduleTypeId = new QDataGridColumn(QApplication::Translate('Schedule Type Id'), '<?= $_CONTROL->ParentControl->dtgT3Sch_ScheduleType_Render($_ITEM); ?>');
		$this->colCreatedOn = new QDataGridColumn(QApplication::Translate('Created On'), '<?= $_CONTROL->ParentControl->dtgT3Sch_CreatedOn_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::T3Sch()->CreatedOn), 'ReverseOrderByClause' => QQ::OrderBy(QQN::T3Sch()->CreatedOn, false)));

		// Setup DataGrid
		$this->dtgT3Sch = new QDataGrid($this);
		$this->dtgT3Sch->CellSpacing = 0;
		$this->dtgT3Sch->CellPadding = 4;
		$this->dtgT3Sch->BorderStyle = QBorderStyle::Solid;
		$this->dtgT3Sch->BorderWidth = 1;
		$this->dtgT3Sch->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgT3Sch->Paginator = new QPaginator($this->dtgT3Sch);
		$this->dtgT3Sch->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgT3Sch->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgT3Sch->SetDataBinder('dtgT3Sch_Bind', $this);

		$this->dtgT3Sch->AddColumn($this->colEditLinkColumn);
		$this->dtgT3Sch->AddColumn($this->colId);
		$this->dtgT3Sch->AddColumn($this->colParticipantId);
		$this->dtgT3Sch->AddColumn($this->colScheduleIn);
		$this->dtgT3Sch->AddColumn($this->colScheduleOut);
		$this->dtgT3Sch->AddColumn($this->colNote);
		$this->dtgT3Sch->AddColumn($this->colInterviewerId);
		$this->dtgT3Sch->AddColumn($this->colScheduleTypeId);
		$this->dtgT3Sch->AddColumn($this->colCreatedOn);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('T3Sch');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgT3Sch_EditLinkColumn_Render(T3Sch $objT3Sch) {
		$strControlId = 'btnEdit' . $this->dtgT3Sch->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgT3Sch, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objT3Sch->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objT3Sch = T3Sch::Load($strParameterArray[0]);

		$objEditPanel = new T3SchEditPanel($this, $this->strCloseEditPanelMethod, $objT3Sch);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new T3SchEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgT3Sch_Participant_Render(T3Sch $objT3Sch) {
		if (!is_null($objT3Sch->Participant))
			return $objT3Sch->Participant->__toString();
		else
			return null;
	}

	public function dtgT3Sch_ScheduleIn_Render(T3Sch $objT3Sch) {
		if (!is_null($objT3Sch->ScheduleIn))
			return $objT3Sch->ScheduleIn->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}

	public function dtgT3Sch_ScheduleOut_Render(T3Sch $objT3Sch) {
		if (!is_null($objT3Sch->ScheduleOut))
			return $objT3Sch->ScheduleOut->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}

	public function dtgT3Sch_Interviewer_Render(T3Sch $objT3Sch) {
		if (!is_null($objT3Sch->Interviewer))
			return $objT3Sch->Interviewer->__toString();
		else
			return null;
	}

	public function dtgT3Sch_ScheduleType_Render(T3Sch $objT3Sch) {
		if (!is_null($objT3Sch->ScheduleType))
			return $objT3Sch->ScheduleType->__toString();
		else
			return null;
	}

	public function dtgT3Sch_CreatedOn_Render(T3Sch $objT3Sch) {
		if (!is_null($objT3Sch->CreatedOn))
			return $objT3Sch->CreatedOn->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}


	public function dtgT3Sch_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgT3Sch->TotalItemCount = T3Sch::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgT3Sch->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgT3Sch->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgT3Sch->DataSource = T3Sch::LoadAll($objClauses);
	}
}
?>