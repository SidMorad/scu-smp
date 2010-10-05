<?php
/**
 * Created at 06/07/2010 4:47:20 PM
 * smp_mapper_Mapper
 *
 * This class is a part of 'Mapper' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('library/adodb511/adodb.inc.php');
require_once('smp/mapper/Logger.php');
require_once('smp/util/ReflectionUtil.php');
abstract class smp_mapper_Mapper {
	protected static $ADODB;
	protected $selectStmt;
	protected $updateStmt;
	protected $insertStmt;
	protected $logger;
	
	function __construct($adodb = null) {
		if (!is_null($adodb)) {
			self::$ADODB = $adodb;
		}
		if (! isset(self::$ADODB)) {
			$dsn = smp_base_ApplicationRegistry::getDSN();
			if (is_null($dsn)) {
				throw new smp_base_AppException("No DSN founded!");
			}
			self::$ADODB = NewADOConnection($dsn);
			self::$ADODB->debug = false;
			self::$ADODB->autoRollback = true;
		}
		if (! isset($this->logger)) {
			$this->logger = new smp_mapper_Logger();
		}
	}
	
	function find($param) {
		self::$ADODB->Execute($this->selectStmt(),array($param));
	}	
	
	protected abstract function doCreateObject(array $array);
	protected abstract function targetClass();
	protected abstract function doInsert(smp_domain_DomainObject $object);
	
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
	
}