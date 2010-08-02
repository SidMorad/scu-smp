<?php
/**
 * Created at 16/07/2010 2:11:40 PM
 * smp_domain_Student
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/DomainObject.php');
require_once('smp/domain/User.php');
require_once('smp/domain/Contact.php');
class smp_domain_Student extends smp_domain_DomainObject {
	
	var $userId;
	var $firstname;
	var $lastname;
	var $gender;
	var $studentNumber;
	var $ageRange;
	var $course;
	var $major;
	var $studyMode;
	var $recommendedByStaff;
	var $semestersCompleted;
	var $familyStatus;
	var $workStatus;
	var $tertiaryStudyStatus;
	var $isFirstYear;
	var $isInternational;
	var $isDisability;
	var $isIndigenous;
	var $isNonEnglish;	
	var $isRegional;
	var $isSocioeconomic;
	var $preferGender;
	var $preferAustralian;
	var $preferDistance;
	var $preferInternational;
	var $preferOnCampus;
	var $interests;
	var $comments;
	var $accountStatus;
	var $user;
	var $contact;
	var $mentees = array();
	
	function __construct($id = -1) {
		parent::__construct($id);
	}
	
	function setUserId ($userId) {
		$this->userId = $userId;
	}
	function setFirstname ($firstname) {
		$this->firstname = $firstname;
	}
	function setLastname ($lastname) {
		$this->lastname = $lastname;
	}
	function setGender ($gender) {
		$this->gender = $gender;
	}
	function setStudentNumber ($studentNumber) {
		$this->studentNumber = $studentNumber;
	}
	function setAgeRange ($ageRange) {
		$this->ageRange = $ageRange;
	}
	function setCourse ($course) {
		$this->course = $course;
	}
	function setMajor ($major) {
		$this->major = $major;
	}
	function setStudyMode ($studyMode) {
		$this->studyMode = $studyMode;
	}
	function setRecommendedByStaff ($recommendedByStaff) {
		$this->recommendedByStaff = $recommendedByStaff;
	}
	function setSemestersCompleted ($semestersCompleted) {
		$this->semestersCompleted = $semestersCompleted;
	}
	function setFamilyStatus ($familyStatus) {
		$this->familyStatus = $familyStatus;
	}
	function setWorkStatus ($workStatus) {
		$this->workStatus = $workStatus;
	}
	function setTertiaryStudyStatus ($tertiaryStudyStatus) {
		$this->tertiaryStudyStatus = $tertiaryStudyStatus;
	}
	function setIsFirstYear ($isFirstYear) {
		$this->isFirstYear = $isFirstYear;
	}
	function setIsInternational ($isInternational) {
		$this->isInternational = $isInternational;
	}
	function setIsDisability ($isDisability) {
		$this->isDisability = $isDisability;
	}
	function setIsIndigenous ($isIndigenous) {
		$this->isIndigenous = $isIndigenous;
	}
	function setIsNonEnglish ($isNonEnglish) {
		$this->isNonEnglish = $isNonEnglish;
	}
	function setIsRegional ($isRegional) {
		$this->isRegional = $isRegional;
	}
	function setIsSocioeconomic ($isSocioeconomic) {
		$this->isSocioeconomic = $isSocioeconomic;
	}
	function setPreferGender ($preferGender) {
		$this->preferGender = $preferGender;
	}
	function setPreferAustralian ($preferAustralian) {
		$this->preferAustralian = $preferAustralian;
	}
	function setPreferDistance ($preferDistance) {
		$this->preferDistance = $preferDistance;
	}
	function setPreferInternational ($preferInternational) {
		$this->preferInternational = $preferInternational;
	}
	function setPreferOnCampus ($preferOnCampus) {
		$this->preferOnCampus = $preferOnCampus;
	}
	function setInterests ($interests) {
		$this->interests = $interests;
	}
	function setComments ($comments) {
		$this->comments = $comments;
	}
	function setAccountStatus ($accountStatus) {
		$this->accountStatus = $accountStatus;
	}
	function setUser(smp_domain_User $user) {
		$this->user = $user;
	}
	function setContact(smp_domain_contact $contact) {
		$this->contact = $contact;
	}
	function setMentees(array $mentees) {
		$this->mentees = $mentees;
	}
	
	function getUserId() {
		return $this->userId;
	}
	function getFirstname() {
		return $this->firstname;
	}
	function getLastname() {
		return $this->lastname;
	}
	function getGender() {
		return $this->gender;
	}
	function getStudentNumber() {
		return $this->studentNumber;
	}
	function getAgeRange() {
		return $this->ageRange;
	}
	function getCourse() {
		return $this->course;
	}
	function getMajor() {
		return $this->major;
	}
	function getStudyMode() {
		return $this->studyMode;
	}
	function getRecommendedByStaff() {
		return $this->recommendedByStaff;
	}
	function getSemestersCompleted() {
		return $this->semestersCompleted;
	}
	function getFamilyStatus() {
		return $this->familyStatus;
	}
	function getWorkStatus() {
		return $this->workStatus;
	}
	function getTertiaryStudyStatus() {
		return $this->tertiaryStudyStatus;
	}
	function getIsFirstYear() {
		return $this->isFirstYear;
	}
	function getIsInternational() {
		return $this->isInternational;
	}
	function getIsDisability() {
		return $this->isDisability;
	}
	function getIsIndigenous() {
		return $this->isIndigenous;
	}
	function getIsNonEnglish() {
		return $this->isNonEnglish;
	}
	function getIsRegional() {
		return $this->isRegional;
	}
	function getIsSocioeconomic() {
		return $this->isSocioeconomic;
	}
	function getPreferGender() {
		return $this->preferGender;
	}
	function getPreferAustralian() {
		return $this->preferAustralian;
	}
	function getPreferDistance() {
		return $this->preferDistance;
	}
	function getPreferInternational() {
		return $this->preferInternational;
	}
	function getPreferOnCampus() {
		return $this->preferOnCampus;
	}
	function getInterests() {
		return $this->interests;
	}
	function getComments() {	
		return $this->comments;
	}
	function getAccountStatus() {
		return $this->accountStatus;
	}
	function getUser() {
		return $this->user;
	}
	function getContact() {
		return (is_null($this->contact) ? new smp_domain_Contact() : $this->contact);
	}
	function getMentees() {
		return $this->mentees;
	}
	
	function __toString() {
		$studentString = $this->getId(); 
		$studentString .= ", " . $this->getFirstname();
		$studentString .= ", " . $this->getLastname();
		return $studentString;
	}	
}