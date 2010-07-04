<?php
/**
 * Created at 04/07/2010 10:59:04 PM
 * smp_command_public_LoginCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
class smp_command_public_LoginCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Login Page");
	}
}