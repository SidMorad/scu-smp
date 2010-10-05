<?php
/**
 * Created at 04/07/2010 10:56:58 PM
 * smp/view/public/home.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 */
include("smp/view/common/header.php");
require_once("smp/util/FormBuilder.php");


$objLoginForm = new smp_util_FormBuilder();
$objLoginForm->setIndent("				");
$objLoginForm->useLocator();
$validator = VH::getValidator();
print $objLoginForm->strIndent."<h1>Login</h1>\r\n";

if ($objLoginForm->isPost()) {
	$objLoginForm->setValues($validator->getValues());
	if ($validator->isInvalid()) {
		$objLoginForm->setErrors($validator->getErrors());
		print $validator->getErrorMessagesString($objLoginForm->strIndent);
	}
}

print $objLoginForm->open("loginForm");
print $objLoginForm->hidden("cmd", "public/login");
print $objLoginForm->label("", "Username:","grid_1",true);
print $objLoginForm->textBox("username", "","",1,"grid_11","input",20,"text");
print $objLoginForm->label("", "Password:","grid_1",true);
print $objLoginForm->textBox("password", "","",2,"grid_11","input",20,"password");
print $objLoginForm->label("", "&nbsp;", "grid_1");
print $objLoginForm->button("submit", "Login","submit", 3, "grid_11");
print $objLoginForm->close();

print $objLoginForm->strIndent."<br /><p> These Username / Password for testing:</p>\r\n";
print $objLoginForm->strIndent."<ul>\r\n";
print $objLoginForm->strIndent."	<li>admin / admin <span style=\"padding-left: 45px;\"> Role Admin</span></li>\r\n";
print $objLoginForm->strIndent."	<li>rob / rob  <span style=\"padding-left: 80px;\"> Role Manager</span></li>\r\n";
print $objLoginForm->strIndent."	<li>jo / jo  <span style=\"padding-left: 95px;\">Role Coordinator</span></li>\r\n";
print $objLoginForm->strIndent."	<li>jiya / jiya <span style=\"padding-left: 75px;\">Role Mentor</span></li>\r\n";
print $objLoginForm->strIndent."	<li>lucy / lucy <span style=\"padding-left: 50px;\">Role Mentee</span></li>\r\n";
print $objLoginForm->strIndent."</ul>\r\n";

include("smp/view/common/footer.php");