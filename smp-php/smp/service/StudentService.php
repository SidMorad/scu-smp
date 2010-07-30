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
	
	function __construct() {
		$this->studentMapper = new smp_mapper_StudentMapper();
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
	
	function findStudentMenteesWithMentorId($id) {
		return $this->studentMapper->findStudentMenteesWithMentorId($id);
	}
}