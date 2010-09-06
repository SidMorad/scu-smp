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
require_once('smp/mapper/Mapper.php');
require_once('smp/mapper/UserMapper.php');
require_once('smp/mapper/StudentMapper.php');
require_once('smp/mapper/ContactMapper.php');
require_once('smp/mapper/MentorMenteeMapper.php');
class smp_mapper_MenteeMapper extends smp_mapper_Mapper {
	private $userMapper;
	private $studentMapper;
	private $contactMapper;
	private $mentorMenteeMapper;

	function __construct($adodb = null) {
		parent::__construct($adodb);
		$this->userMapper = new smp_mapper_UserMapper(self::$ADODB);
		$this->studentMapper = new smp_mapper_StudentMapper(self::$ADODB);
		$this->contactMapper = new smp_mapper_ContactMapper(self::$ADODB);
		$this->mentorMenteeMapper = new smp_mapper_MentorMenteeMapper(self::$ADODB);
		$this->insertStmt = self::$ADODB->Prepare('INSERT INTO smp_mentee (user_id, student_id, contact_id, matched, expired) VALUES (?,?,?,?,?)');
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
		return $obj;
	}
	
	function doInsert(smp_domain_DomainObject $obj) {
		$values = array($obj->getUserId(), $obj->getStudentId(), $obj->getContactId(), $obj->getMatched(), $obj->getExpired());
		return self::$ADODB->Execute($this->insertStmt, $values);
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
	
}