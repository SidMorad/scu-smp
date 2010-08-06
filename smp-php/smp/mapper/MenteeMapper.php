<?php
/**
 * Created at 06/08/2010 12:14:50 PM
 * smp_mentor_MenteeMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/Mentee.php');
require_once('smp/mapper/Mapper.php');
require_once('smp/mapper/UserMapper.php');
require_once('smp/mapper/StudentMapper.php');
require_once('smp/mapper/ContactMapper.php');
require_once('smp/mapper/MentorMenteeMapper.php');
class smp_mapper_MenteeMapper {
	private $userMapper;
	private $studentMapper;
	private $contactMapper;
	private $mentorMenteeMapper;
	function __construct() {
		$this->userMapper = new smp_mapper_UserMapper();
		$this->studentMapper = new smp_mapper_StudentMapper();
		$this->contactMapper = new smp_mapper_ContactMapper();
		$this->mentorMenteeMapper = new smp_mapper_MentorMenteeMapper();
	}
	
	function findMenteeWithStudentId($studentId) {
		$student = $this->studentMapper->find($studentId);
		$user = $this->userMapper->findUserWithStudentId($studentId);
		$contact = $this->contactMapper->findContactWithUserId($user->getId());
		$mentee = new smp_domain_Mentee($user, $student, $contact);
		return $mentee;
	}
	
	function findMenteesWithMentorStudentId ($studentId) {
		$students = $this->studentMapper->findStudentMenteesWithMentorId($studentId);
		$list = array();
		foreach ($students as $student) {
			$mentee = self::findMenteeWithStudentId($student->getId());
			$mentee->setRelation($this->mentorMenteeMapper->findRelationWithMenteeId($student->getId()));
			$list[] = $mentee;
		}
		return $list;
	}
}