<?php
/**
 * Created at 30/08/2010 10:13:40 AM
 * smp_datagrid_MentorMenteeDatagrid
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/Datagrid.php');
class smp_datagrid_MentorMenteeDatagrid extends smp_datagrid_Datagrid {
	
	function getAllMentorMenteeDatagrid($mentorMentee) {
		self::$options['fields'] = array('id', 'mentor_id', 'mentee_id', 'create_time', 'mentor_contact_confirm', 'mentor_contact_confirm_time', 'expired');
		self::$options['labels'] = array(
			'id' => 'Id',
			'mentor_id' => 'Mentor',
			'mentee_id' => 'Mentee',
			'create_time' => 'Create Time',
			'mentor_contact_confirm' => 'Mentor Confirm?',
			'mentor_contact_confirm_time' => 'Mentor Confirm Time'
		);
		
		$mmSearchCriteria = (!is_null($mentorMentee) ? self::getSearchCriteria($mentorMentee,'smp_mentor_mentee.', false) : "");
		
		if ($mmSearchCriteria == "") {
			$query = "SELECT smp_mentor_mentee.*, smp_mentor.student_id,
			(SELECT lastname FROM smp_student WHERE smp_mentor.student_id=smp_student.id) AS mentor_lastname,
			(SELECT lastname FROM smp_student WHERE smp_mentee.student_id=smp_student.id) AS mentee_lastname 
			FROM smp_mentor_mentee, smp_mentor, smp_mentee WHERE smp_mentor_mentee.mentor_id = smp_mentor.id AND smp_mentor_mentee.mentee_id = smp_mentee.id";
		} else {
			$query = "SELECT * FROM smp_mentor_mentee WHERE ".$mmSearchCriteria;
		}
		
		self::$datagrid->setDefaultSort(array('id' => 'DESC'));
		self::$datagrid->bind($query, self::$options);
		return self::$datagrid;
	}

}