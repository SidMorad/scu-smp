<?php
/**
 * Created at 10/09/2010 1:42:47 PM
 * smp_command_profile_EditContactCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/ContactService.php');
require_once('smp/util/Security.php');
require_once('smp/util/Validator.php');
class smp_command_profile_EditContactCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$contactService = new smp_service_ContactService();
		$currentUser = smp_util_Security::getCurrentUser();
		$contact = $contactService->findContactWithUserId($currentUser->getId());
		
		$validator = new smp_util_Validator();
		if ($validator->notEmpty("email")) {
			$validator->checkWithRegex("email"	, "Email is Invalid.", "/^[a-z0-9_\\.\\-]+@+[a-z0-9_\\.\\-]+(\\.[a-z]{2,4})$/");
		}
		
		if ($request->isPost()) {
			if ($validator->isValid()) {
				$contact->setAddress($validator->getProperty('address'));
				$contact->setCity($validator->getProperty('city'));
				$contact->setPostcode($validator->getProperty('postcode'));
				$contact->setPhoneHome($validator->getProperty('phoneHome'));
				$contact->setPhoneWork($validator->getProperty('phoneWork'));
				$contact->setMobile($validator->getProperty('mobile'));
				$contact->setEmail($validator->getProperty('email'));
				
				$result = $contactService->update($contact);
				if ($result) {
					$request->addFeedback('Contact information updated successfully.');
				} else {
					$request->addError('Update failed, please try again or contact Admin for more help.');
				}
			}
		} else {
			$request->setEntity($contact);
		}
		
		$request->setTitle('Edit Contact Info');
	}
	
}	