<?php
/**
 * Created at 03/08/2010 9:06:52 PM
 * smp_view_datasource_ListMentorDataSource
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('Structures/DataGrid/DataSource.php');
require_once('library/adodb511/adodb.inc.php');
require_once('smp/base/ApplicationRegistry.php');
class smp_view_datasource_ListMentorDataSource extends Structures_DataGrid_DataSource {
	var $db;
	var $orderBy = '';
	
	function smp_view_datasource_ListMentorDataSource() {
		$dsn = smp_base_ApplicationRegistry::getDSN();
		$this->db = NewADOConnection($dsn);
	}
	
	function count() {
		$selectStmt = $this->db->Prepare("SELECT * FROM smp_student");
		$rs = $this->db->Execute($selectStmt);
		return $rs->RecordCount();
	}
	function sort($sortSpec, $sortDir = 'ASC') {
		$this->orderBy = "ORDER BY $sortSpec $sortDir";
	}
	function &fetch($offset = 0, $len = null) {
		$limit = is_null($len) ? "LIMIT $offset,1000" : "LIMIT $offset,$len";
		
		$query = "SELECT * FROM smp_student";
		$query .= $this->orderBy . " $limit";
		$selectStmt = $this->db->Prepare($query);
		return $this->db->Execute($selectStmt);
		$list = array();
		while (!$rs->EOF) {
			$list[] = $rs->FetchRow();
			$rs->MoveNext();
		} 
		return $list;
	}	

}