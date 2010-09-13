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
			$currentUser = smp_util_Security::getCurrentUser();
			$recipients = $validator->getProperty('to');
			$mailBean->setRecipients($recipients);
			$mailBean->setFrom($currentUser->getScuEmail());
			$mailBean->setTo($recipients);
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
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MENTOR);
	}	
}