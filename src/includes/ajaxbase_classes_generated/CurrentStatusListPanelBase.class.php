<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the CurrentStatus class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of CurrentStatus objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this CurrentStatusListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class CurrentStatusListPanelBase extends QPanel {
	public $dtgCurrentStatus;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colChanged;
	protected $colCode;
	protected $colParticipantId;
	protected $colSetReasonId;
	protected $colReasonOther;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCurrentStatus_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->Id, false)));
		$this->colChanged = new QDataGridColumn(QApplication::Translate('Changed'), '<?= $_CONTROL->ParentControl->dtgCurrentStatus_Changed_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->Changed), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->Changed, false)));
		$this->colCode = new QDataGridColumn(QApplication::Translate('Code'), '<?= $_ITEM->Code; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->Code), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->Code, false)));
		$this->colParticipantId = new QDataGridColumn(QApplication::Translate('Participant Id'), '<?= $_CONTROL->ParentControl->dtgCurrentStatus_Participant_Render($_ITEM); ?>');
		$this->colSetReasonId = new QDataGridColumn(QApplication::Translate('Set Reason Id'), '<?= $_ITEM->SetReasonId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->SetReasonId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->SetReasonId, false)));
		$this->colReasonOther = new QDataGridColumn(QApplication::Translate('Reason Other'), '<?= QString::Truncate($_ITEM->ReasonOther, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->ReasonOther), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CurrentStatus()->ReasonOther, false)));

		// Setup DataGrid
		$this->dtgCurrentStatus = new QDataGrid($this);
		$this->dtgCurrentStatus->CellSpacing = 0;
		$this->dtgCurrentStatus->CellPadding = 4;
		$this->dtgCurrentStatus->BorderStyle = QBorderStyle::Solid;
		$this->dtgCurrentStatus->BorderWidth = 1;
		$this->dtgCurrentStatus->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgCurrentStatus->Paginator = new QPaginator($this->dtgCurrentStatus);
		$this->dtgCurrentStatus->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgCurrentStatus->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgCurrentStatus->SetDataBinder('dtgCurrentStatus_Bind', $this);

		$this->dtgCurrentStatus->AddColumn($this->colEditLinkColumn);
		$this->dtgCurrentStatus->AddColumn($this->colId);
		$this->dtgCurrentStatus->AddColumn($this->colChanged);
		$this->dtgCurrentStatus->AddColumn($this->colCode);
		$this->dtgCurrentStatus->AddColumn($this->colParticipantId);
		$this->dtgCurrentStatus->AddColumn($this->colSetReasonId);
		$this->dtgCurrentStatus->AddColumn($this->colReasonOther);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('CurrentStatus');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgCurrentStatus_EditLinkColumn_Render(CurrentStatus $objCurrentStatus) {
		$strControlId = 'btnEdit' . $this->dtgCurrentStatus->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgCurrentStatus, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objCurrentStatus->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objCurrentStatus = CurrentStatus::Load($strParameterArray[0]);

		$objEditPanel = new CurrentStatusEditPanel($this, $this->strCloseEditPanelMethod, $objCurrentStatus);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new CurrentStatusEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgCurrentStatus_Changed_Render(CurrentStatus $objCurrentStatus) {
		if (!is_null($objCurrentStatus->Changed))
			return $objCurrentStatus->Changed->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}

	public function dtgCurrentStatus_Participant_Render(CurrentStatus $objCurrentStatus) {
		if (!is_null($objCurrentStatus->Participant))
			return $objCurrentStatus->Participant->__toString();
		else
			return null;
	}


	public function dtgCurrentStatus_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgCurrentStatus->TotalItemCount = CurrentStatus::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgCurrentStatus->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgCurrentStatus->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgCurrentStatus->DataSource = CurrentStatus::LoadAll($objClauses);
	}
}
?>