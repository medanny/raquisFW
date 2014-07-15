<?php
include_once ("tutzi/class/template.class.php");
include_once ("tutzi/template/builder/form.template.php");


global $template;
global $form;

$template->incHead();
$template->cssrewrite("
	body {
    background-color: #222222;
	}
    html {
    background-color: #222222;
    }
     ");


$form->inicForm("accion","post");
$form->addhtml('<div class="body bg-gray">');
$form->addinput("text","userid","form-control", "Usuario");
$form->addinput("password","password","form-control", "Contrasena");
$form->addhtml('</div>');
$form->addbutton("submit","btn bg-olive btn-block","Iniciar Session");
$content=$form->render();
$footer=' <p><a href="#">Olvideo mi contrasena</a></p>';
$template->addFormbox("Inciar Session",$content,$footer);

$template->incTail();

echo $template->render();



               


?>