<?php

namespace app\controles;
use fw\core\Control;
use fw\mods\lenguajes\Lenguaje;

class DemoControl extends Control{

    public function index(){

    }

    public function sms(){

    }

    public function lang(){
        $leng = new Lenguaje();
        $txt=$leng->g;
        echo $txt['titulo'];
        echo "<br>";
        echo $leng->prs($txt['bienvenida'], Array("Daniel"));
    }
}