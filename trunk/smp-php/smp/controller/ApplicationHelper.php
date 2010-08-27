<?php
/**
 * Created at 06/07/2010 2:24:18 PM
 * smp_controller_ApplicationHelper
 *
 * This class is a part of 'Front Controller' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/ApplicationRegistry.php');
require_once('library/adodb511/adodb.inc.php');
class smp_controller_ApplicationHelper {
	private static $instance;
	private $configXmlFile = "smp/config/smp_config.xml";
	private function __construct() {}
	
	static function instance() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	function init() {
		$dsn = smp_base_ApplicationRegistry::getDSN();
		if (!is_null($dsn)) {
			return;
		}
		$this->loadXmlConfiguration();
	}
	
	private function loadXmlConfiguration() {
		$this->ensure( file_exists( $this->configXmlFile), "Could not find config file");
		
		$options = @simplexml_load_file($this->configXmlFile);
		$this->ensure($options instanceof SimpleXMLElement, "Could not resolve config file");
		// set DSN value
		$dsn = (string)$options->dsn;
		$this->ensure($dsn, "No dsn tag found");
		smp_base_ApplicationRegistry::setDSN($dsn);
		
		// set MDB2DSN value
		$mdb2dsn = (string)$options->mdb2dsn;
		$this->ensure($mdb2dsn, "No mdb2dsn tag found");
		smp_base_ApplicationRegistry::setMDB2DSN($mdb2dsn);
		
	}	
	
	private function ensure($expr, $message) {
		if (!$expr) {
			throw new smp_base_AppException($message);
		}
	}	
}