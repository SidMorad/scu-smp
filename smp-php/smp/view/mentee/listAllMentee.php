<?php
/**
 * Created at 23/07/2010 12:57:58 PM
 * smp/view/mentee/listAllMentee.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/view/ViewHelper.php');
require_once('smp/util/DatagridUtil.php');
$request=VH::getRequest();
$datagrid=& $request->getDatagrid();
//use Formatter to edit generated data
$datagrid = smp_util_DatagridUtil::formatColumn('study_mode', $datagrid);
$datagrid = smp_util_DatagridUtil::formatColumn('course_id', $datagrid);
$datagrid = smp_util_DatagridUtil::formatColumn('gender', $datagrid);

if(is_null($request->getProperty('output_format'))){
	include('smp/view/common/header.php');
	$datagrid = smp_util_DatagridUtil::formatColumn('id', $datagrid);
	$datagrid->addColumn(new Structures_DataGrid_Column('Mark as Expired',null,null,array('width'=>'15%'),null,'printMarkAsExpired()'));
	
	$indent = "				";
	print $indent."<br><h1>List of Mentees</h1><br>\r\n";
	
	include("smp/view/search/menteeSearchFullPanel.php");
	
	$table = smp_util_DatagridUtil::getCustomHtmlTable();
	
	$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());
	
	print $table->toHtml();
	$datagrid->render(DATAGRID_RENDER_PAGER);
	
	print $indent. "<br />\r\n";
	print $indent. "<div style=\"clear:both;padding-left:800px;\">\r\n";
	print $indent. "	<a href=\"index.php?cmd=mentee/listAllMentee&output_format=CSV\">\r\n";//todo create the functions
	print $indent. "	<img src=\"static/images/csv.png\">\r\n";
	print $indent. "	</a>\r\n";
	print $indent. "	<span>&nbsp; | &nbsp;</span>\r\n";
	print $indent. "	<a href=\"index.php?cmd=mentee/listAllMentee&output_format=XLS\">\r\n";//todo create the functions
	print $indent. "	<img src=\"static/images/xls.png\">\r\n";
	print $indent. "	</a>\r\n";
	print $indent. "</div>\r\n";
	include('smp/view/common/footer.php');
	
}else if(!is_null($request->getProperty('output_format')) && $request->getProperty('output_format')=='XLS'){
	$datagrid->render(DATAGRID_RENDER_XLS);
}else if(!is_null($request->getProperty('output_format')) && $request->getProperty('output_format')=='CSV'){
	$datagrid->render(DATAGRID_RENDER_CSV);
}

function printMarkAsExpired($params){
	$menteeId = $params['record']['id'];
	$expired = $params['record']['expired'];
	if ($expired) {
		return "<a href=\"index.php?cmd=mentee/undoExpireMenteeForm&amp;menteeId=". $menteeId ."&amp;next=mentee/listAllMentee\" onclick=\"return confirmSubmit()\">Mark as Not Expired</a>";
	} else {
		return "<a href=\"index.php?cmd=mentee/expireMenteeForm&amp;menteeId=". $menteeId ."&amp;next=mentee/listAllMentee\" onclick=\"return confirmSubmit()\">Mark as Expired</a>";
	}
}
function format_course_id($params){
	$key = $params['record']['course_id'];
	return VH::getValueFromDynamicArray('course', $key);
}
function format_id($params) {
	$id = $params['record']['id'];
	return "<a href=\"index.php?cmd=mentee/showMentee&id=$id\">$id</a>";
}
function format_study_mode($params){
	$key=$params['record']['study_mode'];
	return VH::getValueFromFixArray('study_mode', $key);
}
function format_gender($params){
	$key=$params['record']['gender'];
	return VH::getValueFromFixArray('gender', $key);
}