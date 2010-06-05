package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.GroupTraining;
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

privileged aspect GroupTraining_Roo_Entity {
    
    @PersistenceContext
    transient EntityManager GroupTraining.entityManager;
    
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    @Column(name = "id")
    private Long GroupTraining.id;
    
    @Version
    @Column(name = "version")
    private Integer GroupTraining.version;
    
    public Long GroupTraining.getId() {
        return this.id;
    }
    
    public void GroupTraining.setId(Long id) {
        this.id = id;
    }
    
    public Integer GroupTraining.getVersion() {
        return this.version;
    }
    
    public void GroupTraining.setVersion(Integer version) {
        this.version = version;
    }
    
    @Transactional
    public void GroupTraining.persist() {
        if (this.entityManager == null) this.entityManager = entityManager();
        this.entityManager.persist(this);
    }
    
    @Transactional
    public void GroupTraining.remove() {
        if (this.entityManager == null) this.entityManager = entityManager();
        if (this.entityManager.contains(this)) {
            this.entityManager.remove(this);
        } else {
            GroupTraining attached = this.entityManager.find(GroupTraining.class, this.id);
            this.entityManager.remove(attached);
        }
    }
    
    @Transactional
    public void GroupTraining.flush() {
        if (this.entityManager == null) this.entityManager = entityManager();
        this.entityManager.flush();
    }
    
    @Transactional
    public void GroupTraining.merge() {
        if (this.entityManager == null) this.entityManager = entityManager();
        GroupTraining merged = this.entityManager.merge(this);
        this.entityManager.flush();
        this.id = merged.getId();
    }
    
    public static final EntityManager GroupTraining.entityManager() {
        EntityManager em = new GroupTraining().entityManager;
        if (em == null) throw new IllegalStateException("Entity manager has not been injected (is the Spring Aspects JAR configured as an AJC/AJDT aspects library?)");
        return em;
    }
    
    public static long GroupTraining.countGroupTrainings() {
        return (Long) entityManager().createQuery("select count(o) from GroupTraining o").getSingleResult();
    }
    
    public static List<GroupTraining> GroupTraining.findAllGroupTrainings() {
        return entityManager().createQuery("select o from GroupTraining o").getResultList();
    }
    
    public static GroupTraining GroupTraining.findGroupTraining(Long id) {
        if (id == null) return null;
        return entityManager().find(GroupTraining.class, id);
    }
    
    public static List<GroupTraining> GroupTraining.findGroupTrainingEntries(int firstResult, int maxResults) {
        return entityManager().createQuery("select o from GroupTraining o").setFirstResult(firstResult).setMaxResults(maxResults).getResultList();
    }
    
}
