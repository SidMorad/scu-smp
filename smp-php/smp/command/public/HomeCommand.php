<?php
/**
 * Created at 04/07/2010 7:39:05 PM
 * smp_command_public_Home
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
class smp_command_public_HomeCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Home Page");
	}
}