<?php
/**
 * Created at 23/07/2010 2:45:00 PM
 * smp_command_matching_MatchingFormCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MatchingService.php');
require_once('smp/service/MenteeService.php');
require_once('smp/service/MentorService.php');
require_once('smp/service/UserService.php');
require_once('smp/service/ContactService.php');
require_once('smp/util/Validator.php');
require_once('smp/domain/Mentee.php');
require_once('smp/domain/Mentor.php');
require_once('smp/base/SessionRegistry.php');
require_once('smp/util/MailUtil.php');
require_once('smp/util/EmailTemplate.php');
require_once('smp/domain/Mail.php');
class smp_command_matching_MatchingFormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) { 
		$matchingService = new smp_service_MatchingService();
		$menteeService = new smp_service_MenteeService();
		$mentorService = new smp_service_MentorService();
		$userService = new smp_service_UserService();
		$contactService = new smp_service_ContactService();
		$menteeId = $request->getProperty('menteeId');
		if (is_null($menteeId)) {
			$request->addError("Mentee Id was not found, please select Mentee again.");
			$request->redirect("matching/listNewMentees");
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
						
						// Sending Email to Mentor
						$mailUtil = new smp_util_MailUtil();
						$mentorMailBean = new smp_bean_Mail();
						$menteeMailBean = new smp_bean_Mail();
						$mentor = $mentorService->findFilledMentor($mentorId);
						$mentee = $menteeService->findFilledMentee($menteeId);
						$mentorRecipients = $mentor->getUser()->getScuEmail();
						$mentorRecipients = (is_null($mentor->getContact()->getEmail()) ? $mentorRecipients : $mentorRecipients . ", " . $mentor->getContact()->getEmail()) ;
						$menteeRecipients = $mentee->getUser()->getScuEmail();
						$menteeRecipients = (is_null($mentee->getContact()->getEmail()) ? $menteeRecipients : $menteeRecipients . ", " . $mentee->getContact()->getEmail()) ;
						$mentorMailBean->setRecipients($mentorRecipients);
						$mentorMailBean->setFrom(Constants::APPLICATION_EMAIL);
						$mentorMailBean->setTo($mentorRecipients);
						$mentorMailBean->setSubject(smp_util_EmailTemplate::subjectForMentorAfterMatching());
						$mentorMailBean->setBody(smp_util_EmailTemplate::bodyForMentorAfterMatching($mentor, $mentee));
						$menteeMailBean->setRecipients($menteeRecipients);
						$menteeMailBean->setFrom(Constants::APPLICATION_EMAIL);
						$menteeMailBean->setTo($menteeRecipients);
						$menteeMailBean->setSubject(smp_util_EmailTemplate::subjectForMenteeAfterMatching());
						$menteeMailBean->setBody(smp_util_EmailTemplate::bodyForMenteeAfterMatching($mentor, $mentee));
						
						$result = $mailUtil->sendEmail($mentorMailBean);
						$result = $mailUtil->sendEmail($menteeMailBean);
						
						if (is_bool($result)) {
							$request->addFeedback('Notify messages sent successfully to :');
							$request->addFeedback( 'Mentor: ' .$mentor->getStudent()->getFirstname().' '. $mentor->getStudent()->getLastname().' ('.$mentorRecipients .')');
							$request->addFeedback( 'Mentee: ' .$mentee->getStudent()->getFirstname().' '. $mentee->getStudent()->getLastname().' ('.$menteeRecipients .')');
						} else {
							$request->addError($result);
						}
						
					} else {
						$request->addError("Matching faild! (Database Error)");
					}
					$request->redirect("matching/listNewMentees");
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
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}	
}