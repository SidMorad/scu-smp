<?php
/**
 * Created at 04/07/2010 6:43:21 PM
 * smp_command_Command
 *
 * This class is a part of 'Command' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
abstract class smp_command_Command {
	final function __construct() {}
	
	function execute( smp_controller_Request $request) {
		$this->doExecute($request);
		$request->setCommand($this);
	}
	
	abstract function doExecute( smp_controller_Request $request);
	
}