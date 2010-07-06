<?php
/**
 * Created at 06/07/2010 1:59:27 PM
 * filename
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/Registry.php');
require_once('smp/base/AppException.php');
class smp_base_ApplicationRegistry extends smp_base_Registry {
	private static $instance;
	private $values = array();
	private $id;
	const DSN = 1;
	const ADODB = 2;
	
	private function __construct() {
		$this->id = @shm_attach(55,10000,0600);
		if (! $this->id) {
			throw new smp_base_AppException("Could not access shared memeory");
		}
	}
	
	static function instance() {
		if (! isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
		
	protected function get($key) {
		return shm_get_var($this->id, $key);
	}
	
	protected function set($key, $val) {
		shm_put_var($this->id, $key, $val);
	}	
	
	static function getDSN() {
		return self::instance()->get(self::DSN);
	}
	
	static function setDSN($dsn) {
		self::instance()->set(self::DSN, $dsn);
	}

	static function getADODB() {
		return self::instance()->get(self::ADODB);
	}
	
	static function setADODB($adodb) {
		self::instance()->set(self::ADODB, $adodb);
	}
	
}