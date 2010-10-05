<?php
/**
 * Created at 21/09/2010 8:07:54 PM
 * smp_command_user_ViewCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/UserService.php');

class smp_command_user_ViewCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		
		$id = $request->getProperty('id');
		
		$userService = new smp_service_UserService();

		$user = $userService->find($id);
		$user = $userService->findUserRoles($user);
		
		$request->setEntity($user);
		$request->setTitle('User Info');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_ADMIN, Constants::ROLE_MANAGER);
	}
} 