<?php
class AdminControl extends Control
{
    
    function index() {
        
        $this->Admin->plantilla->nombredeApp="Registro";
        $this->Admin->plantilla->skin="login-page";
        $this->Admin->plantilla->titulo="Inicio";
        $this->Admin->plantilla->piedePagina="Copyright &copy; 2014-2015 <a href='http://almsaeedstudio.com'>TutziLAbs</a>.</strong> Todos los derechos reservados.";
        $this->Admin->plantilla->ruta=Array("Home","Hello");
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
        $this->Admin->titulo="Inicio";
        $this->Admin->ruta=Array(
            Array("#","Admin"),
            Array("#","Inicio"),
            Array("#","Fin"));
        $this->Admin->elementosdePagina();
        $this->set("cabeza",$this->Admin->plantilla->renderizar());
        $this->set("pie",$this->Admin->plantilla->pie());
        $this->set("usuario",$this->Admin->usuario->usuario);
    }

    function boletos(){
        $this->Admin->titulo="Generar Boletos";
        $this->Admin->ruta=Array(
            Array("#","Admin"),
            Array("#","Generar Boletos"));
        $this->Admin->elementosdePagina();
        $this->set("cabeza",$this->Admin->plantilla->renderizar());
        $this->set("pie",$this->Admin->plantilla->pie());
        $this->set("usuario",$this->Admin->usuario->usuario);
    }

    function horarios(){
        $this->Admin->titulo="Catalogo de Horarios";
        $this->Admin->ruta=Array(
            Array("#","Admin"),
            Array("#","Catalogos"),
            Array("#","Horarios"));
        $this->Admin->elementosdePagina();
        $this->set("cabeza",$this->Admin->plantilla->renderizar());
        $this->set("pie",$this->Admin->plantilla->pie());
        $this->set("usuario",$this->Admin->usuario->usuario);


        if(isset($_POST['accion'])){

            switch ($_POST['accion']) {
                case 'nuevo':
                    # code...
                    unset($_POST['accion']);
                    $_POST['table_name']="horario";
                    $this->Admin->insertarxArray($_POST);
                    break;
                
                default:
                    # code...
                    break;
            }
        }


        $this->set("horas",$this->Admin->obtenerHorarios());

    }

    function lugar(){
        $this->Admin->titulo="Catalogo de Lugares";
        $this->Admin->ruta=Array(
            Array("#","Admin"),
            Array("#","Catalogos"),
            Array("#","Lugares"));
        $this->Admin->elementosdePagina();
        $this->set("cabeza",$this->Admin->plantilla->renderizar());
        $this->set("pie",$this->Admin->plantilla->pie());
        $this->set("usuario",$this->Admin->usuario->usuario);
        if(isset($_POST['accion'])){

            switch ($_POST['accion']) {
                case 'nuevolugar':
                    # code...
                    unset($_POST['accion']);
                    $_POST['table_name']="lugar";
                    $this->Admin->insertarxArray($_POST);
                    break;
                
                default:
                    # code...
                    break;
            }
        }


        $this->set("lugares",$this->Admin->obtenerLugares());

    }

    function ponente(){
        $this->Admin->titulo="Catalogo de Ponentes";
        $this->Admin->ruta=Array(
            Array("#","Admin"),
            Array("#","Catalogos"),
            Array("#","Ponentes"));
        $this->Admin->elementosdePagina();
        $this->set("cabeza",$this->Admin->plantilla->renderizar());
        $this->set("pie",$this->Admin->plantilla->pie());
        $this->set("usuario",$this->Admin->usuario->usuario);
        

        if(isset($_POST['accion'])){

            switch ($_POST['accion']) {
                case 'nuevoponente':
                    # code...
                    unset($_POST['accion']);
                    $_POST['table_name']="ponencia";
                    $this->Admin->insertarxArray($_POST);
                    break;
                
                default:
                    # code...
                    break;
            }
        }


        $this->set("ponentes",$this->Admin->obtenerPonentes());
    }

    function ponencias(){
        $this->Admin->titulo="Catalogo de Ponencias";
        $this->Admin->ruta=Array(
            Array("#","Admin"),
            Array("#","Catalogos"),
            Array("#","Ponentes"));
        $this->Admin->elementosdePagina();
        $this->set("cabeza",$this->Admin->plantilla->renderizar());
        $this->set("pie",$this->Admin->plantilla->pie());
        $this->set("usuario",$this->Admin->usuario->usuario);
        

        if(isset($_POST['accion'])){

            switch ($_POST['accion']) {
                case 'nueva':
                    # code...
                    unset($_POST['accion']);
                    $_POST['table_name']="ponencias";
                    $this->Admin->insertarxArray($_POST);
                    break;
                
                default:
                    # code...
                    break;
            }
        }


        $this->set("ponentes",$this->Admin->convertirOpciones($this->Admin->obtenerPonentes(),"id","ponente","ponencia"));
        $this->set("horarios",$this->Admin->convertirOpciones($this->Admin->obtenerHorarios(),"id","nombre"));
        $this->set("lugares",$this->Admin->convertirOpciones($this->Admin->obtenerLugares(),"id","nombre"));
        $this->set("ponencias",$this->Admin->obtenerPonencias());
        
           
    }

}
