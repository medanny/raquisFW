<?php
namespace app\modelos;
use fw\mods\usuarios\Usuario;

class Login extends \fw\core\Modelo{

    public $usuario;

    public function __construct(){
        $this->usuario = new Usuario(false);
    }

    public function init(){
    }

    public function inciarSesion($_usuario, $_clave){
        return $this->usuario->inciarSesion($_usuario, $_clave);
    }

    public function existeSesion(){
        return $this->usuario->sesion_activa;
    }

    public function verificarSesion(){
        return $this->usuario->verificarLogin();
    }
}
?>