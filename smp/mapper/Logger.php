<?php
/**
 * Created at 14/07/2010 8:39:37 PM
 * smp_mapper_Logger
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_mapper_Logger {
	protected static $ADODB;
	
	function __construct() {
		if (! isset(self::$ADODB)) {
			$dsn = smp_base_ApplicationRegistry::getDSN();
			if (is_null($dsn)) {
				throw new smp_base_AppException("No DSN founded!");
			}
			self::$ADODB = NewADOConnection($dsn);
			self::$ADODB->debug = false;
			self::$ADODB->autoRollback = false;
		}
	}
	
	protected function doCreateObject(array $array) {}
	
	protected function targetClass() {
		return "smp_domain_Log";
	}

	protected function doInsert(smp_domain_DomainObject $obj) {
		$insertStmt = self::$ADODB->Prepare("INSERT INTO smp_log (title, msg, user_id) values(?,?,?)");
		$values = array($obj->getTitle(), $obj->getMsg(), $obj->getUserId());
		return self::$ADODB->Execute($insertStmt, $values);
	}

	public function save(smp_domain_Log $log) {
		$rs = self::doInsert($log);
		if ($rs === false) {
//			throw new Exception("Log insert failed". self::$ADODB->ErrorMsg());	
		}
	}
	
} 