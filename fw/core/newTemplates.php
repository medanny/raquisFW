<?php
namespace fw\core;

/**
 * Class newTemplates
 * @package fw\core
 * @author Daniel Lozano Carrillo
 * @email daniel@unav.edu.mx
 * @version 0.2
 */
class newTemplates
{
    var $valores = array();
    var $tpl;
    var $partialBuffer;
    var $bufferBloqueRepetido;
    var $delSimple_Abrir="{";
    var $delSimple_Cerrar="{";
    var $delParcial_Abrir="[";
    var $delParcial_Cerrar="]";
    var $delComplejo_Abrir="{{";
    var $delComplejo_Cerrar="}}";


    function __construct($_path = " ")
    {

        if (!empty($_path)) {
            if (file_exists($_path)) {
                $this->tpl = file_get_contents($_path);
			} else {
                //error code
            }
        }

    }

    /**
     * @param $_searchString
     * @param $_replaceString
     */
    function __assign($_searchString, $_replaceString)
    {
        if (!empty($_searchString)) {
            $this->valores[strtoupper($_searchString)] = $_replaceString;
        }
    }

    function _parsearEtiqueta($_etiqueta,$_dato,$_html){
        if($_etiqueta){
            if(is_array($_dato)){
                return $this->_remplazoComplejo($_etiqueta,$_dato,$_html);
            }else{
                return $this->_remplazoSimple($_etiqueta,$_dato,$_html);
            }
        }else{
            die("Es necesario proveer una etiqueta.");
        }
    }

    /**
     * @param $_etiqueta
     * @param $_dato
     * @param $_html
     * @return String
     */
    function _remplazoSimple($_etiqueta,$_dato,$_html){
        return str_replace($this->delSimple_Abrir . $_etiqueta . $this->delSimple_Cerrar, $_dato, $_html);
    }

    /**
     * @param $_etiqueta
     * @param $_dato
     * @param $_html
     */
    function _remplazoComplejo($_etiqueta,$_dato,$_html){
        if(($resultado = $this->_encontrarPar($_html, $_etiqueta)) === false){
            return $_html;
        }
        $str = '';
        foreach($_dato as $row)
        {
            $temp = $resultado['1'];
            foreach($row as $key => $val)
            {
                if(!is_array($val)){
                    $temp = $this->_remplazoSimple($key, $val, $temp);
                }
                else{
                    $temp = $this->_remplazoComplejo($key, $val, $temp);
                }
            }
            $str .= $temp;
        }
        return str_replace($resultado['0'], $str, $_html);
    }

    function _encontrarPar($_html, $_etiqueta)
    {
        if (!preg_match("|" . preg_quote($this->delComplejo_Abrir) . $_etiqueta . preg_quote($this->delComplejo_Cerrar) . "(.+?)". preg_quote($this->delComplejo_Abrir) . '/' . $_etiqueta . preg_quote($this->delComplejo_Cerrar) . "|s", $_html, $resultado))
            return false;
        return $resultado;
    }

    function renderPartial($_searchString, $_path, $_assignValues = array())
    {
        if (!empty($_searchString)) {
            if (file_exists($_path)) {
                $this->partialBuffer = file_get_contents($_path);

                if (count($_assignValues) > 0) {
                    foreach ($_assignValues as $key => $value) {
                        $this->partialBuffer= _parsearEtiqueta($key,$value,$this->partialBuffer);
                    }
                }

                $this->tpl = str_replace($this->delParcial_Abrir . strtoupper($_searchString) . $this->delParcial_Cerrar, $this->partialBuffer, $this->tpl);

            } else {
                //error code
            }
        }

    }


    function show()
    {
        if (count($this->valores) > 0) {
            foreach ($this->valores as $key => $value) {
                $this->tpl= _parsearEtiqueta($key,$value,$this->tpl);
            }
        }
        echo $this->tpl;

    }
}