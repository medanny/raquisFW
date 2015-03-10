<?php

class NaymaControl extends Control
{
    
    public function index() {
    }
    
    public function hablar($texto) {
        $this->set("texto", $texto);
        $this->set("color", $this->Nayma->queColor());
        Correo::correoSimple("Nayma Sunem", "nayma@unav.edu.mx", "Daniel Lozano", "daniel@unav.edu.mx", "Hola", "Hola danny como estas.");
        Utilerias::redirectSeguro("gmail.com");
    }
    
    public function formulario() {

        
        if (isset($_POST['nombre'])) {
            if (Validar::vacio($_POST['nombre'])) {
                
                $error[] = "proporcione el nombre";
            }
            if (Validar::vacio($_POST['escuela'])) {
                
                $error[] = "proporcione el escuela";
            }
            
            if (Validar::vacio($_POST['correo'])) {
                
                $error[] = "proporcione el correo";
            }
            if (!Validar::correo($_POST['correo'])) {
                
                $error[] = "correo no valido";
            }
            
            if (isset($error)) {
                $errores = "";
                foreach ($error as $value) {
                    // code...
                    $errores.= $value . "<br>";
                }
                $this->set("errores", $errores);
            } else {
                
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $escuela = $_POST['escuela'];
                
                $this->Nayma->query("INSERT INTO  `admin_registro`.`prueba` (
`id` ,
`nombre` ,
`correo` ,
`escuela`
)
VALUES (
NULL ,  '$nombre',  '$correo',  '$escuela'
)");
            }
        }
        
        
        $registros = $this->Nayma->aArray($this->Nayma->query("SELECT * FROM prueba"));
        $this->set("registros", $registros);


    }
}
?>