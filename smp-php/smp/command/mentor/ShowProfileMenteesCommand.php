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
require_once('smp/domain/Mentor.php');
require_once('smp/service/MentorService.php');
class smp_command_mentor_ShowProfileMenteesCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$securityUtil = new smp_util_Security();
		$currentUser = $securityUtil->getCurrentUser();
		
		$mentorService = new smp_service_MentorService();
		$mentor = new smp_domain_Mentor();
		$mentor->setUserId($currentUser->getId());
		$mentor = $mentorService->findWithMentor($mentor);
		
		$mentor = $mentorService->findMentorStudentMentees($mentor->getId());
		
		$request->setEntity($mentor);
		$request->setTitle("My Mentees(".count($mentor->getMentees()).")");		
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MENTOR);
	}	
}