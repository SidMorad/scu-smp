/*
 * Created at 04/05/2010 5:45:37 PM
*/
package au.edu.scu.smp.web.formbeans;

import au.edu.scu.smp.domain.Contact;
import au.edu.scu.smp.domain.Matching;
import au.edu.scu.smp.domain.Student;
import au.edu.scu.smp.domain.User;

/**
 *
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Saeid Moradi</a>
 */
public class NewMentorFormBean {
	
	private User user;
	private Student student;
	private Matching matching;
	private Contact contact;

	public NewMentorFormBean() {
//		this.user = new User();
//		this.student = new Student();
//		this.matching = new Matching();
//		this.contact = new Contact();
	}

	public NewMentorFormBean(User user,Student student, Contact contact, Matching matching) {
		this.user = user;
		this.student = student;
		this.contact = contact;
		this.matching = matching;
	}
	
	public User getUser() {
		return user;
	}

	public void setUser(User user) {
		this.user = user;
	}

	public Student getStudent() {
		return student;
	}

	public void setStudent(Student student) {
		this.student = student;
	}

	public Matching getMatching() {
		return matching;
	}

	public void setMatching(Matching matching) {
		this.matching = matching;
	}

	public Contact getContact() {
		return contact;
	}

	public void setContact(Contact contact) {
		this.contact = contact;
	}
}
