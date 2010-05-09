package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.OnlineTraining;
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

privileged aspect OnlineTraining_Roo_Entity {
    
    @PersistenceContext
    transient EntityManager OnlineTraining.entityManager;
    
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    @Column(name = "id")
    private Long OnlineTraining.id;
    
    @Version
    @Column(name = "version")
    private Integer OnlineTraining.version;
    
    public Long OnlineTraining.getId() {
        return this.id;
    }
    
    public void OnlineTraining.setId(Long id) {
        this.id = id;
    }
    
    public Integer OnlineTraining.getVersion() {
        return this.version;
    }
    
    public void OnlineTraining.setVersion(Integer version) {
        this.version = version;
    }
    
    @Transactional
    public void OnlineTraining.persist() {
        if (this.entityManager == null) this.entityManager = entityManager();
        this.entityManager.persist(this);
    }
    
    @Transactional
    public void OnlineTraining.remove() {
        if (this.entityManager == null) this.entityManager = entityManager();
        if (this.entityManager.contains(this)) {
            this.entityManager.remove(this);
        } else {
            OnlineTraining attached = this.entityManager.find(OnlineTraining.class, this.id);
            this.entityManager.remove(attached);
        }
    }
    
    @Transactional
    public void OnlineTraining.flush() {
        if (this.entityManager == null) this.entityManager = entityManager();
        this.entityManager.flush();
    }
    
    @Transactional
    public void OnlineTraining.merge() {
        if (this.entityManager == null) this.entityManager = entityManager();
        OnlineTraining merged = this.entityManager.merge(this);
        this.entityManager.flush();
        this.id = merged.getId();
    }
    
    public static final EntityManager OnlineTraining.entityManager() {
        EntityManager em = new OnlineTraining().entityManager;
        if (em == null) throw new IllegalStateException("Entity manager has not been injected (is the Spring Aspects JAR configured as an AJC/AJDT aspects library?)");
        return em;
    }
    
    public static long OnlineTraining.countOnlineTrainings() {
        return (Long) entityManager().createQuery("select count(o) from OnlineTraining o").getSingleResult();
    }
    
    public static List<OnlineTraining> OnlineTraining.findAllOnlineTrainings() {
        return entityManager().createQuery("select o from OnlineTraining o").getResultList();
    }
    
    public static OnlineTraining OnlineTraining.findOnlineTraining(Long id) {
        if (id == null) return null;
        return entityManager().find(OnlineTraining.class, id);
    }
    
    public static List<OnlineTraining> OnlineTraining.findOnlineTrainingEntries(int firstResult, int maxResults) {
        return entityManager().createQuery("select o from OnlineTraining o").setFirstResult(firstResult).setMaxResults(maxResults).getResultList();
    }
    
}
