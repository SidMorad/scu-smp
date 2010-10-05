<?php
require_once 'PHPUnit/Framework.php';

class ExceptionTest extends PHPUnit_Framework_TestCase {

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testException() {
        try {
            // ... Code that is expected to raise an exception ...
        }
 
        catch (InvalidArgumentException $expected) {
            return;
        }
        
        $this->setExpectedException('InvalidArgumentException');
        throw new InvalidArgumentException('MESSAGEexception!!!!!!!!');
        $this->fail('An expected exception has not been raised.');
 
    }
}