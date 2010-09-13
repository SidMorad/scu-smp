<?php
/**
 * Created at 13/09/2010 2:50:16 PM 
 * smp/view/user/listAllCoordinator.php
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br /><h1>Coordinator List</h1><br />\r\n";

$datagrid=$request->getDatagrid();
$datagrid->removeColumn($datagrid->getColumnByField('password'));
//
//

$table=smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $indent."<a href=\"index.php?cmd=user/form\">Add new Coordinator</a>\r\n";
print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function edit_icon($param){
	$id=$params['record']['id'];
	return "<a href=\"index.php?cmd=user/edit&id=$id\"><img scr=\"static/images/updat.png\"></a>\r\n";
}
//
