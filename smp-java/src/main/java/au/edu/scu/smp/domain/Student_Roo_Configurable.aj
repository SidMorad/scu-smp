package au.edu.scu.smp.domain;

import org.springframework.beans.factory.annotation.Configurable;

privileged aspect Student_Roo_Configurable {
    
    declare @type: Student: @Configurable;
    
}
