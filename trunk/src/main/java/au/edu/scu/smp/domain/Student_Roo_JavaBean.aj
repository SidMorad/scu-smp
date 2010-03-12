package au.edu.scu.smp.domain;

import java.lang.String;

privileged aspect Student_Roo_JavaBean {
    
    public String Student.getEmail() {
        return this.email;
    }
    
    public void Student.setEmail(String email) {
        this.email = email;
    }
    
}
