<?php
/**
 * Created at 04/07/2010 5:12:12 PM
 * smp_controller_AppController
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
require_once('smp/command/Command.php');
require_once('smp/command/DefaultCommand.php');
require_once('smp/base/AppException.php');
class smp_controller_AppController {
	private static $base_cmd;
	private static $default_cmd;
	
	function __construct() {
		if(!self::$base_cmd) {
			self::$base_cmd = new ReflectionClass("smp_command_Command");
			self::$default_cmd = new smp_command_DefaultCommand();
		}
	}
	
	function getView(smp_controller_Request $req) {
		$cmd_str = $req->getProperty('cmd');
		if(! $cmd_str) {
			// no cmd property - returning default view
			return "default";
		}
		// replace '_' with '/' for mapping to right view directory. 
		$view = str_replace("_","/",$cmd_str);
		return $view;
	}
	
	function getCommand(smp_controller_Request $req) {
		$cmd_str = $req->getProperty('cmd');
		if(! $cmd_str) {
			// no cmd property - returning default command
			return self::$default_cmd;
		}
		
		$cmd_obj = $this->resolveCommand($cmd_str);
		if(! $cmd_obj) {
			throw new smp_base_AppException("Couldn't resolve '$cmd_str'");
		}
		return $cmd_obj;
	}
	
	function resolveCommand($cmd_str) {
		$classroot = substr($cmd_str, strpos($cmd_str, '_')+1);
		$classpack = substr($cmd_str, 0,strpos($cmd_str, '_'));
		$Class = ucfirst($classroot). "Command";
		$filepath = "smp/command/$classpack/$Class.php";
		$classname = "smp_command_$classpack"."_".$Class;
		if (file_exists($filepath)) {
			require_once("$filepath");
			if (class_exists($classname)) {
				$cmd_class = new ReflectionClass($classname);
				if ($cmd_class->isSubclassOf( self::$base_cmd)) {
					return $cmd_class->newInstance();
				}
			} else {
				throw new smp_base_AppException("Class '$classname' does not exist");
			}
		} else {
//			throw new smp_base_AppException("File '$filepath' does not exist");
		}
		return null;
	}	
	
}