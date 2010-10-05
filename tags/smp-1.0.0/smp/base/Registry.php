<?php
/**
 * Created at 04/07/2010 8:16:13 PM
 * smp_base_Registry
 *
 * This class is a part of 'Registry' pattern. see Reference#1
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
abstract class smp_base_Registry {

	abstract protected function get($key);
	abstract protected function set($key, $val);
	
}