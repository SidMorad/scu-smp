<?php
/**
 * Created at 24/09/2010 12:29:35 PM
 * smp_command_contact_EditCommand
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/service/ContactService.php');
require_once('smp/util/Validator.php');

class smp_command_contact_EditCommand extends smp_command_Command{

	function doExecute(smp_controller_Request $request){
		$id=$request->getProperty('id');
		$contactService=new smp_service_ContactService();
		$contact=$contactService->find($id);
		
		if($request->isPost()){
			$validator = new smp_util_Validator();
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
					$request->addError('Update failed, please close and reopen the website to try again or contact Admin for more help.');
				}
			}
		}else{
			$request->setEntity($contact);
		}
		$request->setTitle('Edit Contact Info');
	}
	
	function doSecurity(){
		$this->roles=array(Constants::ROLE_ADMIN, Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}
}