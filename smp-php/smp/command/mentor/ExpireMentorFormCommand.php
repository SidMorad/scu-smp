<?php
/**
 * Created at 20/09/2010 5:14:06 PM
 * smp_command_mentor_ExpireMentorFormCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/MentorService.php');
class smp_command_mentor_ExpireMentorFormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		
		$mentorId = $request->getProperty('mentorId');
		if (is_null($mentorId)) {
			$request->addFeedback("Please Select Mentor for being Marked as Expired Mentor!");
		} else {
			$result = $mentorService->markMentorAsExpired($mentorId);
			if ($result) {
				$request->addFeedback("Selected Mentor by id [".$mentorId."] updated as Expired Mentor.");
			} else {
				$request->addError("Selected Mentor by id [".$mentorId."] did not updated as Expired Mentor.");
			}
		}
		
		$request->redirect("mentor/listMatchedMentor");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}	
}