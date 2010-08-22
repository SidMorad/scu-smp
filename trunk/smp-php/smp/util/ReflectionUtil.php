<?php
/**
 * Created at 22/08/2010 11:28:09 AM
 * smp_util_ReflectionUtil
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/DomainObject.php');
require_once('smp/domain/Student.php');
require_once('smp/domain/Mentor.php');
class smp_util_ReflectionUtil {

	static function getSearchCriteria(smp_domain_DomainObject $domain, $prefix = "") {
		$domainClassName = get_class($domain);
		$domainClass = new ReflectionClass($domainClassName);
		
		$searchCriteriaString = "";
		foreach($domainClass->getMethods() as $method) {
			$searchCriteriaString .= self::getCriteriaFromMethod($domain, $method, $prefix);
		}
		
		return (empty($searchCriteriaString) ? "" : substr($searchCriteriaString , 0, -5));
	}

	static function getEqualsCriteria(smp_domain_DomainObject $domain, $prefix = "") {
		$domainClassName = get_class($domain);
		$domainClass = new ReflectionClass($domainClassName);
		
		$searchCriteriaString = "";
		foreach($domainClass->getMethods() as $method) {
			$searchCriteriaString .= self::getCriteriaFromMethod($domain, $method, $prefix, 'equals');
		}
		
		return (empty($searchCriteriaString) ? "" : substr($searchCriteriaString , 0, -5));
	}
	
	static private function getCriteriaFromMethod(smp_domain_DomainObject $domain, ReflectionMethod $method, $prefix = "", $sqlCondition = 'search') {
		$name = $method->getName();
		
		if (substr($name, 0, 3) != "get") {
			return "";
		}
		
		$value = $method->invoke($domain);
		if ($value instanceOf smp_domain_DomainObject || null === $value) {
			return "";
		}
		if (!is_bool($value) && empty($value)) {
			return "";
		} else if (is_bool($value) && empty($value)) {
			$value = 0; // This will fix the Criteria when boolean value is FALSE.
		}		
		
		$property = substr($name , 3);
		$databaseProperty = self::convertPropertyNameToDatabaseFormat($property);
		
		// If the property is 'id' and it's value is '-1' then ignore it.
		if ($databaseProperty == 'id' && $value == -1) {
			return "";
		}
		
		if ($sqlCondition == 'search') {
			return $prefix.$databaseProperty . " LIKE '%" . $value . "%' AND ";;
		} else if ($sqlCondition == 'equals'){
			return $prefix.$databaseProperty . " = '" . $value . "' AND ";;
		}
	}

	static private function convertPropertyNameToDatabaseFormat($string) {
		return strtolower(preg_replace('/([a-z0-9])([A-Z])/', "$1_$2", $string));
	}
	
}