package au.edu.scu.smp.domain;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Transient;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

import org.springframework.roo.addon.entity.RooEntity;
import org.springframework.roo.addon.javabean.RooJavaBean;

@Entity
@RooJavaBean
@RooEntity(finders = { "findRolesByNameEquals" })
public class Role {

	private static final long serialVersionUID = 1L;

	@NotNull
	@Size(max = 30)
	@Column(length = 30, nullable = false, unique = true)
	private String name;

	@Transient
	public String getAuthority() {
		return name;
	}

	@Override
	public int hashCode() {
		return (name != null ? name.hashCode() : Integer.MIN_VALUE);
	}

	@Override
	public String toString() {
		return name;
	}
}
