<?php
/**
 * Created at 21/07/2010 12:36:38 PM
 * smp_mapper_ContactMapper
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/mapper/Mapper.php');
require_once('smp/domain/Contact.php');
class smp_mapper_ContactMapper extends smp_mapper_Mapper {

	function __construct($adodb = null) {
		parent::__construct($adodb);
		$this->insertStmt = self::$ADODB->Prepare("INSERT INTO smp_contact(address, city, postcode, phone_home, phone_work, mobile, email, user_id, student_id) values(?,?,?,?,?,?,?,?,?)");
	}
	
	protected function targetClass() {
		return "smp_domain_Contact";
	}
	
	protected function doCreateObject(array $array) {
		$contact = new smp_domain_Contact();
		$contact->setId($array['id']);
		$contact->setAddrees($array['address']);	
		$contact->setCity($array['city']);	
		$contact->setPostcode($array['postcode']);	
		$contact->setPhoneHome($array['phone_home']);	
		$contact->setPhoneWork($array['phone_work']);	
		$contact->setMobile($array['mobile']);	
		$contact->setEmail($array['email']);	
		$contact->setUserId($array['user_id']);	
		$contact->setStudentId($array['student_id']);
		return $contact;	
	}
	
	protected function doInsert(smp_domain_DomainObject $obj) {
		$values = array($obj->getAddress(), $obj->getCity(), $obj->getPostcode(), $obj->getPhoneHome(), $obj->getPhoneWork(), $obj->getMobile(), $obj->getEmail(), $obj->getUserId(), $obj->getStudentId());
		return self::$ADODB->Execute($this->insertStmt, $values);
	}
	
	function save(smp_domain_Contact $contact) {
		$rs = self::doInsert($contact);
		if ($rs === false) {
			$this->logger->save(new smp_domain_Log("contact.save", "Contact save failed, message:".self::$ADODB->ErrorMsg()));
			return null;
		} else {
			$contact->setId(self::$ADODB->Insert_ID());	
			$this->logger->save(new smp_domain_Log("contact.save", "Contact save Successfully, contact:". $contact));
			return $contact;
		}
	}

	function findContactWithUserId($userId) {
		$findStmt = self::$ADODB->Prepare("SELECT * FROM smp_contact WHERE user_id=?");
		$rs = self::$ADODB->Execute($findStmt, array($userId));
		return ($rs ? self::doCreateObject($rs->FetchRow()) : null);
	}
	
}