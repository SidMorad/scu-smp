package au.edu.scu.smp.web.controller;

import org.springframework.roo.addon.web.mvc.controller.RooWebScaffold;
import au.edu.scu.smp.domain.Contact;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.stereotype.Controller;

@RooWebScaffold(path = "contact", automaticallyMaintainView = false, formBackingObject = Contact.class)
@RequestMapping("/contact/**")
@Controller
public class ContactController {
}
