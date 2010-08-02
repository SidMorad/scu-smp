<?php
/**
 * Created at 26/07/2010 9:37:33 AM
 * smp_command_student_ListMatchedMenteeCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/Constants.php');
require_once('smp/command/Command.php');
require_once('smp/service/StudentService.php');
class smp_command_student_ListMatchedMenteeCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$studentService = new smp_service_StudentService();
		
		$list = $studentService->listStudentWithAccountStatus(Constants::AS_MATCHED_MENTEE);
		foreach($list as $mentee) {
			$mentee->setMentor($studentService->findStudentMentorWithMenteeId($mentee->getId()));
		}
		
		$request->setList($list);
		$request->setTitle("List of Matched Mentees");
	}
}