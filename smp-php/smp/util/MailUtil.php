<?php
/**
 * Created at 09/08/2010 9:44:56 AM
 * smp_util_MailUtil
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/Mail.php');
require_once('Mail.php');
class smp_util_MailUtil {
	
	function sendEmail(smp_bean_Mail $mail) {
		$params['host'] = 'localhost'; 	// default value is localhost
		$params['port'] = 25;			// default value is 25
		$factory =& Mail::factory('smtp', $params);
		
		$headers['From'] = $mail->getFrom();
		$headers['To'] = $mail->getTo();
		$headers['Subject'] = $mail->getSubject();
		$send = $factory->send($mail->getRecipients(), $headers, $mail->getBody());
		if (PEAR::isError($send)) {
			return $send->getMessage();
		}
		return true;
	}
	
}