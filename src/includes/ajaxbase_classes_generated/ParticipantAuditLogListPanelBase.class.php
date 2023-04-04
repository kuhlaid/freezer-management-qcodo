<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the ParticipantAuditLog class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of ParticipantAuditLog objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this ParticipantAuditLogListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class ParticipantAuditLogListPanelBase extends QPanel {
	public $dtgParticipantAuditLog;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colParticipantObj;
	protected $colModifiedDate;
	protected $colParticipantId;
	protected $colModifiedById;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgParticipantAuditLog_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ParticipantAuditLog()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ParticipantAuditLog()->Id, false)));
		$this->colParticipantObj = new QDataGridColumn(QApplication::Translate('Participant Obj'), '<?= QString::Truncate($_ITEM->ParticipantObj, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ParticipantAuditLog()->ParticipantObj), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ParticipantAuditLog()->ParticipantObj, false)));
		$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= $_CONTROL->ParentControl->dtgParticipantAuditLog_ModifiedDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ParticipantAuditLog()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ParticipantAuditLog()->ModifiedDate, false)));
		$this->colParticipantId = new QDataGridColumn(QApplication::Translate('Participant Id'), '<?= $_CONTROL->ParentControl->dtgParticipantAuditLog_Participant_Render($_ITEM); ?>');
		$this->colModifiedById = new QDataGridColumn(QApplication::Translate('Modified By Id'), '<?= $_CONTROL->ParentControl->dtgParticipantAuditLog_ModifiedBy_Render($_ITEM); ?>');

		// Setup DataGrid
		$this->dtgParticipantAuditLog = new QDataGrid($this);
		$this->dtgParticipantAuditLog->CellSpacing = 0;
		$this->dtgParticipantAuditLog->CellPadding = 4;
		$this->dtgParticipantAuditLog->BorderStyle = QBorderStyle::Solid;
		$this->dtgParticipantAuditLog->BorderWidth = 1;
		$this->dtgParticipantAuditLog->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgParticipantAuditLog->Paginator = new QPaginator($this->dtgParticipantAuditLog);
		$this->dtgParticipantAuditLog->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgParticipantAuditLog->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgParticipantAuditLog->SetDataBinder('dtgParticipantAuditLog_Bind', $this);

		$this->dtgParticipantAuditLog->AddColumn($this->colEditLinkColumn);
		$this->dtgParticipantAuditLog->AddColumn($this->colId);
		$this->dtgParticipantAuditLog->AddColumn($this->colParticipantObj);
		$this->dtgParticipantAuditLog->AddColumn($this->colModifiedDate);
		$this->dtgParticipantAuditLog->AddColumn($this->colParticipantId);
		$this->dtgParticipantAuditLog->AddColumn($this->colModifiedById);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('ParticipantAuditLog');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgParticipantAuditLog_EditLinkColumn_Render(ParticipantAuditLog $objParticipantAuditLog) {
		$strControlId = 'btnEdit' . $this->dtgParticipantAuditLog->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgParticipantAuditLog, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objParticipantAuditLog->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objParticipantAuditLog = ParticipantAuditLog::Load($strParameterArray[0]);

		$objEditPanel = new ParticipantAuditLogEditPanel($this, $this->strCloseEditPanelMethod, $objParticipantAuditLog);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new ParticipantAuditLogEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgParticipantAuditLog_ModifiedDate_Render(ParticipantAuditLog $objParticipantAuditLog) {
		if (!is_null($objParticipantAuditLog->ModifiedDate))
			return $objParticipantAuditLog->ModifiedDate->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}

	public function dtgParticipantAuditLog_Participant_Render(ParticipantAuditLog $objParticipantAuditLog) {
		if (!is_null($objParticipantAuditLog->Participant))
			return $objParticipantAuditLog->Participant->__toString();
		else
			return null;
	}

	public function dtgParticipantAuditLog_ModifiedBy_Render(ParticipantAuditLog $objParticipantAuditLog) {
		if (!is_null($objParticipantAuditLog->ModifiedBy))
			return $objParticipantAuditLog->ModifiedBy->__toString();
		else
			return null;
	}


	public function dtgParticipantAuditLog_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgParticipantAuditLog->TotalItemCount = ParticipantAuditLog::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgParticipantAuditLog->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgParticipantAuditLog->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgParticipantAuditLog->DataSource = ParticipantAuditLog::LoadAll($objClauses);
	}
}
?>