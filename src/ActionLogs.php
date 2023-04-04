<?php
/**
 * Aug. 20, 2020 - wpg
 * - adding action type filter
 * 
 * Sept. 19, 2019 - wpg
 * - adding an action column
 */

	// Include prepend.inc to load Qcodo
	require('includes/prepend.inc.php');
	require(__FORMBASE_CLASSES__ . '/ActionLogListFormBase.class.php');
	QApplication::CheckRemoteAdmin();


	class ActionLogListForm extends ActionLogListFormBase {
		protected $colAction, $colLogDate, $lstActionType;
		protected function Form_Create() {
			$this->lstActionType_Create();
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgActionLog_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Log Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ActionLog()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ActionLog()->Id, false)));
			$this->colJsonData = new QDataGridColumn(QApplication::Translate('Log'), '<?= $_ITEM->JsonData; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ActionLog()->JsonData), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ActionLog()->JsonData, false)));
			$this->colAction = new QDataGridColumn(QApplication::Translate('Type'), '<?= $_FORM->dtgActionLog_Action_Render($_ITEM) ?>');
			$this->colLogDate = new QDataGridColumn(QApplication::Translate('Date'), '<?= $_FORM->dtgActionLog_Date_Render($_ITEM) ?>');

			// Setup DataGrid
			$this->dtgActionLog = new QDataGrid($this);
			$this->dtgActionLog->CellSpacing = 0;
			$this->dtgActionLog->CellPadding = 4;
			$this->dtgActionLog->BorderStyle = QBorderStyle::Solid;
			$this->dtgActionLog->BorderWidth = 1;
			$this->dtgActionLog->GridLines = QGridLines::Both;
			$this->dtgActionLog->CssClass='table table-bordered';

			// Datagrid Paginator
			$this->dtgActionLog->Paginator = new QPaginator($this->dtgActionLog);
			$this->dtgActionLog->ItemsPerPage = __ITEMS_PER_PAGE__;

			$this->dtgActionLog->SortColumnIndex=0;
			$this->dtgActionLog->SortDirection = 1;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgActionLog->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgActionLog->SetDataBinder('dtgActionLog_Bind');

			$this->dtgActionLog->AddColumn($this->colId);
			$this->dtgActionLog->AddColumn($this->colAction);
			$this->dtgActionLog->AddColumn($this->colLogDate);
			$this->dtgActionLog->AddColumn($this->colJsonData);
		}

		protected function lstActionType_Create() {
			$this->lstActionType = new QListBox($this);
			$this->lstActionType->Name = QApplication::Translate('Filter by action type:');
			$this->lstActionType->CssClass = '';
			$this->lstActionType->HtmlAfter = '<br/><br/>';
			$this->lstActionType->AddItem("--all types--",null);
			$actionLogJson = json_decode(ActionLog::$strAction);
			foreach($actionLogJson as $key => $val){
				$objListItem = new QListItem($val, $key);
				//if ($key==1) $objListItem->Selected = true;
				$this->lstActionType->AddItem($objListItem);
			}
			$this->lstActionType->AddAction(new QChangeEvent(), new QServerAction('dtgActionLog_Bind'));	
		}
	

		public function dtgActionLog_Action_Render(ActionLog $objActionLog) {
			$objJsonData = json_decode($objActionLog->JsonData);
			return ActionLog::getAction($objJsonData->{'Action'});
		}

		public function dtgActionLog_Date_Render(ActionLog $objActionLog) {
			$objJsonData = json_decode($objActionLog->JsonData);
			return $objJsonData->{'LogDate'};
		}

		protected function dtgActionLog_Bind() {
			if ($this->lstActionType->SelectedValue != ''){
				// filter by box type
				$strAndCondition = "QQ::LIKE(QQN::ActionLog()->JsonData,'%\"Action\":".$this->lstActionType->SelectedValue."%')";
			}
			else $strAndCondition = "QQ::All()";
			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgActionLog->TotalItemCount = ActionLog::QueryCount(eval("return $strAndCondition;"));

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgActionLog->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgActionLog->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all ActionLog objects, given the clauses above
			$this->dtgActionLog->DataSource = ActionLog::QueryArray(eval("return $strAndCondition;"),$objClauses);
		}
		
	}
	// go to the centralized form executing access control function to run the form and check access control
	ACL_Run('ActionLogs');
?>