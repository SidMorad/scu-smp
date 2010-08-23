<?php
/**
 * Created at 21/08/2010 10:30:11 PM
 * smp_datagrid_MentorDatagrid
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/Datagrid.php');
require_once('smp/domain/Mentor.php');
require_once('smp/domain/Student.php');
class smp_datagrid_MentorDatagrid extends smp_datagrid_Datagrid {
	
	function getAllMentorDatagrid($mentor = null, $student = null) {
		self::$options['fields'] = array ('firstname', 'lastname', 'course', 'gender', 'study_mode');			 
		self::$options['labels'] = array ('firstname' => 'First Name',
									'lastname' => 'Last Name',
									'course' => 'Course',
									'gender' => 'Gender',
									'study_mode' => 'Study Mode');
		
		$studentSearchCriteria = self::getSearchCriteria($student, 'smp_student.', true);
		
		$query = "SELECT smp_mentor.id, smp_student.firstname, smp_student.lastname, smp_student.course, smp_student.gender, smp_student.study_mode 
				FROM smp_mentor INNER JOIN smp_student WHERE smp_mentor.student_id = smp_student.id ".$studentSearchCriteria;
		$test = self::$datagrid->bind($query, self::$options);
		
		if (PEAR::isError($test)) {
			throw new Exception("DataGrid binding faild.");
		}
		return self::$datagrid;
	}
	
	function getActiveMentorDatagrid($mentor = null, $student = null) {
		self::$options['fields'] = array ('id', 'firstname', 'lastname', 'course', 'gender', 'study_mode', 'mentee_limit');			 
		self::$options['labels'] = array ('id' => 'Id',
									'firstname' => 'First Name',
									'lastname' => 'Last Name',
									'course' => 'Course',
									'gender' => 'Gender',
									'study_mode' => 'Study Mode',
									'mentee_limit' => 'Mentee Limit');
		
		$studentSearchCriteria = self::getSearchCriteria($student, 'smp_student.', true);
		$mentor = new smp_domain_Mentor();
		$mentor->setTrained(true);
		$mentor->setExpired(false);
		$mentorEqualsCriteria = self::getEqualsCriteria($mentor, 'smp_mentor.', true);
		
		$query = "SELECT smp_mentor.id, smp_mentor.mentee_limit, smp_student.firstname, smp_student.lastname, smp_student.course, smp_student.gender, smp_student.study_mode 
				FROM smp_mentor INNER JOIN smp_student WHERE smp_mentor.student_id = smp_student.id ".$mentorEqualsCriteria.$studentSearchCriteria;
		$test = self::$datagrid->bind($query, self::$options);
		
		if (PEAR::isError($test)) {
			throw new Exception("DataGrid binding faild.");
		}
		return self::$datagrid;
	}	
	
}