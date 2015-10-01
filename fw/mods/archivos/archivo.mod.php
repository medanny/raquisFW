<?php
/**
 * Archivo.mod.php es usado para gestionar archivos, puede guardar y obtener informacio
 * de archivos subidos.
 *
 * @author Daniel Lozano Carrillo <daniel@unav.edu.mx>
 * @version 0.1
 * @license MIT
 * @todo Pruebas
 */

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
    

    /**
     * Constructor, al inicializar necesitamos indicar el directorio y archivo.
     * @param String $directorio Lugar donde se desea guardar el archivo.
     * @param String $archivo    El archivo subido generalmente viene de $_FILE.
     */
    public function __construct($directorio, $archivo) {
    	//var_dump($archivo);
        $this->archivo = $archivo;
        $this->directorioDeseado = $directorio;
        $this->nombre_archivo = $this->directorioDeseado . basename($archivo['name']);
        $this->statusDelArchivo = 1;
        $this->tipoArchivo = pathinfo($this->nombre_archivo, PATHINFO_EXTENSION);
    }

    /**
     * Esta funcion se encarga de validad y guardar el archivo.
     * @return Bool Regresa FALSE o TRUE dependiendo si se alla subido el archivo.
     */
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
    /**
     * Asigna y habilita la validadcion de extenciones.
     * @param  Array $extensiones Extensiones permitidas. Eje. Array("docx","pdf");
     * @return void
     */
    public function asignarExtensiones($extensiones) {
        $this->extensionesPermitidas = $extensiones;
    }
    
    /**
     * Asigna y habilita la validadcion de tamano maximo del archivo.
     * @param  Int $tamano_maximo tamano maximo del archivo especificado en Mbs.
     * @return void
     */
    public function asignarTamanoMaximo($tamano_maximo) {
        $this->tamanoMaximo = $tamano_maximo * 1024000;
    }

    /**
     * Verifica si el archivo ya existe en nuestro servidor.
     * @return void
     */
    public function archivoExiste() {
        if (file_exists($this->nombre_archivo)) {
            $this->statusDelArchivo = 0;
            $this->errores[] = "el archivo ya existe.";
        }
    }

    /**
     * Verifica el tamano del Archivo
     * @return void
     */
    public function verificarTamano(){
    	if($this->archivo['size'] > $this->tamanoMaximo){
    		$this->statusDelArchivo=0;
    		$this->errores[] = "el archivo es muy grande.";
    	}
    }

    /**
     * Verifica las extensiones
     * @return void
     */
    public function verificarExtension(){

    	if(! in_array($this->tipoArchivo,$this->extensionesPermitidas)){
        		$this->statusDelArchivo=0;
        		$this->errores[] = "Tipo de archivo no permitido.";
        	}
    }
}
?>