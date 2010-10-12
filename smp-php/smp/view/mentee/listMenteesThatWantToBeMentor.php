<?php
/**
 * Created at 12/10/2010 2:56:31 PM
 * smp/view/mentee/listMenteesThatWantToBeMentor
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br><h1>Mentee List that want to be Mentor</h1><br>\r\n";

$datagrid = $request->getDatagrid();

$datagrid->addColumn(new Structures_DataGrid_Column('&nbsp;', null, null, array('width' => '20%'), null, 'printCopyLink()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();
$datagrid->fill($table,smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function printCopyLink($params) {
	$id = $params['record']['id'];
	return "<a href=\"index.php?cmd=mentee/copyMenteeInfoAsMentor&id=$id\" onClick=\"return confirmSubmit();\">Convert Mentee to Mentor</a>\r\n";
}
