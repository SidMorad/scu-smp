<?php
/**
 * Created at 23/07/2010 2:02:32 PM
 * smp_service_MatchingService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/StudentService.php');
class smp_service_MatchingService {
	private $studentMapper;
	private $studentService;
	
	function __construct() {
		$this->studentMapper = new smp_mapper_StudentMapper();
		$this->studentService = new smp_service_StudentService();
	}
	
	function listNewMentees() {
		return $this->studentService->listStudentWithAccountStatus(Constants::AS_NEW_MENTEE);
	}
	
	function connectMenteeToMentor($menteeId, $mentorId) {
		return $this->studentMapper->connectMenteeToMentor($menteeId, $mentorId);
	}

	function markMentorAsTrained($mentorId) {
		return $this->studentMapper->markMentorAsTrained($mentorId);
	}
	
	function loadMentorMenteeRelationsWithMentorStudent($student) {
		return $this->mentorMapper->loadMentorMenteeRelationsWithMentorStudent($student);
	}
}