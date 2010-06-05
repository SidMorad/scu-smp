package au.edu.scu.smp.domain;

import javax.persistence.Entity;
import javax.persistence.EnumType;
import javax.persistence.Enumerated;
import javax.persistence.JoinColumn;
import javax.persistence.OneToOne;
import javax.validation.constraints.NotNull;

import org.springframework.roo.addon.entity.RooEntity;
import org.springframework.roo.addon.javabean.RooJavaBean;
import org.springframework.roo.addon.tostring.RooToString;

import au.edu.scu.smp.domain.enums.GenderPrefer;
import au.edu.scu.smp.domain.enums.WorkStatus;

@Entity
@RooJavaBean
@RooToString
@RooEntity
public class Matching {

	@NotNull
	@Enumerated(EnumType.STRING)
	private GenderPrefer genderPrefer;

	@NotNull
	@Enumerated(EnumType.STRING)
	private WorkStatus workStatus;

	private Boolean familyResponsibilities;

	private Boolean tertiaryStudies;

	private String interests;

	private String comments;

	private Boolean preferOnCampus;

	private Boolean preferDistance;

	private Boolean preferAustralian;

	private Boolean preferInternational;

	private Boolean isRegional;

	private Boolean isDisability;

	private Boolean isSocioeconomic;

	private Boolean isNonEnglish;

	private Boolean isIndigenous;

	@OneToOne(targetEntity = Student.class)
	@JoinColumn(name = "student_id", unique = true)
	private Student student;
}
