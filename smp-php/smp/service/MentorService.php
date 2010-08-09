<?php
/**
 * Created at 09/08/2010 2:07:25 PM
 * smp_service_MentorService
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('Structures/DataGrid.php');
require_once('smp/base/ApplicationRegistry.php');
require_once('PEAR.php');
require_once('smp/util/OptionProvider.php');
class smp_service_MentorService {

	/**
	 * This method return all student by status *Mentor* .
	 * 
	 * @return Structures_DataGrid $datagrid
	 */
	function getAllMentorDataGrid() {
		$datagrid =& new Structures_DataGrid(5);
		$options = array('dsn' => smp_base_ApplicationRegistry::getMDB2DSN());
		$options['generate_columns'] = true;
		$options['fields'] = array ('firstname', 'lastname', 'course', 'gender', 'study_mode', 'account_status');			 
		$options['labels'] = array ('firstname' => 'First Name',
									'lastname' => 'Last Name',
									'course' => 'Course',
									'gender' => 'Gender',
									'study_mode' => 'Study Mode',
									'account_status' => 'STATUS');
		$query = 'SELECT * FROM smp_student WHERE account_status="'.Constants::AS_NEW_MENTOR.'" or account_status="'.Constants::AS_TRAINED_MENTOR.'" or account_status="'.Constants::AS_MATCHED_MENTOR.'"';
		$test = $datagrid->bind($query, $options);
		if (PEAR::isError($test)) {
			throw new Exception("DataGrid binding faild.");
		}
		return $datagrid;
	}
}