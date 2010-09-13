<?php
/**
 * Created at 13/09/2010 10:43:52 AM
 * smp_datagrid_GenericDatagrid
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/Datagrid.php');
class smp_datagrid_GenericDatagrid extends smp_datagrid_Datagrid {
	
	function getDatagrid($tableName, $domain = null) {
		
		$searchCriteria = (!is_null($domain) ? self::getSearchCriteria($domain, '', false) : "");
		
		$whereCondition = ($searchCriteria != "" ? " WHERE ".$searchCriteria." " : " ");
		
		$query = "SELECT * FROM ".$tableName.$whereCondition;
		
		self::$datagrid->bind($query, self::$options);
		
		return self::$datagrid;
	}
	
	
}