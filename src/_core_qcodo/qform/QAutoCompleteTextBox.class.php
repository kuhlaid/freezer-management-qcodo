<?php
	/**
	 *	QAutoCompleteTextBox 
	 *	Using the JQuery Library:
	 *		http://bassistance.de/jquery-plugins/jquery-plugin-autocomplete/
	 *
	 *	@author Zeno Yu <zeno.yu@gmail.com> [QControl Class] http://www.qcodo.com/downloads/item.php/132
	 *
	 *	@history:
	 *	2007-09-05 Javascript file packed (Credit lines remained)
	 *	2007-09-03 AJAX Support
	 *	2007-08-16 Change autofill to autoFill in the GetScript function according to the Christophe Damour post
	 *	2007-07-03 Local Data Set
	 */
	class QAutoCompleteTextBox extends QTextBoxBase{

		// APPEARANCE
		protected $strJavaScripts = 'jquery.js,jquery.autocomplete.js,dimensions.js,jquery.bgiframe.min.js';
 		protected $strCssScripts = 'jquery.autocomplete.css';

		/**
		 * Use AJAX
		 */
		protected $blnUseAjax = false;
		/**
		 * Fill the textinput while still selecting a value, replacing the value if more is type or something else is selected. Default: false
		 */
		protected $blnAutoFill=false;
		/**
		 * If set to true, the autocompleter will only allow results that are presented by the backend. Note that illegal values result in an empty input box. Default: false
		 */
		protected $blnMustMatch=false;
		/**
		 * Whether or not the comparison looks inside (i.e. does "ba" match "foo bar") the search results. Only important if you use caching. Don�t mix with autofill. Default: false
		 */
		protected $blnMatchContains=false;
		/**
		 * Whether or not the comparison is case sensitive. Only important only if you use caching. Default: false
		 */
		protected $blnMatchCase=false;
		/**
		 * The minimum number of characters a user has to type before the autocompleter activates. Default: 1
		 */
		protected $intMinChars=0;

		// TextBox CSS Class
		protected $strCssClass = 'textbox';

		// Include Once
		public static $blnIncludedCss = false;

		//////////
		// Methods
		//////////
		public function __construct($objParentObject, $strControlId = null) {
			parent::__construct($objParentObject, $strControlId);

			$this->strLabelForRequired = QApplication::Translate('%s is required');
			$this->strLabelForRequiredUnnamed = QApplication::Translate('Required');
		}

		// MISC
		protected $objItemsArray = array();

		//////////////////////////////
		// Methods From ListControl
		//////////////////////////////

		// Allows you to add a ListItem to the ListControl at the end of the private objItemsArray.
		// This method exhibits polymorphism: you can either pass in a ListItem object, **OR** you can
		// pass in three strings:
		//	* Name of the ListItem (string)
		//	* Value of the ListItem (string, optional)
		//	* Selected flag for the ListItem (bool, optional)
		public function AddItem($mixListItemOrName, $strValue = null, $blnSelected = null) {
			$this->blnModified = true;
			if (gettype($mixListItemOrName) == QType::Object)
				$objListItem = QType::Cast($mixListItemOrName, "QListItem");
			else
				$objListItem = new QListItem($mixListItemOrName, $strValue, $blnSelected);

			array_push($this->objItemsArray, $objListItem);
		}

		// Used if you wnat to add a LIstItem at a specific location in objItemsArray
		public function AddItemAt($intIndex, QListItem $objListItem) {
			$this->blnModified = true;
			try {
				$intIndex = QType::Cast($intIndex, QType::Integer);
			} catch (QInvalidCastException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
			if (($intIndex < 0) ||
				($intIndex > count($this->objItemsArray)))
				throw new QIndexOutOfRangeException($intIndex, "AddItemAt()");
			for ($intCount = count($this->objItemsArray); $intCount > $intIndex; $intCount--) {
				$this->objItemsArray[$intCount] = $this->objItemsArray[$intCount - 1];
			}

			$this->objItemsArray[$intIndex] = $objListItem;
		}

		// Gets the ListItem at a specific location in objItemsArray
		public function GetItem($intIndex) {
			try {
				$intIndex = QType::Cast($intIndex, QType::Integer);
			} catch (QInvalidCastException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
			if (($intIndex < 0) ||
				($intIndex >= count($this->objItemsArray)))
				throw new QIndexOutOfRangeException($intIndex, "GetItem()");

			return $this->objItemsArray[$intIndex];
		}

		// Removes all the items in objItemsArray
		public function RemoveAllItems() {
			$this->blnModified = true;
			$this->objItemsArray = array();
		}

		// Removes a specific ListItem at a specific location in objItemsArray
		public function RemoveItem($intIndex) {
			$this->blnModified = true;
			try {
				$intIndex = QType::Cast($intIndex, QType::Integer);
			} catch (QInvalidCastException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
			if (($intIndex < 0) ||
				($intIndex > (count($this->objItemsArray) - 1)))
				throw new QIndexOutOfRangeException($intIndex, "RemoveItem()");
			for ($intCount = $intIndex; $intCount < count($this->objItemsArray) - 1; $intCount++) {
				$this->objItemsArray[$intCount] = $this->objItemsArray[$intCount + 1];
			}

			$this->objItemsArray[$intCount] = null;
			unset($this->objItemsArray[$intCount]);
		}

		/**
		 *	CSS Setup
		 */
	    public function GetEndHtml() {
			if( !$this->blnVisible )return '';
			if( !$this->blnEnabled )return '';
			if( QAutoCompleteTextBox::$blnIncludedCss )return '';
			QAutoCompleteTextBox::$blnIncludedCss = true;
			return "<link rel='stylesheet' type='text/css' media='all' href='".__CSS_ASSETS__."/".$this->strCssScripts."' />";
	    }

		public function GetAjaxScript(){

		}
		/**
         * Refresh From AjaxAction if needed
		 */
		public function GetScript(){
			if( !$this->blnVisible )return '';
			if( !$this->blnEnabled )return '';
			// Use the AJAX backend
			if($this->blnUseAjax)
				return sprintf('$("#%s").autocomplete("%s",
										{extraParams:{Qform__FormId:"%s",Qform__FormControl:"%s"},
										%s%s%s%s%s%s%s})',
								$this->strControlId,
								QApplication::$RequestUri,
								$this->objForm->FormId,
								$this->strControlId,
								"minChars:".$this->intMinChars,
								(($this->blnAutoFill)?",autoFill:true":""),
								(($this->blnMatchContains)?",matchContains:true":""),
								(($this->blnMatchCase)?",matchCase:true":""),
								(($this->blnMustMatch)?",mustMatch:true":""),
								(($this->Width)?",width:".$this->Width:""),
								(($this->strTextMode==QTextMode::MultiLine)?",multiple:true":"")
								);
			// Use Local Data Set
			if($this->ItemCount<=0)return '';
			// ["Aberdeen", "Ada", ..]
			$arrOptions = array();
			$strJavascriptArray = "";
			if (is_array($this->objItemsArray)) {
				for ($intIndex = 0; $intIndex < $this->ItemCount; $intIndex++) {
					$objItem = $this->objItemsArray[$intIndex];
					if($this->Text=="" && $objItem->Selected)
						$this->Text = QApplication::HtmlEntities($objItem->Name);
					// Add into List
					array_push( $arrOptions, "'".QApplication::HtmlEntities($objItem->Name)."'" );
				}
				if( count( $arrOptions ) > 0){
					$strJavascriptArray = "[".implode(',', $arrOptions)."]";
				}
			}
			// Local Dataset
			return sprintf('$("#%s").autocomplete(%s,{%s%s%s%s%s%s%s})',
							$this->strControlId,
							$strJavascriptArray,
							"minChars:".$this->intMinChars,
							(($this->blnAutoFill)?",autoFill:true":""),
							(($this->blnMatchContains)?",matchContains:true":""),
							(($this->blnMatchCase)?",matchCase:true":""),
							(($this->blnMustMatch)?",mustMatch:true":""),
							(($this->Width)?",width:".$this->Width:""),
							(($this->strTextMode==QTextMode::MultiLine)?",multiple:true":"")
						);
		}
		/**
		 *	Setup the combo list
		 */
		public function GetEndScript() {
			if( !$this->blnVisible )return '';
			if( !$this->blnEnabled )return '';
			$strJavaScript = $this->GetScript();
			return "$().ready(function() {".$strJavaScript.";});";
		}

		/////////////////////////
		// Public Properties: GET (From ListControl)
		/////////////////////////
		public function __get($strName) {
			switch ($strName) {
				case "JavaScripts":return $this->strJavaScripts;	// added Oct. 14, 2018 - wpg
				case "UseAjax":return $this->blnUseAjax;
				case "AutoFill":return $this->blnAutoFill;
				case "MatchContains":return $this->blnMatchContains;
				case "MustMatch":return $this->blnMustMatch;
				case "MatchCase":return $this->blnMatchCase;
				case "MinChars":return $this->intMinChars;
				case "ItemCount":
					if ($this->objItemsArray)
						return count($this->objItemsArray);
					else
						return 0;
				case "SelectedIndex":
					for ($intIndex = 0; $intIndex < count($this->objItemsArray); $intIndex++) {
						if ($this->objItemsArray[$intIndex]->Selected)
							return $intIndex;
					}
					return -1;
				case "SelectedName":
					for ($intIndex = 0; $intIndex < count($this->objItemsArray); $intIndex++) {
						if ($this->objItemsArray[$intIndex]->Selected)
							return $this->objItemsArray[$intIndex]->Name;
					}
					return null;
				case "SelectedValue":
					for ($intIndex = 0; $intIndex < count($this->objItemsArray); $intIndex++) {
						if ($this->objItemsArray[$intIndex]->Selected)
							return $this->objItemsArray[$intIndex]->Value;
					}
					return null;
				case "SelectedItem":
					for ($intIndex = 0; $intIndex < count($this->objItemsArray); $intIndex++) {
						if ($this->objItemsArray[$intIndex]->Selected)
							return $this->objItemsArray[$intIndex];
					}
					return null;
				case "SelectedItems":
					$objToReturn = array();
					for ($intIndex = 0; $intIndex < count($this->objItemsArray); $intIndex++) {
						if ($this->objItemsArray[$intIndex]->Selected)
							array_push($objToReturn, $this->objItemsArray[$intIndex]);
//							$objToReturn[count($objToReturn)] = $this->objItemsArray[$intIndex];
					}
					return $objToReturn;
				case "SelectedNames":
					$strNamesArray = array();
					for ($intIndex = 0; $intIndex < count($this->objItemsArray); $intIndex++) {
						if ($this->objItemsArray[$intIndex]->Selected)
							array_push($strNamesArray, $this->objItemsArray[$intIndex]->Name);
//							$strNamesArray[count($strNamesArray)] = $this->objItemsArray[$intIndex]->Name;
					}
					return $strNamesArray;
				case "SelectedValues":
					$objToReturn = array();
					for ($intIndex = 0; $intIndex < count($this->objItemsArray); $intIndex++) {
						if ($this->objItemsArray[$intIndex]->Selected)
							array_push($objToReturn, $this->objItemsArray[$intIndex]->Value);
//							$objToReturn[count($objToReturn)] = $this->objItemsArray[$intIndex]->Value;
					}
					return $objToReturn;
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
				// added so we can manually load the javascript before we use bootstrap (which requires bootstrap be called after jquery)
				case "JavaScripts":
					try {
						$this->strJavaScripts = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "UseAjax":
					try {
						$this->blnUseAjax = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "CssClass":
					try {
						$this->strCssClass = QType::Cast($mixValue, QType::String);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "AutoFill":
					try {
						$this->blnAutoFill = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "MustMatch":
					try {
						$this->blnMustMatch = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "MatchCase":
					try {
						$this->blnMatchCase = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "MatchContains":
					try {
						$this->blnMatchContains = QType::Cast($mixValue, QType::Boolean);
						break;
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
				case "MinChars":
					try {
						$this->intMinChars = QType::Cast($mixValue, QType::Integer);
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
	// Empty Event
	class QAutoCompleteTextBoxEvent extends QEvent {
		protected $strJavaScriptEvent = '';
	}
?>