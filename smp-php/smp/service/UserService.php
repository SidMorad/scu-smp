<?php
/**
 * Created at 06/07/2010 1:35:02 PM
 * smp_service_UserService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/UserMapper.php');
require_once('smp/service/RoleService.php');
class smp_service_UserService {
	private $userMapper;
	private $roleService;
	
	function __construct() {
		$this->userMapper = new smp_mapper_UserMapper();
		$this->roleService = new smp_service_RoleService();
	}

	function update($user) {
		return $this->userMapper->update($user);
	}
	
	/**
	 * Find User by id
	 * @param $id
	 * @return smp_domain_User  
	 */
	function find($id) {
		return $this->userMapper->find($id);	
	}

	/**
	 * Find User by username
	 * @param $username
	 * @return smp_domain_User  
	 */
	function findUserByUsername($username) {
		return $this->userMapper->findUserByUsername($username);	
	}

	/**
	 * Find User by scu email address
	 * @param $scuEmail
	 * @return smp_domain_User  
	 */
	function findUserByScuEmail($username) {
		return $this->userMapper->findUserByScuEmail($username);	
	}
	
	/**
	 * 
	 * @param smp_domain_User
	 */
	function findUserRoles(smp_domain_User $user) {
		return $this->userMapper->findUserRoles($user);
	}
	
	/**
	 * Save new User and return it with new Id.
	 * 
	 * @param $user
	 * @return $user
	 */
	function save(smp_domain_User $user) {
		$savedUser = $this->userMapper->save($user);
		if (!is_null($savedUser)) {
			$arrRoleIds = $this->roleService->findRoleIdsByRoleNames($user->getRoles());
			$this->userMapper->saveUserRoles($savedUser->getId(), $arrRoleIds);
		}
		return $savedUser;	
	}
}