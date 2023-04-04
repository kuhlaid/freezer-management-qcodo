<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the User class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of User objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this UserListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class UserListFormBase extends QForm {
		protected $dtgUser;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colUserid;
		protected $colUsername;
		protected $colFirstname;
		protected $colLastname;
		protected $colEmail;
		protected $colActive;
		protected $colOnyen;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgUser_EditLinkColumn_Render($_ITEM) ?>');
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
			$this->dtgUser->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgUser->SetDataBinder('dtgUser_Bind');

			$this->dtgUser->AddColumn($this->colEditLinkColumn);
			$this->dtgUser->AddColumn($this->colUserid);
			$this->dtgUser->AddColumn($this->colUsername);
			$this->dtgUser->AddColumn($this->colFirstname);
			$this->dtgUser->AddColumn($this->colLastname);
			$this->dtgUser->AddColumn($this->colEmail);
			$this->dtgUser->AddColumn($this->colActive);
			$this->dtgUser->AddColumn($this->colOnyen);
		}
		
		public function dtgUser_EditLinkColumn_Render(User $objUser) {
			return sprintf('<a href="user_edit.php?intUserid=%s">%s</a>',
				$objUser->Userid, 
				QApplication::Translate('Edit'));
		}


		protected function dtgUser_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgUser->TotalItemCount = User::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgUser->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgUser->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all User objects, given the clauses above
			$this->dtgUser->DataSource = User::LoadAll($objClauses);
		}
	}
?>