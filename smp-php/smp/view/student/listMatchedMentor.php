<?php
/**
 * Created at 26/07/2010 9:48:39 AM
 * smp/view/student/listMatchedMentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br><h1>List of Matched Mentors</h1><br>\r\n";

include("smp/view/search/mentorSearchPanel.php");
$datagrid=&$request->getDatagrid();
$datagrid = smp_util_DatagridUtil::formatColumn('id', $datagrid);

//use Formatter to edit generated data
$studyModeColumn=$datagrid->getColumnByField('study_mode');
$studyModeColumn->setFormatter('formatStudyMode');
//format the gender column form f/m to Female/Male
$genderColumn=$datagrid->getColumnByField('gender');
$genderColumn->setFormatter('formatGender');
$courseIdColumn =& $datagrid->getColumnByField('course_id');
$courseIdColumn->setFormatter('formatCourseId');

$datagrid->addColumn(new Structures_DataGrid_Column('Mentees / Limit',null,null,array('width'=>'20%'),null,'printMenteesNumber()'));
$datagrid->addColumn(new Structures_DataGrid_Column('Mark as Expired',null,null,array('width'=>'20%'),null,'printMarkAsExpired()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table,smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function formatGender($params){
	$key=$params['record']['gender'];
	return VH::getValueFromFixArray('gender', $key);
}
function formatStudyMode($params){
	$key=$params['record']['study_mode'];
	return VH::getValueFromFixArray('study_mode', $key);
}
function formatCourseId($params){
	$id = $params['record']['course_id'];
	return VH::getValueFromDynamicArray('course', $id);
}
function printMenteesNumber($params){
	$mentorId = $params['record']['id'];
	$menteeLimit = $params['record']['mentee_limit'];
	$menteeCount = $params['record']['mentee_count'];
	if($menteeCount > 0){
		$menteeCount="<a href=\"index.php?cmd=student/showStudentMentorMentees&mentorId=".$mentorId."\">".$menteeCount."</a>";
	}
	return $menteeCount. "&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;"."<span style=\"color:red\">$menteeLimit</span>";
}
function format_id($params) {
	$id = $params['record']['id'];
	return "<a href=\"index.php?cmd=mentor/showMentor&id=$id\">$id</a>";
}

function printMarkAsExpired($params){
	$mentorId = $params['record']['id'];
	return "<a href=\"index.php?cmd=mentor/expireMentorForm&amp;mentorId=". $mentorId ."\" onclick=\"return confirmSubmit()\">Mark as Expired</a>";
}