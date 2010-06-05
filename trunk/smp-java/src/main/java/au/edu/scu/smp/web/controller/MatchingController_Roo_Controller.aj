package au.edu.scu.smp.web.controller;

import au.edu.scu.smp.domain.Matching;
import au.edu.scu.smp.domain.Student;
import au.edu.scu.smp.domain.enums.GenderPrefer;
import au.edu.scu.smp.domain.enums.WorkStatus;
import java.lang.Long;
import java.lang.String;
import javax.validation.Valid;
import org.springframework.ui.ModelMap;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;

privileged aspect MatchingController_Roo_Controller {
    
    @RequestMapping(value = "/matching", method = RequestMethod.POST)
    public String MatchingController.create(@Valid Matching matching, BindingResult result, ModelMap modelMap) {
        if (matching == null) throw new IllegalArgumentException("A matching is required");
        if (result.hasErrors()) {
            modelMap.addAttribute("matching", matching);
            modelMap.addAttribute("students", Student.findAllStudents());
            modelMap.addAttribute("genderprefer_enum", GenderPrefer.class.getEnumConstants());
            modelMap.addAttribute("workstatus_enum", WorkStatus.class.getEnumConstants());
            return "matching/create";
        }
        matching.persist();
        return "redirect:/matching/" + matching.getId();
    }
    
    @RequestMapping(value = "/matching/form", method = RequestMethod.GET)
    public String MatchingController.createForm(ModelMap modelMap) {
        modelMap.addAttribute("matching", new Matching());
        modelMap.addAttribute("students", Student.findAllStudents());
        modelMap.addAttribute("genderprefer_enum", GenderPrefer.class.getEnumConstants());
        modelMap.addAttribute("workstatus_enum", WorkStatus.class.getEnumConstants());
        return "matching/create";
    }
    
    @RequestMapping(value = "/matching/{id}", method = RequestMethod.GET)
    public String MatchingController.show(@PathVariable("id") Long id, ModelMap modelMap) {
        if (id == null) throw new IllegalArgumentException("An Identifier is required");
        modelMap.addAttribute("matching", Matching.findMatching(id));
        return "matching/show";
    }
    
    @RequestMapping(value = "/matching", method = RequestMethod.GET)
    public String MatchingController.list(@RequestParam(value = "page", required = false) Integer page, @RequestParam(value = "size", required = false) Integer size, ModelMap modelMap) {
        if (page != null || size != null) {
            int sizeNo = size == null ? 10 : size.intValue();
            modelMap.addAttribute("matchings", Matching.findMatchingEntries(page == null ? 0 : (page.intValue() - 1) * sizeNo, sizeNo));
            float nrOfPages = (float) Matching.countMatchings() / sizeNo;
            modelMap.addAttribute("maxPages", (int) ((nrOfPages > (int) nrOfPages || nrOfPages == 0.0) ? nrOfPages + 1 : nrOfPages));
        } else {
            modelMap.addAttribute("matchings", Matching.findAllMatchings());
        }
        return "matching/list";
    }
    
    @RequestMapping(method = RequestMethod.PUT)
    public String MatchingController.update(@Valid Matching matching, BindingResult result, ModelMap modelMap) {
        if (matching == null) throw new IllegalArgumentException("A matching is required");
        if (result.hasErrors()) {
            modelMap.addAttribute("matching", matching);
            modelMap.addAttribute("students", Student.findAllStudents());
            modelMap.addAttribute("genderprefer_enum", GenderPrefer.class.getEnumConstants());
            modelMap.addAttribute("workstatus_enum", WorkStatus.class.getEnumConstants());
            return "matching/update";
        }
        matching.merge();
        return "redirect:/matching/" + matching.getId();
    }
    
    @RequestMapping(value = "/matching/{id}/form", method = RequestMethod.GET)
    public String MatchingController.updateForm(@PathVariable("id") Long id, ModelMap modelMap) {
        if (id == null) throw new IllegalArgumentException("An Identifier is required");
        modelMap.addAttribute("matching", Matching.findMatching(id));
        modelMap.addAttribute("students", Student.findAllStudents());
        modelMap.addAttribute("genderprefer_enum", GenderPrefer.class.getEnumConstants());
        modelMap.addAttribute("workstatus_enum", WorkStatus.class.getEnumConstants());
        return "matching/update";
    }
    
    @RequestMapping(value = "/matching/{id}", method = RequestMethod.DELETE)
    public String MatchingController.delete(@PathVariable("id") Long id, @RequestParam(value = "page", required = false) Integer page, @RequestParam(value = "size", required = false) Integer size) {
        if (id == null) throw new IllegalArgumentException("An Identifier is required");
        Matching.findMatching(id).remove();
        return "redirect:/matching?page=" + ((page == null) ? "1" : page.toString()) + "&size=" + ((size == null) ? "10" : size.toString());
    }
    
}
