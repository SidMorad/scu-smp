<?php
/**
 * Created at 06/09/2010 11:56:29 AM
 * smp_command_mentor_ShowMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/MentorService.php');
require_once('smp/service/UserService.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/ContactService.php');
class smp_command_mentor_ShowMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$id = $request->getProperty('id');
		
		$mentorService = new smp_service_MentorService();
		$userService = new smp_service_UserService();
		$studentService = new smp_service_StudentService();
		$contactService = new smp_service_ContactService();
		
		$mentor = $mentorService->find($id);
		$mentor->setUser($userService->find($mentor->getUserId()));
		$mentor->setStudent($studentService->find($mentor->getStudentId()));
		$mentor->setContact($contactService->find($mentor->getContactId()));
		
		$request->setEntity($mentor);
		$request->setTitle('Mentor Info | '.$mentor->getStudent());
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}	
}