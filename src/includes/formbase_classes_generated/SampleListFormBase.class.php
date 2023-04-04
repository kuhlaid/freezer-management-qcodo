<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Sample class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Sample objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this SampleListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class SampleListFormBase extends QForm {
		protected $dtgSample;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colStudyTypeId;
		protected $colParticipantId;
		protected $colSampleTypeId;
		protected $colSampleNumber;
		protected $colBarcode;
		protected $colStudyCase;
		protected $colSampleloc;
		protected $colBoxId;
		protected $colNotes;
		protected $colBoxSampleSlot;
		protected $colParentId;
		protected $colContainerTypeId;
		protected $colStateTypeId;
		protected $colVolume;
		protected $colVolumeUnit;
		protected $colConcentration;
		protected $colConcentrationUnit;
		protected $colStateDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgSample_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Id, false)));
			$this->colStudyTypeId = new QDataGridColumn(QApplication::Translate('Study Type'), '<?= $_FORM->dtgSample_StudyTypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId, false)));
			$this->colParticipantId = new QDataGridColumn(QApplication::Translate('Participant Id'), '<?= $_ITEM->ParticipantId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ParticipantId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ParticipantId, false)));
			$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type Id'), '<?= $_FORM->dtgSample_SampleType_Render($_ITEM); ?>');
			$this->colSampleNumber = new QDataGridColumn(QApplication::Translate('Sample Number'), '<?= $_ITEM->SampleNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber, false)));
			$this->colBarcode = new QDataGridColumn(QApplication::Translate('Barcode'), '<?= QString::Truncate($_ITEM->Barcode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode, false)));
			$this->colStudyCase = new QDataGridColumn(QApplication::Translate('Study Case'), '<?= QString::Truncate($_ITEM->StudyCase, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase, false)));
			$this->colSampleloc = new QDataGridColumn(QApplication::Translate('Sampleloc'), '<?= QString::Truncate($_ITEM->Sampleloc, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc, false)));
			$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box Id'), '<?= $_FORM->dtgSample_Box_Render($_ITEM); ?>');
			$this->colNotes = new QDataGridColumn(QApplication::Translate('Notes'), '<?= QString::Truncate($_ITEM->Notes, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Notes), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Notes, false)));
			$this->colBoxSampleSlot = new QDataGridColumn(QApplication::Translate('Box Sample Slot'), '<?= $_ITEM->BoxSampleSlot; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->BoxSampleSlot), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->BoxSampleSlot, false)));
			$this->colParentId = new QDataGridColumn(QApplication::Translate('Parent Id'), '<?= $_ITEM->ParentId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ParentId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ParentId, false)));
			$this->colContainerTypeId = new QDataGridColumn(QApplication::Translate('Container Type Id'), '<?= $_FORM->dtgSample_ContainerType_Render($_ITEM); ?>');
			$this->colStateTypeId = new QDataGridColumn(QApplication::Translate('State Type Id'), '<?= $_FORM->dtgSample_StateType_Render($_ITEM); ?>');
			$this->colVolume = new QDataGridColumn(QApplication::Translate('Volume'), '<?= $_ITEM->Volume; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Volume), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Volume, false)));
			$this->colVolumeUnit = new QDataGridColumn(QApplication::Translate('Volume Unit'), '<?= QString::Truncate($_ITEM->VolumeUnit, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->VolumeUnit), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->VolumeUnit, false)));
			$this->colConcentration = new QDataGridColumn(QApplication::Translate('Concentration'), '<?= $_ITEM->Concentration; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Concentration), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Concentration, false)));
			$this->colConcentrationUnit = new QDataGridColumn(QApplication::Translate('Concentration Unit'), '<?= QString::Truncate($_ITEM->ConcentrationUnit, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ConcentrationUnit), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ConcentrationUnit, false)));
			$this->colStateDate = new QDataGridColumn(QApplication::Translate('State Date'), '<?= $_FORM->dtgSample_StateDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StateDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StateDate, false)));

			// Setup DataGrid
			$this->dtgSample = new QDataGrid($this);
			$this->dtgSample->CellSpacing = 0;
			$this->dtgSample->CellPadding = 4;
			$this->dtgSample->BorderStyle = QBorderStyle::Solid;
			$this->dtgSample->BorderWidth = 1;
			$this->dtgSample->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgSample->Paginator = new QPaginator($this->dtgSample);
			$this->dtgSample->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgSample->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgSample->SetDataBinder('dtgSample_Bind');

			$this->dtgSample->AddColumn($this->colEditLinkColumn);
			$this->dtgSample->AddColumn($this->colId);
			$this->dtgSample->AddColumn($this->colStudyTypeId);
			$this->dtgSample->AddColumn($this->colParticipantId);
			$this->dtgSample->AddColumn($this->colSampleTypeId);
			$this->dtgSample->AddColumn($this->colSampleNumber);
			$this->dtgSample->AddColumn($this->colBarcode);
			$this->dtgSample->AddColumn($this->colStudyCase);
			$this->dtgSample->AddColumn($this->colSampleloc);
			$this->dtgSample->AddColumn($this->colBoxId);
			$this->dtgSample->AddColumn($this->colNotes);
			$this->dtgSample->AddColumn($this->colBoxSampleSlot);
			$this->dtgSample->AddColumn($this->colParentId);
			$this->dtgSample->AddColumn($this->colContainerTypeId);
			$this->dtgSample->AddColumn($this->colStateTypeId);
			$this->dtgSample->AddColumn($this->colVolume);
			$this->dtgSample->AddColumn($this->colVolumeUnit);
			$this->dtgSample->AddColumn($this->colConcentration);
			$this->dtgSample->AddColumn($this->colConcentrationUnit);
			$this->dtgSample->AddColumn($this->colStateDate);
		}
		
		public function dtgSample_EditLinkColumn_Render(Sample $objSample) {
			return sprintf('<a href="sample_edit.php?intId=%s">%s</a>',
				$objSample->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgSample_StudyTypeId_Render(Sample $objSample) {
			if (!is_null($objSample->StudyTypeId))
				return FmStudy::GetName($objSample->StudyTypeId);
			else
				return null;
		}

		public function dtgSample_SampleType_Render(Sample $objSample) {
			if (!is_null($objSample->SampleType))
				return $objSample->SampleType->__toString();
			else
				return null;
		}

		public function dtgSample_Box_Render(Sample $objSample) {
			if (!is_null($objSample->Box))
				return $objSample->Box->__toString();
			else
				return null;
		}

		public function dtgSample_ContainerType_Render(Sample $objSample) {
			if (!is_null($objSample->ContainerType))
				return $objSample->ContainerType->__toString();
			else
				return null;
		}

		public function dtgSample_StateType_Render(Sample $objSample) {
			if (!is_null($objSample->StateType))
				return $objSample->StateType->__toString();
			else
				return null;
		}

		public function dtgSample_StateDate_Render(Sample $objSample) {
			if (!is_null($objSample->StateDate))
				return $objSample->StateDate->toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}


		protected function dtgSample_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgSample->TotalItemCount = Sample::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgSample->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgSample->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Sample objects, given the clauses above
			$this->dtgSample->DataSource = Sample::LoadAll($objClauses);
		}
	}
?>