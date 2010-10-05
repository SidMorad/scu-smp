<?php
/**
 * Created at 01/10/2010 12:53:48 PM
 * smp_mapper_CampusMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
require_once('smp/domain/Campus.php');
class smp_mapper_CampusMapper extends smp_mapper_Mapper {

	function __construct($adodb = null) {
		parent::__construct($adodb);
	}
	
	function delete($id) {
		return self::$ADODB->Execute('DELETE FROM '.Constants::TABLE_CAMPUS . ' WHERE id=?', array($id));
	}
	
	function update($campus) {
		$updateStmt = self::$ADODB->Prepare('UPDATE '.Constants::TABLE_CAMPUS.' SET name=? WHERE id=?');
		$rs = self::$ADODB->execute($updateStmt, array($campus->getName(), $campus->getId()));
		if ($rs === false) {
			return null;
		}
		return $campus;
	}
	
	function save($campus) {
		$insertStmt = self::$ADODB->Prepare('INSERT INTO '.Constants::TABLE_CAMPUS.' (name) VALUES(?)');
		$rs = self::$ADODB->execute($insertStmt, array($campus->getName()));
		if ($rs === false) {
			return null;
		} else {
			$campus->setId(self::$ADODB->Insert_ID());
		}
		return $campus;
	}
	
	function find($id) {
		$selectStmt = self::$ADODB->Prepare('SELECT * FROM '.Constants::TABLE_CAMPUS. ' WHERE id=?');
		$rs = self::$ADODB->Execute($selectStmt, array($id));
		return ($rs === false ? null : self::doCreateObject($rs->FetchRow()));
	}
	
	function getIdNameArray($array) {
		$rs = self::$ADODB->Execute('SELECT id, name FROM '. Constants::TABLE_CAMPUS);
		while ($row = $rs->FetchRow()) {
			$id = $row['id'];
			$array[$id] = $row['name'];
		}
		return $array;
	}
	
	protected function doCreateObject( array $array) {
		return new smp_domain_Campus($array['id'], $array['name']);	
	}
	protected function targetClass() { return 'smp_domain_Campus';}
	protected function doInsert(smp_domain_DomainObject $object) {}
}