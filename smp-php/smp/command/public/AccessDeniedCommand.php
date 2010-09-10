<?php
/**
 * Created at 10/09/2010 2:54:44 PM
 * smp_command_public_AccessDeniedCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Logger.php');
class smp_command_public_AccessDeniedCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$currentUser = smp_util_Security::getCurrentUser();
		$userId = ($currentUser->getId() != -1) ? $currentUser->getId() : null;
		$logger = new smp_mapper_Logger();
		$viewRedirectedFrom = $request->getViewRedirectedFrom();
		$log = new smp_domain_Log('access.denied', 'Not permitted command [' .$viewRedirectedFrom. ']', -1, $userId);
		$logger->save($log);
		
		$request->addError("You don't have permission to access <a href=\"index.php?cmd=$viewRedirectedFrom\">this page</a>");
		$request->addError("System logged this action for security resoan.");
		$request->addError("If you think you should have access to <a href=\"index.php?cmd=$viewRedirectedFrom\">this page</a>, then contact Admin");
		$request->setTitle("Access Denied");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_ANONYMOUS);
	}
}