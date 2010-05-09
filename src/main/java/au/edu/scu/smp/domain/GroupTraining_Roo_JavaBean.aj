package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.Student;
import java.lang.String;
import java.util.Date;
import java.util.Set;

privileged aspect GroupTraining_Roo_JavaBean {
    
    public Date GroupTraining.getTrainingDate() {
        return this.trainingDate;
    }
    
    public void GroupTraining.setTrainingDate(Date trainingDate) {
        this.trainingDate = trainingDate;
    }
    
    public String GroupTraining.getLocation() {
        return this.location;
    }
    
    public void GroupTraining.setLocation(String location) {
        this.location = location;
    }
    
    public String GroupTraining.getStatus() {
        return this.status;
    }
    
    public void GroupTraining.setStatus(String status) {
        this.status = status;
    }
    
    public Set<Student> GroupTraining.getMentors() {
        return this.mentors;
    }
    
    public void GroupTraining.setMentors(Set<Student> mentors) {
        this.mentors = mentors;
    }
    
}
