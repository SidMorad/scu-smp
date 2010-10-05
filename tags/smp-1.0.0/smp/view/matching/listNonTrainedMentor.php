<?php
/**
 * Created at 26/07/2010 10:29:14 AM
 * smp/view/matching/listNonTrainedMentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 *  @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/OptionProvider.php');
require_once('smp/util/FormBuilder.php');
require_once('smp/util/DatagridUtil.php');


$indent = "				";
print $indent."<br><h1>List of Non Trained Mentors</h1><br>\r\n";

include("smp/view/search/mentorSearchPanel.php");

$datagrid=& $request->getDatagrid();
$datagrid = smp_util_DatagridUtil::formatColumn('id', $datagrid);

//use Formatter to edit generated data
$studyModeColumn=& $datagrid->getColumnByField('study_mode');
$studyModeColumn->setFormatter('formatStudyMode');
$courseColumn=& $datagrid->getColumnByField('course_id');
$courseColumn->setFormatter('formatCourse');
//format the gender column form f/m to Female/Male
$genderColumn=$datagrid->getColumnByField('gender');
$genderColumn->setFormatter('formatGender');

$datagrid->addColumn(new Structures_DataGrid_Column('&nbsp;',null,null,array('width'=>'20%'),null,'printMarkAsTrained()'));

$table=smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

//$list = $request->getList();
//if (! empty($list)) {
//	print $indent."<table class=\"table\">\r\n";
//	print $indent."	<th>Id</th>\r\n";	
//	print $indent."	<th>Firstname</th>\r\n";	
//	print $indent."	<th>Lastname</th>\r\n";	
//	print $indent."	<th>Gender</th>\r\n";	
//	print $indent."	<th>Student Number</th>\r\n";	
//	print $indent."	<th>Course</th>\r\n";	
//	print $indent."	<th>Study Mode</th>\r\n";	
//	print $indent."	<th>Age Range</th>\r\n";
//	print $indent."	<th>&nbsp;</th>\r\n";			
//	foreach ($list as $mentor) {
//	print $indent."	<tr>\r\n";
//		print $indent."		<td>".$mentor->getStudent()->getId()."</td>\r\n";
//		print $indent."		<td>".$mentor->getStudent()->getFirstname()."</td>\r\n";
//		print $indent."		<td>".$mentor->getStudent()->getLastname()."</td>\r\n";
//		print $indent."		<td>".VH::getValueFromFixArray('gender', $mentor->getStudent()->getGender())."</td>\r\n";
//		print $indent."		<td>".$mentor->getStudent()->getStudentNumber()."</td>\r\n";
//		print $indent."		<td>".VH::getValueFromDynamicArray('course', $mentor->getStudent()->getCourseId())."</td>\r\n";
//		print $indent."		<td>".VH::getValueFromFixArray('study_mode', $mentor->getStudent()->getStudyMode())."</td>\r\n";
//		print $indent."		<td>".VH::getValueFromFixArray('age_range', $mentor->getStudent()->getAgeRange())."</td>\r\n";
//		print $indent."		<td><a href=\"index.php?cmd=matching/activeMentorForm&amp;mentorId=". $mentor->getId() ."\" onclick=\"return confirmSubmit()\">Mark as Trained</a></td>\r\n";
//	print $indent."	</tr>\r\n";
//	}
//	print $indent."</table>\r\n";
//} else {
//	print $indent. "<p>No Non-Trained Mentor founded.</p>";
//}

include('smp/view/common/footer.php');

function printMarkAsTrained($params){
	$mentorId = $params['record']['id'];
	return "<a href=\"index.php?cmd=matching/activeMentorForm&amp;mentorId=". $mentorId ."\" onclick=\"return confirmSubmit()\">Mark as Trained</a>";
}
function formatGender($params){
	$key=$params['record']['gender'];
	return VH::getValueFromFixArray('gender', $key);
}
function formatStudyMode($params){
    $key = $params['record']['study_mode'];
    return VH::getValueFromFixArray('study_mode', $key);
}
function formatCourse($params){
    $id = $params['record']['course_id'];
    return VH::getValueFromDynamicArray('course', $id);
}
function format_id($params) {
	$id = $params['record']['id'];
	return "<a href=\"index.php?cmd=mentor/showMentor&id=$id\">$id</a>";
}