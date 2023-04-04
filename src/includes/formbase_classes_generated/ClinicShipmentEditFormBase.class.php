<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the ClinicShipment class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single ClinicShipment object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ClinicShipmentEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ClinicShipmentEditFormBase extends QForm {
		// General Form Variables
		protected $objClinicShipment;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for ClinicShipment's Data Fields
		protected $lblId;
		protected $calShipTime;
		protected $txtPreparedBy;
		protected $txtTrackingNumber;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupClinicShipment() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objClinicShipment = ClinicShipment::Load(($intId));

				if (!$this->objClinicShipment)
					throw new Exception('Could not find a ClinicShipment object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objClinicShipment = new ClinicShipment();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupClinicShipment to either Load/Edit Existing or Create New
			$this->SetupClinicShipment();

			// Create/Setup Controls for ClinicShipment's Data Fields
			$this->lblId_Create();
			$this->calShipTime_Create();
			$this->txtPreparedBy_Create();
			$this->txtTrackingNumber_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblId
		protected function lblId_Create() {
			$this->lblId = new QLabel($this);
			$this->lblId->Name = QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objClinicShipment->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup calShipTime
		protected function calShipTime_Create() {
			$this->calShipTime = new QDateTimePicker($this);
			$this->calShipTime->Name = QApplication::Translate('Ship Time');
			$this->calShipTime->DateTime = $this->objClinicShipment->ShipTime;
			$this->calShipTime->DateTimePickerType = QDateTimePickerType::DateTime;
		}

		// Create and Setup txtPreparedBy
		protected function txtPreparedBy_Create() {
			$this->txtPreparedBy = new QIntegerTextBox($this);
			$this->txtPreparedBy->Name = QApplication::Translate('Prepared By');
			$this->txtPreparedBy->Text = $this->objClinicShipment->PreparedBy;
		}

		// Create and Setup txtTrackingNumber
		protected function txtTrackingNumber_Create() {
			$this->txtTrackingNumber = new QTextBox($this);
			$this->txtTrackingNumber->Name = QApplication::Translate('Tracking Number');
			$this->txtTrackingNumber->Text = $this->objClinicShipment->TrackingNumber;
			$this->txtTrackingNumber->MaxLength = ClinicShipment::TrackingNumberMaxLength;
		}


		// Setup btnSave
		protected function btnSave_Create() {
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'ClinicShipment')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateClinicShipmentFields() {
			$this->objClinicShipment->ShipTime = $this->calShipTime->DateTime;
			$this->objClinicShipment->PreparedBy = $this->txtPreparedBy->Text;
			$this->objClinicShipment->TrackingNumber = $this->txtTrackingNumber->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateClinicShipmentFields();
			$this->objClinicShipment->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objClinicShipment->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('clinic_shipment_list.php');
		}
	}
?>