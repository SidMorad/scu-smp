<?php
/**
 * Created at 14/07/2010 11:02:36 PM
 * smp_service_RoleService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/RoleMapper.php');
class smp_service_RoleService {
	private $roleMapper;
	
	function __construct() {
		$this->roleMapper = new smp_mapper_RoleMapper();
	}
	
	function findRoleByName($name) {
		return $this->roleMapper->findRoleByName($name);
	}
	
	function findRoleIdsByRoleNames($roleNames) {
		$arrRoleIds = array();
		foreach ($roleNames as $roleName) {
			$role = self::findRoleByName($roleName);
			$arrRoleIds[] = $role->getId();			
		}
		return $arrRoleIds;
	}
}