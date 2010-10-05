<?php
/**
 * Created at 14/07/2010 8:29:46 PM
 * smp_domain_Log
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/DomainObject.php');
class smp_domain_Log extends smp_domain_DomainObject {

	private $time;
	private $title;
	private $msg;
	private $userId;
	
	function __construct($title, $msg, $id = -1, $userId = null) {
		parent::__construct($id);
		$this->title = $title;
		$this->msg = $msg;
		$this->userId = $userId;
	}
	
	function setMsg($msg) {
		$this->msg = $msg;
	}	
	
	function setUserId($userId) {
		$this->userId = $userId;
	}
	
	function getMsg() {
		return $this->msg;
	}
	
	function getUserId() {
		return $this->userId;
	}
	
	function getTitle() {
		return $this->title;
	}
	
}