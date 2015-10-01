<?php
namespace fw\plantillas\adminlte;
class Widgets{

public static function loginbox($nombre, $desc, $input_usuario, $input_clave, $submit, $link_1_texto, $link_1_url, $link_2_texto, $link_2_url){

return <<<EOT

<div class="login-box">
      <div class="login-logo">
        <a href="">$nombre</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">$desc</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input class="form-control" placeholder="Usuario" type="text" name="$input_usuario">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input class="form-control" placeholder="Contrasena" type="password" name="$input_clave">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">$submit</button>
            </div><!-- /.col -->
          </div>
        </form>


        <a href="$link_1_url">$link_1_texto</a><br>
        <a href="$link_2_url" class="text-center">$link_2_texto</a>

      </div><!-- /.login-box-body -->
    </div>


EOT;

}

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