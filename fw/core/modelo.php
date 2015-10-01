<?php
namespace fw\core;
class Modelo extends \fw\mods\db\mainDBDriver {
	protected $_modelo;

	function __construct() {
		parent::__construct(BD_DRIVER);
	}

	function __destruct(){


	}
}