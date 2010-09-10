<?php
/**
 * Created at 20/08/2010 2:12:39 PM
 * smp_command_mentor_ListActiveMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/MentorService.php');
require_once('smp/util/Validator.php');
require_once('smp/domain/Student.php');
require_once('smp/base/SessionRegistry.php');
class smp_command_mentor_ListActiveMentorCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();

		$mentor = new smp_domain_mentor();
		if ($request->isPost()) {
			$student = new smp_domain_Student();
			$student->setFirstname($request->getProperty('firstname'));
			$student->setLastname($request->getProperty('lastname'));
			$student->setStudentNumber($request->getProperty('studentNumber'));
			$student->setGender($request->getProperty('gender'));
			$student->setCourseId($request->getProperty('courseId'));
			$student->setStudyMode($request->getProperty('studyMode'));
				
			$action = $request->getProperty(Constants::ACTION);
			if ($action == Constants::ACTION_UPDATE) {
				$mentorId = $request->getProperty('mentorId');
				$menteeLimit = $request->getProperty('menteeLimit'.$mentorId);

				// Check Validation
				$validator = new smp_util_Validator();
				if (! $validator->checkWithRegex('menteeLimit'.$mentorId, '', '/^[0-9]{1}$/')) {
					$request->addError('Mentee Limit should be number between 0 to 9');
				} else {
					$fullName = $request->getProperty('fullName');
					$updated = $mentorService->updateMentorLimit($mentorId, $menteeLimit);
					if ($updated) {
						$request->addFeedback("Mentee limit[". $menteeLimit ."] for Mentor[". $fullName ."] updated successfully.");
					} else {
						$request->addError("Update failed!");
					}
				}
			} else if ($action == Constants::ACTION_SEARCH) {
				$mentor->setStudent($student);
				smp_base_SessionRegistry::setSearchEntity('mentor_ListActiveMentor_MentorSearch', $mentor);
			}
		}
		$mentor = smp_base_SessionRegistry::getSearchEntity('mentor_ListActiveMentor_MentorSearch');
		$request->setSearchEntity($mentor);

		$datagrid = $mentorService->getActiveMentorDatagrid($mentor);

		$request->setDatagrid($datagrid);
		$request->setTitle("List Active Mentors");
	}

	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}
}