<?php
// creating a variable for storing update information to the script
$__script_log__ = <<<MLS
Logic:
- shows boxes and their sample layout

8/2/2012 - wpg
	Need to have box type selector since the grid size is dependent on the samples per box

MLS;
define('__script_log__', $__script_log__);
unset($__script_log__);
/**
 * @author w. Patrick Gale (April 2012)
 * @abstract Preparing freezer samples
*/
// Include prepend.inc to load Qcodo
require('includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */

// Include the classfile for BoxListFormBase
require(__FORMBASE_CLASSES__ . '/BoxListFormBase.class.php');

// Security check for ALLOW_REMOTE_ADMIN
// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
QApplication::CheckRemoteAdmin();


// version 2 of box management that uses a separate association table for storing sample locations
class BoxListFormV2_8 extends BoxListFormBase {
	protected $dtgBox2, $lstSearch;
	protected function Form_Create() {
		$this->dtgBox2_Create();
		$this->lstSearch_Create();
	}


	protected function lstSearch_Create() {
		$this->lstSearch = new QListBox($this);
		$this->lstSearch->Name = QApplication::Translate('Box type:');
		$this->lstSearch->CssClass = '';
		$this->lstSearch->HtmlAfter = '<br/><br/>';
		$this->lstSearch->AddItem("-- select a box type --",null);
		$objSampleTypeArray = SampleTypes::QueryArray(QQ::All(), QQ::Clause(QQ::OrderBy(QQN::SampleTypes()->Letter)));
		if ($objSampleTypeArray) foreach ($objSampleTypeArray as $objSampleType) {
			$objListItem = new QListItem($objSampleType->__toString(), $objSampleType->Id);
			$this->lstSearch->AddItem($objListItem);
		}
		$this->lstSearch->AddAction(new QChangeEvent(), new QServerAction('dtgBox_Bind'));
	}


	protected $col2EditLinkColumn,$col2SampleTypeId,$col2Created,$col2Name;

	protected $col2_1;
	protected $col2_2;
	protected $col2_3;
	protected $col2_4;
	protected $col2_5;
	protected $col2_6;
	protected $col2_7;
	protected $col2_8;
	protected $col2_9;
	protected $col2_10;
	protected $col2_11;
	protected $col2_12;
	protected $col2_13;
	protected $col2_14;
	protected $col2_15;
	protected $col2_16;
	protected $col2_17;
	protected $col2_18;
	protected $col2_19;
	protected $col2_20;
	protected $col2_21;
	protected $col2_22;
	protected $col2_23;
	protected $col2_24;
	protected $col2_25;
	protected $col2_26;
	protected $col2_27;
	protected $col2_28;
	protected $col2_29;
	protected $col2_30;
	protected $col2_31;
	protected $col2_32;
	protected $col2_33;
	protected $col2_34;
	protected $col2_35;
	protected $col2_36;
	protected $col2_37;
	protected $col2_38;
	protected $col2_39;
	protected $col2_40;
	protected $col2_41;
	protected $col2_42;
	protected $col2_43;
	protected $col2_44;
	protected $col2_45;
	protected $col2_46;
	protected $col2_47;
	protected $col2_48;
	protected $col2_49;
	protected $col2_50;
	protected $col2_51;
	protected $col2_52;
	protected $col2_53;
	protected $col2_54;
	protected $col2_55;
	protected $col2_56;
	protected $col2_57;
	protected $col2_58;
	protected $col2_59;
	protected $col2_60;
	protected $col2_61;
	protected $col2_62;
	protected $col2_63;
	protected $col2_64;
	protected $col2_65;
	protected $col2_66;
	protected $col2_67;
	protected $col2_68;
	protected $col2_69;
	protected $col2_70;
	protected $col2_71;
	protected $col2_72;
	protected $col2_73;
	protected $col2_74;
	protected $col2_75;
	protected $col2_76;
	protected $col2_77;
	protected $col2_78;
	protected $col2_79;
	protected $col2_80;
	protected $col2_81;
	protected $col2_82;
	protected $col2_83;
	protected $col2_84;
	protected $col2_85;
	protected $col2_86;
	protected $col2_87;
	protected $col2_88;
	protected $col2_89;
	protected $col2_90;
	protected $col2_91;
	protected $col2_92;
	protected $col2_93;
	protected $col2_94;
	protected $col2_95;
	protected $col2_96;
	protected $col2_97;
	protected $col2_98;
	protected $col2_99;
	protected $col2_100;

	// boxes in progress
	protected function dtgBox2_Create(){
			
		// Setup DataGrid Columns
		$this->col2EditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgBox2_EditLinkColumn_Render($_ITEM) ?>');
		$this->col2Name = new QDataGridColumn(QApplication::Translate('Box ID'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Name, false)));
		$this->col2SampleTypeId = new QDataGridColumn(QApplication::Translate('Sample Type'), '<?= $_FORM->dtgBox2_SampleType_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->SampleType->Description), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->SampleType->Description, false)));
		$this->col2EditLinkColumn->HtmlEntities = false;
		$this->col2Created = new QDataGridColumn(QApplication::Translate('Started'), '<?= $_FORM->dtgBox2_Created_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Box()->Created), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Box()->Created, false)));
			
		// build columns for slots
		for($i=1;$i<=81;$i++) {
			$obj = '$this->col2_'.$i.' = new QDataGridColumn(QApplication::Translate("'.$i.'"), "<?= \$_FORM->dtgBox2_Slot_Render(\$_ITEM,'.$i.'); ?>");';
			eval("return $obj;");
		}
			
		// Setup DataGrid
		$this->dtgBox2 = new QDataGrid($this);
		$this->dtgBox2->CellSpacing = 0;
		$this->dtgBox2->CellPadding = 4;
		$this->dtgBox2->BorderStyle = QBorderStyle::Solid;
		$this->dtgBox2->BorderWidth = 1;
		$this->dtgBox2->GridLines = QGridLines::Both;
		$this->dtgBox2->CssClass='table table-bordered';
		$this->dtgBox2->HtmlBefore = '<h2>Boxes in progress</h2>';
			
		// Datagrid Paginator
		$this->dtgBox2->Paginator = new QPaginator($this->dtgBox2);
		$this->dtgBox2->ItemsPerPage = 10;

		$this->dtgBox2->SortColumnIndex = 1;
		$this->dtgBox2->SortDirection = 1;
			
		// Specify Whether or Not to Refresh using Ajax
		$this->dtgBox2->UseAjax = false;

		// Specify the local databind method this datagrid will use
		$this->dtgBox2->SetDataBinder('dtgBox2_Bind');

		$this->dtgBox2->AddColumn($this->col2EditLinkColumn);
		$this->dtgBox2->AddColumn($this->col2Name);
		$this->dtgBox2->AddColumn($this->col2SampleTypeId);
		$this->dtgBox2->AddColumn($this->col2Created);
			
		for($i=1;$i<=81;$i++) {
			$obj = '$this->dtgBox2->AddColumn($this->col2_'.$i.');';
			eval("return $obj;");
		}
	}

	public function dtgBox2_EditLinkColumn_Render(Box $objBox) {
		return sprintf('<a href="box.php?intId=%s">%s</a>',
				$objBox->Id,
				QApplication::Translate('View box'));
	}

	public function dtgBox2_Slot_Render(Box $objBox,$slot) {
		$boxLocation = $objBox->GetSampleBoxLocation($slot);
		if ($boxLocation)
			return "o";

		return "";
	}

	public function dtgBox2_SampleType_Render(Box $objBox) {
		if (!is_null($objBox->SampleType))
			return $objBox->SampleType->__toString();
		else
			return null;
	}

	public function dtgBox2_Created_Render(Box $objBox) {
		if (!is_null($objBox->Created))
			return $objBox->Created->toString(QDateTime::FormatDisplayDateTime);
		else
			return null;
	}

	protected function dtgBox2_Bind() {
		// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

		// Remember!  We need to first set the TotalItemCount, which will affect whether we hide or show the datagrid
		$TotalItemCount = Box::CountAll();

		QApplication::ExecuteJavaScript(sprintf('$("#B").show("slow");', $this));
			
		// Setup the $objClauses Array
		$objClauses = array();

		// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
		// the OrderByClause to the $objClauses array
		if ($objClause = $this->dtgBox2->OrderByClause)
			array_push($objClauses, $objClause);

		// Add the LimitClause information, as well
		if ($objClause = $this->dtgBox2->LimitClause)
			array_push($objClauses, $objClause);

		// Set the DataSource to be the array of all Box objects, given the clauses above
		$this->dtgBox2->DataSource = Box::LoadAll($objClauses);
	}


}



// go to the centralized form executing access control function to run the form and check access control
ACL_Run('box-view_list');
?>
