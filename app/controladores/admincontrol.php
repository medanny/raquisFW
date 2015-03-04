<?php
class AdminControl extends Control
{
    
    function index() {
        global $sesion;
        $sesion->asignar("texto1","Hola mundo");
        $tema= new Tema;
        $tema->titulo("Login");
        $tema->ruta("HELLO");
        $this->set("cabeza",$tema->encabezado());
        $this->set("pie",$tema->pie());
        if($sesion->verificar('error')){
                $this->set("error",$sesion->valor('error'));
            }
        $usuario = new Usuario;
        if (isset($_POST['usuario'])) {
        	$resultado=$usuario->inciarSesion($_POST['usuario'],$_POST['clave']);
        	if($resultado==0){
        		Utilerias::redirectSeguro("/registro/admin/inicio");
             
                   		        	}else{
        	}

        	
        }
    }

    function inicio(){
        global $sesion;
        $this->set("text",$sesion->valor("texto1"));
        $tema= new Tema;
        $tema->titulo("Login");
        $tema->ruta("HELLO");
        $this->set("cabeza",$tema->encabezado());
        $this->set("pie",$tema->pie());
        
        $usuario= new Usuario;
        $this->set("login", $usuario->verificarLogin());
        $this->set("usuario",$usuario->usuario);




    }
}
