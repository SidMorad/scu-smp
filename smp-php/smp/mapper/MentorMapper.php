<?php
/**
 * Created at 06/08/2010 12:02:03 PM
 * smp_mentor_MentorMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/Mentor.php');
require_once('smp/mapper/Mapper.php');
require_once('smp/mapper/UserMapper.php');
require_once('smp/mapper/StudentMapper.php');
require_once('smp/mapper/ContactMapper.php');
class smp_mapper_MentorMapper {
	private $userMapper;
	private $studentMapper;
	private $contactMapper;
	
	function __construct() {
		$this->userMapper = new smp_mapper_UserMapper();
		$this->studentMapper = new smp_mapper_StudentMapper();
		$this->contactMapper = new smp_mapper_ContactMapper();
	}
	
	function findMentorWithStudentId($studentId) {
		$student = $this->studentMapper->find($studentId);
		$user = $this->userMapper->findUserWithStudentId($studentId);
		$contact = $this->contactMapper->findContactWithUserId($user->getId());
		$mentor = new smp_domain_Mentor($user, $student, $contact);
		return $mentor;
	}

	function findMentorWithStudentMenteeId($studentId) {
		$student = $this->studentMapper->findStudentMentorWithMenteeId($studentId);
		$user = $this->userMapper->findUserWithStudentId($student->getId());
		$contact = $this->contactMapper->findContactWithUserId($user->getId());
		$mentor = new smp_domain_Mentor($user, $student, $contact);
		return $mentor;
	}
}