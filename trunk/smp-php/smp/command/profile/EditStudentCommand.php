<?php
/**
 * Created at 10/09/2010 10:30:29 AM
 * smp_command_profile_EditStudentCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/StudentService.php');
require_once('smp/util/Security.php');
require_once('smp/util/Validator.php');
class smp_command_profile_EditStudentCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$currentUser = smp_util_Security::getCurrentUser();
		$studentService = new smp_service_StudentService();
		$student = $studentService->findStudentWithUser($currentUser);
		
		if ($request->isPost()) {
			$validator = new smp_util_Validator();
			$validator->checkEmptiness("studentNumber", "Student number is compulsory.");
			$validator->checkEmptiness("studyMode", "Study mode is compulsory.");
			$validator->checkEmptiness("ageRange", "Age Range is compulsory.");
			$validator->checkEmptiness("firstname", "First Name is compulsory.");
			$validator->checkEmptiness("lastname", "Last Name is compulsory.");
			$validator->checkWithRegex("studentNumber", "Student number is incorrect.", "/^[0-9]{8}$/");
			
			if ($validator->isValid()) {
				$student->setFirstname($validator->getProperty('firstname'));
				$student->setLastname($validator->getProperty('lastname'));
				$student->setGender($validator->getProperty('gender'));
				$student->setStudentNumber($validator->getProperty('studentNumber'));
				$student->setAgeRange($validator->getProperty('ageRange'));
				$student->setCourseId($validator->getProperty('courseId'));
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
				$result = $studentService->update($student);
				if ($result) {
					$request->addFeedback("Update Student information was successfull!");
				}else {
					$request->addError("Error occured, It may be Database problem, please try again later.");
				} 
			}
		} else {
			$request->setEntity($student);		
		}
		
		
		$request->setTitle('Edit Student Info');
	}
	
}