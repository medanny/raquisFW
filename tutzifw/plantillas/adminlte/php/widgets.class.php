<?php
class Widgets
{
    
public static function menuBusqueda($action = '', $method = 'GET') {
        return <<<EOT
    <!-- search form -->
    <form action="$action" method="$method" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
        <span class="input-group-btn">
        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
    </div>
    </form>
<!-- /.search form -->
EOT;
}

public static function menuPaneldeUsuario($img, $usuario, $status) {
return <<<EOT
<div class="user-panel">
    <div class="pull-left image">
        <img src="$img" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
        <p>$username</p>
        <a href="#"><i class="fa fa-circle text-success"></i> $status</a>
    </div>
</div>
EOT;
}

public static function menu_sensillo($url, $icon, $texto) {
return <<<EOT
<li>
    <a href="$url">
    <i class="fa fa-$icon"></i> <span>$texto</span>
    </a>
</li>

EOT;
}

public static function menu_arbol($principal,$submenu) {
//princal array ['Nombre, Icono'];
//submenu array[ array['link','icono','texto'],array['link','icono','texto']];
$html = '
<li class="treeview">
    <a href="$principal[0]">
    <i class="fa fa-'.$principal[1].'"></i>
    <span>'.$principal[2].'</span>

    <i class="fa fa-angle-left pull-right"></i>
    </a>
<ul class="treeview-menu">';

foreach ($submenu as $key) {
    		$html=$html.'<li><a href="'.$key[0].'"><i class="fa fa-angle-double-right"></i>'.$key[1].'</a></li>';
}

$html=$html." </ul> </li>";
return $html;



}


}

?>