<?php
/**
 * Created at 19/07/2010 9:55:03 AM
 * smp_command_student_ListMentorCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/command/Command.php');
require_once('smp/service/StudentService.php');
//require_once('library/datagrid-0.9.0/DataGrid.php');
require_once('smp/base/ApplicationRegistry.php');
class smp_command_student_ListMentorCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$studentService = new smp_service_StudentService();
		$list = $studentService->listMentors();
		foreach($list as $mentor) {
			$mentor->setMentees($studentService->findStudentMenteesWithMentorId($mentor->getId()));
		}
//		$datagrid =& new Structures_DataGrid();
//		$options = array('dsn' => smp_base_ApplicationRegistry::getDSN()); 
//		
//		$test = $datagrid->bind('SELECT *  FROM smp_student', $options);
//		$request->addError($test->getMessage());
//		
//		$test = $datagrid->render();
//		$request->addError($test->getMessage());
		
		$request->setList($list);
		$request->setTitle("List of Mentors");
	}

}
