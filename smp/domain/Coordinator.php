<?php
/**
 * Created at 01/10/2010 2:00:48 PM
 * smp_domain_Coordinator
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_domain_Coordinator extends smp_domain_DomainObject {
	
	var $userId;
	var $firstname;
	var $lastname;
	var $user;
	
	function __construct($id =-1, $firstname = null, $lastname = null, $userId = null) {
		parent::__construct($id);
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->userId = $userId;
	}

	public function getUserId() {
	    return $this->userId;
	}

	public function setUserId($userId) {
	    $this->userId = $userId;
	}

	public function getFirstname() {
	    return $this->firstname;
	}

	public function setFirstname($firstname) {
	    $this->firstname = $firstname;
	}

	public function getLastname() {
	    return $this->lastname;
	}

	public function setLastname($lastname) {
	    $this->lastname = $lastname;
	}
	
	public function getUser() {
	    return $this->user;
	}

	public function setUser($user) {
	    $this->user = $user;
	}
}