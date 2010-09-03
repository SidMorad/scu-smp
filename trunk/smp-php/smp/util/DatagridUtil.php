<?php
/**
 * Created at 21/08/2010 11:48:38 AM
 * smp_util_DatagridUtil
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('HTML/Table.php');
require_once('smp/view/ViewHelper.php');
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
	
		
	static function formatColumn($field , $datagrid) {
		$column =& $datagrid->getColumnByField($field);
		$column->setFormatter('format_'.$field);
		return $datagrid;
	}
	
	function format_gender($params) {
		$key=$params['record']['gender'];
		return VH::getValueFromFixArray('gender', $key);
	}
	
	function format_study_mode($params){
	    $key = $params['record']['study_mode'];
	    return VH::getValueFromFixArray('study_mode', $key);
	}
	
}