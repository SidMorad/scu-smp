<?php
/**
 * Created at 09/08/2010 5:32:17 PM
 * smp_command_message_MessageMentorForm
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/util/Validator.php');
require_once('smp/util/MailUtil.php');
require_once('smp/util/Security.php');
require_once('smp/domain/Mail.php');
require_once('smp/service/MentorService.php');
class smp_command_message_MessageMentorFormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$validator = new smp_util_Validator();
		$validator->checkEmptiness('subject', 'Subject is compulsory.');
		
		if ($validator->isValid()) {
			$mailUtil = new smp_util_MailUtil();
			$mailBean = new smp_bean_Mail();
			// find Recipients 
			$to = $validator->getProperty('to');
			if ($to == Constants::MS_FOR_MENTEE) {
				$mentorService = new smp_service_MentorService();
				$currentUser = smp_util_Security::getCurrentUser();
				$mentor = new smp_domain_Mentor();
				$mentor->setUserId($currentUser->getId());
				$mentor = $mentorService->findWithMentor($mentor);
				$mentor = $mentorService->findMentorStudentMentees($mentor->getId());
				$recipients = "";
				foreach($mentor->getMentees() as $mentee) {
					if (!is_null($mentee->getUser()->getScuEmail())) {
						$recipients .= "" .$mentee->getUser()->getScuEmail() .", ";
					}
					if (!is_null($mentee->getContact()->getEmail())) {
						$recipients .= $mentee->getContact()->getEmail() .", ";
					}	
				}
			} else if ($to == Constants::MS_FOR_COORDINATOR) {
				
			}
			$mailBean->setRecipients($recipients);
			$mailBean->setFrom('smp@scu.edu.au');
			$mailBean->setTo('mentee@scu.edu.au');
			$mailBean->setSubject($validator->getProperty('subject'));
			$mailBean->setBody($validator->getProperty('body'));
			$result = $mailUtil->sendEmail($mailBean);
			if (is_bool($result)) {
				$request->addFeedback('Message sent successfully to :');
				$request->addFeedback($recipients);
			} else {
				$validator->setError('submit', $result);
				$validator->setError('to', $recipients);
			} 			
		}
	}
}