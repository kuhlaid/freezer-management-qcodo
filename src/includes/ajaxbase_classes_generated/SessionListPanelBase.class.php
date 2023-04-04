<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Session class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Session objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SessionListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SessionListPanelBase extends QPanel {
	public $dtgSession;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colSessionData;
	protected $colLastAccess;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSession_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= QString::Truncate($_ITEM->Id, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Session()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Session()->Id, false)));
		$this->colSessionData = new QDataGridColumn(QApplication::Translate('Session Data'), '<?= QString::Truncate($_ITEM->SessionData, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Session()->SessionData), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Session()->SessionData, false)));
		$this->colLastAccess = new QDataGridColumn(QApplication::Translate('Last Access'), '<?= $_CONTROL->ParentControl->dtgSession_LastAccess_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Session()->LastAccess), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Session()->LastAccess, false)));

		// Setup DataGrid
		$this->dtgSession = new QDataGrid($this);
		$this->dtgSession->CellSpacing = 0;
		$this->dtgSession->CellPadding = 4;
		$this->dtgSession->BorderStyle = QBorderStyle::Solid;
		$this->dtgSession->BorderWidth = 1;
		$this->dtgSession->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSession->Paginator = new QPaginator($this->dtgSession);
		$this->dtgSession->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSession->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSession->SetDataBinder('dtgSession_Bind', $this);

		$this->dtgSession->AddColumn($this->colEditLinkColumn);
		$this->dtgSession->AddColumn($this->colId);
		$this->dtgSession->AddColumn($this->colSessionData);
		$this->dtgSession->AddColumn($this->colLastAccess);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Session');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSession_EditLinkColumn_Render(Session $objSession) {
		$strControlId = 'btnEdit' . $this->dtgSession->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSession, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSession->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSession = Session::Load($strParameterArray[0]);

		$objEditPanel = new SessionEditPanel($this, $this->strCloseEditPanelMethod, $objSession);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SessionEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgSession_LastAccess_Render(Session $objSession) {
		if (!is_null($objSession->LastAccess))
			return $objSession->LastAccess->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}


	public function dtgSession_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSession->TotalItemCount = Session::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSession->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSession->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSession->DataSource = Session::LoadAll($objClauses);
	}
}
?>