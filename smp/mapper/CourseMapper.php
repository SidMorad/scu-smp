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
	
	function delete($id) {
		return self::$ADODB->Execute('DELETE FROM '.Constants::TABLE_COURSE . ' WHERE id=?', array($id));
	}
	
	function update($course) {
		$updateStmt = self::$ADODB->Prepare('UPDATE '.Constants::TABLE_COURSE.' SET name=? WHERE id=?');
		$rs = self::$ADODB->execute($updateStmt, array($course->getName(), $course->getId()));
		if ($rs === false) {
			return null;
		}
		return $course;
	}
	
	function save($course) {
		$insertStmt = self::$ADODB->Prepare('INSERT INTO '.Constants::TABLE_COURSE.' (name) VALUES(?)');
		$rs = self::$ADODB->execute($insertStmt, array($course->getName()));
		if ($rs === false) {
			return null;
		} else {
			$course->setId(self::$ADODB->Insert_ID());
		}
		return $course;
	}
	
	function find($id) {
		$selectStmt = self::$ADODB->Prepare('SELECT * FROM '.Constants::TABLE_COURSE. ' WHERE id=?');
		$rs = self::$ADODB->Execute($selectStmt, array($id));
		return ($rs === false ? null : self::doCreateObject($rs->FetchRow()));
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
	protected function doCreateObject( array $array) {
		return new smp_domain_Course($array['id'], $array['name']);	
	}
}