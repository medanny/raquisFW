<?php

namespace app\modelos;
use \fw\core\Modelo;
use fw\core\usuarios\Usuario;
use fw\core\utilerias\Utilerias;


class Blank extends Modelo{
    public $gestorUsuario;

    public function __construc(){
        $this->gestorUsuario = new Usuario(false);
    }

    public function init(){


    }

    public function login($_usuario, $_contrasena){
        $resultado = $this->gestorUsuario->inciarSesion($_usuario, $_contrasena);
        if($resultado == EXITO){

        }
    }



}
?>