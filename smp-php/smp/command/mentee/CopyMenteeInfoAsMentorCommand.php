<?php
/**
 * Created at 12/10/2010 3:20:31 PM
 * smp_command_mentee_CopyMenteeInfoAsMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/MenteeService.php');

class smp_command_mentee_CopyMenteeInfoAsMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$id = $request->getProperty('id');
		
		$menteeService = new smp_service_MenteeService();
		$result = $menteeService->copyMenteeInfoAsMentor($id);
		
		if ($result) {
			$request->addFeedback("Convert Mentee to Mentor was successfull.");
		} else {
			$request->addError("Convert failed.");
		}
		$request->setProperty('id','');
		$request->redirect('mentee/listMenteesThatWantToBeMentor');	
	}

	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}
}