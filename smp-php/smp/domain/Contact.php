<?php
/**
 * Created at 21/07/2010 12:13:00 PM
 * __FILE__
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/DomainObject.php');
class smp_domain_Contact extends smp_domain_DomainObject {
	private $address;
	private $city;
	private $postcode;
	private $phoneHome;
	private $phoneWork;
	private $email;
	private $userId;
	private $studentId;
	
	function __construct($id = -1) {
		parent::__construct($id);
	}

	function setAddrees ($address) {
		$this->address = $address;
	}
	function setCity ($city) {
		$this->city = $city;
	}
	function setPostcode ($postcode) {
		$this->postcode = $postcode;
	}
	function setPhoneHome ($phoneHome) {
		$this->phoneHome = $phoneHome;
	}
	function setPhoneWork ($phoneWork) {
		$this->phoneWork = $phoneWork;
	}
	function setEmail ($email) {
		$this->email = $email;
	}
	function setUserId ($userId) {
		$this->userId = $userId;
	}
	function setStudentId ($studentId) {
		$this->studentId = $studentId;
	}

	function getAddrees() {
		return $this->address;
	}
	function getCity() {
		return $this->city;
	}
	function getPostcode() {
		return $this->postcode;
	}
	function getPhoneHome() {
		return $this->phoneHome;
	}
	function getPhoneWork() {
		return $this->phoneWork;
	}
	function getEmail() {
		return $this->email;
	}
	function getUserId() {
		return $this->userId;
	}
	function getStudentId() {
		return $this->studentId;
	}
	
	function __toString() {
		$contactString = $this->getId();
		$contactString .= ", " . $this->getAddrees();
		$contactString .= ", " . $this->getCity();
		$contactString .= ", " . $this->getPostcode();
		return $contactString;		
	}	
	
}