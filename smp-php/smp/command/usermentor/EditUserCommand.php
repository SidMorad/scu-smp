<?php
/**
 * Created at 06/09/2010 4:54:54 PM
 * smp_command_mentor_EditUserCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/UserService.php');
require_once('smp/util/Validator.php');
require_once "HTTP/Upload.php";
require_once 'Image/Transform.php';
class smp_command_usermentor_EditUserCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$userId = $request->getProperty('userId');
		
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
				$user = $userService->find($validator->getProperty('userId'));
				$user->setScuEmail($validator->getProperty('scuEmail'));
				$user->setPassword(md5($validator->getProperty('password')));
				
				// Add Profile Picture 
				$upload = new HTTP_Upload("en");
				$upload->setChmod(0644);
				
				$filePic = $upload->getFiles('picture');
				if ($filePic->isValid()) {
					$filePic->setName("uniq");
					$dest_pic = $filePic->moveTo("static/images/profile/");
					$picture = $filePic->getProp('name');
					$imgTrans = Image_Transform::factory('GD');
					$imgTrans->load("static/images/profile/".$picture);
					$imgTrans->scaleByXY(100,100);
					$imgTrans->save("static/images/profile/_thb_".$picture);
					$user->setPicture($picture);
				}
				
				$result = $userService->updateUser($user);
				if ($result) {
					$request->addFeedback("User Profile updated successfully.");
				} else {
					$request->addError("Error accour on saving data, Please try again.");
				}
			}	
		
		} else {
			$user = $userService->find($userId);
			$request->setEntity($user);
		}
		
		
		
		$request->setTitle('Edit User Info');
	}
	
}
