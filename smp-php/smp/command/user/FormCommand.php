<?php
/**
 * Created at 13/09/2010 3:45:42 PM 
 * smp_command_user_FormCommand
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/util/Validator.php');
require_once('smp/domain/User.php');
require_once('smp/service/UserService.php');
require_once('HTTP/Upload.php');
require_once('Image/Transform.php');

class smp_command_user_FormCommand extends smp_command_Command{
	function doExecute(smp_controller_Request $request){
		$validator=new smp_util_Validator();
		$validator->checkEmptiness('username','Name is compulsory');
		$validator->checkEmptiness("password", "Password is compulsory.");
		$validator->checkEmptiness("password2", "Confim Password is compulsory.");
		$validator->checkEmptiness("scuEmail", "SCU-Email address is compulsory.");
		
		$validator->checkCustomVal("password" , "Password and Confirm Password need to be same", $validator->getProperty('password') == $validator->getProperty('password2'));
//		$validator->checkWithRegex("scuEmail", "SCU-Email is not valid SCU account. e.g. fbar12@scu.edu.au", "/^[a-z0-9A-Z_\\.\\-]+@scu.edu.au$/");
		
		if ($validator->notEmpty("email")) {
				$validator->checkWithRegex("email"	, "Email is Invalid.", "/^[a-z0-9_\\.\\-]+@+[a-z0-9_\\.\\-]+(\\.[a-z]{2,4})$/");
			}
		
		if($validator->isValid()){
			$user=new smp_domain_User(-1,$validator->getProperty('username'), md5($validator->getProperty('password')), $validator->getProperty('scuEmail'));
			
			$userService=new smp_service_UserService();
			
			// Add role coordinator 
			$user->addToRoles(Constants::ROLE_COORDINATOR);			
			
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
			$user=$userService->save($user);
			
			if(is_null($user)){
				$validator->setError('username','Save failed, It seems this coordinator name already exists!');
			}else{
				//make form empty
				$validator->setProperty('username','');
				$validator->setProperty('scuEmail','');
				$request->addFeedback('Coordinator by username ['.$user->getUsername().' ] added successfully.');
			}
		}
		
		$request->setTitle('Coordinator Form');
	}
	
	function doSecurity(){
		$this->roles=array(Constants::ROLE_MANAGER);
	}
}