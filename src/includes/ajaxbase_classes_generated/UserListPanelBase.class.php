<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the User class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of User objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this UserListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class UserListPanelBase extends QPanel {
	public $dtgUser;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colUserid;
	protected $colUsername;
	protected $colFirstname;
	protected $colLastname;
	protected $colEmail;
	protected $colActive;
	protected $colOnyen;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgUser_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colUserid = new QDataGridColumn(QApplication::Translate('Userid'), '<?= $_ITEM->Userid; ?>', array('OrderByClause' => QQ::OrderBy(QQN::User()->Userid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::User()->Userid, false)));
		$this->colUsername = new QDataGridColumn(QApplication::Translate('Username'), '<?= QString::Truncate($_ITEM->Username, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::User()->Username), 'ReverseOrderByClause' => QQ::OrderBy(QQN::User()->Username, false)));
		$this->colFirstname = new QDataGridColumn(QApplication::Translate('Firstname'), '<?= QString::Truncate($_ITEM->Firstname, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::User()->Firstname), 'ReverseOrderByClause' => QQ::OrderBy(QQN::User()->Firstname, false)));
		$this->colLastname = new QDataGridColumn(QApplication::Translate('Lastname'), '<?= QString::Truncate($_ITEM->Lastname, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::User()->Lastname), 'ReverseOrderByClause' => QQ::OrderBy(QQN::User()->Lastname, false)));
		$this->colEmail = new QDataGridColumn(QApplication::Translate('Email'), '<?= QString::Truncate($_ITEM->Email, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::User()->Email), 'ReverseOrderByClause' => QQ::OrderBy(QQN::User()->Email, false)));
		$this->colActive = new QDataGridColumn(QApplication::Translate('Active'), '<?= $_ITEM->Active; ?>', array('OrderByClause' => QQ::OrderBy(QQN::User()->Active), 'ReverseOrderByClause' => QQ::OrderBy(QQN::User()->Active, false)));
		$this->colOnyen = new QDataGridColumn(QApplication::Translate('Onyen'), '<?= QString::Truncate($_ITEM->Onyen, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::User()->Onyen), 'ReverseOrderByClause' => QQ::OrderBy(QQN::User()->Onyen, false)));

		// Setup DataGrid
		$this->dtgUser = new QDataGrid($this);
		$this->dtgUser->CellSpacing = 0;
		$this->dtgUser->CellPadding = 4;
		$this->dtgUser->BorderStyle = QBorderStyle::Solid;
		$this->dtgUser->BorderWidth = 1;
		$this->dtgUser->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgUser->Paginator = new QPaginator($this->dtgUser);
		$this->dtgUser->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgUser->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgUser->SetDataBinder('dtgUser_Bind', $this);

		$this->dtgUser->AddColumn($this->colEditLinkColumn);
		$this->dtgUser->AddColumn($this->colUserid);
		$this->dtgUser->AddColumn($this->colUsername);
		$this->dtgUser->AddColumn($this->colFirstname);
		$this->dtgUser->AddColumn($this->colLastname);
		$this->dtgUser->AddColumn($this->colEmail);
		$this->dtgUser->AddColumn($this->colActive);
		$this->dtgUser->AddColumn($this->colOnyen);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('User');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgUser_EditLinkColumn_Render(User $objUser) {
		$strControlId = 'btnEdit' . $this->dtgUser->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgUser, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objUser->Userid;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objUser = User::Load($strParameterArray[0]);

		$objEditPanel = new UserEditPanel($this, $this->strCloseEditPanelMethod, $objUser);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new UserEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}


	public function dtgUser_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgUser->TotalItemCount = User::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgUser->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgUser->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgUser->DataSource = User::LoadAll($objClauses);
	}
}
?>