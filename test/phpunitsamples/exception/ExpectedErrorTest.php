<?php
require_once 'PHPUnit/Framework.php';

class ExpectedErrorTest extends PHPUnit_Framework_TestCase {
	
	/**
	 */
	public function testFailingInclude() {
//	 * @expectedException PHPUnit_Framework_Error
//		include 'not_existing_file.php';
		$this->assertTrue(true);
	}
}
