<?php
require_once 'PHPUnit/Extensions/Database/TestCase.php';

class DatabaseTest extends PHPUnit_Extensions_Database_TestCase {

	protected function setUp() {
		if (!extension_loaded('mysqli')) {
			$this->markTestSkipped('The MySQLi extention is not available.');
		}
	}
	
	
	protected function getConnection() {
		$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
		return $this->createDefaultDBConnection($pdo, 'test');
	}
	
	protected function getDataSet() {
//		return $this->createFlatXMLDataSet(dirname(__FILE__).'/_files/bank-account-seed.xml');
	}

	public function testNothing() {
		$this->assertTrue(true);
	} 
}