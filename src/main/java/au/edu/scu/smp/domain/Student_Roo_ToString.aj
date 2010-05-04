package au.edu.scu.smp.domain;

import java.lang.String;

privileged aspect Student_Roo_ToString {
    
    public String Student.toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Id: ").append(getId()).append(", ");
        sb.append("Version: ").append(getVersion()).append(", ");
        sb.append("Firstname: ").append(getFirstname()).append(", ");
        sb.append("Lastname: ").append(getLastname()).append(", ");
        sb.append("Gender: ").append(getGender()).append(", ");
        sb.append("AgeRange: ").append(getAgeRange()).append(", ");
        sb.append("StudentNumber: ").append(getStudentNumber()).append(", ");
        sb.append("StudentType: ").append(getStudentType()).append(", ");
        sb.append("StudyMode: ").append(getStudyMode()).append(", ");
        sb.append("Course: ").append(getCourse()).append(", ");
        sb.append("Major: ").append(getMajor()).append(", ");
        sb.append("FirstYearComplete: ").append(getFirstYearComplete()).append(", ");
        sb.append("RecommendedByStaff: ").append(getRecommendedByStaff()).append(", ");
        sb.append("SemestersCompeleted: ").append(getSemestersCompeleted()).append(", ");
        sb.append("International: ").append(getInternational()).append(", ");
        sb.append("Trained: ").append(getTrained()).append(", ");
        sb.append("MyscuActivated: ").append(getMyscuActivated()).append(", ");
        sb.append("User: ").append(getUser()).append(", ");
        sb.append("Matching: ").append(getMatching()).append(", ");
        sb.append("Contact: ").append(getContact());
        return sb.toString();
    }
    
}
