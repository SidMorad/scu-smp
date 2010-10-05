<?php
/**
 * Created at 02/10/2010 3:49:01 PM
 * smp/view/search/MenteeSearchExpiredPanel.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/util/FormBuilder.php');

$indent = "				";

print $indent . "<a onClick=\"return toggleMe('menteeSearchDiv')\">\r\n";
print $indent . "	<div class=\"searchHeader\">Mentee Search Panel</div>\r\n"; 
print $indent . "</a>\r\n"; 

print $indent . "<div id=\"menteeSearchDiv\" class=\"searchPanel\">\r\n"; 
$searchForm = new smp_util_FormBuilder();
$searchForm->setIndent($indent. "	");

if ($searchForm->isPost()) {
	$searchForm->setValues($request->getProperties());
}
if (!is_null($request->getSearchEntity())) {
	$mentee = $request->getSearchEntity();
	$searchForm->setValue('firstname', $mentee->getStudent()->getFirstname());
	$searchForm->setValue('lastname', $mentee->getStudent()->getLastname());
	$searchForm->setValue('studentNumber', $mentee->getStudent()->getStudentNumber());
	$searchForm->setValue('courseId', $mentee->getStudent()->getCourseId());
	$searchForm->setValue('gender', $mentee->getStudent()->getGender());
	$searchForm->setValue('studyMode', $mentee->getStudent()->getStudyMode());
	$searchForm->setValue('expired', $mentee->getExpired());	
}

print $searchForm->open('menteeSearchForm', "form_container", $_SERVER['REQUEST_URI']);
print $searchForm->hidden(Constants::ACTION, Constants::ACTION_SEARCH);
print $searchForm->label('firstname','Firstname:', 'grid_1');
print $searchForm->textBox('firstname', null, null,1,'grid_2','smallinput');
print $searchForm->label('lastname','Lastname:', 'grid_1');
print $searchForm->textBox('lastname', null, null,1,'grid_2','smallinput');
print $searchForm->label('studentNumber','StudentNumber:', 'grid_1');
print $searchForm->textBox('studentNumber', null, null,1,'grid_1','smallinput');
print $searchForm->label("expired", "Expired:", "grid_1");
print $searchForm->checkBox("expired", "", 1,"grid_1");
print $searchForm->button('clearButton', 'Clear', 'button', 1,'grid_1', 'button', array('onClick'=>'clearForm(this.form)'));

print $searchForm->label('courseId','Course:', 'grid_1');
print $searchForm->selectBox('courseId', null, null,1,'grid_2', VH::getDynamicArray('course', true),'smallinput');
print $searchForm->label('gender','Gender:', 'grid_1');
print $searchForm->selectBox('gender', null, null,1,'grid_2', VH::getFixArray('gender', true),'smallinput');
print $searchForm->label('studyMode','StudyMode:', 'grid_1');
print $searchForm->selectBox('studyMode', null, null,1,'grid_3', VH::getFixArray('study_mode', true),'input');

print $searchForm->button('searchButton', 'Search', 'submit', 1,'grid_1');
print $searchForm->close();
print $indent . "</div>\r\n"; 