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
		return $this->strIndent."<form ".$strId." action=\"".$strAction."\" method=\"".$strMethod."\"".$strOtherAttributes." enctype=\"".$strEnctype."\">\r\n";
	}

	function close() {
		return $this->strIndent."</form>\r\n";
	}

	function textBox($strId, $strLabel, $strValue, $strType="text", $intMaxLength = 0, $intTabIndex = null, $arrOtherAttributes = array()) {
		$strMaxLength = $this->getHtmlAttributeString($intMaxLength > 0 , "maxlength", $intMaxLength);
		$strTabIndex  = $this->getHtmlAttributeString($intTabIndex != NULL, "tabindex", $intTabIndex);
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		$strField = "<input id=\"".$strId."\" name =\"".$strId."\" type=\"".$strType."\" value =\"".$strValue."\"".$strOtherAttributes.$strMaxLength.$strTabIndex." />";
		return $this->getHtmlTagString($strLabel, $strField, $strId);
	}

	function submit($strId, $strCaption, $intTabIndex = NULL ,$arrOtherAttributes = array()) {
		$strTabIndex = $this->getHtmlAttributeString($intTabIndex != NULL, "tabindex", $intTabIndex);
		$strOtherAttributes = $this->getOtherAttributes($arrOtherAttributes);
		$strField = "<input id=\"".$strId."\" type=\"submit\" value=\"".$strCaption."\"".$strTabIndex.$strOtherAttributes. " />";
		return $this->getHtmlTagString("", $strField, $strId);
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

	private function getHtmlTagString($strLabel, $strField, $strId) {
		$strPlaceHolder = "";
		if ($strLabel != "") {
			$strPlaceHolder .= $this->strIndent."	".(($strId != NULL) ? "<label for=\"".$strId."\">" : "").$strLabel.(($strId != NULL) ? "</label>" : "" ). "\r\n";
			$strPlaceHolder .= $this->strIndent."	".$strField."\r\n";
		} else {
			$strPlaceHolder .= $this->strIndent."	".$strField."\r\n";
		}
		return $strPlaceHolder;
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

}