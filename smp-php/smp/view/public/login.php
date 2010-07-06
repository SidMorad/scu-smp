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
print $objLoginForm->strIndent."<h1>Login</h1>\r\n";

if ($objLoginForm->isPost()) {
	$validator = VH::getValidator();
	print $validator->getErrorMessagesString($objLoginForm->strIndent);
}


print $objLoginForm->strIndent."<fieldset>\r\n";
print $objLoginForm->strIndent."<ul class=\"ulForm\">\r\n";
print $objLoginForm->open("loginForm");
print $objLoginForm->hidden("cmd", "public/login");
print $objLoginForm->strIndent."<li>\r\n";
print $objLoginForm->textBox("username", "Username:","","text",20,1);
print $objLoginForm->strIndent."</li>\r\n";
print $objLoginForm->strIndent."<li>\r\n";
print $objLoginForm->textBox("password", "Password:","","password",20,2);
print $objLoginForm->strIndent."</li>\r\n";
print $objLoginForm->strIndent."<li style=\"padding-right:127px;\">\r\n";
print $objLoginForm->submit("submit", "Login", 3);
print $objLoginForm->strIndent."</li>\r\n";
print $objLoginForm->close();
print $objLoginForm->strIndent."</ul>\r\n";
print $objLoginForm->strIndent."</fieldset>\r\n";
print $objLoginForm->strIndent."<p style=\padding-top:30px;\"> These Username / Password for testing:</p>\r\n";
print $objLoginForm->strIndent."<ul>\r\n";
print $objLoginForm->strIndent."	<li>admin / admin</li>\r\n";
print $objLoginForm->strIndent."	<li>manager / manager</li>\r\n";
print $objLoginForm->strIndent."	<li>coordinator / coordinator</li>\r\n";
print $objLoginForm->strIndent."	<li>mentor / mentor</li>\r\n";
print $objLoginForm->strIndent."	<li>mentee / mentee</li>\r\n";
print $objLoginForm->strIndent."</ul>\r\n";

include("smp/view/common/footer.php");