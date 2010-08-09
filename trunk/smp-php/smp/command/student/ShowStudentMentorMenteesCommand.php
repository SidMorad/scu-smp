<?php
/**
 * Created at 30/07/2010 2:22:56 PM
 * smp_command_student_ShowStudentMentorMenteesCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/util/Security.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/ContactService.php');
require_once('smp/mapper/MenteeMapper.php');
class smp_command_student_ShowStudentMentorMenteesCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$mentorId = $request->getProperty('mentorId');
		
		$studentService = new smp_service_StudentService();
		$student = $studentService->find($mentorId);
		
		$mentees = $studentService->findMenteesWithMentorId($student->getId());
		$student->setMentees($mentees);
		
		$request->setEntity($student);
		$request->setTitle("Mentor's Mentees");
	}
}