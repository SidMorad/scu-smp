<?php
/**
 * Created at 13/09/2010 10:34:20 AM
 * smp/view/course/list.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br><h1>Course List</h1><br>\r\n";
include('smp/view/search/courseSearchPanel.php');

$datagrid = $request->getDatagrid();

$datagrid->addColumn(new Structures_DataGrid_Column('Edit', null, null, array('width' => '20%'), null, 'edit_icon()'));
$datagrid->addColumn(new Structures_DataGrid_Column('Delete', null, null, array('width' => '20%'), null, 'delete_icon()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table,smp_util_DatagridUtil::getRenderOptions());

print $indent."<a href=\"index.php?cmd=course/form\">Add new course</a>\r\n";
print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function edit_icon($params) {
	$id = $params['record']['id'];
	return "<a href=\"index.php?cmd=course/edit&id=$id\"><img src=\"static/images/update.png\" ></a>\r\n";
}

function delete_icon($params) {
	$id = $params['record']['id'];
	return "<a href=\"index.php?cmd=course/delete&id=$id\" onClick=\"return confirmSubmit()\"><img src=\"static/images/delete.png\" ></a>\r\n";
}