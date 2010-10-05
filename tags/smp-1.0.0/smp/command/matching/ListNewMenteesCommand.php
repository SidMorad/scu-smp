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
require_once('smp/base/SessionRegistry.php');
class smp_command_matching_ListNewMenteesCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$matchingService = new smp_service_MatchingService();
		
		$mentee = new smp_domain_Mentee();
		// Only Not match and Not Expired Mentees
		$mentee->setMatched(false);
		$mentee->setExpired(false);
		if ($request->isPost()) {
			$student = new smp_domain_Student();
			$student->setFirstname($request->getProperty('firstname'));
			$student->setLastname($request->getProperty('lastname'));
			$student->setStudentNumber($request->getProperty('studentNumber'));
			$student->setGender($request->getProperty('gender'));
			$student->setCourseId($request->getProperty('courseId'));
			$student->setStudyMode($request->getProperty('studyMode'));
			
			$action = $request->getProperty(Constants::ACTION);
			if ($action == Constants::ACTION_SEARCH) {
				$mentee->setStudent($student);
				smp_base_SessionRegistry::setSearchEntity('matching_ListNewMentees_MenteeSearch', $mentee);
			}
		}

		$menteeFromSession = smp_base_SessionRegistry::getSearchEntity('matching_ListNewMentees_MenteeSearch');
		if (!is_null($menteeFromSession)) {
			$mentee = $menteeFromSession;
			$request->setSearchEntity($mentee);
		}
		
		$datagrid = $matchingService->getAllNotMatchedMenteesDatagrid($mentee);
		$request->setDatagrid($datagrid);
		
		$request->setTitle("List of Not Matched Mentees");
	}

	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER, Constants::ROLE_COORDINATOR);
	}
}