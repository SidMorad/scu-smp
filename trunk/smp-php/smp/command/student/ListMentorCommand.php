<?php
/**
 * Created at 19/07/2010 9:55:03 AM
 * smp_command_student_ListMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MentorService.php');
class smp_command_student_ListMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$mentorService = new smp_service_MentorService();
		$datagrid = $mentorService->getAllMentorDatagrid();
		$request->setDatagrid($datagrid);
		$request->setTitle("List of Mentors");
	}
}
