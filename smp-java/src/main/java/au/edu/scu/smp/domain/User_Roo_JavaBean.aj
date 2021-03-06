package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.Role;
import java.lang.String;
import java.util.Set;

privileged aspect User_Roo_JavaBean {
    
    public void User.setUsername(String username) {
        this.username = username;
    }
    
    public void User.setPassword(String password) {
        this.password = password;
    }
    
    public String User.getEmail() {
        return this.email;
    }
    
    public void User.setEmail(String email) {
        this.email = email;
    }
    
    public Set<Role> User.getRoles() {
        return this.roles;
    }
    
    public void User.setRoles(Set<Role> roles) {
        this.roles = roles;
    }
    
    public void User.setEnabled(boolean enabled) {
        this.enabled = enabled;
    }
    
    public boolean User.isAccountExpired() {
        return this.accountExpired;
    }
    
    public void User.setAccountExpired(boolean accountExpired) {
        this.accountExpired = accountExpired;
    }
    
    public boolean User.isAccountLocked() {
        return this.accountLocked;
    }
    
    public void User.setAccountLocked(boolean accountLocked) {
        this.accountLocked = accountLocked;
    }
    
    public boolean User.isCredentialsExpired() {
        return this.credentialsExpired;
    }
    
    public void User.setCredentialsExpired(boolean credentialsExpired) {
        this.credentialsExpired = credentialsExpired;
    }
    
}
