<?php
/**
 * Created at 06/08/2010 12:14:50 PM
 * smp_mentor_MenteeMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
require_once('smp/domain/Mentee.php');
require_once('smp/domain/Mentor.php');
require_once('smp/mapper/Mapper.php');
require_once('smp/mapper/RoleMapper.php');
require_once('smp/mapper/UserMapper.php');
require_once('smp/mapper/StudentMapper.php');
require_once('smp/mapper/ContactMapper.php');
require_once('smp/mapper/MentorMenteeMapper.php');

class smp_mapper_MenteeMapper extends smp_mapper_Mapper {
	private $roleMapper;
	private $userMapper;
	private $studentMapper;
	private $contactMapper;
	private $mentorMenteeMapper;

	function __construct($adodb = null) {
		parent::__construct($adodb);
		$this->roleMapper = new smp_mapper_RoleMapper(self::$ADODB);
		$this->userMapper = new smp_mapper_UserMapper(self::$ADODB);
		$this->studentMapper = new smp_mapper_StudentMapper(self::$ADODB);
		$this->contactMapper = new smp_mapper_ContactMapper(self::$ADODB);
		$this->mentorMenteeMapper = new smp_mapper_MentorMenteeMapper(self::$ADODB);
		$this->insertStmt = self::$ADODB->Prepare('INSERT INTO smp_mentee (user_id, student_id, contact_id, matched, expired) VALUES (?,?,?,?,?)');
	}
	/**
	 * Copy Mentee information to the Mentor table and
	 * Change User's role from Mentee to Mentor.
	 * 
	 * @param Mentee id $id
	 */
	function copyMenteeInfoAsMentor($id) {
		self::$ADODB->StartTrans();
		$mentee = self::find($id);
		
		$insertStmt = self::$ADODB->Prepare('INSERT INTO smp_mentor(user_id, student_id, contact_id) VALUES(?,?,?)');
		self::$ADODB->Execute($insertStmt, array($mentee->getUserId(), $mentee->getStudentId(), $mentee->getContactId()));
		
		$deleteStmt = self::$ADODB->Prepare('DELETE FROM smp_user_role WHERE user_id=?');
		self::$ADODB->Execute($deleteStmt, array($mentee->getUserId()));
		
		// Update user's role to ROLE_MENTOR
		$role = $this->roleMapper->findRoleByName(Constants::ROLE_MENTOR);
		$insertStmt2 = self::$ADODB->Prepare('INSERT INTO smp_user_role(user_id, role_id) VALUES(?,?)');
		self::$ADODB->Execute($insertStmt2, array($mentee->getUserId(), $role->getId()));
		
		// Update Mentee table as it's already copied
		$updateStmt = self::$ADODB->Prepare('UPDATE smp_mentee SET copied_as_mentor=? WHERE id=?');
		self::$ADODB->Execute($updateStmt, array(true, $id));
		
		return self::$ADODB->CompleteTrans();
	}

	function markMenteeForWantToBeMentor($id) {
		$updateStmt = self::$ADODB->Prepare("UPDATE smp_mentee SET want_to_be_mentor=? WHERE id=?");
		return self::$ADODB->Execute($updateStmt, array(true, $id));
	}
	
	function markMenteeAsExpired($id) {
		$updateStmt = self::$ADODB->Prepare("UPDATE smp_mentee SET expired=? WHERE id=?");
		return self::$ADODB->Execute($updateStmt, array(true, $id));
	}

	function markMenteeAsNotExpired($id) {
		$updateStmt = self::$ADODB->Prepare("UPDATE smp_mentee SET expired=?, matched=? WHERE id=?");
		return self::$ADODB->Execute($updateStmt, array(false, false, $id));
	}
	
	function save(smp_domain_Mentee $mentee) {
		$rs = self::doInsert($mentee);
		if ($rs === false) {
			$this->logger->save(new smp_domain_Log("mentor.save", "Mentor save failed, message:".self::$ADODB->ErrorMsg()));
			return null;
		} else {
			$mentee->setId(self::$ADODB->Insert_ID());	
			return $mentee;
		}
	}
	
	function findAllNotMatchedMentees() {
		$selectStmt = self::$ADODB->Prepare('SELECT * FROM smp_mentee WHERE matched IS ? or matched=?');
		$rs = self::$ADODB->Execute($selectStmt, array(null, false));
		$list = array();
		while($row = $rs->FetchRow()) {
			$mentee = self::doCreateObject($row);
			$mentee->setStudent($this->studentMapper->find($mentee->getStudentId()));
			$list[] = $mentee;
		}
		return $list;
	}

	function findAllMatchedMentees() {
		$selectStmt = self::$ADODB->Prepare('SELECT * FROM smp_mentee WHERE matched=?');
		$rs = self::$ADODB->Execute($selectStmt, array(true));
		$list = array();
		while($row = $rs->FetchRow()) {
			$mentee = self::doCreateObject($row);
			$mentee->setStudent($this->studentMapper->find($mentee->getStudentId()));
			$list[] = $mentee;
		}
		return $list;
	}

	function find($id) {
		$selectStmt = self::$ADODB->Prepare('SELECT * FROM smp_mentee WHERE id=?');
		$rs = self::$ADODB->Execute($selectStmt, array($id));
		return (($rs === false) ? null: self::doCreateObject($rs->FetchRow()));
	}
	
	function findWithMentee($mentee) {
		$menteeEqualsCriteriaString = self::getEqualsCriteria($mentee,"",false);
		$rs = self::$ADODB->Execute('SELECT * FROM smp_mentee WHERE '.$menteeEqualsCriteriaString);
		return (($rs === false) ? null: self::doCreateObject($rs->FetchRow()));
	}	
	
	function findMenteeWithStudentId($studentId) {
		$student = $this->studentMapper->find($studentId);
		$user = $this->userMapper->findUserWithStudentId($student->getId());
		$contact = $this->contactMapper->findContactWithStudentId($student->getId());
		$mentee = new smp_domain_Mentee($user, $student, $contact);
		return $mentee;
	}
	
	function findMenteesWithMentorStudentId ($studentId) {
		$students = $this->studentMapper->findStudentMenteesWithStudentId($studentId);
		$list = array();
		foreach ($students as $student) {
			$mentee = self::findMenteeWithStudentId($student->getId());
			$mentee->setRelation($this->mentorMenteeMapper->findRelationWithMenteeId($student->getId()));
			$list[] = $mentee;
		}
		return $list;
	}

	function findMenteesWithMentorId($mentorId) {
		$selectStmt = self::$ADODB->Prepare('SELECT smp_mentee.* FROM smp_mentee INNER JOIN smp_mentor_mentee ON smp_mentee.id = smp_mentor_mentee.mentee_id WHERE smp_mentor_mentee.mentor_id=?');
		$rs = self::$ADODB->Execute($selectStmt, array($mentorId));
		$list = array();
		while ($row = $rs->FetchRow()) {
			$mentee = (is_array($row) ? self::doCreateObject($row) : null);
			$list[] = $mentee;
		}
		return $list;
	}

	function findMenteesStudentWithMentorId($mentorId) {
		$mentees = self::findMenteesWithMentorId($mentorId);
		foreach ($mentees as $mentee) {
			$mentee->setStudent($this->studentMapper->find($mentee->getStudentId()));
		}
		return $mentees;	
	}

	function findMenteesStudentRelationWithMentorId($mentorId) {
		$mentees = self::findMenteesStudentWithMentorId($mentorId);
		foreach ($mentees as $mentee) {
			$mentee->setRelation($this->mentorMenteeMapper->findRelationWithMenteeId($mentee->getId()));
		}
		return $mentees;	
	}
	
	function findMenteesStudentRelationUserContactWithMentorId($mentorId) {
		$mentees = self::findMenteesStudentRelationWithMentorId($mentorId);
		foreach ($mentees as $mentee) {
			$mentee->setContact($this->contactMapper->find($mentee->getContactId()));
			$mentee->setUser($this->userMapper->find($mentee->getUserId()));
		}
		return $mentees;	
	}
	
	function getEmailAddressToArray($mentee) {
		$mentor = self::findMentorWithMenteeId($mentee->getId());
		$emailArray = array();
		if (!is_null($mentor)) {
			$emails = "";
			$user = $this->userMapper->findUserWithStudentId($mentor->getStudentId());
			if (!is_null($user->getScuEmail())) {
				$emails = $user->getScuEmail();
			}
			$contact = $this->contactMapper->findContactWithStudentId($mentor->getStudentId());
			if (!is_null($contact->getEmail())) {
				$emails .= ",". $contact->getEmail(); 
			}
			$student = $this->studentMapper->findStudentWithUser($user);
			$emailArray[$emails] = "My Mentor : " .$student->getFirstname() . " " . $student->getLastname() . " (".$emails.")";
		}
		return $emailArray;
	}
	
	function findMentorWithMenteeId($menteeId) {
		$selectStmt = self::$ADODB->Prepare('SELECT smp_mentor.* FROM smp_mentor INNER JOIN smp_mentor_mentee ON smp_mentor.id = smp_mentor_mentee.mentor_id WHERE smp_mentor_mentee.mentee_id=?');
		$rs = self::$ADODB->Execute($selectStmt, array($menteeId));
		$row = $rs->FetchRow();
		$mentor = (is_array($row) ? self::doCreateMentor($row) : null);
		return $mentor;	
	}
	
	function doCreateMentor($array) {
		$mentor = new smp_domain_Mentor();
		$mentor->setId($array['id']);
		$mentor->setUserId($array['user_id']);
		$mentor->setStudentId($array['student_id']);
		$mentor->setContactId($array['contact_id']);
		$mentor->setMenteeLimit($array['mentee_limit']);
		$mentor->setTrained($array['trained']);
		$mentor->setMatched($array['matched']);
		$mentor->setExpired($array['expired']);
		return $mentor;
	}

	function targetClass() {
		return "smp_domain_Mentee";
	}
	
	function doCreateObject(array $array) {
		$obj = new smp_domain_Mentee();
		$obj->setId($array['id']);
		$obj->setUserId($array['user_id']);
		$obj->setStudentId($array['student_id']);
		$obj->setContactId($array['contact_id']);
		$obj->setMatched($array['matched']);
		$obj->setExpired($array['expired']);
		$obj->setWantToBeMentor($array['want_to_be_mentor']);
		$obj->setCopiedAsMentor($array['copied_as_mentor']);
		return $obj;
	}
	
	function doInsert(smp_domain_DomainObject $obj) {
		$values = array($obj->getUserId(), $obj->getStudentId(), $obj->getContactId(), $obj->getMatched(), $obj->getExpired());
		return self::$ADODB->Execute($this->insertStmt, $values);
	}
	
}