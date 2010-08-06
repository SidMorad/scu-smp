<?php
/**
 * Created at 04/07/2010 11:02:07 PM
 * smp_command_signup_MentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/Constants.php');
require_once('smp/util/Validator.php');
require_once('smp/service/UserService.php');
require_once('smp/service/SignupService.php');
class smp_command_signup_MentorCommand extends smp_command_Command {
	
	
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Signup Mentor");
		$signupService = new smp_service_SignupService();
		$userService = new smp_service_UserService();
		
		if ($request->isPost()) {
			$validator = new smp_util_Validator();
			$validator->checkEmptiness("username", "Username is compulsory.");
			$validator->checkEmptiness("password", "Password is compulsory.");
			$validator->checkEmptiness("password2", "Confim Password is compulsory.");
			$validator->checkEmptiness("scuEmail", "SCU-Email address is compulsory.");
			$validator->checkEmptiness("studentNumber", "Student number is compulsory.");
			$validator->checkEmptiness("studyMode", "Study mode is compulsory.");
			$validator->checkEmptiness("agreement", "For successful registration, you need to accept Agreement.");
			$validator->checkEmptiness("ageRange", "Age Range is compulsory.");
			$validator->checkEmptiness("firstname", "First Name is compulsory.");
			$validator->checkEmptiness("lastname", "Last Name is compulsory.");
			
			$validator->checkCustomVal("password" , "Password and Confirm Password need to be same", $validator->getProperty('password') == $validator->getProperty('password2'));
			$validator->checkWithRegex("scuEmail", "SCU-Email is not valid SCU account. e.g. fbar12@scu.edu.au", "/^[a-z0-9A-Z_\\.\\-]+@scu.edu.au$/");
			$validator->checkWithRegex("studentNumber", "Student number is incorrect.", "/^[0-9]{8}$/");
			if ($validator->notEmpty("email")) {
				$validator->checkWithRegex("email"	, "Email is Invalid.", "/^[a-z0-9_\\.\\-]+@+[a-z0-9_\\.\\-]+(\\.[a-z]{2,4})$/");
			}
					
			if ($validator->isValid()) {
				// more Validation
				$username = $validator->getProperty('username');
				$user = $userService->findUserByUsername($username);				
				$userByScuEmail = $userService->findUserByScuEmail($validator->getProperty('scuEmail'));
				if (!is_null($user)) {
					$validator->setError("username", "This username exists. Please choose another one!");
				} else if (!is_null($userByScuEmail)) {
					$validator->setError("scuEmail", "This SCU Email exists!, Which means you are already registered!");
				} else {
					$user = new smp_domain_User(-1, $validator->getProperty('username'), $validator->getProperty('password'), $validator->getProperty('scuEmail'));
					// Add ROLE_MENTOR to user.
					$user->addToRoles(Constants::ROLE_MENTOR);

					$student = new smp_domain_Student();
					$student->setUserId($user->getId());
					$student->setFirstname($validator->getProperty('firstname'));
					$student->setLastname($validator->getProperty('lastname'));
					$student->setGender($validator->getProperty('gender'));
					$student->setStudentNumber($validator->getProperty('studentNumber'));
					$student->setAgeRange($validator->getProperty('ageRange'));
					$student->setCourse($validator->getProperty('course'));
					$student->setMajor($validator->getProperty('major'));
					$student->setStudyMode($validator->getProperty('studyMode'));
					$student->setRecommendedByStaff($validator->getProperty('recommendedByStaff'));
					$student->setSemestersCompleted($validator->getProperty('semestersCompleted'));
					$student->setFamilyStatus($validator->getProperty('familyStatus'));
					$student->setWorkStatus($validator->getProperty('workStatus'));
					$student->setTertiaryStudyStatus($validator->getProperty('tertiaryStudyStatus'));
					$student->setIsFirstYear($validator->getProperty('isFirstYear'));
					$student->setIsInternational($validator->getProperty('isInternational'));
					$student->setIsDisability($validator->getProperty('isDisability'));
					$student->setIsIndigenous($validator->getProperty('isIndigenous'));
					$student->setIsNonEnglish($validator->getProperty('isNonEnglish'));
					$student->setIsRegional($validator->getProperty('isRegional'));
					$student->setIsSocioeconomic($validator->getProperty('isSocioeconomic'));
					$student->setPreferGender($validator->getProperty('preferGender'));
					$student->setPreferAustralian($validator->getProperty('preferAustralian'));
					$student->setPreferDistance($validator->getProperty('preferDistance'));
					$student->setPreferInternational($validator->getProperty('preferInternational'));
					$student->setPreferOnCampus($validator->getProperty('preferOnCampus'));
					$student->setInterests($validator->getProperty('interests'));
					$student->setComments($validator->getProperty('comments'));
					// Set account status for new registered Mentor
					$student->setAccountStatus(Constants::AS_NEW_MENTOR);	
					
					$contact = new smp_domain_Contact();
					$contact->setAddrees($validator->getProperty('address'));
					$contact->setCity($validator->getProperty('city'));
					$contact->setPostcode($validator->getProperty('postcode'));
					$contact->setPhoneHome($validator->getProperty('phoneHome'));
					$contact->setPhoneWork($validator->getProperty('phoneWork'));
					$contact->setMobile($validator->getProperty('mobile'));
					$contact->setEmail($validator->getProperty('email'));
					// Save User, Student and Contact Information 
					$blnResult = $signupService->saveNewStudent($user, $student, $contact);
					if (! $blnResult) {
						$validator->setError("register", "Sorry, Error occourd on saving data to the database. <br/>Please try again or contact your coordinator for more help");
					}
				}
				
				if ($validator->isValid()) {
					$request->setTitle("Login, First time!");
					$request->addFeedback("Mentor Registration was successfull, you can login with your username/password now.");
					$request->forward("public/login");
				}
			}
		}
	}
}