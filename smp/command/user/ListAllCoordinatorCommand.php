<?php
/**
 * Created at 13/09/2010 2:50:55 PM 
 * smp_command_user_ListAllCoordinatorCommand
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/datagrid/GenericDatagrid.php');
require_once('smp/domain/User.php');
class smp_command_user_ListAllCoordinatorCommand extends smp_command_Command{
	
	function doExecute(smp_controller_Request $request){
		$genericDatagrid=new smp_datagrid_GenericDatagrid();
		
		//
		
	$datagrid=$genericDatagrid->getDatagrid(Constants::TABLE_USER, null);
	
	$request->setDatagrid($datagrid);
	
	$request->setTitle('Coordinator List');		
	}
	
	function doSecurity(){
		$this->roles=array(Constants::ROLE_MANAGER);
	}
}
