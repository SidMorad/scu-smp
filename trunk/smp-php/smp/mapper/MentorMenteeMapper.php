<?php
/**
 * Created at 06/08/2010 6:19:10 PM
 * smp_mapper_MentorMenteeMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
require_once('smp/domain/MentorMentee.php');
require_once('smp/util/DateUtil.php');
class smp_mapper_MentorMenteeMapper extends smp_mapper_Mapper {
	
	function __construct($adodb = null) {
		parent::__construct($adodb);
	}
	
	function confirmContactMentee($id) {
		$updateStmt = self::$ADODB->Prepare('UPDATE smp_mentor_mentee SET mentor_contact_confirm=?,mentor_contact_confirm_time=? WHERE id=?');
		$rs = self::$ADODB->Execute($updateStmt, array(true, smp_util_DateUtil::mysqlDate(time()), $id));
		return $rs;
	}
	
	function targetClass() {
		return "smp_domain_MentorMentee";
	}
	
	function doInsert(smp_domain_DomainObject $obj) {}
	
	function doCreateObject(array $array) {
		$obj = new smp_domain_MentorMentee($array['mentor_id'], $array['mentee_id'], $array['create_time'], $array['expired'], $array['id']);
		$obj->setMentorContactConfirm($array['mentor_contact_confirm']);
		$obj->setMentorContactConfirmTime($array['mentor_contact_confirm_time']);
		return $obj;
	}
	
	function findRelationWithMentorId($mentorId) {
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_mentor_mentee WHERE mentor_id=?");
		$rs = self::$ADODB->Execute($selectStmt, array($mentorId));
		$list = array();
		if ($rs) {
			while ($row = $rs->FetchRow()) {
				$list[] = self::doCreateObject($row);
			}
		}
		return $list;
	}

	function findRelationWithMenteeId($menteeId) {
		$selectStmt = self::$ADODB->Prepare("SELECT * FROM smp_mentor_mentee WHERE mentee_id=?");
		$rs = self::$ADODB->Execute($selectStmt, array($menteeId));
		$row = $rs->FetchRow();
		return (is_array($row) ? self::doCreateObject($row) : null);
	}
	
}