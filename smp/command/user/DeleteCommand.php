<?php
/**
 * Created at 21/09/2010 9:55:08 PM
 * smp_command_user_DeleteCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/UserService.php');

class smp_command_user_DeleteCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$id = $request->getProperty('id');
		
		$userService = new smp_service_UserService();
		$result = $userService->delete($id);
		if ($result) {
			$request->addFeedback("User Deleted succesfully");
		} else {
			$request->addError("Delete user faild.");
		}	
		$request->redirect('user/list');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_ADMIN, Constants::ROLE_MANAGER);	
	}

}