<?php
require_once 'PHPUnit/Framework.php';

class StackTest extends PHPUnit_Framework_TestCase {
	protected $stack;
	
	protected function setUp(){
		$this->stack = array();
	}
	
	public function testEmpty(){
		$this->assertTrue(empty($this->stack));
		return $this->stack;
	}
	
	/**
	 * @depends testEmpty
	 */
	public function testPush(){
		array_push($this->stack, 'foo');
		$this->assertEquals('foo', $this->stack[count($this->stack)-1]);
		$this->assertFalse(empty($this->stack));
		return $this->stack;
	}
	
	/**
	 * @depends testPush
	public function testPop(){
		$this->assertEquals('foo', array_pop($this->stack));
		$this->assertTrue(empty($this->stack));
	}
	 */

}