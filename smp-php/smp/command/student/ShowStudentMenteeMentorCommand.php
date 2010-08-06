<?php
/**
 * Created at 02/08/2010 3:43:20 PM
 * smp_command_student_ShowStudentMenteeMentorCommand
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/util/Security.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/ContactService.php');
require_once('smp/mapper/MentorMenteeMapper.php');
require_once('smp/mapper/MentorMapper.php');
class smp_command_student_ShowStudentMenteeMentorCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$menteeId = $request->getProperty('menteeId');
		
		$studentService = new smp_service_StudentService();
		$student = $studentService->find($menteeId);
		
		$mentorMapper = new smp_mapper_MentorMapper();
		$mentor = $mentorMapper->findMentorWithStudentId($student->getId());
		$student->setMentor($mentor);
		
		$mentorMenteeMapper = new smp_mapper_MentorMenteeMapper();
		$relation = $mentorMenteeMapper->findRelationWithMenteeId($student->getId());
		$student->setRelation($relation);
		
		$request->setEntity($student);
		$request->setTitle("Mentee's Mentor");
	}
}