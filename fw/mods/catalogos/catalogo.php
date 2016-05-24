<?php
namespace fw\mods\catalogos;
use fw\mods\db\mainDBDriver;
use fw\mods\utilerias\Utilerias;

/**
 * Class Catalogo
 *
 * Esta clase se encarga de generar catalogos para insertar, borrar y actulizar, visualizar la informacion
 * de una tabla de la base de datos.
 * @package fw\mods\catalogos
 * @author Daniel Lozano <mail@medanny.com>
 * @version 1.0
 */
class Catalogo{

    /**
     * @var String Nombre de la tabla.
     */
    public $tabla;

    /**
     * @var String id de la tabla.
     */
    public $id;

    /**
     * @var Array Asociativo en el siguiente formato
     * Array("(nombre del campo)" => Array("(nombre de la tabla)", "(id de la tabla)", "(campo a visualizar)"));
     * @example Array("maestro_id" => Array("maestros","id_maestro","nombre_maestro"));
     */
    public $relacion; //Array()

    /**
     * @var Array Asciativo, usado para no usar el nombre de la tabla en los textos generados.
     * @example Array("nombre_maestro" => "Nombre", "apellido_maestro" => "Apellido");
     */
    public $nombres;

    /**
     * @var Array Asociativo, campos a ignorar al generar tablas y campos de insertar y editar.
     * @example Array("id_alumno","clave");
     */
    public $ignorar;

    /**
     * Construlle el catalogo
     * @param $_tabla String nombre de la tabla.
     * @param $_id String campo id de la tabla.
     */
    public $hidden;
    private $db;
    private $archivo;
    public function __construct($_tabla,$_id, $_archivo =  null){
        $this->tabla = $_tabla;
        $this->id = $_id;
        //generar conexion a base de datos.
        $this->db =  new mainDBDriver("mysql");
        if($_archivo == null){
            $this->archivo = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'';
        }else{
            $this->archivo = $_archivo;
        }
        $this->relacion = Array();
        $this->ignorar = Array();
        $this->hidden = Array();
    }

    /**
     * @param Array $ignorar
     */
    public function setIgnorar($ignorar)
    {
        $this->ignorar = $ignorar;
    }

    /**
     * @param Array $relacion
     */
    public function setRelacion($relacion)
    {
        $this->relacion = $relacion;
    }

