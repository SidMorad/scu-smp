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
require_once('smp/service/MenteeService.php');
require_once('smp/service/MentorService.php');
require_once('smp/util/Validator.php');
require_once('smp/domain/Mentee.php');
require_once('smp/domain/Mentor.php');
require_once('smp/base/SessionRegistry.php');
class smp_command_matching_MatchingFormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) { 
		$studentService = new smp_service_StudentService();
		$matchingService = new smp_service_MatchingService();
		$menteeService = new smp_service_MenteeService();
		$mentorService = new smp_service_MentorService();
		$menteeId = $request->getProperty('menteeId');
		if (is_null($menteeId)) {
			$request->setTitle("List of New Mentees");
			$request->addError("Mentee Id was not found, please select Mentee again.");
			$request->setDatagrid($matchingService->getAllNotMatchedMenteesDatagrid());
			$request->forward("matching/listNewMentees");
			return;
		}
		
		$mentor = new smp_domain_Mentor();
		if($request->isPost()) {
			$student = new smp_domain_Student();
			$student->setFirstname($request->getProperty('firstname'));
			$student->setLastname($request->getProperty('lastname'));
			$student->setStudentNumber($request->getProperty('studentNumber'));
			$student->setGender($request->getProperty('gender'));
			$student->setCourseId($request->getProperty('courseId'));
			$student->setStudyMode($request->getProperty('studyMode'));
			
			$action = $request->getProperty(Constants::ACTION);
			if ($action == Constants::ACTION_SUBMIT) {
				$validator = new smp_util_Validator();
				if (!$validator->checkEmptiness("mentorId", "Please select one of Mentors.")) {
					$request->addError("Please select one of Mentors.");
				}
				if ($validator->isValid()) {
					$mentorId = $validator->getProperty('mentorId');
					
					$result = $matchingService->connectMenteeToMentor($menteeId, $mentorId);
					if ($result) {
						$request->addFeedback("Matching Mentee was successful");
					} else {
						$request->addError("Matching faild! (Database Error)");
					}
				}
				if ($validator->isValid()) {
					$request->setTitle("List of New Mentees");
					$request->setDatagrid($matchingService->getAllNotMatchedMenteesDatagrid());
					$request->forward("matching/listNewMentees");
					return;
				}
			} else if ($action == Constants::ACTION_SEARCH) {
				$mentor->setStudent($student);
				smp_base_SessionRegistry::setSearchEntity('matching_MatchingForm_MentorSearch', $mentor);				
			}
		}
		$mentee = $menteeService->findMenteeStudent($menteeId);
		$request->setEntity($mentee);

		$mentor = smp_base_SessionRegistry::getSearchEntity('matching_MatchingForm_MentorSearch');
		$request->setSearchEntity($mentor);
		$activeMentorsDatagrid = $mentorService->getActiveMentorForMatchingDatagrid($mentor);

		$request->setDatagrid($activeMentorsDatagrid);
		$request->setTitle("Mentee Matching form");
	}
}