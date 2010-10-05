<?php
/**
 * Created at 27/08/2010 2:10:43 PM
 * smp_controller_SessionHelper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/SessionRegistry.php');
class smp_controller_SessionHelper {
	private static $instance;
	
	private function __construct() {}
	
	static function instance() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	function init() {
		$this->checkSessionForDestroyAndUnset();
		$this->checkSessionForReGenerateId();
	}
	
	private function checkSessionForDestroyAndUnset() {
		if (!is_null(smp_base_SessionRegistry::getValue('SESSION_LAST_ACTIVITY_TIME')) && (time() - smp_base_SessionRegistry::getValue('SESSION_LAST_ACTIVITY_TIME') > 1800)) {
			// last request was more than 30 minutes ago
			session_destroy();	// destroy session data in storage
			session_unset();	// unset $_SESSION variable for the runtime
		}
		smp_base_SessionRegistry::setValue('SESSION_LAST_ACTIVITY_TIME', time()); // update last activity time stamp
	}	
	
	private function checkSessionForReGenerateId() {
		if (is_null(smp_base_SessionRegistry::getValue('SESSION_CREATED_TIME'))) {
			smp_base_SessionRegistry::setValue('SESSION_CREATED_TIME', time());
		} else if (time() - smp_base_SessionRegistry::getValue('SESSION_CREATED_TIME') > 1800) {
			// session started more than 30 minutes ago
			session_regenerate_id(true);	// change session ID for the current session an invalidate old session ID
			smp_base_SessionRegistry::setValue('SESSION_CREATED_TIME', time());
		}	
	}
	
}