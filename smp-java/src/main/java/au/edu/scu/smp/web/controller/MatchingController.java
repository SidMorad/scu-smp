package au.edu.scu.smp.web.controller;

import org.springframework.roo.addon.web.mvc.controller.RooWebScaffold;
import au.edu.scu.smp.domain.Matching;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.stereotype.Controller;

@RooWebScaffold(path = "matching", automaticallyMaintainView = true, formBackingObject = Matching.class)
@RequestMapping("/matching/**")
@Controller
public class MatchingController {
}
