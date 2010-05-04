package au.edu.scu.smp.domain;

import java.lang.String;

privileged aspect Matching_Roo_ToString {
    
    public String Matching.toString() {
        StringBuilder sb = new StringBuilder();
        sb.append("Id: ").append(getId()).append(", ");
        sb.append("Version: ").append(getVersion()).append(", ");
        sb.append("GenderPrefer: ").append(getGenderPrefer()).append(", ");
        sb.append("WorkStatus: ").append(getWorkStatus()).append(", ");
        sb.append("FamilyResponsibilities: ").append(getFamilyResponsibilities()).append(", ");
        sb.append("TertiaryStudies: ").append(getTertiaryStudies()).append(", ");
        sb.append("Interests: ").append(getInterests()).append(", ");
        sb.append("Comments: ").append(getComments()).append(", ");
        sb.append("PreferOnCampus: ").append(getPreferOnCampus()).append(", ");
        sb.append("PreferDistance: ").append(getPreferDistance()).append(", ");
        sb.append("PreferAustralian: ").append(getPreferAustralian()).append(", ");
        sb.append("PreferInternational: ").append(getPreferInternational()).append(", ");
        sb.append("IsRegional: ").append(getIsRegional()).append(", ");
        sb.append("IsDisability: ").append(getIsDisability()).append(", ");
        sb.append("IsSocioeconomic: ").append(getIsSocioeconomic()).append(", ");
        sb.append("IsNonEnglish: ").append(getIsNonEnglish()).append(", ");
        sb.append("IsIndigenous: ").append(getIsIndigenous()).append(", ");
        sb.append("Student: ").append(getStudent());
        return sb.toString();
    }
    
}
