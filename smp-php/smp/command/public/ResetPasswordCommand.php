<?php
/**
 * Created at 12/10/2010 10:39:16 AM
 * smp_command_public_ResetPasswordCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/UserService.php');

class smp_command_public_ResetPasswordCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$scuEmail = $request->getProperty('scuEmail');		
		$key = $request->getProperty('key');
		
		$userService = new smp_service_UserService();
		$user = $userService->findUserByScuEmail($scuEmail);
		
		if (is_null($user)) {
			$request->addError('User account does not exists.');
		} else {
			if ($user->getPassword() != $key) {
				$request->addError('Wrong key, password can not be reset.');
			} else {
				// auto login and redirect to edit profile
				$user = $userService->findUserRoles($user);
				smp_base_SessionRegistry::setUser($user);
				$request->redirect('profile/editUser');
			}
		}
		
		
		$request->setTitle('Reset Password');
	}

	function doSecurity() {
		$this->roles = array(Constants::ROLE_ANONYMOUS);
	}
}