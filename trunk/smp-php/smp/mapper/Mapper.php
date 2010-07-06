<?php
/**
 * Created at 06/07/2010 4:47:20 PM
 * smp_mapper_Mapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('library/adodb511/adodb.inc.php');
abstract class smp_mapper_Mapper {
	protected static $ADODB;
	protected $selectStmt;
	protected $updateStmt;
	protected $insertStmt;
	
	function __construct() {
		if (! isset(self::$ADODB)) {
			$dsn = smp_base_ApplicationRegistry::getDSN();
			if (is_null($dsn)) {
				throw new smp_base_AppException("No DSN founded!");
			}
			self::$ADODB = NewADOConnection($dsn);
			self::$ADODB->debug = false;
		}
	}
	
	function find($param) {
		self::$ADODB->Execute($this->selectStmt(),array($param));
	}	
	
	abstract function update( smp_domain_DomainObject $object);
	protected abstract function doCreateObject(array $array);
	protected abstract function doInsert(smp_domain_DomainObject $object);
	protected abstract function targetClass();
	protected abstract function selectStmt();
}