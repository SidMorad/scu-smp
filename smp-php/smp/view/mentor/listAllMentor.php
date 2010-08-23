<?php
/**
 * Created at 19/07/2010 9:59:02 AM
 * smp/view/student/listAllMentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('HTML/Table.php');
require_once('smp/util/OptionProvider.php');

$indent = "				";
print $indent."<br/><h1>List of All Mentors</h1><br/>\r\n";

include("smp/view/search/mentorSearchPanel.php");

$datagrid =& $request->getDatagrid();

// use Formatter to edit generated data
$studyModeColumn =& $datagrid->getColumnByField('study_mode');
$studyModeColumn->setFormatter('formatStudyMode');
//$accountStatusColumn =& $datagrid->getColumnByField('account_status');
//$accountStatusColumn->setFormatter('formatAccountStatus');

// Define the Look and Feel
$tableAttribs = array(
    'class' => 'table'
);
$rendererOptions = array(
    'sortIconASC' => '&uArr;',
    'sortIconDESC' => '&dArr;'
);

// Create a HTML_Table
$table = new HTML_Table($tableAttribs);

$datagrid->fill($table, $rendererOptions);

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function formatStudyMode($params){
    $key = $params['record']['study_mode'];
    return VH::getValueFromFixArray('study_mode', $key);
}
//function formatAccountStatus($params){
//    $key = $params['record']['account_status'];
//    return VH::getValueFromFixArray('account_status', $key);
//}