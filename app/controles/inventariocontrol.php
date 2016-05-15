<?php
namespace app\controles;
use fw\core\Control;

class InventarioControl extends Control{

    public function index(){
        $this->Inventario->iniciar();
    }
}