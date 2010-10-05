<?php
/**
 * Created at 01/10/2010 6:15:31 PM
 * smp_command_coordinator_DeleteCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/CoordinatorService.php');

class smp_command_coordinator_DeleteCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$coordinatorService = new smp_service_CoordinatorService();
		
		$id = $request->getProperty('id');
		$result = $coordinatorService->delete($id);
		
		if ($result) {
			$request->addFeedback('Delete Coordinator was successfull.');
		} else {
			$request->addError('Delete failed.');
		}
		$request->redirect('coordinator/list');
		$request->setTitle('Coordinator list');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER);
	}	
}