<?php
/**
 * Created at 02/08/2010 1:52:40 PM
 * smp_command_student_ShowProfileMenteeMentorCommand
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/util/Security.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/ContactService.php');
class smp_command_student_ShowProfileMenteeMentorCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$securityUtil = new smp_util_Security();
		$currentUser = $securityUtil->getCurrentUser();

		$studentService = new smp_service_StudentService();
		$student = $studentService->findStudentWithUser($currentUser);
		$student->setUser($currentUser);

		$mentor = $studentService->findMentorWithMenteeId($student->getId());
		$student->setMentor($mentor);

		$request->setEntity($student);
		$request->setTitle("My Mentor");
	}
}