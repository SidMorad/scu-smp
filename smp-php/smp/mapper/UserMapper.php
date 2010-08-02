<?php
/**
 * Created at 06/07/2010 5:16:51 PM
 * smp_mapper_UserMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
require_once('smp/domain/User.php');
require_once('smp/domain/Log.php');
class smp_mapper_UserMapper extends smp_mapper_Mapper {
	
	function __construct($adodb = null) {
		parent::__construct($adodb);
		$this->selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_user WHERE username=?");
		$this->updateStmt = self::$ADODB->Prepare("UPDATE smp_user SET password=?, WHERE id=?");
		$this->insertStmt = self::$ADODB->Prepare("INSERT into smp_user (username, password, scu_email) values(?,?,?) ");
	}
	
	protected function doCreateObject(array $array) {
		$obj = new smp_domain_User($array['id'], $array['username'], $array['password'],$array['scu_email']);
		return $obj;
	}
	
	protected function doInsert(smp_domain_DomainObject $object) {
		$values = array($object->getUsername(), $object->getPassword(), $object->getScuEmail());
		return self::$ADODB->Execute($this->insertStmt, $values);
	}

	protected function targetClass() {
		return "smp_domain_User";
	}
	
	function save(smp_domain_User $user) {
		$rs = self::doInsert($user);
		if ($rs === false) {
			$this->logger->save(new smp_domain_Log("user.save", "User save failed, message:".self::$ADODB->ErrorMsg()));
			return null;
		} else {
			$user->setId(self::$ADODB->Insert_ID());
			$this->logger->save(new smp_domain_Log("user.save", "User saved successfully, user:".$user));
			return $user;
		}
	}

	function saveUserRoles($userId, $arrRoleIds) {
		self::deleteUserRoles($userId);
		$stmt = self::$ADODB->Prepare("INSERT INTO smp_user_role(user_id,role_id) VALUES(?,?)");
		foreach ($arrRoleIds as $roleId) {
			return self::$ADODB->Execute($stmt, array($userId, $roleId));
		}
	}
	
	function deleteUserRoles($userId) {
		$stmt = self::$ADODB->Prepare("DELETE FROM smp_user_role WHERE user_id=?");
		return self::$ADODB->Execute($stmt, array($userId));
	}
	
	function find($id) {
		$findStmt = self::$ADODB->Prepare("SELECT * FROM smp_user WHERE id=?");
		$rs = self::$ADODB->Execute($findStmt, array($id));
		$row = $rs->FetchRow(); 
		return (is_array($row) ? self::doCreateObject($row) : null);
	}
	
	function findUserByUsername ($username) {
		$rs = self::$ADODB->Execute($this->selectStmt, array($username));
		$row = $rs->FetchRow(); 
		return (is_array($row) ? self::doCreateObject($row) : null);
	}
	
	function findUserByScuEmail ($scuEmail) {
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_user WHERE scu_email=?");
		$rs = self::$ADODB->Execute($selectStmt, array($scuEmail));
		$row = $rs->FetchRow(); 
		return (is_array($row) ? self::doCreateObject($row) : null);
	}
	
	function findUserWithStudentId ($studentId) {
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_user INNER JOIN smp_student ON smp_user.id = smp_student.user_id WHERE smp_student.id=?");
		$rs = self::$ADODB->Execute($selectStmt, array($studentId));
		$row = $rs->FetchRow(); 
		return (is_array($row) ? self::doCreateObject($row) : null);
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