<?php
namespace app\controles;
use fw\core\Control;
class InventarioControl extends Control{
    public function index($catalogo, $id = null, $accion=null){
        $inventario_espacial['articulo']= Array(
            "departamento_id" => Array("departamentos","id_departamento","nombre_departamentos"),
            "categoria_id" => Array("categorias","id_categoria","nombre_categoria")
        );
        if(isset($catalogo)) {
            $html = "";
            $this->Inventario->iniciar();
            $archivo = "http://raquis.tutzilabs.com.mx/raquisFW/inventario/index/$catalogo";
            $this->Inventario->archivo=$archivo;
            $this->Inventario->crearCatalogo($catalogo."s", "id_" . $catalogo, $archivo);
            $this->Inventario->catalogo->ignorar = Array("id_" . $catalogo);
            if(isset($inventario_espacial[$catalogo])){
                $this->Inventario->catalogo->relacion = $inventario_espacial[$catalogo];
            }
            if(isset($_POST['accion'])){
                $this->Inventario->catalogo->router($_POST);
            }
            if($accion=="borrar"){
                $this->Inventario->catalogo->borrarEntradaCatalogo($catalogo."s", "id_" . $catalogo, $id);
            }
            if (isset($id)) {
                $html .= "<h2>Actualizar</h2>";
                $html .= $this->Inventario->catalogo->generarFormularioActualizar($id);
            }
            $html .= "<h2>Insertar</h2>";
            $html .= $this->Inventario->catalogo->generarFormularioInsertar();
            $html .= "<h2>Tabla</h2>";
            $html .= $this->Inventario->catalogo->generarTabla();
            $datos_cdc['cdc_titulo'] = $catalogo."s";
            $datos_cdc['cdc_contenido'] = $html;
            $datos_cdc['cdc_footer'] = "";
            $this->Inventario->plantilla->asignarParcial("contenido_principal", "caja_de_contenido", $datos_cdc);
            $this->Inventario->plantilla->mostrar();
        }
    }
}