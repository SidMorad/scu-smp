<?php
/**
 * Created at 04/07/2010 4:41:26 PM
 * smp_controller_Controller
 *
 * This class is a part of 'Front Controller' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/controller/Request.php');
require_once('smp/controller/AppController.php');
require_once('smp/controller/ApplicationHelper.php');
require_once('smp/controller/SessionHelper.php');
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
		// This method it should be run after handleRequest, 
		// that is why we could not include it in orignal init() method
		$instance->initSession(); 
	}
	
	/**
	 * Initalize required configuration of application
	 */
	function init() {
		$applicationHelper = smp_controller_ApplicationHelper::instance();
		$applicationHelper->init();
	}
	
	/**
	 * handle request 
	 */
	function handleRequest() {
		$request = new smp_controller_Request();
		$appController = new smp_controller_AppController();
		$cmd = $appController->getCommand($request);
		// set default view for request before execute command;
		$request->setView($appController->getView($request));
		$cmd->execute($request);
		$this->invokeView($request->getView());
	}

	/**
	 * Initalize required configuration for HttpSession after handle request
 	 */
	function initSession() {
		$sessionHelper = smp_controller_SessionHelper::instance();
		$sessionHelper->init();
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