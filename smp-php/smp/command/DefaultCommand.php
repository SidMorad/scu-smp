<?php
/**
 * Created at 04/07/2010 8:04:17 PM
 * smp_command_DefaultCommand
 *
 * This class is a part of 'Command' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_command_DefaultCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Default Page");
	}

}