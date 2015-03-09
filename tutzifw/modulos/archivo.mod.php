<?php
class Archivo
{
    
    public $archivo;
    public $directorioDeseado;
    public $nombre_archivo;
    public $statusDelArchivo;
    public $tipoArchivo;
    public $extensionesPermitidas;
    public $tamanoMaximo;
    public $errorres; //array
    
    public function __construct($directorio, $archivo) {
    	//var_dump($archivo);
        $this->archivo = $archivo;
        $this->directorioDeseado = $directorio;
        $this->nombre_archivo = $this->directorioDeseado . basename($archivo['name']);
        $this->statusDelArchivo = 1;
        $this->tipoArchivo = pathinfo($this->nombre_archivo, PATHINFO_EXTENSION);
    }

    public function guardarArchivo() {
        
        //$this->esArchivo();
        $this->archivoExiste();
        if(isset($this->tamanoMaximo)){
        	$this->verificarTamano();
        }
        if(isset($this->extensionesPermitidas)){
        	$this->verificarExtension();
        }
        if($this->statusDelArchivo==0){
        	return FALSE;
        }else{
        	return move_uploaded_file($this->archivo["tmp_name"], $this->nombre_archivo);
        }

    }
    
    public function asignarExtensiones($extensiones) {
        $this->extensionesPermitidas = $extensiones;
    }
    
    public function asignarTamanoMaximo($tamano_maximo) {
        $this->tamanoMaximo = $tamano_maximo * 1024000;
    }
    
    public function esArchivo() {
        $verificar = getimagesize($this->archivo['tmp_name']);
        if ($verificar !== false) {
            $this->statusDelArchivo = 1;
        } else {
            $this->statusDelArchivo = 0;
            $this->errores[] = "el archivo adjunto esta corrupto.";
        }
    }
    
    public function archivoExiste() {
        if (file_exists($this->nombre_archivo)) {
            $this->statusDelArchivo = 0;
            $this->errores[] = "el archivo ya existe.";
        }
    }

    public function verificarTamano(){
    	if($this->archivo['size'] > $this->tamanoMaximo){
    		$this->statusDelArchivo=0;
    		$this->errores[] = "el archivo es muy grande.";
    	}
    }

    public function verificarExtension(){

    	if(! in_array($this->tipoArchivo,$this->extensionesPermitidas)){
        		$this->statusDelArchivo=0;
        		$this->errores[] = "Tipo de archivo no permitido.";
        	}
    }
}
?>