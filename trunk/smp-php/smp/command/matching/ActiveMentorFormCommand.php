<?php
/**
 * Created at 26/07/2010 10:50:03 AM
 * smp_command_matching_ActiveMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/MatchingService.php');
class smp_command_matching_ActiveMentorFormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$studentService = new smp_service_StudentService();
		$matchingService = new smp_service_MatchingService();
		
		$mentorId = $request->getProperty('mentorId');
		if (is_null($mentorId)) {
			$request->addFeedback("Please Select Mentor for being Marked as Trained Mentor!");
		} else {
			$result = $matchingService->markMentorAsTrained($mentorId);
			if ($result) {
				$request->addFeedback("Selected Mentor by id [".$mentorId."] updated as Trained Mentor.");
			} else {
				$request->addError("Selected Mentor by id [".$mentorId."] did not updated as Trained Mentor.");
			}
		}
		
		$listNonTrainedMentor = $studentService->listStudentWithAccountStatus(Constants::AS_NEW_MENTOR);
		$request->setTitle("List of Non Trained Mentor"); 
		$request->setList($listNonTrainedMentor);
		$request->forward("matching/listNonTrainedMentor");
	}
}