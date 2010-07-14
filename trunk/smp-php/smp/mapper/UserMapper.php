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
require_once('smp/mapper/LogMapper.php');
class smp_mapper_UserMapper extends smp_mapper_Mapper {
	protected $logMapper;
	
	function __construct() {
		parent::__construct();
		$this->selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_user WHERE username=?");
		$this->updateStmt = self::$ADODB->Prepare("UPDATE smp_user SET password=?, WHERE id=?");
		$this->insertStmt = self::$ADODB->Prepare("INSERT into smp_user (username, password, scu_email) values(?,?,?) ");
		$this->logMapper = new smp_mapper_LogMapper();
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
			$this->logMapper->save(new smp_domain_Log("user.save", "User save failed, message:".self::$ADODB->ErrorMsg()));
			return null;
		} else {
			$this->logMapper->save(new smp_domain_Log("user.save", "User saved successfully, user:".$user));
			return self::findByUsername($user->getUsername());
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