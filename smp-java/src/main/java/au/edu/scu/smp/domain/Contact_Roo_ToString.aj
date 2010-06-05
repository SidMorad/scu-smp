package au.edu.scu.smp.domain;

import java.lang.String;

privileged aspect Contact_Roo_ToString {
    
    public String Contact.toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Id: ").append(getId()).append(", ");
        sb.append("Version: ").append(getVersion()).append(", ");
        sb.append("Address: ").append(getAddress()).append(", ");
        sb.append("City: ").append(getCity()).append(", ");
        sb.append("Postcode: ").append(getPostcode()).append(", ");
        sb.append("PhoneHome: ").append(getPhoneHome()).append(", ");
        sb.append("PhoneWork: ").append(getPhoneWork()).append(", ");
        sb.append("Mobile: ").append(getMobile()).append(", ");
        sb.append("Email: ").append(getEmail()).append(", ");
        sb.append("Student: ").append(getStudent());
        return sb.toString();
    }
    
}
