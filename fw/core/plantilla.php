<?php
namespace fw\core;
class Plantilla {

	protected $variables = array();
	protected $_control;
	protected $_accion;

	function __construct($control,$accion) {

		$this->_control = $control;

		$this->_accion = $accion;
	}

	/**
	 * Set es usado para asignar variables a vistas.
	 * @param String $name  el nombre de la variable.
	 * @param String $value el valor de la variable.
	 */
	function set($nombre,$valor) {
		$this->variables[$nombre] = $valor;
	}

	/**
	 * Esta clase se clase se encarga, de renderizar la vista general de la persona,
	 */

    function render() {
		extract($this->variables);

			if (file_exists(ROOT . DS . 'app' . DS . 'vistas' . DS . $this->_control . DS . 'encabezado.php')) {
				include (ROOT . DS . 'app' . DS . 'vistas' . DS . $this->_control . DS . 'encabezado.php');
			} else {
				include (ROOT . DS . 'app' . DS . 'vistas' . DS . 'encabezado.php');
			}

        include (ROOT . DS . 'app' . DS . 'vistas' . DS . $this->_control . DS . $this->_accion . '.php');

			if (file_exists(ROOT . DS . 'app' . DS . 'vistas' . DS . $this->_control . DS . 'pie.php')) {
				include (ROOT . DS . 'app' . DS . 'vistas' . DS . $this->_control . DS . 'pie.php');
			} else {
				include (ROOT . DS . 'app' . DS . 'vistas' . DS . 'pie.php');
			}
    }

}
