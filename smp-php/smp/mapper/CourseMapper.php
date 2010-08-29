<?php
/**
 * Created at 29/08/2010 9:10:16 PM
 * smp_mapper_CourseMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
class smp_mapper_CourseMapper extends smp_mapper_Mapper {

	function __construct($adodb = null) {
		parent::__construct($adodb);
	}
	
	function getIdNameArray($array) {
		$rs = self::$ADODB->Execute('SELECT id, name FROM smp_course');
		while ($row = $rs->FetchRow()) {
			$id = $row['id'];
			$array[$id] = $row['name'];
		}
		return $array;
	}
	
	protected function targetClass() { return 'smp_domain_Course';}
	protected function doInsert(smp_domain_DomainObject $object) {}
	protected function doCreateObject( array $array) {}
}