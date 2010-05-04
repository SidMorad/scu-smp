package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.Student;
import au.edu.scu.smp.domain.enums.GenderPrefer;
import au.edu.scu.smp.domain.enums.WorkStatus;
import java.lang.Boolean;
import java.lang.String;

privileged aspect Matching_Roo_JavaBean {
    
    public GenderPrefer Matching.getGenderPrefer() {
        return this.genderPrefer;
    }
    
    public void Matching.setGenderPrefer(GenderPrefer genderPrefer) {
        this.genderPrefer = genderPrefer;
    }
    
    public WorkStatus Matching.getWorkStatus() {
        return this.workStatus;
    }
    
    public void Matching.setWorkStatus(WorkStatus workStatus) {
        this.workStatus = workStatus;
    }
    
    public Boolean Matching.getFamilyResponsibilities() {
        return this.familyResponsibilities;
    }
    
    public void Matching.setFamilyResponsibilities(Boolean familyResponsibilities) {
        this.familyResponsibilities = familyResponsibilities;
    }
    
    public Boolean Matching.getTertiaryStudies() {
        return this.tertiaryStudies;
    }
    
    public void Matching.setTertiaryStudies(Boolean tertiaryStudies) {
        this.tertiaryStudies = tertiaryStudies;
    }
    
    public String Matching.getInterests() {
        return this.interests;
    }
    
    public void Matching.setInterests(String interests) {
        this.interests = interests;
    }
    
    public String Matching.getComments() {
        return this.comments;
    }
    
    public void Matching.setComments(String comments) {
        this.comments = comments;
    }
    
    public Boolean Matching.getPreferOnCampus() {
        return this.preferOnCampus;
    }
    
    public void Matching.setPreferOnCampus(Boolean preferOnCampus) {
        this.preferOnCampus = preferOnCampus;
    }
    
    public Boolean Matching.getPreferDistance() {
        return this.preferDistance;
    }
    
    public void Matching.setPreferDistance(Boolean preferDistance) {
        this.preferDistance = preferDistance;
    }
    
    public Boolean Matching.getPreferAustralian() {
        return this.preferAustralian;
    }
    
    public void Matching.setPreferAustralian(Boolean preferAustralian) {
        this.preferAustralian = preferAustralian;
    }
    
    public Boolean Matching.getPreferInternational() {
        return this.preferInternational;
    }
    
    public void Matching.setPreferInternational(Boolean preferInternational) {
        this.preferInternational = preferInternational;
    }
    
    public Boolean Matching.getIsRegional() {
        return this.isRegional;
    }
    
    public void Matching.setIsRegional(Boolean isRegional) {
        this.isRegional = isRegional;
    }
    
    public Boolean Matching.getIsDisability() {
        return this.isDisability;
    }
    
    public void Matching.setIsDisability(Boolean isDisability) {
        this.isDisability = isDisability;
    }
    
    public Boolean Matching.getIsSocioeconomic() {
        return this.isSocioeconomic;
    }
    
    public void Matching.setIsSocioeconomic(Boolean isSocioeconomic) {
        this.isSocioeconomic = isSocioeconomic;
    }
    
    public Boolean Matching.getIsNonEnglish() {
        return this.isNonEnglish;
    }
    
    public void Matching.setIsNonEnglish(Boolean isNonEnglish) {
        this.isNonEnglish = isNonEnglish;
    }
    
    public Boolean Matching.getIsIndigenous() {
        return this.isIndigenous;
    }
    
    public void Matching.setIsIndigenous(Boolean isIndigenous) {
        this.isIndigenous = isIndigenous;
    }
    
    public Student Matching.getStudent() {
        return this.student;
    }
    
    public void Matching.setStudent(Student student) {
        this.student = student;
    }
    
}
