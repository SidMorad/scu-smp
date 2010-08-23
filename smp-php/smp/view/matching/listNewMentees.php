<?php
/**
 * Created at 23/07/2010 1:56:24 PM
 * smp/view/matching/listNewMentees.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include("smp/view/common/header.php");
require_once('smp/util/OptionProvider.php');
require_once('smp/util/FormBuilder.php');
require_once('smp/util/DatagridUtil.php');

$indent = "				";
print $indent."<br/><h1>List of Not Matched Mentees</h1><br/>\r\n";

include("smp/view/search/menteeSearchPanel.php");

$datagrid =& $request->getDatagrid();

$datagrid->addColumn(new Structures_DataGrid_Column('&nbsp;', null, null, array('width' => '20%'), null, 'printSelectForMatchingLink()'));

$table = smp_util_DatagridUtil::getCustomHtmlTable();

$datagrid->fill($table, smp_util_DatagridUtil::getRenderOptions());

print $table->toHtml();
$datagrid->render(DATAGRID_RENDER_PAGER);

include('smp/view/common/footer.php');

function printSelectForMatchingLink($params) {
	$menteeId = $params['record']['id'];
	return "<a href=\"index.php?cmd=matching/matchingForm&amp;menteeId=". $menteeId ."\">select for matching</a></td>\r\n";
}
