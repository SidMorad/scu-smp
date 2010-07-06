<?php
/**
 * Created at 04/07/2010 8:13:46 PM
 * smp_base_RequestRegistry
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/base/Registry.php');
class smp_base_RequestRegistry extends smp_base_Registry {
	private $values = array();
	private static $instance;
	
	/**
	 * private constructor
	 */
	private function __construct() {}
	
	static function instance() {
		if (! isset(self::$instance)) { 
			self::$instance = new self(); 
		}
		return self::$instance;
	}
	
	protected function get($key) {
		if (isset($this->values[$key])) {
			return $this->values[$key];
		}
		return null;
	}	
	
	protected function set($key, $val) {
		$this->values[$key] = $val;
	}
	
	static function getRequest() {
		return self::instance()->get('request');
	}	
	
	static function setRequest(smp_controller_Request $request) {
		return self::instance()->set('request', $request);
	}
	
	static function getValidator() {
		return self::instance()->get('validator');
	}
	
	static function setValidator(smp_util_Validator $validator) {
		return self::instance()->set('validator', $validator);
	}	
	
}