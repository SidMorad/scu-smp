<?php
/**
 * Created at 06/07/2010 12:01:45 PM
 * smp_util_Validator
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/RequestRegistry.php');
class smp_util_Validator {
	private $properties;
	private $errors;
	
	/**
	 * constructor 
	 */
	function __construct() {
		$this->init();
		smp_base_RequestRegistry::setValidator($this);
	}
	
	/**
	 * Initalize properties from $_REQUEST or $_SERVER['argv']
	 */
	function init() {
		if(isset($_SERVER['REQUEST_METHOD'])) {
			$this->properties = $_REQUEST;
		}
	}
	
	function checkEmptiness($strKey, $strErrorMessage) {
		if (empty($this->properties[$strKey])) {
			$this->setError($strKey, $strErrorMessage);
		}
	}
	
	function checkCustomVal($strKey, $strMessage, $blnValidation) {
		if (!$blnValidation) {
			$this->setError($strKey, $strMessage);
		}
	}
	
	function setError($strKey, $strErrorMessage) {
		if (!isset($this->errors[$strKey])) {
			$this->errors[$strKey] = $strErrorMessage;
		}
	}

	function getErrorMessagesString($strIndent = "	") {
		$strErrMsgs = "";
		if ($this->isInvalid()) {
			$strErrMsgs = $strIndent."<ul class=\"ulError\">\r\n";
			foreach($this->errors as $strErrMsg) {
				$strErrMsgs .= $strIndent."	<li>".$strErrMsg."</li>\r\n";
			}
			$strErrMsgs .= $strIndent."</ul>\r\n";
		}
		return $strErrMsgs;
	}
	
	function isValid() {
		if (count($this->errors) == 0) {
			return true;	
		} else {
			return false;
		}
	}
	
	function isInvalid() {
		return !$this->isValid();
	}
	
	function getProperty($key) {
		if (isset($this->properties[$key])) {
			return $this->properties[$key];
		}
		return null;
	}	
	
}