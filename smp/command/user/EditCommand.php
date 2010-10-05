<?php
/**
 * Created at 21/09/2010 8:37:07 PM
 * smp_command_user_EditCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/UserService.php');
require_once('smp/util/Validator.php');
require_once('HTTP/Upload.php');
require_once('Image/Transform.php');

class smp_command_user_EditCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$id = $request->getProperty('id');
		$userService = new smp_service_UserService();
		
		if ($request->isPost()) {
			$validator = new smp_util_Validator();
			$validator->checkEmptiness("username", "Username is compulsory.");
			$validator->checkEmptiness("password", "Password is compulsory.");
			$validator->checkEmptiness("password2", "Confim Password is compulsory.");
			$validator->checkEmptiness("scuEmail", "SCU-Email address is compulsory.");
			
			$validator->checkCustomVal("password" , "Password and Confirm Password need to be same", $validator->getProperty('password') == $validator->getProperty('password2'));
			$validator->checkWithRegex("scuEmail", "SCU-Email is not valid SCU account. e.g. fbar12@scu.edu.au", "/^[a-z0-9A-Z_\\.\\-]+@scu.edu.au$/");
			
			if ($validator->isValid()) {
				$user = $userService->find($id);
				$user->setScuEmail($validator->getProperty('scuEmail'));
				$user->setPassword(md5($validator->getProperty('password')));
				
				//add Selected Roles to User
				if (!is_null($validator->getProperty('roles'))) {
					foreach($validator->getProperty('roles') as $roleName) {
						$user->addToRoles($roleName);
					}
				}
				
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
				
				// Update user roles.
				$result = $userService->updateUserRoles($user);
				$result = $userService->update($user);
				
				if ($result) {
					$request->addFeedback("User Info updated successfully!");
				} else {
					$request->addError("Error accour on saving data, Please try again.");
				}
			}	
		
		} else {
			$userService = new smp_service_UserService();
			$user = $userService->find($id);
			$user = $userService->findUserRoles($user);
			$request->setEntity($user);
		}
		$request->setTitle('Edit User Form');
	}

	function doSecurity() {
		$this->roles = array(Constants::ROLE_ADMIN, Constants::ROLE_MANAGER);
	}
}