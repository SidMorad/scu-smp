<?php
/**
 * Created at 22/08/2010 11:57:00 AM
 * test_smp_util_ReflectionUtilTest
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('PHPUnit/Framework.php');
require_once('smp/domain/Student.php');
require_once('smp/util/ReflectionUtil.php');
class test_smp_util_ReflectionUtilTest extends PHPUnit_Framework_TestCase {
	protected $reflectionUtil;
	
	protected function setUp() {
		$this->reflectionUtil = new smp_util_ReflectionUtil();
	}
	
	public function testGetClassNameFromObject() {
		$student = new smp_domain_Student();
		$student->setFirstname('foo');
		$student->setWorkStatus('fulltime');
		$studentClassName = get_class($student); 
		$searchCriteriaString = $this->reflectionUtil->getSearchCriteria($student, 'smp_student.');
//		print Reflection::export($studentClass);
//		print Reflection::export(new ReflectionClass($studentClassName));
//		$this->assertEquals($searchCriteriaString, "smp_student.firstname LIKE '%foo%' AND smp_student.work_status LIKE '%fulltime%'");

		$mentor = new smp_domain_Mentor();
		$mentor->setTrained(true);
		$mentor->setExpired(false);
		$mentorCriteriaString = $this->reflectionUtil->getEqualsCriteria($mentor, 'smp_mentor.');
		
		$this->assertEquals($mentorCriteriaString, "smp_mentor.trained = '1' AND smp_mentor.expired = '0'");
	
	}
	
}