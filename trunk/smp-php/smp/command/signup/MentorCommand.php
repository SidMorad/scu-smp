<?php
/**
 * Created at 04/07/2010 11:02:07 PM
 * smp_command_signup_MentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/util/Validator.php');
require_once('smp/service/UserService.php');
require_once('smp/service/StudentService.php');
class smp_command_signup_MentorCommand extends smp_command_Command {
	function doExecute(smp_controller_Request $request) {
		$request->setTitle("Signup Mentor");
		
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
			
			$validator->checkCustomVal("password" , "Password and Confim Password need to be same", $validator->getProperty('password') == $validator->getProperty('password2'));
			$validator->checkWithRegex("scuEmail", "SCU-Email is not valid SCU account. e.g. fbar12@scu.edu.au", "/^[a-z0-9_\\.\\-]+@scu.edu.au$/");
			$validator->checkWithRegex("studentNumber", "Student number is incorrect.", "/^[0-9]{8}$/");
//			$validator->checkWithRegex("email"	, "Email is Invalid.", "/^[a-z0-9_\\.\\-]+@+[a-z0-9_\\.\\-]+(\\.[a-z]{2,4})$/");
			
			if ($validator->isValid()) {
				// more Validation
				$userService = new smp_service_UserService(new smp_mapper_UserMapper());
				$username = $validator->getProperty('username');
				$user = $userService->findByUsername($username);				
				if (!is_null($user)) {
					$validator->setError("username", "This username exists, Please choose another one!");
				} else {
					$user = new smp_domain_User(-1, $validator->getProperty('username'), $validator->getProperty('password'), $validator->getProperty('scuEmail'));
					// Add ROLE_MENTOR to user.
					$user->addToRoles('ROLE_MENTOR');
					// Save new User
					$user = $userService->save($user);
					if (is_null($user)) {
						$validator->setError("scuEmail", "Error occurred on saving user information.");
					} else {
					// Save new Student
						$studentService = new smp_service_StudentService();
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
						$student->setIsTrained(false);
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
		
						$student = $studentService->save($student);
						if (is_null($student)) {
							$validator->setError("studentNumber", "Error occurred on saving student information.");
						} else {
						
						}
						
					}
					//TODO Continue save Mentor information in other tables (Student, Contact and Matching).				
				}
				
				if ($validator->isValid()) {
					$request->setTitle("Login, First time!");
					$request->forward("public/login");
				}
			}
		}
	}
}