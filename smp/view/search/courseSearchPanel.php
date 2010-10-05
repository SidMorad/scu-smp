<?php
/**
 * Created at 13/09/2010 10:59:22 AM
 * smp/view/search/courseSearchPanel.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
require_once('smp/util/FormBuilder.php');

$indent = "				";

print $indent . "<a onClick=\"return toggleMe('courseSearchDiv')\">\r\n";
print $indent . "	<div class=\"searchHeader\">Course Search Panel</div>\r\n"; 
print $indent . "</a>\r\n"; 

print $indent . "<div id=\"courseSearchDiv\" class=\"searchPanel\">\r\n"; 
$searchForm = new smp_util_FormBuilder();
$searchForm->setIndent($indent. "	");

if ($searchForm->isPost()) {
	$searchForm->setValues($request->getProperties());
}
if (!is_null($request->getSearchEntity())) {
	$course = $request->getSearchEntity();
	$searchForm->setValue('id', $course->getId());
	$searchForm->setValue('name', $course->getName());
}

print $searchForm->open('mentorSearchForm', "form_container", $_SERVER['REQUEST_URI']);
print $searchForm->hidden(Constants::ACTION, Constants::ACTION_SEARCH);
print $searchForm->label('id','Id:', 'grid_1');
print $searchForm->textBox('id', null, null,1,'grid_2','smallinput');
print $searchForm->label('name','Name:', 'grid_1');
print $searchForm->textBox('name', null, null,1,'grid_2','smallinput');
print $searchForm->button('searchButton', 'Search', 'submit', 1,'grid_1');
print $searchForm->close();
print $indent . "</div>\r\n"; 