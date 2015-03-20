<?php

/**
* 
*/
class Admin extends Modelo
{
	public $usuario;
	public $t_sesion;
	public $plantilla;

	public $titulo;
	public $nombre;

	public function __construct(){
		parent::__construct();
		$this->usuario = new Usuario;
		global $sesion;
		$this->t_sesion =& $sesion;
		$this->plantilla = new Tema;
	}


	public function sayHello(){
		return "Hello";
	}

	public function obtenerPonentes(){
		return $this->aArray($this->query("SELECT * FROM ponencia"));

	}

	public function obtenerLugares(){
		return $this->aArray($this->query("SELECT * FROM lugar"));

	}

	public function obtenerHorarios(){
		return $this->aArray($this->query("SELECT * FROM horario"));

	}

	public function obtenerPonencias(){
		return $this->aArray($this->query("SELECT ponencias.id AS id, ponencias.id_ponencia, ponencias.id_lugar, ponencias.id_horario, ponencia.ponente, ponencia.ponencia, horario.nombre AS hora_nombre, lugar.nombre AS lugar_nombre
FROM ponencias, ponencia, horario, lugar
WHERE ponencias.id_ponencia = ponencia.id
AND ponencias.id_horario = horario.id
AND ponencias.id_lugar = lugar.id"));

	}

	public function convertirOpciones($datos,$id,$valor,$valor2=null){
		
		$data="";
		if($valor2 == null){
		foreach ($datos as $key) {
		 
			$data.="<option value='".$key[$id]."'>".$key[$valor]."</option>";
		}
	} else {

		foreach ($datos as $key) {
		 
			$data.="<option value='".$key[$id]."'>".$key[$valor]." - ".$key[$valor2]."</option>";
		}
	}
		return $data;
	
	}

	public function inciarSesion($usuario,$contrasena){
		return $this->usuario->inciarSesion($usuario,$contrasena);
	}

	public function menu(){
		return Array(
                Array("separador","Menu"),//separador
                Array("sensillo","#","fa fa-book","Registrados"), //menu sensillo
                Array("multiple","#","fa fa-book","Catalogos", //multinivel
                    Array(
                        Array("ponente","fa fa-book","Ponentes"),
                        Array("ponencias","fa fa-book","Ponencias"),
                        Array("#","fa fa-book","Usuarios"),
                        Array("horarios","fa fa-book","horarios"),
                        Array("lugar","fa fa-book","Lugares")
                         )
                     ),
                Array("separador","Menu"), //separador
                Array("sensillo","boletos","fa fa-book","Generar Codigos"),//sensillo             
 );
	}

	public function elementosdePagina(){
        $this->plantilla->titulo=$this->titulo;
		$this->plantilla->ruta=$this->ruta;
        $this->plantilla->nombreApp="Registro";
        $this->plantilla->skin="skin-blue";
        $this->plantilla->piedePagina="Copyright &copy; 2014-2015 <a href='http://almsaeedstudio.com'>TutziLAbs</a>.</strong> Todos los derechos reservados.";
        $this->plantilla->busqueda="Hola";
        $this->plantilla->datos_usuario=Array(
            "imagen"=>RUTA_PLANTILLA_HTML."dist/img/user2-160x160.jpg",
            "usuario"=>"Nombre Usuario",
            "desc1"=>"descripcion 1",
            "desc2"=>"descripcion 2",
            "link1"=>"link 1",
            "link1url"=>"#",
            "link2"=>"link 2",
            "link2url"=>"#",
            "link3"=>"link 3",
            "link3url"=>"#",
            "perfil"=>"#",
            "logout"=>"#"
            );
            //tipos -> separador,sensillo,multimple
        $this->plantilla->menu=$this->menu();


	}
}