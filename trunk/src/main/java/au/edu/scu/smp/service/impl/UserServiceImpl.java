/*
 * Created at 04/05/2010 12:36:23 PM
*/
package au.edu.scu.smp.service.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.dao.DataAccessException;
import org.springframework.security.authentication.encoding.PasswordEncoder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;

import au.edu.scu.smp.domain.User;
import au.edu.scu.smp.service.UserService;

/**
 *
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Saeid Moradi</a>
 */
@Service
public class UserServiceImpl extends AbstractService implements UserService {

	@Autowired
	private PasswordEncoder passwordEncoder;
	
	@Override
	public User load(String username) {
		User user = (User) User.findUsersByUsernameEquals(username).getSingleResult();
		return user;
	}

	@Override
	public User save(User user) {
		user.setPassword(passwordEncoder.encodePassword(user.getPassword(), null));
		user.persist();
		return user;
	}
	
	@Override
	public void update(User user) {
		user.merge();		
	}

	@Override
	public UserDetails loadUserByUsername(String username) throws UsernameNotFoundException, DataAccessException {
		User user = load(username);
		if (null == user) {
			throw new UsernameNotFoundException("Username: [ " + username + " ] not found..");
		}
		return user;
	}

}
