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
		$this->insertStmt = self::$ADODB->Prepare("INSERT into smp_user (username, password, scu_email, picture) values(?,?,?,?) ");
	}
	
	function delete($id) {
		$deleteStmt = self::$ADODB->Prepare("DELETE FROM smp_user WHERE id=?");
		return self::$ADODB->Execute($deleteStmt, array($id));
	}
	
	function update($user) {
		$pictureCriteria = (is_null($user->getPicture()) ? " " : ", picture=?") ;
		$passwordCriteria = (is_null($user->getPassword()) ? " " : ", password=?") ;
		$updateStmt = self::$ADODB->Prepare("UPDATE smp_user SET scu_email=? $pictureCriteria $passwordCriteria WHERE id=?");
		$values = array($user->getScuEmail());
		if (!is_null($user->getPicture())) {
			$values[] = $user->getPicture();			
		}
		if (!is_null($user->getPassword())) {
			$values[] = $user->getPassword();			
		}
		$values[] = $user->getId();
		
		$rs = self::$ADODB->Execute($updateStmt, $values);
		return $rs;
	}
	
	protected function doCreateObject(array $array) {
		$obj = new smp_domain_User($array['id'], $array['username'], $array['password'],$array['scu_email']);
		$obj->setPicture($array['picture']);
		return $obj;
	}
	
	protected function doInsert(smp_domain_DomainObject $object) {
		$values = array($object->getUsername(), $object->getPassword(), $object->getScuEmail(), $object->getPicture());
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
			self::$ADODB->Execute($stmt, array($userId, $roleId));
		}
		return true;
	}

	function saveUserCampuses($userId, $arrCampusIds) {
		self::deleteUserCampuses($userId);
		$stmt = self::$ADODB->Prepare("INSERT INTO smp_user_campus(user_id,campus_id) VALUES(?,?)");
		foreach ($arrCampusIds as $campusId) {
			self::$ADODB->Execute($stmt, array($userId, $campusId));
		}
		return true;
	}	
	
	function deleteUserRoles($userId) {
		$stmt = self::$ADODB->Prepare("DELETE FROM smp_user_role WHERE user_id=?");
		return self::$ADODB->Execute($stmt, array($userId));
	}

	function deleteUserCampuses($userId) {
		$stmt = self::$ADODB->Prepare("DELETE FROM smp_user_campus WHERE user_id=?");
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
		$selectStmt = self::$ADODB->Prepare("SELECT smp_user.id, smp_user.username, smp_user.scu_email, smp_user.password, smp_user.picture FROM smp_user INNER JOIN smp_student ON smp_user.id = smp_student.user_id WHERE smp_student.id=?");
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

	function findUserCampuses(smp_domain_User $user) {
		$selectStmt = self::$ADODB->Prepare("SELECT smp_campus.id FROM smp_campus INNER JOIN smp_user_campus ON smp_campus.id = smp_user_campus.campus_id WHERE smp_user_campus.user_id=?");
		$rs = self::$ADODB->Execute($selectStmt, array($user->getId()));
		while (!$rs->EOF) {
			$user->addToCampuses($rs->fields('id'));
			$rs->MoveNext();
		}
		return $user;
	}
	
}