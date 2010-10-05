<?php
/**
 * Created at 01/10/2010 11:12:49 AM
 * smp_command_coordinator_ListCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/CoordinatorService.php');
class smp_command_coordinator_ListCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$coordinatorService = new smp_service_CoordinatorService();
		
		$datagrid = $coordinatorService->getDatagrid();
		
		$request->setDatagrid($datagrid);
		$request->setTitle('Coordinator List');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER);	
	}
	
}