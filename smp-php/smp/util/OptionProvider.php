<?php
/**
 * Created at 12/07/2010 8:51:07 PM
 * filename
 *
 * @author <a href='mailto:smorad12@scu.edu.au'>Sid</a>
 * @version 1.0
 */
class smp_util_OptionProvider {
	
	static function getFixArray($type, $firstRecordEmpty = false) {
		$array = ($firstRecordEmpty ? array(null => '----------') : array());
		switch ($type) {
			case 'study_mode':
				$array['lismore'] = 'On-campus - Lismore';
				$array['coffs'] = 'On-campus - Coffs Harbour'; 
				$array['tweed'] = 'On-campus - Tweed/Gold Coast'; 
				$array['external'] = 'Distance Study'; 
				return $array;
				break;
			case 'yes_no':
				$array['yes'] = 'Yes';
				$array['no'] = 'No';
				return $array;
				break;
			case 'age_range':
				$array['under25'] = 'Under 25';
				$array['25to30'] = '25 to 30';
				$array['30to40'] = '30 to 40';
				$array['over40'] = 'Over 40';
				return $array;
				break;
			case 'gender':
				$array['female'] = 'Female';
				$array['male'] = 'Male';
				return $array;
				break;			
			case 'gender_prefer':
				$array['doNotCare'] = 'Do not care';
				$array['yes'] = 'Yes';
				$array['no'] = 'No';
				return $array;
				break;
			case 'work_status':
				$array['fulltime'] = 'Full-time';
				$array['parttime'] = 'Part-time';
				$array['casual'] = 'Casual';
				$array['nowork'] = 'Do not work';
				return $array;
				break;
			case 'account_status':
				$array[Constants::AS_NEW_MENTOR] = 'New Mentor'; 
				$array[Constants::AS_NEW_MENTEE] = 'New Mentee';
				$array[Constants::AS_MATCHED_MENTOR] = 'Matched Mentor';
				$array[Constants::AS_MATCHED_MENTEE] = 'Matched Mentee';
				$array[Constants::AS_TRAINED_MENTOR] = 'Trained Mentor';
				$array[Constants::AS_EXPIRED_MENTOR] = 'Expired Mentor';
				$array[Constants::AS_EXPIRED_MENTEE] = 'Expired Mentee';      
				return $array;
				break;
			case Constants::MESSAGE_MENTOR:
				$array[Constants::MS_FOR_MENTEE] = 'my Mentee';
				$array[Constants::MS_FOR_COORDINATOR] = 'my Coordinator';  
				return $array;
				break;
			default:
				$array['notFound'] = 'Not Found!'; 
				return $array;
				break;						
		}
	}
}