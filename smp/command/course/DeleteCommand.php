<?php
/**
 * Created at 13/09/2010 12:51:47 PM
 * smp_command_course_DeleteCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/service/CourseService.php');
class smp_command_course_DeleteCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$courseService = new smp_service_CourseService();
		
		$id = $request->getProperty('id');
		$result = $courseService->delete($id);
		
		if ($result) {
			$request->addFeedback('Delete Course was successfull.');
		} else {
			$request->addError('Delete failed.');
		}
		$request->redirect('course/list');
		$request->setTitle('Course list');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER);
	}	
}