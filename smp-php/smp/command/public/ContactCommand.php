<?php
/**
 * Created at 04/07/2010 11:11:35 PM
 * smp_command_public_ContactCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
class smp_command_public_ContactCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Contact Us");
	}
}