<?php
/**
 * Created at 20/08/2010 2:12:39 PM
 * smp_command_mentor_ListActiveMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require('smp/service/MentorService.php');
class smp_command_mentor_ListActiveMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		
		if ($request->isPost()) {
			$mentorId = $request->getProperty('mentorId');
			$menteeLimit = $request->getProperty('menteeLimit');
			$mentorService->updateMentorLimit($mentorId, $menteeLimit);
		}
		
		$datagrid = $mentorService->getAactiveMentorDatagrid();	
		
		$request->setDatagrid($datagrid);
		$request->setTitle("List Active Mentors");
	}
}