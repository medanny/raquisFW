<?php
/**
 * la clase Lenguaje puede ser usadaba para crear aplicaciones, en diferentes diferentes idiomas
 * usando archivos .ini faciles de entender y desarrollar por usuarios comunes, facilitando su 
 * traduccion.
 *
 * @author Daniel Lozano Carrillo <daniel@unav.edu.mx>
 * @package fw\mods\lenguajes
 * @version 0.1
 * @license MIT
 * 
 */
namespace fw\mods\lenguajes;
class Lenguaje {
	private $locale;
	public $g = Array();
	/**
	 * Constructor, se encarga, de construir la plantilla recibe el lenguaje y jala el lenguaje,
	 * de los archivos ini, si ningun lenguaje es especificado, lo carga del request HTTP y valida
	 * si existe, si no existe lo carga de la configuracion.
	 * @param String $lenguaje el lenguaje ex: en,es,fr
	 */
	public function __construct($_locale = null){
		//si se especifica un locale y es soportado asignarlo.
		if(isset($_locale) && $this->soportado($_locale)){
			$this->locale = $_locale;
		}else{
			//si no encontrarlo del servidor.
			$locale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
			echo " Server Locale:". $locale. "<br>";
			if($this->soportado($locale)){
				$this->locale = $locale;
			}else{
				//si aun no lo tenemos usar el principal especificado en la configuracion.
				$this->locale = LOCALE_PRINCIPAL;
			}
		}
		$archivo=ROOT."/app/lang/".$this->locale.".ini";
		if(file_exists($archivo)){
			$this->g = parse_ini_file($archivo);
		}else{

		}
	}

	/**
	 * Esta funcion parsea textos con variables dentro.
	 * @param String $texto texto a parsear "Hola, {1} bienvenido, hoy es {2}"
	 * @param String $datos arreglo de datos Array("Daniel", "Lunes");
     */
	public function prs($texto, $datos){
		$tamano = count($datos);
		for($i = 0; $i < $tamano; $i++){
			$texto = str_replace("{".($i+1)."}",$datos[$i],$texto);
		}
		return $texto;
	}

	private function soportado($_locale){
		$archivo=ROOT."/app/lang/".$_locale.".ini";
		if(file_exists($archivo)){
			return true;
		}else{
			return false;
		}
	}



}