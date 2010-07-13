<?php
/**
 * Created at 04/07/2010 11:02:07 PM
 * smp_command_signup_MentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/util/Validator.php');
class smp_command_signup_MentorCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Signup Mentor");
		
		if ($request->isPost()) {
			$validator = new smp_util_Validator();
			$validator->checkEmptiness("username", "Username is required.");
			$validator->checkEmptiness("scuEmail", "SCU-Email address is required.");
			$validator->checkEmptiness("studyMode", "Study mode need to be selected.");
			$validator->checkEmptiness("studentNumber", "Student number is required.");
			$validator->checkEmptiness("argument", "For successful registration, you need to accept Agreement.");
			
			if ($validator->isValid()) {
				
				$request->setTitle("Login, First time!");
				$request->forward("public/login");
			}
		}
	}
}