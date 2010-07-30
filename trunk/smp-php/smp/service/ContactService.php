<?php
/**
 * Created at 30/07/2010 11:39:44 AM
 * smp_service_ContactService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/ContactMapper.php');
class smp_service_ContactService {
	private $contactMapper;
	
	function __construct() {
		$this->contactMapper = new smp_mapper_ContactMapper();
	}
	
	function findContactWithUserId($userId) {
		return $this->contactMapper->findContactWithUserId($userId);
	}
}