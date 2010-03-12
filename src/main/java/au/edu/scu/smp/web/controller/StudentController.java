package au.edu.scu.smp.web.controller;

import org.springframework.roo.addon.web.mvc.controller.RooWebScaffold;
import au.edu.scu.smp.domain.Student;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.stereotype.Controller;

@RooWebScaffold(path = "student", automaticallyMaintainView = true, formBackingObject = Student.class)
@RequestMapping("/student/**")
@Controller
public class StudentController {
}
