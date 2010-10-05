<?php
/**
 * Created at 26/07/2010 9:47:34 AM
 * smp_command_mentor_ListMatchedMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MentorService.php');
require_once('smp/domain/Student.php');
require_once('smp/base/SessionRegistry.php');
class smp_command_mentor_ListMatchedMentorCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		
		$mentor = new smp_domain_Mentor();
		$mentor->setMatched(true);
		$mentor->setExpired(false);
		smp_base_SessionRegistry::setSearchEntity('mentor_ListMatchedMentor_MentorSearch', $mentor);
		if($request->isPost()){
			$student = new smp_domain_Student();
			$student->setFirstname($request->getProperty('firstname'));
			$student->setLastname($request->getProperty('lastname'));
			$student->setStudentNumber($request->getProperty('studentNumber'));
			$student->setGender($request->getProperty('gender'));
			$student->setCourseId($request->getProperty('courseId'));
			$student->setStudyMode($request->getProperty('studyMode'));
			$mentor->setExpired((is_null($request->getProperty('expired')) ? false : true));
			
			$mentor->setStudent($student);
			smp_base_SessionRegistry::setSearchEntity('mentor_ListMatchedMentor_MentorSearch', $mentor);
		}
		$mentor = smp_base_SessionRegistry::getSearchEntity('mentor_ListMatchedMentor_MentorSearch');
		$request->setSearchEntity($mentor);
		
		$outputFormat = $request->getProperty('output_format');
		if (is_null($outputFormat)) {
			$datagrid = $mentorService->getAllMentorDatagrid($mentor, true);
		} else {
			$datagrid = $mentorService->getAllMentorDatagrid($mentor, false);
		}
		
		$request->setDatagrid($datagrid);
		$request->setTitle("List of Matched Mentors");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}		
}