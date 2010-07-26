<?php
/**
 * Created at 26/07/2010 10:24:27 AM
 * smp_command_ListNonTrainedMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/Constants.php');
require_once('smp/command/Command.php');
require_once('smp/service/StudentService.php');
class smp_command_matching_ListNonTrainedMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_request $request) {
		$studentService = new smp_service_StudentService();
		
		$listNonTrainedMentor = $studentService->listStudentWithAccountStatus(Constants::AS_NEW_MENTOR);
		$request->setList($listNonTrainedMentor);
		$request->setTitle("List of Non Trained Mentor"); 
	}
}