<?php
/**
 * Created at 04/07/2010 6:43:21 PM
 * smp_util_FormBuilder
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_util_FormBuilder {

	var $strFileName = "";
	var $strIndent   = "";
	var $blnLocator = false;
	var $values = array();
	var $errors = array();
	
	function __construct() {
		preg_match("/[^\/]*$/", $_SERVER['PHP_SELF'], $arrSub);
		$this->strFileName = $arrSub[0];
	}

	function open($strId, $strAction = "", $strMethod = "post", $strEnctype = "multipart", $arrOtherAttributes = array()) {
		$strId = $this->getHtmlAttributeString($strId == "", "id", $strId);
		$strAction = (($strAction == "") ? $this->strFileName : $strAction);
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		switch ($strMethod) {
			case "get":
				$strMethod = "get";
				break;
			case "post":
				$strMethod = "post";
				break;
			default:
				$strMethod = "post";
				break;
		}
		switch ($strEnctype) {
			case "text":
				$strEnctype = "text/plain";
				break;
			case "urlencoded":
				$strEnctype = "application/x-www-form-urlencoded";
				break;
			case "multipart":
				$strEnctype = "multipart/form-data";
				break;
			default:
				$strEnctype = "multipart/form-data";
				break;
		}
		$openString = $this->strIndent."<div class=\"form_container\">\r\n";
		$openString .=$this->strIndent."<form ".$strId." action=\"".$strAction."\" method=\"".$strMethod."\"".$strOtherAttributes." enctype=\"".$strEnctype."\">\r\n"; 
		return $openString; 
	}

	function close() {
		$closeString = $this->strIndent."</form>\r\n";
		$closeString .= $this->strIndent."</div>\r\n";
		return $closeString;
	}

	function textBox($strId, $strLabel, $strValue, $intTabIndex = null, $grid_X = null, $classCSS = "input", $intMaxLength = 0, $strType="text", $arrOtherAttributes = array()) {
		$strMaxLength = $this->getHtmlAttributeString($intMaxLength > 0 , "maxlength", $intMaxLength);
		$strTabIndex  = $this->getHtmlAttributeString($intTabIndex != null, "tabindex", $intTabIndex);
		$classCSS = $this->getCSSclassIsError($strId, $classCSS);
		$strClassCSS  = $this->getHtmlAttributeString($classCSS != null, "class", $classCSS);
		$strLocator = $this->getLocatorString($strId, $classCSS);
		$strValue = $this->getValueIfIsSet($strId);
		$strValue = (($strType == "password") ? "" : $strValue);
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		$strField = "<input id=\"".$strId."\" name =\"".$strId."\" type=\"".$strType."\" value =\"".$strValue."\"".$strOtherAttributes.$strMaxLength.$strTabIndex.$strClassCSS.$strLocator." />";
		return $this->getHtmlTagString($strLabel, $strField, $strId, $grid_X);
	}
	
	function selectBox($strId, $strLabel, $strValue, $intTabIndex = null, $grid_X = null, $arrOptions, $classCSS = "select", $intSize = 0, $blnMultiSelect = false, $arrOtherAttributes = array()) {
		$strOptions = "";
		$strSelected = "";
		while (list($strKey, $strVal) = each ($arrOptions)) {
			$newStrId = ($blnMultiSelect ? str_replace("[]", "", $strId) : $strId);
			if (isset($this->values[$newStrId])) {
				if ($blnMultiSelect) {
					$strSelected = ((in_array($strKey, $this->values[$newStrId])) ? "selected=\"selected\"" : "");
				} else {
					$strSelected = (($this->values[$newStrId] == $strKey) ? "selected=\"selected\"" : "");
				}
			} else {
				if($blnMultiSelect) {
					$strSelected = ((in_array($strKey, $strValue)) ? " selected=\"selected\"" : "" );
				} else {
					$strSelected = (($strValue == $strKey) ? " selected=\"selected\"" : "" );
				}
			}
			$strOptions .= $this->strIndent."        		<option value=\"$strKey\" $strSelected>$strVal</option>\r\n";
		}
		$strTabIndex = $this->getHtmlAttributeString($intTabIndex != null, "tabindex", $intTabIndex);
		$strSize = $this->getHtmlAttributeString($intSize > 0, "size", $intSize);
		$strMultiSelect = $this->getHtmlAttributeString($blnMultiSelect, "multiple", "multiple");
		$classCSS = $this->getCSSclassIsError($strId, $classCSS);
		$strClassCSS  = $this->getHtmlAttributeString($classCSS != null, "class", $classCSS);
		$strLocator = $this->getLocatorString($strId, $classCSS);
		$strField = "\r\n".$this->strIndent."		<select id=\"$strId\" name=\"$strId\"".$strTabIndex.$strClassCSS.$strSize.$strMultiSelect.$strLocator.">\r\n";
		$strField .= $strOptions;
		$strField .= $this->strIndent."		</select>\r\n";
		return $this->getHtmlTagString($strLabel, $strField, $strId,$grid_X);
	}
	
	function redioBox($strId, $intTabIndex = null, $grid_X = null, $arrItems, $classCSS = "input", $strCheckedItem = "", $arrOtherAttributes = array()) {
		$strFieldCombined = $this->strIndent."\r\n";
		$strTabIndex = $this->getHtmlAttributeString($intTabIndex != null, "tabindex", $intTabIndex);
		$strClassCSS = $this->getHtmlAttributeString($classCSS != null, "class", $classCSS);
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		while (list($strKey, $strVal) = each($arrItems)) {
			$strChecked = "";
			if ($this->isPost()) {
				$strChecked = (((isset($this->values[$strId])? $this->values[$strId]: "") == $strKey) ? " checked=\"checked\"" : "");
			} else {
				$strChecked = (($strCheckedItem == $strKey) ? " checked=\checked\"" : "");
			}
			$strField = "<input id=\"".$strId."-".$strKey."\" name=\"$strId\" type=\"radio\" value=\"$strKey\"".$strChecked.$strTabIndex.$strClassCSS.$strOtherAttributes." >$strVal</input>";
			$strFieldCombined .= $this->getHtmlTagString("", $strField, $strId."-".$strKey);
		}
		return $this->getHtmlTagString("", $strFieldCombined, $strId, $grid_X);
	}
	
	function checkBox($strId, $strLabel, $intTabIndex = null, $grid_X = null, $classCSS = "checkbox", $blnChecked = false, $strValue="1", $arrOtherOptions = array()) {
		$strTabIndex = $this->getHtmlAttributeString($intTabIndex != null, "tabindex", $intTabIndex );
		$strClassCSS = $this->getHtmlAttributeString($classCSS != null, "class", $classCSS);
		$strOtherAttributes = $this->getOtherAttributes($arrOtherOptions);
		if ($this->isPost()) {
			$strChecked = ((isset($this->values[$strId])) ? "checked=\"checked\"" : "");
		} else {
			$strChecked = (($blnChecked) ? "checked=\"checked\"" : "");
		}
		$strField = "<input id=\"$strId\" name=\"$strId\" type=\"checkbox\" value=\"$strValue\"".$strChecked.$strTabIndex.$strClassCSS.$strOtherAttributes." />";
		return $this->getHtmlTagString($strLabel, $strField,$strId, $grid_X);
	}
	
	function textArea($strId, $strLabel, $strValue, $intTabIndex = null, $grid_X = null, $intCols = 23, $intRows = 3, $classCSS = "textarea") {
		$strTabIndex = $this->getHtmlAttributeString($intTabIndex != null, "tabindex", $intTabIndex);
		$classCSS = $this->getCSSclassIsError($strId, $classCSS);
		$strClassCSS  = $this->getHtmlAttributeString($classCSS != null, "class", $classCSS);
		$strLocator = $this->getLocatorString($strId, $classCSS);
		$strField = "<textarea id=\"$strId\" name=\"$strId\" rows=\"$intRows\" cols=\"$intCols\"".$strTabIndex.$strClassCSS.$strLocator.">$strValue</textarea>";
		return $this->getHtmlTagString($strLabel, $strField, $strId, $grid_X);
	}
	
	function label($strId, $strLabel, $grid_X = null, $blnRequired = false, $arrOtherAttributes = array()) {
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		$forAttribute = (($strId != null) ? " for=\"".$strId."\" " : "");
		$strRequired = ($blnRequired ? "<span class=\"required\">*</span>" : "");
		$strLabelTag = "<label class=\"label\"$forAttribute$strOtherAttributes>".$strLabel.$strRequired."</label>";
		$labelString = $this->strIndent. "	<div class=\"".$grid_X."\" >\r\n";
		$labelString .= $this->strIndent. "		".$strLabelTag . "\r\n";	
		$labelString .= $this->strIndent."	</div>\r\n";
		return $labelString;
	}
	
	function note($grid_X = null, $string) {
		$strNote = "";
		$strNote .= ($grid_X != null ? $this->strIndent . "	<div class=\"".$grid_X."\" >\r\n" : "");
		$strNote .= $this->strIndent. "	<p>$string</p>\r\n";
		$strNote .= ($grid_X != null ? $this->strIndent . "	</div>\r\n" : "");
		return $strNote;
	} 

	function hx($hx, $grid_X = null, $string) {
		$strNote = "";
		$strNote .= ($grid_X != null ? $this->strIndent . "	<div class=\"".$grid_X."\" >\r\n" : "");
		$strNote .= $this->strIndent. "	<$hx>$string</$hx>\r\n";
		$strNote .= ($grid_X != null ? $this->strIndent . "	</div>\r\n" : "");
		return $strNote;
	} 
	
	function hr() {
		return $this->strIndent. "	<hr/>\r\n";
	}

	function button($strId, $strCaption,$strType= "submit", $intTabIndex = null ,$grid_X= null, $classCSS = "button", $arrOtherAttributes = array()) {
		$strTabIndex = $this->getHtmlAttributeString($intTabIndex != null, "tabindex", $intTabIndex);
		$strClassCSS  = $this->getHtmlAttributeString($classCSS != null, "class", $classCSS);
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		$strLocator = $this->getLocatorString($strId, $classCSS);
		$strField = "<input id=\"".$strId."\" type=\"$strType\" value=\"".$strCaption."\"".$strTabIndex.$strOtherAttributes.$strClassCSS.$strLocator." />";
		return $this->getHtmlTagString("", $strField, $strId, $grid_X);
	}
	
	function submitAndResetButton($strId,$strSubmitCaption,$strResetCaption, $intTabIndex = null, $grid_X = null, $classCSS = "button", $arrOtherAttributes = array()) {
		$strFieldCombined = $this->strIndent. "\r\n".$this->button($strId."1", $strSubmitCaption, "submit", $intTabIndex,null,$classCSS, $arrOtherAttributes);
		$strFieldCombined .= $this->button($strId."2", $strResetCaption, "reset", $intTabIndex,null,$classCSS, $arrOtherAttributes);
		return $this->getHtmlTagString("", $strFieldCombined, $strId, $grid_X);
	}
		
	function hidden($strId, $strValue) {
		return $this->strIndent."	<input id=\"".$strId."\" name=\"".$strId."\" type=\"hidden\" value=\"".$strValue."\" />\r\n";
	}

	function setIndent($strIndent) {
		$this->strIndent = $strIndent;
	}

	public function isPost() {
		if (strtoupper($_SERVER['REQUEST_METHOD']) == "POST") {
			return true;
		} else {
			return false;
		}
	}
	
	function useLocator() {
		$this->blnLocator = true;
	}

	private function getLocatorString($strId, $strClassCSS) {
		$strLocator = (($this->blnLocator) ?  " onfocus=\"javascript:ChangeClassName('".$strId."', 'selected_".$strClassCSS."');\" onblur=\"javascript:ChangeClassName('".$strId."', '".$strClassCSS."');\"" : "" );
		return $strLocator;
	}
	
	private function getHtmlTagString($strLabel, $strField, $strId, $grid_X = null) {
		$htmlTagString = ($grid_X != null ? $this->strIndent. "	<div class=\"".$grid_X."\">\r\n" : "");
		if ($strLabel != "") {
			$htmlTagString .= $this->strIndent."		".(($strId != null) ? "<label for=\"".$strId."\">" : "").$strLabel.(($strId != null) ? "</label>" : "" ). "\r\n";
			$htmlTagString .= $this->strIndent."		".$strField."\r\n";
		} else {
			$htmlTagString .= $this->strIndent."		".$strField."\r\n";
		}
		$htmlTagString .= ($grid_X != null ? $this->strIndent."	</div>\r\n" : "");	
		return $htmlTagString;
	}

	private function getHtmlAttributeString($condition, $attribute , $value) {
		if ($condition) {
			return " $attribute=\"".$value."\"";
		} else {
			return "";
		}
	}

/*	private function stripSlashes($strValue) {
		if (get_magic_quotes_gpc()) {
			return stripcslashes($strValue);
		} else {
			return $strValue;
		}
	}*/

	private function getOtherAttributes($arrOtherAttributes) {
		$strOtherAttributes = "";
		while (list($strArrKey, $strArrValue) = each($arrOtherAttributes)) {
			$strOtherAttributes .= " ".$strArrKey/"=\"".$strArrValue."\"";
		}
		return $strOtherAttributes;
	}

	function getCSSclassIsError($strId, $defaultCSS) {
		if (isset($this->errors[$strId])) {
			return "error_".$defaultCSS;
		} else {
			return $defaultCSS;
		}
	}
	
	function getValueIfIsSet($strId) {
		if (isset($this->values[$strId])) {
			return $this->values[$strId];
		} else {
			return "";
		}
	}
	
	function setErrors($errorArray) {
		$this->errors = $errorArray;
	}
	
	function setValues($valueArray) {
		$this->values = $valueArray;
	}
}