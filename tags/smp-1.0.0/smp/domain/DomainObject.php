<?php
/**
 * Created at 06/07/2010 5:14:41 PM
 * smp_domain_DomainObject
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_domain_DomainObject {
	private $id = -1;
	
	function __construct($id = null) {
		$this->id = $id;
	}
	
	function setId($id) {
		$this->id = $id;
	}
	
	function getId() {
		return $this->id;
	}
}