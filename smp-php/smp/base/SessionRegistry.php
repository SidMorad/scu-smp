<?php
/**
 * Created at 06/07/2010 1:44:27 PM
 * smp_base_SessionRegistry
 *
 * This class is a part of 'Registry' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/Registry.php');
class smp_base_SessionRegistry extends smp_base_Registry {	
	private static $instance;
	
	private function __construct() {
	// below line will give Warning : Cannot send session cookie - headers already sent by
		session_start();
	}
	
	static function instance() {
		if (! isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	protected function get($key) {
		if (isset($_SESSION[__CLASS__][$key])) {
			return $_SESSION[__CLASS__][$key];
		}
		return null;
	}	
	
	protected function set($key, $val) {
		$_SESSION[__CLASS__][$key] = $val;
	}	
	
	static function setUser(smp_domain_User $user) {
		self::instance()->set('X_USER', $user);	
	}
	
	static function getUser() {
		return self::instance()->get('X_USER');
	}
	
	static function doInvalidUser() {
		self::instance()->set('X_USER', null);
	}
}