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

include("smp/view/Search/menteeSearchPanel.php");

$datagrid=&$request->getDatagrid();

//use Formatter to edit generated data
$studyModeColumn=&$datagrid->getColumnByField('study_mode');
$studyModeColumn->setFormatter('formatStudyMode');

$table=smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function formatStudyMode($params){
	$key=$params['record']['study_mode'];
	return VH::getValueFromFixArray('study_mode', $key);
}