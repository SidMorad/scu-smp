<?php
/**
 * Created at 04/07/2010 6:43:21 PM
 * smp_command_Command
 *
 * This class is a part of 'Command' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/util/Security.php');
abstract class smp_command_Command {
	protected $roles = array();
	
	final function __construct() {}
	
	function execute( smp_controller_Request $request) {
		$this->doSecurity();
		
		if ($this->isUserGranted()) {
			$this->doExecute($request);
			$request->setCommand($this);
		} else {
			$request->redirect('public/accessDenied');
		}
		
	}
	
	abstract function doExecute( smp_controller_Request $request);
	
	abstract function doSecurity();

	private function isUserGranted() {
		// If roles containes ROLE_ANONYMOUS then return true
		if (in_array(Constants::ROLE_ANONYMOUS, $this->roles )) {
			return true;
		}
		$currentUser = smp_util_Security::getCurrentUser();
		foreach ($this->roles as $role) {
			if (in_array($role, $currentUser->getRoles())) {
				return true;
			}
		}
		return false;
	}
}