<?php
/**
 * Created at 26/07/2010 9:37:33 AM
 * smp_command_student_ListMatchedMenteeCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MenteeService.php');
require_once('smp/domain/Student.php');
require_once('smp/base/SessionRegistry.php');
class smp_command_student_ListMatchedMenteeCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$menteeService = new smp_service_MenteeService();
		
		$mentee = new smp_domain_Mentee();
		$mentee->setMatched(true);
		if($request->isPost()){
			$student = new smp_domain_Student();
			$student->setFirstname($request->getProperty('firstname'));
			$student->setLastname($request->getProperty('lastname'));
			$student->setStudentNumber($request->getProperty('studentNumber'));
			$student->setGender($request->getProperty('gender'));
			$student->setCourseId($request->getProperty('courseId'));
			$student->setStudyMode($request->getProperty('studyMode'));
			
			$action = $request->getProperty(Constants::ACTION);
			if($action==Constants::ACTION_SEARCH){
				$mentee->setStudent($student);
				smp_base_SessionRegistry::setSearchEntity('student_ListMatchedMentee_MenteeSearch', $mentee);
			}
		}
		$mentee = smp_base_SessionRegistry::getSearchEntity('student_ListMatchedMentee_MenteeSearch');
		$request->setSearchEntity($mentee);		
		
		$datagrid = $menteeService->getAllMenteeDatagrid($mentee);
		$request->setDatagrid($datagrid);		
		$request->setTitle("List of Matched Mentees");
	}
}