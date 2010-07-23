<?php
/**
 * Created at 23/07/2010 11:03:30 PM
 * smp_command_signup_MenteeCommand
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 */
require_once('smp/util/Validator.php');
require_once('smp/service/UserService.php');
require_once('smp/service/SignupService.php');


class smp_command_signup_MenteeCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Signup Mentee");
		$signupService=new smp_service_SighupService();
		$userService=new smp_service_UserService();
		
		if($request->isPost()){
			$validator=new smp_util_Validator();
			$validator->checkEmptiness("username","Username is compulsory.");
			$validator->checkEmptiness("password", "Password is compulsory.");
			$validator->checkEmptiness("password2", "Confim Password is compulsory.");
			$validator->checkEmptiness("scuEmail", "SCU-Email address is compulsory.");
			$validator->checkEmptiness("studentNumber", "Student number is compulsory.");
			$validator->checkEmptiness("studyMode", "Study mode is compulsory.");
			$validator->checkEmptiness("agreement", "For successful registration, you need to accept Agreement.");
			$validator->checkEmptiness("ageRange", "Age Range is compulsory.");
			$validator->checkEmptiness("firstname", "First Name is compulsory.");
			$validator->checkEmptiness("lastname", "Last Name is compulsory.");
			
			$validator->checkCustomVal("password","Password and Confirm")
		}
	}
}