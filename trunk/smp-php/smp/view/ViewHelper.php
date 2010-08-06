<?php
/**
 * Created at 04/07/2010 8:10:51 PM
 * VH
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/base/RequestRegistry.php');
require_once('smp/base/SessionRegistry.php');
require_once('smp/util/Security.php');
require_once('smp/util/OptionProvider.php');
class VH {
	static function getRequest() {
		return smp_base_RequestRegistry::getRequest();
	}
	
	static function getValidator() {
		return smp_base_RequestRegistry::getValidator();
	}
	
	static function getCurrentUser() {
		return smp_util_Security::getCurrentUser();
	}
	
	static function isUserAuthenticated() {
		return smp_util_Security::isUserAuthenticated();
	}
	
	static function isUserGrantedWith($ROLE_NAME) {
		return smp_util_Security::isUserGrantedWith($ROLE_NAME);
	}
	
	static function getFixArray($type) {
		return smp_util_OptionProvider::getFixArray($type);
	}
	
	static function getValueFromFixArray($type, $key) {
		$array = smp_util_OptionProvider::getFixArray($type);
		return (isset($array[$key]) ? $array[$key] : "-");
	}
	
	static function getValueFromBoolean($value) {
		if (is_null($value)) {
			return "-";
		} else {
			if ($value == true) {
				return "Yes";
			} else {
				return "No";
			}
		}
	}
	
	/**
	 * This method is for Check null values. 
	 */
	static function chN($value) {
		if (is_null($value)) {
			return "-";
		} else if (empty($value)){
			return "&nbsp;";
		} else {	
			return $value;
		}
	}
}