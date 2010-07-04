<?php
/**
 * Created at 04/07/2010 8:04:17 PM
 * filename
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
class smp_command_DefaultCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Default Page");
	}

}