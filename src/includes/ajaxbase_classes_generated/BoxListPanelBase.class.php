<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Box class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Box objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this BoxListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class BoxListPanelBase extends QPanel {
	public $dtgBox;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colName;
	protected $colRackId;
	protected $colShelf;
	protected $colFreezer;
	protected $colId;
	protected $colIssues;
	protected $colDescription;
	protected $colBoxTypeId;
	protected $colSampleTypeId;
	protected $colCreated;
	protected $colPreparedById;
	protected $colComplete;
	protected $colClinicShipmentId;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgBox_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Name, false)));
		$this->colRackId = new QDataGridColumn(QApplication::Translate('Rack Id'), '<?= $_CONTROL->ParentControl->dtgBox_Rack_Render($_ITEM); ?>');
		$this->colShelf = new QDataGridColumn(QApplication::Translate('Shelf'), '<?= $_ITEM->Shelf; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Shelf), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Shelf, false)));
		$this->colFreezer = new QDataGridColumn(QApplication::Translate('Freezer'), '<?= $_ITEM->Freezer; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Freezer), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Freezer, false)));
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Id, false)));
		$this->colIssues = new QDataGridColumn(QApplication::Translate('Issues'), '<?= QString::Truncate($_ITEM->Issues, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Issues), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Issues, false)));
		$this->colDescription = new QDataGridColumn(QApplication::Translate('Description'), '<?= QString::Truncate($_ITEM->Description, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Description, false)));
		$this->colBoxTypeId = new QDataGridColumn(QApplication::Translate('Box Type Id'), '<?= $_CONTROL->ParentControl->dtgBox_BoxType_Render($_ITEM); ?>');
		$this->colSampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type Id'), '<?= $_CONTROL->ParentControl->dtgBox_SampleType_Render($_ITEM); ?>');
		$this->colCreated = new QDataGridColumn(QApplication::Translate('Created'), '<?= $_CONTROL->ParentControl->dtgBox_Created_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Created), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Created, false)));
		$this->colPreparedById = new QDataGridColumn(QApplication::Translate('Prepared By Id'), '<?= $_ITEM->PreparedById; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->PreparedById), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->PreparedById, false)));
		$this->colComplete = new QDataGridColumn(QApplication::Translate('Complete'), '<?= ($_ITEM->Complete) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Complete), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Complete, false)));
		$this->colClinicShipmentId = new QDataGridColumn(QApplication::Translate('Clinic Shipment Id'), '<?= $_CONTROL->ParentControl->dtgBox_ClinicShipment_Render($_ITEM); ?>');

		// Setup DataGrid
		$this->dtgBox = new QDataGrid($this);
		$this->dtgBox->CellSpacing = 0;
		$this->dtgBox->CellPadding = 4;
		$this->dtgBox->BorderStyle = QBorderStyle::Solid;
		$this->dtgBox->BorderWidth = 1;
		$this->dtgBox->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgBox->Paginator = new QPaginator($this->dtgBox);
		$this->dtgBox->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgBox->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgBox->SetDataBinder('dtgBox_Bind', $this);

		$this->dtgBox->AddColumn($this->colEditLinkColumn);
		$this->dtgBox->AddColumn($this->colName);
		$this->dtgBox->AddColumn($this->colRackId);
		$this->dtgBox->AddColumn($this->colShelf);
		$this->dtgBox->AddColumn($this->colFreezer);
		$this->dtgBox->AddColumn($this->colId);
		$this->dtgBox->AddColumn($this->colIssues);
		$this->dtgBox->AddColumn($this->colDescription);
		$this->dtgBox->AddColumn($this->colBoxTypeId);
		$this->dtgBox->AddColumn($this->colSampleTypeId);
		$this->dtgBox->AddColumn($this->colCreated);
		$this->dtgBox->AddColumn($this->colPreparedById);
		$this->dtgBox->AddColumn($this->colComplete);
		$this->dtgBox->AddColumn($this->colClinicShipmentId);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Box');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgBox_EditLinkColumn_Render(Box $objBox) {
		$strControlId = 'btnEdit' . $this->dtgBox->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgBox, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objBox->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objBox = Box::Load($strParameterArray[0]);

		$objEditPanel = new BoxEditPanel($this, $this->strCloseEditPanelMethod, $objBox);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new BoxEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgBox_Rack_Render(Box $objBox) {
		if (!is_null($objBox->Rack))
			return $objBox->Rack->__toString();
		else
			return null;
	}

	public function dtgBox_BoxType_Render(Box $objBox) {
		if (!is_null($objBox->BoxType))
			return $objBox->BoxType->__toString();
		else
			return null;
	}

	public function dtgBox_SampleType_Render(Box $objBox) {
		if (!is_null($objBox->SampleType))
			return $objBox->SampleType->__toString();
		else
			return null;
	}

	public function dtgBox_Created_Render(Box $objBox) {
		if (!is_null($objBox->Created))
			return $objBox->Created->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}

	public function dtgBox_ClinicShipment_Render(Box $objBox) {
		if (!is_null($objBox->ClinicShipment))
			return $objBox->ClinicShipment->__toString();
		else
			return null;
	}


	public function dtgBox_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgBox->TotalItemCount = Box::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgBox->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgBox->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgBox->DataSource = Box::LoadAll($objClauses);
	}
}
?>