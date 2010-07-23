<?php
/**
 * Created at 23/07/2010 1:58:53 PM
 * smp_command_matching_ListNewMenteesCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/MatchingService.php');
class smp_command_matching_ListNewMenteesCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$matchingService = new smp_service_MatchingService();
		
		$list = $matchingService->listNewMentees();
		$request->setList($list);
		
		$request->setTitle("List of New Mentees");
	}

}