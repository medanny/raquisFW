<?php
/**
 * Created by PhpStorm.
 * User: Beast
 * Date: 3/19/2016
 * Time: 12:30 AM
 */
use \fw\plantillas\adminlte\Constructor;

$plantilla = new Constructor("Hola Mundo");

$handdle -> asignarValor("skin","hold-transition login-page");

$login_parametros=array(
    "titulo" => "Sistema de Calculo de Horas",
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