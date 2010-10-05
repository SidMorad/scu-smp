<?php
/**
 * Created at 21/07/2010 7:57:55 PM
 * smp_mapper_SignupMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/UserMapper.php');
require_once('smp/mapper/RoleMapper.php');
require_once('smp/mapper/StudentMapper.php');
require_once('smp/mapper/ContactMapper.php');
require_once('smp/mapper/MentorMapper.php');
require_once('smp/mapper/MenteeMapper.php');
class smp_mapper_SignupMapper extends smp_mapper_Mapper {
	protected $userMapper;
	protected $roleMapper;
	protected $studentMapper;
	protected $contactMapper;
	protected $mentorMapper;
	protected $menteeMapper;
	
	function __construct($adodb = null) {
		parent::__construct($adodb);
		$this->roleMapper = new smp_mapper_RoleMapper(self::$ADODB);
		$this->userMapper = new smp_mapper_UserMapper(self::$ADODB);
		$this->studentMapper = new smp_mapper_StudentMapper(self::$ADODB);
		$this->contactMapper = new smp_mapper_ContactMapper(self::$ADODB);
		$this->mentorMapper = new smp_mapper_MentorMapper(self::$ADODB);
		$this->menteeMapper = new smp_mapper_MenteeMapper(self::$ADODB);
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
		// Save User Roles
		$arrRoleIds = array();
		foreach ($user->getRoles() as $roleName) {
			$role = $this->roleMapper->findRoleByName($roleName);
			$arrRoleIds[] = $role->getId();			
		}
		$this->userMapper->saveUserRoles($user->getId(), $arrRoleIds);
		
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
		
		if ($ok) {
			$mentor = new smp_domain_Mentor();
			$mentor->setUserId($user->getId());
			$mentor->setStudentId($student->getId());
			$mentor->setContactId($contact->getId());
			//set default values
			$mentor->setTrained(false);
			$mentor->setMatched(false);
			$mentor->setExpired(false);
			$mentor = $this->mentorMapper->save($mentor);
			if (is_null($mentor)) {
				$ok = false;
				$msg = "Save Mentor failed, Error message:" . self::$ADODB->ErrorMsg();
			}
		}
		
		$ok = self::$ADODB->CompleteTrans();
		if (! $ok) {
			$this->logger->save(new smp_domain_Log("signup.save", $msg));
		}
		return $ok;
	}

	function saveMentee($user, $student, $contact) {
		self::$ADODB->StartTrans();
		$ok = true;
		$msg = "";
		
		$user = $this->userMapper->save($user);	
		if (is_null($user)) {
			$ok = false;
			$msg = "Save User failed, Error message:" . self::$ADODB->ErrorMsg();
		}
		// Save User Roles
		$arrRoleIds = array();
		foreach ($user->getRoles() as $roleName) {
			$role = $this->roleMapper->findRoleByName($roleName);
			$arrRoleIds[] = $role->getId();			
		}
		$this->userMapper->saveUserRoles($user->getId(), $arrRoleIds);
		
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
		
		if ($ok) {
			$mentee = new smp_domain_Mentee();
			$mentee->setUserId($user->getId());
			$mentee->setStudentId($student->getId());
			$mentee->setContactId($contact->getId());
			// set default values
			$mentee->setMatched(false);
			$mentee->setExpired(false);
			$mentee = $this->menteeMapper->save($mentee);
			if (is_null($mentee)) {
				$ok = false;
				$msg = "Save Mentee failed, Error message:" . self::$ADODB->ErrorMsg();
			}
		}
		
		
		$ok = self::$ADODB->CompleteTrans();
		if (! $ok) {
			$this->logger->save(new smp_domain_Log("signup.save", $msg));
		}
		return $ok;
	}
}