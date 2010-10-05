<?php
/**
 * Created at 01/10/2010 12:57:12 PM
 * smp_domain_Campus
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_domain_Campus extends smp_domain_DomainObject {
	private $name;
	private $shortName;
	
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

	public function getShortName() {
	    return $this->shortName;
	}

	public function setShortName($shortName) {
	    $this->shortName = $shortName;
	}
}