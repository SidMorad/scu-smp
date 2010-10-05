<?php
/**
 * Created at 06/08/2010 11:01:27 AM
 * smp_domain_MentorMentee
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/DomainObject.php');
class smp_domain_MentorMentee extends smp_domain_DomainObject {
	private $mentorId;
	private $menteeId;
	private $mentorContactConfirm;
	private $mentorContactConfirmTime;
	private $createTime;
	private $expired;
	
	function __construct($mentorId = null, $menteeId = null, $createTime = null, $expired = false, $id = -1) {
		parent::setId($id);
		$this->mentorId = $mentorId;
		$this->menteeId = $menteeId;
		$this->createTime = $createTime;
		$this->expired = $expired;
	}
	
	function setMentorId ($mentorId) {
		$this->mentorId = $mentorId;
	}
	function getMentorId() {
		return $this->mentorId;
	}

	function setMenteeId ($menteeId) {
		$this->menteeId = $menteeId;
	}
	function getMenteeId() {
		return $this->menteeId;
	}

	function setCreateTime ($createTime) {
		$this->createTime = $createTime;
	} 
	function getCreateTime() {
		return $this->createTime;
	}

	function setExpired ($expired) {
		$this->expired = $expired;
	}
	function getExpired() {
		return $this->expired;
	}

	public function setMentorContactConfirm($mentorContactConfirm) {
	    $this->mentorContactConfirm = $mentorContactConfirm;
	}
	public function getMentorContactConfirm() {
	    return $this->mentorContactConfirm;
	}

	public function setMentorContactConfirmTime($mentorContactConfirmTime) {
	    $this->mentorContactConfirmTime = $mentorContactConfirmTime;
	}
	public function getMentorContactConfirmTime() {
	    return $this->mentorContactConfirmTime;
	}
}