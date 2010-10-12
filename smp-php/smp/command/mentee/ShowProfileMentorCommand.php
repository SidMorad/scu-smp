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
require_once('smp/service/MenteeService.php');
require_once('smp/service/MentorService.php');
require_once('smp/service/UserService.php');
class smp_command_mentee_ShowProfileMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$studentService = new smp_service_StudentService();
		$menteeService = new smp_service_MenteeService();
		$mentorService = new smp_service_MentorService();
		$contactService = new smp_service_ContactService();
		$userService = new smp_service_UserService();
		$securityUtil = new smp_util_Security();
		$currentUser = $securityUtil->getCurrentUser();
		
		$mentee = new smp_domain_Mentee();
		$mentee->setUserId($currentUser->getId());
		$mentee = $menteeService->findWithMentee($mentee);

		$mentor = $mentorService->findMentorWithMenteeId($mentee->getId());
		if (!is_null($mentor)) {
			$mentor = $mentorService->findFilledMentor($mentor->getId()); 
			$mentee->setMentor($mentor);
		}

		$request->setEntity($mentee);
		$request->setTitle("My Mentor's Information");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MENTEE);
	}	
}