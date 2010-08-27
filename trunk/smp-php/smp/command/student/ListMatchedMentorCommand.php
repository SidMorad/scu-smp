<?php
/**
 * Created at 26/07/2010 9:47:34 AM
 * smp_command_student_ListMatchedMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MentorService.php');
require_once('smp/domain/Student.php');
require_once('smp/base/SessionRegistry.php');
class smp_command_student_ListMatchedMentorCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		
		$mentor= new smp_domain_Mentor();
		if($request->isPost()){
			$student=new smp_domain_Student();
			$student->setFirstName($request->getProperty('firstname'));
			$student->setLastName($request->getProperty('lastname'));
			$student->setStudentNumber($request->getProperty('studentNumber'));
			$student->setGender($request->getProperty('gender'));
			$student->setCourse($request->getProperty('course'));
			$student->setStudyMode($request->getProperty('studyMode'));
			
			$action=$request->getProperty(Constants::ACTION);
			if($action==Constants::ACTION_SEARCH){
				$mentor->setStudent($student);
				smp_base_SessionRegistry::setSearchEntity('student_ListMatchedMentor_MentorSearch',$mentor);
			}
		}
		$mentor=smp_base_SessionRegistry::getSearchEntity('student_ListMatchedMentor_MentorSearch');
		$request->setSearchEntity($mentor);
		
		$mentor->setMatched(true);
		$datagrid = $mentorService->getAllMentorDatagrid($mentor);
		$request->setDatagrid($datagrid);
		$request->setTitle("List of Matched Mentors");
	}
}