package au.edu.scu.smp.web.controller;

import au.edu.scu.smp.domain.Student;
import java.lang.Long;
import java.lang.String;
import javax.validation.Valid;
import org.springframework.ui.ModelMap;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;

privileged aspect StudentController_Roo_Controller {
    
    @RequestMapping(value = "/student", method = RequestMethod.POST)
    public String StudentController.create(@Valid Student student, BindingResult result, ModelMap modelMap) {
        if (student == null) throw new IllegalArgumentException("A student is required");
        if (result.hasErrors()) {
            modelMap.addAttribute("student", student);
            return "student/create";
        }
        student.persist();
        return "redirect:/student/" + student.getId();
    }
    
    @RequestMapping(value = "/student/form", method = RequestMethod.GET)
    public String StudentController.createForm(ModelMap modelMap) {
        modelMap.addAttribute("student", new Student());
        return "student/create";
    }
    
    @RequestMapping(value = "/student/{id}", method = RequestMethod.GET)
    public String StudentController.show(@PathVariable("id") Long id, ModelMap modelMap) {
        if (id == null) throw new IllegalArgumentException("An Identifier is required");
        modelMap.addAttribute("student", Student.findStudent(id));
        return "student/show";
    }
    
    @RequestMapping(value = "/student", method = RequestMethod.GET)
    public String StudentController.list(@RequestParam(value = "page", required = false) Integer page, @RequestParam(value = "size", required = false) Integer size, ModelMap modelMap) {
        if (page != null || size != null) {
            int sizeNo = size == null ? 10 : size.intValue();
            modelMap.addAttribute("students", Student.findStudentEntries(page == null ? 0 : (page.intValue() - 1) * sizeNo, sizeNo));
            float nrOfPages = (float) Student.countStudents() / sizeNo;
            modelMap.addAttribute("maxPages", (int) ((nrOfPages > (int) nrOfPages || nrOfPages == 0.0) ? nrOfPages + 1 : nrOfPages));
        } else {
            modelMap.addAttribute("students", Student.findAllStudents());
        }
        return "student/list";
    }
    
    @RequestMapping(method = RequestMethod.PUT)
    public String StudentController.update(@Valid Student student, BindingResult result, ModelMap modelMap) {
        if (student == null) throw new IllegalArgumentException("A student is required");
        if (result.hasErrors()) {
            modelMap.addAttribute("student", student);
            return "student/update";
        }
        student.merge();
        return "redirect:/student/" + student.getId();
    }
    
    @RequestMapping(value = "/student/{id}/form", method = RequestMethod.GET)
    public String StudentController.updateForm(@PathVariable("id") Long id, ModelMap modelMap) {
        if (id == null) throw new IllegalArgumentException("An Identifier is required");
        modelMap.addAttribute("student", Student.findStudent(id));
        return "student/update";
    }
    
    @RequestMapping(value = "/student/{id}", method = RequestMethod.DELETE)
    public String StudentController.delete(@PathVariable("id") Long id, @RequestParam(value = "page", required = false) Integer page, @RequestParam(value = "size", required = false) Integer size) {
        if (id == null) throw new IllegalArgumentException("An Identifier is required");
        Student.findStudent(id).remove();
        return "redirect:/student?page=" + ((page == null) ? "1" : page.toString()) + "&size=" + ((size == null) ? "10" : size.toString());
    }
    
}
