<?php
namespace fw\plantillas\adminlte;
class Estructura{

public static function abr_sidebar(){
return <<<html
<aside class="left-side sidebar-offcanvas">
<section class="sidebar">
html;
}

public static function cer_sidebar(){
return <<<html
</section>
</aside>
html;
}


public static function abr_menu(){
return <<<html
<ul class="sidebar-menu">
html;
}

public static function cer_menu(){
return <<<html
</ul>
html;
}





}