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

	function textBox($strId, $strLabel, $strValue, $strType="text", $intMaxLength = 0, $intTabIndex = null, $grid_X = "grid_12", $arrOtherAttributes = array(), $classCSS = "input") {
		$strMaxLength = $this->getHtmlAttributeString($intMaxLength > 0 , "maxlength", $intMaxLength);
		$strTabIndex  = $this->getHtmlAttributeString($intTabIndex != NULL, "tabindex", $intTabIndex);
		$classCSS = $this->getCSSclassIsError($strId, $classCSS);
		$strClassCSS  = $this->getHtmlAttributeString($classCSS != null, "class", $classCSS);
		$strLocator = $this->getLocatorString($strId, $classCSS);
		$strValue = $this->getValueIfIsSet($strId);
		$strValue = (($strType == "password") ? "" : $strValue);
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		$strField = "<input id=\"".$strId."\" name =\"".$strId."\" type=\"".$strType."\" value =\"".$strValue."\"".$strOtherAttributes.$strMaxLength.$strTabIndex.$strClassCSS.$strLocator." />";
		return $this->getHtmlTagString($strLabel, $strField, $strId, $grid_X);
	}
	
	function label($strId, $strLabel, $grid_X = "grid_1", $arrOtherAttributes = array()) {
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		$forAttribute = (($strId != NULL) ? " for=\"".$strId."\" " : "");
		$strLabelTag = "<label$forAttribute$strOtherAttributes> $strLabel </label>";
		$labelString = $this->strIndent. "	<div class=\"".$grid_X."\" >\r\n";
		$labelString .= $this->strIndent. "		".$strLabelTag . "\r\n";	
		$labelString .= $this->strIndent."	</div>\r\n";
		return $labelString;
	}

	function submit($strId, $strCaption, $intTabIndex = NULL ,$grid_X= "grid_12", $arrOtherAttributes = array(), $classCSS = "input") {
		$strTabIndex = $this->getHtmlAttributeString($intTabIndex != NULL, "tabindex", $intTabIndex);
		$strClassCSS  = $this->getHtmlAttributeString($classCSS != null, "class", $classCSS);
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		$strLocator = $this->getLocatorString($strId, "input");
		$strField = "<input id=\"".$strId."\" type=\"submit\" value=\"".$strCaption."\"".$strTabIndex.$strOtherAttributes.$strClassCSS.$strLocator." />";
		return $this->getHtmlTagString("", $strField, $strId, $grid_X);
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
		$strLocator = (($this->blnLocator) ?  " onfocus=\"javascript:ChangeClassName('".$strId."', 'selected');\" onblur=\"javascript:ChangeClassName('".$strId."', '".$strClassCSS."');\"" : "" );
		return $strLocator;
	}
	
	private function getHtmlTagString($strLabel, $strField, $strId, $grid_X = "grid_12") {
		$htmlTagString = $this->strIndent. "	<div class=\"".$grid_X."\">\r\n";
		if ($strLabel != "") {
			$htmlTagString .= $this->strIndent."		".(($strId != NULL) ? "<label for=\"".$strId."\">" : "").$strLabel.(($strId != NULL) ? "</label>" : "" ). "\r\n";
			$htmlTagString .= $this->strIndent."		".$strField."\r\n";
		} else {
			$htmlTagString .= $this->strIndent."		".$strField."\r\n";
		}
		$htmlTagString .= $this->strIndent."	</div>\r\n";	
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
			return "error";
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