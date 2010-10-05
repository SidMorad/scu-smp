<?php
/**
 * Created at 02/10/2010 3:35:29 PM
 * smp_command_mentee_UndoExpireMenteeFormCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/MenteeService.php');

class smp_command_mentee_UndoExpireMenteeFormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$menteeService = new smp_service_MenteeService();
		
		$menteeId = $request->getProperty('menteeId');
		if (is_null($menteeId)) {
			$request->addFeedback("Please Select Mentee for being Marked as Not Expired Mentee!");
		} else {
			$result = $menteeService->markMenteeAsNotExpired($menteeId);
			if ($result) {
				$request->addFeedback("Selected Mentee by id [".$menteeId."] updated as Not Expired Mentee.");
			} else {
				$request->addError("Selected Mentee by id [".$menteeId."] did not updated as Not Expired Mentee.");
			}
		}
		
		$request->redirect($request->getProperty('next'));
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}
}