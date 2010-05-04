/*
 * Created at 04/05/2010 5:55:28 PM
*/
package au.edu.scu.smp.web.controller;

import java.util.HashSet;
import java.util.Set;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import au.edu.scu.smp.Constants;
import au.edu.scu.smp.domain.Contact;
import au.edu.scu.smp.domain.Matching;
import au.edu.scu.smp.domain.Role;
import au.edu.scu.smp.domain.Student;
import au.edu.scu.smp.domain.User;
import au.edu.scu.smp.domain.enums.AgeRange;
import au.edu.scu.smp.domain.enums.Gender;
import au.edu.scu.smp.domain.enums.GenderPrefer;
import au.edu.scu.smp.domain.enums.StudentType;
import au.edu.scu.smp.domain.enums.StudyMode;
import au.edu.scu.smp.domain.enums.WorkStatus;
import au.edu.scu.smp.service.UserService;
import au.edu.scu.smp.web.formbeans.NewMentorFormBean;

/**
 *
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Saeid Moradi</a>
 */
@RequestMapping("/coordinator/**")
@Controller
public class CoordinatorController {
	
	@Autowired
	protected UserService userService;
	
	@RequestMapping(value = "/coordinator/mentor/form", method = RequestMethod.GET)
	public String createMentorForm(ModelMap modelMap) {
		modelMap.addAttribute("newMentorFormBean", new NewMentorFormBean());
        modelMap.addAttribute("agerange_enum", AgeRange.class.getEnumConstants());
        modelMap.addAttribute("gender_enum", Gender.class.getEnumConstants());
        modelMap.addAttribute("studenttype_enum", StudentType.class.getEnumConstants());
        modelMap.addAttribute("studymode_enum", StudyMode.class.getEnumConstants());
        modelMap.addAttribute("genderprefer_enum", GenderPrefer.class.getEnumConstants());
        modelMap.addAttribute("workstatus_enum", WorkStatus.class.getEnumConstants());
		return "coordinator/newMentor";
	}
	
	@RequestMapping(value = "/coordinator/mentor", method = RequestMethod.POST)
	public String createMentor(@Valid NewMentorFormBean newMentorFormBean, BindingResult result, ModelMap modelMap) {
        if (result.hasErrors()) {
        	modelMap.addAttribute("newMentorFormBean", newMentorFormBean);
        	modelMap.addAttribute("agerange_enum", AgeRange.class.getEnumConstants());
        	modelMap.addAttribute("gender_enum", Gender.class.getEnumConstants());
        	modelMap.addAttribute("studenttype_enum", StudentType.class.getEnumConstants());
        	modelMap.addAttribute("studymode_enum", StudyMode.class.getEnumConstants());
        	modelMap.addAttribute("genderprefer_enum", GenderPrefer.class.getEnumConstants());
        	modelMap.addAttribute("workstatus_enum", WorkStatus.class.getEnumConstants());
        	return "coordinator/newMentor";
        }
		// Persist User
        User user = newMentorFormBean.getUser();
		user.addRole((Role)Role.findRolesByNameEquals(Constants.ROLE_MENTOR).getSingleResult());
		user = userService.save(user);
		// Persist Student
		Student student = newMentorFormBean.getStudent();
		student.setUser(user);
		student.persist();
		// Persist Contact
		Contact contact = newMentorFormBean.getContact();
		contact.setStudent(student);
		contact.persist();
		// Persist Matching
		Matching matching = newMentorFormBean.getMatching();
		matching.setStudent(student);
		matching.persist();
		
		// Update Student 
		student.setMatching(matching);
		student.setContact(contact);
		student.merge();
		return "redirect:/coordinator/mentor/" + student.getId();
	}
	
	@RequestMapping(value = "/coordinator/mentor/{id}")
	public String showMentor(@PathVariable("id") Long id, ModelMap modelMap) {
		if (id == null) throw new IllegalArgumentException("An Identifier is required");		
		Student student = Student.findStudent(id);
		NewMentorFormBean newMentorFormBean = new NewMentorFormBean(student.getUser(),student,student.getContact(),student.getMatching());
		modelMap.addAttribute("newMentorFormBean",newMentorFormBean);
		return "coordinator/showMentor";
	}
}
