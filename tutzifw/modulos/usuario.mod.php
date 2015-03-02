<?php
class Usuario
{
    public $id;
    public $usuario;
    public $nivel;
    public $info_usuario;
    public $sesion_activa;
    
    function __construct() {
        verificarLogin();
    }
    
    function verificarLogin() {
        global $sesion;
        if ($sesion->verificar("id") && $sesion->verificar("usuario")) {
            if ($this->confirmarId($sesion->valor("id"), $sesion->valor("usuario"))) {
                $this->sesion_activa = TRUE;
                $this->usuario = $sesion->valor("usuario");
                $this->info_usuario = $this->obtenerDatosUsuario($this->usuario);
            } else {
                $sesion->destruir();
                $this->sesion_activa = FALSE;
            }
        }
    }
    
    function confirmarId($usuario, $id) {
        global $mysql;
        $result = $mysql->aArray($mysql->elegirDondeCampo(TABLA_USUARIOS, CAMPO_USUARIO, $usuario));
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
        $q = "SELECT * FROM " . USER_TABLE . " WHERE " . USER_FIELD . " = '$usuario'";
        $result = $mysql->aArray($mysql->query($q));
        $nrows = count($result);
        if (!$result || $nrows < 1) {
            return NULL;
        }
        return $result;
    }
    
    function confirmarUsuarioContrasena($usuario, $contrasena) {
        global $mysql;
        $q = "SELECT * FROM " . TABLA_USUARIOS . " WHERE " . CAMPO_USUARIO . " = '$usuario'";
        $result = $mysql->aArray($database->query($q));
        $nrows = count($result);
        
        if (!$result || $nrows < 1) {
            return 1;
             //el usuario no existe.
            
        } else if ($constrasena == $result[0][CAMPO_CONTRASENA]) {
            return 0;
             // usuario validado EXITO!
            
        } else {
            return 2;
             //contrasena incorrecta.
            
        }
    }
    
    function inciarSesion($usuario, $constrasena) {
        global $sesion, $mysql;
        $resultado = $this->confirmarUsuarioContrasena($usuario, md5($contrasena));
        if ($resultado >= 1) {
            return $resultado;
        }
        $this->info_usuario = $this->obtenerDatosUsuario($this->usuario);
        $this->usuario = $this->info_usuario[CAMPO_USUARIO];
        $sesion->asignar("usuario", $this->usuario);
        $this->id = $this->info_usuario[CAMPO_ID_USUARIO];
        $sesion->asignar("id", $this->id);
        $this->nivel = $this->info_usuario[CAMPO_PERMISOS];
        $this->sesion_activa = TRUE;
        return $resultado;
    }
    
    function terminarSesion() {
        $sesion->destruir();
        $this->sesion_activa = FALSE;
    }
}
