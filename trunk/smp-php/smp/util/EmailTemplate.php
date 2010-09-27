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
		return "Registration was successfull";
	}

	static function bodyForMentorAfterRegistration($user, $student, $contact) {
		$body = "Dear " . $student->getFirstname() . "\n\n";
		$body .= "You are registered now, Thank you! \n";
		$body .= "Username: " . $user->getUsername() . "\n";
		$body .= "Please login to our website and see your information. \n";
		$body .= Constants::APPLICATION_DOMAIN."index.php?cmd=public/login";
		return $body;
	}
	
}