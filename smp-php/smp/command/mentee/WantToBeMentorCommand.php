<?php
/**
 * Created at 12/10/2010 1:42:02 PM
 * smp_command_mentee_WantToBeMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/MenteeService.php');

class smp_command_mentee_WantToBeMentorCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$menteeId = $request->getProperty('menteeId');
		
		$menteeService = new smp_service_MenteeService();
		
		$result = $menteeService->markMenteeForWantToBeMentor($menteeId);
		
		if ($result) {
			$request->addFeedback("Your request for being Mentor submitted successfully.");
		} else {
			$request->addError("Your request for being Mentor failed.");
		}
		$request->setTitle('Want to be Mentor ?');
		$request->redirect('mentee/showProfileMentor');		
	}

	function doSecurity() {
		$this->roles = array(Constants::ROLE_MENTEE);
	}
}