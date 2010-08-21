<?php
/**
 * Created at 21/08/2010 11:48:38 AM
 * smp_util_DatagridUtil
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('HTML/Table.php');
class smp_util_DatagridUtil {

	static function getCustomHtmlTable() {
		// Define the Look and Feel
		$tableAttribs = array(
		    'class' => 'table'
		);
		// Create a HTML_Table
		$table = new HTML_Table($tableAttribs);
		
		return $table; 		
	}
	
	static function getRenderOptions() {
		$rendererOptions = array(
		    'sortIconASC' => '&uArr;',
		    'sortIconDESC' => '&dArr;'
		);
		return $rendererOptions;
	}
	
}