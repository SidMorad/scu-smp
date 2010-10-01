<?php
/**
 * Created at 01/10/2010 12:17:37 PM
 * smp_command_coordinator_FormCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/util/Validator.php');
require_once('smp/domain/User.php');
require_once('smp/domain/Coordinator.php');
require_once('smp/service/UserService.php');
require_once('smp/service/CoordinatorService.php');
require_once('HTTP/Upload.php');
require_once('Image/Transform.php');

class smp_command_coordinator_FormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		
		if ($request->isPost()) {
			$validator=new smp_util_Validator();
			$validator->checkEmptiness("firstname", "Firstname is compulsory.");
			$validator->checkEmptiness("lastname", "Lastname is compulsory.");
			$validator->checkEmptiness('username','Username is compulsory');
			$validator->checkEmptiness("password", "Password is compulsory.");
			$validator->checkEmptiness("password2", "Confim Password is compulsory.");
			$validator->checkEmptiness("scuEmail", "SCU-Email address is compulsory.");
			
			$validator->checkCustomVal("password" , "Password and Confirm Password need to be same", $validator->getProperty('password') == $validator->getProperty('password2'));
			$validator->checkWithRegex("scuEmail", "SCU-Email is not valid SCU account. e.g. fbar12@scu.edu.au", "/^[a-z0-9A-Z_\\.\\-]+@scu.edu.au$/");
			
			if($validator->isValid()){
				$userService = new smp_service_UserService();
				$coordinatorService = new smp_service_CoordinatorService();
				// more User Validation
				$user = $userService->findUserByUsername($validator->getProperty('username'));				
				$userByScuEmail = $userService->findUserByScuEmail($validator->getProperty('scuEmail'));
				if (!is_null($user)) {
					$validator->setError("username", "This username exists. Please choose another one!");
				} else if (!is_null($userByScuEmail)) {
					$validator->setError("scuEmail", "This SCU Email exists!, Which means you are already registered!");
				} else {
			
					$user=new smp_domain_User(-1,$validator->getProperty('username'), md5($validator->getProperty('password')), $validator->getProperty('scuEmail'));
					$coordinator = new smp_domain_Coordinator(-1, $validator->getProperty('firstname'), $validator->getProperty('lastname'));
					
					//add Role Coordinator to User
					$user->addToRoles(Constants::ROLE_COORDINATOR);
					
					//add Selected Campuses to User
					if (!is_null($validator->getProperty('campuses'))) {
						foreach($validator->getProperty('campuses') as $campus) {
							$user->addToCampuses($campus);
						}
					}
					
					//add Profile picture
					$upload=new HTTP_Upload("en");
					$upload->setChmod(0644);
					
					$filePic=$upload->getFiles('picture');
					if($filePic->isValid()){
						$filePic->setName("uniq");
						$dest_pic=$filePic->moveTo(Constants::IMAGE_UPLOAD_DIR);
						$picture=$filePic->getProp('name');
						$imgTrans=Image_Transform::factory('GD');
						$imgTrans->load(Constants::IMAGE_UPLOAD_DIR.$picture);
						$imgTrans->scaleByXY(100,100);
						$imgTrans->save(Constants::IMAGE_UPLOAD_DIR."_thb_".$picture);
						$user->setPicture($picture);
					}elseif($filePic->isError()){
						$request->addError($filePic->errorMsg());
					}elseif($filePic->isMissing()){
						$request->addFeedback("No picture was provided. Or picture's type was not supported, try jpg type.");
					}
					$user = $userService->save($user);
					
					if(is_null($user)){
						$validator->setError('username','Save failed, Database Error!');
					}else{
						// save coordinator
						$coordinator->setUserId($user->getId());
						$coordinator = $coordinatorService->save($coordinator);
						
						//make form empty
						$validator->setProperty('username','');
						$validator->setProperty('scuEmail','');
						$validator->setProperty('firstname','');
						$validator->setProperty('lastname','');
						$validator->setProperty('campuses',array());
						$request->addFeedback('User by username ['.$user->getUsername().' ] added successfully.');
					}
				}	
			}
		}
		
		$request->setTitle('Coordinator Form');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER);
	}
}