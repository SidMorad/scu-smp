<?php
/**
 * Created at 04/07/2010 4:57:42 PM
 * smp_controller_Request
 *
 * This class is a part of 'Front Controller' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/base/RequestRegistry.php');
class smp_controller_Request {
	private $properties;
	private $title;
	private $command;
	private $view;
	private $list = array();
	private $feedbacks;
	private $entity;
	private $errors;
	private $datagrid;
	private $searchEntity;
	private $isRedirect = false;
	private $viewRedirectedFrom;
	
	/**
	 * constructor
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
		return null;
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
	 * @return $properties
	 */
	function getProperties() {
		return $this->properties;
	}
	
	/**
	 * isPost method for check if request type is post
	 */
	public function isPost() {
		if (strtoupper($_SERVER['REQUEST_METHOD']) == "POST") {
			return true;
		} else {
			return false;
		}
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
		return $this->command;
	}
	
	/**
	 * 
	 * @param $view
	 */
	function setView($view) {
		$this->view = $view;
	}
	
	/**
	 * @return $view
	 */
	function getView() {
		return $this->view;
	}
	
	/**
	 * Forward to view 
	 * @param $view
	 */
	function forward($view) {
		$this->setView($view);
	}	
	
	/**
	 * 
	 * @param $list
	 */
	function setList($list) {
		$this->list = $list;
	}
	
	/**
	 * @return $list whcih is array of object
	 */
	function getList() {
		return $this->list;
	}

	/**
	 * @return $feedbacks whcih is array of string
	 */
	function getFeedbacks() {
		return $this->feedbacks;
	}
	
	/**
	 * 
	 * @param $feedback
	 */
	function addFeedback ( $feedback) {
		$this->feedbacks[] = $feedback;
	} 	

	/**
	 * @return $errors whcih is array of string
	 */
	function getErrors() {
		return $this->errors;
	}
	
	/**
	 * 
	 * @param $error
	 */
	function addError ( $error) {
		$this->errors[] = $error;
	} 	

	/**
	 * 
	 * @param smp_domain_DomainObject $entity
	 */
	function setEntity ($entity) {
		$this->entity = $entity;
	}
	
	/**
	 * @return smp_domain_DomainObject entity
	 */
	function getEntity() {
		return $this->entity;
	}
	
	/**
	 * @return Structures_DataGrid object 	
	 */
	public function getDatagrid() {
	    return $this->datagrid;
	}

	/**
	 * 
	 * @param Structures_DataGrid $datagrid
	 */
	public function setDatagrid($datagrid) {
	    $this->datagrid = $datagrid;
	}
	
	/**
	 * 
	 * @param smp_domain_DomainObject $entity
	 */
	function setSearchEntity ($searchEntity) {
		$this->searchEntity = $searchEntity;
	}
	
	/**
	 * @return smp_domain_DomainObject entity
	 */
	function getSearchEntity() {
		return $this->searchEntity;
	}
	
	/**
	 * Return true if the request has redirect
	 */
	public function getIsRedirect() {
	    return $this->isRedirect;
	}
	
	/**
	 * 
	 * @param Boolean $isRedirect
	 */
	public function setIsRedirect($isRedirect) {
	    $this->isRedirect = $isRedirect;
	}
	
	public function redirect($cmd) {
		$this->setIsRedirect(true);
		$this->setProperty('cmd', $cmd);
		$this->setViewRedirectedFrom($this->getView());
		$this->setView($cmd);
	}

	public function getViewRedirectedFrom(){
	    return $this->viewRedirectedFrom;
	}

	public function setViewRedirectedFrom($viewRedirectedFrom){
	    $this->viewRedirectedFrom = $viewRedirectedFrom;
	}
}