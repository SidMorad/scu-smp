<?php
/**
 * Created at 13/09/2010 11:33:45 AM
 * smp_service_CourseService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/CourseMapper.php');
class smp_service_CourseService {
	private $courseMapper;
	
	function __construct() {
		$this->courseMapper = new smp_mapper_CourseMapper();
	}

	function delete($id) {
		return $this->courseMapper->delete($id);
	}
	
	function update($course) {
		return $this->courseMapper->update($course);
	}
	
	function save($course) {
		return $this->courseMapper->save($course);
	}

	function find($id) {
		return $this->courseMapper->find($id);
	}
	
}