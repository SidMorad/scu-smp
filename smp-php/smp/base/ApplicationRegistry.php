<?php
/**
 * Created at 06/07/2010 1:59:27 PM
 * smp_base_ApplicationRegistry
 * 
 * This class is a part of 'Registry' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/Registry.php');
require_once('smp/base/AppException.php');
class smp_base_ApplicationRegistry extends smp_base_Registry {
	private static $instance;
	private $values = array();
	private $mtimes = array();
	//TODO $freezdir should be SECURE directory! and currently is not. 
	private $freezdir = "smp/application_registry_data";
	
	private function __construct() {}
	
	static function instance() {
		if (! isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
		
	protected function get($key) {
		$path = $this->freezdir . DIRECTORY_SEPARATOR . $key;
		if (file_exists($path)) {
			clearstatcache();
			$mtime = filemtime($path);
			
			if (!isset($this->mtimes[$key])) {
				$this->mtimes[$key] = 0;
			}
			if ($mtime > $this->mtimes[$key]) {
				$data = file_get_contents($path);
				$this->mtimes[$key] = $mtime;
				return ($this->values[$key] = unserialize($data));
			}
			if (isset($this->values[$key])) {
				return $this->values[$key];
			}
			return null;
		} 
	}
	
	protected function set($key, $val) {
		$this->values[$key] = $val;
		$path = $this->freezdir .DIRECTORY_SEPARATOR . $key;
		file_put_contents($path, serialize($val));
		$this->mtimes[$key]=time();
	}	
	
	static function getDSN() {
		return self::instance()->get('dsn');
	}
	
	static function setDSN($dsn) {
		self::instance()->set('dsn', $dsn);
	}

}