<?php
/**
 * Created at 09/08/2010 5:34:33 PM
 * __FILE__
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
include('smp/view/common/header.php');
require_once('smp/util/FormBuilder.php');

$indent = "				";
print $indent."<br/><h1>Send Message</h1><br/>\r\n";

$form = new smp_util_FormBuilder();
$form->setIndent($indent);
$validator = VH::getValidator();

if ($form->isPost()) {
	if ($validator->isInValid()) {
		$form->setErrors($validator->getErrors());
		$form->setValues($validator->getValues());
		print $validator->getErrorMessagesString($form->strIndent);
	}
}
print $form->open('messageForm');
print $form->hidden('cmd', 'message/messageMentorForm');
print $form->label('to', "To: ","grid_2",true);
print $form->selectBox('to', null, null, 1, "grid_10",VH::getFixArray(Constants::MESSAGE_MENTOR));
print $form->label('subject', "Subject: ","grid_2",true);
print $form->textBox('subject', null, null, 2, "grid_10");
print $form->label('body', "Text : ","grid_2",true);
print $form->textArea('body',null, null, 3,'grid_10',30,5);
print $form->label('submit', "&nbsp;", "grid_2");
print $form->button('submit',"Send", 'submit', 3,"grid_10");
print $form->close();


include('smp/view/common/footer.php');