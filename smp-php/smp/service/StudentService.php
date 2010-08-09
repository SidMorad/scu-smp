<?php
/**
 * Created at 16/07/2010 3:08:24 PM
 * smp_service_StudentService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/StudentMapper.php');
class smp_service_StudentService {
	private $studentMapper;
	private $mentorMapper;
	private $menteeMapper;
	
	function __construct() {
		$this->studentMapper = new smp_mapper_StudentMapper();
		$this->mentorMapper = new smp_mapper_MentorMapper();
		$this->menteeMapper = new smp_mapper_MenteeMapper();
	}
	
	function save(smp_domain_Student $student) {
		return $this->studentMapper->save($student);
	}
	
	function listMentors() {
		return $this->studentMapper->listMentors();
	}

	function listMentees() {
		return $this->studentMapper->listMentees();
	}
	
	function listStudentWithAccountStatus($accountStatus) {
		return $this->studentMapper->listStudentWithAccountStatus($accountStatus);
	}
	
	function listStudentWithAccountStatuses(array $arrAccountStatus) {
		return $this->studentMapper->listStudentWithAccountStatuses($arrAccountStatus);
	}
	
	function find($id) {
		return $this->studentMapper->find($id);
	}
	
	function findStudentWithUser($user) {
		return $this->studentMapper->findStudentWithUser($user);
	}
	
	/**
	 * This method will return array of smp_domain_Student object
	 * @param Student Id $id
	 */
	function findStudentMenteesWithMentorId($id) {
		return $this->studentMapper->findStudentMenteesWithMentorId($id);
	}

	/**
	 * This method will return array of smp_domain_Mentee object
	 * @param Student Id $id
	 */
	function findMenteesWithMentorId($id) {
		return $this->menteeMapper->findMenteesWithMentorStudentId($id);
	}

	/**
	 * This method will return smp_domain_Student
	 * @param Studnet Id $id
	 */
	function findStudentMentorWithMenteeId($id) {
		return $this->studentMapper->findStudentMentorWithMenteeId($id);
	}

	/**
	 * This method will return smp_domain_Mentor
	 * @param Studnet Id $id
	 */
	function findMentorWithMenteeId($id) {
		return $this->mentorMapper->findMentorWithStudentMenteeId($id);
	}
}