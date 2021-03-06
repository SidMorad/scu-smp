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

include("smp/view/search/mentorSearchPanel.php");

$datagrid =& $request->getDatagrid();
$datagrid = smp_util_DatagridUtil::formatColumn('id', $datagrid);

// use Formatter to edit generated data
$studyModeColumn =& $datagrid->getColumnByField('study_mode');
//$studyModeColumn->setFormatter('formatStudyMode');
$courseIdColumn =& $datagrid->getColumnByField('course_id');
$courseIdColumn->setFormatter('formatCourseId');
$accountStatusColumn =& $datagrid->getColumnByField('mentee_limit');
$accountStatusColumn->setFormatter('printMenteeLimitTextbox');

$datagrid->addColumn(new Structures_DataGrid_Column('&nbsp;', null, null, array('width' => '20%'), null, 'printUpdateButton()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function formatStudyMode($params){
    $key = $params['record']['study_mode'];
    return VH::getValueFromFixArray('study_mode', $key);
}
function formatCourseId($params){
    $id = $params['record']['course_id'];
    return VH::getValueFromDynamicArray('course', $id);
}
function printUpdateButton($params) {
	$formBuilder = new smp_util_FormBuilder();
	$formBuilder->setIndent("			");
    $id = $params['record']['id'];
	$formString = $formBuilder->button('updateButton'.$id, 'update', 'submit', $id, null);
	$formString .= $formBuilder->close();
    return $formString;
}
function printMenteeLimitTextbox($params) {
	$formBuilder = new smp_util_FormBuilder();
	$formBuilder->setIndent("			");
    $id = $params['record']['id'];
	$fullName = $params['record']['firstname'] . " " . $params['record']['lastname'];
	$menteeLimit = $params['record']['mentee_limit'];
	$formString = $formBuilder->open('updateForm', null, $_SERVER['REQUEST_URI']);
	$formString .= $formBuilder->textBox('menteeLimit'.$id, '',$menteeLimit, $id, NULL,'smallinput',1);
    $formString .= $formBuilder->hidden('mentorId', $id);
    $formString .= $formBuilder->hidden('fullName', $fullName);
    $formString .= $formBuilder->hidden(Constants::ACTION, Constants::ACTION_UPDATE);
	return $formString;
}
function format_id($params) {
	$id = $params['record']['id'];
	return "<a href=\"index.php?cmd=mentor/showMentor&id=$id\">$id</a>";
}
