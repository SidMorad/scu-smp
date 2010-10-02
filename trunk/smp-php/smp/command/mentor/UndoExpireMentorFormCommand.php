<?php
/**
 * Created at 20/09/2010 10:32:20 PM
 * smp_command_mentor_UndoExpireMentorFormCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/MentorService.php');
class smp_command_mentor_UndoExpireMentorFormCommand extends smp_command_Command {
		
	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		
		$mentorId = $request->getProperty('mentorId');
		if (is_null($mentorId)) {
			$request->addFeedback("Please Select Mentor for being Marked as Not Expired Mentor!");
		} else {
			$result = $mentorService->markMentorAsNotExpired($mentorId);
			if ($result) {
				$request->addFeedback("Selected Mentor by id [".$mentorId."] updated as Not Expired Mentor.");
			} else {
				$request->addError("Selected Mentor by id [".$mentorId."] did not updated as Not Expired Mentor.");
			}
		}
		
		$request->redirect("mentor/listMatchedMentor");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}	
	
}