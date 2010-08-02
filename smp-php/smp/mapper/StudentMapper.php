<?php
/**
 * Created at 16/07/2010 3:10:36 PM
 * smp_mapper_StudentMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
require_once('smp/domain/Student.php');
require_once('smp/domain/Log.php');
require_once('smp/mapper/ContactMapper.php');
require_once('smp/mapper/UserMapper.php');
class smp_mapper_StudentMapper extends smp_mapper_Mapper {

	function __construct() {
		parent::__construct();
		$strInsertQuery = "INSERT INTO smp_student (user_id, firstname, lastname, gender, student_number, age_range, course, major, study_mode, recommended_by_staff";
		$strInsertQuery .= ",semesters_completed,family_status, work_status, tertiary_study_status,is_first_year, is_international, is_disability, is_indigenous";
		$strInsertQuery .= ",is_non_english,is_regional,is_socioeconomic,prefer_gender,prefer_australian,prefer_distance,prefer_international,prefer_on_campus,interests,comments, account_status)";
		$strInsertQuery .= "values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$this->insertStmt = self::$ADODB->Prepare($strInsertQuery);
	}

	protected function doCreateObject(array $array) {
		$obj = new smp_domain_Student();
		$obj->setId($array['id']);
		$obj->setUserId($array['user_id']);
		$obj->setFirstname($array['firstname']);
		$obj->setLastname($array['lastname']);
		$obj->setGender($array['gender']);
		$obj->setStudentNumber($array['student_number']);
		$obj->setAgeRange($array['age_range']);
		$obj->setCourse($array['course']);
		$obj->setMajor($array['major']);
		$obj->setStudyMode($array['study_mode']);
		$obj->setRecommendedByStaff($array['recommended_by_staff']);
		$obj->setSemestersCompleted($array['semesters_completed']);
		$obj->setFamilyStatus($array['family_status']);
		$obj->setWorkStatus($array['work_status']);
		$obj->setTertiaryStudyStatus($array['tertiary_study_status']);
		$obj->setIsFirstYear($array['is_first_year']);
		$obj->setIsInternational($array['is_international']);
		$obj->setIsDisability($array['is_disability']);
		$obj->setIsIndigenous($array['is_indigenous']);
		$obj->setIsNonEnglish($array['is_non_english']);
		$obj->setIsRegional($array['is_regional']);
		$obj->setIsSocioeconomic($array['is_socioeconomic']);
		$obj->setPreferGender($array['prefer_gender']);
		$obj->setPreferAustralian($array['prefer_australian']);
		$obj->setPreferDistance($array['prefer_distance']);
		$obj->setPreferInternational($array['prefer_international']);
		$obj->setPreferOnCampus($array['prefer_on_campus']);
		$obj->setInterests($array['interests']);
		$obj->setComments($array['comments']);
		$obj->setAccountStatus($array['account_status']);
		return $obj;
	}

	protected function doInsert(smp_domain_DomainObject $obj) {
		$values = array($obj->getUserId(), $obj->getFirstname(), $obj->getLastname(), $obj->getGender(), $obj->getStudentNumber(), $obj->getAgeRange(), $obj->getCourse(), $obj->getMajor(),
		$obj->getStudyMode(), $obj->getRecommendedByStaff(), $obj->getSemestersCompleted(), $obj->getFamilyStatus(), $obj->getWorkStatus(), $obj->getTertiaryStudyStatus(), $obj->getIsFirstYear(),
		$obj->getIsInternational(), $obj->getIsDisability(), $obj->getIsIndigenous(), $obj->getIsNonEnglish(), $obj->getIsRegional(), $obj->getIsSocioeconomic(), $obj->getPreferGender(),
		$obj->getPreferAustralian(), $obj->getPreferDistance(), $obj->getPreferInternational(), $obj->getPreferOnCampus(), $obj->getInterests(), $obj->getComments(), $obj->getAccountStatus());
		return self::$ADODB->Execute($this->insertStmt, $values);
	}

	protected function targetClass() {
		return "smp_domain_Student";
	}

	function connectMenteeToMentor($menteeId, $mentorId) {
		self::$ADODB->StartTrans();
		$msg = "";
		
		$insertStmt = self::$ADODB->Prepare("INSERT INTO smp_mentor_mentee(mentor_id, mentee_id, expired) VALUES(?,?,?)");
		$ok = self::$ADODB->Execute($insertStmt, array($mentorId, $menteeId, false));
		if (! $ok) {
			$msg = self::$ADODB->ErrorMsg();
			$ok = true;
		}
		
		$updateMenteeStmt = self::$ADODB->Prepare("UPDATE smp_student SET account_status=? WHERE id=?");
		$ok = self::$ADODB->Execute($updateMenteeStmt, array(Constants::AS_MATCHED_MENTEE, $menteeId));
		if (! $ok) {
			$msg = self::$ADODB->ErrorMsg();
			$ok = true;
		}

		$updateMentorStmt = self::$ADODB->Prepare("UPDATE smp_student SET account_status=? WHERE id=?");
		$ok = self::$ADODB->Execute($updateMentorStmt, array(Constants::AS_MATCHED_MENTOR, $mentorId));
		if (! $ok) {
			$msg = self::$ADODB->ErrorMsg();
			$ok = true;
		}
		
		$ok = self::$ADODB->CompleteTrans();
	 	$this->logger->save(new smp_domain_Log("student.insert.update", "Updating student information, message:" . $msg));
		
		return $ok;
	}
	
	function markMentorAsTrained($mentorId) {
		$updateStmt = self::$ADODB->Prepare("UPDATE smp_student SET account_status=? WHERE id=?");
		$rs = self::$ADODB->Execute($updateStmt, array(Constants::AS_TRAINED_MENTOR, $mentorId));
		if ($rs === false) {
			return false;
		} else {
			return true;
		}
	}
	
	function save(smp_domain_Student $student) {
		$rs = self::doInsert($student);
		if ($rs === false) {
			$this->logger->save(new smp_domain_Log("student.save", "Student save failed, message:".self::$ADODB->ErrorMsg()));
			return null;
		} else {
			$student->setId(self::$ADODB->Insert_ID());
			$this->logger->save(new smp_domain_Log("student.save", "Student save successfully, student:".$student));
			return $student;
		}
	}

	function find($id) {
		$findStmt = self::$ADODB->Prepare("SELECT * FROM smp_student WHERE id=?");
		$rs = self::$ADODB->Execute($findStmt, array($id));
		return ($rs ? self::doCreateObject($rs->FetchRow()) : null);
	}
	
	function findStudentWithUser($user) {
		$findStmt = self::$ADODB->Prepare("SELECT * FROM smp_student WHERE user_id=?");
		$rs = self::$ADODB->Execute($findStmt, array($user->getId()));
		return ($rs ? self::doCreateObject($rs->FetchRow()) : null);
	}
	
	function findStudentMenteesWithMentorId($id) {
		$findStmt = self::$ADODB->Prepare("SELECT mentee_id FROM smp_mentor_mentee WHERE mentor_id=?");
		$rs = self::$ADODB->Execute($findStmt, array($id));
		$listMenttes = array();
		$userMapper = new smp_mapper_UserMapper();
		$contactMapper = new smp_mapper_ContactMapper();
     	while (!$rs->EOF) {
			$menteeId = $rs->fields('mentee_id');
			$mentee = self::find($menteeId);
			$contact = $contactMapper->findContactWithUserId($mentee->getUserId());
			(($contact!= null) ? $mentee->setContact($contact) : true);
			$mentee->setUser($userMapper->findUserWithStudentId($mentee->getId()));
			$listMenttes[] = $mentee;
			$rs->MoveNext();
		}
		return $listMenttes;
	}
	
	function listMentors() {
		// Filter Student with Account status MENTOR
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_student WHERE account_status like ?");
		$rs = self::$ADODB->Execute($selectStmt, array('%MENTOR%'));
		$list = array();
		if ($rs) {
			while ($row = $rs->FetchRow()) {
				$list[] = self::doCreateObject($row);
			}
		}
		return $list;
	}

	function listMentees() {
		// Filter Student with Account status MENTEE
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_student WHERE account_status like ?");
		$rs = self::$ADODB->Execute($selectStmt, array('%MENTEE%'));
		$list = array();
		if ($rs) {
			while ($row = $rs->FetchRow()) {
				$list[] = self::doCreateObject($row);
			}
		}
		return $list;
	}
	
	function listStudentWithAccountStatus($accountStatus) {
		// list Student with passed Account status
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_student WHERE account_status like ?");
		$rs = self::$ADODB->Execute($selectStmt, array("%$accountStatus%"));
		$list = array();
		if ($rs) {
			while ($row = $rs->FetchRow()) {
				$list[] = self::doCreateObject($row);
			}
		}
		return $list;
	}	

	function listStudentWithAccountStatuses($arrAccountStatus) {
		// list Student with passed Account status
		$conditionString = "";
		foreach($arrAccountStatus as $ccountStatus) {
			$conditionString .= " account_status=? or";
		}
		$conditionString = substr($conditionString, 0, strlen($conditionString) -3);
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_student WHERE ". $conditionString);
		$rs = self::$ADODB->Execute($selectStmt, $arrAccountStatus);
		$list = array();
		if ($rs) {
			while ($row = $rs->FetchRow()) {
				$list[] = self::doCreateObject($row);
			}
		}
		return $list;
	}	
	
}