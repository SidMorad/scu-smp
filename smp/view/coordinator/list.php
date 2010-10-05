<?php
/**
 * Created at 01/10/2010 11:34:51 AM
 * smp/view/coordinator/list.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br><h1>Coordinator List</h1><br>\r\n";
print $indent."<a href=\"index.php?cmd=coordinator/form\">Add new Coordinator<img src=\"static/images/add.png\" alt=\"new\" title=\"New\"></a>\r\n";

$datagrid = $request->getDatagrid();

$datagrid->addColumn(new Structures_DataGrid_Column('&nbsp;', null, null, array('width' => '20%'), null, 'icons()'));
$datagrid = smp_util_DatagridUtil::formatColumn('username', $datagrid);
$datagrid->removeColumn($datagrid->getColumnByField('user_id'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table,smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function format_username($params) {
	$userId = $params['record']['user_id'];
	$username = $params['record']['username'];
	return "<a href=\"index.php?cmd=user/view&id=$userId\">$username</a>\r\n";
}
function icons($params) {
	$id = $params['record']['id'];
	$html = "<a href=\"index.php?cmd=coordinator/edit&id=$id\"><img src=\"static/images/update.png\" alt=\"update\" title=\"Update\"></a>\r\n";
	$html .= "&nbsp; | &nbsp;";
	$html .="<a href=\"index.php?cmd=coordinator/delete&id=$id\" onClick=\"return confirmSubmit()\"><img src=\"static/images/delete.png\" alt=\"delete\" title=\"Delete\"></a>\r\n";
	return $html;
}
