package au.edu.scu.smp.domain;

import java.lang.String;

privileged aspect Student_Roo_ToString {
    
    public String Student.toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Id: ").append(getId()).append(", ");
        sb.append("Version: ").append(getVersion()).append(", ");
        sb.append("Email: ").append(getEmail());
        return sb.toString();
    }
    
}
