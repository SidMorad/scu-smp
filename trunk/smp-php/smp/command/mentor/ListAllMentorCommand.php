<?php
/**
 * Created at 19/07/2010 9:55:03 AM
 * smp_command_student_ListAllMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MentorService.php');
require_once('smp/domain/Student.php');
require_once('smp/base/SessionRegistry.php');
class smp_command_mentor_ListAllMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		
		if ($request->isPost()) {
			$student = new smp_domain_Student();
			$student->setFirstname($request->getProperty('firstname'));
			$student->setLastname($request->getProperty('lastname'));
			$student->setStudentNumber($request->getProperty('studentNumber'));
			$student->setGender($request->getProperty('gender'));
			$student->setCourse($request->getProperty('course'));
			$student->setStudyMode($request->getProperty('studyMode'));
			
			$action = $request->getProperty(Constants::ACTION);
			if ($action == Constants::ACTION_SEARCH) {
				smp_base_SessionRegistry::setSearchEntity('ListMentor_MentorSearch_Student', $student);
			}
		}
		$student = smp_base_SessionRegistry::getSearchEntity('ListMentor_MentorSearch_Student');
		$mentor = new smp_domain_Mentor();
		$mentor->setStudent($student);
		$request->setSearchEntity($mentor);
		
		$datagrid = $mentorService->getAllMentorDatagrid(null, $student);
		$request->setDatagrid($datagrid);
		$request->setTitle("List of Mentors");
	}
}
