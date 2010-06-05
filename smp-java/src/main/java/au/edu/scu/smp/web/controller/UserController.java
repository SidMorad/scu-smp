package au.edu.scu.smp.web.controller;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.roo.addon.web.mvc.controller.RooWebScaffold;
import org.springframework.stereotype.Controller;
import org.springframework.ui.ModelMap;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import au.edu.scu.smp.domain.Role;
import au.edu.scu.smp.domain.User;
import au.edu.scu.smp.service.UserService;

@RooWebScaffold(path = "user", automaticallyMaintainView = false, formBackingObject = User.class)
@RequestMapping("/user/**")
@Controller
public class UserController {
	
	@Autowired
	protected UserService userService;
	
    @RequestMapping(value = "/user", method = RequestMethod.POST)
    public String create(@Valid User user, BindingResult result, ModelMap modelMap) {
        if (user == null) throw new IllegalArgumentException("A user is required");
        if (result.hasErrors()) {
            modelMap.addAttribute("user", user);
            modelMap.addAttribute("roles", Role.findAllRoles());
            return "user/create";
        }
        user = userService.save(user);
        return "redirect:/user/" + user.getId();
    }

    @RequestMapping(method = RequestMethod.PUT)
    public String update(@Valid User user, BindingResult result, ModelMap modelMap) {
        if (user == null) throw new IllegalArgumentException("A user is required");
        User oldUser = (User) User.findUsersByUsernameEquals(user.getUsername()).getSingleResult();
        user.setPassword(oldUser.getPassword());
        if (result.hasErrors()) {
            modelMap.addAttribute("user", user);
            modelMap.addAttribute("roles", Role.findAllRoles());
            return "user/update";
        }
        userService.update(user);
        return "redirect:/user/" + user.getId();
    }
    
}
