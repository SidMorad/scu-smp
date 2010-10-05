<?php
/**
 * Created at 29/08/2010 5:20:49 PM
 * smp_serivce_MentorMenteeService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/MentorMenteeMapper.php');
require_once('smp/datagrid/MentorMenteeDatagrid.php');
class smp_service_MentorMenteeService {
	private $mentorMenteeMapper;
	private $mentorMenteeDatagrid;
	
	function __construct() {
		$this->mentorMenteeMapper = new smp_mapper_MentorMenteeMapper();
		$this->mentorMenteeDatagrid = new smp_datagrid_MentorMenteeDatagrid();
	}
	
	function confirmContactMentee($id) {
		return $this->mentorMenteeMapper->confirmContactMentee($id);
	}
	
	function getAllMentorMenteeDatagrid($mentorMentee) {
		return $this->mentorMenteeDatagrid->getAllMentorMenteeDatagrid($mentorMentee);
	}
}