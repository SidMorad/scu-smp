<?php
/**
 * Created at 30/07/2010 2:22:56 PM
 * smp_command_student_ShowStudentMentorMenteesCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MentorService.php');
class smp_command_student_ShowStudentMentorMenteesCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$mentorId = $request->getProperty('mentorId');
		
		$mentorService = new smp_service_MentorService();
		$mentor = $mentorService->findMentorStudentMentees($mentorId);
		
		$request->setEntity($mentor);
		$request->setTitle("Mentor's Mentees");
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}		
}