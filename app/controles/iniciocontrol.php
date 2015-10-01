<?php
namespace app\controles;
class InicioControl extends \fw\core\Control {

    function index(){
        $this->Inicio->init();
        $this->Inicio->titulo="Inicio";
        $this->Inicio->ruta=Array(
            Array("#","Admin"),
            Array("#","Inicio"),
            Array("#","Fin"));
        $this->Inicio->elementosdePagina();
        $this->set("hello", "goodbye");
        $this->set("libros", $this->Inicio->getBooks());
        $this->set("cabeza",$this->Inicio->plantilla->renderizar());
        $this->set("pie",$this->Inicio->plantilla->pie());
    }


}