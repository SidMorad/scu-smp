<?php
/**
 * Created at 29/08/2010 3:52:52 PM
 * smp_command_mentor_ConfirmContactMenteeCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/MentorMenteeService.php');
class smp_command_mentor_ConfirmContactMenteeCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$relationId = $request->getProperty('relation_id');
		if (is_null($relationId)) {
			$request->addError('Error: Mentor-Mentee information not found.');
		} else if ($relationId == -1){
			$request->addError('Error: Mentor-Mentee id is not set.');	
		} else {
			$mmService = new smp_serivce_MentorMenteeService();
			$result = $mmService->confirmContactMentee($relationId);
			if ($result === false) {
				$request->addError('Update failed!');
			} else {
				$request->addFeedback('Update was successfull.');			
			}
		}
		$request->redirect('mentor/showProfileMentees');
	}
}