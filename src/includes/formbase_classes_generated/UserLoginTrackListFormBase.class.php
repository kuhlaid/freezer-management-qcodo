<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the UserLoginTrack class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of UserLoginTrack objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this UserLoginTrackListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class UserLoginTrackListFormBase extends QForm {
		protected $dtgUserLoginTrack;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colUserId;
		protected $colLoginPassed;
		protected $colAttempted;
		protected $colIp;
		protected $colUserNameAttempt;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgUserLoginTrack_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Id, false)));
			$this->colUserId = new QDataGridColumn(QApplication::Translate('User Id'), '<?= $_ITEM->UserId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->UserId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->UserId, false)));
			$this->colLoginPassed = new QDataGridColumn(QApplication::Translate('Login Passed'), '<?= ($_ITEM->LoginPassed) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->LoginPassed), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->LoginPassed, false)));
			$this->colAttempted = new QDataGridColumn(QApplication::Translate('Attempted'), '<?= $_FORM->dtgUserLoginTrack_Attempted_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Attempted), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserLoginTrack()->Attempted, false)));
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
			$this->dtgUserLoginTrack->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgUserLoginTrack->SetDataBinder('dtgUserLoginTrack_Bind');

			$this->dtgUserLoginTrack->AddColumn($this->colEditLinkColumn);
			$this->dtgUserLoginTrack->AddColumn($this->colId);
			$this->dtgUserLoginTrack->AddColumn($this->colUserId);
			$this->dtgUserLoginTrack->AddColumn($this->colLoginPassed);
			$this->dtgUserLoginTrack->AddColumn($this->colAttempted);
			$this->dtgUserLoginTrack->AddColumn($this->colIp);
			$this->dtgUserLoginTrack->AddColumn($this->colUserNameAttempt);
		}
		
		public function dtgUserLoginTrack_EditLinkColumn_Render(UserLoginTrack $objUserLoginTrack) {
			return sprintf('<a href="user_login_track_edit.php?intId=%s">%s</a>',
				$objUserLoginTrack->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgUserLoginTrack_Attempted_Render(UserLoginTrack $objUserLoginTrack) {
			if (!is_null($objUserLoginTrack->Attempted))
				return $objUserLoginTrack->Attempted->toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}


		protected function dtgUserLoginTrack_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgUserLoginTrack->TotalItemCount = UserLoginTrack::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgUserLoginTrack->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgUserLoginTrack->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all UserLoginTrack objects, given the clauses above
			$this->dtgUserLoginTrack->DataSource = UserLoginTrack::LoadAll($objClauses);
		}
	}
?>