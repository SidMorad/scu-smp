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
class smp_service_MenteeService {
	protected $studentMapper;
	protected $menteeMapper;
	
	function __construct() {
		$this->menteeMapper = new smp_mapper_MenteeMapper();
		$this->studentMapper = new smp_mapper_StudentMapper();
	}

	function findAllMatchedMentees() {
		return $this->menteeMapper->findAllMatchedMentees();
	}
	
	function findAllNotMatchedMentees() {
		return $this->menteeMapper->findAllNotMatchedMentees();
	}
	
	function find($id) {
		return $this->menteeMapper->find($id);
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