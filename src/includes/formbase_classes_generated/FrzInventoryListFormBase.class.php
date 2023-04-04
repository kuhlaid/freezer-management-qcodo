<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the FrzInventory class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of FrzInventory objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FrzInventoryListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FrzInventoryListFormBase extends QForm {
		protected $dtgFrzInventory;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colSampleid;
		protected $colSampleloc;
		protected $colBoxid;
		protected $colId;
		protected $colStudy;
		protected $colStudyCase;
		protected $colSampleType;
		protected $colSampleNumber;
		protected $colBoxIdent;
		protected $colStudyTypeId;
		protected $colSampleTypeId;
		protected $colParticipantId;
		protected $colSampleLocId;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgFrzInventory_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colSampleid = new QDataGridColumn(QApplication::Translate('Sampleid'), '<?= QString::Truncate($_ITEM->Sampleid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Sampleid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Sampleid, false)));
			$this->colSampleloc = new QDataGridColumn(QApplication::Translate('Sampleloc'), '<?= QString::Truncate($_ITEM->Sampleloc, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Sampleloc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Sampleloc, false)));
			$this->colBoxid = new QDataGridColumn(QApplication::Translate('Boxid'), '<?= QString::Truncate($_ITEM->Boxid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Boxid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Boxid, false)));
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Id, false)));
			$this->colStudy = new QDataGridColumn(QApplication::Translate('Study'), '<?= QString::Truncate($_ITEM->Study, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Study), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Study, false)));
			$this->colStudyCase = new QDataGridColumn(QApplication::Translate('Study Case'), '<?= QString::Truncate($_ITEM->StudyCase, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->StudyCase), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->StudyCase, false)));
			$this->colSampleType = new QDataGridColumn(QApplication::Translate('Sample Type'), '<?= QString::Truncate($_ITEM->SampleType, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleType, false)));
			$this->colSampleNumber = new QDataGridColumn(QApplication::Translate('Sample Number'), '<?= $_ITEM->SampleNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleNumber, false)));
			$this->colBoxIdent = new QDataGridColumn(QApplication::Translate('Box Ident'), '<?= $_FORM->dtgFrzInventory_BoxIdentObject_Render($_ITEM); ?>');
			$this->colStudyTypeId = new QDataGridColumn(QApplication::Translate('Study Type Id'), '<?= $_ITEM->StudyTypeId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->StudyTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->StudyTypeId, false)));
			$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type Id'), '<?= $_ITEM->SampleTypeId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleTypeId, false)));
			$this->colParticipantId = new QDataGridColumn(QApplication::Translate('Participant Id'), '<?= $_ITEM->ParticipantId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->ParticipantId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->ParticipantId, false)));
			$this->colSampleLocId = new QDataGridColumn(QApplication::Translate('Sample Loc Id'), '<?= $_ITEM->SampleLocId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleLocId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleLocId, false)));

			// Setup DataGrid
			$this->dtgFrzInventory = new QDataGrid($this);
			$this->dtgFrzInventory->CellSpacing = 0;
			$this->dtgFrzInventory->CellPadding = 4;
			$this->dtgFrzInventory->BorderStyle = QBorderStyle::Solid;
			$this->dtgFrzInventory->BorderWidth = 1;
			$this->dtgFrzInventory->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgFrzInventory->Paginator = new QPaginator($this->dtgFrzInventory);
			$this->dtgFrzInventory->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgFrzInventory->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgFrzInventory->SetDataBinder('dtgFrzInventory_Bind');

			$this->dtgFrzInventory->AddColumn($this->colEditLinkColumn);
			$this->dtgFrzInventory->AddColumn($this->colSampleid);
			$this->dtgFrzInventory->AddColumn($this->colSampleloc);
			$this->dtgFrzInventory->AddColumn($this->colBoxid);
			$this->dtgFrzInventory->AddColumn($this->colId);
			$this->dtgFrzInventory->AddColumn($this->colStudy);
			$this->dtgFrzInventory->AddColumn($this->colStudyCase);
			$this->dtgFrzInventory->AddColumn($this->colSampleType);
			$this->dtgFrzInventory->AddColumn($this->colSampleNumber);
			$this->dtgFrzInventory->AddColumn($this->colBoxIdent);
			$this->dtgFrzInventory->AddColumn($this->colStudyTypeId);
			$this->dtgFrzInventory->AddColumn($this->colSampleTypeId);
			$this->dtgFrzInventory->AddColumn($this->colParticipantId);
			$this->dtgFrzInventory->AddColumn($this->colSampleLocId);
		}
		
		public function dtgFrzInventory_EditLinkColumn_Render(FrzInventory $objFrzInventory) {
			return sprintf('<a href="frz_inventory_edit.php?intId=%s">%s</a>',
				$objFrzInventory->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgFrzInventory_BoxIdentObject_Render(FrzInventory $objFrzInventory) {
			if (!is_null($objFrzInventory->BoxIdentObject))
				return $objFrzInventory->BoxIdentObject->__toString();
			else
				return null;
		}


		protected function dtgFrzInventory_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgFrzInventory->TotalItemCount = FrzInventory::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgFrzInventory->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgFrzInventory->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all FrzInventory objects, given the clauses above
			$this->dtgFrzInventory->DataSource = FrzInventory::LoadAll($objClauses);
		}
	}
?>