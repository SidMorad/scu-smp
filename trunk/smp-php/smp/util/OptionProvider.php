<?php
/**
 * Created at 12/07/2010 8:51:07 PM
 * smp_util_OptionProvider
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
				$array['f'] = 'Female';
				$array['m'] = 'Male';
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
			case 'role':
				$array[Constants::ROLE_ADMIN] = Constants::ROLE_ADMIN;
				$array[Constants::ROLE_MANAGER] = Constants::ROLE_MANAGER;
				$array[Constants::ROLE_COORDINATOR] = Constants::ROLE_COORDINATOR;
				$array[Constants::ROLE_MENTOR] = Constants::ROLE_MENTOR;
				$array[Constants::ROLE_MENTEE] = Constants::ROLE_MENTEE;
				return $array;
				break;
			default:
				$array['notFound'] = 'Not Found!'; 
				return $array;
				break;						
		}
	}
	
	
	static function getDynamicArray($table, $firstRecordEmpty = false) {
		$array = ($firstRecordEmpty ? array(null => '----------') : array());
		switch($table) {
			case "course":
				require_once('smp/mapper/CourseMapper.php');
				$courseMapper = new smp_mapper_CourseMapper();
				return $courseMapper->getIdNameArray($array);
				break;

			case Constants::MESSAGE_MENTOR: 
				require_once('smp/service/MentorService.php');
				$mentorService = new smp_service_MentorService();
				return $mentorService->getCurrentMenteesEmailAddressArray();	
				break;
			case Constants::MESSAGE_MENTEE:
				require_once('smp/service/MenteeService.php');
				$menteeService = new smp_service_MenteeService();	
				return $menteeService->getCurrentMentorEmailAddressArray();
				break;
			case Constants::TABLE_CAMPUS: 	
				require_once('smp/mapper/CampusMapper.php');
				$campusMapper = new smp_mapper_CampusMapper();
				return $campusMapper->getIdNameArray($array);
				break;
		}
	}
}