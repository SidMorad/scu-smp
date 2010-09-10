<?php
/**
 * Created at 16/07/2010 3:10:36 PM
 * smp_mapper_StudentMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/Student.php');
require_once('smp/domain/Log.php');
require_once('smp/mapper/Mapper.php');
class smp_mapper_StudentMapper extends smp_mapper_Mapper {
	
	function __construct() {
		parent::__construct();
		$strInsertQuery = "INSERT INTO smp_student (user_id, firstname, lastname, gender, student_number, age_range, course_id, major, study_mode, recommended_by_staff";
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
		$obj->setCourseId($array['course_id']);
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
		$values = array($obj->getUserId(), $obj->getFirstname(), $obj->getLastname(), $obj->getGender(), $obj->getStudentNumber(), $obj->getAgeRange(), $obj->getCourseId(), $obj->getMajor(),
		$obj->getStudyMode(), $obj->getRecommendedByStaff(), $obj->getSemestersCompleted(), $obj->getFamilyStatus(), $obj->getWorkStatus(), $obj->getTertiaryStudyStatus(), $obj->getIsFirstYear(),
		$obj->getIsInternational(), $obj->getIsDisability(), $obj->getIsIndigenous(), $obj->getIsNonEnglish(), $obj->getIsRegional(), $obj->getIsSocioeconomic(), $obj->getPreferGender(),
		$obj->getPreferAustralian(), $obj->getPreferDistance(), $obj->getPreferInternational(), $obj->getPreferOnCampus(), $obj->getInterests(), $obj->getComments(), $obj->getAccountStatus());
		return self::$ADODB->Execute($this->insertStmt, $values);
	}

	protected function targetClass() {
		return "smp_domain_Student";
	}

	function update($student) {
		$strUpdateQuery = "UPDATE smp_student SET firstname=?, lastname=?, gender=?, student_number=?, age_range=?, course_id=?, major=?, study_mode=?, recommended_by_staff=?,";		
		$strUpdateQuery .= "semesters_completed=?,family_status=?, work_status=?, tertiary_study_status=?,is_first_year=?, is_international=?, is_disability=?, is_indigenous=?,";
		$strUpdateQuery .= "is_non_english=?,is_regional=?,is_socioeconomic=?,prefer_gender=?,prefer_australian=?,prefer_distance=?,prefer_international=?,prefer_on_campus=?,interests=?,comments=?";
		$strUpdateQuery .= " WHERE id=?";
		$updateStmt = self::$ADODB->Prepare($strUpdateQuery);
		
		$rs = self::$ADODB->Execute($updateStmt, array($student->getFirstname(), $student->getLastname(), $student->getGender(), $student->getStudentNumber(), $student->getAgeRange(), $student->getCourseId(), $student->getMajor(),
		$student->getStudyMode(), $student->getRecommendedByStaff(), $student->getSemestersCompleted(), $student->getFamilyStatus(), $student->getWorkStatus(), $student->getTertiaryStudyStatus(), $student->getIsFirstYear(),
		$student->getIsInternational(), $student->getIsDisability(), $student->getIsIndigenous(), $student->getIsNonEnglish(), $student->getIsRegional(), $student->getIsSocioeconomic(), $student->getPreferGender(),
		$student->getPreferAustralian(), $student->getPreferDistance(), $student->getPreferInternational(), $student->getPreferOnCampus(), $student->getInterests(), $student->getComments(), $student->getId()));
		return $rs;
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
		$row = $rs->FetchRow(); 
		return (is_array($row) ? self::doCreateObject($row) : null);
	}
	
	function findStudentWithUser($user) {
		$findStmt = self::$ADODB->Prepare("SELECT * FROM smp_student WHERE user_id=?");
		$rs = self::$ADODB->Execute($findStmt, array($user->getId()));
		$row = $rs->FetchRow(); 
		return (is_array($row) ? self::doCreateObject($row) : null);
	}
	
	function findStudentMenteesWithMentorId($id) {
		$findStmt = self::$ADODB->Prepare("SELECT mentee_id FROM smp_mentor_mentee WHERE mentor_id=?");
		$rs = self::$ADODB->Execute($findStmt, array($id));
		$list = array();
     	while (!$rs->EOF) {
			$studentId = $rs->fields('mentee_id');
			$student = self::find($studentId);
			$list[] = $student;
			$rs->MoveNext();
		}
		return $list;
	}
	
	function findStudentMenteesWithStudentId($id) {
		$findStmt = self::$ADODB->Prepare('SELECT id FROM smp_mentor WHERE student_id=?');
		$rs = self::$ADODB->Execute($findStmt, array($id));
		$row = $rs->FetchRow();
		return self::findStudentMenteesWithMentorId($row['id']);
	}
	
	function findStudentMentorWithMenteeId($id) {
		$findStmt = self::$ADODB->Prepare("SELECT mentor_id FROM smp_mentor_mentee WHERE mentee_id=?");
		$rs = self::$ADODB->Execute($findStmt, array($id));
		$row = $rs->FetchRow();
		$studentId = $row['mentor_id'];
		$mentor = self::find($studentId);
		return $mentor;
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
	
	// TODO Remove this method and Refactor related classes
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

	// TODO Remove this method and Refactor related classes
	function listStudentWithAccountStatuses($arrAccountStatus) {
		// list Student with passed Account status
		$conditionString = "";
		foreach($arrAccountStatus as $ccountStatus) {
			$conditionString .= " account_status=? or";
		}
		$conditionString = substr($conditionString, 0, strlen($conditionString) -3);
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_student WHERE ". $conditionString. " ORDER BY id DESC");
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