<?php
/**
 * Created at 23/08/2010 2:27:11 PM
 * smp_datagrid_MenteeDatagrid
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/Datagrid.php');


class smp_datagrid_MenteeDatagrid extends smp_datagrid_Datagrid {
	
	function getMenteeDatagrid($mentee = null, $paging=ture) {
		self::$options['fields'] = array ('id','firstname', 'lastname', 'student_number', 'course_id', 'gender', 'study_mode');			 
		self::$options['labels'] = array (
			'id' => 'Id',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'student_number' => 'Student Number',
			'course_id' => 'Course',
			'gender' => 'Gender',
			'study_mode' => 'Study Mode');

		$menteeSearchCriteria = (!is_null($mentee) ? self::getSearchCriteria($mentee, 'smp_mentee.', true) : "");
		$studentSearchCriteria = (!is_null($mentee) ? self::getSearchCriteria($mentee->getStudent(), 'smp_student.', true) : "");
		
		$query = "SELECT smp_mentee.id, smp_mentee.expired, smp_student.firstname, smp_student.lastname, smp_student.student_number, smp_student.course_id, smp_student.gender, smp_student.study_mode 
				FROM smp_mentee INNER JOIN smp_student WHERE smp_mentee.student_id = smp_student.id ".$menteeSearchCriteria.$studentSearchCriteria;
				
		if(!$paging){
			self::$datagrid = new Structures_DataGrid();
		}
		
		self::$datagrid->setDefaultSort(array('id' => 'ASC'));
		self::$datagrid->bind($query, self::$options);
		
		return self::$datagrid;
		
	}

	function getMatchedMenteeDatagrid($mentee = null) {
		self::$options['fields'] = array ('id','firstname', 'lastname', 'student_number', 'course_id', 'gender', 'study_mode');			 
		self::$options['labels'] = array (
			'id' => 'Id',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'student_number' => 'Student Number',
			'course_id' => 'Course',
			'gender' => 'Gender',
			'study_mode' => 'Study Mode');

		$menteeSearchCriteria = (!is_null($mentee) ? self::getSearchCriteria($mentee, 'smp_mentee.', true) : "");
		$studentSearchCriteria = (!is_null($mentee) ? self::getSearchCriteria($mentee->getStudent(), 'smp_student.', true) : "");
		
		$query = "SELECT smp_mentee.id, smp_mentee.expired, smp_student.firstname, smp_student.lastname, smp_student.student_number, smp_student.course_id, smp_student.gender, smp_student.study_mode,
				(SELECT lastname FROM smp_student WHERE smp_mentor.student_id = smp_student.id) AS mentor_lastname
				FROM smp_mentee, smp_student, smp_mentor_mentee, smp_mentor WHERE smp_mentee.student_id = smp_student.id AND smp_mentee.id = smp_mentor_mentee.mentee_id AND smp_mentor_mentee.mentor_id = smp_mentor.id".$menteeSearchCriteria.$studentSearchCriteria;
		self::$datagrid->setDefaultSort(array('id' => 'DESC'));
		self::$datagrid->bind($query, self::$options);
		
		return self::$datagrid;
		
	}

}