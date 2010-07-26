<?php
/**
 * Created at 12/07/2010 8:51:07 PM
 * filename
 *
 * @author <a href='mailto:smorad12@scu.edu.au'>Sid</a>
 * @version 1.0
 */
class smp_util_OptionProvider {
	
	static function getFixArray($type) {
		switch ($type) {
			case 'study_mode':
				return array('lismore'=>'On-campus - Lismore','coffs'=>'On-campus - Coffs Harbour','tweedGC'=>'On-campus - Tweed/Gold Coast','external'=>'Distance Study');
				break;
			case 'yes_no':
				return array('yes'=>'Yes', 'no'=>'No');
				break;
			case 'age_range':
				return array('under25'=>'Under 25','25to30'=>'25 to 30','30to40'=>'30 to 40','over40'=>'Over 40');
				break;
			case 'gender':
				return array('female'=>'Female','male'=>'Male');
				break;			
			case 'gender_prefer':
				return array('doNotCare'=>'Do not care','yes'=>'Yes', 'no'=>'No');
				break;
			case 'work_status':
				return array('fulltime'=>'Full-time','parttime'=>'Part-time','casual'=>'Casual','nowork'=>'Do not work');
				break;
			case 'account_status':
				return array(Constants::AS_NEW_MENTOR=>'New Mentor', Constants::AS_NEW_MENTEE=>'New Mentee', Constants::AS_MATCHED_MENTOR=>'Matched Mentor', Constants::AS_MATCHED_MENTEE=>'Matched Mentee', Constants::AS_TRAINED_MENTOR=>'Trained Mentor', Constants::AS_EXPIRED_MENTOR=>'Expired Mentor', Constants::AS_EXPIRED_MENTEE=>'Expired Mentee');
				break;
			default:
				return array('notFound'=>'Not Found!');
				break;						
		}
	}
}