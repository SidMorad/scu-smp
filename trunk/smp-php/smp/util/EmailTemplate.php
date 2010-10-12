<?php
/**
 * Created at 20/09/2010 12:35:06 PM
 * smp_util_EmailTemplate
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/Constants.php');
class smp_util_EmailTemplate {
	
	static function subjectForMentorAfterMatching() {
		return "You are matched with New Mentee";
	}

	static function bodyForMentorAfterMatching($mentor, $mentee) {
		$body = "Dear " . $mentor->getStudent()->getFirstname() . "\n\n";
		$body .= "You are matched with new Mentee :". $mentee->getStudent()->getFirstname() ." " . $mentee->getStudent()->getLastname(). "\n";
		$body .= "SCU-Email: " . $mentee->getUser()->getScuEmail() . "\n";
		$body .= "Personal Email: " . $mentee->getContact()->getEmail() . "\n";
		$body .= "Mobile: " . $mentee->getContact()->getMobile() . "\n";
		$body .= "You can also login to our website and see her/his information. \n";
		$body .= Constants::APPLICATION_DOMAIN."index.php?cmd=public/login";
		return $body;
	}

	static function subjectForMenteeAfterMatching() {
		return "You are matched with your Mentor";
	}

	static function bodyForMenteeAfterMatching($mentor, $mentee) {
		$body = "Dear " . $mentee->getStudent()->getFirstname() . "\n\n";
		$body .= "You are matched with your Mentor: ". $mentor->getStudent()->getFirstname() ." " . $mentor->getStudent()->getLastname(). "\n";
		$body .= "SCU-Email: " . $mentor->getUser()->getScuEmail() . "\n";
		$body .= "Personal Email: " . $mentor->getContact()->getEmail() . "\n";
		$body .= "Mobile: " . $mentor->getContact()->getMobile() . "\n";
		$body .= "You can also login to our website and see her/his information. \n";
		$body .= Constants::APPLICATION_DOMAIN."index.php?cmd=public/login";		
		return $body;
	}
	
	static function subjectForMentorAfterRegistration() {
		return "Registration was successful";
	}
	static function subjectForMenteeAfterRegistration(){
		return "Registration was successful";
	}

	static function bodyForMentorAfterRegistration($user, $student, $contact) {
		$body = "Dear " . $student->getFirstname() . "\n\n";
		$body .= "You are registered now, Thank you! \n";
		$body .= "Username: " . $user->getUsername() . "\n";
		$body .= "Please login to our website and see your information. \n";
		$body .= Constants::APPLICATION_DOMAIN."index.php?cmd=public/login";
		return $body;
	}
	static function bodyForMenteeAfterRegistration($user, $student, $contact){
		$body="Dear " . $student->getFirstname() . "\n\n";
		$body .="You are registered now, Thank you!\n";
		$body .="Username: ". $user->getUsername()."\n";
		$body .="Please login to our website and see your information. \n";
		$body .=Constants::APPLICATION_DOMAIN."index.php?cmd=public/login";
		return $body;
	}

	static function subjectForForgotPassword(){
		return "Forgot your Password ?";
	}

	static function bodyForForgotPassword($user){
		$body="Dear " . $user->getUsername() . "\n\n";
		$body .="Please click below url for reset your password.\n";
		$body .=Constants::APPLICATION_DOMAIN."index.php?cmd=public/resetPassword&scuEmail=".$user->getScuEmail()."&key=".$user->getPassword()."\n\n";
		$body .="Sent from SMP application.\n";
		return $body;
	}
}