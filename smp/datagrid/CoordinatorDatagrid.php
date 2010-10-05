<?php
/**
 * Created at 01/10/2010 11:19:51 AM
 * smp_datagrid_CoordinatorDatagrid
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/Datagrid.php');
class smp_datagrid_CoordinatorDatagrid extends smp_datagrid_Datagrid {
	
	function getDatagrid($coordinator = null) {
		
		$query = "SELECT smp_coordinator.id, smp_coordinator.firstname, smp_coordinator.lastname, smp_coordinator.user_id, smp_user.username  FROM smp_coordinator " ;
		$query .= " INNER JOIN smp_user ON smp_coordinator.user_id = smp_user.id";
		self::$datagrid->bind($query, self::$options);
		
		return self::$datagrid;
	}
}