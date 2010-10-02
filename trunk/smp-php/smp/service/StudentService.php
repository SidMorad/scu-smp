<?php
/**
 * Created at 16/07/2010 3:08:24 PM
 * smp_service_StudentService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/StudentMapper.php');
require_once('smp/mapper/MentorMapper.php');
require_once('smp/mapper/MenteeMapper.php');
class smp_service_StudentService {
	private $studentMapper;
	private $mentorMapper;
	private $menteeMapper;
	
	function __construct() {
		$this->studentMapper = new smp_mapper_StudentMapper();
		$this->mentorMapper = new smp_mapper_MentorMapper();
		$this->menteeMapper = new smp_mapper_MenteeMapper();
	}
	
	function update($student) {
		return $this->studentMapper->update($student);
	}
	
	function save(smp_domain_Student $student) {
		return $this->studentMapper->save($student);
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
	function findMenteesWithStudentId($id) {
		return $this->studentMapper->findMenteesWithMentorStudentId($id);
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
	function findMentorForMenteeWithStudentId($id) {
		return $this->mentorMapper->findMentorForMenteeWithStudentId($id);
	}
}