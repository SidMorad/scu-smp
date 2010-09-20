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
	
	function getAllMentorDatagrid($mentor = null, $paging = true) {
		self::$options['fields'] = array ('id','firstname', 'lastname', 'student_number', 'course_id', 'gender', 'study_mode');			 
		self::$options['labels'] = array (
			'id' => 'Id',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'student_number' => 'Student Number',
			'course_id' => 'Course',
			'gender' => 'Gender',
			'study_mode' => 'Study Mode');
		
		$mentorSearchCriteria = (!is_null($mentor) ? self::getSearchCriteria($mentor, 'smp_mentor.', true) : "");
		$studentSearchCriteria = (!is_null($mentor) ? self::getSearchCriteria($mentor->getStudent(), 'smp_student.', true) : "");
		
		$query = "SELECT smp_mentor.id, smp_mentor.mentee_limit, smp_student.firstname, smp_student.lastname, smp_student.student_number, smp_student.course_id, smp_student.gender, smp_student.study_mode 
				FROM smp_mentor INNER JOIN smp_student WHERE smp_mentor.student_id = smp_student.id ".$mentorSearchCriteria.$studentSearchCriteria;
		
		if (!$paging) {
			self::$datagrid = new Structures_DataGrid();
		}
		
		self::$datagrid->setDefaultSort(array('firstname' => 'ASC'));
		self::$datagrid->bind($query, self::$options);
		return self::$datagrid;
	}
	
	function getActiveMentorDatagrid($mentor) {
		self::$options['fields'] = array ('id', 'firstname', 'lastname', 'course_id', 'gender', 'study_mode', 'mentee_limit');			 
		self::$options['labels'] = array (
			'id' => 'Id',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'course_id' => 'Course',
			'gender' => 'Gender',
			'study_mode' => 'Study Mode',
			'mentee_limit' => 'Mentee Limit');
		if (is_null($mentor)) {
			$mentor = new smp_domain_Mentor();
		}
		// make sure is Trained and Not Expired
		$mentor->setTrained(true);
		$mentor->setExpired(false);
		$mentorEqualsCriteria = self::getEqualsCriteria($mentor, 'smp_mentor.', true);
		$studentSearchCriteria = self::getSearchCriteria($mentor->getStudent(), 'smp_student.', true);
		
		$query = "SELECT smp_mentor.id, smp_mentor.mentee_limit, smp_student.firstname, smp_student.lastname, smp_student.course_id, smp_student.gender, smp_student.study_mode 
		FROM smp_mentor INNER JOIN smp_student WHERE smp_mentor.student_id = smp_student.id ".$mentorEqualsCriteria.$studentSearchCriteria;
		
		self::$datagrid->setDefaultSort(array('id' => 'DESC'));
		self::$datagrid->bind($query, self::$options);
		return self::$datagrid;
	}	
	
	
	function getActiveMentorForMatchingDatagrid($mentor) {
		self::$options['fields'] = array ('id', 'firstname', 'lastname', 'course_id', 'gender', 'study_mode');			 
		self::$options['labels'] = array (
			'id' => 'Id',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'course_id' => 'Course',
			'gender' => 'Gender',
			'study_mode' => 'Study Mode');
		if (is_null($mentor)) {
			$mentor = new smp_domain_Mentor();
		}
		// make sure is Trained and Not Expired
		$mentor->setTrained(true);
		$mentor->setExpired(false);
		$mentorEqualsCriteria = self::getEqualsCriteria($mentor, 'smp_mentor.', true);
		$studentSearchCriteria = self::getSearchCriteria($mentor->getStudent(), 'smp_student.', true);
		
		$query = "SELECT smp_mentor.id, smp_mentor.mentee_limit, 
			(SELECT COUNT(*) FROM smp_mentor_mentee WHERE smp_mentor_mentee.mentor_id=smp_mentor.id) AS mentee_count, 
			smp_student.firstname, smp_student.lastname, smp_student.course_id, smp_student.gender, smp_student.study_mode 
			FROM smp_mentor INNER JOIN smp_student WHERE smp_mentor.student_id = smp_student.id ".$mentorEqualsCriteria.$studentSearchCriteria;
		
		self::$datagrid->setDefaultSort(array('id' => 'DESC'));
		self::$datagrid->bind($query, self::$options);
		return self::$datagrid;
	}	
	
}