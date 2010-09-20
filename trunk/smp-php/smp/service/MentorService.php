<?php
/**
 * Created at 09/08/2010 2:07:25 PM
 * smp_service_MentorService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */

require_once('smp/util/OptionProvider.php');
require_once('smp/mapper/MentorMapper.php');
require_once('smp/mapper/MenteeMapper.php');
require_once('smp/mapper/UserMapper.php');
require_once('smp/mapper/ContactMapper.php');
require_once('smp/datagrid/MentorDatagrid.php');
require_once('smp/util/Security.php');
class smp_service_MentorService {
	protected $mentorMapper;
	protected $menteeMapper;
	protected $studentMapper;
	protected $userMapper;
	protected $mentorDatagrid;
	
	function __construct() {
		$this->menteeMapper = new smp_mapper_MenteeMapper();
		$this->mentorMapper = new smp_mapper_MentorMapper();
		$this->studentMapper = new smp_mapper_StudentMapper();
		$this->userMapper = new smp_mapper_UserMapper();
		$this->contactMapper = new smp_mapper_ContactMapper();
		$this->mentorDatagrid = new smp_datagrid_MentorDatagrid();
	}
	
	function getCurrentMenteesEmailAddressArray() {
		$currentUser = smp_util_Security::getCurrentUser();
		$mentor = new smp_domain_Mentor();
		$mentor->setUserId($currentUser->getId());
		$mentor = self::findWithMentor($mentor);
		return $this->mentorMapper->getEmailAddressToArray($mentor);
	}
	
	function updateMentorLimit($mentorId, $menteeLimit) {
		return $this->mentorMapper->updateMentorLimit($mentorId, $menteeLimit);
	}
	
	/**
	 * This method return all Mentors.
	 * 
	 * @return Structures_DataGrid $datagrid
	 */
	function getAllMentorDatagrid($mentor = null) {
		return $this->mentorDatagrid->getAllMentorDatagrid($mentor);
	}

	/**
	 * This method return Active Mentor.
	 * Active Mentors are Trained and not Expired
	 * 
	 * @return Structures_DataGrid $datagrid
	 */
	function getActiveMentorDatagrid($mentor = null) {
		return $this->mentorDatagrid->getActiveMentorDatagrid($mentor);
	}

	/**
	 * This method return Active Mentor plus their Number of Mentee
	 * Active Mentors are Trained and not Expired
	 * 
	 * @return Structures_DataGrid $datagrid
	 */
	function getActiveMentorForMatchingDatagrid($mentor = null) {
		return $this->mentorDatagrid->getActiveMentorForMatchingDatagrid($mentor);
	}
	
	function findAllMatchedMentor() {
		return $this->mentorMapper->findAllMatchedMentor();	
	}
	
	function findAllNonTrainedMentor() {
		return $this->mentorMapper->findAllNotTrainedMentor();	
	}
	
	function findAllTrainedMentor() {
		return $this->mentorMapper->findAllTrainedMentor();	
	}
	
	function markMentorAsTrained($mentorId) {
		return $this->mentorMapper->markMentorAsTrained($mentorId);
	}
	
	function find($id) {
		return $this->mentorMapper->find($id);
	}
	
	function findWithMentor($mentor) {
		return $this->mentorMapper->findWithMentor($mentor);
	}
	
	function findFilledMentor($mentorId) {
		$mentor = self::find($mentorId);
		$mentor->setUser($this->userMapper->find($mentor->getUserId()));
		$mentor->setStudent($this->studentMapper->find($mentor->getStudentId()));
		$mentor->setContact($this->contactMapper->find($mentor->getContactId()));
		return $mentor;
	}
	
	function findMentorStudentMentees($mentorId) {
		$mentor = self::find($mentorId);
		$mentor->setStudent($this->studentMapper->find($mentor->getStudentId()));
		$mentees = $this->menteeMapper->findMenteesStudentRelationUserContactWithMentorId($mentorId);
		$mentor->setMentees($mentees);
		return $mentor;
	}

	function findMentorWithMenteeId($menteeId) {
		return $this->mentorMapper->findMentorWithMenteeId($menteeId);
	}
	
	function findMentorStudentWithMenteeId($menteeId) {
		$mentor = self::findMentorWithMenteeId($menteeId);
		$mentor->setStudent($this->studentMapper->find($mentor->getStudentId()));
		return $mentor;
	}
}