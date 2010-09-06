<?php
/**
 * Created at 23/07/2010 12:57:58 PM
 * smp/view/mentee/listAllMentee.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/OptionProvider.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br><h1>List of Mentees</h1><br>\r\n";

include("smp/view/search/menteeSearchPanel.php");

$datagrid = $request->getDatagrid();

$datagrid = smp_util_DatagridUtil::formatColumn('id', $datagrid);
//use Formatter to edit generated data
$studyModeColumn =& $datagrid->getColumnByField('study_mode');
$studyModeColumn->setFormatter('formatStudyMode');
$studyModeColumn =& $datagrid->getColumnByField('course_id');
$studyModeColumn->setFormatter('format_course_id');
function formatStudyMode($params){
	$key=$params['record']['study_mode'];
	return VH::getValueFromFixArray('study_mode', $key);
}
//format the gender column form f/m to Female/Male
$genderColumn = $datagrid->getColumnByField('gender');
$genderColumn->setFormatter('formatGender');
function formatGender($params){
	$key=$params['record']['gender'];
	return VH::getValueFromFixArray('gender', $key);
}

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');
function format_course_id($params){
    $key = $params['record']['course_id'];
    return VH::getValueFromDynamicArray('course', $key);
}
function format_id($params) {
	$id = $params['record']['id'];
	return "<a href=\"index.php?cmd=mentee/showMentee&id=$id\">$id</a>";
}