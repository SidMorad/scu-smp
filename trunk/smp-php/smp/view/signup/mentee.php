<?php
/**
 * Created at 04/07/2010 11:04:39 PM
 * smp/view/signup/mentee.php
 *
 * @author <a href="mailto:sli24@scu.edu.au">Bruce</a>
 */
include("smp/view/common/header.php");
require_once('smp/util/FormBuilder.php');

$objForm=new smp_util_FormBuilder();
$objForm->useLocator();
$objForm->setIndent("			");
$validator=VH::getValidator();

print $objForm->strIndent."<h1>Became a Mentee Application Form</h1>\r\n";
print $objForm->strIndent."<p style=\"padding-left:30px;\">Use this form if you have successfully completed at least two semesters of undergraduate study at Southern Cross Uni</p>"













include("smp/view/common/footer.php");