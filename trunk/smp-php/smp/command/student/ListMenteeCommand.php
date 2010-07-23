<?php
/**
 * Created at 23/07/2010 1:00:18 PM
 * smp_command_student_ListMenteeCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/StudentService.php');
class smp_command_student_ListMenteeCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$studentService = new smp_service_StudentService();
		
		$list = $studentService->listMentees();
		
		$request->setList($list);
		$request->setTitle("List of Mentors");
	}

}