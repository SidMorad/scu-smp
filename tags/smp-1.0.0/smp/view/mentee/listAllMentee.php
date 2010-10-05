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

include("smp/view/search/menteeSearchFullPanel.php");

$datagrid = $request->getDatagrid();

$datagrid = smp_util_DatagridUtil::formatColumn('id', $datagrid);
//use Formatter to edit generated data
$datagrid = smp_util_DatagridUtil::formatColumn('study_mode', $datagrid);
$datagrid = smp_util_DatagridUtil::formatColumn('course_id', $datagrid);
$datagrid = smp_util_DatagridUtil::formatColumn('gender', $datagrid);

$datagrid->addColumn(new Structures_DataGrid_Column('Mark as Expired',null,null,array('width'=>'15%'),null,'printMarkAsExpired()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();
$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

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