    /**
     * @param mixed $hidden
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden;
    }




    private function getCatalogo($_tabla){
        $query =
            "SELECT *".
            " FROM $_tabla";
        return $this->db->q($query)->aArray();

    }

    private function getEntradaCatalogo($_tabla,$_campo,$_id){
        $query =
            "SELECT * ".
            " FROM $_tabla".
            " WHERE $_campo = $_id";
        return $this->db->q($query)->aArray();

    }

    private function getInfTabla($_tabla){
        $query = "DESCRIBE $_tabla";
        return $this->db->q($query)->aArray();
    }

    public function borrarEntradaCatalogo($_tabla,$_campo,$_id){
        $query =
            "DELETE ".
            " FROM $_tabla".
            " WHERE $_campo = $_id";
        $this->db->query($query);
        Utilerias::redirectSeguro($this->archivo);
    }

    protected function editarCatalogo($_datos){
        $this->db->actualizarXArray($_datos);
    }

    protected function insertarCatalogo($_datos){
        $this->db->insertarXArray($_datos);
    }

    private function generarOpciones($array, $campo_id, $campo_nombre, $id = null){
        $html = "";
        foreach ($array as $dato) {
            if ($dato[$campo_id] == $id) {
                $html.= "<option value='" . $dato[$campo_id] . "' selected>" . $dato[$campo_nombre] . "</option>";
            } else {
                $html.= "<option value='" . $dato[$campo_id] . "'>" . $dato[$campo_nombre] . "</option>";
            }
        }
        return $html;
    }

    private function tipoDato($string) {

        $string = preg_replace("/\([^)]+\)/", "", $string);
        switch ($string) {
            case 'varchar':
                return "text";
                break;
            case 'int':
                return "number";
                break;
            case 'double':
                return "number";
                break;
            case 'date':
                return "date";
                break;
            default:
                return "text";
                break;
        }
    }

    public function generarFormularioInsertar() {
        //echo "Generando Formulario";
        $archivo = $this->archivo;
        $medio = $this->tabla;
        $ignorar = $this->ignorar;
        $especial = $this->relacion;
        $hidden = $this->hidden;

        $campos = $this->getInfTabla($medio);
        $html = "<form action='' method='post'>".
            "<input type='hidden' name='accion' value='insertar'>".
            "<input type='hidden' name='fuente' value='" . $archivo . "'>".
            "<input type='hidden' name='nombre_tabla' value='" . $medio . "'>";
        if (count($hidden) > 0) {
            foreach ($hidden as $key) {
                $html.= "<input type='hidden' name='" . $key[0] . "' value='" . $key[1] . "'>";
            }
        }
        foreach ($campos as $campo) {
            if (array_key_exists($campo['Field'], $especial)) {
                $html.= "<select name='" . $campo['Field'] . "' >";
                $html.= "<option value='' disabled selected>" . $campo['Field'] . "</option>";
                $html.= $this->generarOpciones($this->getCatalogo($especial[$campo['Field']][0]), $especial[$campo['Field']][1], $especial[$campo['Field']][2]);
                $html.= "</select>";
                $html.= "<br>";
            } else {
                $tipo = $this->tipoDato($campo['Type']);
                $nombre = $campo['Field'];
                if (!in_array($nombre, $ignorar)) {
                    $html.= "<input type='" . $tipo . "' name='" . $nombre . "' placeholder='" . $nombre . "' required='required'><br>";
                }
            }
        }
        $html.= "<input type='submit' value='Enviar'>";
        $html.= "</form>";
        return $html;
    }


    function generarTabla() {
        $archivo = $this->archivo;
        $medio = $this->tabla;
        $ignorar = $this->ignorar;
        $especial = $this->relacion;
        $hidden = $this->hidden;

        $campos = $this->getInfTabla($medio);
        $articulos = $this->getCatalogo($medio);

        $html = "<table class='table'><tr>";
        foreach ($campos as $campo) {
            $nombre = $campo['Field'];

            if (!in_array($nombre, $ignorar)) {
                $html.= "<th>" . $nombre . "</th>";
            }
        }
        $html.= "<th></th><th></th></tr>";

        foreach ($articulos as $articulo) {
            $html.= "<tr>";
            foreach ($campos as $campo) {
                if (array_key_exists($campo['Field'], $especial)) {
                    $nombre = $campo['Field'];

                    // obtenerCatalogoUnico($medio, $campo, $id)
                    $datos = $this->getEntradaCatalogo($especial[$campo['Field']][0], $especial[$campo['Field']][1], $articulo[$nombre]);
                    $html.= "<td>" . $datos[0][$especial[$campo['Field']][2]] . "</td>";
                } else {
                    $nombre = $campo['Field'];
                    if (!in_array($nombre, $ignorar)) {
                        $html.= "<td>" . $articulo[$nombre] . "</td>";
                    }
                }
            }

            $html.= "<td><a href='" . $archivo . "/" . $articulo[$this->id] ."/". "borrar'>Borrar</a></td>";
            $html.= "<td><a href='" . $archivo . "/" . $articulo[$this->id] . "'>Editar</a></td>";

            $html.= "</tr>";
        }
        $html.= "</table>";
        return $html;
    }

    function generarTablaEspecial($archivo, $medio, $ignorar = Array(), $id, $especial = Array(), $articulos) {
        $archivo = $this->archivo;
        $medio = $this->tabla;
        $ignorar = $this->ignorar;
        $especial = $this->relacion;
        $hidden = $this->hidden;

        $campos = $this->getInfTabla($medio);
        $html = "<table><tr>";
        foreach ($campos as $campo) {
            $nombre = $campo['Field'];

            if (!in_array($nombre, $ignorar)) {
                $html.= "<th>" . $nombre . "</th>";
            }
        }
        $html.= "<th></th><th></th></tr>";

        foreach ($articulos as $articulo) {
            $html.= "<tr>";
            foreach ($campos as $campo) {
                if (array_key_exists($campo['Field'], $especial)) {
                    $nombre = $campo['Field'];

                    // obtenerCatalogoUnico($medio, $campo, $id)
                    $datos = $this->getEntradaCatalogo($especial[$campo['Field']][0], $especial[$campo['Field']][1], $articulo[$nombre]);
                    $html.= "<td>" . $datos[0][$especial[$campo['Field']][2]] . "</td>";
                } else {
                    $nombre = $campo['Field'];
                    if (!in_array($nombre, $ignorar)) {
                        $html.= "<td>" . $articulo[$nombre] . "</td>";
                    }
                }
            }

            $html.= "<td><a href='super_catalogos.php?accion=borrar&medio=" . $medio . "&fuente=" . $archivo . "&campo=" . $id . "&id=" . $articulo['id'] . "'>Borrar</a></td>";
            $html.= "<td><a href='" . $archivo . "id=" . $articulo['id'] . "'>Editar</a></td>";

            $html.= "</tr>";
        }
        $html.= "</table>";
        return $html;
    }
    function generarFormularioActualizar($id_articulo) {

        $archivo = $this->archivo;
        $medio = $this->tabla;
        $ignorar = $this->ignorar;
        $especial = $this->relacion;
        $hidden = $this->hidden;
        $id= $this->id;

        $campos = $this->getInfTabla($medio);
        $articulo = $this->getEntradaCatalogo($medio, $id, $id_articulo);
        $html = "<form action='' method='post'>
<input type='hidden' name='accion' value='actualizar'>
<input type='hidden' name='fuente' value='" . $archivo . "'>
<input type='hidden' name='nombre_tabla' value='" . $medio . "'>
<input type='hidden' name='nombre_identificador' value='" . $id . "'>
<input type='hidden' name='identificador_valor' value='" . $id_articulo . "'>";

        foreach ($campos as $campo) {
            if (array_key_exists($campo['Field'], $especial)) {
                $html.= "<select name='" . $campo['Field'] . "' >";
                $html.= "<option value='' disabled>" . $campo['Field'] . "</option>";

                $html.= $this->generarOpciones($this->getCatalogo($especial[$campo['Field']][0]), $especial[$campo['Field']][1], $especial[$campo['Field']][2], $id_articulo);
                $html.= "</select>";
                $html.= "<br>";
            } else {
                $tipo = $this->tipoDato($campo['Type']);
                $nombre = $campo['Field'];
                if (!in_array($nombre, $ignorar)) {
                    $html.= "<input type='" . $tipo . "' name='" . $nombre . "' placeholder='" . $nombre . "' value='" . $articulo[0][$nombre] . "'><br>";
                }
            }
        }
        $html.= "<input type='submit' value='Enviar'>";
        $html.= "</form>";
        return $html;
    }
    /**
     * Esta funcion se encarga de recibir y mandar los datos para
     * ser procesados.
     * @param $_datos Array de datos del post o get.
     * @throws \Exception si no se especifica una accion.
     */
    public function router($_datos){
        if(isset($_datos['accion'])){
            $accion = $_datos['accion'];
            switch($accion){
                case 'insertar':
                    unset($_datos['accion']);
                    $fuente = $_datos['fuente'];
                    unset($_datos['fuente']);
                    $this->insertarCatalogo($_datos);
                    Utilerias::redirectSeguro($fuente);
                    break;

                case 'actualizar':
                    unset($_datos['accion']);
                    $fuente = $_datos['fuente'];
                    unset($_datos['fuente']);
                    $this->editarCatalogo($_datos);
                    Utilerias::redirectSeguro($fuente);
                    break;

                case 'borrar':
                    $medio = $_datos['medio'];
                    $campo = $_datos['campo'];
                    $id = $_datos['id'];
                    $fuente = $_datos['fuente'];
                    unset($_datos['fuente']);
                    $this->borrarEntradaCatalogo($medio, $campo, $id);
                    Utilerias::redirectSeguro($fuente);
                    break;
                default:
                    throw new \Exception("Accion $accion no es soportada.");
                    break;

            }
        }else{
            throw new \Exception("No se especifico ninguna accion.");
        }
    }

    public function getTabla(){

    }

    public function getInsert(){

    }

    public function getUpdate(){

    }

}