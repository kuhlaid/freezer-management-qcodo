<?php
/**
 * @abstract Lists the names of studies/projects for the freezer samples.
 * 
 */
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/FmStudyListFormBase.class.php');
QApplication::CheckRemoteAdmin();


class FmStudyListForm8 extends FmStudyListFormBase {
    protected function Form_Create() {
        // Setup DataGrid Columns
        $this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFmStudy_EditLinkColumn_Render($_ITEM) ?>');
        $this->colEditLinkColumn->HtmlEntities = false;
        $this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmStudy()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmStudy()->Id, false)));
        $this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmStudy()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmStudy()->Name, false)));

        // Setup DataGrid
        $this->dtgFmStudy = new QDataGrid($this);
        $this->dtgFmStudy->CellSpacing = 0;
        $this->dtgFmStudy->CellPadding = 4;
        $this->dtgFmStudy->BorderStyle = QBorderStyle::Solid;
        $this->dtgFmStudy->BorderWidth = 1;
        $this->dtgFmStudy->GridLines = QGridLines::Both;
        $this->dtgFmStudy->CssClass='table table-bordered';

        // Datagrid Paginator
        $this->dtgFmStudy->Paginator = new QPaginator($this->dtgFmStudy);
        $this->dtgFmStudy->ItemsPerPage = 10;

        // Specify Whether or Not to Refresh using Ajax
        $this->dtgFmStudy->UseAjax = false;

        // Specify the local databind method this datagrid will use
        $this->dtgFmStudy->SetDataBinder('dtgFmStudy_Bind');

        $this->dtgFmStudy->AddColumn($this->colEditLinkColumn);
        $this->dtgFmStudy->AddColumn($this->colId);
        $this->dtgFmStudy->AddColumn($this->colName);
    }

    public function dtgFmStudy_EditLinkColumn_Render(FmStudy $objFmStudy) {
		return sprintf('<a href="study_project.php?intId=%s">%s</a>',
            $objFmStudy->Id,
			QApplication::Translate('Edit'));
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('study_project_list');
?>