<?php
/**
 * conf.php
 * Esta clase es necesaria para especificar todas las
 * diferentes variables para que funcione el programa.
 */


   //---------------------------------------------------\\
  //---------------CONSTANTES GENERALES------------------\\
 //-------------------------------------------------------\\

define('CONTROL_PRINCIPAL','inicio'); //Nombre del controlador principal
define('PLANTILLA',''); // Nombre del Template
define('DOMINIO',''); //nombre de dominio
define('ANVITO_DESARROLLO',true); // si esta en desarrollo la aplicacion (TRUE o FALSE)
define('RUTA_CLASE', ROOT . DS . 'tutzifw' . DS . 'classes' . DS);
define('RUTA_PLANTILLA', ROOT . DS . 'tutzifw'.DS. 'plantillas' . DS . PLANTILLA . DS);
define('RUTA_PLANTILLA_HTML', DOMINIO . DS . 'tutzifw'.DS. 'plantillas' . DS . PLANTILLA . DS);
define('PAGINA_LOGIN', DOMAIN . DS . 'content' . DS . 'index');
define('PAGINA_USUARIO', DOMAIN . DS . 'main' . DS . 'index');


   //---------------------------------------------------\\
  //------------CONSTANTES DE BASE DE DATOS--------------\\
 //-------------------------------------------------------\\
define('BD_NOMBRE', 'admin_registro');
define('BD_USUARIO', 'admin_registro');
define('BD_CONTRASENA', 'registro123');
define('BD_SERVIDOR', 'localhost');

   //---------------------------------------------------\\
  //--------------CONSTANTES DE SESSIONES----------------\\
 //-------------------------------------------------------\\

define("TABLA_USUARIOS", '');//tabla de usuarios
define("CAMPO_ID_USUARIO", '');//compo de usuario
define("CAMPO_USUARIO", '');//compo de usuario
define("CAMPO_CONTRASENA", '');//campo de clave
define("CAMPO_PERMISOS", '');//campo de permisos


   //------------------------------------------------------\\
  //--------------CONSTANTES DE CORREO----------------------\\
 //----------------------------------------------------------\\

define("CORREO_EMISOR", "");//tabla de usuarios
define("NOMBRE_EMISOR", "");//compo de usuario
define("CONTRASENA", "");//campo de clave
define("HOST",""); // Establece el dmonio del host,
									//"smtp.gmail.com" es el de gmail
define("PUERTO",465);   // Establece el puerto del servidor
									//465 el de gmail
define("SMTPDEBUG", 0);// Habilita información SMTP (opcional para pruebas)
									// 0 = desabilitado
                                    // 1 = errores y mensajes
                                    // 2 = solo mensajes
define("SMTPAUTH", true); // Habilita la autenticación SMTP
									// true habilidado
									// false desabilitado
define("SMTPSECURE", "ssl");  // Establece el tipo de seguridad SMTP




?>