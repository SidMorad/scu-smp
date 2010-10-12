<?php
/**
 * Created at 21/09/2010 4:47:09 PM
 * smp_service_LogService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/GenericDatagrid.php');
class smp_service_LogService {
	private $genericDatagrid;
	
	function __construct() {
		$this->genericDatagrid = new smp_datagrid_GenericDatagrid();
	}
	
	function getDatagrid() {
		return $this->genericDatagrid->getDatagrid(Constants::TABLE_LOG, null, 'id', 'DESC');	
	}
	
}