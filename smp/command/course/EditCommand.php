<?php
/**
 * Created at 13/09/2010 12:04:54 PM
 * smp_command_course_EditCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/util/Validator.php');
require_once('smp/domain/Course.php');
require_once('smp/service/CourseService.php');
class smp_command_course_EditCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$courseService = new smp_service_CourseService();
		$validator = new smp_util_Validator();
		$validator->checkEmptiness('name', 'Name is compulsory.');
		$validator->checkEmptiness('id', 'Id is required.');
		
		if ($request->isPost()) {
			if ($validator->isValid()) {
				$course = new smp_domain_Course($validator->getProperty('id'), $validator->getProperty('name'));
				$course = $courseService->update($course);
				if (is_null($course)) {
					$validator->setError('name','Update failed, It seems this course name already exists!');
				} else {
					// make form empty
					$request->addFeedback('Course by name [ '.$course->getName(). ' ] updated successfully.');
				}
			}
		} else {
			$id = $request->getProperty('id');
			$course = $courseService->find($id);
			$request->setEntity($course);			
		}
		
		$request->setTitle('Course Form');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER);
	}
}