<?php
/**
 * Created at 21/09/2010 4:43:17 PM
 * smp_command_log_ListCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/LogService.php');
class smp_command_log_ListCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$logService = new smp_service_LogService();
		
		$datagrid = $logService->getDatagrid();
		$request->setDatagrid($datagrid);
		$request->setTitle('Log list');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_ADMIN);
	}
	
}