<?php
/**
 * This is the abstract Panel class for the Create, Edit, and Delete functionality
 * of the Sampleloc class.  This code-generated class
 * contains all the basic Qform elements to display an HTML DIV that can
 * manipulate a single Sampleloc object.
 *
 * To take advantage of some (or all) of these control objects, you
 * must create a new Panel which extends this SamplelocEditPanelBase
 * class.
 *
 * Any and all changes to this file will be overwritten with any subsequent re-
 * code generation.
 *
 * @package My Application
 * @subpackage PanelBaseObjects
 *
 */
abstract class SamplelocEditPanelBase extends QPanel {
	// General Panel Variables
	protected $objSampleloc;
	protected $strTitleVerb;
	protected $blnEditMode;

	protected $strClosePanelMethod;

	// Controls for Sampleloc's Data Fields
	public $lstBox;
	public $txtSamptype;
	public $txtA0;
	public $txtA1;
	public $txtA2;
	public $txtA3;
	public $txtA4;
	public $txtA5;
	public $txtA6;
	public $txtA7;
	public $txtA8;
	public $txtB0;
	public $txtB1;
	public $txtB2;
	public $txtB3;
	public $txtB4;
	public $txtB5;
	public $txtB6;
	public $txtB7;
	public $txtB8;
	public $txtC0;
	public $txtC1;
	public $txtC2;
	public $txtC3;
	public $txtC4;
	public $txtC5;
	public $txtC6;
	public $txtC7;
	public $txtC8;
	public $txtD0;
	public $txtD1;
	public $txtD2;
	public $txtD3;
	public $txtD4;
	public $txtD5;
	public $txtD6;
	public $txtD7;
	public $txtD8;
	public $txtE0;
	public $txtE1;
	public $txtE2;
	public $txtE3;
	public $txtE4;
	public $txtE5;
	public $txtE6;
	public $txtE7;
	public $txtE8;
	public $txtF0;
	public $txtF1;
	public $txtF2;
	public $txtF3;
	public $txtF4;
	public $txtF5;
	public $txtF6;
	public $txtF7;
	public $txtF8;
	public $txtG0;
	public $txtG1;
	public $txtG2;
	public $txtG3;
	public $txtG4;
	public $txtG5;
	public $txtG6;
	public $txtG7;
	public $txtG8;
	public $txtH0;
	public $txtH1;
	public $txtH2;
	public $txtH3;
	public $txtH4;
	public $txtH5;
	public $txtH6;
	public $txtH7;
	public $txtH8;
	public $txtI0;
	public $txtI1;
	public $txtI2;
	public $txtI3;
	public $txtI4;
	public $txtI5;
	public $txtI6;
	public $txtI7;
	public $txtI8;
	public $txtUsername;
	public $calDate;
	public $lblId;

	// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

	// Button Actions
	public $btnSave;
	public $btnCancel;
	public $btnDelete;

	protected function SetupSampleloc($objSampleloc) {
		if ($objSampleloc) {
			$this->objSampleloc = $objSampleloc;
			$this->strTitleVerb = QApplication::Translate('Edit');
			$this->blnEditMode = true;
		} else {
			$this->objSampleloc = new Sampleloc();
			$this->strTitleVerb = QApplication::Translate('Create');
			$this->blnEditMode = false;
		}
	}

	public function __construct($objParentObject, $strClosePanelMethod, $objSampleloc = null, $strControlId = null) {
		// Call the Parent
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}

		// Call SetupSampleloc to either Load/Edit Existing or Create New
		$this->SetupSampleloc($objSampleloc);
		$this->strClosePanelMethod = $strClosePanelMethod;

		// Create/Setup Controls for Sampleloc's Data Fields
		$this->lstBox_Create();
		$this->txtSamptype_Create();
		$this->txtA0_Create();
		$this->txtA1_Create();
		$this->txtA2_Create();
		$this->txtA3_Create();
		$this->txtA4_Create();
		$this->txtA5_Create();
		$this->txtA6_Create();
		$this->txtA7_Create();
		$this->txtA8_Create();
		$this->txtB0_Create();
		$this->txtB1_Create();
		$this->txtB2_Create();
		$this->txtB3_Create();
		$this->txtB4_Create();
		$this->txtB5_Create();
		$this->txtB6_Create();
		$this->txtB7_Create();
		$this->txtB8_Create();
		$this->txtC0_Create();
		$this->txtC1_Create();
		$this->txtC2_Create();
		$this->txtC3_Create();
		$this->txtC4_Create();
		$this->txtC5_Create();
		$this->txtC6_Create();
		$this->txtC7_Create();
		$this->txtC8_Create();
		$this->txtD0_Create();
		$this->txtD1_Create();
		$this->txtD2_Create();
		$this->txtD3_Create();
		$this->txtD4_Create();
		$this->txtD5_Create();
		$this->txtD6_Create();
		$this->txtD7_Create();
		$this->txtD8_Create();
		$this->txtE0_Create();
		$this->txtE1_Create();
		$this->txtE2_Create();
		$this->txtE3_Create();
		$this->txtE4_Create();
		$this->txtE5_Create();
		$this->txtE6_Create();
		$this->txtE7_Create();
		$this->txtE8_Create();
		$this->txtF0_Create();
		$this->txtF1_Create();
		$this->txtF2_Create();
		$this->txtF3_Create();
		$this->txtF4_Create();
		$this->txtF5_Create();
		$this->txtF6_Create();
		$this->txtF7_Create();
		$this->txtF8_Create();
		$this->txtG0_Create();
		$this->txtG1_Create();
		$this->txtG2_Create();
		$this->txtG3_Create();
		$this->txtG4_Create();
		$this->txtG5_Create();
		$this->txtG6_Create();
		$this->txtG7_Create();
		$this->txtG8_Create();
		$this->txtH0_Create();
		$this->txtH1_Create();
		$this->txtH2_Create();
		$this->txtH3_Create();
		$this->txtH4_Create();
		$this->txtH5_Create();
		$this->txtH6_Create();
		$this->txtH7_Create();
		$this->txtH8_Create();
		$this->txtI0_Create();
		$this->txtI1_Create();
		$this->txtI2_Create();
		$this->txtI3_Create();
		$this->txtI4_Create();
		$this->txtI5_Create();
		$this->txtI6_Create();
		$this->txtI7_Create();
		$this->txtI8_Create();
		$this->txtUsername_Create();
		$this->calDate_Create();
		$this->lblId_Create();

		// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Create/Setup Button Action controls
		$this->btnSave_Create();
		$this->btnCancel_Create();
		$this->btnDelete_Create();
	}

	// Protected Create Methods
	// Create and Setup lstBox
	protected function lstBox_Create() {
		$this->lstBox = new QListBox($this);
		$this->lstBox->Name = QApplication::Translate('Box');
		$this->lstBox->Required = true;
		if (!$this->blnEditMode)
			$this->lstBox->AddItem(QApplication::Translate('- Select One -'), null);
		$objBoxArray = Sampleboxes::LoadAll();
		if ($objBoxArray) foreach ($objBoxArray as $objBox) {
			$objListItem = new QListItem($objBox->__toString(), $objBox->Id);
			if (($this->objSampleloc->Box) && ($this->objSampleloc->Box->Id == $objBox->Id))
				$objListItem->Selected = true;
			$this->lstBox->AddItem($objListItem);
		}
	}

	// Create and Setup txtSamptype
	protected function txtSamptype_Create() {
		$this->txtSamptype = new QTextBox($this);
		$this->txtSamptype->Name = QApplication::Translate('Samptype');
		$this->txtSamptype->Text = $this->objSampleloc->Samptype;
		$this->txtSamptype->Required = true;
		$this->txtSamptype->MaxLength = Sampleloc::SamptypeMaxLength;
	}

	// Create and Setup txtA0
	protected function txtA0_Create() {
		$this->txtA0 = new QTextBox($this);
		$this->txtA0->Name = QApplication::Translate('A 0');
		$this->txtA0->Text = $this->objSampleloc->A0;
		$this->txtA0->MaxLength = Sampleloc::A0MaxLength;
	}

	// Create and Setup txtA1
	protected function txtA1_Create() {
		$this->txtA1 = new QTextBox($this);
		$this->txtA1->Name = QApplication::Translate('A 1');
		$this->txtA1->Text = $this->objSampleloc->A1;
		$this->txtA1->MaxLength = Sampleloc::A1MaxLength;
	}

	// Create and Setup txtA2
	protected function txtA2_Create() {
		$this->txtA2 = new QTextBox($this);
		$this->txtA2->Name = QApplication::Translate('A 2');
		$this->txtA2->Text = $this->objSampleloc->A2;
		$this->txtA2->MaxLength = Sampleloc::A2MaxLength;
	}

	// Create and Setup txtA3
	protected function txtA3_Create() {
		$this->txtA3 = new QTextBox($this);
		$this->txtA3->Name = QApplication::Translate('A 3');
		$this->txtA3->Text = $this->objSampleloc->A3;
		$this->txtA3->MaxLength = Sampleloc::A3MaxLength;
	}

	// Create and Setup txtA4
	protected function txtA4_Create() {
		$this->txtA4 = new QTextBox($this);
		$this->txtA4->Name = QApplication::Translate('A 4');
		$this->txtA4->Text = $this->objSampleloc->A4;
		$this->txtA4->MaxLength = Sampleloc::A4MaxLength;
	}

	// Create and Setup txtA5
	protected function txtA5_Create() {
		$this->txtA5 = new QTextBox($this);
		$this->txtA5->Name = QApplication::Translate('A 5');
		$this->txtA5->Text = $this->objSampleloc->A5;
		$this->txtA5->MaxLength = Sampleloc::A5MaxLength;
	}

	// Create and Setup txtA6
	protected function txtA6_Create() {
		$this->txtA6 = new QTextBox($this);
		$this->txtA6->Name = QApplication::Translate('A 6');
		$this->txtA6->Text = $this->objSampleloc->A6;
		$this->txtA6->MaxLength = Sampleloc::A6MaxLength;
	}

	// Create and Setup txtA7
	protected function txtA7_Create() {
		$this->txtA7 = new QTextBox($this);
		$this->txtA7->Name = QApplication::Translate('A 7');
		$this->txtA7->Text = $this->objSampleloc->A7;
		$this->txtA7->MaxLength = Sampleloc::A7MaxLength;
	}

	// Create and Setup txtA8
	protected function txtA8_Create() {
		$this->txtA8 = new QTextBox($this);
		$this->txtA8->Name = QApplication::Translate('A 8');
		$this->txtA8->Text = $this->objSampleloc->A8;
		$this->txtA8->MaxLength = Sampleloc::A8MaxLength;
	}

	// Create and Setup txtB0
	protected function txtB0_Create() {
		$this->txtB0 = new QTextBox($this);
		$this->txtB0->Name = QApplication::Translate('B 0');
		$this->txtB0->Text = $this->objSampleloc->B0;
		$this->txtB0->MaxLength = Sampleloc::B0MaxLength;
	}

	// Create and Setup txtB1
	protected function txtB1_Create() {
		$this->txtB1 = new QTextBox($this);
		$this->txtB1->Name = QApplication::Translate('B 1');
		$this->txtB1->Text = $this->objSampleloc->B1;
		$this->txtB1->MaxLength = Sampleloc::B1MaxLength;
	}

	// Create and Setup txtB2
	protected function txtB2_Create() {
		$this->txtB2 = new QTextBox($this);
		$this->txtB2->Name = QApplication::Translate('B 2');
		$this->txtB2->Text = $this->objSampleloc->B2;
		$this->txtB2->MaxLength = Sampleloc::B2MaxLength;
	}

	// Create and Setup txtB3
	protected function txtB3_Create() {
		$this->txtB3 = new QTextBox($this);
		$this->txtB3->Name = QApplication::Translate('B 3');
		$this->txtB3->Text = $this->objSampleloc->B3;
		$this->txtB3->MaxLength = Sampleloc::B3MaxLength;
	}

	// Create and Setup txtB4
	protected function txtB4_Create() {
		$this->txtB4 = new QTextBox($this);
		$this->txtB4->Name = QApplication::Translate('B 4');
		$this->txtB4->Text = $this->objSampleloc->B4;
		$this->txtB4->MaxLength = Sampleloc::B4MaxLength;
	}

	// Create and Setup txtB5
	protected function txtB5_Create() {
		$this->txtB5 = new QTextBox($this);
		$this->txtB5->Name = QApplication::Translate('B 5');
		$this->txtB5->Text = $this->objSampleloc->B5;
		$this->txtB5->MaxLength = Sampleloc::B5MaxLength;
	}

	// Create and Setup txtB6
	protected function txtB6_Create() {
		$this->txtB6 = new QTextBox($this);
		$this->txtB6->Name = QApplication::Translate('B 6');
		$this->txtB6->Text = $this->objSampleloc->B6;
		$this->txtB6->MaxLength = Sampleloc::B6MaxLength;
	}

	// Create and Setup txtB7
	protected function txtB7_Create() {
		$this->txtB7 = new QTextBox($this);
		$this->txtB7->Name = QApplication::Translate('B 7');
		$this->txtB7->Text = $this->objSampleloc->B7;
		$this->txtB7->MaxLength = Sampleloc::B7MaxLength;
	}

	// Create and Setup txtB8
	protected function txtB8_Create() {
		$this->txtB8 = new QTextBox($this);
		$this->txtB8->Name = QApplication::Translate('B 8');
		$this->txtB8->Text = $this->objSampleloc->B8;
		$this->txtB8->MaxLength = Sampleloc::B8MaxLength;
	}

	// Create and Setup txtC0
	protected function txtC0_Create() {
		$this->txtC0 = new QTextBox($this);
		$this->txtC0->Name = QApplication::Translate('C 0');
		$this->txtC0->Text = $this->objSampleloc->C0;
		$this->txtC0->MaxLength = Sampleloc::C0MaxLength;
	}

	// Create and Setup txtC1
	protected function txtC1_Create() {
		$this->txtC1 = new QTextBox($this);
		$this->txtC1->Name = QApplication::Translate('C 1');
		$this->txtC1->Text = $this->objSampleloc->C1;
		$this->txtC1->MaxLength = Sampleloc::C1MaxLength;
	}

	// Create and Setup txtC2
	protected function txtC2_Create() {
		$this->txtC2 = new QTextBox($this);
		$this->txtC2->Name = QApplication::Translate('C 2');
		$this->txtC2->Text = $this->objSampleloc->C2;
		$this->txtC2->MaxLength = Sampleloc::C2MaxLength;
	}

	// Create and Setup txtC3
	protected function txtC3_Create() {
		$this->txtC3 = new QTextBox($this);
		$this->txtC3->Name = QApplication::Translate('C 3');
		$this->txtC3->Text = $this->objSampleloc->C3;
		$this->txtC3->MaxLength = Sampleloc::C3MaxLength;
	}

	// Create and Setup txtC4
	protected function txtC4_Create() {
		$this->txtC4 = new QTextBox($this);
		$this->txtC4->Name = QApplication::Translate('C 4');
		$this->txtC4->Text = $this->objSampleloc->C4;
		$this->txtC4->MaxLength = Sampleloc::C4MaxLength;
	}

	// Create and Setup txtC5
	protected function txtC5_Create() {
		$this->txtC5 = new QTextBox($this);
		$this->txtC5->Name = QApplication::Translate('C 5');
		$this->txtC5->Text = $this->objSampleloc->C5;
		$this->txtC5->MaxLength = Sampleloc::C5MaxLength;
	}

	// Create and Setup txtC6
	protected function txtC6_Create() {
		$this->txtC6 = new QTextBox($this);
		$this->txtC6->Name = QApplication::Translate('C 6');
		$this->txtC6->Text = $this->objSampleloc->C6;
		$this->txtC6->MaxLength = Sampleloc::C6MaxLength;
	}

	// Create and Setup txtC7
	protected function txtC7_Create() {
		$this->txtC7 = new QTextBox($this);
		$this->txtC7->Name = QApplication::Translate('C 7');
		$this->txtC7->Text = $this->objSampleloc->C7;
		$this->txtC7->MaxLength = Sampleloc::C7MaxLength;
	}

	// Create and Setup txtC8
	protected function txtC8_Create() {
		$this->txtC8 = new QTextBox($this);
		$this->txtC8->Name = QApplication::Translate('C 8');
		$this->txtC8->Text = $this->objSampleloc->C8;
		$this->txtC8->MaxLength = Sampleloc::C8MaxLength;
	}

	// Create and Setup txtD0
	protected function txtD0_Create() {
		$this->txtD0 = new QTextBox($this);
		$this->txtD0->Name = QApplication::Translate('D 0');
		$this->txtD0->Text = $this->objSampleloc->D0;
		$this->txtD0->MaxLength = Sampleloc::D0MaxLength;
	}

	// Create and Setup txtD1
	protected function txtD1_Create() {
		$this->txtD1 = new QTextBox($this);
		$this->txtD1->Name = QApplication::Translate('D 1');
		$this->txtD1->Text = $this->objSampleloc->D1;
		$this->txtD1->MaxLength = Sampleloc::D1MaxLength;
	}

	// Create and Setup txtD2
	protected function txtD2_Create() {
		$this->txtD2 = new QTextBox($this);
		$this->txtD2->Name = QApplication::Translate('D 2');
		$this->txtD2->Text = $this->objSampleloc->D2;
		$this->txtD2->MaxLength = Sampleloc::D2MaxLength;
	}

	// Create and Setup txtD3
	protected function txtD3_Create() {
		$this->txtD3 = new QTextBox($this);
		$this->txtD3->Name = QApplication::Translate('D 3');
		$this->txtD3->Text = $this->objSampleloc->D3;
		$this->txtD3->MaxLength = Sampleloc::D3MaxLength;
	}

	// Create and Setup txtD4
	protected function txtD4_Create() {
		$this->txtD4 = new QTextBox($this);
		$this->txtD4->Name = QApplication::Translate('D 4');
		$this->txtD4->Text = $this->objSampleloc->D4;
		$this->txtD4->MaxLength = Sampleloc::D4MaxLength;
	}

	// Create and Setup txtD5
	protected function txtD5_Create() {
		$this->txtD5 = new QTextBox($this);
		$this->txtD5->Name = QApplication::Translate('D 5');
		$this->txtD5->Text = $this->objSampleloc->D5;
		$this->txtD5->MaxLength = Sampleloc::D5MaxLength;
	}

	// Create and Setup txtD6
	protected function txtD6_Create() {
		$this->txtD6 = new QTextBox($this);
		$this->txtD6->Name = QApplication::Translate('D 6');
		$this->txtD6->Text = $this->objSampleloc->D6;
		$this->txtD6->MaxLength = Sampleloc::D6MaxLength;
	}

	// Create and Setup txtD7
	protected function txtD7_Create() {
		$this->txtD7 = new QTextBox($this);
		$this->txtD7->Name = QApplication::Translate('D 7');
		$this->txtD7->Text = $this->objSampleloc->D7;
		$this->txtD7->MaxLength = Sampleloc::D7MaxLength;
	}

	// Create and Setup txtD8
	protected function txtD8_Create() {
		$this->txtD8 = new QTextBox($this);
		$this->txtD8->Name = QApplication::Translate('D 8');
		$this->txtD8->Text = $this->objSampleloc->D8;
		$this->txtD8->MaxLength = Sampleloc::D8MaxLength;
	}

	// Create and Setup txtE0
	protected function txtE0_Create() {
		$this->txtE0 = new QTextBox($this);
		$this->txtE0->Name = QApplication::Translate('E 0');
		$this->txtE0->Text = $this->objSampleloc->E0;
		$this->txtE0->MaxLength = Sampleloc::E0MaxLength;
	}

	// Create and Setup txtE1
	protected function txtE1_Create() {
		$this->txtE1 = new QTextBox($this);
		$this->txtE1->Name = QApplication::Translate('E 1');
		$this->txtE1->Text = $this->objSampleloc->E1;
		$this->txtE1->MaxLength = Sampleloc::E1MaxLength;
	}

	// Create and Setup txtE2
	protected function txtE2_Create() {
		$this->txtE2 = new QTextBox($this);
		$this->txtE2->Name = QApplication::Translate('E 2');
		$this->txtE2->Text = $this->objSampleloc->E2;
		$this->txtE2->MaxLength = Sampleloc::E2MaxLength;
	}

	// Create and Setup txtE3
	protected function txtE3_Create() {
		$this->txtE3 = new QTextBox($this);
		$this->txtE3->Name = QApplication::Translate('E 3');
		$this->txtE3->Text = $this->objSampleloc->E3;
		$this->txtE3->MaxLength = Sampleloc::E3MaxLength;
	}

	// Create and Setup txtE4
	protected function txtE4_Create() {
		$this->txtE4 = new QTextBox($this);
		$this->txtE4->Name = QApplication::Translate('E 4');
		$this->txtE4->Text = $this->objSampleloc->E4;
		$this->txtE4->MaxLength = Sampleloc::E4MaxLength;
	}

	// Create and Setup txtE5
	protected function txtE5_Create() {
		$this->txtE5 = new QTextBox($this);
		$this->txtE5->Name = QApplication::Translate('E 5');
		$this->txtE5->Text = $this->objSampleloc->E5;
		$this->txtE5->MaxLength = Sampleloc::E5MaxLength;
	}

	// Create and Setup txtE6
	protected function txtE6_Create() {
		$this->txtE6 = new QTextBox($this);
		$this->txtE6->Name = QApplication::Translate('E 6');
		$this->txtE6->Text = $this->objSampleloc->E6;
		$this->txtE6->MaxLength = Sampleloc::E6MaxLength;
	}

	// Create and Setup txtE7
	protected function txtE7_Create() {
		$this->txtE7 = new QTextBox($this);
		$this->txtE7->Name = QApplication::Translate('E 7');
		$this->txtE7->Text = $this->objSampleloc->E7;
		$this->txtE7->MaxLength = Sampleloc::E7MaxLength;
	}

	// Create and Setup txtE8
	protected function txtE8_Create() {
		$this->txtE8 = new QTextBox($this);
		$this->txtE8->Name = QApplication::Translate('E 8');
		$this->txtE8->Text = $this->objSampleloc->E8;
		$this->txtE8->MaxLength = Sampleloc::E8MaxLength;
	}

	// Create and Setup txtF0
	protected function txtF0_Create() {
		$this->txtF0 = new QTextBox($this);
		$this->txtF0->Name = QApplication::Translate('F 0');
		$this->txtF0->Text = $this->objSampleloc->F0;
		$this->txtF0->MaxLength = Sampleloc::F0MaxLength;
	}

	// Create and Setup txtF1
	protected function txtF1_Create() {
		$this->txtF1 = new QTextBox($this);
		$this->txtF1->Name = QApplication::Translate('F 1');
		$this->txtF1->Text = $this->objSampleloc->F1;
		$this->txtF1->MaxLength = Sampleloc::F1MaxLength;
	}

	// Create and Setup txtF2
	protected function txtF2_Create() {
		$this->txtF2 = new QTextBox($this);
		$this->txtF2->Name = QApplication::Translate('F 2');
		$this->txtF2->Text = $this->objSampleloc->F2;
		$this->txtF2->MaxLength = Sampleloc::F2MaxLength;
	}

	// Create and Setup txtF3
	protected function txtF3_Create() {
		$this->txtF3 = new QTextBox($this);
		$this->txtF3->Name = QApplication::Translate('F 3');
		$this->txtF3->Text = $this->objSampleloc->F3;
		$this->txtF3->MaxLength = Sampleloc::F3MaxLength;
	}

	// Create and Setup txtF4
	protected function txtF4_Create() {
		$this->txtF4 = new QTextBox($this);
		$this->txtF4->Name = QApplication::Translate('F 4');
		$this->txtF4->Text = $this->objSampleloc->F4;
		$this->txtF4->MaxLength = Sampleloc::F4MaxLength;
	}

	// Create and Setup txtF5
	protected function txtF5_Create() {
		$this->txtF5 = new QTextBox($this);
		$this->txtF5->Name = QApplication::Translate('F 5');
		$this->txtF5->Text = $this->objSampleloc->F5;
		$this->txtF5->MaxLength = Sampleloc::F5MaxLength;
	}

	// Create and Setup txtF6
	protected function txtF6_Create() {
		$this->txtF6 = new QTextBox($this);
		$this->txtF6->Name = QApplication::Translate('F 6');
		$this->txtF6->Text = $this->objSampleloc->F6;
		$this->txtF6->MaxLength = Sampleloc::F6MaxLength;
	}

	// Create and Setup txtF7
	protected function txtF7_Create() {
		$this->txtF7 = new QTextBox($this);
		$this->txtF7->Name = QApplication::Translate('F 7');
		$this->txtF7->Text = $this->objSampleloc->F7;
		$this->txtF7->MaxLength = Sampleloc::F7MaxLength;
	}

	// Create and Setup txtF8
	protected function txtF8_Create() {
		$this->txtF8 = new QTextBox($this);
		$this->txtF8->Name = QApplication::Translate('F 8');
		$this->txtF8->Text = $this->objSampleloc->F8;
		$this->txtF8->MaxLength = Sampleloc::F8MaxLength;
	}

	// Create and Setup txtG0
	protected function txtG0_Create() {
		$this->txtG0 = new QTextBox($this);
		$this->txtG0->Name = QApplication::Translate('G 0');
		$this->txtG0->Text = $this->objSampleloc->G0;
		$this->txtG0->MaxLength = Sampleloc::G0MaxLength;
	}

	// Create and Setup txtG1
	protected function txtG1_Create() {
		$this->txtG1 = new QTextBox($this);
		$this->txtG1->Name = QApplication::Translate('G 1');
		$this->txtG1->Text = $this->objSampleloc->G1;
		$this->txtG1->MaxLength = Sampleloc::G1MaxLength;
	}

	// Create and Setup txtG2
	protected function txtG2_Create() {
		$this->txtG2 = new QTextBox($this);
		$this->txtG2->Name = QApplication::Translate('G 2');
		$this->txtG2->Text = $this->objSampleloc->G2;
		$this->txtG2->MaxLength = Sampleloc::G2MaxLength;
	}

	// Create and Setup txtG3
	protected function txtG3_Create() {
		$this->txtG3 = new QTextBox($this);
		$this->txtG3->Name = QApplication::Translate('G 3');
		$this->txtG3->Text = $this->objSampleloc->G3;
		$this->txtG3->MaxLength = Sampleloc::G3MaxLength;
	}

	// Create and Setup txtG4
	protected function txtG4_Create() {
		$this->txtG4 = new QTextBox($this);
		$this->txtG4->Name = QApplication::Translate('G 4');
		$this->txtG4->Text = $this->objSampleloc->G4;
		$this->txtG4->MaxLength = Sampleloc::G4MaxLength;
	}

	// Create and Setup txtG5
	protected function txtG5_Create() {
		$this->txtG5 = new QTextBox($this);
		$this->txtG5->Name = QApplication::Translate('G 5');
		$this->txtG5->Text = $this->objSampleloc->G5;
		$this->txtG5->MaxLength = Sampleloc::G5MaxLength;
	}

	// Create and Setup txtG6
	protected function txtG6_Create() {
		$this->txtG6 = new QTextBox($this);
		$this->txtG6->Name = QApplication::Translate('G 6');
		$this->txtG6->Text = $this->objSampleloc->G6;
		$this->txtG6->MaxLength = Sampleloc::G6MaxLength;
	}

	// Create and Setup txtG7
	protected function txtG7_Create() {
		$this->txtG7 = new QTextBox($this);
		$this->txtG7->Name = QApplication::Translate('G 7');
		$this->txtG7->Text = $this->objSampleloc->G7;
		$this->txtG7->MaxLength = Sampleloc::G7MaxLength;
	}

	// Create and Setup txtG8
	protected function txtG8_Create() {
		$this->txtG8 = new QTextBox($this);
		$this->txtG8->Name = QApplication::Translate('G 8');
		$this->txtG8->Text = $this->objSampleloc->G8;
		$this->txtG8->MaxLength = Sampleloc::G8MaxLength;
	}

	// Create and Setup txtH0
	protected function txtH0_Create() {
		$this->txtH0 = new QTextBox($this);
		$this->txtH0->Name = QApplication::Translate('H 0');
		$this->txtH0->Text = $this->objSampleloc->H0;
		$this->txtH0->MaxLength = Sampleloc::H0MaxLength;
	}

	// Create and Setup txtH1
	protected function txtH1_Create() {
		$this->txtH1 = new QTextBox($this);
		$this->txtH1->Name = QApplication::Translate('H 1');
		$this->txtH1->Text = $this->objSampleloc->H1;
		$this->txtH1->MaxLength = Sampleloc::H1MaxLength;
	}

	// Create and Setup txtH2
	protected function txtH2_Create() {
		$this->txtH2 = new QTextBox($this);
		$this->txtH2->Name = QApplication::Translate('H 2');
		$this->txtH2->Text = $this->objSampleloc->H2;
		$this->txtH2->MaxLength = Sampleloc::H2MaxLength;
	}

	// Create and Setup txtH3
	protected function txtH3_Create() {
		$this->txtH3 = new QTextBox($this);
		$this->txtH3->Name = QApplication::Translate('H 3');
		$this->txtH3->Text = $this->objSampleloc->H3;
		$this->txtH3->MaxLength = Sampleloc::H3MaxLength;
	}

	// Create and Setup txtH4
	protected function txtH4_Create() {
		$this->txtH4 = new QTextBox($this);
		$this->txtH4->Name = QApplication::Translate('H 4');
		$this->txtH4->Text = $this->objSampleloc->H4;
		$this->txtH4->MaxLength = Sampleloc::H4MaxLength;
	}

	// Create and Setup txtH5
	protected function txtH5_Create() {
		$this->txtH5 = new QTextBox($this);
		$this->txtH5->Name = QApplication::Translate('H 5');
		$this->txtH5->Text = $this->objSampleloc->H5;
		$this->txtH5->MaxLength = Sampleloc::H5MaxLength;
	}

	// Create and Setup txtH6
	protected function txtH6_Create() {
		$this->txtH6 = new QTextBox($this);
		$this->txtH6->Name = QApplication::Translate('H 6');
		$this->txtH6->Text = $this->objSampleloc->H6;
		$this->txtH6->MaxLength = Sampleloc::H6MaxLength;
	}

	// Create and Setup txtH7
	protected function txtH7_Create() {
		$this->txtH7 = new QTextBox($this);
		$this->txtH7->Name = QApplication::Translate('H 7');
		$this->txtH7->Text = $this->objSampleloc->H7;
		$this->txtH7->MaxLength = Sampleloc::H7MaxLength;
	}

	// Create and Setup txtH8
	protected function txtH8_Create() {
		$this->txtH8 = new QTextBox($this);
		$this->txtH8->Name = QApplication::Translate('H 8');
		$this->txtH8->Text = $this->objSampleloc->H8;
		$this->txtH8->MaxLength = Sampleloc::H8MaxLength;
	}

	// Create and Setup txtI0
	protected function txtI0_Create() {
		$this->txtI0 = new QTextBox($this);
		$this->txtI0->Name = QApplication::Translate('I 0');
		$this->txtI0->Text = $this->objSampleloc->I0;
		$this->txtI0->MaxLength = Sampleloc::I0MaxLength;
	}

	// Create and Setup txtI1
	protected function txtI1_Create() {
		$this->txtI1 = new QTextBox($this);
		$this->txtI1->Name = QApplication::Translate('I 1');
		$this->txtI1->Text = $this->objSampleloc->I1;
		$this->txtI1->MaxLength = Sampleloc::I1MaxLength;
	}

	// Create and Setup txtI2
	protected function txtI2_Create() {
		$this->txtI2 = new QTextBox($this);
		$this->txtI2->Name = QApplication::Translate('I 2');
		$this->txtI2->Text = $this->objSampleloc->I2;
		$this->txtI2->MaxLength = Sampleloc::I2MaxLength;
	}

	// Create and Setup txtI3
	protected function txtI3_Create() {
		$this->txtI3 = new QTextBox($this);
		$this->txtI3->Name = QApplication::Translate('I 3');
		$this->txtI3->Text = $this->objSampleloc->I3;
		$this->txtI3->MaxLength = Sampleloc::I3MaxLength;
	}

	// Create and Setup txtI4
	protected function txtI4_Create() {
		$this->txtI4 = new QTextBox($this);
		$this->txtI4->Name = QApplication::Translate('I 4');
		$this->txtI4->Text = $this->objSampleloc->I4;
		$this->txtI4->MaxLength = Sampleloc::I4MaxLength;
	}

	// Create and Setup txtI5
	protected function txtI5_Create() {
		$this->txtI5 = new QTextBox($this);
		$this->txtI5->Name = QApplication::Translate('I 5');
		$this->txtI5->Text = $this->objSampleloc->I5;
		$this->txtI5->MaxLength = Sampleloc::I5MaxLength;
	}

	// Create and Setup txtI6
	protected function txtI6_Create() {
		$this->txtI6 = new QTextBox($this);
		$this->txtI6->Name = QApplication::Translate('I 6');
		$this->txtI6->Text = $this->objSampleloc->I6;
		$this->txtI6->MaxLength = Sampleloc::I6MaxLength;
	}

	// Create and Setup txtI7
	protected function txtI7_Create() {
		$this->txtI7 = new QTextBox($this);
		$this->txtI7->Name = QApplication::Translate('I 7');
		$this->txtI7->Text = $this->objSampleloc->I7;
		$this->txtI7->MaxLength = Sampleloc::I7MaxLength;
	}

	// Create and Setup txtI8
	protected function txtI8_Create() {
		$this->txtI8 = new QTextBox($this);
		$this->txtI8->Name = QApplication::Translate('I 8');
		$this->txtI8->Text = $this->objSampleloc->I8;
		$this->txtI8->MaxLength = Sampleloc::I8MaxLength;
	}

	// Create and Setup txtUsername
	protected function txtUsername_Create() {
		$this->txtUsername = new QTextBox($this);
		$this->txtUsername->Name = QApplication::Translate('Username');
		$this->txtUsername->Text = $this->objSampleloc->Username;
		$this->txtUsername->Required = true;
		$this->txtUsername->MaxLength = Sampleloc::UsernameMaxLength;
	}

	// Create and Setup calDate
	protected function calDate_Create() {
		$this->calDate = new QDateTimePicker($this);
		$this->calDate->Name = QApplication::Translate('Date');
		$this->calDate->DateTime = $this->objSampleloc->Date;
		$this->calDate->DateTimePickerType = QDateTimePickerType::Date;
		$this->calDate->Required = true;
	}

	// Create and Setup lblId
	protected function lblId_Create() {
		$this->lblId = new QLabel($this);
		$this->lblId->Name = QApplication::Translate('Id');
		if ($this->blnEditMode)
			$this->lblId->Text = $this->objSampleloc->Id;
		else
			$this->lblId->Text = 'N/A';
	}


	// Setup btnSave
	protected function btnSave_Create() {
		$this->btnSave = new QButton($this);
		$this->btnSave->Text = QApplication::Translate('Save');
		$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
		$this->btnSave->PrimaryButton = true;
		$this->btnSave->CausesValidation = true;
	}

	// Setup btnCancel
	protected function btnCancel_Create() {
		$this->btnCancel = new QButton($this);
		$this->btnCancel->Text = QApplication::Translate('Cancel');
		$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));
		$this->btnCancel->CausesValidation = false;
	}

	// Setup btnDelete
	protected function btnDelete_Create() {
		$this->btnDelete = new QButton($this);
		$this->btnDelete->Text = QApplication::Translate('Delete');
		$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Sampleloc')));
		$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
		$this->btnDelete->CausesValidation = false;
		if (!$this->blnEditMode)
			$this->btnDelete->Visible = false;
	}

	// Protected Update Methods
	protected function UpdateSamplelocFields() {
		$this->objSampleloc->BoxId = $this->lstBox->SelectedValue;
		$this->objSampleloc->Samptype = $this->txtSamptype->Text;
		$this->objSampleloc->A0 = $this->txtA0->Text;
		$this->objSampleloc->A1 = $this->txtA1->Text;
		$this->objSampleloc->A2 = $this->txtA2->Text;
		$this->objSampleloc->A3 = $this->txtA3->Text;
		$this->objSampleloc->A4 = $this->txtA4->Text;
		$this->objSampleloc->A5 = $this->txtA5->Text;
		$this->objSampleloc->A6 = $this->txtA6->Text;
		$this->objSampleloc->A7 = $this->txtA7->Text;
		$this->objSampleloc->A8 = $this->txtA8->Text;
		$this->objSampleloc->B0 = $this->txtB0->Text;
		$this->objSampleloc->B1 = $this->txtB1->Text;
		$this->objSampleloc->B2 = $this->txtB2->Text;
		$this->objSampleloc->B3 = $this->txtB3->Text;
		$this->objSampleloc->B4 = $this->txtB4->Text;
		$this->objSampleloc->B5 = $this->txtB5->Text;
		$this->objSampleloc->B6 = $this->txtB6->Text;
		$this->objSampleloc->B7 = $this->txtB7->Text;
		$this->objSampleloc->B8 = $this->txtB8->Text;
		$this->objSampleloc->C0 = $this->txtC0->Text;
		$this->objSampleloc->C1 = $this->txtC1->Text;
		$this->objSampleloc->C2 = $this->txtC2->Text;
		$this->objSampleloc->C3 = $this->txtC3->Text;
		$this->objSampleloc->C4 = $this->txtC4->Text;
		$this->objSampleloc->C5 = $this->txtC5->Text;
		$this->objSampleloc->C6 = $this->txtC6->Text;
		$this->objSampleloc->C7 = $this->txtC7->Text;
		$this->objSampleloc->C8 = $this->txtC8->Text;
		$this->objSampleloc->D0 = $this->txtD0->Text;
		$this->objSampleloc->D1 = $this->txtD1->Text;
		$this->objSampleloc->D2 = $this->txtD2->Text;
		$this->objSampleloc->D3 = $this->txtD3->Text;
		$this->objSampleloc->D4 = $this->txtD4->Text;
		$this->objSampleloc->D5 = $this->txtD5->Text;
		$this->objSampleloc->D6 = $this->txtD6->Text;
		$this->objSampleloc->D7 = $this->txtD7->Text;
		$this->objSampleloc->D8 = $this->txtD8->Text;
		$this->objSampleloc->E0 = $this->txtE0->Text;
		$this->objSampleloc->E1 = $this->txtE1->Text;
		$this->objSampleloc->E2 = $this->txtE2->Text;
		$this->objSampleloc->E3 = $this->txtE3->Text;
		$this->objSampleloc->E4 = $this->txtE4->Text;
		$this->objSampleloc->E5 = $this->txtE5->Text;
		$this->objSampleloc->E6 = $this->txtE6->Text;
		$this->objSampleloc->E7 = $this->txtE7->Text;
		$this->objSampleloc->E8 = $this->txtE8->Text;
		$this->objSampleloc->F0 = $this->txtF0->Text;
		$this->objSampleloc->F1 = $this->txtF1->Text;
		$this->objSampleloc->F2 = $this->txtF2->Text;
		$this->objSampleloc->F3 = $this->txtF3->Text;
		$this->objSampleloc->F4 = $this->txtF4->Text;
		$this->objSampleloc->F5 = $this->txtF5->Text;
		$this->objSampleloc->F6 = $this->txtF6->Text;
		$this->objSampleloc->F7 = $this->txtF7->Text;
		$this->objSampleloc->F8 = $this->txtF8->Text;
		$this->objSampleloc->G0 = $this->txtG0->Text;
		$this->objSampleloc->G1 = $this->txtG1->Text;
		$this->objSampleloc->G2 = $this->txtG2->Text;
		$this->objSampleloc->G3 = $this->txtG3->Text;
		$this->objSampleloc->G4 = $this->txtG4->Text;
		$this->objSampleloc->G5 = $this->txtG5->Text;
		$this->objSampleloc->G6 = $this->txtG6->Text;
		$this->objSampleloc->G7 = $this->txtG7->Text;
		$this->objSampleloc->G8 = $this->txtG8->Text;
		$this->objSampleloc->H0 = $this->txtH0->Text;
		$this->objSampleloc->H1 = $this->txtH1->Text;
		$this->objSampleloc->H2 = $this->txtH2->Text;
		$this->objSampleloc->H3 = $this->txtH3->Text;
		$this->objSampleloc->H4 = $this->txtH4->Text;
		$this->objSampleloc->H5 = $this->txtH5->Text;
		$this->objSampleloc->H6 = $this->txtH6->Text;
		$this->objSampleloc->H7 = $this->txtH7->Text;
		$this->objSampleloc->H8 = $this->txtH8->Text;
		$this->objSampleloc->I0 = $this->txtI0->Text;
		$this->objSampleloc->I1 = $this->txtI1->Text;
		$this->objSampleloc->I2 = $this->txtI2->Text;
		$this->objSampleloc->I3 = $this->txtI3->Text;
		$this->objSampleloc->I4 = $this->txtI4->Text;
		$this->objSampleloc->I5 = $this->txtI5->Text;
		$this->objSampleloc->I6 = $this->txtI6->Text;
		$this->objSampleloc->I7 = $this->txtI7->Text;
		$this->objSampleloc->I8 = $this->txtI8->Text;
		$this->objSampleloc->Username = $this->txtUsername->Text;
		$this->objSampleloc->Date = $this->calDate->DateTime;
	}


	// Control ServerActions
	public function btnSave_Click($strFormId, $strControlId, $strParameter) {
		$this->UpdateSamplelocFields();
		$this->objSampleloc->Save();


		$this->CloseSelf(true);
	}

	public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
		$this->CloseSelf(false);
	}

	public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

		$this->objSampleloc->Delete();

		$this->CloseSelf(true);
	}

	protected function CloseSelf($blnChangesMade) {
		$strMethod = $this->strClosePanelMethod;
		$this->objForm->$strMethod($blnChangesMade);
	}
}
?>