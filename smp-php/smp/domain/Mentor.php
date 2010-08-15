<?php
/**
 * Created at 06/08/2010 11:23:39 AM
 * smp_domain_Mentor
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/DomainObject.php');
require_once('smp/domain/User.php');
require_once('smp/domain/Student.php');
require_once('smp/domain/Contact.php');
class smp_domain_Mentor extends smp_domain_DomainObject {
	private $user;
	private $student;
	private $contact;
	private $userId;
	private $studentId;
	private $contactId;
	private $menteeLimit;
	private $menteeContactConfirm;
	private $trained;
	private $matched;
	private $expired;
	private $mentees;
	
	function __construct(smp_domain_User $user = null, smp_domain_Student $student = null, smp_domain_Contact $contact = null, $id = -1) {
		$this->id = $id;
		$this->user = $user;
		$this->student = $student;
		$this->contact = $contact;
	}

	public function getUser(){
		return (is_null($this->user) ? new smp_domain_User() : $this->user);
	}
	public function getStudent(){
		return (is_null($this->student) ? new smp_domain_Student() : $this->student);
	}
	public function getContact(){
		return (is_null($this->contact) ? new smp_domain_Contact() : $this->contact);
	}

	public function setUser(smp_domain_User $user){
		$this->user = $user;
	}
	public function setStudent(smp_domain_Student $student){
		$this->student = $student;
	}
	public function setContact(smp_domain_Contact $contact){
		$this->contact = $contact;
	}

	public function getUserId() {
	    return $this->userId;
	}
	public function setUserId($userId) {
	    $this->userId = $userId;
	}

	public function getStudentId() {
	    return $this->studentId;
	}
	public function setStudentId($studentId) {
	    $this->studentId = $studentId;
	}

	public function getContactId() {
	    return $this->contactId;
	}
	public function setContactId($contactId) {
	    $this->contactId = $contactId;
	}
	
	public function getMenteeLimit() {
		return $this->menteeLimit;
	}

	public function setMenteeLimit($menteeLimit) {
		$this->menteeLimit = $menteeLimit;
	}

	public function getMenteeContactConfirm() {
	    return $this->menteeContactConfirm;
	}

	public function setMenteeContactConfirm($menteeContactConfirm) {
	    $this->menteeContactConfirm = $menteeContactConfirm;
	}
	
	public function getTrained() {
		return $this->trained;
	}

	public function setTrained($trained) {
		$this->trained = $trained;
	}

	public function getMatched() {
		return $this->matched;
	}

	public function setMatched($matched) {
		$this->matched = $matched;
	}

	public function getExpired() {
		return $this->expired;
	}

	public function setExpired($expired) {
		$this->expired = $expired;
	}

	public function getMentees() {
	    return $this->mentees;
	}

	public function setMentees($mentees) {
	    $this->mentees = $mentees;
	}
}