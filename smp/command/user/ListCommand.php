<?php
/**
 * Created at 21/09/2010 5:07:05 PM
 * smp_command_user_ListCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/GenericDatagrid.php');
class smp_command_user_ListCommand extends smp_command_Command {

	function doExecute(smp_controller_Request $request){
		$genericDatagrid = new smp_datagrid_GenericDatagrid();

		$datagrid = $genericDatagrid->getDatagrid(Constants::TABLE_USER, null);

		$request->setDatagrid($datagrid);

		$request->setTitle('User List');
	}

	function doSecurity(){
		$this->roles = array(Constants::ROLE_ADMIN);
	}

}