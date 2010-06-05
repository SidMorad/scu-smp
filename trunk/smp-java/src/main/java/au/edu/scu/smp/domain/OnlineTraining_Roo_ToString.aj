package au.edu.scu.smp.domain;

import java.lang.String;

privileged aspect OnlineTraining_Roo_ToString {
    
    public String OnlineTraining.toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Id: ").append(getId()).append(", ");
        sb.append("Version: ").append(getVersion()).append(", ");
        sb.append("TrainingDate: ").append(getTrainingDate()).append(", ");
        sb.append("Mentor: ").append(getMentor());
        return sb.toString();
    }
    
}
