<?php
/**
 * This is the abstract Panel class for the List All functionality
 * of the Sampleloc class.  This code-generated class
 * contains a datagrid to display an HTML page that can
 * list a collection of Sampleloc objects.  It includes
 * functionality to perform pagination and sorting on columns.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new QPanel which extends this SamplelocListPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SamplelocListPanelBase extends QPanel {
	public $dtgSampleloc;
	public $btnCreateNew;

	// Callback Method Names
	protected $strSetEditPanelMethod;
	protected $strCloseEditPanelMethod;

	// DataGrid Columns
	protected $colEditLinkColumn;
	protected $colBoxId;
	protected $colSamptype;
	protected $colA0;
	protected $colA1;
	protected $colA2;
	protected $colA3;
	protected $colA4;
	protected $colA5;
	protected $colA6;
	protected $colA7;
	protected $colA8;
	protected $colB0;
	protected $colB1;
	protected $colB2;
	protected $colB3;
	protected $colB4;
	protected $colB5;
	protected $colB6;
	protected $colB7;
	protected $colB8;
	protected $colC0;
	protected $colC1;
	protected $colC2;
	protected $colC3;
	protected $colC4;
	protected $colC5;
	protected $colC6;
	protected $colC7;
	protected $colC8;
	protected $colD0;
	protected $colD1;
	protected $colD2;
	protected $colD3;
	protected $colD4;
	protected $colD5;
	protected $colD6;
	protected $colD7;
	protected $colD8;
	protected $colE0;
	protected $colE1;
	protected $colE2;
	protected $colE3;
	protected $colE4;
	protected $colE5;
	protected $colE6;
	protected $colE7;
	protected $colE8;
	protected $colF0;
	protected $colF1;
	protected $colF2;
	protected $colF3;
	protected $colF4;
	protected $colF5;
	protected $colF6;
	protected $colF7;
	protected $colF8;
	protected $colG0;
	protected $colG1;
	protected $colG2;
	protected $colG3;
	protected $colG4;
	protected $colG5;
	protected $colG6;
	protected $colG7;
	protected $colG8;
	protected $colH0;
	protected $colH1;
	protected $colH2;
	protected $colH3;
	protected $colH4;
	protected $colH5;
	protected $colH6;
	protected $colH7;
	protected $colH8;
	protected $colI0;
	protected $colI1;
	protected $colI2;
	protected $colI3;
	protected $colI4;
	protected $colI5;
	protected $colI6;
	protected $colI7;
	protected $colI8;
	protected $colUsername;
	protected $colDate;
	protected $colId;

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
		$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgSampleloc_EditLinkColumn_Render($_ITEM) ?>');
		$this->colEditLinkColumn->HtmlEntities = false;
		$this->colBoxId = new QDataGridColumn(QApplication::Translate('Box Id'), '<?= $_CONTROL->ParentControl->dtgSampleloc_Box_Render($_ITEM); ?>');
		$this->colSamptype = new QDataGridColumn(QApplication::Translate('Samptype'), '<?= QString::Truncate($_ITEM->Samptype, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->Samptype), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->Samptype, false)));
		$this->colA0 = new QDataGridColumn(QApplication::Translate('A 0'), '<?= QString::Truncate($_ITEM->A0, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A0), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A0, false)));
		$this->colA1 = new QDataGridColumn(QApplication::Translate('A 1'), '<?= QString::Truncate($_ITEM->A1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A1, false)));
		$this->colA2 = new QDataGridColumn(QApplication::Translate('A 2'), '<?= QString::Truncate($_ITEM->A2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A2, false)));
		$this->colA3 = new QDataGridColumn(QApplication::Translate('A 3'), '<?= QString::Truncate($_ITEM->A3, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A3), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A3, false)));
		$this->colA4 = new QDataGridColumn(QApplication::Translate('A 4'), '<?= QString::Truncate($_ITEM->A4, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A4), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A4, false)));
		$this->colA5 = new QDataGridColumn(QApplication::Translate('A 5'), '<?= QString::Truncate($_ITEM->A5, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A5), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A5, false)));
		$this->colA6 = new QDataGridColumn(QApplication::Translate('A 6'), '<?= QString::Truncate($_ITEM->A6, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A6), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A6, false)));
		$this->colA7 = new QDataGridColumn(QApplication::Translate('A 7'), '<?= QString::Truncate($_ITEM->A7, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A7), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A7, false)));
		$this->colA8 = new QDataGridColumn(QApplication::Translate('A 8'), '<?= QString::Truncate($_ITEM->A8, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A8), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->A8, false)));
		$this->colB0 = new QDataGridColumn(QApplication::Translate('B 0'), '<?= QString::Truncate($_ITEM->B0, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B0), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B0, false)));
		$this->colB1 = new QDataGridColumn(QApplication::Translate('B 1'), '<?= QString::Truncate($_ITEM->B1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B1, false)));
		$this->colB2 = new QDataGridColumn(QApplication::Translate('B 2'), '<?= QString::Truncate($_ITEM->B2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B2, false)));
		$this->colB3 = new QDataGridColumn(QApplication::Translate('B 3'), '<?= QString::Truncate($_ITEM->B3, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B3), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B3, false)));
		$this->colB4 = new QDataGridColumn(QApplication::Translate('B 4'), '<?= QString::Truncate($_ITEM->B4, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B4), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B4, false)));
		$this->colB5 = new QDataGridColumn(QApplication::Translate('B 5'), '<?= QString::Truncate($_ITEM->B5, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B5), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B5, false)));
		$this->colB6 = new QDataGridColumn(QApplication::Translate('B 6'), '<?= QString::Truncate($_ITEM->B6, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B6), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B6, false)));
		$this->colB7 = new QDataGridColumn(QApplication::Translate('B 7'), '<?= QString::Truncate($_ITEM->B7, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B7), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B7, false)));
		$this->colB8 = new QDataGridColumn(QApplication::Translate('B 8'), '<?= QString::Truncate($_ITEM->B8, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B8), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->B8, false)));
		$this->colC0 = new QDataGridColumn(QApplication::Translate('C 0'), '<?= QString::Truncate($_ITEM->C0, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C0), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C0, false)));
		$this->colC1 = new QDataGridColumn(QApplication::Translate('C 1'), '<?= QString::Truncate($_ITEM->C1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C1, false)));
		$this->colC2 = new QDataGridColumn(QApplication::Translate('C 2'), '<?= QString::Truncate($_ITEM->C2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C2, false)));
		$this->colC3 = new QDataGridColumn(QApplication::Translate('C 3'), '<?= QString::Truncate($_ITEM->C3, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C3), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C3, false)));
		$this->colC4 = new QDataGridColumn(QApplication::Translate('C 4'), '<?= QString::Truncate($_ITEM->C4, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C4), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C4, false)));
		$this->colC5 = new QDataGridColumn(QApplication::Translate('C 5'), '<?= QString::Truncate($_ITEM->C5, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C5), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C5, false)));
		$this->colC6 = new QDataGridColumn(QApplication::Translate('C 6'), '<?= QString::Truncate($_ITEM->C6, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C6), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C6, false)));
		$this->colC7 = new QDataGridColumn(QApplication::Translate('C 7'), '<?= QString::Truncate($_ITEM->C7, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C7), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C7, false)));
		$this->colC8 = new QDataGridColumn(QApplication::Translate('C 8'), '<?= QString::Truncate($_ITEM->C8, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C8), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->C8, false)));
		$this->colD0 = new QDataGridColumn(QApplication::Translate('D 0'), '<?= QString::Truncate($_ITEM->D0, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D0), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D0, false)));
		$this->colD1 = new QDataGridColumn(QApplication::Translate('D 1'), '<?= QString::Truncate($_ITEM->D1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D1, false)));
		$this->colD2 = new QDataGridColumn(QApplication::Translate('D 2'), '<?= QString::Truncate($_ITEM->D2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D2, false)));
		$this->colD3 = new QDataGridColumn(QApplication::Translate('D 3'), '<?= QString::Truncate($_ITEM->D3, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D3), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D3, false)));
		$this->colD4 = new QDataGridColumn(QApplication::Translate('D 4'), '<?= QString::Truncate($_ITEM->D4, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D4), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D4, false)));
		$this->colD5 = new QDataGridColumn(QApplication::Translate('D 5'), '<?= QString::Truncate($_ITEM->D5, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D5), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D5, false)));
		$this->colD6 = new QDataGridColumn(QApplication::Translate('D 6'), '<?= QString::Truncate($_ITEM->D6, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D6), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D6, false)));
		$this->colD7 = new QDataGridColumn(QApplication::Translate('D 7'), '<?= QString::Truncate($_ITEM->D7, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D7), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D7, false)));
		$this->colD8 = new QDataGridColumn(QApplication::Translate('D 8'), '<?= QString::Truncate($_ITEM->D8, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D8), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->D8, false)));
		$this->colE0 = new QDataGridColumn(QApplication::Translate('E 0'), '<?= QString::Truncate($_ITEM->E0, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E0), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E0, false)));
		$this->colE1 = new QDataGridColumn(QApplication::Translate('E 1'), '<?= QString::Truncate($_ITEM->E1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E1, false)));
		$this->colE2 = new QDataGridColumn(QApplication::Translate('E 2'), '<?= QString::Truncate($_ITEM->E2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E2, false)));
		$this->colE3 = new QDataGridColumn(QApplication::Translate('E 3'), '<?= QString::Truncate($_ITEM->E3, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E3), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E3, false)));
		$this->colE4 = new QDataGridColumn(QApplication::Translate('E 4'), '<?= QString::Truncate($_ITEM->E4, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E4), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E4, false)));
		$this->colE5 = new QDataGridColumn(QApplication::Translate('E 5'), '<?= QString::Truncate($_ITEM->E5, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E5), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E5, false)));
		$this->colE6 = new QDataGridColumn(QApplication::Translate('E 6'), '<?= QString::Truncate($_ITEM->E6, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E6), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E6, false)));
		$this->colE7 = new QDataGridColumn(QApplication::Translate('E 7'), '<?= QString::Truncate($_ITEM->E7, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E7), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E7, false)));
		$this->colE8 = new QDataGridColumn(QApplication::Translate('E 8'), '<?= QString::Truncate($_ITEM->E8, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E8), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->E8, false)));
		$this->colF0 = new QDataGridColumn(QApplication::Translate('F 0'), '<?= QString::Truncate($_ITEM->F0, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F0), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F0, false)));
		$this->colF1 = new QDataGridColumn(QApplication::Translate('F 1'), '<?= QString::Truncate($_ITEM->F1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F1, false)));
		$this->colF2 = new QDataGridColumn(QApplication::Translate('F 2'), '<?= QString::Truncate($_ITEM->F2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F2, false)));
		$this->colF3 = new QDataGridColumn(QApplication::Translate('F 3'), '<?= QString::Truncate($_ITEM->F3, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F3), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F3, false)));
		$this->colF4 = new QDataGridColumn(QApplication::Translate('F 4'), '<?= QString::Truncate($_ITEM->F4, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F4), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F4, false)));
		$this->colF5 = new QDataGridColumn(QApplication::Translate('F 5'), '<?= QString::Truncate($_ITEM->F5, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F5), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F5, false)));
		$this->colF6 = new QDataGridColumn(QApplication::Translate('F 6'), '<?= QString::Truncate($_ITEM->F6, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F6), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F6, false)));
		$this->colF7 = new QDataGridColumn(QApplication::Translate('F 7'), '<?= QString::Truncate($_ITEM->F7, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F7), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F7, false)));
		$this->colF8 = new QDataGridColumn(QApplication::Translate('F 8'), '<?= QString::Truncate($_ITEM->F8, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F8), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->F8, false)));
		$this->colG0 = new QDataGridColumn(QApplication::Translate('G 0'), '<?= QString::Truncate($_ITEM->G0, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G0), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G0, false)));
		$this->colG1 = new QDataGridColumn(QApplication::Translate('G 1'), '<?= QString::Truncate($_ITEM->G1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G1, false)));
		$this->colG2 = new QDataGridColumn(QApplication::Translate('G 2'), '<?= QString::Truncate($_ITEM->G2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G2, false)));
		$this->colG3 = new QDataGridColumn(QApplication::Translate('G 3'), '<?= QString::Truncate($_ITEM->G3, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G3), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G3, false)));
		$this->colG4 = new QDataGridColumn(QApplication::Translate('G 4'), '<?= QString::Truncate($_ITEM->G4, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G4), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G4, false)));
		$this->colG5 = new QDataGridColumn(QApplication::Translate('G 5'), '<?= QString::Truncate($_ITEM->G5, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G5), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G5, false)));
		$this->colG6 = new QDataGridColumn(QApplication::Translate('G 6'), '<?= QString::Truncate($_ITEM->G6, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G6), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G6, false)));
		$this->colG7 = new QDataGridColumn(QApplication::Translate('G 7'), '<?= QString::Truncate($_ITEM->G7, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G7), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G7, false)));
		$this->colG8 = new QDataGridColumn(QApplication::Translate('G 8'), '<?= QString::Truncate($_ITEM->G8, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G8), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->G8, false)));
		$this->colH0 = new QDataGridColumn(QApplication::Translate('H 0'), '<?= QString::Truncate($_ITEM->H0, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H0), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H0, false)));
		$this->colH1 = new QDataGridColumn(QApplication::Translate('H 1'), '<?= QString::Truncate($_ITEM->H1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H1, false)));
		$this->colH2 = new QDataGridColumn(QApplication::Translate('H 2'), '<?= QString::Truncate($_ITEM->H2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H2, false)));
		$this->colH3 = new QDataGridColumn(QApplication::Translate('H 3'), '<?= QString::Truncate($_ITEM->H3, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H3), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H3, false)));
		$this->colH4 = new QDataGridColumn(QApplication::Translate('H 4'), '<?= QString::Truncate($_ITEM->H4, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H4), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H4, false)));
		$this->colH5 = new QDataGridColumn(QApplication::Translate('H 5'), '<?= QString::Truncate($_ITEM->H5, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H5), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H5, false)));
		$this->colH6 = new QDataGridColumn(QApplication::Translate('H 6'), '<?= QString::Truncate($_ITEM->H6, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H6), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H6, false)));
		$this->colH7 = new QDataGridColumn(QApplication::Translate('H 7'), '<?= QString::Truncate($_ITEM->H7, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H7), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H7, false)));
		$this->colH8 = new QDataGridColumn(QApplication::Translate('H 8'), '<?= QString::Truncate($_ITEM->H8, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H8), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->H8, false)));
		$this->colI0 = new QDataGridColumn(QApplication::Translate('I 0'), '<?= QString::Truncate($_ITEM->I0, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I0), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I0, false)));
		$this->colI1 = new QDataGridColumn(QApplication::Translate('I 1'), '<?= QString::Truncate($_ITEM->I1, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I1), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I1, false)));
		$this->colI2 = new QDataGridColumn(QApplication::Translate('I 2'), '<?= QString::Truncate($_ITEM->I2, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I2), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I2, false)));
		$this->colI3 = new QDataGridColumn(QApplication::Translate('I 3'), '<?= QString::Truncate($_ITEM->I3, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I3), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I3, false)));
		$this->colI4 = new QDataGridColumn(QApplication::Translate('I 4'), '<?= QString::Truncate($_ITEM->I4, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I4), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I4, false)));
		$this->colI5 = new QDataGridColumn(QApplication::Translate('I 5'), '<?= QString::Truncate($_ITEM->I5, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I5), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I5, false)));
		$this->colI6 = new QDataGridColumn(QApplication::Translate('I 6'), '<?= QString::Truncate($_ITEM->I6, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I6), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I6, false)));
		$this->colI7 = new QDataGridColumn(QApplication::Translate('I 7'), '<?= QString::Truncate($_ITEM->I7, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I7), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I7, false)));
		$this->colI8 = new QDataGridColumn(QApplication::Translate('I 8'), '<?= QString::Truncate($_ITEM->I8, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I8), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->I8, false)));
		$this->colUsername = new QDataGridColumn(QApplication::Translate('Username'), '<?= QString::Truncate($_ITEM->Username, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->Username), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->Username, false)));
		$this->colDate = new QDataGridColumn(QApplication::Translate('Date'), '<?= $_CONTROL->ParentControl->dtgSampleloc_Date_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->Date), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->Date, false)));
		$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Sampleloc()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Sampleloc()->Id, false)));

		// Setup DataGrid
		$this->dtgSampleloc = new QDataGrid($this);
		$this->dtgSampleloc->CellSpacing = 0;
		$this->dtgSampleloc->CellPadding = 4;
		$this->dtgSampleloc->BorderStyle = QBorderStyle::Solid;
		$this->dtgSampleloc->BorderWidth = 1;
		$this->dtgSampleloc->GridLines = QGridLines::Both;

		// Datagrid Paginator
		$this->dtgSampleloc->Paginator = new QPaginator($this->dtgSampleloc);
		$this->dtgSampleloc->ItemsPerPage = 10;

		// Specify Whether or Not to Refresh using Ajax
		$this->dtgSampleloc->UseAjax = true;

		// Specify the local databind method this datagrid will use
		$this->dtgSampleloc->SetDataBinder('dtgSampleloc_Bind', $this);

		$this->dtgSampleloc->AddColumn($this->colEditLinkColumn);
		$this->dtgSampleloc->AddColumn($this->colBoxId);
		$this->dtgSampleloc->AddColumn($this->colSamptype);
		$this->dtgSampleloc->AddColumn($this->colA0);
		$this->dtgSampleloc->AddColumn($this->colA1);
		$this->dtgSampleloc->AddColumn($this->colA2);
		$this->dtgSampleloc->AddColumn($this->colA3);
		$this->dtgSampleloc->AddColumn($this->colA4);
		$this->dtgSampleloc->AddColumn($this->colA5);
		$this->dtgSampleloc->AddColumn($this->colA6);
		$this->dtgSampleloc->AddColumn($this->colA7);
		$this->dtgSampleloc->AddColumn($this->colA8);
		$this->dtgSampleloc->AddColumn($this->colB0);
		$this->dtgSampleloc->AddColumn($this->colB1);
		$this->dtgSampleloc->AddColumn($this->colB2);
		$this->dtgSampleloc->AddColumn($this->colB3);
		$this->dtgSampleloc->AddColumn($this->colB4);
		$this->dtgSampleloc->AddColumn($this->colB5);
		$this->dtgSampleloc->AddColumn($this->colB6);
		$this->dtgSampleloc->AddColumn($this->colB7);
		$this->dtgSampleloc->AddColumn($this->colB8);
		$this->dtgSampleloc->AddColumn($this->colC0);
		$this->dtgSampleloc->AddColumn($this->colC1);
		$this->dtgSampleloc->AddColumn($this->colC2);
		$this->dtgSampleloc->AddColumn($this->colC3);
		$this->dtgSampleloc->AddColumn($this->colC4);
		$this->dtgSampleloc->AddColumn($this->colC5);
		$this->dtgSampleloc->AddColumn($this->colC6);
		$this->dtgSampleloc->AddColumn($this->colC7);
		$this->dtgSampleloc->AddColumn($this->colC8);
		$this->dtgSampleloc->AddColumn($this->colD0);
		$this->dtgSampleloc->AddColumn($this->colD1);
		$this->dtgSampleloc->AddColumn($this->colD2);
		$this->dtgSampleloc->AddColumn($this->colD3);
		$this->dtgSampleloc->AddColumn($this->colD4);
		$this->dtgSampleloc->AddColumn($this->colD5);
		$this->dtgSampleloc->AddColumn($this->colD6);
		$this->dtgSampleloc->AddColumn($this->colD7);
		$this->dtgSampleloc->AddColumn($this->colD8);
		$this->dtgSampleloc->AddColumn($this->colE0);
		$this->dtgSampleloc->AddColumn($this->colE1);
		$this->dtgSampleloc->AddColumn($this->colE2);
		$this->dtgSampleloc->AddColumn($this->colE3);
		$this->dtgSampleloc->AddColumn($this->colE4);
		$this->dtgSampleloc->AddColumn($this->colE5);
		$this->dtgSampleloc->AddColumn($this->colE6);
		$this->dtgSampleloc->AddColumn($this->colE7);
		$this->dtgSampleloc->AddColumn($this->colE8);
		$this->dtgSampleloc->AddColumn($this->colF0);
		$this->dtgSampleloc->AddColumn($this->colF1);
		$this->dtgSampleloc->AddColumn($this->colF2);
		$this->dtgSampleloc->AddColumn($this->colF3);
		$this->dtgSampleloc->AddColumn($this->colF4);
		$this->dtgSampleloc->AddColumn($this->colF5);
		$this->dtgSampleloc->AddColumn($this->colF6);
		$this->dtgSampleloc->AddColumn($this->colF7);
		$this->dtgSampleloc->AddColumn($this->colF8);
		$this->dtgSampleloc->AddColumn($this->colG0);
		$this->dtgSampleloc->AddColumn($this->colG1);
		$this->dtgSampleloc->AddColumn($this->colG2);
		$this->dtgSampleloc->AddColumn($this->colG3);
		$this->dtgSampleloc->AddColumn($this->colG4);
		$this->dtgSampleloc->AddColumn($this->colG5);
		$this->dtgSampleloc->AddColumn($this->colG6);
		$this->dtgSampleloc->AddColumn($this->colG7);
		$this->dtgSampleloc->AddColumn($this->colG8);
		$this->dtgSampleloc->AddColumn($this->colH0);
		$this->dtgSampleloc->AddColumn($this->colH1);
		$this->dtgSampleloc->AddColumn($this->colH2);
		$this->dtgSampleloc->AddColumn($this->colH3);
		$this->dtgSampleloc->AddColumn($this->colH4);
		$this->dtgSampleloc->AddColumn($this->colH5);
		$this->dtgSampleloc->AddColumn($this->colH6);
		$this->dtgSampleloc->AddColumn($this->colH7);
		$this->dtgSampleloc->AddColumn($this->colH8);
		$this->dtgSampleloc->AddColumn($this->colI0);
		$this->dtgSampleloc->AddColumn($this->colI1);
		$this->dtgSampleloc->AddColumn($this->colI2);
		$this->dtgSampleloc->AddColumn($this->colI3);
		$this->dtgSampleloc->AddColumn($this->colI4);
		$this->dtgSampleloc->AddColumn($this->colI5);
		$this->dtgSampleloc->AddColumn($this->colI6);
		$this->dtgSampleloc->AddColumn($this->colI7);
		$this->dtgSampleloc->AddColumn($this->colI8);
		$this->dtgSampleloc->AddColumn($this->colUsername);
		$this->dtgSampleloc->AddColumn($this->colDate);
		$this->dtgSampleloc->AddColumn($this->colId);

		// Setup the Create New button
		$this->btnCreateNew = new QButton($this);
		$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Sampleloc');
		$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
	}

	public function dtgSampleloc_EditLinkColumn_Render(Sampleloc $objSampleloc) {
		$strControlId = 'btnEdit' . $this->dtgSampleloc->CurrentRowIndex;

		$btnEdit = $this->objForm->GetControl($strControlId);
		if (!$btnEdit) {
			$btnEdit = new QButton($this->dtgSampleloc, $strControlId);
			$btnEdit->Text = QApplication::Translate('Edit');
			$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
		}

		$btnEdit->ActionParameter = $objSampleloc->Id;
		return $btnEdit->Render(false);
	}

	public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
		$strParameterArray = explode(',', $strParameter);
		$objSampleloc = Sampleloc::Load($strParameterArray[0]);

		$objEditPanel = new SamplelocEditPanel($this, $this->strCloseEditPanelMethod, $objSampleloc);
			
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
		$objEditPanel = new SamplelocEditPanel($this, $this->strCloseEditPanelMethod, null);
		$strMethodName = $this->strSetEditPanelMethod;
		$this->objForm->$strMethodName($objEditPanel);
	}

	public function dtgSampleloc_Box_Render(Sampleloc $objSampleloc) {
		if (!is_null($objSampleloc->Box))
			return $objSampleloc->Box->__toString();
		else
			return null;
	}

	public function dtgSampleloc_Date_Render(Sampleloc $objSampleloc) {
		if (!is_null($objSampleloc->Date))
			return $objSampleloc->Date->toString(QDateTime::FormatDisplayDate);
		else
			return null;
	}


	public function dtgSampleloc_Bind() {
		// Get Total Count b/c of Pagination
		$this->dtgSampleloc->TotalItemCount = Sampleloc::CountAll();

		$objClauses = array();
		if ($objClause = $this->dtgSampleloc->OrderByClause)
			array_push($objClauses, $objClause);
		if ($objClause = $this->dtgSampleloc->LimitClause)
			array_push($objClauses, $objClause);
		$this->dtgSampleloc->DataSource = Sampleloc::LoadAll($objClauses);
	}
}
?>