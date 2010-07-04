<?php
/**
 * Created at 04/07/2010 8:16:13 PM
 * smp_base_Registry
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
abstract class smp_base_Registry {

	abstract protected function get($key);
	abstract protected function set($key, $val);
	
}