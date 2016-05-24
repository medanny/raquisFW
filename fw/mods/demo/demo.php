<?php
namespace  fw\mods\demo;
use fw\mods\utilerias\Utilerias;
/**
 * Class Demo es un ejemplo de como deben de ser creados nuevos, modulos.
 * @package fw\mods\demo
 */
class Demo {
    /**
     * @var String variable privada usada como ejemplo.
     */
    private $variablePrivada;
    /**
     * @var Array con formato Array("arreglo1" => Array(), "arreglo2" => Array());
     */
    protected $variableProtegida;
    /**
     * @var String variable publica.
     */
    public  $variablePublica;
    /**
     * Documentacion de funcion contructora.
     */
    public function __construct(){
        //CODIGO
    }
    /**
     * Documentacion de funcion ejemplo.
     */
    public function ejemplo(){
        return Utilerias::generarToken(10);
    }

}