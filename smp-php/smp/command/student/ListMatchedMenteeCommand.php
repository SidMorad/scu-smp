<?php
/**
 * Created at 26/07/2010 9:37:33 AM
 * smp_command_student_ListMatchedMenteeCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MenteeService.php');
require_once('smp/service/MentorService.php');
class smp_command_student_ListMatchedMenteeCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$menteeService = new smp_service_MenteeService();
		$mentorService = new smp_service_MentorService();
		
		$list = $menteeService->findAllMatchedMentees();
		foreach($list as $mentee) {
			$mentee->setMentor($mentorService->findMentorStudentWithMenteeId($mentee->getId()));
		}
		
		$request->setList($list);
		$request->setTitle("List of Matched Mentees");
	}
}