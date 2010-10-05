<?php
/**
 * Created at 23/07/2010 3:11:30 PM
 * smp/view/matching/matchingForm.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/FormBuilder.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";

//print $indent."<br /><h1>Mentee matching form</h1><br/>\r\n";
print $indent."<br/>\r\n";

$mentee = $request->getEntity();

print $indent."<span style=\"padding-left:20px;\">Mentee Name :  <b>". $mentee->getStudent()->getFirstname() ."	". $mentee->getStudent()->getLastname() ."</b></span>\r\n";
print $indent."<span style=\"padding-left:20px;\">Student Number :  <b>". $mentee->getStudent()->getStudentNumber()."</b></span>\r\n";
print $indent."<span style=\"padding-left:20px;\">Gender :  <b>". VH::getValueFromFixArray('gender', $mentee->getStudent()->getGender())."</b></span>\r\n";
print $indent."<span style=\"padding-left:20px;\">Course :  <b>". VH::getValueFromDynamicArray('course', $mentee->getStudent()->getCourseId())."</b></span><br/>\r\n";
print $indent."<span style=\"padding-left:20px;\">Age Range :  <b>". VH::getValueFromFixArray('age_range', $mentee->getStudent()->getAgeRange())."</b></span>\r\n";
print $indent."<span style=\"padding-left:20px;\">Study Mode :  <b>". VH::getValueFromFixArray('study_mode', $mentee->getStudent()->getStudyMode())."</b></span><hr/>\r\n";

// Include Mentor Search Panel
include("smp/view/search/mentorSearchPanel.php");

$matchingForm = new smp_util_FormBuilder();
$matchingForm->setIndent($indent);
print $indent. $matchingForm->open("matchingForm", null, $_SERVER['REQUEST_URI']);
print $matchingForm->hidden(Constants::ACTION, Constants::ACTION_SUBMIT);
print $matchingForm->hidden("menteeId", $mentee->getId());
print $indent ."	</span><hr style=\"border-color:white;\" />\r\n";
print $indent. "	<span style=\"padding-left:20px;\">\r\n" . $matchingForm->button("submit", "Submit", "submit", 0,null, "button", array('onClick'=>'return confirmSubmit()'));
print $indent ."	</span><hr style=\"border-color:white;\" />\r\n";


$datagrid =& $request->getDatagrid();

// use Formatter to edit generated data
$idColumn =& $datagrid->getColumnByField('id');
$idColumn->setFormatter('printMenteeIdRedioBox');
$idColumn =& $datagrid->getColumnByField('course_id');
$idColumn->setFormatter('formatCourseId');
$genderColumn=$datagrid->getColumnByField('gender');
$genderColumn->setFormatter('formatGender');

$datagrid->addColumn(new Structures_DataGrid_Column('Mentees / Limit', null, null, array('width' => '20%'), null, 'printMenteesNumber()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);


print $matchingForm->close();

include('smp/view/common/footer.php');

function printMenteeIdRedioBox($params) {
	$formBuilder = new smp_util_FormBuilder();
	$formBuilder->setIndent("			");
    $id = $params['record']['id'];
    return $formBuilder->redioBox("mentorId", 1, null, array($id=>$id), "redio", null);
}
function printMenteesNumber($params) {
	$mentorId = $params['record']['id'];
	$menteeLimit = $params['record']['mentee_limit'];
	$menteeCount = $params['record']['mentee_count'];
	if ($menteeCount > 0) {
		$menteeCount = "<a href=\"index.php?cmd=student/showStudentMentorMentees&mentorId=".$mentorId."\">".$menteeCount."</a>";
	}
	return $menteeCount . "&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;". "<span style=\"color:red\">$menteeLimit</span>";
} 
function formatCourseId($params) {
    $id = $params['record']['course_id'];
    return VH::getValueFromDynamicArray('course', $id);
}
function formatGender($params){
	$key=$params['record']['gender'];
	return VH::getValueFromFixArray('gender', $key);
}