<?php
/**
 * Created at 26/07/2010 10:50:03 AM
 * smp_command_matching_ActiveMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MentorService.php');
class smp_command_matching_ActiveMentorFormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		
		$mentorId = $request->getProperty('mentorId');
		if (is_null($mentorId)) {
			$request->addFeedback("Please Select Mentor for being Marked as Trained Mentor!");
		} else {
			$result = $mentorService->markMentorAsTrained($mentorId);
			if ($result) {
				$request->addFeedback("Selected Mentor by id [".$mentorId."] updated as Trained Mentor.");
			} else {
				$request->addError("Selected Mentor by id [".$mentorId."] did not updated as Trained Mentor.");
			}
		}
		
		$request->redirect("matching/listNonTrainedMentor");
	}
}