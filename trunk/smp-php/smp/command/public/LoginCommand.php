<?php
/**
 * Created at 04/07/2010 10:59:04 PM
 * smp_command_public_LoginCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/util/Validator.php');
require_once('smp/service/UserService.php');
require_once('smp/mapper/UserMapper.php');
require_once('smp/base/SessionRegistry.php');
class smp_command_public_LoginCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Login Page");
		
		if ($request->isPost()) {
			$validator = new smp_util_Validator();
			$validator->checkEmptiness("username", "Username is empty.");
			$validator->checkEmptiness("password", "Password is empty.");
			
			if ($validator->isValid()) {
				$userService = new smp_service_UserService(new smp_mapper_UserMapper());
				$user = $userService->findByUsername($validator->getProperty('username'));
				if (!is_null($user)) {
					$validator->checkCustomVal("username", "Password is incorrect", $user->getPassword() == $validator->getProperty('password'));
				} else {
					$validator->setError("username", "Username is incorrect");
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
}