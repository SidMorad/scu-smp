<?php
/**
 * Created at 20/08/2010 2:12:39 PM
 * smp_command_mentor_ListActiveMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require('smp/service/MentorService.php');
require('smp/util/Validator.php');
class smp_command_mentor_ListActiveMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		
		if ($request->isPost()) {
			$mentorId = $request->getProperty('mentorId');
			$menteeLimit = $request->getProperty('menteeLimit');
			
			// Check Validation
			$validator = new smp_util_Validator();
			if (! $validator->checkWithRegex('menteeLimit', '', '/^[0-9]{1}$/')) {
				$request->addError('Mentee Limit should be number between 0 to 9');
			} else {
				$fullName = $request->getProperty('fullName');
				$updated = $mentorService->updateMentorLimit($mentorId, $menteeLimit);
				if ($updated) {
					$request->addFeedback("Mentee limit[". $menteeLimit ."] for Mentor[". $fullName ."] updated successfully.");
				}
			}
		}
		
		$datagrid = $mentorService->getAactiveMentorDatagrid();	
		
		$request->setDatagrid($datagrid);
		$request->setTitle("List Active Mentors");
	}
}