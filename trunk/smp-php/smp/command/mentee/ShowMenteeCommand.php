<?php
/**
 * Created at 06/09/2010 12:57:58 PM
 * smp/command/mentee/ShowMenteeCommand.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/service/MenteeService.php');
require_once('smp/service/UserService.php');
require_once('smp/service/StudentService.php');
require_once('smp/service/ContactService.php');
class smp_command_mentee_ShowMenteeCommand extends smp_command_Command{
	function doExecute(smp_controller_Request $request){
		$id=$request->getProperty('id');
		
		$menteeService=new smp_service_menteeService();
		$userService=new smp_service_UserService();
		$studentService=new smp_service_StudentService();
		$contactService=new smp_service_ContactService();
		
		$mentee=$menteeService->find($id);
		$mentee->setUser($userService->find($mentee->getUserId()));
		$mentee->setStudent($studentService->find($mentee->getStudentId()));
		$mentee->setContact($contactService->find($mentee->getContactId()));
		
		$request->setEntity($mentee);
		$request->setTitle("mentee Info | ".$mentee->getStudent());		
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}	
}