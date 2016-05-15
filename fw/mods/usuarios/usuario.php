<?php

namespace fw\mods\usuarios;
use fw\mods\sesiones\Sesion;
use fw\mods\db\mainDBDriver;

/**
 * Class Usuario, se encarga de gestionar Usuarios.
 * 
 * Class Usuario traba jo en conjunto con la clase de sessiones,
 * para gestionar todo lo que tiene que ver con logins y usuarios.
 * 
 * Ejemplo de uso:
 *  Para utilzar esta clase solo es necesario inicialarla en un objeto:
 * 
 * $gestorUsuarios = new Usuario();
 *
 * @package fw\core\usuarios
 */
class Usuario
{
    public $id;
    public $usuario;
    public $nivel;
    public $info_usuario;
    public $sesion_activa;
    public $sesion;
    public $mysql;
    
    function __construct($_verLogin = true) {
        $this->sesion = new Sesion();
        $this->mysql =  new mainDBDriver(BD_DRIVER);
        if($_verLogin){
            $this->verificarLogin();
        }

    }
    
    function verificarLogin() {
        if ($this->sesion->verificar("id") && $this->sesion->verificar("usuario")) {
           
            if ($this->confirmarId($this->sesion->valor("usuario"), $this->sesion->valor("id"))) {
               
                $this->sesion_activa = TRUE;
                $this->usuario = $this->sesion->valor("usuario");
                $this->info_usuario = $this->obtenerDatosUsuario($this->usuario);
                return EXITO;
            } else {
                $this->sesion->destruir();
                $this->sesion_activa = FALSE;
            }
        }else{
            return FRACASO;
        }
    }
    
    function confirmarId($usuario, $id) {
        $result = $this->mysql->aArray($this->mysql->query("SELECT * FROM ".TABLA_USUARIOS." WHERE ".CAMPO_USUARIO ." = '".$usuario."'"));
        $nrows = count($result);
        if (!$result || $nrows < 1) {
            return false;
        } else if ($id == $result[0][CAMPO_ID_USUARIO]) {
        
            return true;
        } else {
            return false;
        }
    }
    
    function obtenerDatosUsuario($usuario) {
        $q = "SELECT * FROM " . TABLA_USUARIOS . " WHERE " . CAMPO_USUARIO . " = '$usuario'";
        $result = $this->mysql->aArray($this->mysql->query($q));
        $nrows = count($result);
        if (!$result || $nrows < 1) {
            return NULL;
        }
        return $result;
    }
    
    function confirmarUsuarioContrasena($usuario, $contrasena) {
        $q = "SELECT * FROM " . TABLA_USUARIOS . " WHERE " . CAMPO_USUARIO . " = '$usuario'";
        $result = $this->mysql->aArray($this->mysql->query($q));
        $nrows = count($result);
        
        if (!$result || $nrows < 1) {
            $this->sesion->asignar("error","El usuario no existe en nuestra base de datos.");
            return USUARIO_NO_EXISTE;
             //el usuario no existe.
            
        } else if ($contrasena == $result[0][CAMPO_CONTRASENA]) {

            return EXITO;
             // usuario validado EXITO!
            
        } else {
            $this->sesion->asignar("error","La contrasena especificada no es correcta.");
            return CONTRASENA_INCORRECTA;
             //contrasena incorrecta.
            
        }
    }
    
    function inciarSesion($usuario, $contrasena) {
        echo "Verificando Session<br>";
        $resultado = $this->confirmarUsuarioContrasena($usuario, md5($contrasena));
        if ($resultado != EXITO) {
            return $resultado;
        }
        $this->info_usuario = $this->obtenerDatosUsuario($usuario);
        $this->usuario = $this->info_usuario[0][CAMPO_USUARIO];
        $this->sesion->asignar("usuario", $this->usuario);
        $this->id = $this->info_usuario[0][CAMPO_ID_USUARIO];
        $this->sesion->asignar("id", $this->id);
        $this->nivel = $this->info_usuario[0][CAMPO_PERMISOS];
        $this->sesion_activa = TRUE;

        echo "Usuario:".$this->sesion->valor("usuario")."<br>";
        echo "Id:".$this->sesion->valor("id");
        return $resultado;



    }
    
    function terminarSesion() {
        $this->sesion->destruir();
        $this->sesion_activa = FALSE;
    }
}
