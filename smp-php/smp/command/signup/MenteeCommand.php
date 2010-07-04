<?php
/**
 * Created at 04/07/2010 11:03:30 PM
 * smp_command_signup_MenteeCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
class smp_command_signup_MenteeCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Signup Mentee");
	}
}