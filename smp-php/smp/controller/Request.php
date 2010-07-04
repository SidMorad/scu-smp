<?php
/**
 * Created at 04/07/2010 4:57:42 PM
 * smp_controller_Request
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/base/RequestRegistry.php');
class smp_controller_Request {
	private $properties;
	private $title;
	private $command;
	
	/**
	 * default constructor
	 */
	function __construct() {
		$this->init();
		smp_base_RequestRegistry::setRequest($this);
	}

	/**
	 * Initalize properties from $_REQUEST or $_SERVER['argv']
	 */
	function init() {
		if(isset($_SERVER['REQUEST_METHOD'])) {
			$this->properties = $_REQUEST;
			return;
		}
		foreach($_SERVER['argv'] as $arg) {
			if(strpos($arg, '=')) {
				list($key, $val) = explode("=",$arg);
				$this->setProperty($key, $val);
			}
		}
	}
	
	/**
	 * get property from request array
	 * @param $key
	 * @return $val
	 */
	function getProperty($key) {
		if (isset($this->properties[$key])) {
			return $this->properties[$key];
		}
	}

	/**
	 * set property to request array
	 * @param $key
	 * @param $val
	 */
	function setProperty($key, $val) {
		$this->properties[$key]= $val;
	}
	
	/**
	 * set title for page
	 * @param $title
	 */
	function setTitle($title) {
		$this->title = $title;
	}
	
	/**
	 * get title for page
	 * @return title
	 */
	function getTitle() {
		return $this->title;
	}

	/**
	 * 
	 * @param $command
	 */
	function setCommand(smp_command_Command $command) {
		$this->command = $command;
	}	
	
	/**
	 * 
	 * @return $command
	 */
	function getCommand() {
		$this->command;
	}
	
}