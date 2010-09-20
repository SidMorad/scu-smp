<?php
/**
 * Created at 15/08/2010 9:23:41 PM
 * smp_service_MenteeService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/MenteeMapper.php');
require_once('smp/mapper/StudentMapper.php');
require_once('smp/mapper/UserMapper.php');
require_once('smp/mapper/ContactMapper.php');
require_once('smp/datagrid/MenteeDatagrid.php');
require_once('smp/domain/Mentee.php');
class smp_service_MenteeService {
	protected $studentMapper;
	protected $menteeMapper;
	protected $menteeDatagrid;
	
	function __construct() {
		$this->menteeMapper = new smp_mapper_MenteeMapper();
		$this->studentMapper = new smp_mapper_StudentMapper();
		$this->userMapper = new smp_mapper_UserMapper();
		$this->contactMapper = new smp_mapper_ContactMapper();
		$this->menteeDatagrid = new smp_datagrid_MenteeDatagrid();
	}
	
	function getCurrentMentorEmailAddressArray() {
		$currentUser = smp_util_Security::getCurrentUser();
		$mentee = new smp_domain_Mentee();
		$mentee->setUserId($currentUser->getId());
		$mentee = self::findWithMentee($mentee);
		return $this->menteeMapper->getEmailAddressToArray($mentee);
	}

	function findAllMatchedMentees() {
		return $this->menteeMapper->findAllMatchedMentees();
	}
	
	/** This method return datagrid of all mentees.
	 * 
	 * @param smp_domain_Mentee $mentee 
	 */
	function getAllMenteeDatagrid($mentee = null){
		return $this->menteeDatagrid->getMenteeDatagrid($mentee);
	}

	/** This method return datagrid of all matched mentees.
	 * 
	 * @param smp_domain_Mentee $mentee 
	 */
	function getMatchedMenteeDatagrid($mentee = null){
		return $this->menteeDatagrid->getMatchedMenteeDatagrid($mentee);
	}
	
	function getAllNotMatchedMenteesDatagrid($mentee = null) {
		if (is_null($mentee)) {
			$mentee = new smp_domain_Mentee();
		}
		// Make sure Mentee is Not Matched and Not Expired
		$mentee->setMatched(false);
		$mentee->setExpired(false);
		return $this->menteeDatagrid->getMenteeDatagrid($mentee);
	}
	
	function find($id) {
		return $this->menteeMapper->find($id);
	}

	function findFilledMentee($menteeId) {
		$mentee = self::find($menteeId);
		$mentee->setUser($this->userMapper->find($mentee->getUserId()));
		$mentee->setStudent($this->studentMapper->find($mentee->getStudentId()));
		$mentee->setContact($this->contactMapper->find($mentee->getContactId()));
		return $mentee;
	}
	
	function findWithMentee($mentee) {
		return $this->menteeMapper->findWithMentee($mentee);
	}
	
	function findMenteesWithMentorId($mentorId) {
		return $this->menteeMapper->findMenteesWithMentorId($mentorId);
	}	
	
	function findMenteeStudent($menteeId) {
		$mentee = self::find($menteeId);
		$mentee->setStudent($this->studentMapper->find($mentee->getStudentId()));
		return $mentee;
	}
	
}