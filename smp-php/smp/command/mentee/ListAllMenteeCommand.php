<?php
/**
 * Created at 23/07/2010 1:00:18 PM
 * smp_command_student_ListAllMenteeCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a> 
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MenteeService.php');
require_once('smp/domain/Student.php');
require_once('smp/base/SessionRegistry.php');
class smp_command_mentee_ListAllMenteeCommand extends smp_command_Command {	
	function doExecute(smp_controller_Request $request) {
		$menteeService = new smp_service_MenteeService();
		
		$mentee = new smp_domain_Mentee();
		if($request->isPost()){
			$student = new smp_domain_Student();
			$student->setFirstname($request->getProperty('firstname'));
			$student->setLastname($request->getProperty('lastname'));
			$student->setStudentNumber($request->getProperty('studentNumber'));
			$student->setGender($request->getProperty('gender'));
			$student->setCourseId($request->getProperty('courseId'));
			$student->setStudyMode($request->getProperty('studyMode'));
			$mentee->setExpired((is_null($request->getProperty('expired')) ? null : true));
			$mentee->setMatched((is_null($request->getProperty('matched')) ? null : true));
			
			
			$mentee->setStudent($student);
			smp_base_SessionRegistry::setSearchEntity('mentee_ListAllMentee_MenteeSearch', $mentee);
		}
		$mentee = smp_base_SessionRegistry::getSearchEntity('mentee_ListAllMentee_MenteeSearch');
		$request->setSearchEntity($mentee);
		
		$outputFormat = $request->getProperty('output_format');
		if(is_null($outputFormat)){
			$datagrid = $menteeService->getAllMenteeDatagrid($mentee);
		}else{
			$datagrid = $menteeService->getAllMenteeDatagrid($mentee, false);
		}
		
		
		$request->setDatagrid($datagrid);
		$request->setTitle("List of Mentees");
	}

	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}
}