package au.edu.scu.smp.domain;

import org.springframework.beans.factory.annotation.Configurable;

privileged aspect Role_Roo_Configurable {
    
    declare @type: Role: @Configurable;
    
}
