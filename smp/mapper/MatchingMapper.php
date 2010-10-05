<?php
/**
 * Created at 15/08/2010 10:07:12 PM
 * smp_mapper_MatchingMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
class smp_mapper_MatchingMapper extends smp_mapper_Mapper {

	function __construct($adodb = null) {
		parent::__construct($adodb);
	}

	function connectMenteeToMentor($menteeId, $mentorId) {
		self::$ADODB->StartTrans();
		$msg = "";
		
		$insertStmt = self::$ADODB->Prepare("INSERT INTO smp_mentor_mentee(mentor_id, mentee_id, expired) VALUES(?,?,?)");
		$ok = self::$ADODB->Execute($insertStmt, array($mentorId, $menteeId, false));
		if (! $ok) {
			$msg = self::$ADODB->ErrorMsg();
			$ok = true;
		}
		
		$updateMenteeStmt = self::$ADODB->Prepare("UPDATE smp_mentee SET matched=? WHERE id=?");
		$ok = self::$ADODB->Execute($updateMenteeStmt, array(true, $menteeId));
		if (! $ok) {
			$msg = self::$ADODB->ErrorMsg();
			$ok = true;
		}

		$updateMentorStmt = self::$ADODB->Prepare("UPDATE smp_mentor SET matched=? WHERE id=?");
		$ok = self::$ADODB->Execute($updateMentorStmt, array(true, $mentorId));
		if (! $ok) {
			$msg = self::$ADODB->ErrorMsg();
			$ok = true;
		}
		
		$ok = self::$ADODB->CompleteTrans();
	 	$this->logger->save(new smp_domain_Log("mentor/mentee.update", "Updating Mentor/Mentee info, message:" . $msg));
		
		return $ok;
	}

	
	function targetClass() {}
	function doCreateObject(array $array){}
	function doInsert(smp_domain_DomainObject $obj){}
}