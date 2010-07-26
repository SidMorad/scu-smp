<?php
	require_once('smp/view/ViewHelper.php'); 
	require_once('smp/Constants.php'); 
	$request = VH::getRequest();
	$user = VH::getCurrentUser();
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>SMP | <?php print $request->getTitle()?></title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link type="text/css" rel="Stylesheet" media="all" href="static/css/theme.css" />
		<script language="JavaScript" type="text/javascript" src="static/js/util.js"></script>
		<script language="JavaScript" type="text/javascript" src="static/js/menu/SpryMenuBar.js"></script>
	</head>	
	<body>
		<div id="container" class="container_12">
			<div id="header" class="grid_12">
				<img src="static/images/mentoring_logo.png" width="240" height="41" alt="mentoring program" />
				<h6>Welcome <?php print $user->getUsername()?></h6>
			</div>
			<div  id="menu" class="grid_12">
				<?php include("menu.php");?>
			</div>
			<div id="content" class="grid_12">			
				<?php
					print "\r\n";
					$feedbacks = $request->getFeedbacks(); 
					if (isset($feedbacks)) {
						$indent = "				";
						print $indent."<div id=\"feedbacks\" class=\"grid_12\">\r\n";
						print $indent."	<ul class=\"ulInfo\">\r\n";	
						foreach ($feedbacks as $feedback) {
							print $indent."		<li>$feedback</li>\r\n";						
						}	
						print $indent."	</ul>\r\n";	
						print $indent."</div>\r\n";	
						print "\r\n";
					}
					$errors = $request->getErrors(); 
					if (isset($errors)) {
						$indent = "				";
						print $indent."<div id=\"errors\" class=\"grid_12\">\r\n";
						print $indent."	<ul class=\"ulError\">\r\n";	
						foreach ($errors as $error) {
							print $indent."		<li>$error</li>\r\n";						
						}	
						print $indent."	</ul>\r\n";	
						print $indent."</div>\r\n";	
						print "\r\n";
					}?>
