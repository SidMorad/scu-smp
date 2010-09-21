<?php
/**
 * Created at 21/09/2010 8:15:31 PM
 * 
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');

$user = $request->getEntity();
$userId = $user->getId();

$indent = "			";
print $indent. "<br/><h1>&nbsp;User Info</h1><br/>";
include('smp/view/user/show.php');
print $indent. "<div style=\"padding-left:900px;\"><a href=\"index.php?cmd=user/edit&id=$userId\"><img src=\"static/images/update.png\" alt=\"edit\" title=\"Edit\"></a></div>";
include('smp/view/user/showRoles.php');

include('smp/view/common/footer.php');