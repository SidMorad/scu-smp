package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.Contact;
import au.edu.scu.smp.domain.Matching;
import au.edu.scu.smp.domain.User;
import au.edu.scu.smp.domain.enums.AgeRange;
import au.edu.scu.smp.domain.enums.Gender;
import au.edu.scu.smp.domain.enums.StudentType;
import au.edu.scu.smp.domain.enums.StudyMode;
import java.lang.Boolean;
import java.lang.Integer;
import java.lang.String;

privileged aspect Student_Roo_JavaBean {
    
    public String Student.getFirstname() {
        return this.firstname;
    }
    
    public void Student.setFirstname(String firstname) {
        this.firstname = firstname;
    }
    
    public String Student.getLastname() {
        return this.lastname;
    }
    
    public void Student.setLastname(String lastname) {
        this.lastname = lastname;
    }
    
    public Gender Student.getGender() {
        return this.gender;
    }
    
    public void Student.setGender(Gender gender) {
        this.gender = gender;
    }
    
    public AgeRange Student.getAgeRange() {
        return this.ageRange;
    }
    
    public void Student.setAgeRange(AgeRange ageRange) {
        this.ageRange = ageRange;
    }
    
    public Integer Student.getStudentNumber() {
        return this.studentNumber;
    }
    
    public void Student.setStudentNumber(Integer studentNumber) {
        this.studentNumber = studentNumber;
    }
    
    public StudentType Student.getStudentType() {
        return this.studentType;
    }
    
    public void Student.setStudentType(StudentType studentType) {
        this.studentType = studentType;
    }
    
    public StudyMode Student.getStudyMode() {
        return this.studyMode;
    }
    
    public void Student.setStudyMode(StudyMode studyMode) {
        this.studyMode = studyMode;
    }
    
    public String Student.getCourse() {
        return this.course;
    }
    
    public void Student.setCourse(String course) {
        this.course = course;
    }
    
    public String Student.getMajor() {
        return this.major;
    }
    
    public void Student.setMajor(String major) {
        this.major = major;
    }
    
    public Boolean Student.getFirstYearComplete() {
        return this.firstYearComplete;
    }
    
    public void Student.setFirstYearComplete(Boolean firstYearComplete) {
        this.firstYearComplete = firstYearComplete;
    }
    
    public String Student.getRecommendedByStaff() {
        return this.recommendedByStaff;
    }
    
    public void Student.setRecommendedByStaff(String recommendedByStaff) {
        this.recommendedByStaff = recommendedByStaff;
    }
    
    public Integer Student.getSemestersCompeleted() {
        return this.semestersCompeleted;
    }
    
    public void Student.setSemestersCompeleted(Integer semestersCompeleted) {
        this.semestersCompeleted = semestersCompeleted;
    }
    
    public Boolean Student.getInternational() {
        return this.international;
    }
    
    public void Student.setInternational(Boolean international) {
        this.international = international;
    }
    
    public Boolean Student.getTrained() {
        return this.trained;
    }
    
    public void Student.setTrained(Boolean trained) {
        this.trained = trained;
    }
    
    public Boolean Student.getMyscuActivated() {
        return this.myscuActivated;
    }
    
    public void Student.setMyscuActivated(Boolean myscuActivated) {
        this.myscuActivated = myscuActivated;
    }
    
    public User Student.getUser() {
        return this.user;
    }
    
    public void Student.setUser(User user) {
        this.user = user;
    }
    
    public Matching Student.getMatching() {
        return this.matching;
    }
    
    public void Student.setMatching(Matching matching) {
        this.matching = matching;
    }
    
    public Contact Student.getContact() {
        return this.contact;
    }
    
    public void Student.setContact(Contact contact) {
        this.contact = contact;
    }
    
}
