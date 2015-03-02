<?php
/**
 * bootstrap.php se encarga de hacer funcional el MVC, tiene algunas funciones muy basicas.
 * @author Daniel Lozano Carrillo <daniel@unav.edu.mx>
 * @version 0.2
 * @license MIT
 * @todo Agregar algunas otras funciones basicas.
 */

/* Cargar la configuracion. */
require_once (ROOT . DS . 'app' . DS . 'configuracion' . DS . 'configuracion.php');


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
    $urlArray = explode("/", $url);
    $campos = count($urlArray);
    //echo $campos;
    if ($campos > 1) {
        $control = $urlArray[0];
        array_shift($urlArray);
        $accion = $urlArray[0];
        array_shift($urlArray);
        $queryString = $urlArray;
        if($accion==""||$accion==NULL){
            $accion = "index";
        }
        
        $nombreControl = $control;
        $control = ucwords($control);
        $modelo = $control;
        $control.= 'Control';

        echo "Control:" . $control;
        echo "Modelo:" . $modelo;
        echo "Accion:" . $accion;

        $dispatch = new $control($modelo, $nombreControl, $accion);

        

        if ((int)method_exists($control, $accion)) {
            call_user_func_array(array($dispatch, $accion), $queryString);
        } else {
            
            /* Contenido de Errores */
        }
    } else {
    	$control = CONTROL_PRINCIPAL;
        $accion = "index";
        $queryString = $urlArray;
    	$nombreControl = $control;
        $control = $control;
        $modelo = $control;
        $control.= 'Control';


                echo "Control:" . $control;
        echo "Modelo:" . $modelo;
        echo "Accion:" . $accion;

        $dispatch = new $control($modelo, $nombreControl, $accion);

        
        if ((int)method_exists($control, $accion)) {
            call_user_func_array(array($dispatch, $accion), $queryString);
        } else {
            
            /* Contenido de Errores */
        }
        
    }
   // echo "Controller ". $controllerName . " model: " . $model ." actions: ". $action ;
}



/** 
 * Esta funcion es de PHP y se encarga de tratar de cargar clases, que sean llamadas, pero
 * no tengan includes.
 * @param  String $className El nombre de clase a tratar de cargar.
 * @return void
 */
function __autoload($className) {
    /* intentar cargar clase como clase principal */
    if (file_exists(ROOT . DS . 'tutzifw' . DS . 'classes' . DS . strtolower($className) . '.class.php')) {
        require_once (ROOT . DS . 'tutzifw' . DS . 'classes' . DS . strtolower($className) . '.class.php');
    } 
    /* intentar cargar clase como controlador */
    else if (file_exists(ROOT . DS . 'app' . DS . 'controladores' . DS . strtolower($className) . '.php')) {
        require_once (ROOT . DS . 'app' . DS . 'controladores' . DS . strtolower($className) . '.php');
    } 

    /* intentar cargar clase como modelo */
    else if (file_exists(ROOT . DS . 'app' . DS . 'modelos' . DS . strtolower($className) . '.php')) {
        require_once (ROOT . DS . 'app' . DS . 'modelos' . DS . strtolower($className) . '.php');
    } 

    /* intentar cargar clase como modulos */
    else if (file_exists(ROOT . DS . 'tutzifw' . DS . 'modulos' . DS . strtolower($className) . '.mod.php')) {
        require_once (ROOT . DS . 'tutzifw' . DS . 'modulos' . DS . strtolower($className) . '.mod.php');
    } 

    /* intentar cargar clase como plantilla */
    else if (file_exists(ROOT . DS . 'tutzifw' . DS . 'plantilla' . DS . strtolower($className) . '.php')) {
        require_once (ROOT . DS . 'tutzifw' . DS . 'plantilla' . DS . strtolower($className) . '.php');
    } 

    else {
        
        /* Contenido de Errores.   */
    }
} 
$mysql= new MySQLDB;
$sesion= new Session;

setReportes();
removeMagicQuotes();
unregistrarGlobales();
callHook();

