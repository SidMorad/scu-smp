<?php
/**
 * Created at 21/08/2010 12:51:54 PM
 * smp/view/search/mentorSearchPanel.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/util/FormBuilder.php');

$indent = "				";

print $indent . "<a onClick=\"return toggleMe('mentorSearchDiv')\">\r\n";
print $indent . "	<div class=\"searchHeader\">Mentor Search Panel</div>\r\n"; 
print $indent . "</a>\r\n"; 

print $indent . "<div id=\"mentorSearchDiv\" class=\"searchPanel\">\r\n"; 
$searchForm = new smp_util_FormBuilder();
$searchForm->setIndent($indent. "	");

if ($searchForm->isPost()) {
	$searchForm->setValues($request->getProperties());
}
if (!is_null($request->getSearchEntity())) {
	$mentor = $request->getSearchEntity();
	$searchForm->setValue('firstname', $mentor->getStudent()->getFirstname());
	$searchForm->setValue('lastname', $mentor->getStudent()->getLastname());
	$searchForm->setValue('studentNumber', $mentor->getStudent()->getStudentNumber());
	$searchForm->setValue('courseId', $mentor->getStudent()->getCourseId());
	$searchForm->setValue('gender', $mentor->getStudent()->getGender());
	$searchForm->setValue('studyMode', $mentor->getStudent()->getStudyMode());
}

print $searchForm->open('mentorSearchForm', "form_container", $_SERVER['REQUEST_URI']);
print $searchForm->hidden(Constants::ACTION, Constants::ACTION_SEARCH);
print $searchForm->label('firstname','Firstname:', 'grid_1');
print $searchForm->textBox('firstname', null, null,1,'grid_2','smallinput');
print $searchForm->label('lastname','Lastname:', 'grid_1');
print $searchForm->textBox('lastname', null, null,1,'grid_2','smallinput');
print $searchForm->label('studentNumber','StudentNumber:', 'grid_1');
print $searchForm->textBox('studentNumber', null, null,1,'grid_4','smallinput');
//print $searchForm->button('clearButton', 'Clear', 'button', 1,'grid_1', 'button', array('onClick'=>'clearForm(this.form)'));
print $searchForm->label('courseId','Course:', 'grid_1');
print $searchForm->selectBox('courseId', null, null,1,'grid_2', VH::getDynamicArray('course', true),'smallinput');
print $searchForm->label('gender','Gender:', 'grid_1');
print $searchForm->selectBox('gender', null, null,1,'grid_2', VH::getFixArray('gender', true),'smallinput');
print $searchForm->label('studyMode','StudyMode:', 'grid_1');
print $searchForm->selectBox('studyMode', null, null,1,'grid_3', VH::getFixArray('study_mode', true),'input');
print $searchForm->button('searchButton', 'Search', 'submit', 1,'grid_1');
print $searchForm->close();
print $indent . "</div>\r\n"; 