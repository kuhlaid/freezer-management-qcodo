<?php
/**
 * @abstract This lists the 
 */

// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/FmBoxSampleConfigListFormBase.class.php');
QApplication::CheckRemoteAdmin();


class FmBoxSampleConfigListForm8 extends FmBoxSampleConfigListFormBase {
    protected function Form_Create() {
        // Setup DataGrid Columns
        $this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFmBoxSampleConfig_EditLinkColumn_Render($_ITEM) ?>');
        $this->colEditLinkColumn->HtmlEntities = false;
        $this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Id, false)));
        $this->colConfig = new QDataGridColumn(QApplication::Translate('Config'), '<?= QString::Truncate($_ITEM->Config, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Config), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Config, false)));
        $this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FmBoxSampleConfig()->Description, false)));

        // Setup DataGrid
        $this->dtgFmBoxSampleConfig = new QDataGrid($this);
        $this->dtgFmBoxSampleConfig->CellSpacing = 0;
        $this->dtgFmBoxSampleConfig->CellPadding = 4;
        $this->dtgFmBoxSampleConfig->BorderStyle = QBorderStyle::Solid;
        $this->dtgFmBoxSampleConfig->BorderWidth = 1;
        $this->dtgFmBoxSampleConfig->GridLines = QGridLines::Both;
        $this->dtgFmBoxSampleConfig->CssClass='table table-bordered';

        // Datagrid Paginator
        $this->dtgFmBoxSampleConfig->Paginator = new QPaginator($this->dtgFmBoxSampleConfig);
        $this->dtgFmBoxSampleConfig->ItemsPerPage = __ITEMS_PER_PAGE__;

        // Specify Whether or Not to Refresh using Ajax
        $this->dtgFmBoxSampleConfig->UseAjax = false;

        // Specify the local databind method this datagrid will use
        $this->dtgFmBoxSampleConfig->SetDataBinder('dtgFmBoxSampleConfig_Bind');

        $this->dtgFmBoxSampleConfig->AddColumn($this->colEditLinkColumn);
        $this->dtgFmBoxSampleConfig->AddColumn($this->colId);
        $this->dtgFmBoxSampleConfig->AddColumn($this->colConfig);
        $this->dtgFmBoxSampleConfig->AddColumn($this->colDescription);
    }
    
    public function dtgFmBoxSampleConfig_EditLinkColumn_Render(FmBoxSampleConfig $objFmBoxSampleConfig) {
        return sprintf('<a href="box_sample_config.php?intId=%s">%s</a>',
            $objFmBoxSampleConfig->Id, 
            QApplication::Translate('Edit'));
    }
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('box_sample_configs');
?>