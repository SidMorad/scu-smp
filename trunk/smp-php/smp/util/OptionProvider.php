<?php
/**
 * Created at 12/07/2010 8:51:07 PM
 * filename
 *
 * @author <a href='mailto:smorad12@scu.edu.au'>Sid</a>
 * @version 1.0
 */
class smp_util_OptionProvider {
	
	static function getStaticOptionArray($arrayType) {
		switch ($arrayType) {
			case 'study_mode':
				return array('lismore'=>'On-campus - Lismore','coffs'=>'On-campus - Coffs Harbour','tweedGC'=>'On-campus - Tweed/Gold Coast','external'=>'Distance Study');
				break;
			case 'yes_no':
				return array('yes'=>'Yes', 'no'=>'No');
				break;	
		}
	}
}