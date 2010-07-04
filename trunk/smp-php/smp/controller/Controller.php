<?php
/**
 * Created at 04/07/2010 4:41:26 PM
 * smp_controller_Controller is part of 'Front Controller' pattern.
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/controller/Request.php');
require_once('smp/controller/AppController.php');
class smp_controller_Controller {

	/**
	 * private constructor for forcing client code to use run() method.
	 */
	private function __construct() {}
	
	/**
	 * run method is starting point of application that
	 * will be called by client code per request (in our case see index.php)
	 */
	static function run() {
		$instance = new smp_controller_Controller();
		$instance->init();
		$instance->handleRequest();
	}
	
	/**
	 * Initalize required configuration of application
	 */
	function init() {
		// init configuration 
	}
	
	/**
	 * handle request 
	 */
	function handleRequest() {
		$request = new smp_controller_Request();
		$appController = new smp_controller_AppController();
		$cmd = $appController->getCommand($request);
		$cmd->execute($request);
		$this->invokeView($appController->getView($request));
	}

	/**
	 * invoke the veiw 
	 * @param string $target
	 */
	function invokeView($target) {
		include("smp/view/$target.php");
		exit;
	}
	
}