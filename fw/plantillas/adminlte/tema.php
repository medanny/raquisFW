<?php
namespace fw\plantillas\adminlte;
class Tema{

	  protected $nombreApp;
    protected $titulo;
	  protected $ruta;
	  protected $menu;
	  protected $html;
    protected $skin;
    protected $mensajes;
    protected $notificaciones;
    protected $tareas;
    protected $datos_usuario;
    protected $busqueda;
    protected $piedePagina;


    public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

	public function __construct(){
	}


	public function encabezado(){
		$plantilla=RUTA_PLANTILLA_HTML;
	return "<!DOCTYPE html>
	<html>
	<head>
    <meta charset='UTF-8'>
    <title>".$this->titulo."</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href='". RUTA_PLANTILLA_HTML ."bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' type='text/css' />
    <link href='http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."dist/css/AdminLTE.min.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."dist/css/skins/_all-skins.min.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/iCheck/flat/blue.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/morris/morris.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/jvectormap/jquery-jvectormap-1.2.2.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/datepicker/datepicker3.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/daterangepicker/daterangepicker-bs3.css' rel='stylesheet' type='text/css' />
    <link href='". RUTA_PLANTILLA_HTML ."plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css' rel='stylesheet' type='text/css' />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
        <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
    <![endif]-->
  </head>
  <body class='".$this->skin."'>
  ";

	}

	public function pie(){

		return "
        <!-- jQuery 2.1.3 -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/jQuery/jQuery-2.1.3.min.js'></script>
    <!-- jQuery UI 1.11.2 -->
    <script src='".RUTA_PLANTILLA_HTML."http://code.jquery.com/ui/1.11.2/jquery-ui.min.js' type='text/javascript'></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src='".RUTA_PLANTILLA_HTML."bootstrap/js/bootstrap.min.js' type='text/javascript'></script>
    <!-- Morris.js charts -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js'></script>
    <script src='".RUTA_PLANTILLA_HTML."plugins/morris/morris.min.js' type='text/javascript'></script>
    <!-- Sparkline -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/sparkline/jquery.sparkline.min.js' type='text/javascript'></script>
    <!-- jvectormap -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' type='text/javascript'></script>
    <script src='".RUTA_PLANTILLA_HTML."plugins/jvectormap/jquery-jvectormap-world-mill-en.js' type='text/javascript'></script>
    <!-- jQuery Knob Chart -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/knob/jquery.knob.js' type='text/javascript'></script>
    <!-- daterangepicker -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/daterangepicker/daterangepicker.js' type='text/javascript'></script>
    <!-- datepicker -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/datepicker/bootstrap-datepicker.js' type='text/javascript'></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js' type='text/javascript'></script>
    <!-- iCheck -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/iCheck/icheck.min.js' type='text/javascript'></script>
    <!-- Slimscroll -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/slimScroll/jquery.slimscroll.min.js' type='text/javascript'></script>
    <!-- FastClick -->
    <script src='".RUTA_PLANTILLA_HTML."plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src='".RUTA_PLANTILLA_HTML."dist/js/app.min.js' type='text/javascript'></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src='".RUTA_PLANTILLA_HTML."dist/js/pages/dashboard.js' type='text/javascript'></script>

    <!-- AdminLTE for demo purposes -->
    <script src='".RUTA_PLANTILLA_HTML."dist/js/demo.js' type='text/javascript'></script>
  </body>
</html>";

	}
  public function cerCont(){

    return "</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
";
  }
  public function footer(){

    return "

      <footer class='main-footer'>
        <div class='pull-right hidden-xs'>
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href='http://almsaeedstudio.com'>TutziLAbs</a>.</strong> Todos los derechos reservados.
      </footer>
    </div><!-- ./wrapper -->";
  }

    public function abrNav(){
        return " <!-- Site wrapper -->
    <div class='wrapper'>

      <header class='main-header'>
        <a href='#' class='logo'>".$this->nombreApp."</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class='navbar navbar-static-top' role='navigation'>
          <!-- Sidebar toggle button-->
          <a href='#' class='sidebar-toggle' data-toggle='offcanvas' role='button'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </a>
          <div class='navbar-custom-menu'>
            <ul class='nav navbar-nav'>";
    }
    public function cerNav(){

        return "
        </ul>
          </div>
        </nav>
      </header>";
    }

    public function ahtml($contenido){
        $this->html=$this->html.$contenido;
    }

