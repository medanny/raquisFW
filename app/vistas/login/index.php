<?php
$template = "\\fw\plantillas\adminlte\Constructor";
$handdle= new $template("Hola mundo");

$handdle -> asignarValor("skin","hold-transition login-page");

$login_parametros=array(
  "titulo" => "Mega Sistema 14",
  "descripcion" => "Bienvenido, porfavor inicie session para continuar.",
  "input_1_tipo" => "text",
  "input_1_placeholder" => "Usuario",
  "input_2_tipo" => "password",
  "input_2_placeholder" => "Clave",
  "boton_texto" => "ENTRAR",
  "action" => "#",
  "method" => "POST"
  );
$handdle -> asignarParcial("content","login",$login_parametros);
$handdle -> mostrar();