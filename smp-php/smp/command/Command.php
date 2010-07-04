<?php
/**
 * Created at 04/07/2010 6:43:21 PM
 * smp_command_Command
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
abstract class smp_command_Command {
	final function __construct() {}
	
	function execute( smp_controller_Request $request) {
		$this->doExecute($request);
		$request->setCommand($this);
	}
	
	abstract function doExecute( smp_controller_Request $request);
	
}