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
class smp_mapper_StudentMapper extends smp_mapper_Mapper {

	function __construct() {
		parent::__construct();
		$strInsertQuery = "INSERT INTO smp_student (user_id, firstname, lastname, gender, student_number, age_range, course, major, study_mode, recommended_by_staff";
		$strInsertQuery .= ",semesters_completed,family_status, work_status, tertiary_study_status,is_first_year, is_trained, is_international, is_disability, is_indigenous";
		$strInsertQuery .= ",is_non_english,is_regional,is_socioeconomic,prefer_gender,prefer_australian,prefer_distance,prefer_international,prefer_on_campus,interests,comments)";
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
		$obj->setIsTrained($array['is_trained']);
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
		return $obj;
	}

	protected function doInsert(smp_domain_DomainObject $obj) {
		$values = array($obj->getUserId(), $obj->getFirstname(), $obj->getLastname(), $obj->getGender(), $obj->getStudentNumber(), $obj->getAgeRange(), $obj->getCourse(), $obj->getMajor(),
		$obj->getStudyMode(), $obj->getRecommendedByStaff(), $obj->getSemestersCompleted(), $obj->getFamilyStatus(), $obj->getWorkStatus(), $obj->getTertiaryStudyStatus(), $obj->getIsFirstYear(), $obj->getIsTrained(),
		$obj->getIsInternational(), $obj->getIsDisability(), $obj->getIsIndigenous(), $obj->getIsNonEnglish(), $obj->getIsRegional(), $obj->getIsSocioeconomic(), $obj->getPreferGender(),
		$obj->getPreferAustralian(), $obj->getPreferDistance(), $obj->getPreferInternational(), $obj->getPreferOnCampus(), $obj->getInterests(), $obj->getComments());
		return self::$ADODB->Execute($this->insertStmt, $values);
	}

	protected function targetClass() {
		return "smp_domain_Student";
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

	function listMentors() {
		// TODO Change selectStmt to filter studnet by type 'Mentor'
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_student;");
		$rs = self::$ADODB->Execute($selectStmt);
		$list = array();
		if ($rs) {
			while ($row = $rs->FetchRow()) {
				$list[] = self::doCreateObject($row);
			}
		}
		return $list;
	}
}