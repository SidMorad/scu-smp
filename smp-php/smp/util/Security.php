<?php
/**
 * Created at 06/07/2010 11:24:51 PM
 * filename
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/domain/User.php');
class smp_util_Security {
	
	static function getCurrentUser() {
		$user = smp_base_SessionRegistry::getUser();
		if (! $user instanceof smp_domain_User) {
			$user = new smp_domain_User(-1,"Guest");
		}
		return $user;
	}
	
	static function isUserAuthenticated() {
		$user = smp_base_SessionRegistry::getUser();
		if ($user instanceof smp_domain_User) {
			return true;
		}
		return false;
	}
	
	static function isUserGrantedWith($roleName) {
		$user = smp_util_Security::getCurrentUser();
		return in_array($roleName, $user->getRoles());
	}
}