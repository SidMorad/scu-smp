<?php
/**
 * Created at 30/08/2010 9:58:40 AM
 * smp_command_mentormentee_ListAllMentorMenteeCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/MentorMenteeService.php');
class smp_command_mentormentee_ListAllMentorMenteeCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$mmService = new smp_service_MentorMenteeService();
		$datagrid = $mmService->getAllMentorMenteeDatagrid(null);
		
		$request->setDatagrid($datagrid);
		$request->setTitle('List all Mentor&Mentee');
	}
}