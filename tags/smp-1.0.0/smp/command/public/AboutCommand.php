<?php
/**
 * Created at 04/07/2010 11:10:55 PM
 * smp_command_public_AboutCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
class smp_command_public_AboutCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("About Us");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_ANONYMOUS);
	}
}