<?php
/**
 * Created at 13/09/2010 11:06:50 AM
 * smp_domain_Course
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_domain_Course extends smp_domain_DomainObject {
	private $name;
	
	function __construct($id = -1, $name = "") {
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