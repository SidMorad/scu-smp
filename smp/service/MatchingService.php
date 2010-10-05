<?php
/**
 * Created at 23/07/2010 2:02:32 PM
 * smp_service_MatchingService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/MatchingMapper.php');
require_once('smp/service/MenteeService.php');
class smp_service_MatchingService {
	private $matchingMapper;
	private $menteeService;
	
	function __construct() {
		$this->matchingMapper = new smp_mapper_MatchingMapper();
		$this->menteeService = new smp_service_MenteeService();
	}
	
	function getAllNotMatchedMenteesDatagrid($mentee = null) {
		return $this->menteeService->getAllNotMatchedMenteesDatagrid($mentee);
	}
	
	function connectMenteeToMentor($menteeId, $mentorId) {
		return $this->matchingMapper->connectMenteeToMentor($menteeId, $mentorId);
	}

}