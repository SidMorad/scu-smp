package au.edu.scu.smp.domain;

import java.lang.String;

privileged aspect GroupTraining_Roo_ToString {
    
    public String GroupTraining.toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Id: ").append(getId()).append(", ");
        sb.append("Version: ").append(getVersion()).append(", ");
        sb.append("TrainingDate: ").append(getTrainingDate()).append(", ");
        sb.append("Location: ").append(getLocation()).append(", ");
        sb.append("Status: ").append(getStatus()).append(", ");
        sb.append("Mentors: ").append(getMentors() == null ? "null" : getMentors().size());
        return sb.toString();
    }
    
}
