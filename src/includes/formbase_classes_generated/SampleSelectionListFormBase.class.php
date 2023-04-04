<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the SampleSelection class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of SampleSelection objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleSelectionListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleSelectionListFormBase extends QForm {
		protected $dtgSampleSelection;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colParticipantSelect;
		protected $colSampleType;
		protected $colStudySelect;
		protected $colSampleSelect;
		protected $colDescription;
		protected $colLock;
		protected $colSamplesTransferred;
		protected $colDateSelected;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSampleSelection_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Id, false)));
			$this->colParticipantSelect = new QDataGridColumn(QApplication::Translate('Participant Select'), '<?= QString::Truncate($_ITEM->ParticipantSelect, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->ParticipantSelect), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->ParticipantSelect, false)));
			$this->colSampleType = new QDataGridColumn(QApplication::Translate('Sample Type'), '<?= $_ITEM->SampleType; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SampleType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SampleType, false)));
			$this->colStudySelect = new QDataGridColumn(QApplication::Translate('Study Select'), '<?= QString::Truncate($_ITEM->StudySelect, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->StudySelect), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->StudySelect, false)));
			$this->colSampleSelect = new QDataGridColumn(QApplication::Translate('Sample Select'), '<?= QString::Truncate($_ITEM->SampleSelect, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SampleSelect), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SampleSelect, false)));
			$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Description, false)));
			$this->colLock = new QDataGridColumn(QApplication::Translate('Lock'), '<?= ($_ITEM->Lock) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Lock), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->Lock, false)));
			$this->colSamplesTransferred = new QDataGridColumn(QApplication::Translate('Samples Transferred'), '<?= ($_ITEM->SamplesTransferred) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SamplesTransferred), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->SamplesTransferred, false)));
			$this->colDateSelected = new QDataGridColumn(QApplication::Translate('Date Selected'), '<?= $_FORM->dtgSampleSelection_DateSelected_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SampleSelection()->DateSelected), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SampleSelection()->DateSelected, false)));

			// Setup DataGrid
			$this->dtgSampleSelection = new QDataGrid($this);
			$this->dtgSampleSelection->CellSpacing = 0;
			$this->dtgSampleSelection->CellPadding = 4;
			$this->dtgSampleSelection->BorderStyle = QBorderStyle::Solid;
			$this->dtgSampleSelection->BorderWidth = 1;
			$this->dtgSampleSelection->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgSampleSelection->Paginator = new QPaginator($this->dtgSampleSelection);
			$this->dtgSampleSelection->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgSampleSelection->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgSampleSelection->SetDataBinder('dtgSampleSelection_Bind');

			$this->dtgSampleSelection->AddColumn($this->colEditLinkColumn);
			$this->dtgSampleSelection->AddColumn($this->colId);
			$this->dtgSampleSelection->AddColumn($this->colParticipantSelect);
			$this->dtgSampleSelection->AddColumn($this->colSampleType);
			$this->dtgSampleSelection->AddColumn($this->colStudySelect);
			$this->dtgSampleSelection->AddColumn($this->colSampleSelect);
			$this->dtgSampleSelection->AddColumn($this->colDescription);
			$this->dtgSampleSelection->AddColumn($this->colLock);
			$this->dtgSampleSelection->AddColumn($this->colSamplesTransferred);
			$this->dtgSampleSelection->AddColumn($this->colDateSelected);
		}
		
		public function dtgSampleSelection_EditLinkColumn_Render(SampleSelection $objSampleSelection) {
			return sprintf('<a href="sample_selection_edit.php?intId=%s">%s</a>',
				$objSampleSelection->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgSampleSelection_DateSelected_Render(SampleSelection $objSampleSelection) {
			if (!is_null($objSampleSelection->DateSelected))
				return $objSampleSelection->DateSelected->toString(QDateTime::FormatDisplayDate);
			else
				return null;
		}


		protected function dtgSampleSelection_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgSampleSelection->TotalItemCount = SampleSelection::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgSampleSelection->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgSampleSelection->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all SampleSelection objects, given the clauses above
			$this->dtgSampleSelection->DataSource = SampleSelection::LoadAll($objClauses);
		}
	}
?>