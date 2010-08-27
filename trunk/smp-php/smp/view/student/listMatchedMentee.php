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