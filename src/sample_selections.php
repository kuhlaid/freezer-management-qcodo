<?php
/**
 * @abstract Tracks the sample selection searches for freezer pulls.
 * @author w. Patrick Gale (Oct. 2015)
 *
 * - added date to the selection so we have an idea of when things were performed (Nov. 3, 2015 - wpg)
 * - added sorting by ID in descending order (Jan. 21, 2016 - wpg)
 */
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
require(__FORMBASE_CLASSES__ . '/SampleSelectionListFormBase.class.php');
QApplication::CheckRemoteAdmin();


class SampleSelectionListForm extends SampleSelectionListFormBase {
	protected function Form_Create() {

		// Setup DataGrid Columns
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleSelection_EditLinkColumn_Render($_ITEM) ?>');

		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= "SampleLog#".$_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Id, false)));
		$this->colParticipantSelect = new QDataGridColumn(QApplication::Translate('Participant Select'), '<?= QString::Truncate($_ITEM->ParticipantSelect, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->ParticipantSelect), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->ParticipantSelect, false)));
		$this->colSampleType = new QDataGridColumn(QApplication::Translate('Sample Type'), '<?= $_FORM->dtgSampleSelection_Sample_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SampleType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SampleType, false)));
		$this->colStudySelect = new QDataGridColumn(QApplication::Translate('Study Select'), '<?= $_FORM->dtgSampleSelection_Study_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->StudySelect), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->StudySelect, false)));
		$this->colSampleSelect = new QDataGridColumn(QApplication::Translate('Sample Select'), '<?= QString::Truncate($_ITEM->SampleSelect, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SampleSelect), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SampleSelect, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Description, false)));
		$this->colLock = new QDataGridColumn(QApplication::Translate('Lock'), '<?= ($_ITEM->Lock) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Lock), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Lock, false)));
		$this->colDateSelected = new QDataGridColumn(QApplication::Translate('Date Created'), '<?= $_FORM->dtgSampleSelection_DateSelected_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->DateSelected), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->DateSelected, false)));

		$this->colEditLinkColumn->HtmlEntities = $this->colStudySelect->HtmlEntities = false;

		// Setup DataGrid
		$this->dtgSampleSelection = new QDataGrid($this);
		$this->dtgSampleSelection->CellSpacing = 0;
		$this->dtgSampleSelection->CellPadding = 4;
		$this->dtgSampleSelection->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleSelection->BorderWidth = 1;
		$this->dtgSampleSelection->GridLines = QGridLines::Both;
		$this->dtgSampleSelection->CssClass='table table-bordered';

		// Datagrid Paginator
		$this->dtgSampleSelection->Paginator = new QPaginator($this->dtgSampleSelection);
		$this->dtgSampleSelection->ItemsPerPage = __ITEMS_PER_PAGE__;

		$this->dtgSampleSelection->SortColumnIndex = 2;
		$this->dtgSampleSelection->SortDirection = 1;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleSelection->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleSelection->SetDataBinder('dtgSampleSelection_Bind');

		$this->dtgSampleSelection->AddColumn($this->colEditLinkColumn);
		$this->dtgSampleSelection->AddColumn($this->colDescription);
		$this->dtgSampleSelection->AddColumn($this->colId);
		$this->dtgSampleSelection->AddColumn($this->colSampleType);
		$this->dtgSampleSelection->AddColumn($this->colStudySelect);
		$this->dtgSampleSelection->AddColumn($this->colDateSelected);
		$this->dtgSampleSelection->AddColumn($this->colLock);
	}

	public function dtgSampleSelection_EditLinkColumn_Render(SampleSelection $objSampleSelection) {
		return sprintf('<a href="sample_selection.php?intId=%s">%s</a> | <a href="find_samples.php?intSampleSelectId=%s">%s</a>',
				$objSampleSelection->Id,
				QApplication::Translate('Edit'),
				$objSampleSelection->Id,
				"Load sample search");
	}

	// show actual study names instead of IDs
	public function dtgSampleSelection_Study_Render(SampleSelection $objSampleSelection) {
		$rtn = '';
		if ($objSampleSelection->StudySelect) {
			$studyArray = explode(",",$objSampleSelection->StudySelect);
			foreach ($studyArray as $k=>$v) {
				if ($rtn != '') $rtn .= ",<br/>";
				$rtn .= FmStudy::GetName($v);
			}
		}
		return $rtn;
	}

	// show actual sample names instead of IDs
	public function dtgSampleSelection_Sample_Render(SampleSelection $objSampleSelection) {
		$rtn = '';
		if ($objSampleSelection->SampleType) {
			return SampleTypes::$NameArray[$objSampleSelection->SampleType];
		}
		return;
	}
}

// go to the centralized form executing access control function to run the form and check access control
ACL_Run('sample_selections');
?>