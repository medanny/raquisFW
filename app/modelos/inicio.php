<?php
namespace app\modelos;
class Inicio extends \fw\core\Modelo{

    public $plantilla;
    public $titulo;
    public $nombre;
    public function init(){

        $this->plantilla = new \fw\plantillas\adminlte\Tema;
    }

    public function alive(){
        echo "Im alive";
    }

    public function getBooks(){
         return $this->seleccionar("libros","nombre,genero",Array(Array('id',1,2)),'nombre',1);
    }

    public function deleteBook(){

    }

    public function addBook(){

    }

    public function findBook(){

    }

    public function updateBook(){

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
?>