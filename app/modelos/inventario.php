<?php
namespace app\modelos;
use fw\core\Modelo;
use fw\mods\plantillas\Constructor;
use fw\mods\usuarios\Usuario;

class Inventario extends Modelo{

    protected $usuario;
    protected $plantilla;

    public function __construct(){
        $this->usuario = new Usuario();
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
        $datos_cdc['cdc_titulo']="Caja de Contenido.";
        $datos_cdc['cdc_contenido']="Contenido.";
        $datos_cdc['cdc_footer']="Footer.";
        $this->plantilla->asignarParcial("contenido_principal", "caja_de_contenido", $datos_cdc);
        $this->plantilla->asignarParcial("menu", "menu_simple", Array("articulo_menu" => $this->getMenu()));

        $this->plantilla->mostrar();
    }

    public function getMenu(){
        $menu[]=Array(
            "clase"=>"",
            "url"=>"#",
            "icono"=>"fa fa-book",
            "texto"=>"Usuario"
        );
        $menu[]=Array(
            "clase"=>"",
            "url"=>"#",
            "icono"=>"fa fa-book",
            "texto"=>"Eventos"
        );
        return $menu;
    }
}