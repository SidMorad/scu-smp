/*
 * Created at 04/05/2010 12:34:14 PM
 */
package au.edu.scu.smp.service;

import org.springframework.security.core.userdetails.UserDetailsService;

import au.edu.scu.smp.domain.User;

/**
 * 
 * 
 * @author <a href="mailto:smorad12@scu.edu.au">Saeid Moradi</a>
 */
public interface UserService extends UserDetailsService {

	/**
	 * @param username
	 * @return
	 */
	User load(String username);

	/**
	 * @param user
	 */
	User save(User user);

	/**
	 * @param user
	 */
	void update(User user);
}
