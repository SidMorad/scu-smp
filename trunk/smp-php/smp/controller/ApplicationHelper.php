<?php
/**
 * Created at 06/07/2010 2:24:18 PM
 * smp_controller_ApplicationHelper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/ApplicationRegistry.php');
require_once('library/adodb511/adodb.inc.php');
class smp_controller_ApplicationHelper {
	private static $instance;
	private $configXmlFile = "smp/config/smp_config.xml";
	private $falg = false;
	private function __construct() {}
	
	static function instance() {
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	function init() {
//		if (!self::$instance->falg) {
//			return;
//		}
		$this->loadXmlConfiguration();
	}
	
	private function loadXmlConfiguration() {
		$this->ensure( file_exists( $this->configXmlFile), "Could not find config file");
		
		$options = @simplexml_load_file($this->configXmlFile);
		$this->ensure($options instanceof SimpleXMLElement, "Could noe resolve config file");
		// set DSN value
		$dsn = (string)$options->dsn;
		$this->ensure($dsn, "No dsn tag found");
		smp_base_ApplicationRegistry::setDSN($dsn);
		
		// set ADODB value
//		$dbConnection = NewADOConnection($dsn);
//		$this->ensure($dbConnection, "Database connection faild!");
//		smp_base_ApplicationRegistry::setADODB($dbConnection);
		// set other values
		self::$instance->falg = true;
	}	
	
	private function ensure($expr, $message) {
		if (!$expr) {
			throw new smp_base_AppException($message);
		}
	}	
}