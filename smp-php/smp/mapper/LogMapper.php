<?php
/**
 * Created at 14/07/2010 8:39:37 PM
 * smp_mapper_LogMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_mapper_LogMapper extends smp_mapper_Mapper {
	
	function __construct() {
		parent::__construct();
		$this->selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_log");
		$this->insertStmt = self::$ADODB->Prepare("INSERT INTO smp_log (title, msg, user_id) values(?,?,?)");
	}
	
	protected function doCreateObject(array $array) {}
	
	protected function targetClass() {
		return "smp_domain_Log";
	}

	protected function doInsert(smp_domain_DomainObject $obj) {
		$values = array($obj->getTitle(), $obj->getMsg(), $obj->getUserId());
		return self::$ADODB->Execute($this->insertStmt, $values);
	}

	public function save(smp_domain_Log $log) {
		$rs = self::doInsert($log);
		if ($rs === false) {
//			throw new Exception("Log insert failed". self::$ADODB->ErrorMsg());	
		}
	}
	
} 