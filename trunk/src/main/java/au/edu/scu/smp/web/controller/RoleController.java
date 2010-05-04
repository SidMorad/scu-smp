package au.edu.scu.smp.web.controller;

import org.springframework.roo.addon.web.mvc.controller.RooWebScaffold;
import au.edu.scu.smp.domain.Role;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.stereotype.Controller;

@RooWebScaffold(path = "role", automaticallyMaintainView = false, formBackingObject = Role.class)
@RequestMapping("/role/**")
@Controller
public class RoleController {
}
