<?php
/**
 * Created at 30/08/2010 10:01:02 AM
 * smp/view/mentormentee/listAllMentorMentee.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br/><h1>List of All Mentor&Mentee</h1><br/>\r\n";

$datagrid =& $request->getDatagrid();

// use Formatter to edit generated data
$mccColumn =& $datagrid->getColumnByField('mentor_contact_confirm');
$mccColumn->setFormatter('formatMentorContactConfirm');
$expColumn =& $datagrid->getColumnByField('expired');
$expColumn->setFormatter('formatExpired');
$mriColumn =& $datagrid->getColumnByField('mentor_id');
$mriColumn->setFormatter('formatMentorId');
$mtiColumn =& $datagrid->getColumnByField('mentee_id');
$mtiColumn->setFormatter('formatMenteeId');

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table,smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function formatMentorContactConfirm($params){
    $confirm = $params['record']['mentor_contact_confirm'];
    if ($confirm) {
	    return "<img src=\"static/images/yes.png\" >";
    } else {
    	return "<img src=\"static/images/no.png\" >";
    }
}
function formatExpired($params){
    $expired = $params['record']['expired'];
    if ($expired) {
	    return "Yes";
    } else {
    	return "No";
    }
}
function formatMentorId($params) {
	$mentor = $params['record']['mentor_lastname'];
	return $mentor;
}
function formatMenteeId($params) {
	$mentee = $params['record']['mentee_lastname'];
	return $mentee;
}
