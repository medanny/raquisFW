<?php
class AdminControl extends Control
{
    
    function index() {
        $this->Admin->plantilla->titulo("Login");
        $this->Admin->plantilla->skin("login-page"); 
        $this->Admin->plantilla->ruta("HELLO");
        $this->set("cabeza",$this->Admin->plantilla->encabezado());
        $this->set("pie",$this->Admin->plantilla->pie());


        if (isset($_POST['usuario'])) {
        	$resultado=$this->Admin->usuario->inciarSesion($_POST['usuario'],$_POST['clave']);
        	if($resultado==0){
        		Utilerias::redirectSeguro("/admin/inicio");
             
                   		        	}else{
        	}

        	
        }
    }

    function inicio(){
        //$this->Admin->plantilla->titulo("Login");
        //$this->Admin->plantilla->skin("skin-blue");
        $this->Admin->plantilla->nombredeApp="Registro";
        $this->Admin->plantilla->skin="skin-blue";
        $this->Admin->plantilla->titulo="Inicio";
        $this->Admin->plantilla->piedePagina="Copyright &copy; 2014-2015 <a href='http://almsaeedstudio.com'>TutziLAbs</a>.</strong> Todos los derechos reservados.";
        $this->Admin->plantilla->ruta=Array("Home","Hello");
        $this->Admin->plantilla->datos_usuario=Array(
            "imagen"=>"url",
            "usuario"=>"Nombre Usuario",
            "desc1"=>"descripcion 1",
            "desc2"=>"descripcion 2",
            "link1"=>"link 1",
            "link2"=>"link 2",
            "link3"=>"link 3",
            "perfil"=>"perfil",
            "logout"=>"url"
            );
            //tipos -> separador,sensillo,multimple
        $this->Admin->plantilla->menu=Array(
                Array("separador","Menu"),
                Array("sensillo","#","fa fa-book","text"),
                Array("multiple","#","fa fa-book",
                    Array(
                        Array("#","fa fa-book","text"),
                        Array("#","fa fa-book","text"),
                        Array("#","fa fa-book","text")
                        
                         )
                     ),
                Array("separador","Menu"),
                Array("sensillo","#","fa fa-book","text"),


            );


        $this->set("cabeza",$this->Admin->plantilla->renderizar());
        $this->set("pie",$this->Admin->plantilla->pie());
        $this->set("usuario",$this->Admin->usuario->usuario);




    }
}
