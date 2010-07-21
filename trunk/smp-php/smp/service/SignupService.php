<?php
/**
 * Created at 21/07/2010 11:42:02 AM
 * smp_service_SignupService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/SignupMapper.php');
require_once('smp/domain/User.php');
require_once('smp/domain/Student.php');
require_once('smp/domain/Contact.php');
class smp_service_SignupService {
	protected $signupMapper;

	function __construct() {
		$this->signupMapper = new smp_mapper_SignupMapper();
	}	
	
	function saveMentor(smp_domain_User $user, smp_domain_Student $student, smp_domain_Contact $contact) {
		return $this->signupMapper->saveMentor($user, $student, $contact);
	}
}