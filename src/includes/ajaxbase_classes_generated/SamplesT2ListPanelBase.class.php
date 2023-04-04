<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the SamplesT2 class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of SamplesT2 objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SamplesT2ListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SamplesT2ListPanelBase extends QPanel {
	public $dtgSamplesT2;
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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSamplesT2_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Id, false)));
		$this->colCaseid = new QDataGridColumn(QApplication::Translate('Caseid'), '<?= QString::Truncate($_ITEM->Caseid, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Caseid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Caseid, false)));
		$this->colSamplenum = new QDataGridColumn(QApplication::Translate('Samplenum'), '<?= QString::Truncate($_ITEM->Samplenum, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Samplenum), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Samplenum, false)));
		$this->colSamploc = new QDataGridColumn(QApplication::Translate('Samploc'), '<?= QString::Truncate($_ITEM->Samploc, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Samploc), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Samploc, false)));
		$this->colSamptype = new QDataGridColumn(QApplication::Translate('Samptype'), '<?= QString::Truncate($_ITEM->Samptype, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Samptype), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Samptype, false)));
		$this->colBoxid = new QDataGridColumn(QApplication::Translate('Boxid'), '<?= $_ITEM->Boxid; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Boxid), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Boxid, false)));
		$this->colUsername = new QDataGridColumn(QApplication::Translate('Username'), '<?= QString::Truncate($_ITEM->Username, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Username), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Username, false)));
		$this->colThawed = new QDataGridColumn(QApplication::Translate('Thawed'), '<?= $_ITEM->Thawed; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Thawed), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Thawed, false)));
		$this->colOnmanifest = new QDataGridColumn(QApplication::Translate('Onmanifest'), '<?= $_ITEM->Onmanifest; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Onmanifest), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Onmanifest, false)));
		$this->colLoggedout = new QDataGridColumn(QApplication::Translate('Loggedout'), '<?= $_ITEM->Loggedout; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Loggedout), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Loggedout, false)));
		$this->colToenaildate = new QDataGridColumn(QApplication::Translate('Toenaildate'), '<?= $_CONTROL->ParentControl->dtgSamplesT2_Toenaildate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Toenaildate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Toenaildate, false)));
		$this->colToenailshipped = new QDataGridColumn(QApplication::Translate('Toenailshipped'), '<?= $_ITEM->Toenailshipped; ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Toenailshipped), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Toenailshipped, false)));
		$this->colChlclin = new QDataGridColumn(QApplication::Translate('Chlclin'), '<?= $_CONTROL->ParentControl->dtgSamplesT2_Chlclin_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Chlclin), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Chlclin, false)));
		$this->colChllabcorp = new QDataGridColumn(QApplication::Translate('Chllabcorp'), '<?= $_CONTROL->ParentControl->dtgSamplesT2_Chllabcorp_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Chllabcorp), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Chllabcorp, false)));
		$this->colBscbook = new QDataGridColumn(QApplication::Translate('Bscbook'), '<?= QString::Truncate($_ITEM->Bscbook, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Bscbook), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Bscbook, false)));
		$this->colBscpage = new QDataGridColumn(QApplication::Translate('Bscpage'), '<?= QString::Truncate($_ITEM->Bscpage, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Bscpage), 'ReverseOrderByClause' => QQ::OrderBy(QQN::SamplesT2()->Bscpage, false)));

		// Setup DataGrid
		$this->dtgSamplesT2 = new QDataGrid($this);
		$this->dtgSamplesT2->CellSpacing = 0;
		$this->dtgSamplesT2->CellPadding = 4;
		$this->dtgSamplesT2->BorderStyle = QBorderStyle::Solid;
		$this->dtgSamplesT2->BorderWidth = 1;
		$this->dtgSamplesT2->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSamplesT2->Paginator = new QPaginator($this->dtgSamplesT2);
		$this->dtgSamplesT2->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSamplesT2->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSamplesT2->SetDataBinder('dtgSamplesT2_Bind', $this);

		$this->dtgSamplesT2->AddColumn($this->colEditLinkColumn);
		$this->dtgSamplesT2->AddColumn($this->colId);
		$this->dtgSamplesT2->AddColumn($this->colCaseid);
		$this->dtgSamplesT2->AddColumn($this->colSamplenum);
		$this->dtgSamplesT2->AddColumn($this->colSamploc);
		$this->dtgSamplesT2->AddColumn($this->colSamptype);
		$this->dtgSamplesT2->AddColumn($this->colBoxid);
		$this->dtgSamplesT2->AddColumn($this->colUsername);
		$this->dtgSamplesT2->AddColumn($this->colThawed);
		$this->dtgSamplesT2->AddColumn($this->colOnmanifest);
		$this->dtgSamplesT2->AddColumn($this->colLoggedout);
		$this->dtgSamplesT2->AddColumn($this->colToenaildate);
		$this->dtgSamplesT2->AddColumn($this->colToenailshipped);
		$this->dtgSamplesT2->AddColumn($this->colChlclin);
		$this->dtgSamplesT2->AddColumn($this->colChllabcorp);
		$this->dtgSamplesT2->AddColumn($this->colBscbook);
		$this->dtgSamplesT2->AddColumn($this->colBscpage);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('SamplesT2');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSamplesT2_EditLinkColumn_Render(SamplesT2 $objSamplesT2) {
		$strControlId = 'btnEdit' . $this->dtgSamplesT2->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSamplesT2, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSamplesT2->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSamplesT2 = SamplesT2::Load($strParameterArray[0]);

		$objEditPanel = new SamplesT2EditPanel($this, $this->strCloseEditPanelMethod, $objSamplesT2);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SamplesT2EditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgSamplesT2_Toenaildate_Render(SamplesT2 $objSamplesT2) {
		if (!is_null($objSamplesT2->Toenaildate))
			return $objSamplesT2->Toenaildate->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgSamplesT2_Chlclin_Render(SamplesT2 $objSamplesT2) {
		if (!is_null($objSamplesT2->Chlclin))
			return $objSamplesT2->Chlclin->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}

	public function dtgSamplesT2_Chllabcorp_Render(SamplesT2 $objSamplesT2) {
		if (!is_null($objSamplesT2->Chllabcorp))
			return $objSamplesT2->Chllabcorp->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}


	public function dtgSamplesT2_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSamplesT2->TotalItemCount = SamplesT2::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSamplesT2->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSamplesT2->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSamplesT2->DataSource = SamplesT2::LoadAll($objClauses);
	}
}
?>