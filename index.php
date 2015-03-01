<?php
/**
 * index.php se encarga de recoger todas las entradas por url y mandarlas por
 * a su controlador.
 */

/* obtener variables globales para ser usado en todo include. */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(realpath(__FILE__)));

/* Requerir el url, por medio de $GET, (este viene del htaccess). */
$url = $_GET['url'];

/* Requerir bootstrap. */
require_once (ROOT . DS . 'tutzifw' . DS . 'bootstrap.php');
