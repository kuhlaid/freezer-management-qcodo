<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Samples class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Samples objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SamplesListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SamplesListPanelBase extends QPanel {
	public $dtgSamples;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colId;
	protected $colCaseid;
	protected $colSamplenum;
	protected $colSamploc;
	protected $colSamptype;
	protected $colBoxid;
	protected $colUsername;
	protected $colThawed;
	protected $colOnmanifest;
	protected $colLoggedout;
	protected $colToenaildate;
	protected $colToenailshipped;
	protected $colChlclin;
	protected $colChllabcorp;
	protected $colBscbook;
	protected $colBscpage;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSamples_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Id, false)));
		$this->colCaseid = new QDataGridColumn(QApplication::Translate('Caseid'), '<?= QString::Truncate($_ITEM->Caseid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Caseid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Caseid, false)));
		$this->colSamplenum = new QDataGridColumn(QApplication::Translate('Samplenum'), '<?= QString::Truncate($_ITEM->Samplenum, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Samplenum), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Samplenum, false)));
		$this->colSamploc = new QDataGridColumn(QApplication::Translate('Samploc'), '<?= QString::Truncate($_ITEM->Samploc, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Samploc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Samploc, false)));
		$this->colSamptype = new QDataGridColumn(QApplication::Translate('Samptype'), '<?= QString::Truncate($_ITEM->Samptype, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Samptype), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Samptype, false)));
		$this->colBoxid = new QDataGridColumn(QApplication::Translate('Boxid'), '<?= $_ITEM->Boxid; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Boxid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Boxid, false)));
		$this->colUsername = new QDataGridColumn(QApplication::Translate('Username'), '<?= QString::Truncate($_ITEM->Username, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Username), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Username, false)));
		$this->colThawed = new QDataGridColumn(QApplication::Translate('Thawed'), '<?= $_ITEM->Thawed; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Thawed), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Thawed, false)));
		$this->colOnmanifest = new QDataGridColumn(QApplication::Translate('Onmanifest'), '<?= $_ITEM->Onmanifest; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Onmanifest), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Onmanifest, false)));
		$this->colLoggedout = new QDataGridColumn(QApplication::Translate('Loggedout'), '<?= $_ITEM->Loggedout; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Loggedout), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Loggedout, false)));
		$this->colToenaildate = new QDataGridColumn(QApplication::Translate('Toenaildate'), '<?= $_CONTROL->ParentControl->dtgSamples_Toenaildate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Toenaildate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Toenaildate, false)));
		$this->colToenailshipped = new QDataGridColumn(QApplication::Translate('Toenailshipped'), '<?= $_ITEM->Toenailshipped; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Toenailshipped), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Toenailshipped, false)));
		$this->colChlclin = new QDataGridColumn(QApplication::Translate('Chlclin'), '<?= $_CONTROL->ParentControl->dtgSamples_Chlclin_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Chlclin), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Chlclin, false)));
		$this->colChllabcorp = new QDataGridColumn(QApplication::Translate('Chllabcorp'), '<?= $_CONTROL->ParentControl->dtgSamples_Chllabcorp_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Chllabcorp), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Chllabcorp, false)));
		$this->colBscbook = new QDataGridColumn(QApplication::Translate('Bscbook'), '<?= QString::Truncate($_ITEM->Bscbook, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Bscbook), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Bscbook, false)));
		$this->colBscpage = new QDataGridColumn(QApplication::Translate('Bscpage'), '<?= QString::Truncate($_ITEM->Bscpage, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Samples()->Bscpage), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Samples()->Bscpage, false)));

		// Setup DataGrid
		$this->dtgSamples = new QDataGrid($this);
		$this->dtgSamples->CellSpacing = 0;
		$this->dtgSamples->CellPadding = 4;
		$this->dtgSamples->BorderStyle = QBorderStyle::Solid;
		$this->dtgSamples->BorderWidth = 1;
		$this->dtgSamples->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSamples->Paginator = new QPaginator($this->dtgSamples);
		$this->dtgSamples->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSamples->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSamples->SetDataBinder('dtgSamples_Bind', $this);

		$this->dtgSamples->AddColumn($this->colEditLinkColumn);
		$this->dtgSamples->AddColumn($this->colId);
		$this->dtgSamples->AddColumn($this->colCaseid);
		$this->dtgSamples->AddColumn($this->colSamplenum);
		$this->dtgSamples->AddColumn($this->colSamploc);
		$this->dtgSamples->AddColumn($this->colSamptype);
		$this->dtgSamples->AddColumn($this->colBoxid);
		$this->dtgSamples->AddColumn($this->colUsername);
		$this->dtgSamples->AddColumn($this->colThawed);
		$this->dtgSamples->AddColumn($this->colOnmanifest);
		$this->dtgSamples->AddColumn($this->colLoggedout);
		$this->dtgSamples->AddColumn($this->colToenaildate);
		$this->dtgSamples->AddColumn($this->colToenailshipped);
		$this->dtgSamples->AddColumn($this->colChlclin);
		$this->dtgSamples->AddColumn($this->colChllabcorp);
		$this->dtgSamples->AddColumn($this->colBscbook);
		$this->dtgSamples->AddColumn($this->colBscpage);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Samples');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSamples_EditLinkColumn_Render(Samples $objSamples) {
		$strControlId = 'btnEdit' . $this->dtgSamples->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSamples, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSamples->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSamples = Samples::Load($strParameterArray[0]);

		$objEditPanel = new SamplesEditPanel($this, $this->strCloseEditPanelMethod, $objSamples);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SamplesEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgSamples_Toenaildate_Render(Samples $objSamples) {
		if (!is_null($objSamples->Toenaildate))
			return $objSamples->Toenaildate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgSamples_Chlclin_Render(Samples $objSamples) {
		if (!is_null($objSamples->Chlclin))
			return $objSamples->Chlclin->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgSamples_Chllabcorp_Render(Samples $objSamples) {
		if (!is_null($objSamples->Chllabcorp))
			return $objSamples->Chllabcorp->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}


	public function dtgSamples_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSamples->TotalItemCount = Samples::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSamples->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSamples->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSamples->DataSource = Samples::LoadAll($objClauses);
	}
}
?>