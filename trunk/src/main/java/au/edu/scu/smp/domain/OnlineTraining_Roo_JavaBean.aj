package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.Student;
import java.util.Date;

privileged aspect OnlineTraining_Roo_JavaBean {
    
    public Date OnlineTraining.getTrainingDate() {
        return this.trainingDate;
    }
    
    public void OnlineTraining.setTrainingDate(Date trainingDate) {
        this.trainingDate = trainingDate;
    }
    
    public Student OnlineTraining.getMentor() {
        return this.mentor;
    }
    
    public void OnlineTraining.setMentor(Student mentor) {
        this.mentor = mentor;
    }
    
}
