<?php
class Usuario
{
    public $id;
    public $usuario;
    public $nivel;
    public $info_usuario;
    public $sesion_activa;
    
    function __construct() {
        $this->verificarLogin();

    }
    
    function verificarLogin() {
        global $sesion;


        if ($sesion->verificar("id") && $sesion->verificar("usuario")) {
           
            if ($this->confirmarId($sesion->valor("usuario"), $sesion->valor("id"))) {
               
                $this->sesion_activa = TRUE;
                $this->usuario = $sesion->valor("usuario");
                $this->info_usuario = $this->obtenerDatosUsuario($this->usuario);
            } else {
                $sesion->destruir();
                $this->sesion_activa = FALSE;
            }
        }else{

        }
    }
    
    function confirmarId($usuario, $id) {
        global $mysql;
        $result = $mysql->aArray($mysql->query("SELECT * FROM ".TABLA_USUARIOS." WHERE ".CAMPO_USUARIO ." = '".$usuario."'"));
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
        global $mysql;
        $q = "SELECT * FROM " . TABLA_USUARIOS . " WHERE " . CAMPO_USUARIO . " = '$usuario'";
        $result = $mysql->aArray($mysql->query($q));
        $nrows = count($result);
        if (!$result || $nrows < 1) {
            return NULL;
        }
        return $result;
    }
    
    function confirmarUsuarioContrasena($usuario, $contrasena) {
        global $mysql,$sesion;
        $q = "SELECT * FROM " . TABLA_USUARIOS . " WHERE " . CAMPO_USUARIO . " = '$usuario'";
        $result = $mysql->aArray($mysql->query($q));
        $nrows = count($result);
        
        if (!$result || $nrows < 1) {
            $sesion->asignar("error","El usuario no existe en nuestra base de datos.");
            return 1;
             //el usuario no existe.
            
        } else if ($contrasena == $result[0][CAMPO_CONTRASENA]) {

            return 0;
             // usuario validado EXITO!
            
        } else {
            $sesion->asignar("error","La contrasena especificada no es correcta.");
            return 2;
             //contrasena incorrecta.
            
        }
    }
    
    function inciarSesion($usuario, $contrasena) {
        echo "Verificando Session<br>";
        global $sesion, $mysql;
        $resultado = $this->confirmarUsuarioContrasena($usuario, md5($contrasena));
        if ($resultado >= 1) {
            return $resultado;
        }
        $this->info_usuario = $this->obtenerDatosUsuario($usuario);
        $this->usuario = $this->info_usuario[0][CAMPO_USUARIO];
        $sesion->asignar("usuario", $this->usuario);
        $this->id = $this->info_usuario[0][CAMPO_ID_USUARIO];
        $sesion->asignar("id", $this->id);
        $this->nivel = $this->info_usuario[0][CAMPO_PERMISOS];
        $this->sesion_activa = TRUE;

        echo "Usuario:".$sesion->valor("usuario")."<br>";
        echo "Id:".$sesion->valor("id");
        return $resultado;



    }
    
    function terminarSesion() {
        $sesion->destruir();
        $this->sesion_activa = FALSE;
    }
}
