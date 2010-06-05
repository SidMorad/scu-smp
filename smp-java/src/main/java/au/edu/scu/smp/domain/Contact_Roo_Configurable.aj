package au.edu.scu.smp.domain;

import org.springframework.beans.factory.annotation.Configurable;

privileged aspect Contact_Roo_Configurable {
    
    declare @type: Contact: @Configurable;
    
}
