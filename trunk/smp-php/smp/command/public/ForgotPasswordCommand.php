<?php
/**
 * Created at 12/10/2010 9:29:24 AM
 * smp_command_public_ForgotPasswordCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/util/Validator.php');
require_once('smp/service/UserService.php');
require_once('smp/util/MailUtil.php');
require_once('smp/util/EmailTemplate.php');
require_once('smp/domain/Mail.php');

class smp_command_public_ForgotPasswordCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Forget your Password ?");

		if ($request->isPost()) {
			$validator = new smp_util_Validator();
			$validator->checkEmptiness("scuEmail", "SCU-Email address is compulsory.");
			$validator->checkWithRegex("scuEmail", "SCU-Email is not valid SCU email account. For example (s.moradi.12@<b>scu.edu.au</b>) is valid", "/^[a-z0-9A-Z_\\.\\-]+@scu.edu.au$/");
			
			if ($validator->isValid()) {
				$userService = new smp_service_UserService();
				$scuEmail = $validator->getProperty('scuEmail');
				$user = $userService->findUserByScuEmail($scuEmail);
				if (is_null($user)) {
					$validator->setError("scuEmail", "Sorry, we're unable to send a password to this SCU email address ($scuEmail).");
				}
				if ($validator->isValid()) {

					// Sending an Email 
					$mailUtil = new smp_util_MailUtil();
					$mailBean = new smp_bean_Mail();
					$mailBean->setRecipients($scuEmail);
					$mailBean->setFrom(Constants::APPLICATION_EMAIL);
					$mailBean->setTo($scuEmail);
					$mailBean->setSubject(smp_util_EmailTemplate::subjectForForgotPassword());
					$mailBean->setBody(smp_util_EmailTemplate::bodyForForgotPassword($user));
					
					$result = $mailUtil->sendEmail($mailBean);
					
					if (is_bool($result)) {
						$request->addFeedback("We sent a password reset to this SCU email address($scuEmail).");
						// make textfield empty
						$validator->setProperty('scuEmail', '');
					} else {
						$request->addError("Sending Email failed, Error:" . $result);
					}			
				}	
			}
		}	
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_ANONYMOUS);
	}
}