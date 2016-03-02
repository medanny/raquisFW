<?php
$template = "\\fw\plantillas\adminlte\Constructor";
$handdle= new $template("Hola mundo");

$handdle -> asignarValor("skin","hold-transition skin-blue sidebar-mini");
$handdle -> asignarParcial("header","header");
$handdle -> asignarParcial("sidebar","sidebar");
$handdle -> asignarParcial("content","content");
$handdle -> asignarParcial("footer","footer");
$handdle -> asignarParcial("rightsidebar","rightsidebar");


$handdle -> mostrar();


?>