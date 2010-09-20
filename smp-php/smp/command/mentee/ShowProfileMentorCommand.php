<?php
/**
 * Created at 20/09/2010 10:18:41 AM
 * smp_command_mentee_ShowProfileMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/util/Security.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/ContactService.php');
class smp_command_mentee_ShowProfileMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$securityUtil = new smp_util_Security();
		$currentUser = $securityUtil->getCurrentUser();

		$studentService = new smp_service_StudentService();
		$student = $studentService->findStudentWithUser($currentUser);
		$student->setUser($currentUser);

		$mentor = $studentService->findMentorForMenteeWithStudentId($student->getId());
		if (!is_null($mentor)) { $student->setMentor($mentor);}

		$request->setEntity($student);
		$request->setTitle("My Mentor's Information");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MENTEE);
	}	
}