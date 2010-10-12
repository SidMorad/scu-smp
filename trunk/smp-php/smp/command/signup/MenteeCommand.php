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
require_once('HTTP/Upload.php');
require_once('Image/Transform.php');
require_once('smp/util/MailUtil.php');
require_once('smp/util/EmailTemplate.php');
require_once('smp/domain/Mail.php');
class smp_command_signup_MenteeCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Signup Mentee");
		$signupService=new smp_service_SignupService();
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
			
			$validator->checkCustomVal("password","Password and Confirm Password need to be same", $validator->getProperty('password')==$validator->getProperty('password2'));
			$validator->checkWithRegex("scuEmail", "SCU-Email is not valid. e.g. fbar12@scu.edu.au","/^[a-z0-9A-Z_\\.\\-]+@scu.edu.au$/");
			$validator->checkWithRegex("studentNumber","Student number is incorrect.","/^[0-9]{8}$/");
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
					$user = new smp_domain_User(-1, $validator->getProperty('username'), md5($validator->getProperty('password')), $validator->getProperty('scuEmail'));
					// Add ROLE_MENTEE to user.
					$user->addToRoles(Constants::ROLE_MENTEE);
					
					// Add Profile Picture 
					$upload = new HTTP_Upload("en");
					$upload->setChmod(0644);
					$filePic = $upload->getFiles('picture');
					if ($filePic->isValid()) {
						$filePic->setName("uniq");
						$dest_pic = $filePic->moveTo(Constants::IMAGE_UPLOAD_DIR);
						$picture = $filePic->getProp('name');
						$imgTrans = Image_Transform::factory('GD');
						$imgTrans->load(Constants::IMAGE_UPLOAD_DIR.$picture);
						$imgTrans->scaleByXY(100,100);
						$imgTrans->save(Constants::IMAGE_UPLOAD_DIR."_thb_".$picture);
	 					$user->setPicture($picture);
					} elseif ($filePic->isError()) {
						$request->addError($filePic->errorMsg());
					} elseif ($filePic->isMissing()) {
						$request->addFeedback("No picture was provided. Or picture's type was not supported, try jpg type.");
					}

					$student = new smp_domain_Student();
					$student->setUserId($user->getId());
					$student->setFirstname($validator->getProperty('firstname'));
					$student->setLastname($validator->getProperty('lastname'));
					$student->setGender($validator->getProperty('gender'));
					$student->setStudentNumber($validator->getProperty('studentNumber'));
					$student->setAgeRange($validator->getProperty('ageRange'));
					$student->setCourseId($validator->getProperty('courseId'));
					$student->setMajor($validator->getProperty('major'));
					$student->setStudyMode($validator->getProperty('studyMode'));
					
					$student->setFamilyStatus($validator->getProperty('familyStatus'));
					$student->setWorkStatus($validator->getProperty('workStatus'));
					$student->setTertiaryStudyStatus($validator->getProperty('tertiaryStudyStatus'));
					$student->setIsInternational($validator->getProperty('isInternational'));
					
					$student->setIsDisability($validator->getProperty('isDisability'));
					$student->setIsIndigenous($validator->getProperty('isIndigenous'));
					$student->setIsNonEnglish($validator->getProperty('isNonEnglish'));
					$student->setIsRegional($validator->getProperty('isRegional'));
					$student->setIsSocioeconomic($validator->getProperty('isSocioeconomic'));
					$student->setPreferGender($validator->getProperty('preferGender'));					
					$student->setInterests($validator->getProperty('interests'));
					$student->setComments($validator->getProperty('comments'));					

					$contact = new smp_domain_Contact();
					$contact->setAddress($validator->getProperty('address'));
					$contact->setCity($validator->getProperty('city'));
					$contact->setPostcode($validator->getProperty('postcode'));
					$contact->setPhoneHome($validator->getProperty('phoneHome'));
					$contact->setPhoneWork($validator->getProperty('phoneWork'));
					$contact->setMobile($validator->getProperty('mobile'));
					$contact->setEmail($validator->getProperty('email'));
					// Save User, Student and Contact Information 
					$blnResult = $signupService->saveMentee($user, $student, $contact);
					if ($blnResult) {
						//Sending Email to mentee
						$mailUtil=new smp_util_MailUtil();
						$menteeMailBean=new smp_bean_Mail();
						$menteeRecipients=$user->getScuEmail();
						if(!is_null($contact->getEmail())){
							$menteeRecipients=$menteeRecipients.", ".$contact->getEmail();
						}
						$menteeMailBean->setRecipients($menteeRecipients);
						$menteeMailBean->setFrom(Constants::APPLICATION_EMAIL);
						$menteeMailBean->setTo($menteeRecipients);
						$menteeMailBean->setSubject(smp_util_EmailTemplate::subjectForMenteeAfterRegistration());
						$menteeMailBean->setBody(smp_util_EmailTemplate::bodyForMenteeAfterRegistration($user,$student, $contact));
						$mailUtil->sendEmail($menteeMailBean);
						
						$request->setTitle("Login, First time!");
						$request->addFeedback("mentee Registration was successful, you can login with your username/password now.");
						$request->forward("public/login");
					}else{
						$validator->setError("register", "Sorry, Error occourd on saving data to the database. <br/>Please try again or contact your coordinator for more help");
					}
				}
			}
		}
	}

	function doSecurity() {
		$this->roles = array(Constants::ROLE_ANONYMOUS);
	}
}