<?php
/**
 * Created at 21/09/2010 5:40:46 PM
 * smp/view/user/list.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br /><h1>User List</h1><br />\r\n";

$datagrid = $request->getDatagrid();
$datagrid->removeColumn($datagrid->getColumnByField('password'));
$datagrid = smp_util_DatagridUtil::formatColumn('picture', $datagrid);
$datagrid->addColumn(new Structures_DataGrid_Column('&nbsp;', null, null, array('width' => '20%'), null, 'icons()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();
$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $indent."<a href=\"index.php?cmd=user/form\">Add new user<img src=\"static/images/add.png\" alt=\"new\" title=\"New\"></a>\r\n";
print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function icons($params) {
	$id = $params['record']['id'];
	$html = "<a href=\"index.php?cmd=user/view&id=$id\"><img src=\"static/images/show.png\" alt=\"view\" title=\"View\"></a>\r\n";
	$html .= "&nbsp; | &nbsp;";
	$html .= "<a href=\"index.php?cmd=user/edit&id=$id\"><img src=\"static/images/update.png\" alt=\"edit\" title=\"Edit\"></a>\r\n";
	$html .= "&nbsp; | &nbsp;";
	$html .="<a href=\"index.php?cmd=user/delete&id=$id\" onClick=\"return confirmSubmit()\"><img src=\"static/images/delete.png\" alt=\"delete\" title=\"Delete\"></a>\r\n";
	return $html;
}

function format_picture($params) {
	$picture = $params['record']['picture'];
	return "<img src=\"".Constants::IMAGE_UPLOAD_DIR."_thb_$picture\" width=\"30px\" height=\"30px;\"/>";
}