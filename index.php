<?php
/**
 * index.php se encarga de recoger todas las entradas por url y mandarlas por
 * a su controlador.
 */

/* obtener variables globales para ser usado en todo include. */
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(realpath(__FILE__)));

/* Requerir el url, por medio de $GET, (este viene del htaccess). */

$url = isset($_GET['url'])? $_GET['url'] : null ;

/* Cargar la configuracion. */
require_once (ROOT . DS . 'app' . DS . 'conf' . DS . 'conf.php');

/**
 * Verifica en la configuracion, si la aplicacion esta en desarrollo, si lo esta
 * muestra errores, si no guarda logs de los errores.
 */

function setReportes() {
    if (ANVITO_DESARROLLO == true) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 'Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT . DS . 'app' . DS . 'temporales' . DS . 'errores.log');
    }
}

/**
 * Remuebe los diagonales de los strings.
 * @param  String,Array $value El valor con diagonales.
 * @return String,Array        Valor sin diagonales.
 */
function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

/**
 * Remuebe magic quotes.
 * @return void
 */
function removeMagicQuotes() {
    if (get_magic_quotes_gpc()) {
        $_GET = stripSlashesDeep($_GET);
        $_POST = stripSlashesDeep($_POST);
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}


/**
 * Remueve los registros globales como Session, cookies ect.
 * @return void
 */
function unregistrarGlobales() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/**
 * Funcion usada para interpretar y pasar valores a los diferentes controladores.
 * @return void
 */
function callHook() {
    global $url;
    
    $urlArray = array();
    if ($url) {

        
        $urlArray = explode("/", $url);
        $campos = count($urlArray);
        $control = $urlArray[0];
        array_shift($urlArray);
        if (isset($urlArray[0])) {
            $accion = $urlArray[0];
            array_shift($urlArray);
            $queryString = $urlArray;
        }else{

        $accion = "index";
        $queryString = $urlArray;
        }


        $nombreControl = $control;
        $control = ucwords($control);
        $modelo = $control;
        $control.= 'Control';
        $control="\app\controles\\".$control;
        $dispatch = new $control($modelo, $nombreControl, $accion);

        if ((int)method_exists($control, $accion)) {
            call_user_func_array(array($dispatch, $accion), $queryString);
        } else {

            /* Contenido de Errores */
        }
    } else {
        $control = CONTROL_PRINCIPAL;
        $accion = "index";
        $queryString = Array();
        $nombreControl = $control;
        $control = ucwords($control);
        $modelo = $control;
        $control.= 'Control';
        $control="\app\controles\\".$control;
        $dispatch = new $control($modelo, $nombreControl, $accion);

        if ((int)method_exists($control, $accion)) {
            call_user_func_array(array($dispatch, $accion), $queryString);
        } else {

            /* Contenido de Errores */
        }
    }

    // echo "Controller ". $controllerName . " model: " . $model ." actions: ". $action ;

}


//Creamos el autoloader arientado a namespaces.
define('BASE_PATH', realpath(dirname(__FILE__)));

function my_autoloader($class)
{
    $filename = BASE_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    include($filename);
}
spl_autoload_register('my_autoloader');

setReportes();
removeMagicQuotes();
unregistrarGlobales();
callHook();