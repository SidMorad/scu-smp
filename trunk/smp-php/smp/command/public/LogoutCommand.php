<?php
/**
 * Created at 06/07/2010 11:50:26 PM
 * smp_command_public_LogoutCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/SessionRegistry.php');
class smp_command_public_LogoutCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		smp_base_SessionRegistry::doInvalidUser();
		// forward to login page 
		$request->setTitle("Login again!");
		$request->forward("public/login");
	} 
}