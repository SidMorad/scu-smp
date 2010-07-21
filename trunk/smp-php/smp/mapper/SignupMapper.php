<?php
/**
 * Created at 21/07/2010 7:57:55 PM
 * __FILE__
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/UserMapper.php');
require_once('smp/mapper/StudentMapper.php');
require_once('smp/mapper/ContactMapper.php');
class smp_mapper_SignupMapper extends smp_mapper_Mapper {
	protected $userMapper;
	protected $studentMapper;
	protected $contactMapper;
	
	function __construct($adodb = null) {
		parent::__construct($adodb);
		$this->userMapper = new smp_mapper_UserMapper();
		$this->studentMapper = new smp_mapper_StudentMapper();
		$this->contactMapper = new smp_mapper_ContactMapper();
	}
	
	protected function targetClass() {}
	protected function doInsert(smp_domain_DomainObject $obj) {}
	protected function doCreateObject(array $array) {}
	
	function saveMentor($user, $student, $contact) {
		self::$ADODB->StartTrans();
		
		$user = $this->userMapper->save($user);	
		
		$student->setUserId($user->getId());
		$student = $this->studentMapper->save($student);
		
		$contact->setUserId($user->getId());
		$contact->setStudentId($student->getId());
		$contact = $this->contactMapper->save($contact);
		
		return self::$ADODB->CompleteTrans();
	}
}