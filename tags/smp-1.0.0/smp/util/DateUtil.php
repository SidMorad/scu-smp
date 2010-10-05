<?php
/**
 * Created at 29/08/2010 5:39:57 PM
 * smp_util_DateUtil
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_util_DateUtil {

	static function mysqlDate($phpDate, $pattern = 'Y-m-d H:i:s') {
		return date($pattern, $phpDate);
	}

	static function phpDate($mysqlDate) {
		return strtotime($mysqlDate);
	}

	static function dayDiff($startDate, $endDate) {
	
		$diff = abs(strtotime($startDate) - strtotime($endDate));
	
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		if ($years == 0 && $months == 0) {
			return "$days days\n";
		} else if ($years == 0) {
			return "$months months, $days days\n";
		} else {
			return "$years years, $months months, $days days\n";
		}
	}
	
	static function DayDiffUntilToday($startDate) {
		return self::dayDiff($startDate, self::mysqlDate(time()));
	}

}