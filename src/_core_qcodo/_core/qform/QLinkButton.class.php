<?php
/**
 * Feb. 21, 2019 - wpg
 * - added strAjaxAnchor to test having the link button reference some location on the page when using Ajax actions
 */
	// This class will render an HTML link <a href>, but will act like a Button or ImageButton.
	// (it is a subclass of actioncontrol)
	// Therefore, you cannot define a "URL/HREF" destination for this LinkButton.  It simply links
	// to "#".  And then if a ClientAction is defined, it will execute that when clicked.  If a ServerAction
	// is defined, it will execute PostBack and execute that when clicked.
	// * "Text" is the text of the Link

	class QLinkButton extends QActionControl {
		///////////////////////////
		// Private Member Variables
		///////////////////////////

		// APPEARANCE
		protected $strText = null;
		protected $blnHtmlEntities = true;
		protected $strAjaxAnchor = null;	// added for ajax actions where we want to use anchor references in an inline edited datagrid


		//////////
		// Methods
		//////////
		protected function GetControlHtml() {
			$strStyle = $this->GetStyleAttributes();
			if ($strStyle)
				$strStyle = sprintf('style="%s"', $strStyle);

			$strToReturn = sprintf('<a href="#%s" id="%s" %s%s>%s</a>',
				$this->strAjaxAnchor,
				$this->strControlId,
				$this->GetAttributes(),
				$strStyle,
				($this->blnHtmlEntities) ? 
					QApplication::htmlentities($this->strText ?? '') :
					$this->strText);

			return $strToReturn;
		}

		/////////////////////////
		// Public Properties: GET
		/////////////////////////
		public function __get($strName) {
			switch ($strName) {
				// APPEARANCE
				case "Text": return $this->strText;
				case "HtmlEntities": return $this->blnHtmlEntities;
				case "AjaxAnchor":return $this->strAjaxAnchor;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/////////////////////////
		// Public Properties: SET
		/////////////////////////
		public function __set($strName, $mixValue) {
			$this->blnModified = true;

			switch ($strName) {
				// APPEARANCE
				case "Text":
					try {
						$this->strText = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case "HtmlEntities":
					try {
						$this->blnHtmlEntities = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				// wpg - added Feb. 2019
				case "AjaxAnchor":
					try {
						$this->strAjaxAnchor = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
					break;
			}
		}
	}
?>