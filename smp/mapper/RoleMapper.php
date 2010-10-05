<?php
/**
 * Created at 14/07/2010 11:04:54 PM
 * __FILE__
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/Role.php');
require_once('smp/mapper/Mapper.php');
class smp_mapper_RoleMapper extends smp_mapper_Mapper {
	
	function __construct() {
		parent::__construct();
		$this->selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_role WHERE name=?");
	} 
	
	function findRoleByName($name) {
		$rs = self::$ADODB->Execute($this->selectStmt, array($name));
		$row = $rs->FetchRow();
		if (is_array($row)) {
			return $this->doCreateObject($row);
		}
		return null;
	}
	
	protected function doCreateObject(array $array) {
		return new smp_domain_Role($array['id'], $array['name']);
	}
	
	protected function doInsert(smp_domain_DomainObject $obj) {}	
	
	protected function targetClass() {
		return "smp_domain_Role";
	}
}