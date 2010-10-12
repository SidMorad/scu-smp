<?php
/**
 * Created at 04/07/2010 10:59:04 PM
 * smp_command_public_LoginCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/util/Validator.php');
require_once('smp/service/UserService.php');
require_once('smp/base/SessionRegistry.php');

class smp_command_public_LoginCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Login Page");
		
		if ($request->isPost()) {
			$validator = new smp_util_Validator();
			$validator->checkEmptiness("username", "Username is empty.");
			$validator->checkWithRegex("username", "Username has invalid caracter.", "/^([a-zA-Z0-9_\\.\\-])*$/");
			$validator->checkEmptiness("password", "Password is empty.");
			
			if ($validator->isValid()) {
				$userService = new smp_service_UserService();
				$username = $validator->getProperty('username');
				//TODO change findByUsername to return user object with 'case sensetive' username 
				$user = $userService->findUserByUsername($username);
				if (!is_null($user)) {
					$validator->checkCustomVal("password", "Password is incorrect", $user->getPassword() === md5($validator->getProperty('password')));
				} else {
					$validator->setError("username", "Username ($username) does not exist.");
				}
				if ($validator->isValid()) {
					$user = $userService->findUserRoles($user);
					smp_base_SessionRegistry::setUser($user);
					$request->setTitle("Home Page");
					$request->forward('public/home');		
				}	
			}
		}
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_ANONYMOUS);
	}
}