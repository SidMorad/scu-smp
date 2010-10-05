<?php
/**
 * Created at 13/09/2010 10:32:21 AM
 * smp_command_course_ListCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/datagrid/GenericDatagrid.php');
require_once('smp/domain/Course.php');
class smp_command_course_ListCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$genericDatagrid = new smp_datagrid_GenericDatagrid();
		
		$course = new smp_domain_Course();
		if($request->isPost()){
			
			if(Constants::ACTION_SEARCH == $request->getProperty(Constants::ACTION)){
				$course->setId($request->getProperty('id'));
				$course->setName($request->getProperty('name'));
			}	
		}
		
		$datagrid = $genericDatagrid->getDatagrid(Constants::TABLE_COURSE, $course);
		
		$request->setDatagrid($datagrid);
		
		$request->setTitle('Course List');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER);
	}
	
}