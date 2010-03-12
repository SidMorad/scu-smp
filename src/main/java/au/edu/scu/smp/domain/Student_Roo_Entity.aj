package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.Student;
import java.lang.Integer;
import java.lang.Long;
import java.util.List;
import javax.persistence.Column;
import javax.persistence.EntityManager;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.PersistenceContext;
import javax.persistence.Version;
import org.springframework.transaction.annotation.Transactional;

privileged aspect Student_Roo_Entity {
    
    @PersistenceContext
    transient EntityManager Student.entityManager;
    
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    @Column(name = "id")
    private Long Student.id;
    
    @Version
    @Column(name = "version")
    private Integer Student.version;
    
    public Long Student.getId() {
        return this.id;
    }
    
    public void Student.setId(Long id) {
        this.id = id;
    }
    
    public Integer Student.getVersion() {
        return this.version;
    }
    
    public void Student.setVersion(Integer version) {
        this.version = version;
    }
    
    @Transactional
    public void Student.persist() {
        if (this.entityManager == null) this.entityManager = entityManager();
        this.entityManager.persist(this);
    }
    
    @Transactional
    public void Student.remove() {
        if (this.entityManager == null) this.entityManager = entityManager();
        if (this.entityManager.contains(this)) {
            this.entityManager.remove(this);
        } else {
            Student attached = this.entityManager.find(Student.class, this.id);
            this.entityManager.remove(attached);
        }
    }
    
    @Transactional
    public void Student.flush() {
        if (this.entityManager == null) this.entityManager = entityManager();
        this.entityManager.flush();
    }
    
    @Transactional
    public void Student.merge() {
        if (this.entityManager == null) this.entityManager = entityManager();
        Student merged = this.entityManager.merge(this);
        this.entityManager.flush();
        this.id = merged.getId();
    }
    
    public static final EntityManager Student.entityManager() {
        EntityManager em = new Student().entityManager;
        if (em == null) throw new IllegalStateException("Entity manager has not been injected (is the Spring Aspects JAR configured as an AJC/AJDT aspects library?)");
        return em;
    }
    
    public static long Student.countStudents() {
        return (Long) entityManager().createQuery("select count(o) from Student o").getSingleResult();
    }
    
    public static List<Student> Student.findAllStudents() {
        return entityManager().createQuery("select o from Student o").getResultList();
    }
    
    public static Student Student.findStudent(Long id) {
        if (id == null) return null;
        return entityManager().find(Student.class, id);
    }
    
    public static List<Student> Student.findStudentEntries(int firstResult, int maxResults) {
        return entityManager().createQuery("select o from Student o").setFirstResult(firstResult).setMaxResults(maxResults).getResultList();
    }
    
}
