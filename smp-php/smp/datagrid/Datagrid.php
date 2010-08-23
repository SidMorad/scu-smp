<?php
/**
 * Created at 21/08/2010 10:32:11 PM
 * smp_datagrid_Datagrid
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('PEAR.php');
require_once('Structures/DataGrid.php');
require_once('smp/base/ApplicationRegistry.php');
require_once('smp/base/AppException.php');
require_once('smp/util/ReflectionUtil.php');
abstract class smp_datagrid_Datagrid {
	protected static $DSN;
	protected static $options;
	protected static $datagrid;
	
	function __construct() {
		if (! isset(self::$DSN)) {
			$dsn = smp_base_ApplicationRegistry::getMDB2DSN();
			if (is_null($dsn)) {
				throw new smp_base_AppException('No DSN founded! for MDB2');
			}
			self::$DSN = $dsn;
		}
		self::$options = array('dsn' => self::$DSN);
		self::$options['generate_columns'] = true;
		self::$datagrid = new Structures_DataGrid(10);
	}
	
	protected function getSearchCriteria($domain, $prefix = "", $withAnd = false) {
		if (is_null($domain)) {
			$searchCriteria = "";
		} else {
			$extractedInfo = smp_util_ReflectionUtil::getSearchCriteria($domain, $prefix); 
			if (empty($extractedInfo)) {
				$searchCriteria = "";
			} else {
				$searchCriteria = ($withAnd ? " AND " . $extractedInfo : " ".$extractedInfo);
			}
		}
		return $searchCriteria;
	}

	protected function getEqualsCriteria($domain, $prefix = "", $withAnd = false) {
		if (is_null($domain)) {
			$searchCriteria = "";
		} else {
			$extractedInfo = smp_util_ReflectionUtil::getEqualsCriteria($domain, $prefix); 
			if (empty($extractedInfo)) {
				$searchCriteria = "";
			} else {
				$searchCriteria = ($withAnd ? " AND " . $extractedInfo : " ".$extractedInfo);	
			}
		}
		return $searchCriteria;
	}
}