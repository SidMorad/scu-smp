<?php
/**
 * Created at 23/07/2010 1:00:18 PM
 * smp_command_student_ListAllMenteeCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @au
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MenteeService.php');
require_once('smp/domain/Student.php');
require_once('smp/base/SessionRegistry.php');
class smp_command_mentee_ListAllMenteeCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$menteeService= new smp_service_MenteeService();
		
		$mentee=new smp_domain_Mentee();
		if($request->isPost()){
			$student=new smp_domain_Student();
			$student->setFirstname($request->getProperty('firstname'));
			$student->setLastname($request->getProperty('lastname'));
			$student->setStudentNumber($request->getProperty('studentNumber'));
			$student->setGender($request->getProperty('gender'));
			$student->setCourse($request->getProperty('course'));
			$student->setStudyMode($request->getProperty('studyMode'));
		}
		
		$action=$request->getProperty(Constants::ACTION);
		if($action ==Constants::ACTION_SEARCH){
			$mentee->setStudent($student);
			smp_base_SessionRegistry::setSearchEntity('mentee_ListAllMentee_MenteeSearch', $mentee);
		}
		$mentee =smp_base_SessionRegistry::getSearchEntity('mentee_ListAllMentee_MenteeSearch');
		$request->setSearchEntity($mentee);
		
		$datagrid=$menteeService->getAllMenteeDatagrid($mentee);
		$request->setDatagrid($datagrid);
		$request->setTitle("List of Mentees");
	}

}