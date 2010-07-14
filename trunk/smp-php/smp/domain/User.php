<?php
/**
 * Created at 06/07/2010 5:39:14 PM
 * smp_domain_User
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/DomainObject.php');
class smp_domain_User extends smp_domain_DomainObject {

	private $username;
	private $password;
	private $scuEmail;
	
	private $roles = array();
	
	function __construct($id =-1, $username, $password = null, $scuEmail = null) {
		parent::__construct($id);
		$this->username = $username;
		$this->password = $password;
		$this->scuEmail = $scuEmail;
	}
	
	function getUsername() {
		return $this->username;
	}	
	
	function setUsername($username) {
		$this->username = $username;
	}
	
	function getPassword() {
		return $this->password;
	}
	
	function setPassword($password) {
		$this->password = $password;
	}
	
	function setScuEmail($scuEmail) {
		$this->scuEmail = $scuEmail;
	}
	
	function getScuEmail() {
		return $this->scuEmail;
	}
	
	function getRoles() {
		return $this->roles;
	}
	
	function addToRoles($roleName) {
		$this->roles[] = $roleName;
	}

	function __toString() {
		$userString = $this->getUsername();
		$userString .= ", " . $this->getScuEmail();
		return $userString;	
	}

}