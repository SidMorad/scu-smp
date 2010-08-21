<?php
/**
 * Created at 20/08/2010 2:28:22 PM
 * smp/view/mentor/listActiveMentor
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include("smp/view/common/header.php");
require_once('smp/util/OptionProvider.php');
require_once('smp/util/FormBuilder.php');	
require_once('smp/util/DatagridUtil.php');	

$indent = "				";
print $indent."<br/><h1>List of Active Mentors</h1><br/>\r\n";

$datagrid =& $request->getDatagrid();

// use Formatter to edit generated data
$studyModeColumn =& $datagrid->getColumnByField('study_mode');
//$studyModeColumn->setFormatter('formatStudyMode');
//$accountStatusColumn =& $datagrid->getColumnByField('account_status');
//$accountStatusColumn->setFormatter('formatAccountStatus');

$datagrid->addColumn(new Structures_DataGrid_Column('Mentee Limit', null, null, array('width' => '20%'), null, 'printMenteeLimitTextbox()'));
$datagrid->addColumn(new Structures_DataGrid_Column('Update', null, null, array('width' => '20%'), null, 'printUpdateButton()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function formatStudyMode($params){
    $key = $params['record']['study_mode'];
    return VH::getValueFromFixArray('study_mode', $key);
}
function printUpdateButton($params) {
	$formBuilder = new smp_util_FormBuilder();
	$formString = $formBuilder->button('updateButton', 'update', 'submit', 2, null);
    $id = $params['record']['id'];
    $formString .= $formBuilder->hidden('mentorId', $id);
    $formString .= $formBuilder->hidden('cmd', 'mentor/listActiveMentor');
    $formString .= $formBuilder->hidden('fullName', $params['record']['firstname'] . " " . $params['record']['lastname']);
	$formString .= $formBuilder->close();
    return $formString;
}
function printMenteeLimitTextbox($params) {
	$formBuilder = new smp_util_FormBuilder();
	$menteeLimit = $params['record']['mentee_limit'];
	$formString = $formBuilder->open('updateForm', null);
	$formString .= $formBuilder->textBox('menteeLimit', '',$menteeLimit, 1, NULL,'smallinput',1);
	return $formString;
}

