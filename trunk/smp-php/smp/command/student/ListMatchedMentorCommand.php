<?php
/**
 * Created at 26/07/2010 9:47:34 AM
 * smp_command_student_ListMatchedMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MentorService.php');
require_once('smp/service/MenteeService.php');
class smp_command_student_ListMatchedMentorCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		$menteeService = new smp_service_MenteeService();
		
		$list = $mentorService->findAllMatchedMentor();
		foreach($list as $mentor) {
			$mentor->setMentees($menteeService->findMenteesWithMentorId($mentor->getId()));
		}
		
		$request->setList($list);
		$request->setTitle("List of Matched Mentors");
	}
}