<?php
/**
 * Created at 09/08/2010 2:07:25 PM
 * smp_service_MentorService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('Structures/DataGrid.php');
require_once('smp/base/ApplicationRegistry.php');
require_once('PEAR.php');
require_once('smp/util/OptionProvider.php');
require_once('smp/mapper/MentorMapper.php');
require_once('smp/mapper/MenteeMapper.php');
class smp_service_MentorService {
	protected $mentorMapper;
	protected $menteeMapper;
	protected $studentMapper;
	
	function __construct() {
		$this->menteeMapper = new smp_mapper_MenteeMapper();
		$this->mentorMapper = new smp_mapper_MentorMapper();
		$this->studentMapper = new smp_mapper_StudentMapper();
	}
	
	function updateMentorLimit($mentorId, $menteeLimit) {
		$this->mentorMapper->updateMentorLimit($mentorId, $menteeLimit);
	}
	
	/**
	 * This method return all student by status *Mentor* .
	 * 
	 * @return Structures_DataGrid $datagrid
	 */
	function getAllMentorDataGrid() {
		$datagrid =& new Structures_DataGrid(5);
		$options = array('dsn' => smp_base_ApplicationRegistry::getMDB2DSN());
		$options['generate_columns'] = true;
		$options['fields'] = array ('firstname', 'lastname', 'course', 'gender', 'study_mode');			 
		$options['labels'] = array ('firstname' => 'First Name',
									'lastname' => 'Last Name',
									'course' => 'Course',
									'gender' => 'Gender',
									'study_mode' => 'Study Mode');
		$query = "SELECT smp_mentor.id, smp_student.firstname, smp_student.lastname, smp_student.course, smp_student.gender, smp_student.study_mode 
				FROM smp_mentor INNER JOIN smp_student WHERE smp_mentor.student_id = smp_student.id";
		$test = $datagrid->bind($query, $options);
		if (PEAR::isError($test)) {
			throw new Exception("DataGrid binding faild.");
		}
		return $datagrid;
	}

	/**
	 * This method return Active Mentor.
	 * Active Mentors are Trained and not Expired
	 * 
	 * @return Structures_DataGrid $datagrid
	 */
	function getAactiveMentorDatagrid() {
			$datagrid =& new Structures_DataGrid(5);
		$options = array('dsn' => smp_base_ApplicationRegistry::getMDB2DSN());
		$options['generate_columns'] = true;
		$options['fields'] = array ('firstname', 'lastname', 'course', 'gender', 'study_mode');			 
		$options['labels'] = array ('firstname' => 'First Name',
									'lastname' => 'Last Name',
									'course' => 'Course',
									'gender' => 'Gender',
									'study_mode' => 'Study Mode');
		$query = "SELECT smp_mentor.id, smp_mentor.mentee_limit, smp_student.firstname, smp_student.lastname, smp_student.course, smp_student.gender, smp_student.study_mode 
				FROM smp_mentor INNER JOIN smp_student WHERE smp_mentor.student_id = smp_student.id and smp_mentor.trained=1 and smp_mentor.expired<>1";
		$test = $datagrid->bind($query, $options);
		if (PEAR::isError($test)) {
			throw new Exception("DataGrid binding faild.");
		}
		return $datagrid;
	}
	
	function findAllMatchedMentor() {
		return $this->mentorMapper->findAllMatchedMentor();	
	}
	
	function findAllNonTrainedMentor() {
		return $this->mentorMapper->findAllNotTrainedMentor();	
	}
	
	function findAllTrainedMentor() {
		return $this->mentorMapper->findAllTrainedMentor();	
	}
	
	function markMentorAsTrained($mentorId) {
		return $this->mentorMapper->markMentorAsTrained($mentorId);
	}
	
	function find($id) {
		return $this->mentorMapper->find($id);
	}
	
	function findMentorStudentMentees($mentorId) {
		$mentor = self::find($mentorId);
		$mentor->setStudent($this->studentMapper->find($mentor->getStudentId()));
		$mentees = $this->menteeMapper->findMenteesStudentRelationWithMentorId($mentorId);
		$mentor->setMentees($mentees);
		return $mentor;
	}

	function findMentorWithMenteeId($menteeId) {
		return $this->mentorMapper->findMentorWithMenteeId($menteeId);
	}
	
	function findMentorStudentWithMenteeId($menteeId) {
		$mentor = self::findMentorWithMenteeId($menteeId);
		$mentor->setStudent($this->studentMapper->find($mentor->getStudentId()));
		return $mentor;
	}
}