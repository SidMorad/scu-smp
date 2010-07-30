<?php
/**
 * Created at 26/07/2010 9:47:34 AM
 * smp_command_student_ListMatchedMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/Constants.php');
require_once('smp/command/Command.php');
require_once('smp/service/StudentService.php');
class smp_command_student_ListMatchedMentorCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$studentService = new smp_service_StudentService();
		
		$list = $studentService->listStudentWithAccountStatus(Constants::AS_MATCHED_MENTOR);
		foreach($list as $mentor) {
			$mentor->setMentees($studentService->findStudentMenteesWithMentorId($mentor->getId()));
		}
		
		$request->setList($list);
		$request->setTitle("List of Matched Mentors");
	}
}