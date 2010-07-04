<?php
/**
 * Created at 04/07/2010 11:02:07 PM
 * smp_command_signup_MentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
class smp_command_signup_MentorCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Signup Mentor");
	}
}