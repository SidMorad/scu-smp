<?php
/**
 * Created at 30/07/2010 9:30:16 AM
 * smp_command_mentor_ShowProfileCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/util/Security.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/ContactService.php');
class smp_command_mentor_ShowProfileCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$securityUtil = new smp_util_Security();
		$currentUser = $securityUtil->getCurrentUser();
		
		$studentService = new smp_service_StudentService();
		$student = $studentService->findStudentWithUser($currentUser);
		$student->setUser($currentUser);

		$contactService = new smp_service_ContactService();
		$contact = $contactService->findContactWithUserId($currentUser->getId());
		if (!is_null($contact)) {$student->setContact($contact);}

		$request->setEntity($student);
		$request->setTitle("Profile");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MENTOR);
	}
}