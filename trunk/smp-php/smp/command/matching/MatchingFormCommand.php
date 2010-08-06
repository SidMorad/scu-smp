<?php
/**
 * Created at 23/07/2010 2:45:00 PM
 * smp_command_matching_MatchingFormCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/MatchingService.php');
require_once('smp/util/Validator.php');
class smp_command_matching_MatchingFormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) { 
		$studentService = new smp_service_StudentService();
		$matchingService = new smp_service_MatchingService();
		$menteeId = $request->getProperty('menteeId');
		if (is_null($menteeId)) {
			$request->setTitle("List of New Mentees");
			$request->addFeedback("Mentee Id was not found, please select Mentee again.");
			$request->setList($matchingService->listNewMentees());
			$request->forward("matching/listNewMentees");
			return;
		}
		
		if($request->isPost()) {
			$validator = new smp_util_Validator();
			$validator->checkEmptiness("mentorId", "Please select one of Mentors.");
			if ($validator->isValid()) {
				$mentorId = $validator->getProperty('mentorId');
				
				$result = $matchingService->connectMenteeToMentor($menteeId, $mentorId);
				if ($result) {
					$request->addFeedback("Matching Mentee was successful");
				} else {
					$validator->setError("mentorId", "Matching faild! (Database Error)");
				}
			}
			if ($validator->isValid()) {
				$request->setTitle("List of New Mentees");
				$request->setList($matchingService->listNewMentees());
				$request->forward("matching/listNewMentees");
				return;
			}
		
		}
		
		$mentee = $studentService->find($menteeId);
		$request->setEntity($mentee);
		
		$listTrainedMentors = $studentService->listStudentWithAccountStatuses(array(Constants::AS_TRAINED_MENTOR, Constants::AS_MATCHED_MENTOR));
		foreach($listTrainedMentors as $mentor) {
			$mentor->setMentees($studentService->findStudentMenteesWithMentorId($mentor->getId()));
		}
		$request->setList($listTrainedMentors);
		
		$request->setTitle("Mentee Matching form");
	}
}