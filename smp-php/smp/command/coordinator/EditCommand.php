<?php
/**
 * Created at 01/10/2010 2:44:15 PM
 * smp_command_coordinator_EditCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/UserService.php');
require_once('smp/service/CoordinatorService.php');
require_once('smp/util/Validator.php');
require_once('HTTP/Upload.php');
require_once('Image/Transform.php');

class smp_command_coordinator_EditCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$id = $request->getProperty('id');
		$coordinatorService = new smp_service_CoordinatorService();
		$userService = new smp_service_UserService();
		
		if ($request->isPost()) {
			$validator = new smp_util_Validator();
			$validator->checkEmptiness("firstname", "Firstname is compulsory.");
			$validator->checkEmptiness("lastname", "Lastname is compulsory.");
			$validator->checkEmptiness("username", "Username is compulsory.");
			$validator->checkEmptiness("scuEmail", "SCU-Email address is compulsory.");
			
			$validator->checkCustomVal("password" , "Password and Confirm Password need to be same", $validator->getProperty('password') == $validator->getProperty('password2'));
			$validator->checkWithRegex("scuEmail", "SCU-Email is not valid SCU account. e.g. fbar12@scu.edu.au", "/^[a-z0-9A-Z_\\.\\-]+@scu.edu.au$/");
			
			if ($validator->isValid()) {
				$coordinator = $coordinatorService->find($id);
				$user = $userService->find($coordinator->getUserId());
				// set new values for user
				$user->setScuEmail($validator->getProperty('scuEmail'));
				//add Selected Campuses to User
				if (!is_null($validator->getProperty('campuses'))) {
					foreach($validator->getProperty('campuses') as $campus) {
						$user->addToCampuses($campus);
					}
				}
				// set new values for coordinator
				$coordinator->setFirstname($validator->getProperty('firstname'));
				$coordinator->setLastname($validator->getProperty('lastname'));
				
				// Add Profile Picture 
				$upload = new HTTP_Upload("en");
				$upload->setChmod(0644);
				
				$filePic = $upload->getFiles('picture');
				if ($filePic->isValid()) {
					$filePic->setName("uniq");
					$dest_pic = $filePic->moveTo(Constants::IMAGE_UPLOAD_DIR);
					$picture = $filePic->getProp('name');
					$imgTrans = Image_Transform::factory('GD');
					$imgTrans->load(Constants::IMAGE_UPLOAD_DIR.$picture);
					$imgTrans->scaleByXY(100,100);
					$imgTrans->save(Constants::IMAGE_UPLOAD_DIR."_thb_".$picture);
					// First remove old picture from image directory id exists
					if (file_exists(Constants::IMAGE_UPLOAD_DIR.$user->getPicture()) && !is_null($user->getPicture())) {
						unlink(Constants::IMAGE_UPLOAD_DIR.$user->getPicture());
						unlink(Constants::IMAGE_UPLOAD_DIR."_thb_".$user->getPicture());
					}
 					$user->setPicture($picture);
				} elseif ($filePic->isError()) {
					$request->addError($filePic->errorMsg());
				} elseif ($filePic->isMissing()) {
					$request->addFeedback("No picture was provided. Or picture's type was not supported, try jpg type.");
				}
				
				// Update user campuses.
				$result = $coordinatorService->update($coordinator); 
				$result = $userService->updateUserCampuses($user);
				$result = $userService->update($user);
				
				if ($result) {
					$request->addFeedback("Coordinator's Info updated successfully!");
				} else {
					$request->addError("Error accour on saving data, Please try again.");
				}
			}	
		
		} else {
			$coordinator = $coordinatorService->find($id);
			$user = $userService->find($coordinator->getUserId());
			$user = $userService->findUserCampuses($user);
			$coordinator->setUser($user);
			$request->setEntity($coordinator);
		}
		$request->setTitle('Edit User Form');
	}

	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER);
	}
}