package au.edu.scu.smp.domain;

import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.JoinColumn;
import javax.persistence.OneToOne;
import javax.validation.constraints.Max;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

import org.springframework.roo.addon.entity.RooEntity;
import org.springframework.roo.addon.javabean.RooJavaBean;
import org.springframework.roo.addon.tostring.RooToString;

import au.edu.scu.smp.domain.enums.AgeRange;
import au.edu.scu.smp.domain.enums.Gender;
import au.edu.scu.smp.domain.enums.StudentType;
import au.edu.scu.smp.domain.enums.StudyMode;

@Entity
@RooJavaBean
@RooToString
@RooEntity
public class Student {

	@NotNull
	private String firstname;

	@NotNull
	private String lastname;

	@NotNull
	@Enumerated(EnumType.STRING)
	private Gender gender;

	@NotNull
	@Enumerated(EnumType.STRING)
	private AgeRange ageRange;

	@NotNull
	@Size(min = 8, max = 8)
	private Integer studentNumber;

	@Enumerated(EnumType.STRING)
	private StudentType studentType;

	@NotNull
	@Enumerated(EnumType.STRING)
	private StudyMode studyMode;

	@NotNull
	private String course;

	private String major;

	private Boolean firstYearComplete;

	private String recommendedByStaff;

	@NotNull
	@Size(min = 1, max = 1)
	@Min(1)
	@Max(10)
	private Integer semestersCompeleted;

	private Boolean international;

	private Boolean trained;

	private Boolean myscuActivated;

	@OneToOne(targetEntity = User.class)
	@JoinColumn(name = "user_id")
	private User user;

	@OneToOne(targetEntity = Matching.class)
	@JoinColumn(name = "matching_id", unique = true)
	private Matching matching;
	
	@OneToOne(targetEntity = Contact.class)
	@JoinColumn(name = "contact_id")
	private Contact contact;

}