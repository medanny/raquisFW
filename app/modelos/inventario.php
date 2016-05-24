<?php
namespace app\modelos;
use fw\core\Modelo;
use fw\mods\catalogos\Catalogo;
use fw\mods\plantillas\Constructor;
use fw\mods\usuarios\Usuario;

class Inventario extends Modelo{

    protected $usuario;
    public $plantilla;
    public $catalogo;
    public $archivo;
    public function __construct(){
        $this->usuario = new Usuario();
    }
    public function crearCatalogo($_tabla,$_id, $_archivo = null){
        $this->catalogo = new Catalogo($_tabla,$_id , $_archivo);
    }
    public function iniciar(){
        $this->plantilla = new Constructor("Hola mundo");
        $this->plantilla->asignarValor("skin","skin-blue sidebar-mini");
        $this->plantilla->asignarParcial("footer","footer",Array());
        $datos_hp['h_logo_url'] = "#";
        $datos_hp['h_logo_mini'] = "<b>I</b>nvt";
        $datos_hp['h_logo_lg'] = "<b>FW</b>Invt";
        $this->plantilla->asignarParcial("header","header",$datos_hp);
        $datos_sb['pu_prof_img_url']="{RUTA_PLANTILLA_HTML}dist/img/user2-160x160.jpg";
        $this->plantilla->asignarParcial("sidebar","sidebar",Array());
        $datos_contenido=Array("nombre_pagina" => "Pagina con caja.", "descripcion_pagina"=>"Bienvenido");
        $this->plantilla->asignarParcial("content","content",$datos_contenido);
        $this->plantilla->asignarParcial("menu", "menu_simple", Array("articulo_menu" => $this->getMenu()));

    }
    public function getMenu(){
        //crear menu
        $menu[]=Array(
            "clase"=>"",
            "url"=>$this->archivo."articulo",
            "icono"=>"fa fa-book",
            "texto"=>"Articulos"
        );
        $menu[]=Array(
            "clase"=>"",
            "url"=>$this->archivo."categoria",
            "icono"=>"fa fa-book",
            "texto"=>"Categorias"
        );
        $menu[]=Array(
            "clase"=>"",
            "url"=>$this->archivo."departamento",
            "icono"=>"fa fa-book",
            "texto"=>"Departamentos"
        );
        return $menu;
    }
}