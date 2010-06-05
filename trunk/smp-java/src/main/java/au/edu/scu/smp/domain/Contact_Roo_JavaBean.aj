package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.Student;
import java.lang.String;

privileged aspect Contact_Roo_JavaBean {
    
    public String Contact.getAddress() {
        return this.address;
    }
    
    public void Contact.setAddress(String address) {
        this.address = address;
    }
    
    public String Contact.getCity() {
        return this.city;
    }
    
    public void Contact.setCity(String city) {
        this.city = city;
    }
    
    public String Contact.getPostcode() {
        return this.postcode;
    }
    
    public void Contact.setPostcode(String postcode) {
        this.postcode = postcode;
    }
    
    public String Contact.getPhoneHome() {
        return this.phoneHome;
    }
    
    public void Contact.setPhoneHome(String phoneHome) {
        this.phoneHome = phoneHome;
    }
    
    public String Contact.getPhoneWork() {
        return this.phoneWork;
    }
    
    public void Contact.setPhoneWork(String phoneWork) {
        this.phoneWork = phoneWork;
    }
    
    public String Contact.getMobile() {
        return this.mobile;
    }
    
    public void Contact.setMobile(String mobile) {
        this.mobile = mobile;
    }
    
    public String Contact.getEmail() {
        return this.email;
    }
    
    public void Contact.setEmail(String email) {
        this.email = email;
    }
    
    public Student Contact.getStudent() {
        return this.student;
    }
    
    public void Contact.setStudent(Student student) {
        this.student = student;
    }
    
}
