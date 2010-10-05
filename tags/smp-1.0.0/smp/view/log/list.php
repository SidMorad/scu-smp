<?php
/**
 * Created at 21/09/2010 4:53:19 PM
 * smp/view/log/list.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/DatagridUtil.php');

print "<br/><h1>&nbsp; Log List</h1><br/>";

$datagrid = $request->getDatagrid();
if ($datagrid) {
	$datagrid = smp_util_DatagridUtil::formatColumn('user_id', $datagrid);
}

$table = smp_util_DatagridUtil::getCustomHtmlTable();
$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function format_user_id($params) {
	$userId = $params['record']['user_id'];
	if (isset($userId)) {
		return "<a href=\"index.php?cmd=user/view&id=$userId\">$userId</a>";
	} else {
		return "";
	}
}