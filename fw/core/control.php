<?php
/**
 * Esta clase es la base para, todos los controles de la aplicacion.
 * @author Daniel Lozano Carrillo <daniel@unav.edu.mx>
 * @version 0.2
 * @license MIT
 */

namespace fw\core;
class Control {

	protected $_modelo;
	protected $_control;
	protected $_accion;
	protected $_plantilla;

	/**
	 * Constructor de la clase, recibe variables y contrullo la aplicacion
	 * principal
	 * @param String $modelo  el nombre del modelo
	 * @param String $control el nombre del control
	 * @param String $accion  la accion princial.
	 */

	function __construct($modelo, $control, $accion) {

		$this->_accion = $accion;
		$this->_control = $control;
		$this->_modelo = $modelo;
		$modelo2='\\app\\modelos\\'.$modelo;
		$this->$modelo = new $modelo2;
		$this->_plantilla = new \fw\core\Plantilla($control,$accion);

	}


	/**
	 * Set es usado para asignar variables a vistas.
	 * @param String $nombre  el nombre de la variable.
	 * @param String $valor el valor de la variable.
	 */
	function set($nombre,$valor) {
		$this->_plantilla->set($nombre,$valor);
	}


	/**
	 * Mandar a renderizar la aplicacion antes de terminar.
	 */
	function __destruct() {
		$this->_plantilla->render();
	}

}
