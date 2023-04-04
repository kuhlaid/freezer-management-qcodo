<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Sampleboxes class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Sampleboxes objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SampleboxesListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SampleboxesListPanelBase extends QPanel {
	public $dtgSampleboxes;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colIncounty;
	protected $colIncountydate;
	protected $colCountyuser;
	protected $colChapelhilluser;
	protected $colIntransit;
	protected $colIntransitdate;
	protected $colTrackingnum;
	protected $colReadytoship;
	protected $colReadytoshipdate;
	protected $colInchapelhill;
	protected $colIncdc;
	protected $colIncdcdate;
	protected $colCdcuser;
	protected $colInchapelhilldate;
	protected $colSamptype;
	protected $colFreezer;
	protected $colRack;
	protected $colBox;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSampleboxes_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Id, false)));
		$this->colIncounty = new QDataGridColumn(QApplication::Translate('Incounty'), '<?= $_ITEM->Incounty; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Incounty), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Incounty, false)));
		$this->colIncountydate = new QDataGridColumn(QApplication::Translate('Incountydate'), '<?= $_CONTROL->ParentControl->dtgSampleboxes_Incountydate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Incountydate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Incountydate, false)));
		$this->colCountyuser = new QDataGridColumn(QApplication::Translate('Countyuser'), '<?= QString::Truncate($_ITEM->Countyuser, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Countyuser), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Countyuser, false)));
		$this->colChapelhilluser = new QDataGridColumn(QApplication::Translate('Chapelhilluser'), '<?= QString::Truncate($_ITEM->Chapelhilluser, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Chapelhilluser), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Chapelhilluser, false)));
		$this->colIntransit = new QDataGridColumn(QApplication::Translate('Intransit'), '<?= $_ITEM->Intransit; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Intransit), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Intransit, false)));
		$this->colIntransitdate = new QDataGridColumn(QApplication::Translate('Intransitdate'), '<?= $_CONTROL->ParentControl->dtgSampleboxes_Intransitdate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Intransitdate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Intransitdate, false)));
		$this->colTrackingnum = new QDataGridColumn(QApplication::Translate('Trackingnum'), '<?= QString::Truncate($_ITEM->Trackingnum, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Trackingnum), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Trackingnum, false)));
		$this->colReadytoship = new QDataGridColumn(QApplication::Translate('Readytoship'), '<?= $_ITEM->Readytoship; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Readytoship), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Readytoship, false)));
		$this->colReadytoshipdate = new QDataGridColumn(QApplication::Translate('Readytoshipdate'), '<?= $_CONTROL->ParentControl->dtgSampleboxes_Readytoshipdate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Readytoshipdate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Readytoshipdate, false)));
		$this->colInchapelhill = new QDataGridColumn(QApplication::Translate('Inchapelhill'), '<?= $_ITEM->Inchapelhill; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Inchapelhill), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Inchapelhill, false)));
		$this->colIncdc = new QDataGridColumn(QApplication::Translate('Incdc'), '<?= $_ITEM->Incdc; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Incdc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Incdc, false)));
		$this->colIncdcdate = new QDataGridColumn(QApplication::Translate('Incdcdate'), '<?= $_CONTROL->ParentControl->dtgSampleboxes_Incdcdate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Incdcdate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Incdcdate, false)));
		$this->colCdcuser = new QDataGridColumn(QApplication::Translate('Cdcuser'), '<?= QString::Truncate($_ITEM->Cdcuser, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Cdcuser), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Cdcuser, false)));
		$this->colInchapelhilldate = new QDataGridColumn(QApplication::Translate('Inchapelhilldate'), '<?= $_CONTROL->ParentControl->dtgSampleboxes_Inchapelhilldate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Inchapelhilldate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Inchapelhilldate, false)));
		$this->colSamptype = new QDataGridColumn(QApplication::Translate('Samptype'), '<?= QString::Truncate($_ITEM->Samptype, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Samptype), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Samptype, false)));
		$this->colFreezer = new QDataGridColumn(QApplication::Translate('Freezer'), '<?= QString::Truncate($_ITEM->Freezer, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Freezer), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Freezer, false)));
		$this->colRack = new QDataGridColumn(QApplication::Translate('Rack'), '<?= QString::Truncate($_ITEM->Rack, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Rack), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Rack, false)));
		$this->colBox = new QDataGridColumn(QApplication::Translate('Box'), '<?= QString::Truncate($_ITEM->Box, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Box), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleboxes()->Box, false)));

		// Setup DataGrid
		$this->dtgSampleboxes = new QDataGrid($this);
		$this->dtgSampleboxes->CellSpacing = 0;
		$this->dtgSampleboxes->CellPadding = 4;
		$this->dtgSampleboxes->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleboxes->BorderWidth = 1;
		$this->dtgSampleboxes->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSampleboxes->Paginator = new QPaginator($this->dtgSampleboxes);
		$this->dtgSampleboxes->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleboxes->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleboxes->SetDataBinder('dtgSampleboxes_Bind', $this);

		$this->dtgSampleboxes->AddColumn($this->colEditLinkColumn);
		$this->dtgSampleboxes->AddColumn($this->colId);
		$this->dtgSampleboxes->AddColumn($this->colIncounty);
		$this->dtgSampleboxes->AddColumn($this->colIncountydate);
		$this->dtgSampleboxes->AddColumn($this->colCountyuser);
		$this->dtgSampleboxes->AddColumn($this->colChapelhilluser);
		$this->dtgSampleboxes->AddColumn($this->colIntransit);
		$this->dtgSampleboxes->AddColumn($this->colIntransitdate);
		$this->dtgSampleboxes->AddColumn($this->colTrackingnum);
		$this->dtgSampleboxes->AddColumn($this->colReadytoship);
		$this->dtgSampleboxes->AddColumn($this->colReadytoshipdate);
		$this->dtgSampleboxes->AddColumn($this->colInchapelhill);
		$this->dtgSampleboxes->AddColumn($this->colIncdc);
		$this->dtgSampleboxes->AddColumn($this->colIncdcdate);
		$this->dtgSampleboxes->AddColumn($this->colCdcuser);
		$this->dtgSampleboxes->AddColumn($this->colInchapelhilldate);
		$this->dtgSampleboxes->AddColumn($this->colSamptype);
		$this->dtgSampleboxes->AddColumn($this->colFreezer);
		$this->dtgSampleboxes->AddColumn($this->colRack);
		$this->dtgSampleboxes->AddColumn($this->colBox);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Sampleboxes');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSampleboxes_EditLinkColumn_Render(Sampleboxes $objSampleboxes) {
		$strControlId = 'btnEdit' . $this->dtgSampleboxes->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSampleboxes, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSampleboxes->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSampleboxes = Sampleboxes::Load($strParameterArray[0]);

		$objEditPanel = new SampleboxesEditPanel($this, $this->strCloseEditPanelMethod, $objSampleboxes);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SampleboxesEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgSampleboxes_Incountydate_Render(Sampleboxes $objSampleboxes) {
		if (!is_null($objSampleboxes->Incountydate))
			return $objSampleboxes->Incountydate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgSampleboxes_Intransitdate_Render(Sampleboxes $objSampleboxes) {
		if (!is_null($objSampleboxes->Intransitdate))
			return $objSampleboxes->Intransitdate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgSampleboxes_Readytoshipdate_Render(Sampleboxes $objSampleboxes) {
		if (!is_null($objSampleboxes->Readytoshipdate))
			return $objSampleboxes->Readytoshipdate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgSampleboxes_Incdcdate_Render(Sampleboxes $objSampleboxes) {
		if (!is_null($objSampleboxes->Incdcdate))
			return $objSampleboxes->Incdcdate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgSampleboxes_Inchapelhilldate_Render(Sampleboxes $objSampleboxes) {
		if (!is_null($objSampleboxes->Inchapelhilldate))
			return $objSampleboxes->Inchapelhilldate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}


	public function dtgSampleboxes_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSampleboxes->TotalItemCount = Sampleboxes::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSampleboxes->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSampleboxes->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSampleboxes->DataSource = Sampleboxes::LoadAll($objClauses);
	}
}
?>