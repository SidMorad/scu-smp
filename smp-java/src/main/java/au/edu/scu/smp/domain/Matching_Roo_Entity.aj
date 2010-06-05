package au.edu.scu.smp.domain;

import au.edu.scu.smp.domain.Matching;
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

privileged aspect Matching_Roo_Entity {
    
    @PersistenceContext
    transient EntityManager Matching.entityManager;
    
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    @Column(name = "id")
    private Long Matching.id;
    
    @Version
    @Column(name = "version")
    private Integer Matching.version;
    
    public Long Matching.getId() {
        return this.id;
    }
    
    public void Matching.setId(Long id) {
        this.id = id;
    }
    
    public Integer Matching.getVersion() {
        return this.version;
    }
    
    public void Matching.setVersion(Integer version) {
        this.version = version;
    }
    
    @Transactional
    public void Matching.persist() {
        if (this.entityManager == null) this.entityManager = entityManager();
        this.entityManager.persist(this);
    }
    
    @Transactional
    public void Matching.remove() {
        if (this.entityManager == null) this.entityManager = entityManager();
        if (this.entityManager.contains(this)) {
            this.entityManager.remove(this);
        } else {
            Matching attached = this.entityManager.find(Matching.class, this.id);
            this.entityManager.remove(attached);
        }
    }
    
    @Transactional
    public void Matching.flush() {
        if (this.entityManager == null) this.entityManager = entityManager();
        this.entityManager.flush();
    }
    
    @Transactional
    public void Matching.merge() {
        if (this.entityManager == null) this.entityManager = entityManager();
        Matching merged = this.entityManager.merge(this);
        this.entityManager.flush();
        this.id = merged.getId();
    }
    
    public static final EntityManager Matching.entityManager() {
        EntityManager em = new Matching().entityManager;
        if (em == null) throw new IllegalStateException("Entity manager has not been injected (is the Spring Aspects JAR configured as an AJC/AJDT aspects library?)");
        return em;
    }
    
    public static long Matching.countMatchings() {
        return (Long) entityManager().createQuery("select count(o) from Matching o").getSingleResult();
    }
    
    public static List<Matching> Matching.findAllMatchings() {
        return entityManager().createQuery("select o from Matching o").getResultList();
    }
    
    public static Matching Matching.findMatching(Long id) {
        if (id == null) return null;
        return entityManager().find(Matching.class, id);
    }
    
    public static List<Matching> Matching.findMatchingEntries(int firstResult, int maxResults) {
        return entityManager().createQuery("select o from Matching o").setFirstResult(firstResult).setMaxResults(maxResults).getResultList();
    }
    
}
