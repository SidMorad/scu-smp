<?php
/**
 * Created at 30/07/2010 12:46:06 PM
 * smp_command_mentor_ShowProfileMenteesCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/util/Security.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/ContactService.php');
class smp_command_mentor_ShowProfileMenteesCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$securityUtil = new smp_util_Security();
		$currentUser = $securityUtil->getCurrentUser();
		
		$studentService = new smp_service_StudentService();
		$student = $studentService->findStudentWithUser($currentUser);
		$student->setUser($currentUser);
		
		$mentees = $studentService->findMenteesWithStudentId($student->getId());
		$student->setMentees($mentees);
		
		$request->setEntity($student);
		$request->setTitle("My Mentees(".count($mentees).")");		
	}
}