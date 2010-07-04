<?php
/**
 * Created at 04/07/2010 8:10:51 PM
 * VH
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/base/RequestRegistry.php');
class VH {
	static function getRequest() {
		return smp_base_RequestRegistry::getRequest();
	}
}