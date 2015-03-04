<?php

interface TemaBase {
	public function menu($menu);
	public function titulo($titulo);
	public function ruta($ruta);
	public function encabezado();
	public function pie();
	public function renderizar();
}