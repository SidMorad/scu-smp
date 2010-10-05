<?php
/**
 * Created at 13/09/2010 11:19:26 AM
 * smp_command_course_FormCommand
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/util/Validator.php');
require_once('smp/domain/Course.php');
require_once('smp/service/CourseService.php');
class smp_command_course_FormCommand extends smp_command_Command {
	
	function doExecute(smp_controller_Request $request) {
		$validator = new smp_util_Validator();
		$validator->checkEmptiness('name', 'Name is compulsory.');
		
		if ($validator->isValid()) {
			$course = new smp_domain_Course(-1, $validator->getProperty('name'));
			$courseService = new smp_service_CourseService();
			$course = $courseService->save($course);
			if (is_null($course)) {
				$validator->setError('name','Save failed, It seems this course name already exists!');
			} else {
				// make form empty
				$validator->setProperty('name', '');
				$request->addFeedback('Course by name [ '.$course->getName(). ' ] added successfully.');
			}
		}
		
		$request->setTitle('Course Form');
	}
	
	function doSecurity() {
		$this->roles = array(Constants::ROLE_MANAGER);
	}
}