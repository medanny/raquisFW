<?php
class registrarControl extends Control
{
    
    public function index() {
        $this->Registrar->plantilla->titulo = "Foro de Investigación";
        $this->Registrar->plantilla->skin = "login-page";
        $this->Registrar->plantilla->ruta = "HELLO";
        $this->set("cabeza", $this->Registrar->plantilla->encabezado());
        $this->set("pie", $this->Registrar->plantilla->pie());
    }

    public function gracias(){
    	$this->Registrar->plantilla->titulo = "Gracias";
        $this->Registrar->plantilla->skin = "login-page";
        $this->Registrar->plantilla->ruta = "HELLO";
        $this->set("cabeza", $this->Registrar->plantilla->encabezado());
        $this->set("pie", $this->Registrar->plantilla->pie());
        

    }
    
    public function prueba(){
        $this->Registrar->plantilla->titulo = "Gracias";
        $this->Registrar->plantilla->skin = "login-page";
        $this->Registrar->plantilla->ruta = "HELLO";
        $this->set("cabeza", $this->Registrar->plantilla->encabezado());
        $this->set("pie", $this->Registrar->plantilla->pie());
        

    }
    
    public function ponente() {
        $this->Registrar->plantilla->titulo = "Registro Ponente";
        $this->Registrar->plantilla->skin = "login-page";
        $this->Registrar->plantilla->ruta = "HELLO";
        $this->set("cabeza", $this->Registrar->plantilla->encabezado());
        $this->set("pie", $this->Registrar->plantilla->pie());
        
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $autor = $_POST['autor'];
            $coautor = $_POST['coautor'];
            $categoria = $_POST['categoria'];
            $escuela = $_POST['escuela'];
            $institucion = $_POST['institucion'];
            $archivo = new Archivo("app/temporales/archivos_subidos/",$_FILES['image']);
            $archivo->asignarExtensiones(Array("png","pdf","docx","doc"));
            $archivo->asignarTamanoMaximo(3);//Mb
            if($archivo->guardarArchivo()){
            $nombre_archivo=$archivo->nombre_archivo;
            global $mysql;
            $mysql->query("INSERT INTO `admin_registro`.`ponentes` (`id`, `nombre`, `correo`, `categoria`, `coautor`, `autor`, `escuela`, `institucion`, `archivo`) 
            	VALUES (NULL, '$nombre', '$correo', '$categoria', '$coautor', '$autor', '$escuela', '$institucion', '$nombre_archivo');");
            $message="
            
Tu proceso ha sido completado con éxito
			
Tus Datos:
Nombre: ". $nombre."
Correo: ". $correo."
Categoria: ". $categoria."
Autor: ". $autor."
Co Autor: ". $coautor."
Escuela: ". $escuela."
Institucion: ". $institucion."

            ";

            Correo::correoAdjunto($_FILES["image"]["name"], $nombre_archivo, $correo, "registro@unav.edu.mx", "Registro Unav", "registro@unav.edu.mx", "Nuevo Registro.", $message);
            Correo::correoAdjunto($_FILES["image"]["name"], $nombre_archivo, "investigacion@unav.edu.mx", "registro@unav.edu.mx", "Registro Unav", "registro@unav.edu.mx", "Nuevo Registro.", $message);
            
            //Utilerias::redirectSeguro("/registrar/gracias");
            }else{
            	foreach ($archivo->errores as $value) {
            		echo "Error:". $value . "<br>";
            	}
            }
        }
    }
    
    public function asistente() {
        $this->Registrar->plantilla->titulo = "Registro Asistente";
        $this->Registrar->plantilla->skin = "login-page";
        $this->Registrar->plantilla->ruta = "HELLO";
        $this->set("cabeza", $this->Registrar->plantilla->encabezado());
        $this->set("pie", $this->Registrar->plantilla->pie());
        
        if (isset($_POST['nombre'])) {
            
            $msg = "Gracias por registrarte.
        	tus datos:
        	Nombre: " . $_POST['nombre'] . "
        	Correo: " . $_POST['correo'] . "
        	Escuela: " . $_POST['escuela'] . "
        	Institucion: " . $_POST['institucion'] . "
        	";
            $to = $_POST['correo'];
            $subject = "Nuevo Registro";
            $txt = $msg;
            $headers = "From: registro@unav.edu.mx" . "\r\n" . "CC: daniel@unav.edu.mx,investigacion@unav.edu.mx";
            
            mail($to, $subject, $txt, $headers);
            global $mysql;
            $mysql->query("INSERT INTO asistentes (`id`, `nombre`, `correo`, `escuela`, `institucion`) 
            	VALUES (NULL, '" . $_POST['nombre'] . "', '" . $_POST['correo'] . "', '" . $_POST['escuela'] . "', '" . $_POST['institucion'] . "')");
            echo "<b> A sido registrado1</b>";
            Utilerias::redirectSeguro("/registrar/gracias");
        }
    }
}
