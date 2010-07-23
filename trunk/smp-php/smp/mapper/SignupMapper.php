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
		$this->userMapper = new smp_mapper_UserMapper(self::$ADODB);
		$this->studentMapper = new smp_mapper_StudentMapper(self::$ADODB);
		$this->contactMapper = new smp_mapper_ContactMapper(self::$ADODB);
	}
	
	protected function targetClass() {}
	protected function doInsert(smp_domain_DomainObject $obj) {}
	protected function doCreateObject(array $array) {}
	
	function saveMentor($user, $student, $contact) {
		self::$ADODB->StartTrans();
		$ok = true;
		$msg = "";
		
		$user = $this->userMapper->save($user);	
		if (is_null($user)) {
			$ok = false;
			$msg = "Save User failed, Error message:" . self::$ADODB->ErrorMsg();
		}
		
		if ($ok) {
			$student->setUserId($user->getId());
			$student = $this->studentMapper->save($student);
			if (is_null($student)) {
				$ok = false;
				$msg = "Save Student failed, Error message:" . self::$ADODB->ErrorMsg();
			}
		}
		
		if ($ok) {
			$contact->setUserId($user->getId());
			$contact->setStudentId($student->getId());
			$contact = $this->contactMapper->save($contact);
			if (is_null($contact)) {
				$ok = false;
				$msg = "Save Contact failed, Error message:" . self::$ADODB->ErrorMsg();
			}
		}
		$ok = self::$ADODB->CompleteTrans();
		
		if (! $ok) {
			$this->logger->save(new smp_domain_Log("signup.save.mentor", "Error occoured on Save New Mentor: ". $msg));
		}
		
		return $ok;
	}
}