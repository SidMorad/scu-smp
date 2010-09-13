<?php
/**
 * Created at 06/08/2010 12:02:03 PM
 * smp_mentor_MentorMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
require_once('smp/domain/Mentor.php');
require_once('smp/mapper/UserMapper.php');
require_once('smp/mapper/StudentMapper.php');
require_once('smp/mapper/ContactMapper.php');
require_once('smp/mapper/MenteeMapper.php');
class smp_mapper_MentorMapper extends smp_mapper_Mapper {
	private $userMapper;
	private $studentMapper;
	private $contactMapper;
	private $menteeMapper;
	
	function __construct($adodb = null) {
		parent::__construct($adodb);
		$this->userMapper = new smp_mapper_UserMapper();
		$this->studentMapper = new smp_mapper_StudentMapper();
		$this->contactMapper = new smp_mapper_ContactMapper();
		$this->menteeMapper = new smp_mapper_MenteeMapper();
		$this->insertStmt = self::$ADODB->Prepare('INSERT INTO smp_mentor (user_id, student_id, contact_id, mentee_limit, trained, matched, expired) VALUES (?,?,?,?,?,?,?)');
	}

	function targetClass() {
		return "smp_domain_Mentor";
	}
	
	function doCreateObject(array $array) {
		$obj = new smp_domain_Mentor();
		$obj->setId($array['id']);
		$obj->setUserId($array['user_id']);
		$obj->setStudentId($array['student_id']);
		$obj->setContactId($array['contact_id']);
		$obj->setMenteeLimit($array['mentee_limit']);
		$obj->setTrained($array['trained']);
		$obj->setMatched($array['matched']);
		$obj->setExpired($array['expired']);
		return $obj;
	}
	
	function getEmailAddressToArray($mentor) {
		$mentees = $this->menteeMapper->findMenteesWithMentorId($mentor->getId());
		$emailArray = array();
		foreach($mentees as $mentee) {
			$emails = "";
			$user = $this->userMapper->findUserWithStudentId($mentee->getStudentId());
			if (!is_null($user->getScuEmail())) {
				$emails = $user->getScuEmail();
			}
			$contact = $this->contactMapper->findContactWithStudentId($mentee->getStudentId());
			if (!is_null($contact->getEmail())) {
				$emails .= ",". $contact->getEmail(); 
			}
			$student = $this->studentMapper->findStudentWithUser($user);
			$emailArray[$emails] = "My Mentee : " .$student->getFirstname() . " " . $student->getLastname() . " (".$emails.")";
		}
		return $emailArray;
	}
	
	function updateMentorLimit($mentorId, $menteeLimit) {
		$updateStmt = self::$ADODB->Prepare('UPDATE smp_mentor SET mentee_limit=? where id=?');
		$rs = self::$ADODB->Execute($updateStmt, array($menteeLimit, $mentorId));
		return ($rs === false ? false : true);
	}
	
	function doInsert(smp_domain_DomainObject $obj) {
		$values = array($obj->getUserId(), $obj->getStudentId(), $obj->getContactId(), $obj->getMenteeLimit(), $obj->getTrained(), $obj->getMatched(), $obj->getExpired());
		return self::$ADODB->Execute($this->insertStmt, $values);
	}
	
	function save(smp_domain_Mentor  $mentor) {
		$rs = self::doInsert($mentor);
		if ($rs === false) {
			$this->logger->save(new smp_domain_Log("mentor.save", "Mentor save failed, message:".self::$ADODB->ErrorMsg()));
			return null;
		} else {
			$mentor->setId(self::$ADODB->Insert_ID());	
			return $mentor;
		}
	}
	
	
	function markMentorAsTrained($mentorId) {
		$updateStmt = self::$ADODB->Prepare("UPDATE smp_mentor SET trained=? WHERE id=?");
		$rs = self::$ADODB->Execute($updateStmt, array(true, $mentorId));
		if ($rs === false) {
			return false;
		} else {
			return true;
		}
	}
	
	function findMentorWithStudentId($studentId) {
		$student = $this->studentMapper->find($studentId);
		$user = $this->userMapper->findUserWithStudentId($studentId);
		$contact = $this->contactMapper->findContactWithUserId($user->getId());
		$mentor = new smp_domain_Mentor($user, $student, $contact);
		return $mentor;
	}

	function findMentorWithStudentMenteeId($studentId) {
		$student = $this->studentMapper->findStudentMentorWithMenteeId($studentId);
		if (is_null($student)) {
			return null;
		}
		$user = $this->userMapper->findUserWithStudentId($student->getId());
		$contact = $this->contactMapper->findContactWithUserId($user->getId());
		$mentor = new smp_domain_Mentor($user, $student, $contact);
		return $mentor;
	}

	function findAllMatchedMentor() {
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_mentor WHERE matched=?");
		$rs = self::$ADODB->execute($selectStmt, array(true));
		$list = array();
		while ($row = $rs->FetchRow()) {
			$mentor = self::doCreateObject($row);
			$mentor->setStudent($this->studentMapper->find($mentor->getStudentId()));
			$list[] = $mentor;
		}
		return $list;
	}
	
	function findAllNotTrainedMentor() {
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_mentor WHERE trained is NULL or trained=?");
		$rs = self::$ADODB->execute($selectStmt, array(false));
		$list = array();
		while ($row = $rs->FetchRow()) {
			$mentor = self::doCreateObject($row);
			$mentor->setStudent($this->studentMapper->find($mentor->getStudentId()));
			$list[] = $mentor;
		}
		return $list;
	}	

	function findAllTrainedMentor() {
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_mentor WHERE trained=?");
		$rs = self::$ADODB->execute($selectStmt, array(true));
		$list = array();
		while ($row = $rs->FetchRow()) {
			$mentor = self::doCreateObject($row);
			$mentor->setStudent($this->studentMapper->find($mentor->getStudentId()));
			$list[] = $mentor;
		}
		return $list;
	}

	function find($id) {
		$selectStmt = self::$ADODB->Prepare('SELECT * FROM smp_mentor WHERE id=?');
		$rs = self::$ADODB->Execute($selectStmt, array($id));
		return (($rs === false) ? null: self::doCreateObject($rs->FetchRow()));
	}

	function findWithMentor($mentor) {
		$mentorEqualsCriteriaString = self::getEqualsCriteria($mentor,"",false);
		$rs = self::$ADODB->Execute('SELECT * FROM smp_mentor WHERE '.$mentorEqualsCriteriaString);
		return (($rs === false) ? null: self::doCreateObject($rs->FetchRow()));
	}	

	function findMentorWithMenteeId($menteeId) {
		$selectStmt = self::$ADODB->Prepare('SELECT * FROM smp_mentor INNER JOIN smp_mentor_mentee ON smp_mentor.id = smp_mentor_mentee.mentor_id WHERE smp_mentor_mentee.mentee_id=?');
		$rs = self::$ADODB->Execute($selectStmt, array($menteeId));
		$row = $rs->FetchRow();
		$mentor = (is_array($row) ? self::doCreateObject($row) : null);
		return $mentor;
	}
	
	
}