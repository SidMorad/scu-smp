<?php
/**
 * Created at 19/07/2010 9:59:02 AM
 * smp/view/student/listAllMentor.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 * @version 1.0
 */
require_once('smp/view/ViewHelper.php');
$request = VH::getRequest();
$datagrid =& $request->getDatagrid();

if (!is_null($request->getProperty('output_format')) && $request->getProperty('output_format') == 'XLS') {
	require_once('Structures/DataGrid/Renderer/XLS.php');
	require_once('Structures/DataGrid/Renderer/CSV.php');
	// Create a workbook
	$workbook = new Spreadsheet_Excel_Writer();
	// Create your format
	$format_bold =& $workbook->addFormat();
	$format_bold->setBold();
	
	// Fill the workbook, passing the format as an option
	$options = array('headerFormat' => &$format_bold);
	$datagrid->fill($workbook, $options);
	
	// Specify that spreadsheet must be sent the browser
	$workbook->send('test.xls');
} else if (!is_null($request->getProperty('output_format')) && $request->getProperty('output_format') == 'CSV'){
	$datagrid->render(DATAGRID_RENDER_CSV);
} else {

	include('smp/view/common/header.php');
	require_once('smp/util/DatagridUtil.php');
	
	$indent = "				";
	print $indent."<br/><h1>List of All Mentors</h1><br/>\r\n";
	
	include("smp/view/search/mentorSearchPanel.php");
	
	
	// use Formatter to edit generated data
	$studyModeColumn =& $datagrid->getColumnByField('study_mode');
	$studyModeColumn->setFormatter('formatStudyMode');
	//format the gender column form f/m to Female/Male
	$genderColumn=$datagrid->getColumnByField('gender');
	$genderColumn->setFormatter('formatGender');
	function formatGender($params){
		$key=$params['record']['gender'];
		return VH::getValueFromFixArray('gender', $key);
	}
	
	$table = smp_util_DatagridUtil::getCustomHtmlTable();
	
	$datagrid->fill($table,smp_util_DatagridUtil::getRenderOptions());
	
	print $table->toHtml();
	$datagrid->render(DATAGRID_RENDER_PAGER);
	
	print $indent. "<a href=\"index.php?cmd=mentor/listAllMentor&output_format=CSV\">";
	print $indent. "<img src=\"static/images/csv.png\" >";
	print $indent. "</a>";
	include('smp/view/common/footer.php');
	
	function formatStudyMode($params){
	    $key = $params['record']['study_mode'];
	    return VH::getValueFromFixArray('study_mode', $key);
	}

}