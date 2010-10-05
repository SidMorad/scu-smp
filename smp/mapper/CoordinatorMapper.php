<?php
/**
 * Created at 01/10/2010 11:23:11 AM
 * smp_mapper_CoordinatorMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
require_once('smp/domain/Coordinator.php');
class smp_mapper_CoordinatorMapper extends smp_mapper_Mapper {

	function __construct($adodb = null) {
		parent::__construct($adodb);
	}
	
	function delete($id) {
		return self::$ADODB->Execute('DELETE FROM '.Constants::TABLE_COORDINATOR . ' WHERE id=?', array($id));
	}
	
	function update($coordinator) {
		$updateStmt = self::$ADODB->Prepare('UPDATE '.Constants::TABLE_COORDINATOR.' SET firstname=?, lastname=? WHERE id=?');
		$rs = self::$ADODB->execute($updateStmt, array($coordinator->getFirstname(), $coordinator->getLastname(), $coordinator->getId()));
		if ($rs === false) {
			return null;
		}
		return $coordinator;
	}
	
	function save($coordinator) {
		$insertStmt = self::$ADODB->Prepare('INSERT INTO '.Constants::TABLE_COORDINATOR.' (firstname, lastname, user_id) VALUES(?, ?, ?)');
		$rs = self::$ADODB->execute($insertStmt, array($coordinator->getFirstname(), $coordinator->getLastname(), $coordinator->getUserId()));
		if ($rs === false) {
			return null;
		} else {
			$coordinator->setId(self::$ADODB->Insert_ID());
		}
		return $coordinator;
	}
	
	function find($id) {
		$selectStmt = self::$ADODB->Prepare('SELECT * FROM '.Constants::TABLE_COORDINATOR. ' WHERE id=?');
		$rs = self::$ADODB->Execute($selectStmt, array($id));
		return ($rs === false ? null : self::doCreateObject($rs->FetchRow()));
	}
	
	protected function doCreateObject( array $array) {
		return new smp_domain_Coordinator($array['id'], $array['firstname'], $array['lastname'], $array['user_id']);	
	}
	protected function targetClass() { return 'smp_domain_Coordinator';}
	protected function doInsert(smp_domain_DomainObject $object) {}
}