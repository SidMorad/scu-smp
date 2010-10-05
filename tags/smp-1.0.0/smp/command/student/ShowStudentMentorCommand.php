<?php
/**
 * Created at 30/07/2010 12:15:16 PM
 * smp_command_student_ShowStudentMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/UserService.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/ContactService.php');
class smp_command_student_ShowStudentMentorCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$mentorId = $request->getProperty('mentorId');
		
		$studentService = new smp_service_StudentService();
		$student = $studentService->find($mentorId);

		$userService = new smp_service_UserService();
		$user = $userService->find($student->getUserId());
		$student->setUser($user);	

		$contactService = new smp_service_ContactService();
		$contact = $contactService->findContactWithUserId($user->getId());
		if (!is_null($contact)) {$student->setContact($contact);}	
		
		$request->setEntity($student);
		$request->setTitle("Mentor Details");	
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}		
}