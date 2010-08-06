<?php
/**
 * Created at 06/07/2010 12:01:45 PM
 * smp_util_Validator
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/RequestRegistry.php');
require_once('library/htmLawed/htmLawed.php');
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
	 * Initalize properties from $_REQUEST
	 */
	function init() {
		if(isset($_SERVER['REQUEST_METHOD'])) {
			while (list($strKey, $value) = each($_REQUEST)) {
				if (is_array($value)) {
					$this->properties[$strKey] = $value;
				} else {
					$strVal = trim($value);
					$strVal = $this->validateByHtmLawed($strVal);
					$this->properties[$strKey] = $strVal;
				}				
			}
		}
	}
	/**
	 * Validate submitted values by htmLawed 
	 *  TODO: The return value in not correct at this time!!!  
	 *  
	 * @param string $strVal
	 * @return string $strSafe
	 */
	function validateByHtmLawed($strVal) {
		if (get_magic_quotes_gpc()) {
			$strVal = stripslashes($strVal);
		}
		$strSafe = htmLawed($strVal, array('safe'=>1));
		return $strSafe;		
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
	
	function checkWithRegex($strKey, $strMessage, $strPattern) {
		if (preg_match($strPattern, $this->properties[$strKey]) === 0) {
			$this->setError($strKey, $strMessage);
		}
	}
	
	function setError($strKey, $strErrorMessage) {
		if (!isset($this->errors[$strKey])) {
			$this->errors[$strKey] = $strErrorMessage;
		}
	}

	function notEmpty($strKey) {
		if (empty($this->properties[$strKey])) {
			return false;
		}
		return true;
	}
	
	function getErrorMessagesString($strIndent = "	") {
		$strErrMsgs = "";
		if ($this->isInvalid()) {
			$strErrMsgs = $strIndent."<ul class=\"ulError\">\r\n";
			foreach($this->errors as $strErrMsg) {
				$strErrMsgs .= $strIndent."	<li>".$strErrMsg."</li>\r\n";
			}
			$strErrMsgs .= $strIndent."</ul>\r\n";
			$strErrMsgs .= $strIndent."<br/>\r\n";
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
	
	function getValues() {
		return $this->properties;
	}
	
	function getErrors() {
		return $this->errors;
	}
	
	function printProperties () {
		return print_r($this->properties);
	}
}