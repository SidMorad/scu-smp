<?php
/**
 * Created at 06/07/2010 5:16:51 PM
 * filename
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
require_once('smp/domain/User.php');
class smp_mapper_UserMapper extends smp_mapper_Mapper {

	function __construct() {
		parent::__construct();
		$this->selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_user WHERE username=?");
		$this->updateStmt = self::$ADODB->Prepare("UPDATE smp_user SET password=?, WHERE id=?");
		$this->insertStmt = self::$ADODB->Prepare("INSERT into smp_user (username, password) values(?,?) ");
	}
	
	protected function doCreateObject(array $array) {
		$obj = new smp_domain_User($array['id'], $array['username']);
		$obj->setPassword($array['password']);
		return $obj;
	}
	
	protected function doInsert(smp_domain_DomainObject $object) {
		$values = array($object->getUsername(), $object->getPassword());
		self::$ADODB->Execute($this->insertStmt, $values);
		$id = self::$ADODB->LastInsertId();
		$object->setId($id);
	}
	
	function update (smp_domain_DomainObject $object) {
		$values = array($object->getPassword(), $object->getId());
		self::$ADODB->Execute($this->updateStmt,$values);
	}
	
	function selectStmt() {
		return $this->selectStmt;
	}
	
	protected function targetClass() {
		return "smp_domain_User";
	}

	function findByUsername ($username) {
		$rs = self::$ADODB->Execute($this->selectStmt, array($username));
		$arr = $rs->FetchRow();
		if (!is_array($arr)) {
			return null;
		}
		return $this->doCreateObject($arr);
	}
	
	function findUserRoles(smp_domain_User $user) {
		$selectStmt = self::$ADODB->Prepare("SELECT smp_role.name FROM smp_role INNER JOIN smp_user_role ON smp_role.id = smp_user_role.role_id WHERE smp_user_role.user_id=?");
		$rs = self::$ADODB->Execute($selectStmt, array($user->getId()));
		while (!$rs->EOF) {
			$user->addToRoles($rs->fields('name'));
			$rs->MoveNext();
		}
		return $user;
	}
	
}