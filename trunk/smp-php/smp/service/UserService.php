<?php
/**
 * Created at 06/07/2010 1:35:02 PM
 * smp_service_UserService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/UserMapper.php');
class smp_service_UserService {
	private $userMapper;
	
	function __construct(smp_mapper_UserMapper $userMapper) {
		$this->userMapper = $userMapper;
	}
	
	/**
	 * Find User by username
	 * @param $username
	 * @return smp_domain_User  
	 */
	function findByUsername($username) {
		return $this->userMapper->findByUsername($username);	
	}
	
	/**
	 * 
	 * @param smp_domain_User
	 */
	function findUserRoles(smp_domain_User $user) {
		return $this->userMapper->findUserRoles($user);
	}
}