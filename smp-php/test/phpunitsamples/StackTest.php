<?php
require_once 'PHPUnit/Framework.php';

class StackTest0 extends PHPUnit_Framework_TestCase{

	public function testPushAndPop()
	{
		$stack = array();
		$this->assertEquals(0, count($stack));

		array_push($stack, 'foo');
		$this->assertEquals('foo', $stack[count($stack)-1]);
		$this->assertEquals(1, count($stack));

		$this->assertEquals('foo', array_pop($stack));
		$this->assertEquals(0, count($stack));
	}

    public function testSomething()
    {
        // Optional: Test anything here, if you want.
        $this->assertTrue(TRUE, 'This should already work.');
 
        // Stop here and mark this test as incomplete.
//        $this->markTestIncomplete('This test has not been implemented yet.');
    }
	
}
?>