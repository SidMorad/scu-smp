<?php
/**
 * Created at 04/07/2010 11:12:33 PM
 * smp_command_public_AlbumCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
class smp_command_public_AlbumCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Album");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_ANONYMOUS);
	}
}