<?php
/**
 * Created at 14/07/2010 11:20:55 PM
 * smp_domain_Role
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/DomainObject.php');
class smp_domain_Role extends smp_domain_DomainObject {
	private $name;
	
	function __construct($id = -1, $name) {
		parent::__construct($id);
		$this->name = $name;
	}
	
	function getName() {
		return $this->name;
	}
	
	function setName($name) {
		$this->name = $name;
	}
}