<?php
/**
 * Created at 12/10/2010 2:46:01 PM
 * smp_command_mentee_ListMenteesThatWantToBeMentor
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/Mentee.php');
require_once('smp/datagrid/MenteeDatagrid.php');

class smp_command_mentee_ListMenteesThatWantToBeMentorCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request) {
		$request->setTitle('List Mentees that want to be Mentor');

		$menteeDatagrid = new smp_datagrid_MenteeDatagrid();	
		
		$mentee = new smp_domain_Mentee();
		$mentee->setExpired(true);
		$mentee->setWantToBeMentor(true);
		$mentee->setCopiedAsMentor(false);
		$datagrid = $menteeDatagrid->getMenteeDatagrid($mentee);
		$request->setDatagrid($datagrid);
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}
}