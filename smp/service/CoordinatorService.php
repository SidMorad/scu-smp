<?php
/**
 * Created at 01/10/2010 11:17:55 AM
 * smp_service_CoordinatorService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/CoordinatorDatagrid.php');
require_once('smp/mapper/CoordinatorMapper.php');
class smp_service_CoordinatorService {
	private $coordinatorMapper;
	private $coordinatorDatagrid;
	
	function __construct() {
		$this->coordinatorDatagrid = new smp_datagrid_CoordinatorDatagrid();
		$this->coordinatorMapper = new smp_mapper_CoordinatorMapper();
	}
	
	function getDatagrid() {
		return $this->coordinatorDatagrid->getDatagrid();
	}
	
	function save($coordinator) {
		return $this->coordinatorMapper->save($coordinator);
	}

	function find($id) {
		return $this->coordinatorMapper->find($id);
	}
	
	function update($coordinator) {
		return $this->coordinatorMapper->update($coordinator);
	}

	function delete($id) {
		return $this->coordinatorMapper->delete($id);
	}
	
}