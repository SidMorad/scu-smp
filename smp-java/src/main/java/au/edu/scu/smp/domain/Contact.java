package au.edu.scu.smp.domain;

import javax.persistence.Entity;
import javax.persistence.JoinColumn;
import javax.persistence.OneToOne;
import javax.validation.constraints.NotNull;

import org.springframework.roo.addon.entity.RooEntity;
import org.springframework.roo.addon.javabean.RooJavaBean;
import org.springframework.roo.addon.tostring.RooToString;

@Entity
@RooJavaBean
@RooToString
@RooEntity
public class Contact {

    @NotNull
    private String address;

    @NotNull
    private String city;

    @NotNull
    private String postcode;

    private String phoneHome;

    private String phoneWork;

    private String mobile;

    private String email;
 
    @OneToOne(targetEntity = Student.class)
    @JoinColumn(name = "student_id")
    private Student student;
    
}
