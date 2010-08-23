<?php
/**
 * Created at 23/08/2010 2:27:11 PM
 * __FILE__
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/Datagrid.php');
class smp_datagrid_MenteeDatagrid extends smp_datagrid_Datagrid {
	
	function getMenteeDatagrid($mentee = null) {
		self::$options['fields'] = array ('id','firstname', 'lastname', 'student_number', 'course', 'gender', 'study_mode');			 
		self::$options['labels'] = array (
			'id' => 'Id',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'student_number' => 'Student Number',
			'course' => 'Course',
			'gender' => 'Gender',
			'study_mode' => 'Study Mode');
		if (!is_null($mentee)) {
			$menteeSearchCriteria = self::getSearchCriteria($mentee, 'smp_mentee.', true);
			$studentSearchCriteria = self::getSearchCriteria($mentee->getStudent(), 'smp_student.', true);
		}
		
		$query = "SELECT smp_mentee.id, smp_student.firstname, smp_student.lastname, smp_student.student_number, smp_student.course, smp_student.gender, smp_student.study_mode 
				FROM smp_mentee INNER JOIN smp_student WHERE smp_mentee.student_id = smp_student.id ".$menteeSearchCriteria.$studentSearchCriteria;
		self::$datagrid->setDefaultSort(array('id' => 'DESC'));
		self::$datagrid->bind($query, self::$options);
		
		return self::$datagrid;
		
	}

}