    public function generarDatosUsuario(){
        return "<!-- User Account: style can be found in dropdown.less -->
              <li class='dropdown user user-menu'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                  <img src='".$this->datos_usuario['imagen']."' class='user-image' alt='User Image'/>
                  <span class='hidden-xs'>".$this->datos_usuario['usuario']."</span>
                </a>
                <ul class='dropdown-menu'>
                  <!-- User image -->
                  <li class='user-header'>
                    <img src='".$this->datos_usuario['imagen']."' class='img-circle' alt='User Image' />
                    <p>
                      ".$this->datos_usuario['usuario']." - ".$this->datos_usuario['desc1']."
                      <small>".$this->datos_usuario['desc2']."</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class='user-body'>
                    <div class='col-xs-4 text-center'>
                      <a href='".$this->datos_usuario['link1url']."'>".$this->datos_usuario['link1']."</a>
                    </div>
                    <div class='col-xs-4 text-center'>
                      <a href='".$this->datos_usuario['link2url']."'>".$this->datos_usuario['link2']."</a>
                    </div>
                    <div class='col-xs-4 text-center'>
                      <a href='".$this->datos_usuario['link3url']."'>".$this->datos_usuario['link3']."</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class='user-footer'>
                    <div class='pull-left'>
                      <a href='".$this->datos_usuario['perfil']."' class='btn btn-default btn-flat'>Perfil</a>
                    </div>
                    <div class='pull-right'>
                      <a href='".$this->datos_usuario['logout']."' class='btn btn-default btn-flat'>Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
            ";
    }
    public function abrSidebar()
    {
        # code...
        return "
 <!-- Left side column. contains the sidebar -->
      <aside class='main-sidebar'>
        <!-- sidebar: style can be found in sidebar.less -->
        <section class='sidebar'>
          <!-- Sidebar user panel -->
        ";
    }
    public function infoUsuLat(){
      return "<div class='user-panel'><div class='pull-left image'>
              <img src='".RUTA_PLANTILLA_HTML."dist/img/user2-160x160.jpg' class='img-circle' alt='User Image' />
            </div>
            <div class='pull-left info'>
              <p>Alexander Pierce</p>

              <a href='#'><i class='fa fa-circle text-success'></i> Online</a>
            </div>
          </div>";
    }

    public function abrBusqueda(){
      return "<!-- search form -->
          <form action='#' method='get' class='sidebar-form'>
            <div class='input-group'>
              <input type='text' name='q' class='form-control' placeholder='Search...'/>
              <span class='input-group-btn'>
                <button type='submit' name='seach' id='search-btn' class='btn btn-flat'><i class='fa fa-search'></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->";
    }
    public function abrMenu(){
        $code="<ul class='sidebar-menu'>";
        //var_dump($this->menu);



          for($i=0; $i< count($this->menu);$i++){

          switch ($this->menu[$i][0]) {
            case 'separador':
              # code...
              $code.="<li class='header'>".$this->menu[$i][1]."</li>";
              break;

            case 'sensillo':
              # code...
              $code.="<li><a href='".$this->menu[$i][1]."'><i class='".$this->menu[$i][2]."'></i>".$this->menu[$i][3]."</a></li>";
              break;

            case 'multiple':
              # code...
              #
              $code.="<li class='treeview'>
              <a href='".$this->menu[$i][1]."'>
                <i class='".$this->menu[$i][2]."'></i> <span>".$this->menu[$i][3]."</span>
                <i class='fa fa-angle-left pull-right'></i>
              </a>
              <ul class='treeview-menu'>
              ";
              for($x=0;$x<count($this->menu[$i][4]);$x++){
                $code.="<li><a href='".$this->menu[$i][4][$x][0]."'><i class='".$this->menu[$i][4][$x][1]."'></i>".$this->menu[$i][4][$x][2]."</a></li>";
              }
              $code.="</ul></li>";
              break;
          }


        }

          return $code;

    }

    public function cerSidebar(){
        return "
        </section>
        <!-- /.sidebar -->
      </aside>

        ";
    }
    public function generarScrum(){
      $prep="";
      for ($i=0; $i<count($this->ruta);$i++){
          $prep.="<li class='active'> ".$this->ruta[$i][1]."</li>";

      }
      return $prep;
    }
    public function preContenido(){

        return "
<!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class='content-wrapper'>
        <!-- Content Header (Page header) -->
        <section class='content-header'>
          <h1>
            ".$this->titulo."
            <small>Descripcion</small>
          </h1>
          <ol class='breadcrumb'>
            ".$this->generarScrum()."
          </ol>
        </section>

        <!-- Main content -->
        <section class='content'>
        ";
    }

	public function renderizar(){
        $this->ahtml($this->encabezado());

        $this->ahtml($this->abrNav());
        if(isset($this->mensajes)){

        }
        if(isset($this->notificaciones)){


        }
        if(isset($this->tareas)){

        }
        if(isset($this->datos_usuario)){
            $this->ahtml($this->generarDatosUsuario());

        }
        $this->ahtml($this->cerNav());
        $this->ahtml($this->abrSidebar());

        if(isset($this->datos_usuario)){
          $this->ahtml($this->infoUsuLat());
        }

        if(isset($this->busqueda)){
          $this->ahtml($this->abrBusqueda());
        }


        if(isset($this->menu)){
          $this->ahtml($this->abrMenu());
        }

        $this->ahtml($this->cerSidebar());
        $this->ahtml($this->preContenido());

        return $this->html;

	}


}