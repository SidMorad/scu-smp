<?php
/**
 * Created at 23/07/2010 1:56:24 PM
 * smp/view/matching/listNewMentees.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include("smp/view/common/header.php");
require_once('smp/util/OptionProvider.php');
require_once('smp/util/FormBuilder.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br/><h1>List of Not Matched Mentees</h1><br/>\r\n";

include("smp/view/search/menteeSearchPanel.php");

$datagrid =& $request->getDatagrid();

//use Formatter to edit generated data
$studyModeColumn=& $datagrid->getColumnByField('study_mode');
$studyModeColumn->setFormatter('formatStudyMode');
$courseColumn=& $datagrid->getColumnByField('course_id');
$courseColumn->setFormatter('formatCourse');
//format the gender column form f/m to Female/Male
$genderColumn=$datagrid->getColumnByField('gender');
$genderColumn->setFormatter('formatGender');
function formatGender($params){
	$key=$params['record']['gender'];
	return VH::getValueFromFixArray('gender', $key);
}
$datagrid->addColumn(new Structures_DataGrid_Column('&nbsp;', null, null, array('width' => '20%'), null, 'printSelectForMatchingLink()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function printSelectForMatchingLink($params) {
	$menteeId = $params['record']['id'];
	return "<a href=\"index.php?cmd=matching/matchingForm&amp;menteeId=". $menteeId ."\">select for matching</a></td>\r\n";
}
function formatStudyMode($params){
    $key = $params['record']['study_mode'];
    return VH::getValueFromFixArray('study_mode', $key);
}
function formatCourse($params){
    $id = $params['record']['course_id'];
    return VH::getValueFromDynamicArray('course', $id);
}
