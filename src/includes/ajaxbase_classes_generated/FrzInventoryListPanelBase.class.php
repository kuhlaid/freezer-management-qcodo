<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the FrzInventory class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of FrzInventory objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this FrzInventoryListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class FrzInventoryListPanelBase extends QPanel {
	public $dtgFrzInventory;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgFrzInventory_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colSampleid = new QDataGridColumn(QApplication::Translate('Sampleid'), '<?= QString::Truncate($_ITEM->Sampleid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Sampleid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Sampleid, false)));
		$this->colSampleloc = new QDataGridColumn(QApplication::Translate('Sampleloc'), '<?= QString::Truncate($_ITEM->Sampleloc, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Sampleloc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Sampleloc, false)));
		$this->colBoxid = new QDataGridColumn(QApplication::Translate('Boxid'), '<?= QString::Truncate($_ITEM->Boxid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Boxid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Boxid, false)));
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Id, false)));
		$this->colStudy = new QDataGridColumn(QApplication::Translate('Study'), '<?= QString::Truncate($_ITEM->Study, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Study), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->Study, false)));
		$this->colStudyCase = new QDataGridColumn(QApplication::Translate('Study Case'), '<?= QString::Truncate($_ITEM->StudyCase, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->StudyCase), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->StudyCase, false)));
		$this->colSampleType = new QDataGridColumn(QApplication::Translate('Sample Type'), '<?= QString::Truncate($_ITEM->SampleType, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleType, false)));
		$this->colSampleNumber = new QDataGridColumn(QApplication::Translate('Sample Number'), '<?= $_ITEM->SampleNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::FrzInventory()->SampleNumber, false)));
		$this->colBoxIdent = new QDataGridColumn(QApplication::Translate('Box Ident'), '<?= $_CONTROL->ParentControl->dtgFrzInventory_BoxIdentObject_Render($_ITEM); ?>');
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
		$this->dtgFrzInventory->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgFrzInventory->SetDataBinder('dtgFrzInventory_Bind', $this);

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

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('FrzInventory');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgFrzInventory_EditLinkColumn_Render(FrzInventory $objFrzInventory) {
		$strControlId = 'btnEdit' . $this->dtgFrzInventory->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgFrzInventory, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objFrzInventory->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objFrzInventory = FrzInventory::Load($strParameterArray[0]);

		$objEditPanel = new FrzInventoryEditPanel($this, $this->strCloseEditPanelMethod, $objFrzInventory);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new FrzInventoryEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgFrzInventory_BoxIdentObject_Render(FrzInventory $objFrzInventory) {
		if (!is_null($objFrzInventory->BoxIdentObject))
			return $objFrzInventory->BoxIdentObject->__toString();
		else
			return null;
	}


	public function dtgFrzInventory_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgFrzInventory->TotalItemCount = FrzInventory::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgFrzInventory->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgFrzInventory->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgFrzInventory->DataSource = FrzInventory::LoadAll($objClauses);
	}
}
?>