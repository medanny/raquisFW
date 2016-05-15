<?php
/**
 * Created by PhpStorm.
 * User: Beast
 * Date: 3/19/2016
 * Time: 12:29 AM
 */

namespace app\controles;

class BlankControl extends \fw\core\Control {

    function index(){
        if(isset($_GET['accion'])){
            if($_GET['accion'] == "login"){
                $this->Blank->login($_GET['usuario'],$_GET['constrasena']);
            }
        }
    }

    function clave(){

    }


}