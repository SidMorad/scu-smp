<?php
/**
 * Created at 19/07/2010 9:59:02 AM
 * smp/view/student/listAllMentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/view/ViewHelper.php');
require_once('smp/util/DatagridUtil.php');
$request = VH::getRequest();
$datagrid =& $request->getDatagrid();
// use Formatter to edit generated data
$datagrid = smp_util_DatagridUtil::formatColumn('study_mode', $datagrid);
$datagrid = smp_util_DatagridUtil::formatColumn('gender', $datagrid);
$datagrid = smp_util_DatagridUtil::formatColumn('course_id', $datagrid);

if (is_null($request->getProperty('output_format'))) {
	include('smp/view/common/header.php');
	$datagrid = smp_util_DatagridUtil::formatColumn('id', $datagrid);
	
	$indent = "				";
	print $indent."<br/><h1>List of All Mentors</h1><br/>\r\n";
	
	include("smp/view/search/mentorSearchFullPanel.php");
	
	$table = smp_util_DatagridUtil::getCustomHtmlTable();
	
	$datagrid->fill($table,smp_util_DatagridUtil::getRenderOptions());
	
	print $table->toHtml();
	$datagrid->render(DATAGRID_RENDER_PAGER);
	
	print $indent. "<br/>\r\n";
	print $indent. "<div style=\"clear:both;padding-left:800px;\">\r\n";
	print $indent. "	<a href=\"index.php?cmd=mentor/listAllMentor&output_format=CSV\">\r\n";
	print $indent. "	<img src=\"static/images/csv.png\" >\r\n";
	print $indent. "	</a>\r\n";
	print $indent. "	<span>&nbsp; | &nbsp;</span>\r\n";
	print $indent. "	<a href=\"index.php?cmd=mentor/listAllMentor&output_format=XLS\">\r\n";
	print $indent. "	<img src=\"static/images/xls.png\" >\r\n";
	print $indent. "	</a>\r\n";
	print $indent. "</div>\r\n";
	include('smp/view/common/footer.php');

}else if (!is_null($request->getProperty('output_format')) && $request->getProperty('output_format') == 'XLS') {
	$datagrid->render(DATAGRID_RENDER_XLS);
} else if (!is_null($request->getProperty('output_format')) && $request->getProperty('output_format') == 'CSV'){
	$datagrid->render(DATAGRID_RENDER_CSV);
}

function format_gender($params){
    $key = $params['record']['gender'];
    return VH::getValueFromFixArray('gender', $key);
}
function format_study_mode($params){
    $key = $params['record']['study_mode'];
    return VH::getValueFromFixArray('study_mode', $key);
}	
function format_course_id($params){
    $key = $params['record']['course_id'];
    return VH::getValueFromDynamicArray('course', $key);
}
function format_id($params) {
	$id = $params['record']['id'];
	return "<a href=\"index.php?cmd=mentor/showMentor&id=$id\">$id</a>";
}

	