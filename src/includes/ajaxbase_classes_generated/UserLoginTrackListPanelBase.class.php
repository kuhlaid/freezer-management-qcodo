<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the UserLoginTrack class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of UserLoginTrack objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this UserLoginTrackListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class UserLoginTrackListPanelBase extends QPanel {
	public $dtgUserLoginTrack;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colUserId;
	protected $colLoginPassed;
	protected $colAttempted;
	protected $colIp;
	protected $colUserNameAttempt;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgUserLoginTrack_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Id, false)));
		$this->colUserId = new QDataGridColumn(QApplication::Translate('User Id'), '<?= $_ITEM->UserId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->UserId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->UserId, false)));
		$this->colLoginPassed = new QDataGridColumn(QApplication::Translate('Login Passed'), '<?= ($_ITEM->LoginPassed) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->LoginPassed), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->LoginPassed, false)));
		$this->colAttempted = new QDataGridColumn(QApplication::Translate('Attempted'), '<?= $_CONTROL->ParentControl->dtgUserLoginTrack_Attempted_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Attempted), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Attempted, false)));
		$this->colIp = new QDataGridColumn(QApplication::Translate('Ip'), '<?= QString::Truncate($_ITEM->Ip, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Ip), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Ip, false)));
		$this->colUserNameAttempt = new QDataGridColumn(QApplication::Translate('User Name Attempt'), '<?= QString::Truncate($_ITEM->UserNameAttempt, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->UserNameAttempt), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->UserNameAttempt, false)));

		// Setup DataGrid
		$this->dtgUserLoginTrack = new QDataGrid($this);
		$this->dtgUserLoginTrack->CellSpacing = 0;
		$this->dtgUserLoginTrack->CellPadding = 4;
		$this->dtgUserLoginTrack->BorderStyle = QBorderStyle::Solid;
		$this->dtgUserLoginTrack->BorderWidth = 1;
		$this->dtgUserLoginTrack->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgUserLoginTrack->Paginator = new QPaginator($this->dtgUserLoginTrack);
		$this->dtgUserLoginTrack->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgUserLoginTrack->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgUserLoginTrack->SetDataBinder('dtgUserLoginTrack_Bind', $this);

		$this->dtgUserLoginTrack->AddColumn($this->colEditLinkColumn);
		$this->dtgUserLoginTrack->AddColumn($this->colId);
		$this->dtgUserLoginTrack->AddColumn($this->colUserId);
		$this->dtgUserLoginTrack->AddColumn($this->colLoginPassed);
		$this->dtgUserLoginTrack->AddColumn($this->colAttempted);
		$this->dtgUserLoginTrack->AddColumn($this->colIp);
		$this->dtgUserLoginTrack->AddColumn($this->colUserNameAttempt);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('UserLoginTrack');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgUserLoginTrack_EditLinkColumn_Render(UserLoginTrack $objUserLoginTrack) {
		$strControlId = 'btnEdit' . $this->dtgUserLoginTrack->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgUserLoginTrack, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objUserLoginTrack->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objUserLoginTrack = UserLoginTrack::Load($strParameterArray[0]);

		$objEditPanel = new UserLoginTrackEditPanel($this, $this->strCloseEditPanelMethod, $objUserLoginTrack);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new UserLoginTrackEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgUserLoginTrack_Attempted_Render(UserLoginTrack $objUserLoginTrack) {
		if (!is_null($objUserLoginTrack->Attempted))
			return $objUserLoginTrack->Attempted->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}


	public function dtgUserLoginTrack_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgUserLoginTrack->TotalItemCount = UserLoginTrack::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgUserLoginTrack->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgUserLoginTrack->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgUserLoginTrack->DataSource = UserLoginTrack::LoadAll($objClauses);
	}
}
?>