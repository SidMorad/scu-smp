<?php
/**
 * Created at 29/08/2010 5:20:49 PM
 * smp_serivce_MentorMenteeService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/MentorMenteeMapper.php');
class smp_serivce_MentorMenteeService {
	private $mentorMenteeMapper;
	
	function __construct() {
		$this->mentorMenteeMapper = new smp_mapper_MentorMenteeMapper();
	}
	
	function confirmContactMentee($id) {
		return $this->mentorMenteeMapper->confirmContactMentee($id);
	}
}