<?php
/**
 * Created at 26/07/2010 9:25:44 AM
 * smp/view/student/listMatchedMentee.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/OptionProvider.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br><h1>List of Matched Mentees</h1><br>\r\n";

include("smp/view/search/menteeSearchPanel.php");
$datagrid=&$request->getDatagrid();

//use Formatter to edit generated data
$studyModeColumn=&$datagrid->getColumnByField('study_mode');
$studyModeColumn->setFormatter('formatStudyMode');
//format the gender column form f/m to Female/Male
$genderColumn=$datagrid->getColumnByField('gender');
$genderColumn->setFormatter('formatGender');

$datagrid->addColumn(new Structures_DataGrid_Column("Mentor", null,null, array('width'=>'20%'),null,'printMentorOfMentee()'));

$table=smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table,smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function formatStudyMode($params){
	$key = $params['record']['study_mode'];
	return VH::getValueFromFixArray('study_mode',$key);
}
function formatGender($params){
	$key=$params['record']['gender'];
	return VH::getValueFromFixArray('gender', $key);
}
function formatCourseId($params){
    $id = $params['record']['course_id'];
    return VH::getValueFromDynamicArray('course', $id);
}
function printMentorOfMentee($params){
	$menteeId=$params['record']['id'];
	$mentorLastname=$params['record']['mentor_lastname'];
	return "<a href=\"index.php?cmd=student/showStudentMenteeMentor&menteeId=".$menteeId."\">".$mentorLastname."</a>";
}
//<a href=\"index.php?cmd=student/showStudentMenteeMentor&menteeId=".$mentee->getId()."\">".$mentee->getMentor()->getStudent()->getFirstname()." ".$mentee->getMentor()->getStudent()->getLastname()."</a>