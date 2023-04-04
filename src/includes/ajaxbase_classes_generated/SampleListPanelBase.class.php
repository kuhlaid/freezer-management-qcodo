<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Sample class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Sample objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SampleListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleListPanelBase extends QPanel {
	public $dtgSample;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSample_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Id, false)));
		$this->colStudyTypeId = new QDataGridColumn(QApplication::Translate('Study Type'), '<?= $_CONTROL->ParentControl->dtgSample_StudyTypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyTypeId, false)));
		$this->colParticipantId = new QDataGridColumn(QApplication::Translate('Participant Id'), '<?= $_ITEM->ParticipantId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->ParticipantId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->ParticipantId, false)));
		$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type Id'), '<?= $_CONTROL->ParentControl->dtgSample_SampleType_Render($_ITEM); ?>');
		$this->colSampleNumber = new QDataGridColumn(QApplication::Translate('Sample Number'), '<?= $_ITEM->SampleNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->SampleNumber, false)));
		$this->colBarcode = new QDataGridColumn(QApplication::Translate('Barcode'), '<?= QString::Truncate($_ITEM->Barcode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Barcode, false)));
		$this->colStudyCase = new QDataGridColumn(QApplication::Translate('Study Case'), '<?= QString::Truncate($_ITEM->StudyCase, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->StudyCase, false)));
		$this->colSampleloc = new QDataGridColumn(QApplication::Translate('Sampleloc'), '<?= QString::Truncate($_ITEM->Sampleloc, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->Sampleloc, false)));
		$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box Id'), '<?= QString::Truncate($_ITEM->BoxId, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sample()->BoxId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sample()->BoxId, false)));

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
		$this->dtgSample->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSample->SetDataBinder('dtgSample_Bind', $this);

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

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Sample');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSample_EditLinkColumn_Render(Sample $objSample) {
		$strControlId = 'btnEdit' . $this->dtgSample->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSample, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSample->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSample = Sample::Load($strParameterArray[0]);

		$objEditPanel = new SampleEditPanel($this, $this->strCloseEditPanelMethod, $objSample);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SampleEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
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


	public function dtgSample_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSample->TotalItemCount = Sample::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSample->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSample->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSample->DataSource = Sample::LoadAll($objClauses);
	}
}
?>